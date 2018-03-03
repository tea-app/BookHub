<?php
session_start();

function getUserShelfData()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '200')
  {
    require_once(__DIR__.'/../../src/Shelf.php');
    $pdo = $check['pdo'];
    $shelfs = new Shelf($pdo, 'shelf');

    $user_id = $_SESSION['userId'];

    $shelf_data = $shelfs->getUserShelfData($user_id);
    return $shelf_data;
  }
}

$shelf = getUserShelfData();
var_dump($shelf);