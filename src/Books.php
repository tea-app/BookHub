<?php

class Books
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
   * Add New Book Data
   */
  public function newBookData($shelf_id, $isbn, $title, $author, $image_url, $status, $cate_id)
  {
    $stmt = $this->connect->prepare('INSERT INTO books (shelf_id, isbn, title, author, image_url, status, cate_id) VALUES (:shelf_id, :isbn, :title, :author, :image_url, :status, :cate_id)');
    $stmt->bindValue(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->bindValue(':isbn', $isbn, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':author', $author, PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);
    $stmt->bindValue(':status', $status, PDO::PARAM_INT);
    $stmt->bindValue(':cate_id', $cate_id, PDO::PARAM_INT);
    $stmt->execute();
  }
  
  /**
   * Search Shelf's Books
   * 
   * @param int $shelf_id
   * 
   * @return array $books
   */
  public function searchShelfBooks($shelf_id)
  {
    $stmt = $this->connect->prepare('SELECT * FROM books WHERE shelf_id = :shelf_id');
    $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->execute();
    $books = $stmt->fetchAll();
    return $books;
  }

  /**
   * Search Shelf's Title Books
   * 
   * @param int $shelf_id
   * @param string $title
   */
  public function searchShelfBookTitle($shelf_id, $title)
  {
    $stmt = $this->connect->prepare('SELECT * FROM books WHERE shelf_id = :shelf_id AND title = :title');
    $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();
    $books = $stmt->fetchAll();
    return $books;
  }

  /**
   * Search Shelf's Cate Books
   * 
   * @param int $shelf_id
   * @param int $cate_id
   * 
   * @return array $books
   */
  public function searchShelfCateBooks($shelf_id, $cate_id)
  {
    $stmt = $this->connect->prepare('SELECT * FROM books WHERE shelf_id = :shelf_id');
    $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();
    $books = $stmt->fetchAll();
    return $books;
  }

  /**
   * Search Shelf's Book Data
   * 
   * @param int $id
   */
  public function searchShelfBookData($id)
  {
    $stmt = $this->connect->prepare('SELECT * FROM books WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch();
    return $book;
  }

  /**
   * Lend Books
   * 
   * @param int id
   * @param string userId
   */
  public function lendBook($id, $status)
  {
    $stmt = $this->connect->prepare('UPDATE books SET status = :status WHERE id = :id');
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * Get User Lend Books
   * 
   * @param string $status
   */
  public function getUserLendBooks($status)
  {
    $stmt = $this->connect->prepare('SELECT * FROM books WHERE status = :status');
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->execute();
    $books = $stmt->fetchAll();
    return $books;
  }
}