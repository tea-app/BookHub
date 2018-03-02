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
          $return = array('status'=>'200',
            'pdo'=>$pdo
          );
          return $return;
        }
        else
        {
          // アクセストークンが無効
          $return = array('status'=>'400');
          return $return;
        }
      }
      else
      {
        // 未登録
        $return = array('status'=>'400');
        return $return;
      }
    }
    else
    {
      // ユーザIdを持っていない
      $return = array('status'=>'400');
      return $return;
    }
  }
  else
  {
    // アクセストークンが無い
    $return = array('status'=>'400');
    return $return;
  }
}