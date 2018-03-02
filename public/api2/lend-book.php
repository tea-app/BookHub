<?php
session_start();
require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$id = 3;
$userId = $_SESSION['userId'];

$books->lendBook($id, $userId);
