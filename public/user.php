<?php
require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();

if($checkLogin['status'] == '200')
{
  require_once(__DIR__.'/api2/get-user-info.php');
  $user_info = getUserInfo($checkLogin['pdo'], $_SESSION['userId'])['data'];
  require_once(__DIR__.'/api2/get-user-shelf.php');
  $shelf = getUserShelf($checkLogin['pdo'], $_SESSION['userId'])['data'];
  $shelf_url = 'https://dev.prog24.com/public/shelf.php?id=';
  $base_url = 'https://dev.prog24.com/public/';

  require_once(__DIR__.'/api2/get-user-lend-books.php');
  $lend_books = getUserLendBooks($checkLogin['pdo'])['data'];
  require_once(__DIR__.'/api2/get-shelf-data.php');
}else{
  $url = 'https://dev.prog24.com/public/login.php';
  header("Location: {$url}");
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>BookHub</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/user-setting.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</head>
    <body>
      <header>
        <div class="logo">BookHub</div>
        <a href="<?php echo $base_url.'user.php'; ?>" title="ユーザページ"><img src="<?php echo $user_info['image_url']; ?>" class="line-name"/></a>
      </header>
      <div class="main">
        <div class="content">
          <div class="setting">設定</div>
          <!-- タブボタン部分 -->
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="#tab1" class="nav-link" data-toggle="tab">所有本棚</a>
            </li>
            <li class="nav-item">
              <a href="#tab2" class="nav-link" data-toggle="tab">借りている本</a>
            </li>
          </ul>
          <!--タブのコンテンツ部分-->
          <div class="tab-content">
            <div id="tab1" class="tab-pane active">
              <div class="book-shelf-list">
                <?php foreach($shelf as $data) : ?>
                <div class="book-shelf">
                  <div class="shelf-title2"><a href="<?php echo $shelf_url.$data['id']; ?>"><?php echo $data['title']; ?></a></div>
                </div>
                <?php endforeach; ?>
              </div>
              <a href="<?php echo $base_url.'new-shelf.php'; ?>"><button type="button" class="btn page-link text-dark d-inline-block">　　追加　　</button></a>
            </div>
            <div id="tab2" class="tab-pane">
              <div class="book-shelf-list">

                <?php foreach($lend_books as $lend_book): ?>
                <?php $lend_book['shelf_name'] = getShelfData($checkLogin['pdo'], $lend_book['shelf_id'])['data']['title'] ?>
                <div class="book-shelf">
                  <form action="https://dev.prog24.com/public/api2/return-book.php" method="POST">
                  <input type="hidden" value="<?php echo $lend_book['id'] ?>" name="book_id">
                  <button type="submit" class="btn page-link text-dark d-inline-block">　　返却　　</button>
                  </form>
                  <div class="book-title"><?php echo $lend_book['title'] ?></div>
                  <div class="shelf-title"><a href="https://dev.prog24.com/public/shelf.php?id=<?php echo $lend_book['shelf_id'] ?>"><?php echo $lend_book['shelf_name'] ?></a></div>
                </div>
                <?php endforeach ; ?>
              </div>
            </div>
          </div>
          <a href="https://dev.prog24.com/public/api2/logout.php">ログアウト</a>
        </div>
        
      </div>
    </body>
</html>
