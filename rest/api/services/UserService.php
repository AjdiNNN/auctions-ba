<?php

require_once __DIR__.'/BaseService.php';
require_once __DIR__.'/../dao/UserDao.class.php';

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new UserDao());
    }

    public function checkExistsEmail($email)
    {
        return $this->dao->checkExistsEmail($email);
    }

    public function checkExistsUsername($username)
    {
        return $this->dao->checkExistsUsername($username);
    }
}
?>
