<?php
  require_once 'php/dbconnect.php'; //$connect
  if (isset($_COOKIE['id']) && isset($_COOKIE['token'])) {
    $id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `token` FROM `userstable` WHERE `id` = '$id'");
    $row = $result -> fetch_assoc();
    $token = $row['token'];
    $hashedtoken = $_COOKIE['token'];
    if (!password_verify($token,$hashedtoken)) {
      header('Location: ggtheory.php');
    }
  } else {
    header('Location: ggtheory.php');
  }//проверка на авторизацию
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Теория</title>
  <link rel="stylesheet" href="css/gg.css">
  <link rel="stylesheet" href="css/theory.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<?php
include_once 'ggheaderauth.php';
?>
<div class="main">
  <div class="container__main__theory">
    <div class="container__theory">
      <button class="theory__header" value='0' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Основные гг параметры</div>
      </button>
      <div class="theory__text">
        <p><b>k<sub>ф</sub></b> — коэффициент фильтрации, определяется по результатам опытно-фильтрационных опробований, лабораторными методами, либо через свойства жидкости и коэффициент проницаемости. Единицы измерения - м/сут</p>
        <p><b>m </b>(H) — мощность пласта, представляет собой разницу между абсолютными отметками (либо глубинами залегания) кровли и подошвы в случае напорного горизонта, или между отметками подошвы и свободной поверхности подземных вод (зеркала грунтовых вод) в случае безнапорного горизонта</p>
        <p><b>T</b> — проводимость (водопроводимость, коэффициент водопроводимости), одна из основных характеристик фильтрационных свойств горных пород, физически выражает способность площади водоносного горизонта фильтровать воду в единицу времени при напорном градиенте равном единице. Единицы измерения - м<sup>2</sup>/сут. Формула: T=k<sub>ф</sub>∙m</p>
        <p><b>a</b> — пьезопроводность, характеризует скорость распространения изменения давления в пласте. Определяется по результатам опытно-фильтрационных опробований, преимущественно по кустовых откачкам/нагнетаниям. Единицы измерения - м<sup>2</sup>/сут. Формула: a=T/S  </p>
        <p><b>a<sub>y</sub></b> — уровнепроводность, характеризует скорость распространения возмущения в безнапорном пласте, аналог a. Единицы измерения - м<sup>2</sup>/сут. Формула: a<sub>y</sub>=T/S<sub>y</sub></p>
        <p><b>S</b> (μ*) — упругая водоотдача/емкость, обощенный показатель, отвечающий за водоотдачу пласта вследствие упругих деформаций пласта и жидкости под воздействием напора ПВ. Характеризует объем жидкости, получаемой с единицы площади водоносного горизонта при снижении напора на 1м. Безразмерный, д.е. Формула: S=T/a</p>
        <p><b>S<sub>y</sub></b> (μ<sub>в</sub>) — гравитационная водоотдача/емкость, характеризует способность пород отдавать заключенную в них воду путем свободного стекания под действием силы тяжести. Как правило, количественно данный показатель стремится к активной порстости пород (n<sub>a</sub>, д.е.). Безразмерный, д.е. Формула: S<sub>y</sub>=T/a<sub>y</sub></p>
        <p><b>S<sub>s</sub></b> — удельная водоотдача, 1/м: S<sub>s</sub>=S/m,  S<sub>s</sub>=S<sub>y</sub>/H</p>
        <p><b>Q</b> — дебит/расход, объем воды из скважины отбираемый(изливающийся) в единицу времени. Единицы измерения - м<sub>3</sub>/сут, л/с и т.д.</p>
        <p><b>q</b> — удельный дебит, формула: q=Q/S, где S - максимально достигнутое понижение при дебите Q. Характеристика для приблизительной оценки водообильности горизонта, используется в различных методах гидравлической оценки запасов. Можно приблизительно оценить проводимость горизонта: T=1.22∙q - если дебит в м<sup>3</sup>/сут, и T=105∙q если дебит в л/с. Наиболее распространенные единицы измерения - л*сек/м (это пора менять!)</p>
      </div>
      <button class="theory__header" value='1' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Дополнительные гг параметры</div>
      </button>
      <div class="theory__text">
        <!-- <p><b></b> — скорость фильтрации</p>
        <p><b></b> — истинный k<sub>ф</sub></p> -->
        <p><b>B</b> — параметр перетекания, характеризует интенсивность перетекания из смежного пласта (в кровле, либо в подошве) через водоупор с мощностью m' и коэффициентом фильтрации k'. Используется при расчетах понижения в скважине. Чем меньше параметр, тем интенсивнее идет перетекание. Формула: B=√(T∙m'/k'), где Т - проводимость эксплуатируемого пласта. Формула при наличии перетекания через подошву и кровлю B=√(T∙m'm''/(k'm''+k''m')) </p>
        <p><b>ΔL</b> — сопротивление русла реки, обобщенный гидрогеологический параметр ложа водоема, характеризующий его фильтрационное сопротивление. Можно выразать как: ΔL=√(Tm<sub>0</sub>/k<sub>0</sub>)</p>
        <p><b>ε </b>(w) — инфильтрационное питание. Может определяться по результатам режимных наблюдений, данным водного баланса. Приблизительно можно оценить по формуле: ε=0.15∙P/365, где P - сумма атмосферных осадков в год (м), а множитель 0.15 характеризует процент влаги, доходящей непосредственно до ПВ. Обычно значения 0.10-0.20 соотвествуют континентальному климату умеренных широт</p>
        <p><b>Cкин-эффект</b>, обусловлен кольматацией скважины/прискважинной зоны, констркцией фильтра. Схематизируется слабопроницаемым слоем вокруг скважины с заданной толщиной и k<sub>ф</sub>. В опытных скважинах приводит к увеличению понижения, в наблюдательных - к замедлению реакции уровня</p>
        <p><b>R</b> — радиус влияния, дает оценку расстояния от скважины, на которое распространяется возмущение из-за откачки/нагнетания. Формула: R≈1.5√(a∙t). <br>Вышеприведенная формула соответствует классическому радиусу влияния, который чаще всего используется на практике. Истинный же радиус влияния вычисляется по формуле R≈3.5√(at). Обе формулы могут использоваться и для безнапорного пласта при замене a на a<sub>y</sub> </p>
        <p><b>I</b> — градиент напора. Соотношение потери напора к длине пути фильтрации: I=(H<sub>1</sub>-H<sub>2</sub>)/L</p>
        <!-- <p><b></b> — </p> -->
      </div>
      <!-- <button class="theory__header" value='2' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Вычисление понижения</div>
      </button>
      <div class="theory__text">
        <p>Хуй</p>
        <p>Пизда</p>
      </div> ЦЕ ПРИМЕР -->
      <button class="theory__header" value='2' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Вычисление понижения</div>
      </button>
      <div class="theory__text">
        <p><b>Условные обозначения:</b> Q — дебит (м<sup>3</sup>/сут), Т — водопроводимость (м<sup>2</sup>/сут), а — пьезопроводность (м<sup>2</sup>/сут), r — радиус скважины, либо расстояние от наблюдательной скважины до опытной (м), t — время откачки (сут), H — мощность безнапорного пласта (м), B — параметр перетекания.</p>
        <p>●  Понижение в напорном пласте: <br> <img src="img/theory1.png" alt=""> при условии, что: <br> <img src="img/theory2.png" alt=""> </p>
        <p>●  Понижение в безнапорном пласте: <br> <img src="img/theory3.png"></p>
        <p>●  Максимальное понижение в пласте с перетеканием для опытной скважины: <br> <img src="img/theory4.png"> Время наступления стационара (максимального понижения):<br> <img src="img/theory5.png"></p>
        <p>●  Понижение при работе нескольких скважин <br>
          Понижение в любой точке пласта рассчитывается весьма просто. Допустим, у нас есть две опытные скважины — №1э и №2э (их дебиты Q1 и Q2 соответственно), и одна наблюдательная — №3н.
          Расстояние от 1э до 3н равняется R1, от 2э до 3н — R2. По формуле, которая соотвествует
          нашим условиям откачки (напорный пласт, безнапорный и т.д.), вычисляем понижение S1 от работы 1э,
          подставляя в формулу значения R1 и Q1, и S2, подставляя R2 и Q2. Сумма S1 и S2 будет понижением
          в наблюдательной скважине 3н. А если бы и из нее откачивали воду с дебитом Q3, то к S1 и S2 прибавилось бы еще
          понижение S3 от собственной работы скважины, для этого в формулу подставляются значения Q3 и r — радиус скв. 3н.
          <br> <img src="img/theory7.png">
        </p>
        <p>●  Понижение в полуограниченном пласте <br>
            Понижение в полуограниченном пласте вычисляется относительно несложно: при расчетах необходимо добавить
             дополнительные "виртуальные/фиктивные" скважины, которые находятся на другой стороне границы
            на таком же расстоянии как и ваши опытные скважины. На рисунке ниже представлен пример схематизации
            откачки из одной скважины вблизи границы, присутствует одна наблюдательная скважина. Фиктивную
            скважину необхожимо расположить напротив нашей на расстоянии L<sub>w</sub> и
            задать ей такой же дебит. В зависимости от типа границы — I род или II, то есть граница с
            постоянным напором (река, озеро, море), или непроницаемая граница, знак у дебита изменяется:
            для границы первого рода дебит будет отрицательным (фиктивная скважина схематизируется как нагнетательная),
            для границы второго — положительный. После этого вычисляете в опытной скважине, наблюдательной,
            либо любой другой точке пласта понижение с учетом наличия фиктивных скважин по принципу групповой откачки.
            <br> <img src="img/theory6.png"></p>
      </div>
      <button class="theory__header" value='3' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Видеоуроки</div>
      </button>
      <div class="theory__text">
        <p class="video__title">Влияние г/г параметров на депрессионную воронку</p>
        <div class="video">
          <iframe class="iframe" src="https://www.youtube.com/embed/UG0Q1azBuWk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <p class="video__title">Привязка топоосновы</p>
        <div class="video">
          <iframe class="iframe" src="https://www.youtube.com/embed/IMugvCV96yg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
      <button class="theory__header" value='4' onclick="opentheory(this.value)">
        <div class="theory__button"> ▼ </div>
        <div class="theory__header__name"> Полезные ссылки</div>
      </button>
      <div class="theory__text">
        <p> <a href="https://ansdimat.com/ru/param.shtml">• Основные фильтрационные параметры пласта</a> <br>
            <a href="https://ansdimat.com/ru/parabase.shtml">• Справочные фильтрационные параметры</a> <br>
            <a href="https://zso.ansdimat.com/">• Все о зонах санитарной охраны (ЗСО)</a> <br> <br>
            Основные книги, которые я использовал, вы можете найти на<a href="https://www.geokniga.org/books"><u>этом</u></a>сайте. Список книг: <br>
            - Синдаловский Л.Н. Гидрогеологические расчеты с использованием программы ANSDIMAT, 2021 <br>
            - Синдаловский Л.Н. Справочник аналитических решений для интерпретации опытно-фильтрационных опробований, 2006 <br>
            - Боревский Б.В., Самсонов Б.Г., Язвин Л.С. Методика определения параметров водоносных горизонтов по данным откачек, 1979<br>
            - Шестаков В.М. Гидрогеодинамика, 1995 <br>
            - Справочное руководство гидрогеолога, 1979 <br><br>
            Рекомендую обратить внимание на ПО ANSDIMAT и базу знаний вокруг этого программного комплекса. <a href="https://ansdimat.com/ru/ansdimat.shtml">ansdimat.com</a>
        </p>
      </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once 'ggbottom.php';
?>
<script src="js/theory.js"></script>
</body>
</html>