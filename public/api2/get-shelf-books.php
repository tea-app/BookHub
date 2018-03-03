<?php
/**
 * @param PDO
 */
function getShelfBooks($pdo)
{
  require_once(__DIR__.'/checkLoginAPI.php');
  $check = checkLogin($pdo);
  if($check['status'] == '400')
  {
    exit("400");
  }else{
    require_once(__DIR__.'/../../src/Books.php');
    $pdo = $check['pdo'];
    $books = new Books($pdo, 'books');
    
    $shelf_id = 3;
    
    $books_data = $books->searchShelfBooks($shelf_id);
    return $books_data;
  }
}