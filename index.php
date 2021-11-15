<?php
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$ip_correto = "";
$referrer = "";
$useragent = "";
//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------

//--------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( 'common/connect.php' );
//***************************************

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
//=====================================================
require_once "common/Mobile_Detect.php";
$detect = new Mobile_Detect;
$meu_device="Computador";
$meu_sistema="Desconhecido";

// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
$meu_device="Celular";
}
 
// Any tablet device.
if( $detect->isTablet() ){
$meu_device="Computador";
}

// Check for a specific platform with the help of the magic methods:
if( $detect->isiOS() ){
$meu_sistema="iOS";
}
 
if( $detect->isAndroidOS() ){
$meu_sistema="Android";
}
//=====================================================
$ip_correto = $clientIP;

if(isset($_SERVER['HTTP_REFERER'])) {
  $referrer = $_SERVER['HTTP_REFERER'];  
   }
else
{
  $referrer = "acesso direto";
}

$useragent = $_SERVER['HTTP_USER_AGENT'];

//===============================================================
// desktop: Windows, Linux, Mac, Nuzzel, Twitterbot, WhatsApp, datagnionbot, facebookexternalhit, dataminr, Googlebot, PaperLiBot, TrendsmapResolver
if($meu_device=="Computador") {

    if (strpos($useragent,'Windows') !== false) {
    $meu_sistema="Windows";
    }
    if (strpos($useragent,'Linux') !== false) {
    $meu_sistema="Linux";
    }
    if (strpos($useragent,'Mac') !== false) {
    $meu_sistema="Mac OSX";
    }
    if (strpos($useragent,'Nuzzel') !== false) {
    $meu_sistema="Nuzzel";
    }
    if (strpos($useragent,'Twitterbot') !== false) {
    $meu_sistema="Twitterbot";
    }
    if (strpos($useragent,'WhatsApp') !== false) {
    $meu_sistema="WhatsApp";
    }
    if (strpos($useragent,'DatagnionBot') !== false) {
    $meu_sistema="Datagnionbot";
    }
    if (strpos($useragent,'facebookexternalhit') !== false) {
    $meu_sistema="FacebookExternalHit";
    }
    if (strpos($useragent,'dataminr') !== false) {
    $meu_sistema="Dataminr";
    }
    if (strpos($useragent,'Googlebot') !== false) {
    $meu_sistema="Googlebot";
    }
    if (strpos($useragent,'AdsBot-Google') !== false) {
    $meu_sistema="Googlebot";
    }
    if (strpos($useragent,'PaperLiBot') !== false) {
    $meu_sistema="PaperLiBot";
    }
    if (strpos($useragent,'TrendsmapResolver') !== false) {
    $meu_sistema="TrendsmapResolver";
    }
    if (strpos($useragent,'AhrefsBot') !== false) {
    $meu_sistema="AhrefsBot";
    }

//incluir comando para desktop
$mycss = "desktop.css";

}

//===============================================================
// mobile
if($meu_device=="Celular") {

    if (strpos($useragent,'Windows Phone') !== false) {
    $meu_sistema="Windows Phone";
    }
	
//incluir comando para mobile
$mycss = "mobile.css";

}

//===============================================================
//INSERIR DADOS NO DB

