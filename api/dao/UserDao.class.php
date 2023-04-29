<?php

require_once __DIR__.'/BaseDao.class.php';

class UserDao extends BaseDao
{
    /**
    * constructor of dao class
    */
    public function __construct()
    {
        parent::__construct("users");
    }



    public function addUser($userdata)
    {
        $username = $userdata['username'];
        $fname = $userdata['firstname'];
        $sname = $userdata['secondname'];
        $email = strtolower($userdata['email']);
        $hashedpassword = password_hash($userdata['password'], PASSWORD_ARGON2I);
        $this->queryUnique(
            "INSERT INTO users (username, firstname, secondname, email, password) VALUES (:username, :fname, :sname, :email, :hashedpassword)",
            ['email' => $email, 'username' => $username, 'fname' => $fname, 'sname' => $sname,'hashedpassword'=>$hashedpassword]
        );
    }
    public function checkExistsUsername($username)
    {
        return $this->queryUnique("SELECT * FROM users WHERE username = :username LIMIT 1", ['username' => $username]);
    }

    public function checkExistsEmail($email)
    {
        return $this->queryUnique("SELECT * FROM users WHERE email = :email LIMIT 1", ['email' => $email]);
    }
}
