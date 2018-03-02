<?php

require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$id = 3;

$book_data = $books->searchShelfBookData($id);
var_dump($book_data);