<?php
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$wlogin_error="";
$wlogin_id="";

//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------

//--------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************
$worigem = "TokenVerify";

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
//------------------------------------------
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if(!$email) {
    echo "no data";
    exit();
}
//------------------------------------------
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_NUMBER_INT);

$token = substr($token, 0, 6);
if(!$token) {
    //echo "no token";
    exit();
}

$checknumber = is_numeric($token);
if(!$checknumber) {
    //echo "not numbers";
    exit();
}

$checksize = strlen($token);
if($checksize < 6) {
    //echo "tamanho menor que 6";
    exit();
}

$max_tentativas = 5;

//VERIFICA SE O EMAIL ESTÁ BLOQUEADO
$queryLogin = "SELECT
login_error, nome, id
FROM
professores
where email='$email'";


if ($resultLogin = $mysqli->query($queryLogin)) {

	while ($rowLogin = $resultLogin->fetch_assoc()) {
    $wlogin_error	=	$rowLogin["login_error"];
    $wlogin_nome	=	$rowLogin["nome"];
    $wlogin_id  	=	$rowLogin["id"];
		
if($wlogin_error == $max_tentativas) { echo "blocked"; exit();}

$wlogin_error++;

}}
//-----------------------------------------------------------

if(!$wlogin_id) {echo "nao cad"; exit();}

// CHECANDO CREDENCIAIS
$query = "SELECT
id, nome
FROM
professores
where email='$email' and token=$token";

$contador = 0;
if ($result = $mysqli->query($query)) {

	while ($row = $result->fetch_assoc()) {
    $wid	=	$row["id"];
    $wNome 	=	$rowLogin["nome"];
		
if($wid) { $contador++; }


}}

if($contador == 1) {

//INICIA SESSAO COM ID E SECRET

session_start();

$_SESSION["wid"] = $wid;

$_SESSION["wNome"] = $wNome;

$mysecretsession = null;

$_SESSION["mysecretsession"] = $mysecretsession;

$mysecretsession = random_str(256);

$_SESSION["mysecretsession"] = $mysecretsession;



$mysqli -> query("UPDATE professores SET login_error = '0' where email='$email'");

$mysqli -> query("UPDATE professores SET secret = '$mysecretsession' where email='$email'");

$mysqli -> query("UPDATE professores SET data = '$datahoje' where email='$email'");

$mysqli -> query("UPDATE professores SET hora = '$horanow' where email='$email'");

//INSERE NOS LOGS
$mysqli -> query("INSERT INTO logs (origem, usuario_id, usuario, senha, ip, data, hora, result)
VALUES ('$worigem', '$wlogin_id', '$wlogin_nome', '********', '$clientIP', '$datahoje', '$horanow', 'sucesso')");

$mysqli -> query("UPDATE professores SET token = '', tokentime = ''  where email='$email'");

echo "success";


} else {


$mysqli -> query("UPDATE professores SET login_error = '$wlogin_error' where email='$email'");

//INSERE NOS LOGS
if($wlogin_id && $wlogin_nome) {
$senha="";
$mysqli -> query("INSERT INTO logs (origem, usuario_id, usuario, senha, ip, data, hora, result)
VALUES ('$worigem', '$wlogin_id', '$wlogin_nome', '$senha', '$clientIP', '$datahoje', '$horanow', 'erro')");

} else {
    $senha="";
    $mysqli -> query("INSERT INTO logs (origem, usuario_id, usuario, senha, ip, data, hora, result)
    VALUES ('$worigem', '0', '$email', '$senha', '$clientIP', '$datahoje', '$horanow', 'erro')");

}


echo "error: $wlogin_error"; exit();



}


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