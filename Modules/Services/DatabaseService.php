<?php

class DatabaseService
{

    private static ?DatabaseService $_instance = null;
    private PDO $_pdo; //PHP Data Object
    private $_query;
    private bool $_error = false;
    private array $_results;
    private int $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/database'),
                Config::get('mysql/username'),
                Config::get('mysql/password')
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function getInstance(): ?DatabaseService
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DatabaseService();
        }
        return self::$_instance;
    }


    public function query($sql, $params = []): DatabaseService
    {
        $this->_error = false;
        $this->_query = $this->_pdo->prepare($sql);

        if ($this->_query) {
            foreach ($params as $i => $param) {
                $this->_query->bindValue($i + 1, $param);
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, array $where = []): DatabaseService|bool
    {
        $validOperators = ['=', '>', '<', '>=', '<='];

        if (count($where) === 3 && in_array($where[1], $validOperators)) {
            [$field, $operator, $value] = $where;

            $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

            if (!$this->query($sql, [$value])->error()) return $this;
        }

        if (count($where) === 0) {
            $sql = "{$action} FROM {$table}";

            if (!$this->query($sql)->error()) return $this;
        }

        return false;
    }

    public function get($table, array $where = []): DatabaseService|bool
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where): DatabaseService|bool
    {
        return $this->action('DELETE', $table, $where);
    }

    public function results(): array
    {
        return $this->_results;
    }

    public function first(): object|null
    {
        return $this->count() ? $this->results()[0] : null;
    }

    public function error(): bool
    {
        return $this->_error;
    }

    public function count(): int
    {
        return $this->_count;
    }
}