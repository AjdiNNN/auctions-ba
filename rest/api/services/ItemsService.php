<?php
require_once __DIR__.'/BaseService.php';
require_once __DIR__."/../dao/ItemsDao.class.php";

class AdminService extends BaseService{
    public function __construct(){
        parent::__construct(new ItemsDao);
    }
    public function get_by_desc($name_desc) {
      return $this->dao->get_by_desc($name_desc);
  }
}
?>
