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
        <img src="<?php echo $user_info['image_url']; ?>" class="line-name"/>
        <img src="icon/plus.svg" class="make-book"/>
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
              <button type="button" class="btn btn-default">　　追加　　</button>
            </div>
            <div id="tab2" class="tab-pane">
              <div class="book-shelf-list">
                <div class="book-shelf">
                  <button type="button" class="btn btn-default">　　返却　　</button>
                  <div class="book-title">本のタイトルA</div>
                  <div class="shelf-title">本棚のタイトルA</div>
                </div>
                <div class="book-shelf">
                  <button type="button" class="btn btn-default">　　返却　　</button>
                  <div class="book-title">本のタイトルB</div>
                  <div class="shelf-title">本棚のタイトルB</div>
                </div>
                <div class="book-shelf">
                  <button type="button" class="btn btn-default">　　返却　　</button>
                  <div class="book-title">本のタイトルA</div>
                  <div class="shelf-title">本棚のタイトルA</div>
                </div>
                <div class="book-shelf">
                  <button type="button" class="btn btn-default">　　返却　　</button>
                  <div class="book-title">本のタイトルB</div>
                  <div class="shelf-title">本棚のタイトルB</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
