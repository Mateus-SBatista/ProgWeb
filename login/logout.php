<?php
session_start();
session_unset();
session_destroy();

setcookie('email', '', time()-60, '/');
setcookie('senha', '', time()-60, '/');

header("login.php");
exit();
?>