<?php
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (password_verify($token,$hashedtoken)) {
      header('Location: ggcalcconfinedauth.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Расчет понижения в напорном пласте</title>
  <meta name="description" content="Онлайн расчет понижения в скважине при откачке из напорного пласта.">
  <link rel="stylesheet" href="css/gg.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheader.php';
?>
    <!-- Делаем подсказочник -->
          <div class="questionclick">?</div>
          <div class="questionanswer">
            <div class="answercontent">
              <p>Т - водопроводимость, является произведением
                коэффициента фильтрации (kф, м/сут) и мощности
                пласта (m, м), ед. изм. м<sup>2</sup>/сут;</p>
            </div>
            <div class="answercontent">
              <p>a - равняется T/s, где s - упругая водоотдача, ед. изм. м<sup>2</sup>/сут;</p>
            </div>
            <div class="answercontent">
              <p>Q - дебит, расход скважины, ед. изм. м<sup>3</sup>/сут;</p>
            </div>
            <div class="answercontent">
              <p>r - радиус скважины, ед. изм. м;</p>
            </div>
            <div class="answercontent">
              <p>R - расстояние до соседней скважины, ед. изм. м.</p>
            </div>
            <a href="ggtheory.php">Подробнее</a>
          </div>
    <!-- Сделали подсказочник -->
<div class="main">
<form class="" action="php/createreport.php" method="post" target="_blank">
  <div class="container__one">
    <br>
    <h2 class="title__two">Расчет понижения в скважине, напорный пласт</h2>
    <div class="divcenter fuckinglink"><a href="ggcalcunconfined.php">Рассчитать в безнапорном</a></div>
    <br>
      <div class="container__calc">
        <div class="divcenter">
          <h3>Параметры пласта</h3>
        </div>
        <div class="divleft">
          <input type="text" name='trans' class='in'> <span> Водопроводимость (Т, м<sup>2</sup>/сут)</span> <br>
          <input type="text" name='pezo' class='in'> <span> Пьезопроводность (a, м<sup>2</sup>/сут)</span> <br>
        </div>
        <div class="divcenter">
          <h3>Параметры скважины</h3>
        </div>
        <div class="divleft">
          <input type="text" name='debit' class='in'> <span> Дебит (Q, м<sup>3</sup>/сут)</span> <br>
          <input type="text" name='radius' class='in'> <span> Радиус скважины (r, м)</span> <br>
          <input type="text" name='time' class='in'> <span> Время откачки (t, сут)</span> <br>
        </div>
        <div class="divcenter">
          <button type="button" name="buttonone" class="blackbutton"  id='buttonone'>Вычислить</button>
            <div class="answer">
              <p>Понижение составит:</p>
              <p id='resultone'>________________</p>
            </div>
        </div>
        <div class="divleft">
          <div class="container__two">
          <input type="checkbox" name="samewell" id='checkingsamewell' onchange="fun1()">
            <p>Рассчитать понижение с влиянием от соседних скважин</p>
          </div>
        </div>
        <div class="divcenter">
          <div id="samewellblock">
            <div class="container__two">
                  <span>Выберите количество соседних скважин:</span>
                  <select id='selectquan' name = 'numberwell' size='1'>
                    <option selected>1</option>
                    <option>2</option>
                    <option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>
                    </select>
            </div>
          <div class="divcenter">
            <p>Параметры соседних скважин</p>
            <table>
              <tbody>
                <tr class='tablerow'>
                  <td>№</td>
                  <td class = 'tablehead'>Q</td>
                  <td class = 'tablehead'>R</td>
                </tr>
                <tr class='tablerow'>
                  <td>1</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>2</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>3</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>4</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>5</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>6</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>7</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>8</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>9</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>10</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>11</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>12</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>13</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>14</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
                <tr class='tablerow'>
                  <td>15</td>
                  <td><input name="datasamewell[]" class="intable"></td>
                  <td><input name="datasamewell[]" class="intable"></td>
                </tr>
              </tbody>
            </table>


            <button class="blackbutton" type="button" id='button2'>Вычислить</button>
            <div class="answer">
              <p>Понижение с влиянием соседних скважин составит:</p>
              <p id='resulttwo'>________________</p>
            </div>
            <br>
            <button id='report' class="blackbutton" type="button" name="button">Сформировать отчет</button>
            <p id='reporterror'> </p>
          </div>
          </div>
        </div>
        </div>
      </div>

</form>
</div>




<?php
include_once 'ggbottom.php';
?>
<script src="js/ggopensamewell.js"></script>
<script src="js/ggcalculateconfined.js"></script>
</body>
</html>
