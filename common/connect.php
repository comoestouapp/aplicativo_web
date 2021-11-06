<?php

$mysqli = new mysqli("localhost","user","password","comoesto_db");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Falha ao conectar ao MySQL: " . $mysqli -> connect_error;
  exit();
}

?>