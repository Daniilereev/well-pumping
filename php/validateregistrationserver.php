<?php
session_start();
require_once 'dbconnect.php'; //$connect
$errmsg ='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $passmailcheck = filter_var(trim($_POST['passmailcheck']),FILTER_SANITIZE_STRING);
  if ($passmailcheck == $_SESSION['passmail']){
    $token = rand(1000000, 9999999);
    $email = $_SESSION['user'];
    $connect->query("INSERT INTO `userstable` (`email`, `pass`, `token`) VALUES ('{$_SESSION['user']}', '{$_SESSION['pass']}', '$token')");
    $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
      $result = $connect -> query("SELECT `id`  FROM `userstable` WHERE `email` = '$email' ");
      $row = $result -> fetch_assoc();
      $userid = $row['id'];
    $connect->close();
    setcookie('id', $userid, time() + 3600*24, "/");
    setcookie('token', $hashedtoken, time() + 3600*24, "/");
    //setcookie('email', $user['email'], time() + 3600*24, "/");
    $_SESSION['errormsg2']='';
    header('Location: ../ggmainauth.php');
  } else {
    $_SESSION['errormsg2'] ='Код неверный, либо устарел';
    header('Location: ../ggvalidateregistration.php');
  }
}
 ?>
