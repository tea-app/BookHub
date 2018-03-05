<?php
session_start();

require_once(__DIR__.'/checkLoginPage.php');
$checkLogin = checkLoginPage();
var_dump($checkLogin);

if($checkLogin['status'] == '200')
{
  $book_id = $_GET['book_id'];
  require_once(__DIR__.'/../../src/Books.php');
  $books = new Books($checkLogin['pdo'], 'books');
  $books->lendBook($book_id, $_SESSION['userId']);
  $url = "https://dev.prog24.com/public/shelf.php?id=".$_GET['book_id'];

}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}