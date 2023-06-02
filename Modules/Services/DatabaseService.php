<?php

class DatabaseService
{

    private static ?DatabaseService $_instance = null;
    private PDO $_pdo; //PHP Data Object
    private $_query;
    private bool $_error = false;
    private $_results;
    private int $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/database'),
                Config::get('mysql/username'),
                Config::get('mysql/password')
            );

            echo 'Connected';
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

}