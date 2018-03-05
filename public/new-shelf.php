<?php
require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();
if($checkLogin['status'] == '200')
{
  //
  $base_url = 'https://dev.prog24.com/public/';
  require_once(__DIR__.'/api2/get-user-info.php');
  $login_user = getUserInfo($checkLogin['pdo'], $_SESSION['userId'])['data'];
}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BookHub</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/shelf-new.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
	</head>
    <body>
      <header>
        <div class="logo">BookHub</div>
        <a href="<?php echo $base_url.'user.php' ?>"><img src="<?php echo $login_user['image_url']; ?>" class="line-name"></img></a>
        <img src="icon/plus.svg" class="make-book"></img>
      </header>
      <div class="main">
        <div class="content">
          <div class="new-shelf">新規本棚</div>
          <form action="api2/new-shelf.php" method="post">
          <div class="name-shelf">本棚名
            <input type="text" name="name">
          </div>
          <div class="explanation-shelf">説明
            <input type="text" name="detail">
          </div>
          <button type="submit" class="btn page-link text-dark d-inline-block">　　作成　　</button>
          </form>
        </div>
      </div>
    </body>
</html>
