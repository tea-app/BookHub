<?php

require_once(__DIR__.'/../../src/Auth.php');
$auth_code = $_GET['code'];

// セッションスタート
session_start();

if($_SESSION["accessToken"])
{
  $auth = new Auth();
  $check = $auth->checkAccessToken($_SESSION["accessToken"]);
  if($check)
  {
    //
  }
  else
  {
    if($auth_code){
      $auth = new Auth();
      $access_token = $auth->getAccessToken($auth_code);
      $user_id = $auth->getUserId($access_token);
      $_SESSION["accessToken"] = null;
      $_SESSION["accessToken"] = $access_token;
      var_dump($_SESSION["accessToken"]);
    }else{
      echo 'Null';
    }
  }
}
else
{
  if($auth_code){
    $auth = new Auth();
    $access_token = $auth->getAccessToken($auth_code);
    $user_id = $auth->getUserId($access_token);
    $_SESSION["accessToken"] = null;
    $_SESSION["accessToken"] = $access_token;
    var_dump($_SESSION["accessToken"]);
  }else{
    echo 'Null';
  }
  
}
