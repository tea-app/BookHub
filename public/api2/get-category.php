<?php

/**
 * @param PDO
 * @param int $id
 * 
 * @return array cate
 */
function getCategory($pdo, $id)
{
  if($pdo)
  {
    require_once(__DIR__.'/../../src/Categories.php');
    $categories = new Categories($pdo, 'categories');

    $cate = $categories->getCategory($id);
    $return = array(
      'status'=>'200',
      'data'=>$cate
    );
    return $return;
  }else{
    $return = array('status'=>'400');
    return $return;
  }
}

// function getCategory($pdo, $id)
// {
//   require_once(__DIR__.'/checkLoginAPI.php');
//   $check = checkLogin($pdo);
//   if($check['status'] == '200')
//   {
//     require_once(__DIR__.'/../../src/Categories.php');
//     $pdo = $check['pdo'];
//     $categories = new Categories($pdo, 'categories');

//     $id = 1;

//     $cate = $categories->getCategory($id);
//     return $cate;
//   }else{
//     $return = array('status'=>'400');
//     return $return;
//   }
// }

// $cate = getCategory();
// var_dump($cate);