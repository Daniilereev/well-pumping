<?php
  session_start();
  require_once 'dbconnect.php'; //$connect
  $_SESSION['errormsg'] ='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
  $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
  $passcheck = filter_var(trim($_POST['passcheck']),FILTER_SANITIZE_STRING);
  if (strlen((string)$pass) < 6) {
    $_SESSION['errormsg'] = 'Слишком короткий пароль';
    header('Location: ../ggregistration.php');
  } else {
    if ($pass == $passcheck) {
      $pass = password_hash($pass, PASSWORD_DEFAULT);
      $result = $connect->query("SELECT * FROM `userstable` WHERE `email` = '$email'");
      $user = $result->fetch_assoc();
      $count = count($user ?? []);
      if ($count > 0) {
        $_SESSION['errormsg'] = 'Email уже зарегистрирован';
        header('Location: ../ggregistration.php');
      } else {
        $_SESSION['passmail'] = rand(100000, 999999);
        $_SESSION['user'] = $email;
        $_SESSION['pass'] = $pass;
        $headers = 'From: info@well-pumping.ru' . "\r\n" . // Адрес отправителя
             'Reply-To: info@well-pumping.ru' . "\r\n" . // Адрес для ответа
        mail($email,'Registration',$_SESSION['passmail']);
        $_SESSION['errormsg']='';
        header('Location: ../ggvalidateregistration.php');
        // ТАК БЫЛО, просто добавляли в базу, делали куки и переадресовывали на главную
        // $connect->query("INSERT INTO `userstable` (`email`, `pass`) VALUES ('$email', '$pass')");
        // $connect->close();
        // setcookie('email', $user['email'], time() + 3600*24, "/");
        // header('Location: ggmain.php');
        exit();}
    } else {
      $_SESSION['errormsg'] = 'Пароли не совпадают';
      header('Location: ../ggregistration.php');
    }
  }
  $connect->close();
}

 ?>