$mysqli -> query("INSERT INTO visitors
( ip, dispositivo, os, navegador, url_origem, data, hora )
VALUES
( \"$ip_correto\", \"$meu_device\",\"$meu_sistema\", \"$useragent\", \"$referrer\", \"$datahoje\", \"$horanow\" )");

//=====================================================
//######################################################################################################################


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- ################################################################# !-->
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<!-- ################################################################# !-->
<meta name="viewport" content="user-scalable=no">
<!-- ################################################################# !-->
<link rel="icon" href="https://comoestou.app.br/favicon.svg" sizes="any" type="image/svg+xml">
<meta name="geo.country" content="BR">
<meta name="description" content="Aplicativo web para o acompanhamento emocional do aluno.">
<meta name="author" content="Daniel Villela">
<!-- ################################################################# !-->
<meta property="og:site_name" content="ComoEstou APP">
<meta property="og:type" content="website">
<meta property="og:title" content="ComoEstou APP">
<meta property="og:description" content="">
<meta property="og:image" content="http://comoestou.app.br/ogimage.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:secure_url" content="https://www.comoestou.app.br/ogimage.jpg">
<meta property="og:url" content="https://comoestou.app.br/">
<!-- ################################################################# !-->
  <title>.: ComoEstou APP :.</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700;800;900&display=swap">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="./login/<?php echo $mycss; ?>">
<style>
  body {
  background: #074791;
  }
  </style>
</head>
<body>
<!-- Solicita Token -->
<div class="modal fade" id="TokenModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-primary">
        <h3 class="modal-title" id="myModalLabel">Recuperar Senha</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
        <p>Informe o TOKEN enviado para o seu email:</p>
        <div class="form-group">
          <input class="form-control input-lg" id="tokenvalue" type="tel" size="20" maxlength="6" autocomplete="off" onkeypress="return /^[0-9]*$/i.test(event.key)">
          <div id="msg1"></div>
        </div>
      </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="tokenverify">verificar token</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tokenbtcancel">cancelar</button>
        </div>
    </div>
  </div>
</div>
<!---->
<!-- Solicita Nova Senha -->
<div class="modal fade" id="PasswordModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-success">
        <h3 class="modal-title" id="myModalLabel">Cadastro Senha</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
        <p>Informe uma nova senha com pelo menos 8 digitos:</p>
        <div class="form-group">
          <input class="form-control input-lg" id="passwordvalue" type="password" size="20" maxlength="50" autocomplete="off">
          <div id="msg2"></div>
        </div>
      </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="passwordverify">cadastrar nova senha</button>
        </div>
    </div>
  </div>
</div>
<!---->
<!-- ############################################################-->
<!-- Área de Pacote -->
<div class="wrapper__area" id="wrapper_Area">

<!-- ############################################################-->

  <!-- Área dos Formulários -->
  <div class="forms__area">

<!-- ############################################################-->

    <!-- Formulário de Login -->
    <form class="login__form" id="loginForm" action="javascript:void(0);">
      <!-- Título do formulário -->
      <h1 class="form__title">ENTRAR</h1>
      <!-- inputs -->
      <div class="input__group">
        <label class="field">
          <input type="text" name="email" placeholder="Email" id="email" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-at"></i></span>
        <small class="error_email"></small>
      </div>
      <div class="input__group">
        <label class="field">
          <input type="password" name="senha" placeholder="Senha" id="senha" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-lock"></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="error_senha"></small>
      </div>
      <div class="form__actions">
<!--
        <label for="checkboxInput" class="remeber_me">
          <input type="checkbox" id="checkboxInput">
          <span class="checkmark"></span>
          <span>Lembrar</span>
        </label>-->
        <div class="forgot_password">Esqueceu a senha?</div>
      </div>
      <!-- Botão de Login -->
      <button type="submit" class="submit-button" id="loginSubmitBtn">acessar</button>
      <div id="msg3"></div>
    </form> <!-- Fim do Login -->

<!-- ############################################################-->

    <!-- Formulário de Cadastro -->
    <form class="sign-up__form" id="signUpForm" action="javascript:void(0);">
      <h1 class="form__title">CADASTRE-SE</h1>
      <!-- inputs -->
      <div class="input__group">
        <label class="field">
          <input type="text" name="cadnome" placeholder="Nome Sobrenome" id="cadnome" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-user"></i></span>
        <small class="error_cadnome"></small>
      </div>
      <div class="input__group">
        <label class="field">
          <input type="text" name="cademail" placeholder="email@site.com" id="cademail" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-at"></i></span>
        <small class="error_cademail"></small>
      </div>
      <div class="input__group">
        <label class="field">
          <input type="password" name="cadpassword" placeholder="senha" id="cadpassword" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-lock"></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="ierror_cadpassword"></small>
      </div>
      <div class="input__group confirm__group">
        <label class="field">
          <input type="password" name="cad_password2" placeholder="confirme a senha" id="cad_password2" autocomplete="off">
        </label>
        <span class="input__icon"><i class="bx bx-lock"></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="error_cad_password2"></small>
      </div>
      <!-- Botão de cadastro -->
      <button type="submit" class="submit-button" id="signUpSubmitBtn">cadastrar</button>
      <div id="msg4"></div>

    </form> <!-- Fim Formulário de Cadastro -->

<!-- ############################################################-->

  </div><!-- Fim da Área dos Formulários -->

  <!-- Área Info Lateral -->
  <div class="aside__area" id="aside_Area">
    <div class="login__aside-info">
      <img src="./login/logo.png" alt="Image">
      <p>Digite seus dados de acesso para começar sua jornada,<br>ou</p>
      <button id="aside_signUp_Btn">Cadastre-se</button>
    </div>

<!-- ############################################################-->

    <div class="sign-up__aside-info">
      <h4 style="color:#520707;">Bem-vindo!</h4>
      <img src="./login/rocket.png" alt="Image">
      <p>Informe seus dados para cadastro,<br>ou</p>
      <button id="aside_signIn_Btn">Entre</button>
    </div>
  </div>
  <!-- Área Info Lateral -->
</div>
<!-- Fim da Área de Pacote -->
<!-- Javascript -->
  <script  src="./login/script.js"></script>
</body>
</html>