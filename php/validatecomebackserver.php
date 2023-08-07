<?php
session_start();
require_once 'dbconnect.php'; //$connect
$errmsg ='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $passcomeback = filter_var(trim($_POST['passcomeback']),FILTER_SANITIZE_STRING);
  $newpass = filter_var(trim($_POST['newpass']));
  $newpasscheck = filter_var(trim($_POST['newpasscheck']));
  $email = $_SESSION['user'];
  $token = rand(1000000, 9999999);
  if (password_verify($passcomeback, $_SESSION['passmail'])){
    if ($newpass == $newpasscheck) {
          $result = $connect -> query("SELECT `id`  FROM `userstable` WHERE `email` = '$email' ");
          $row = $result -> fetch_assoc();
          $userid = $row['id'];
      $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);
      $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
      $connect->query("UPDATE `userstable` SET `token` = '$token'  WHERE `id` = '$userid' ");
      $connect->query("UPDATE `userstable` SET `pass` = '$hashedpass'  WHERE `id` = '$userid' ");
      $connect->close();
      setcookie('id', $userid, time() + 3600*24, "/");
      setcookie('token', $hashedtoken, time() + 3600*24, "/");
      // setcookie('email', $user['email'], time() + 3600*24, "/");
      $_SESSION['errormsg4'] ='';
      header('Location: ../ggmainauth.php');
    } else {
      $_SESSION['errormsg4'] ='Пароли не совпадают';
      header('Location: ../ggvalidatecomeback.php');
    }
  } else {
    $_SESSION['errormsg4'] ='Код неверный, либо устарел';
    header('Location: ../ggvalidatecomeback.php');
  }
}
 ?>
