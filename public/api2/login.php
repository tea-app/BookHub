<?php

session_start();
require_once(__DIR__.'/../../src/Auth.php');
require_once(__DIR__.'/../../src/Users.php');
require_once(__DIR__.'/../../src/connect.php');
$auth_code = $_GET['code'];

$auth = new Auth();
$pdo = connect();
$users = new Users($pdo, 'users');
$url = 'https://dev.prog24.com/public/user.php';

if($auth_code)
{
  // Auth Codeがある
  if($_SESSION['accessToken'])
  {
    // アクセストークンを持っている
    if($auth->checkAccessToken($_SESSION['accessToken']))
    {
      // 有効なアクセストークン
      $profile = $auth->getProfile($_SESSION['accessToken']);
      if($users->getUserInfo($profile['userId']))
      {
        // 登録済み
        header("Location: {$url}");
        exit("200");
      }
      else
      {
        // 未登録
        $user_icon = $profile['pictureUrl'];
        $name = $profile['displayName'];
        $users->addUser($_SESSION['userId'], $name, $_SESSION['accessToken'], $user_icon);
        header("Location: {$url}");
        exit("200");
      }
    }
    else
    {
      // 無効なアクセストークン
      $_SESSION['accessToken'] = null;
      $_SESSION['accessToken'] = $auth->getAccessToken($auth_code);
      $profiele = $auth->getProfile($_SESSION['accessToken']);
      $_SESSION['userId'] = null;
      $_SESSION['userId'] = $profiele['userId'];
      if($users->getUserInfo($_SESSION['userId']))
      {
        // 登録済み
        $users->updateUser($_SESSION['userId'], $_SESSION['accessToken']);
        header("Location: {$url}");
        exit("200");
      }
      else
      {
        // 未登録
        $name = $profiele['displayName'];
        $user_icon = $profile['pictureUrl'];
        $users->addUser($_SESSION['userId'], $name, $_SESSION['accessToken'], $user_icon);
        header("Location: {$url}");
        exit("200");
      }
    }
  }
  else
  {
    echo "アクセストークンがない";
    // アクセストークンを持っていない
    $_SESSION['accessToken'] = $auth->getAccessToken($auth_code);
    $profile = $auth->getProfile($_SESSION['accessToken']);
    $_SESSION['userId'] = null;
    $_SESSION['userId'] = $profile['userId'];
    if($users->getUserInfo($_SESSION['userId']))
    {
      // 登録済み
      $users->updateUser($_SESSION['userId'], $_SESSION['accessToken']);
      header("Location: {$url}");
      exit("202");
    }
    else
    {
      echo "aa";
      // 未登録
      $user_icon = $profile['pictureUrl'];
      $name = $profile['displayName'];
      $users->addUser($_SESSION['userId'], $name, $_SESSION['accessToken'], $user_icon);
      header("Location: {$url}");
      exit("200");
    }
  }
}
else
{
  // Auth Codeがない
  exit("400");
}