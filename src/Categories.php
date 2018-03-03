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

  /**
   * New Category
   * 
   * @param string $name
   * @param int $shelf_id
   */
  public function newCate($name, $shelf_id)
  {
    $stmt = $this->connect->prepare('INSERT INTO categories (name, shelf_id) VALUES (:name, :shelf_id)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * Get Shelf's Categories
   * 
   * @param int $shelf_id
   * 
   * @return array $categories
   */
  public function getShelfCate($shelf_id)
  {
    $stmt = $this->connect->prepare('SELECT * FROM categories WHERE shelf_id = :shelf_id');
    $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
  }

  /**
   * Get Category Data
   * 
   * @param int $id
   * 
   * @return array $category
   */
  public function getCategory($id)
  {
    $stmt = $this->connect->prepare('SELECT * FROM categories WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch();
    return $category;
  }
}