<?php
    session_start();
    $_SESSION['quanmail'] = 0;
    require_once 'php/dbconnect.php'; //$connect
    $errmsg = '';
    $token = 1488;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    // $passcash = md5($pass."d6as78d6a78");

    if($email == '' || $pass == '') {
      $errmsg = '<span class="error">Введите логин/пароль</span><br>';
      // header('Location: ../login.php');
    } else {
      $result = $connect->query("SELECT * FROM `userstable` WHERE `email` = '$email'");
      if ($result === false) {
    // Вывести сообщение об ошибке
    die('Ошибка выполнения запроса: ' . $connect->error);  }
      $user = $result->fetch_assoc();
      $count = count($user ?? []);
      if ($count == 0) {
        $errmsg = '<span class="error">Email не зарегестрирован</span><br>';
      } else {
        $result = $connect -> query("SELECT `pass`  FROM `userstable` WHERE `email` = '$email' ");
        $row = $result -> fetch_assoc();
        $hashedpass = $row['pass'];
        if (password_verify($pass, $hashedpass)) {
          $token = rand(1000000, 9999999);
          $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
          $result = $connect -> query("SELECT `id`  FROM `userstable` WHERE `email` = '$email' ");
          $row = $result -> fetch_assoc();
          $userid = $row['id'];
          $connect -> query("UPDATE `userstable` SET `token` = '$token' WHERE `id` = '$userid' ");
          setcookie('id', $userid, time() + 3600*24, "/");
          setcookie('token', $hashedtoken, time() + 3600*24, "/");
          // setcookie('email', $user['email'], time() + 3600*24, "/");
          header('Location: ggmain.php');
        } else {
          $errmsg = '<span class="error">Неверный пароль</span><br>';
        }
      }
    }
  }
?>
