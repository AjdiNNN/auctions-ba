<?php
require_once __DIR__.'/BaseDao.class.php';

 class BidsDao extends BaseDao{


  public function __construct(){
    parent::__construct("bids");
  }

 }
 ?>
