<?php

/**
 * @param PDO
 * @param string user_id
 * 
 * @return array UserInfo
 */
function getUserInfo($pdo, $user_id)
{
  if($pdo)
  {
    require_once(__DIR__.'/../../src/Users.php');
    $users = new Users($pdo, 'users');

    $userInfo = $users->getUserInfo($user_id);
    $return = array(
      'status'=>'200',
      'data'=>$userInfo
    );
    return $return;
  }else{
    $return = array(
      'status'=>'400'
    );
    return $return;
  }
}