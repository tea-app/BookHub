<?php

session_start();

require_once(__DIR__.'/../../src/Auth.php');

if($_SESSION["accessToken"])
{
  $auth = new Auth();
  $auth->checkAccessToken($_SESSION['accessToken']);
  // echo $_SESSION["accessToken"];
}
else
{
  exit("401");
}