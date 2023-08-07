<?php
session_start();
require_once 'dbconnect.php'; //$connect
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$id = $_COOKIE['id'];
    $result = $connect -> query("SELECT `email`  FROM `userstable` WHERE `id` = '$id' ");
    $row = $result -> fetch_assoc();
$email = $row['email'];
$message = 'From email: ' . $email . PHP_EOL;
$message .= 'Text message: ' . $_POST['message'] . PHP_EOL;
$headers = 'From: info@well-pumping.ru' . "\r\n" . // Адрес отправителя
     'Reply-To: info@well-pumping.ru' . "\r\n" . // Адрес для ответа
mail('daniil.ereev98@gmail.com','well-pumping feedback', $message);
$connect->close();
$_SESSION['nicemsg'] = 'Спасибо, ваше письмо отправлено!';
header('Location: ../ggfeedbackauth.php');
}
 ?>
