<?php

require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();

if($checkLogin['status'] == '200')
{
  require_once(__DIR__.'/api2/get-user-info.php');
  $login_user = getUserInfo($checkLogin['pdo'], $_SESSION['userId'])['data'];
  $shelf_id = $_GET['id'];
  require_once(__DIR__.'/api2/get-shelf-cate.php');
  $cate = getShelfCate($checkLogin['pdo'], $shelf_id)['data'];
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
    <link rel="stylesheet" href="css/shelf-config.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
	</head>
    <body>
      <header>
      <div class="logo">BookHub</div>
      <a href="<?php echo $base_url.'user.php'; ?>"><img src="<?php echo $login_user['image_url']; ?>" class="line-name"></img></a>
      <img src="icon/plus.svg" class="make-book"></img>
      </header>
      <div class="main">
        <div class="content">
          <div class="shelf-config">本棚設定</div>
          <div class="cat-edit">カテゴリ編集</div>
          <div class="cat-list">
            <?php foreach($cate as $data) : ?>
            <div class="cat-card"><p><?php echo $data['name'] ?></p></div>
            <?php endforeach; ?>
            <!-- <div class="cat-card"><p>小説</p></div>
            <div class="cat-card"><p>マンガ</p></div>
            <div class="cat-card"><p>小説</p></div>
            <div class="cat-card"><p>小説</p></div>
            <div class="cat-card"><p>小説</p></div>
            <div class="cat-card"><p>小説</p></div> -->
          </div>
          <div class="cat-space"></div>
          <div class="cat-form">
            <form action="https://dev.prog24.com/public/api2/new-cate.php" method="POST">
              <input type="text" name="cate_name">
              <input type="hidden" name="shelf_id" value="<?php echo $_GET['id'] ?>">
          </div>
          <button type="submit" class="btn btn-default btn-sm">　追加　</button>
            </form>
        </div>
      </div>
    </body>
</html>
