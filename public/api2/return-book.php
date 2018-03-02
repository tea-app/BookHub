<?php

require_once(__DIR__.'/../../src/connect.php');
require_once(__DIR__.'/../../src/Books.php');

$pdo = connect();
$books = new Books($pdo, 'books');

$id = 3;
$status = 0;

$books->lendBook($id, $status);