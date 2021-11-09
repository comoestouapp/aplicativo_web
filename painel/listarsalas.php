<?php
//error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$wid="";
$Sala_de_Aula="";
//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//-------------------------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************

//CHECAR SE ESTÁ LOGADO
session_start();
$wid = $_SESSION["wid"];
$mysecretsession = $_SESSION["mysecretsession"];
if(!$wid) { echo "session"; exit(); }
//-------------------------------------------------------------------------

//LISTAR SALAS DE AULAS
$queryListar = "SELECT
id, nome
FROM
salas
where professor_id='$wid' order by nome ASC";

$mycolor="#efefef";

if ($resultListar = $mysqli->query($queryListar)) {

	while ($rowListar = $resultListar->fetch_assoc()) {
    $id_de_Aula  	=	$rowListar["id"];
    $Sala_de_Aula  	=	$rowListar["nome"];

echo "<div class='d-flex' style='background-color: $mycolor'>
<div class='mr-auto p-2'><i class=\"fas fa-caret-right\"></i>&nbsp;$Sala_de_Aula</div>
<!-- <div class='p-2'><button type='button' class='btn btn-info' value='$id_de_Aula' id='btSalaAulaEdit'><i class='fas fa-edit myicon'></i>Editar</button></div> -->
<div class='p-2'><button type='button' class='btn btn-danger'  value='$id_de_Aula' id='btSalaAulaDelete'><i class='far fa-trash-alt myicon'></i>Excluir</button></div>
</div>";

if($mycolor=="#efefef") {$mycolor="#FFF";} else {$mycolor="#efefef";}

}}

if(!$Sala_de_Aula) { echo "<p>Sem salas cadastradas</p>"; exit();}

?>