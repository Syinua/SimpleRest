<?php

class MyAPI extends API
{
    private $users = [
        1 => [
            'login' => 'admin',
            'pass'  => 'admin',
            'fname' => 'Ivan',
            'lname' => 'Ivanov',
        ],
        2 => [
            'login' => 'user',
            'pass'  => 'user',
            'fname' => 'Petya',
            'lname' => 'Sidorov',
        ],
    ];

    public function __construct($request, $origin)
    {
        AuthBasic::require_auth();
        parent::__construct($request);
    }

    /**
     * Example of an Endpoint
     */
    protected function example()
    {
        if ($this->method == 'GET') {
            return "Your name is ";
        } else {
            return "Only accepts GET requests";
        }
    }

    /**
     * Gets user list
     * @url GET /users
     */
    protected function users()
    {
        return $this->users;
    }

    /**
     * Gets the user by id or current user
     * @url GET /user/$id
     * @url GET /user/current
     */
    protected function user()
    {
        if (isset($this->args[0]) && isset($this->users[$this->args[0]])) {
            return $user = $this->users[$this->args[0]];
        }
        return "User not found";
    }
}