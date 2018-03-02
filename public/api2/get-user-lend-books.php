<?php
session_start();
require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$userId = $_SESSION['userId'];
$books_data = $books->getUserLendBooks($userId);

var_dump($books_data);