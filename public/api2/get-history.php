<?php

$json_string = file_get_contents('php://input');

$userInfo = json_decode($json_string, true);
$userId = $userInfo['userId'];

require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');
$pdo = connect();
$books = new Books($pdo, 'books');
$books_data = $books->getUserLendBooks($userId);
// $json_book_data = json_encode($books_data, JSON_UNESCAPED_UNICODE);

$return = array(
  'status'=>200,
  'userId'=>$userId,
  'lendBooks'=>$books_data
);

print json_encode($return, JSON_UNESCAPED_UNICODE);