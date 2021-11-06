<?php
date_default_timezone_set('America/Sao_Paulo');
$max_tentativas = 5;
$mytoken = random_str(6);
$validadetoken = "3600"; // em segundos
$now = time();
$headers="";
$wlogin_id="";

//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------

//------------------------------------------
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_NUMBER_INT);

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if(!$email) {
    //echo "no data";
    exit();
}
//--------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************

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
//CASO O EMAIL NÃO EXISTA, SAIA
if(!$wlogin_id) {exit();}
//-----------------------------------------------------------
//VERIFICA SE O TOKEN EXPIROU
$queryLogin = "SELECT
tokentime, token
FROM
professores
where email='$email'";

if ($resultLogin = $mysqli->query($queryLogin)) {

	while ($rowLogin = $resultLogin->fetch_assoc()) {
    $wlogin_tokentime	=	$rowLogin["tokentime"];
    $wlogin_token	=	$rowLogin["token"];

    if ($wlogin_token and $wlogin_tokentime) {
        $resta_timesec = $now - $wlogin_tokentime;
        if ( $resta_timesec >= $validadetoken ) {
            $mytoken = random_str(6);
            $mysqli -> query("UPDATE professores SET token = '$mytoken', tokentime = '$now' where email='$email'");
            //novo token gerado
            echo "success";
            } else {
            $mytoken = $wlogin_token;
            //token ainda válido
            echo "success";
            }
    } else {
        $mytoken = random_str(6);
        $mysqli -> query("UPDATE professores SET token = '$mytoken', tokentime = '$now' where email='$email'");
        //novo token gerado
        echo "success";
    }

}}

//-----------------------------------------------------------

// Função HTML :)
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html;charset=utf-8\r\n";
$headers .= "From: ComoEstou APP <naoresponda@comoestou.app.br>\r\n";

//      Resposta que vai ao Cliente/Visitante
// =================================================== //

$assunto   = "ComoEstou APP - Token de Acesso";

$html = "<h3>Seu token de acesso é:</h3><h1><b>$mytoken</b></h1><h6><div style='color: #ccc'>*Token válido por 1h.<br>Esta é uma mensagem automática, não responda.</div></h6>";


$success = mail($email, $assunto, $html, $headers,"-fnaoresponda@comoestou.app.br");

if (!$success) {
    $errorMessage = error_get_last()['message'];
} else {
    //Mensagem enviada com sucesso!
}

######################################################################################################################

function random_str(
    $length,
    $keyspace = '0123456789'
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