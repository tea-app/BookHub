<?php
// ページ用のログインチェック

session_start();

function checkLoginPage()
{
  $url = 'https://dev.prog24.com/public/login.php';
  if($_SESSION['accessToken'])
  {
    require_once(__DIR__.'/../../src/connect.php');
    require_once(__DIR__.'/../../src/Users.php');
    $pdo = connect();
    $users = new Users($pdo, 'users');

    if($_SESSION['userId'])
    {
      if($users->getUserInfo($_SESSION['userId']))
      {
        require_once(__DIR__.'/../../src/Auth.php');
        $auth = new Auth();
        if($auth->checkAccessToken($_SESSION['accessToken']))
        {
          // 200 OK
          $return = array(
            'status'=>'200',
            'pdo'=>$pdo
          );
          $pdo = null;
          $users = null;
          $auth = null;
          return $return;
        }else{
          $return = array('status'=>'400');
          return $return;
        }
      }else{
        $return = array('status'=>'400');
        return $return;
      }
    }else{
      $return = array('status'=>'400');
      return $return;
    }
  }else{
    $return = array('status'=>'400');
    return $return;
  }
}