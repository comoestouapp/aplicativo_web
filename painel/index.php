<?php
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------

//CHECAR SE ESTÁ LOGADO
session_start();
$wid = $_SESSION["wid"];
$mysecretsession = $_SESSION["mysecretsession"];

if(!$wid) { header('Location: https://comoestou.app.br/'); exit(); }

//--------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************

//VERIFICA O SECRET e NOME
$querySecret = "SELECT
secret, nome
FROM
professores
where id='$wid'";


if ($resultSecret = $mysqli->query($querySecret)) {

	while ($rowSecret = $resultSecret->fetch_assoc()) {
    $secret_db	=	$rowSecret["secret"];
    $wNome 	=	$rowSecret["nome"];		

}}

if($mysecretsession != $secret_db ) { header('Location: https://comoestou.app.br/'); exit(); }

//-------------------------------------------------------------------------

$primeiroNome = strtok($wNome, ' ');

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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./estilos.css">
</head>
<body>
<!-- ################################################################# !-->
<!-- Listar Sala Modal -->
<div class="modal fade" id="ListarSalaModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-primary">
        <h3 class="modal-title" id="myModalLabel">Minhas Salas de Aula</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
        <div id="listarSalas" class="text-muted"></div>
      </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
  </div>
</div>
<!-- =================================================================== -->
<!-- ################################################################# !-->
<!-- Nova Sala -->
<div class="modal fade" id="NovaSalaModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-primary">
        <h3 class="modal-title" id="myModalLabel">Criar Nova Sala</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
        <p>Informe o NOME da Sala:</p>
        <div class="form-group">
          <input class="form-control input-lg" id="NovaSalavalue" type="text" size="20" maxlength="25" autocomplete="off">
          <div id="msg5"></div>
        </div>
      </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btNovaSala">Gravar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btcancel">Fechar</button>
        </div>
    </div>
  </div>
</div>
<!-- =================================================================== -->
<!-- Novo Aluno -->
<div class="modal fade" id="NovoAlunoModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-primary">
        <h3 class="modal-title" id="myModalLabel">Cadastrar Novo Aluno</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputNovoAluno">Sala:</label>
          </div>
          <select class="custom-select" id="inputNovoAluno">
          <div id="listarSalasAlunos"></div>
          </select>
        </div>
        <div id="ShowMyNovoAluno" style="display:none;">
          <p>Informe o NOME do aluno:</p>
          <div class="form-group">
            <input class="form-control input-lg" id="NovoAlunovalue" type="text" size="20" maxlength="25" autocomplete="off">
            <div id="msg6"></div>
          </div>
        </div>
      </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btNovaSalaAluno" disabled='disabled'>Gravar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btcancelNovoAluno">Fechar</button>
        </div>
    </div>
  </div>
</div>
<!-- =================================================================== -->
<!-- Listar  Alunos -->
<div class="modal fade" id="ListarlunosModal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog rubberBand animated" role="document">
    <div class="modal-content">
      <div class="modal-header alert-primary">
        <h3 class="modal-title" id="myModalLabel">Meus Alunos</h3>
      </div>
      <div id="meu_modal" class="modal-body modalshow">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputListarSalaAluno">Sala:</label>
          </div>
          <select class="custom-select" id="inputListarSalaAluno">
          <div id="listarSalasAlunos"></div>
          </select>
        </div>
        <div id="sHOWlistarMeusAlunos" class="text-muted" style="display:none;"></div>
      </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btcancelListarAluno">Fechar</button>
        </div>
    </div>
  </div>
</div>
<!-- ###################### MENU ########################## -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <a class="navbar-brand" href="javascript:void(0);"><img src="./imagens/logo_topo.svg" class="img-responsive"></a>
      <div class="nome_user"><i class="fas fa-smile-beam myicon"></i>Olá, <?php echo $primeiroNome; ?></div>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
<!-- ____________________________________________________________________________________ -->
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="avaliarAluno"><i class="fas fa-user-graduate myicon"></i>Avaliar Aluno</a>
        </li>
<!-- ____________________________________________________________________________________ -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarGerenciarSalas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-door-closed myicon"></i>Gerenciar Salas de Aula</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="javascript:void(0);" id="btCriarSalas">Criar Nova</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);" id="btListarSalas">Listar/Excluir</a></li>
          </ul>
        </li>
<!-- ____________________________________________________________________________________ -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="geranciarAlunos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-edit myicon"></i>Gerenciar Alunos</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="javascript:void(0);" id="btAdicionarAluno">Cadastrar Novo</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);" id="btListarAlunos">Listar/Excluir</a></li>
          </ul>
        </li>
<!-- ____________________________________________________________________________________ -->
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="relatorios"><i class="fas fa-receipt myicon"></i>Relatórios</a>
        </li>
<!-- ____________________________________________________________________________________ -->
      </ul>
      <p class="my-2 my-lg-0">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="logoutMe"><i class="fas fa-sign-out-alt myicon"></i>Sair</button>
      </p>
    </div>
  </nav>
<!-- ################################################ -->
<div id="painel"></div>
<script  src="./script.js"></script>
</body>
</html>
