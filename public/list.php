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
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <script src="js/modal.js"></script>
	</head>
  <body>
    <header>
      <div class="logo">BookHub</div>
      <img src="test.jpg" class="line-name"></img>
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
        <div class="shelf-list">
          <?php foreach($books as $book) : ?>
          <div class="book-content" id="<?php echo $book['id']; ?>" onClick="reaction(this);">
            <img src="<?php echo $book['image_url']; ?>" class="book-img"></img>
            <div class="book-info">
              <div class="book-title">
                <?php echo $book['title']; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </body>
</html>
