<?php

function getAllShelf()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Shelf.php');
    $pdo = $check['pdo'];
    $shelfs = new Shelf($pdo, 'shelf');
    
    $shelfs_data = $shelfs->getAllShelf();
    return $shelfs_data;
  }else{
    exit('400');
  }
}

$shelfs = getAllShelf();
var_dump($shelfs);