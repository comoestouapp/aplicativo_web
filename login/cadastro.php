<?php
//error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$wid="";

//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------

//--------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************
$worigem = "Cadastro";

//######################################################################################################################
//PEGAR IP DO CLIENTE
$clientIP = $_SERVER['HTTP_CLIENT_IP'] 
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # quando tiver protegido pelo cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED'] 
    ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
    ?? $_SERVER['HTTP_FORWARDED'] 
    ?? $_SERVER['HTTP_FORWARDED_FOR'] 
    ?? $_SERVER['REMOTE_ADDR'] 
    ?? '0.0.0.0';

# Antes do PHP7
$clientIP = '0.0.0.0';

if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $clientIP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    # quando tiver protegido pelo cloudflare
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; 
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
    $clientIP = $_SERVER['HTTP_X_FORWARDED'];
} elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
    $clientIP = $_SERVER['HTTP_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_FORWARDED'])) {
    $clientIP = $_SERVER['HTTP_FORWARDED'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $clientIP = $_SERVER['REMOTE_ADDR'];
}
//######################################################################################################################

$cadnome = filter_input(INPUT_POST, 'cadnome', FILTER_SANITIZE_MAGIC_QUOTES);

$cademail = filter_input(INPUT_POST, 'cademail', FILTER_SANITIZE_EMAIL);

$cadpassword = filter_input(INPUT_POST, 'cadpassword', FILTER_SANITIZE_MAGIC_QUOTES);

if(!$cadnome or !$cademail or !$cadpassword ) { echo "empty"; exit(); }

//VERIFICA SE O EMAIL JÁ ESTÁ CADASTRADO
$queryLogin = "SELECT
id
FROM
professores
where email='$cademail'";


if ($resultLogin = $mysqli->query($queryLogin)) {

	while ($rowLogin = $resultLogin->fetch_assoc()) {
    $wlogin_id  	=	$rowLogin["id"];
		
if($wlogin_id) { echo "exists"; exit();}

}}
//-----------------------------------------------------------


// EFETUANDO O CADASTRO
$mysqli -> query("INSERT INTO professores (nome, email, senha)
VALUES ('$cadnome', '$cademail', PASSWORD('$cadpassword'))");


//SOLICITA OS DADOS DE CADASTRADO
$queryLogin = "SELECT
id, nome
FROM
professores
where email='$cademail'";


if ($resultLogin = $mysqli->query($queryLogin)) {

	while ($rowLogin = $resultLogin->fetch_assoc()) {
    $wid  	=	$rowLogin["id"];
    $wNome 	=	$rowLogin["nome"];
		
}}
//-----------------------------------------------------------


//INICIA SESSAO COM ID E SECRET

session_start();

$_SESSION["wid"] = $wid;

$_SESSION["wNome"] = $wNome;

$mysecretsession = null;

$_SESSION["mysecretsession"] = $mysecretsession;

$mysecretsession = random_str(256);

$_SESSION["mysecretsession"] = $mysecretsession;

$mysqli -> query("UPDATE professores SET login_error = '0' where email='$cademail'");

$mysqli -> query("UPDATE professores SET secret = '$mysecretsession' where email='$cademail'");

$mysqli -> query("UPDATE professores SET data = '$datahoje' where email='$cademail'");

$mysqli -> query("UPDATE professores SET hora = '$horanow' where email='$cademail'");

//INSERE NOS LOGS
$mysqli -> query("INSERT INTO logs (origem, usuario_id, usuario, senha, ip, data, hora, result)
VALUES ('$worigem', '$wid', '$cadnome', '********', '$clientIP', '$datahoje', '$horanow', 'sucesso')");


echo "success";



######################################################################################################################

function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace deve ter ao menos 2 digitos');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

######################################################################################################################

?>