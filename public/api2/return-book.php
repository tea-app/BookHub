<?php

function returnBook()
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
    $status = 0;
    
    $books->lendBook($id, $status);
    $return = array('status'=>'200');
    return $return;
  }
}

$return = returnBook();
var_dump($return);