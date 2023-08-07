<?php
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (!password_verify($token,$hashedtoken)) {
      header('Location: ggunits.php');
    }
  } else {
    header('Location: ggunits.php');
  }//проверка на авторизацию
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Конвертер</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="stylesheet" href="css/units.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheaderauth.php';
?>
<!-- Делаем подсказочник -->
      <div class="questionclick">?</div>
      <div class="questionanswer">
        <div class="answercontent">
          <p>Для перевода единиц измерений можно использовать
          постоянные коэффициенты:</p>
        </div>
        <div class="answercontent">
          <p>л/с * 86,4 => м<sup>3</sup>/сут</p>
        </div>
        <div class="answercontent">
          <p>л/ч * 0,024 => м<sup>3</sup>/сут</p>
        </div>
        <div class="answercontent">
          <p>см/сек * 864 => м/сут</p>
        </div>

      </div>
<!-- Сделали подсказочник -->
<div class="main">
  <div class="container__one">
    <br>
    <h2 class='title__two'>Перевод единиц измерений</h2>
    <br>
    <!-- Третий перевод -->
<div class="container__units">
  <div class="content__units">
    <div class="units__name units__name__header">
      <div class="nominator">length<sup>3</sup>
      </div>
      <div class="stick">
      </div>
      <div class="denominator">time
      </div>
    </div>
  <div class="hint">Q</div>
  </div>
  <br>
  <div class="content__units">
    <div class="calculate__units wrapunits">
      <div class='frame'>
      <input type="" name="" value="" class="units__input iteminput">
      <div class="units__name iteminput">
        <div class="nominator">
          <select class="units__start" name="">
            <option value='1000000000'selected>м&sup3</option>
            <option value='1000'>см&sup3</option>
            <option value='1'>мм&sup3</option>
            <option value='1000000'>л</option>
            <option value='1000'>мл</option>
          </select>
        </div>
        <div class="stick">
        </div>
        <div class="denominator">
          <select class="units__start" name="">
            <option value="86400" selected>сут</option>
            <option value="3600" >ч</option>
            <option value="60" >мин</option>
            <option value="1" >сек</option>
        </select>
        </div>
      </div>
    </div>
    <div class="frame">
      <button value='0' onclick="unitsQ(this.value)" class='transform__units iteminput' type="whitebutton" name="button">Перевести</button>
    </div>
    <div class="frame">
      <input type="" name="" value="" class="units__output iteminput">
      <div class="units__name iteminput">
        <div class="nominator">
          <select class="units__end" name="">
            <option value='1000000000'selected>м&sup3</option>
            <option value='1000'>см&sup3</option>
            <option value='1'>мм&sup3</option>
            <option value='1000000'>л</option>
            <option value='1000'>мл</option>
          </select>
        </div>
        <div class="stick">
        </div>
        <div class="denominator">
          <select class="units__end" name="">
            <option value="86400" selected>сут</option>
            <option value="3600" >ч</option>
            <option value="60" >мин</option>
            <option value="1" >сек</option>
          </select>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="content__units">
    <br>
    <div class="calculate__units units__error">Введите число 
    </div>
  </div>
  <div class="">
  </div>
</div>
        <!-- Второй перевод -->
    <div class="container__units">
      <div class="content__units">
        <div class="units__name units__name__header">
          <div class="nominator">length<sup>2</sup>
          </div>
          <div class="stick">
          </div>
          <div class="denominator">time
          </div>
        </div>
        <div class="hint">T, a</div>
      </div>
      <br>
      <div class="content__units">
        <div class="calculate__units">
          <div class='frame'>
          <input type="" name="" value="" class="units__input">
          <div class="units__name">
            <div class="nominator">
              <select class='units__start' name="">
                <option value='1000000' selected>м&sup2;</option>
                <option value='100'>см&sup2</option>
                <option  value='1'>мм&sup2</option>
              </select>
            </div>
            <div class="stick">
            </div>
            <div class="denominator">
              <select class='units__start' name="">
                <option value="86400" selected>сут</option>
                <option value="3600" >ч</option>
                <option value="60" >мин</option>
                <option value="1" >сек</option>
            </select>
            </div>
          </div>
          </div>
          <div class='frame'>
          <button value='1' onclick="unitsQ(this.value)" class='transform__units' type="whitebutton" name="button">Перевести</button>
          </div>
          <div class='frame'>
          <input type="" name="" value="" class="units__output">
          <div class="units__name">
            <div class="nominator">
              <select class="units__end" name="">
                <option value='1000000' selected>м&sup2;</option>
                <option value='100'>см&sup2</option>
                <option  value='1'>мм&sup2</option>
              </select>
            </div>
            <div class="stick">
            </div>
            <div class="denominator">
              <select class="units__end" name="">
                <option value="86400" selected>сут</option>
                <option value="3600" >ч</option>
                <option value="60" >мин</option>
                <option value="1" >сек</option>
              </select>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="content__units">
        <br>
        <div class="calculate__units units__error">Введите число 
        </div>
      </div>
      <div class="">
      </div>
    </div>
    <!-- Первый перевод -->
    <div class="container__units">
      <div class="content__units">
        <div class="units__name units__name__header">
          <div class="nominator">length</sup>
          </div>
          <div class="stick">
          </div>
          <div class="denominator">time
          </div>
        </div>
        <div class="hint">k<sub>ф</sub></div>
      </div>
      <br>
      <div class="content__units">
        <div class="calculate__units">
          <div class='frame'>
          <input type="" name="" value="" class="units__input">
          <div class="units__name">
            <div class="nominator">
              <select class="units__start" name="">
                <option value='1000' selected>м</option>
                <option value='10'>см</option>
                <option value="1" >мм</option>
              </select>
            </div>
            <div class="stick">
            </div>
            <div class="denominator">
              <select class="units__start" name="">
                <option value="86400" selected>сут</option>
                <option value="3600" >ч</option>
                <option value="60" >мин</option>
                <option value="1" >сек</option>
            </select>
            </div>
          </div>
          </div>
          <div class='frame'>
          <button value='2' onclick="unitsQ(this.value)" class='transform__units' type="whitebutton" name="button">Перевести</button>
          </div>
          <div class='frame'>
          <input type="" name="" value="" class="units__output">
          <div class="units__name">
            <div class="nominator">
              <select class="units__end" name="">
                <option value='1000' selected>м</option>
                <option value='10'>см</option>
                <option value="1">мм</option>
              </select>
            </div>
            <div class="stick">
            </div>
            <div class="denominator">
              <select class="units__end" name="">
                <option value="86400" selected>сут</option>
                <option value="3600" >ч</option>
                <option value="60" >мин</option>
                <option value="1" >сек</option>
              </select>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="content__units">
        <br>
        <div class="calculate__units units__error">Введите число 
        </div>
      </div>
      <div class="">
      </div>
    </div>
  </div>
</div>

<?php
include_once 'ggbottom.php';
?>
<script src="js/ggopensamewell.js"></script>
<script src="js/units.js"></script>
</body>
</html>
