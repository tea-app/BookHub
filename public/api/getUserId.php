<?php

require_once(__DIR__.'/../../src/Auth.php');
require_once(__DIR__.'/checkLogin.php');

$auth = new Auth();
$json = $auth->getUserId($_SESSION["accessToken"]);
$user_id = json_decode($json, true)["userId"];

var_dump($user_id);
