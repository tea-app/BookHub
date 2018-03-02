<?php

require_once(__DIR__.'/../../src/Auth.php');

session_start();

$auth = new Auth();
$auth->revokeAccessToken($_SESSION["accessToken"]);
$_SESSION["accessToken"] = null;