<?php

function newCate()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Categories.php');
    $pdo = $check['pdo'];
    $categories = new Categories($pdo, 'categories');

    $name = 'カテゴリ名';
    $shelf_id = 3;

    $categories->newCate($name, $shelf_id);
    $return = array('status'=>'200');
    return $return;
  }else{
    exit('400');
  }
}

$return = newCate();
var_dump($return);
