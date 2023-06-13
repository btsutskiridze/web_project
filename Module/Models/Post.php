<?php

class Post
{
    private DB $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    /**
     * @throws Exception
     */
    public function create(array $fields): void
    {
        if (!$this->_db->insert('posts', $fields))
            throw new Exception('There was a problem creating an account.');
    }


    public function get(string $field, $value): object|bool
    {
        $data = $this->_db->get('posts', [$field, '=', $value]);

        if (!$data->count()) return false;

        return $data->first();
    }

    public function all(array $fields): array
    {
        return $this->_db
            ->getWithRelations('posts', [
                'table' => 'users',
                'condition' => 'users.id = posts.user_id'
            ])
            ->results();
    }

}