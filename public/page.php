<?php
session_start();
require_once(__DIR__.'/api2/checkLoginPage.php');

var_dump($_SESSION["accessToken"]);
var_dump($_SESSION["userId"]);
echo 'AAA';
?>
<a href="./api2/logout.php">ログアウト</a>