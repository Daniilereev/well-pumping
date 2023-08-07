<?php
session_start();
if (!isset($_SESSION['errormsg2'])) {
  $_SESSION['errormsg2'] = '';
}
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (password_verify($token,$hashedtoken)) {
      header('Location: ggmainauth.php');
    }
  }
//проверка на авторизацию
?>
<?php
// include_once('php/validateregistrationserver.php');
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Регистрация</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheader.php';
?>
<div class="main">
  <form class="" action="php/validateregistrationserver.php" method="post">
    <div class="container__login">
    <h2 class="title__two">Подтверждение регистрации</h2>
    <p>На указанную почту отправлен код. Введите его, чтобы подтвердить регистрацию</p>
    <input type="" name="passmailcheck" placeholder="Code from mail" class="logininput">
    <button class="whitebutton" type="submit" name="button">Зарегистрироваться</button>
    <div class="errmsg"><?=$_SESSION['errormsg2']?></div>
    <a href="ggmain.php">Вернуться на главную</a>
    </div>
  </form>
</div>

<?php
include_once 'ggbottom.php';
?>

</body>
</html>
