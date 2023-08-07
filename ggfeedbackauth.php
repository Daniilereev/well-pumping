<?php
session_start();
if (!isset($_SESSION['nicemsg'])) {
  $_SESSION['nicemsg'] = '';
}
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (!password_verify($token,$hashedtoken)) {
      header('Location: ggfeedback.php');
    }
  } else {
    header('Location: ggfeedback.php');
  }
?>
<?php
// require_once 'php/feedbackserver.php'
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Обратная связь</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheaderauth.php';
?>
<div class="main">
  <form class="" action="php/feedbackserver.php" method="post">
    <div class="container__feedback">
    <h2 class="title__two">Обратная связь</h2>
    <br>
    <textarea class='letter' name="message" rows="8" cols="80" id = 'message__for__me'placeholder="Место для вашего сообщения.."></textarea> <br>
    <button class="whitebutton" type="submit" name="button" id='send__message'>Отправить</button>
    <div class="nicemsg"><?= $_SESSION['nicemsg'] ?></div>
    <a href="ggmain.php">Вернуться на главную</a>
    </div>
  </form>
</div>

<?php
include_once 'ggbottom.php';
?>
<script src="js/ggfeedback.js"></script>
</body>
</html>
