<?php
/**
 * @param PDO
 * @param int $id
 * 
 * @return array books
 */

function getShelfBooks($pdo, $id)
{
  if($pdo)
  {
    require_once(__DIR__.'/../../src/Books.php');
    $books = new Books($pdo, 'books');


    $books_data = $books->searchShelfBooks($id);
    $return = array(
      'status'=>'200',
      'data'=>$books_data
    );
    return $return;
  }else{
    $return = array(
      'status'=>'400'
    );
    return $return;
  }
  
}

// function getShelfBooks($pdo, $id)
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin($pdo);
//   if($check['status'] == '400')
//   {
//     exit("400");
//   }else{
//     require_once(__DIR__.'/../../src/Books.php');
//     $pdo = $check['pdo'];
//     $books = new Books($pdo, 'books');
    
//     $shelf_id = $id;
    
//     $books_data = $books->searchShelfBooks($shelf_id);
//     return $books_data;
//   }
// }