<?php

require_once(__DIR__.'/checkLoginPage.php');
$checkLogin = checkLoginPage();
if($checkLogin['status'] == '200')
{
  require_once(__DIR__.'/../../src/Books.php');
  $books = new Books($checkLogin['pdo'], 'books');

  $book_id = $_POST['book_id'];
  $status = 0;
  var_dump($book_id);
  $books->lendBook($book_id, $status);
  $url = "https://dev.prog24.com/public/user.php";
  header("Location: {$url}");
}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}


// function returnBook()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin();
//   if($check['status'] == '400')
//   {
//     exit('400');
//   }else{
//     require_once(__DIR__.'/../../src/Books.php');
//     $pdo = $check['pdo'];
//     $books = new Books($pdo, 'books');
    
//     $id = 3;
//     $status = 0;
    
//     $books->lendBook($id, $status);
//     $return = array('status'=>'200');
//     return $return;
//   }
// }

// $return = returnBook();
// var_dump($return);