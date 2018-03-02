<?php

class Shelf
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
   * インスタンス生成
   */
  public function __construct($connect, $dbtable)
  {
    $this->connect = $connect;
    $this->dbtable = $dbtable;
  }

  /**
   * Add New Shelf
   * 
   * @param string $title
   * @param string $user_id
   * @param string $detail
   * @param int $type
   */
  public function newShelf($title, $user_id, $detail, $type)
  {
    $stmt = $this->connect->prepare('INSERT INTO shelf (title, user_id, detail, type) VALUES (:title, :user_id, :detail, :type)');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_INT);
    var_dump($stmt->execute());
  }

  /**
   * Get All Shelf Data
   */
  public function getAllShelf()
  {
    $stmt = $this->connect->prepare('SELECT * FROM shelf');
    $stmt->execute();
    $shelfs = $stmt->fetchAll();
    return $shelfs;
  }
}