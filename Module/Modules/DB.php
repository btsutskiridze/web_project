<?php

class DB //database
{

    private static ?DB $_instance = null;
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

    public static function getInstance(): DB
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }


    public function query($sql, $params = []): DB
    {
        $this->_error = false;
        $this->_query = $this->_pdo->prepare($sql);

        if ($this->_query) {
            $x = 1;
            foreach ($params as $param) {
                $this->_query->bindValue($x++, $param);
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

    private function executeQuery(string $sql, array $params = []): DB|bool
    {
        $query = $this->query($sql, $params);
        return !$query->error() ? $this : false;
    }

    public function action($action, $table, array $where = []): DB|bool
    {
        $validOperators = ['=', '>', '<', '>=', '<='];

        if (count($where) === 3 && in_array($where[1], $validOperators)) {
            [$field, $operator, $value] = $where;

            $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

            return $this->executeQuery($sql, [$value]);
        }

        if (empty($where)) {
            $sql = "{$action} FROM {$table}";

            return $this->executeQuery($sql);
        }

        return false;
    }

    public function get($table, array $where = []): DB|bool
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function getWithRelations($table, $relations = []): DB|bool
    {
        // Select query for the main table
        $sql = "SELECT * FROM {$table}";

        // Fetch related data
        foreach ($relations as $relation) {
            $relatedTable = $relation['table'];
            $joinCondition = $relation['condition'];

            $sql .= " JOIN {$relatedTable} ON {$joinCondition}";
        }

        return $this->executeQuery($sql);
    }


    public function delete(string $table, array $where): DB|bool
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert(string $table, array $fields): DB|bool
    {
        if (empty($fields)) return false;

        $columns = implode("`,`", array_keys($fields));
        $placeholders = implode(', ', array_fill(0, count($fields), '?'));

        $sql = "INSERT INTO  {$table} (`{$columns}`) VALUES({$placeholders})";

        return $this->executeQuery($sql, $fields);
    }

    public function update(string $table, int $id, array $fields)
    {
        if (empty($fields)) return false;

        $sets = implode(', ', array_map(function ($key) {
            return "{$key} = ?";
        }, array_keys($fields)));

        $sql = "UPDATE {$table} SET {$sets} WHERE id = {$id}";

        return $this->executeQuery($sql, $fields);
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