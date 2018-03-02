<?php

session_start();
require_once(__DIR__.'/../../src/Auth.php');

if($_SESSION["accessToken"])
{
  $auth = new Auth();
  $check = $auth->checkAccessToken($_SESSION["accessToken"]);
  if($check)
  {
    // ログインOK
    exit("200");
  }
  else
  {
    // アクセストークンが無効
    exit("401");
  }
}
else
{
  // アクセストークンが無い
  exit("401");
}