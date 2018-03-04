<?php

$isbn = $_POST['isbn'];
$title = $_POST['name'];
$author = $_POST['author'];
$image_url = $_POST['image_url'];
$cate_id = (int)$_POST['cate_id'];
$status = 0;
$shelf_id = $_GET['id'];

require_once(__DIR__.'/../../src/connect.php');
$pdo = connect();
require_once(__DIR__.'/../../src/Books.php');
$books = new Books($pdo, 'books');
$books->newBookData($shelf_id, $isbn, $title, $author, $image_url, $status, $cate_id);

$url = "https://dev.prog24.com/public/shelf.php?id=$shelf_id";
header("Location: {$url}");

// function addBook($pdo, $shelf_id, $isbn, $title, $author, $image_url, $cate_id)
// {
//   if($pdo)
//   {
//     require_once(__DIR__.'/../../src/Books.php');
//     $books = new Books($pdo, 'books');
//     $status = 0;

//     $books->newBookData($shelf_id, $isbn, $title, $author, $image_url, $status, $cate_id);
//   }
// }

// function addBook()
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $checkFlag = checkLogin();
//   if($checkFlag['status'] == "400")
//   {
//     // エラー（403ページとかに飛ばす?）
//     exit("400");
//   }
//   require_once(__DIR__.'/../../src/Books.php');
//   $pdo = $checkFlag['pdo'];
//   $books = new Books($pdo, 'books');
//   // $shelf_id = $_POST['shelf_id'];
//   // $isbn = $_POST['isbn'];
//   // $title = $_POST['title'];
//   // $author = $_POST['author'];
//   // $image_url = $_POST['image_url'];
//   // $status = $_['status'];
//   // $cate_id = $_['cate_id'];
  
//   $shelf_id = 3;
//   $isbn = 123456789;
//   $title = '本のタイトル2';
//   $author = '本の著者名';
//   $image_url = 'https://image.example.com';
//   $status = 0;
//   $cate_id = 3;
  
//   $books->newBookData($shelf_id, $isbn, $title, $author, $image_url, $status, $cate_id);
// }

// // Testing
// $books = addBook();