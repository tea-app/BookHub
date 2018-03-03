<?php

class Categories
{
  /**
   * @var PDO
   */
  private $connect;

  /**
   * @var string
   */
  private $dbtable;

  /**
   * インスタンスを生成する
   */
  public function __construct($connect, $dbtable)
  {
    $this->connect = $connect;
    $this->dbtable = $dbtable;
  }

  public function newCate($name, $shelf_id)
  {
    $stmt = $this->connect->prepare('INSERT INTO categories (name, shelf_id) VALUES (:name, :shelf_id)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->execute();
  }
}