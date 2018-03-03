<?php

function getShelfCate()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Categories.php');
    $pdo = $check['pdo'];
    $categories = new Categories($pdo, 'categories');

    $shelf_id = 3;

    $cate = $categories->getShelfCate($shelf_id);
    return $cate;
  }else{
    $return = array('status'=>'400');
    return $return;
  }
}

$cate = getShelfCate();
var_dump($cate);