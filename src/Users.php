<?php

class Users
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
   * 
   * @param PDO $connect
   * @param string $dbtable
   */
  public function __construct($connect, $dbtable)
  {
    $this->connect = $connect;
    $this->dbtable = $dbtable;
  }

  /**
   * @param string $user_id
   * @param string $user_name
   * @param string $access_token
   */
  public function addUser($user_id, $name, $access_token, $image_url)
  {
    $stmt = $this->connect->prepare('INSERT INTO users (user_id, name, access_token, image_url) VALUES (:user_id, :name, :access_token, :image_url)');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':access_token', $access_token, PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);
    $stmt->execute();
  }
  /**
   * Update
   */
  public function updateUser($user_id, $access_token)
  {
    $stmt = $this->connect->prepare('UPDATE users set access_token =:access_token where user_id =:user_id');
    $stmt->bindValue(':access_token', $access_token, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
  }

  /**
   * Get User Info
   * @param string $user_id
   */
  public function getUserInfo($user_id)
  {
    $smtp = $this->connect->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $smtp->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $smtp->execute();
    $data = $smtp->fetch();
    return $data;
  }
}