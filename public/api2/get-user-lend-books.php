<?php
session_start();

function getUserLendBooks($pdo)
{
  if($pdo)
  {
    require_once(__DIR__.'/../../src/Books.php');
    $books = new Books($pdo, 'books');
    $books_data = $books->getUserLendBooks($_SESSION['userId']);
    $return = array(
      'status'=>'200',
      'data'=>$books_data
    );
    return $return;
  }else{
    $return = array('status'=>'400');
    return $return;
  }
}

// function getUserLendBookss()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin();
//   if($check['status'] == "400")
//   {
//     // 400ページに飛ばす
//     exit("400");
//   }else{
//     $pdo = $check['pdo'];
//     require_once(__DIR__.'/../../src/Books.php');
//     $books = new Books($pdo, 'books');
    
//     $userId = $_SESSION['userId'];
//     $books_data = $books->getUserLendBooks($userId);
//     return $books_data;
//   }
// }

// $books = getUserLendBookss();
// var_dump($books);