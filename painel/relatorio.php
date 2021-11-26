<?php
//error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$ativo = null;

//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************

// ** CAPTURAR OS DADOS DO MÉTODO POST FILTRANDO COM SEGURANÇA **
//***************************************************************
    //data_inicial
    //-------------------------------------------------
    $data_inicial = filter_input(INPUT_GET, 'data_inicial', FILTER_SANITIZE_NUMBER_INT);
    $data_inicial = substr($data_inicial, 0, 8);
    $data_inicial = "19800101";
    //-------------------------------------------------
    //data_final
    //-------------------------------------------------
    $data_final = filter_input(INPUT_GET, 'data_final', FILTER_SANITIZE_NUMBER_INT);
    $data_final = substr($data_final, 0, 8);
    $data_final = "20501231";
    //-------------------------------------------------
    //KEY_ID
    //-------------------------------------------------
    $key_id = filter_input(INPUT_GET, 'key_id', FILTER_SANITIZE_NUMBER_INT);
    $key_id = substr($key_id, 0, 11);
    //-------------------------------------------------
//***************************************************************

if(!$data_inicial or !$data_final or !$key_id) { echo "no data"; exit(); }

//LISTAR ALUNOS
$queryListar = "SELECT
nome
FROM
alunos
where id='$key_id'";

if ($resultListar = $mysqli->query($queryListar)) {

	while ($rowListar = $resultListar->fetch_assoc()) {
    $nomeAluno  	=	$rowListar["nome"];

}}



//LISTAR EMOÇÕES DE ALUNO POR PERÍODO
$queryListar = "select
sum(antecipacao) as antecipacao,
sum(aversao) as aversao,
sum(confianca) as confianca,
sum(feliz) as feliz,
sum(medo) as medo,
sum(raiva) as raiva,
sum(surpresa) as surpresa,
sum(triste) as triste
from emocoes
where
aluno_id = '$key_id'
and data BETWEEN '$data_inicial' and '$data_final'";

if ($resultListar = $mysqli->query($queryListar)) {

	while ($rowListar = $resultListar->fetch_assoc()) {

    $antecipacao  	=	$rowListar["antecipacao"];
    $aversao  	    =	$rowListar["aversao"];
    $confianca      =	$rowListar["confianca"];
    $feliz  	    =	$rowListar["feliz"];
    $medo  	        =	$rowListar["medo"];
    $raiva  	    =	$rowListar["raiva"];
    $surpresa  	    =	$rowListar["surpresa"];
    $triste  	    =	$rowListar["triste"];

    $total = $antecipacao + $aversao + $confianca + $feliz + $medo + $raiva + $surpresa + $triste;


}}

if(!$resultListar) { echo "<p class='texto'>Sem avaliação do aluno para o período!</p>"; exit();}

$percentual_antecipacao = calcularPercentual($antecipacao, $total);
$percentual_aversao  = calcularPercentual($aversao, $total);
$percentual_confianca = calcularPercentual($confianca, $total);
$percentual_feliz = calcularPercentual($feliz, $total);
$percentual_medo = calcularPercentual($medo, $total);
$percentual_raiva = calcularPercentual($raiva, $total);
$percentual_surpresa = calcularPercentual($surpresa, $total);
$percentual_triste = calcularPercentual($triste, $total);

//calcular percentual
function calcularPercentual($valor, $total) {
    if($valor == 0){ return 0;}
    $percentual = ($valor * 100) / $total;
    return $percentual;
  }

//######################################################################################################################
//=====================================================
require_once "../common/Mobile_Detect.php";
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
$myCSShere = "      #myChart {
  width: 100%;
  height: auto;
}
.texto {
          width: 60%;
          margin: auto;
          text-align: justify;
          font-family: 'Trebuchet MS', sans-serif;
          font-size: 1.4vw;
          color:#003F63;
          padding-top:10px;
          padding-bottom:10px;
      }
      .alerta {
          width: 60%;
          margin: auto;
          text-align: center;
          font-family: 'Trebuchet MS', sans-serif;
          font-size: 1.8vw;
          color: red;
          padding-top:80px;
      }";

$myJShere = "";

}

//===============================================================
// mobile
if($meu_device=="Celular") {

    if (strpos($useragent,'Windows Phone') !== false) {
    $meu_sistema="Windows Phone";
    }
	
//incluir comando para mobile
$myCSShere = "      #myChart {
  width: 100%;
  height: auto;
}
.texto {
          width: 60%;
          margin: auto;
          text-align: justify;
          font-family: 'Trebuchet MS', sans-serif;
          font-size: 2.5vw;
          color:#003F63;
          padding-top:10px;
          padding-bottom:10px;
      }
      .alerta {
          width: 60%;
          margin: auto;
          text-align: center;
          font-family: 'Trebuchet MS', sans-serif;
          font-size: 1.8vw;
          color: red;
          padding-top:80px;
      }";
      $myJShere = "";

}


