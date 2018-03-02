<?php

function searchShelfBookTitle()
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
    
    $shelf_id = 3;
    $title = '本のタイトル';
    
    $books_data = $books->searchShelfBookTitle($shelf_id, $title);
    
    return $books_data;
  }
}

$books = searchShelfBookTitle();
var_dump($books);
