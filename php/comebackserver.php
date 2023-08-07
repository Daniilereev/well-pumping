<?php
session_start();
require_once 'dbconnect.php';
$errmsg ='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
  $result = $connect->query("SELECT * FROM `userstable` WHERE `email` = '$email'");
  $user = $result->fetch_assoc();
  $count = count($user ?? []);
  if ($count > 0) {
    $sendpass = rand(100000, 999999);
    $_SESSION['passmail'] = password_hash($sendpass, PASSWORD_DEFAULT);
    $_SESSION['user'] = $email;
    $headers = 'From: info@well-pumping.ru' . "\r\n" . // Адрес отправителя
         'Reply-To: info@well-pumping.ru' . "\r\n" . // Адрес для ответа
    mail($email,'Сброс пароля',$sendpass);
    $_SESSION['errormsg3'] = '';
    header('Location: ../ggvalidatecomeback.php');
  } else {
    $_SESSION['errormsg3'] ='Email не зарегестрирован';
  }
}


 ?>
