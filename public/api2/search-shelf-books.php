<?php

require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$shelf_id = 3;

$books_data = $books->searchShelfBooks($shelf_id);

var_dump($books_data);