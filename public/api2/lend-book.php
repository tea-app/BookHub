<?php
session_start();

function lendBook()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '400')
  {
    exit("400");
  }else{
    require_once(__DIR__.'/../../src/Books.php');
    $pdo = $check['pdo'];
    $books = new Books($pdo, 'books');

    $id = 3;
    $userId = $_SESSION['userId'];

    $books->lendBook($id, $userId);
    $return = array('status'=>'200');
    return $return;
  }
}

$return = lendBook();
var_dump($return);
