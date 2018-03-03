<?php

require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();

if($checkLogin['status'] == '200')
{
  var_dump($checkLogin);


  require_once(__DIR__.'/api2/get-shelf-data.php');
  
  $shelf = getShelfData($checkLogin['pdo'], 3);
  var_dump($shelf);
  
  require_once(__DIR__.'/api2/get-user-info.php');
  $userInfo = getUserInfo($checkLogin['pdo'], $shelf['data']['user_id']);
  var_dump($userInfo);
  
  require_once(__DIR__.'/api2/get-shelf-cate.php');
  $cate = getShelfCate($checkLogin['pdo'], 3);
  var_dump($cate['data']);
  
  require_once(__DIR__.'/api2/get-shelf-books.php');
  $books = getShelfBooks($checkLogin['pdo'], 3);
  var_dump($books['data']);
}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}

