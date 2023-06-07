<?php

class User
{
    private DB $_db;
    private object $_data;
    private string $_sessionName;
    private string $_cookieName;

    private bool $_isLoggedIn = false;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if ($user) {
            $this->find($user);
            return;
        }

        if (Session::exists($this->_sessionName)) {
            $user = Session::get($this->_sessionName);

            if ($this->find($user)) {
                $this->_isLoggedIn = true;
            }
        }

    }

    /**
     * @throws Exception
     */
    public function create(array $fields): void
    {
        if (!$this->_db->insert('users', $fields))
            throw new Exception('There was a problem creating an account.');
    }

    public function find($value = null): bool
    {

        if (!$value) return false;

        $field = is_numeric($value) ? 'id' : 'email';

        $data = $this->_db->get('users', [$field, '=', $value]);

        if (!$data->count()) return false;

        $this->_data = $data->first();
        return true;
    }

    public function login($email = null, $password = null): bool
    {
        if (!$this->find($email)) return false;

        if ($this->data()->password !== Hash::make($password)) return false;

        Session::put($this->_sessionName, $this->data()->id);
        
        return true;
    }


    public function logout(): void
    {
        Session::delete($this->_sessionName);
    }

    public function data(): object
    {
        return $this->_data;
    }

    public function isLoggedIn(): bool
    {
        return $this->_isLoggedIn;
    }
}