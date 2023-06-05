<?php

class User
{
    private DB $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    /**
     * @throws Exception
     */
    public function create(array $fields)
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }

        return $this;
    }


}