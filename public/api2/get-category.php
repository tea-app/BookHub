<?php

function getCategory()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Categories.php');
    $pdo = $check['pdo'];
    $categories = new Categories($pdo, 'categories');

    $id = 1;

    $cate = $categories->getCategory($id);
    return $cate;
  }else{
    $return = array('status'=>'400');
    return $return;
  }
}

$cate = getCategory();
var_dump($cate);