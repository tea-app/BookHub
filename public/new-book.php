<?php
require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();

if($checkLogin['status'] == '200')
{
  //
  $id = $_GET['id'];
  require_once(__DIR__.'/api2/get-user-info.php');
  $login_user = getUserInfo($checkLogin['pdo'], $_SESSION['userId'])['data'];
  require_once(__DIR__.'/api2/get-shelf-cate.php');
  $cate = getShelfCate($checkLogin['pdo'], $id)['data'];
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
    <link rel="stylesheet" href="css/book-setting.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
	</head>
    <body>
      <header>
        <div class="logo">BookHub</div>
        <img src="<?php echo $login_user['image_url']; ?>" class="line-name"></img>
        <img src="icon/plus.svg" class="make-book"></img>
      </header>
      <div class="main">
        <div class="content">
          <div class="book-add">書籍追加</div>
          <form action="https://dev.prog24.com/public/api2/add-book.php?id=<?php echo $_GET['id'] ?>" method="POST">
          <div class="isbn">isbn
            <div class="control-1">
              <button type="button" class="btn page-link text-dark d-inline-block btn-sm">　　自動入力　　</button>
            </div>
              <input type="text" name="isbn">
          </div>
          <div class="book-name">書籍名
              <input type="text" name="name">
          </div>
          <div class="author-name">著者名
              <input type="text" name="author">
          </div>
          <div class="img-url">画像URL
              <input type="text" name="image_url" value="https://dev.prog24.com/public/icon/hatena.jpg">
          </div>
          <div class="category">カテゴリ
            <select class="custom-select d-block w-100" id="country" required name="cate_id">
              <?php foreach($cate as $data) : ?>
              <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="control-2">
            <button type="submit" class="btn page-link text-dark d-inline-block">　　作成　　</button>
          </div>
          </form>
        </div>
      </div>
    </body>
</html>
