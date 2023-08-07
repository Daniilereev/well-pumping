<?php
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (password_verify($token,$hashedtoken)) {
      header('Location: ggfeedbackauth.php');
    }
  }
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Обратная связь</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="icon" type="image/x-icon" href="img/icon.ico">
</head>
<body>
<?php
include_once 'ggheader.php';
?>
<div class="main">
  <form class="" action="ggregistration.php" method="post">
    <div class="container__feedback">
    <h2 class="title__two">Обратная связь</h2>
    <br>
    <textarea class='letter' name="message" rows="8" cols="80" placeholder="" disabled></textarea> <br>
    <button class="whitebutton" type="submit" name="button" disabled>Отправить</button>
    <div class="errmsg">Авторизуйтесь для отправки сообщения</div><br>
        <a href="gglogin.php">Авторизация</a>
    <a href="ggmain.php">Вернуться на главную</a>
    </div>
  </form>
</div>

<?php
include_once 'ggbottom.php';
?>

</body>
</html>
