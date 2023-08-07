<?php
setcookie('id', '', time() - 3600*24, "/");
setcookie('token', '', time() - 3600*24, "/");
setcookie('email', '', time() - 3600*24, "/");
header('Location: ../ggmain.php');
 ?>
