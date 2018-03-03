<?php

function searchShelfBookData()
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin();
  if($check['status'] == '400')
  {
    exit('400');
  }else{
    require_once(__DIR__.'/../../src/Books.php');
    $pdo = $check['pdo'];
    $books = new Books($pdo, 'books');
    
    $id = 3;
    
    $book_data = $books->searchShelfBookData($id);
    return $book_data;
  }
}

$books = searchShelfBookData();
var_dump($books);
