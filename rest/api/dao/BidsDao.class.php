<?php
require_once __DIR__.'/BaseDao.class.php';

 class BidsDao extends BaseDao{


  public function __construct(){
    parent::__construct("bids");
  }
  public function get_by_name($name){
    $name=strtolower($name);
    $stmt = $this->conn->prepare("SELECT * FROM auctions WHERE LOWER(item_name) LIKE '%".$name."%'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 }
 ?>
