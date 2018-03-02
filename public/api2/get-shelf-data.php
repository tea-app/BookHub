<?php

function getShelfData()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Shelf.php');
    $pdo = $check['pdo'];
    $shelfs = new Shelf($pdo, 'shelf');

    $id = 1;

    $shelf_data = $shelfs->getShelfData($id);
    return $shelf_data;
  }else{
    exit('400');
  }
}

$shelf = getShelfData();
var_dump($shelf);