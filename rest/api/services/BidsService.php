<?php
require_once __DIR__.'/BaseService.php';
require_once __DIR__."/../dao/BidsDao.class.php";

class AdminService extends BaseService{
    public function __construct(){
        parent::__construct(new BidsDao);
    }

}
?>
