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