<?php

require_once(__DIR__.'/checkLoginPage.php');
$checkLogin = checkLoginPage();
if($checkLogin['status'] == '200')
{
  require_once(__DIR__.'/../../src/Categories.php');
  require_once(__DIR__.'/../../src/connect.php');
  $categories = new Categories($checkLogin['pdo'], 'categories');

  $shelf_id = $_POST['shelf_id'];
  $cate_name = $_POST['cate_name'];

  $categories->newCate($cate_name, $shelf_id);

  $url = "https://dev.prog24.com/public/shelf-setting.php?id=$shelf_id";
  header("Location: {$url}");

}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}

// function newCate()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin();
//   if($check['status'] == '200')
//   {
//     require_once(__DIR__.'/../../src/Categories.php');
//     $pdo = $check['pdo'];
//     $categories = new Categories($pdo, 'categories');

//     $name = 'カテゴリ名';
//     $shelf_id = 3;

//     $categories->newCate($name, $shelf_id);
//     $return = array('status'=>'200');
//     return $return;
//   }else{
//     exit('400');
//   }
// }

// $return = newCate();
// var_dump($return);
