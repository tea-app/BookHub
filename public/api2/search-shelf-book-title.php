<?php

require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$shelf_id = 3;
$title = '本のタイトル';

$books_data = $books->searchShelfBookTitle($shelf_id, $title);

var_dump($books_data);