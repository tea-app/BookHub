<?php

session_start();
require_once(__DIR__.'/../../src/Auth.php');
require_once(__DIR__.'/../../src/Users.php');
require_once(__DIR__.'/../../src/connect.php');

function checkLogin()
{
  $pdo = connect();
  $users = new Users($pdo, 'users');
  $auth = new Auth();
  if($_SESSION['accessToken'])
  {
    if($_SESSION['userId'])
    {
      if($users->getUserInfo($_SESSION['userId']))
      {
        if($auth->checkAccessToken($_SESSION['accessToken']))
        {
          // ログインOK
          exit("200");
        }
        else
        {
          // アクセストークンが無効
          exit("400");
        }
      }
      else
      {
        // 未登録
        exit("400");
      }
    }
    else
    {
      // ユーザIdを持っていない
      exit("400");
    }
  }
  else
  {
    // アクセストークンが無い
    exit("400");
  }
}