<?php

class DatabaseService
{

    private static ?DatabaseService $_instance = null;
    private PDO $_pdo; //PHP Data Object
    private $_query;
    private bool $_error = false;
    private array|bool $_results;
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

    public function error(): bool
    {
        return $this->_error;
    }
}