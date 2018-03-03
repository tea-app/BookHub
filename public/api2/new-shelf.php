<?php
session_start();

if($_SESSION['userId']){
  require_once(__DIR__.'/../../src/Shelf.php');
  require_once(__DIR__.'/../../src/connect.php');
  $pdo = connect();
  $shelfs = new Shelf($pdo, 'shelfs');
  $title = $_POST['name'];
  $detail = $_POST['detail'];
  $type = 0;
  
  $shelfs->newShelf($title, $_SESSION['userId'], $detail, $type);
}else{
  exit("400");
}



// function newShelf()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin();
//   if($check['status'] == '200')
//   {
//     require_once(__DIR__.'/../../src/Shelf.php');
//     $pdo = $check['pdo'];
//     $shelfs = new Shelf($pdo, 'shelf');

//     $title = "本棚のタイトル";
//     $user_id = $_SESSION['userId'];
//     $detail = "本棚の詳細情報ですよーーー";
//     $type = 4;

//     $shelfs->newShelf($title, $user_id, $detail, $type);
//     $return = array('status'=>'200');
//     return $return;
//   }else{
//     exit('400');
//   }
// }

// $return = newShelf();
// var_dump($return);
