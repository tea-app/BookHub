<?php

function getUserShelf($pdo, $user_id)
{
  if($pdo)
  {
    require_once(__DIR__.'/../../src/Shelf.php');
    $shelfs = new Shelf($pdo, 'shelf');
    $shelf_data = $shelfs->getUserShelfData($user_id);
    $return = array(
      'status'=>'200',
      'data'=>$shelf_data
    );
    return $return;
  }else{
    $return = array(
      'status'=>'400'
    );
    return $return;
  }

}

// function getUserShelfData()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin();
//   if($check['status'] == '200')
//   {
//     require_once(__DIR__.'/../../src/Shelf.php');
//     $pdo = $check['pdo'];
//     $shelfs = new Shelf($pdo, 'shelf');

//     $user_id = $_SESSION['userId'];

//     $shelf_data = $shelfs->getUserShelfData($user_id);
//     return $shelf_data;
//   }
// }

// $shelf = getUserShelfData();
// var_dump($shelf);