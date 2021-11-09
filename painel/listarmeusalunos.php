<?php
//error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$wid="";
$Nome_Aluno="";
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

$mysalaid = filter_input(INPUT_POST, 'mysalaid', FILTER_SANITIZE_NUMBER_INT);
$mysalaid = substr($mysalaid, 0, 11);
if(!$mysalaid) { echo "noid"; exit(); }
//-------------------------------------------------------------------------
//LISTAR ALUNOS
$queryListar = "SELECT
id, nome
FROM
alunos
where professor_id='$wid' and sala_id='$mysalaid' order by nome ASC";

$mycolor="#efefef";

if ($resultListar = $mysqli->query($queryListar)) {

	while ($rowListar = $resultListar->fetch_assoc()) {
    $id_de_Aluno  	=	$rowListar["id"];
    $Nome_Aluno  	=	$rowListar["nome"];

echo "<div class='d-flex' style='background-color: $mycolor'>
<div class='mr-auto p-2'><i class=\"fas fa-caret-right\"></i>&nbsp;$Nome_Aluno</div>
<!-- <div class='p-2'><button type='button' class='btn btn-info' value='$id_de_Aluno' id='btAlunoListEdit'><i class='fas fa-edit myicon'></i>Editar</button></div> -->
<div class='p-2'><button type='button' class='btn btn-danger'  value='$id_de_Aluno' id='btAlunoListDelete'><i class='far fa-trash-alt myicon'></i>Excluir</button></div>
</div>";

if($mycolor=="#efefef") {$mycolor="#FFF";} else {$mycolor="#efefef";}

}}

if(!$Nome_Aluno) { echo "<p>Sem alunos cadastrados nesta sala.</p>"; exit();}

?>