<?php
// ページ用のログインチェック

session_start();
require_once(__DIR__.'/../../src/Auth.php');
require_once(__DIR__.'/../../src/Users.php');
require_once(__DIR__.'/../../src/connect.php');

$url = 'https://dev.prog24.com/public/login.php';

if($_SESSION['accessToken'])
{
  $pdo = connect();
  $users = new Users($pdo, 'users');

  if($_SESSION['userId'])
  {
    if($users->getUserInfo($_SESSION['userId']))
    {
      // 登録済み
      $auth = new Auth();
      if($auth->checkAccessToken($_SESSION['accessToken']))
      {
        // ログインOK
        // 何もしない
      }
      else
      {
        header("Location: {$url}");
        exit("400");
      }
    }
    else
    {
      header("Location: {$url}");
      exit("400");
    }
  }
  else
  {
    header("Location: {$url}");
    exit("400");
  }
}
else
{
  header("Location: {$url}");
  exit("400");
}