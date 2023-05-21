<?php
require_once __DIR__.'/BaseDao.class.php';

 class ItemsDao extends BaseDao{


  public function __construct(){
    parent::__construct("items");
  }
  public function get_by_desc($name_desc){
    $name_desc=strtolower($name_desc);
    $stmt = $this->conn->prepare("SELECT * FROM auctions WHERE LOWER(description) LIKE '%".$name_desc."%'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 }
 ?>
