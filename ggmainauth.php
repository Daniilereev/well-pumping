<?php
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (!password_verify($token,$hashedtoken)) {
      header('Location: ggmain.php');
    }
  } else {
    header('Location: ggmain.php');
  }//проверка на авторизацию
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Главная</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheaderauth.php';
?>
<div class="main">
  <div class="container__one">
    <br>
    <h1 class='title__one'>Главная</h1>
    <br>
    <div class="forlinkinheader">
      <a href="ggcalcconfined.php"><h2 class="title__two">Расчет понижений</h2></a>
    </div>
    <br>
      <div class="container__two">
        <p>На данном сайте вы можете рассчитать понижение в скважине как в напорном, так и в безнапорном пласте.
          Расчеты проводятся по классическому решению Тейса-Джейкоба для напорного пласта ("формула Тейса") и решению
          Тейса для безнапорного пласта. В обоих случаях решения для неизолированного в плане пласта с совершенной
          по вскрытию скважиной.
        </p>
        <div class="picture">
          <img src="img/one.png" alt="">
        </div>
      </div>
      <br>
      <div class="forlinkinheader">
      <a href="ggunits.php"><h2 class="title__two">Перевод единиц измерений</h2></a>
      </div>
      <br>
      <div class="container__two">
        <div class="picture">
          <img src="img/two.png" alt="">
        </div>
        <p>Для перевода единиц измерений вы можете воспользоваться соответствующей функцией данного сайта.
           В гидрогеологии чаще всего используются объемные (л, мл, м<sup>3</sup> ..), "площадные"(м<sup>2</sup>..) либо линейные
           (м, см..) единицы измерения в сочетании с временными интервалами в знаменателе
           (сут, ч, сек). Для трех основных типов есть конвертеры.
        </p>
      </div>
      <br>
      <div class="forlinkinheader">
      <a href="ggpump.php"><h2 class="title__two">Обработка откачек</h2></a>
      </div>
      <br>
      <div class="container__two">
        <p>Если хотите освежить теоретическую часть основных методов обработки откачек, то и для этого
          есть соотвествующий раздел. Там рассматривается только один наидоступнейший метод — метод аппроксимации прямой.
        </p>
        <div class="picture">
          <img src="img/three.png" alt="">
        </div>
      </div>
      <br>
      <div class="forlinkinheader">
      <a href="ggtheory.php"><h2 class="title__two">Теория</h2></a>
      </div>
      <br>
      <div class="container__two">
        <div class="picture">
          <img src="img/four.png" alt="">
        </div>
        <p>В теоретическом разделе находятся базовые знания, которые я посчитал важными, и которые мне часто
          пригождались/пригождаются на практике. Это скорее моя записная книжка, чем то, где можно найти ответ на большинство ваших вопросов..
        </p>
      </div>
  </div>
</div>
<?php
include_once 'ggbottom.php';
?>
</body>
</html>