//TODO js DESKTOP:
/*
$(window).resize(function() {
  var minhaJanela = window.location.pathname;
  var meusParametros = ("<?php $wSim = "?"; foreach ($_GET as $key => $value) { echo "$wSim$key=$value";if($wSim=="?") {$wSim="&";} }?>")
  window.location = minhaJanela + meusParametros;
});
*/


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
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<style>
<?php echo $myCSShere; ?>
</style>
</head>
<body>
<?php if($total==0) {echo "<p class='alerta'>Sem dados para este aluno no período selecionado!</p></body></html>"; exit();} ?>
<canvas id="myChart" height="650"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['TRISTEZA', 'MEDO', 'AVERSÃO', 'SURPRESA', 'ANTECIPAÇÃO', 'CONFIANÇA', 'FELIZ', 'RAIVA'],
        datasets: [{
            label: '',
            data: [<?php echo "$percentual_triste, $percentual_medo, $percentual_aversao, $percentual_surpresa, $percentual_antecipacao, $percentual_confianca, $percentual_feliz, $percentual_raiva" ?>],
            backgroundColor: [
                'rgba(0, 18, 25, 0.2)',
                'rgba(114, 9, 183, 0.2)',
                'rgba(181, 23, 158, 0.2)',
                'rgba(247, 37, 133, 0.2)',
                'rgba(67, 97, 238, 0.2)',
                'rgba(72, 149, 239, 0.2)',
                'rgba(76, 201, 240, 0.2)',
                'rgba(174, 32, 18, 0.2)'
            ],
            borderColor: [
                'rgb(0, 18, 25)',
                'rgb(114, 9, 183)',
                'rgb(181, 23, 158)',
                'rgb(247, 37, 133)',
                'rgb(67, 97, 238)',
                'rgb(72, 149, 239)',
                'rgb(76, 201, 240, 1)',
                'rgb(174, 32, 18, 1)'
            ],
            borderWidth: 1,
            borderRadius: 15,
        }]
    },
    options: {
    indexAxis: 'y',
    responsive: false,
    maintainAspectRatio: true,
    animation: {
            duration: 2000,
        },
    plugins: {
      legend: {
        display:false
      },
      title: {
        display: true,
        text: '<?php echo $nomeAluno; ?> - Avaliação Emocional',
        padding: 30,
        font: {
            size: 40,
          }
      },




      tooltips: {
  callbacks: {
    label: function(tooltipItem, data) {
      return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
    }
  }
}









    },
    layout: {
            padding: {
                left: 120,
                right: 150,
                top: 0,
                bottom: 50
            }
        },
        scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 20,
                                },
        callback: function (value) {
          return value + '%';
        },
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 20,
                                }
                            }
                        }
                  },
        scaleLabel: {
        display: true,
        labelString: 'Percentage',
      }         
  }
});
<?php echo $myJShere; ?>
</script>
<?php

//ordena o array pelo valor
$meusSentimentos = array(
  "TRISTEZA"=>"$percentual_triste",
  "MEDO"=>"$percentual_medo",
  "AVERSAO"=>"$percentual_aversao",
  "SURPRESA"=>"$percentual_surpresa",
  "ANTECIPACAO"=>"$percentual_antecipacao",
  "CONFIANCA"=>"$percentual_confianca",
  "FELIZ"=>"$percentual_feliz",
  "RAIVA"=>"$percentual_raiva"
);
arsort($meusSentimentos);

$contador=1;

foreach($meusSentimentos as $x => $x_value) {


  if($contador <= 3 and $x_value > 0 ) {

    //echo " Key = $x / Value = $x_value | $contador |";


    //-------------------------------------------------------
    $minhaEmocao = null;
    //LISTAR EMOCOES
    $queryEmocoes = "SELECT
    conteudo
    FROM
    emocoes_list
    where nome='$x'";

    if ($resultEmocoes = $mysqli->query($queryEmocoes)) {

    while ($rowEmocoes = $resultEmocoes->fetch_assoc()) {
    $minhaEmocao    =	$rowEmocoes["conteudo"];
    $minhaEmocao    =  utf8_encode( $minhaEmocao);

    }}
    //-------------------------------------------------------


    echo "<p class='texto'>$minhaEmocao</p>";

    $minhaEmocao = null;
    $contador++;
  }

}
//==================================================================================
?>
</body>
</html>