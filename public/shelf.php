<?php
require_once(__DIR__.'/api2/checkLoginPage.php');
$checkLogin = checkLoginPage();

if($checkLogin['status'] == '200')
{
  $id = $_GET['id'];
  require_once(__DIR__.'/api2/get-shelf-data.php'); 
  $shelf_info = getShelfData($checkLogin['pdo'], $id)['data'];
  require_once(__DIR__.'/api2/get-shelf-cate.php');
  $cate = getShelfCate($checkLogin['pdo'], $id)['data'];
  require_once(__DIR__.'/api2/get-shelf-books.php');
  $books = getShelfBooks($checkLogin['pdo'], $id)['data'];

  require_once(__DIR__.'/api2/get-user-info.php');
  $user_info = getUserInfo($checkLogin['pdo'], $shelf_info['user_id'])['data'];
  $login_user = getUserInfo($checkLogin['pdo'], $_SESSION['userId'])['data'];
  $base_url = 'https://dev.prog24.com/public/';

  require_once(__DIR__.'/api2/get-category.php');
  $_SESSION['shelf_id'] = null;
  $_SESSION['shelf_id'] = $_GET['id'];
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
    <link rel="stylesheet" href="css/shelf.css">
    <link rel="stylesheet" href="css/search.css">

    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/bookcard.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/modal2.js"></script>
	</head>
    <body>
      <header>
        <div class="logo">BookHub</div>
        <a href="<?php echo $base_url.'user.php'; ?>"><img src="<?php echo $login_user['image_url']; ?>" class="line-name"></img></a>
        <img src="icon/plus.svg" class="make-book"></img>
      </header>
      <div class="main">
        <div class="content">
          <div class="shelf">
            <div class="shelf-name"><?php echo $shelf_info['title']; ?></div>
            <div class="shelf-maker">作成者：<?php echo $user_info['name']; ?></div>
            <div class="shelf-explanation"><?php echo $shelf_info['detail']; ?></div>
          </div>
          <div class="search-space">
              <div class="category">
                <select class="custom-select d-block w-100" id="country" required>
                  <?php foreach($cate as $data) : ?>
                  <option><?php echo $data['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="search">
                <input type="text" class="form-control" id="bookName" placeholder="Search" value required>
              </div>
          </div>
          <div class="book-line-up">
            <?php foreach($books as $book) : ?>
              <div class="book-card" data-target="<?php echo $book['id']; ?>">
                <img src="<?php echo $book['image_url'] ?>" />
                <div class="book-card-mini"><p class="book-card-text"><?php echo $book['title'] ?></p></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="floating">
          <a href="https://dev.prog24.com/public/new-book.php?id=<?php echo $_GET['id'] ?>">
            <img src="icon/book-plus.svg" width="70px" height="70px"/>
          </a>
        </div>
      </div>

      <!-- ここからモーダル -->
      <?php foreach($books as $book) : ?>
        <div id="<?php echo $book['id']; ?>" class="modal-contents">
          <img src="<?php echo $book['image_url']; ?>" class="modal-book-img"></img>
          <div class="modal-info">
            <div class="modal-title">タイトル：<?php echo $book['title']; ?></div>
            <div class="modal-writer">著者名：<?php echo $book['author']; ?></div>
            <div class="modal-isbn">isbn：<?php echo $book['isbn']; ?></div>
            <?php
            $book['cate'] = getCategory($checkLogin['pdo'], $book['cate_id']);
            ?>
            <div class="modal-category">カテゴリ：<?php echo $book['cate']['data']['name']; ?></div>
          </div>
          <!-- 借りられている時は借りている人の名前を表示する -->
          <?php if($book['status'] == '0') : ?>
          <a href="https://dev.prog24.com/public/api2/lend-book.php?book_id=<?php echo $book['id'] ?>"><button type="button" role="button" class="modal-borrow-button btn btn-lg btn-primary">借りる!</button></a>
          <?php else : ?>
          借りられています
          <?php endif; ?>
          

          <p><a id="modal-close" class="button-link">×</a></p>
        </div>
      <?php endforeach; ?>
    </body>
</html>
