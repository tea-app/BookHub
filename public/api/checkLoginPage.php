<?php

session_start();
require_once(__DIR__.'/../../src/Auth.php');

if($_SESSION["accessToken"])
{
  $auth = new Auth();
  $check_login = $auth->checkAccessToken($_SESSION["accessToken"]);
  if($check_login)
  {
    //
  }
  else
  {
    var_dump($check_login);
    $url = 'https://dev.prog24.com/public/login.php';
    header("Location: {$url}");
    exit();
  }
}
else
{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
  exit();
}