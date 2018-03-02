<?php

function addBook()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $checkFlag = checkLogin();
  if($checkFlag['status'] == "400")
  {
    // エラー（403ページとかに飛ばす?）
    exit("400");
  }
  require_once(__DIR__.'/../../src/Books.php');
  $pdo = $checkFlag['pdo'];
  $books = new Books($pdo, 'books');
  // $shelf_id = $_POST['shelf_id'];
  // $isbn = $_POST['isbn'];
  // $title = $_POST['title'];
  // $author = $_POST['author'];
  // $image_url = $_POST['image_url'];
  // $status = $_['status'];
  // $cate_id = $_['cate_id'];
  
  $shelf_id = 3;
  $isbn = 123456789;
  $title = '本のタイトル2';
  $author = '本の著者名';
  $image_url = 'https://image.example.com';
  $status = 0;
  $cate_id = 3;
  
  $books->newBookData($shelf_id, $isbn, $title, $author, $image_url, $status, $cate_id);
}

// Testing
$books = addBook();