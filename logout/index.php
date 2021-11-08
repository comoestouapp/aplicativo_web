<?php
session_start();
$_SESSION["wid"] = null;
$_SESSION["mysecretsession"] = null;
session_unset(); 
session_destroy();
header('Location: https://comoestou.app.br/');
?>