<?php

session_start();
require_once(__DIR__.'/../../src/Auth.php');

$url = 'https://dev.prog24.com/public/login.php';

$auth = new Auth();
$auth->revokeAccessToken($_SESSION["accessToken"]);
$_SESSION["accessToken"] = null;
header("Location: {$url}");