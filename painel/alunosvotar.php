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
$preloadme = filter_input(INPUT_POST, 'preloadme', FILTER_SANITIZE_MAGIC_QUOTES);
$preloadme = substr($preloadme, 0, 9);

if($preloadme) {

echo "<!-- ################################### -->
<div class=\"d-flex justify-content-center flex-nowrap mytitulo\"><b><span style=\"color: rgb(200, 20, 20);\"></span></b>,&nbsp;como você se sentindo hoje?</div>
    <div class=\"container\">
        <div class=\"row\">
<!-- ___________________________________ -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">RAIVA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted=\"muted\" defaultMuted playsinline oncontextmenu=\"return false;\" preload=\"auto\" class=\"filter\" value='raiva'>
                        <source src=\"./videos/0raiva.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/0raiva.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">AVERSÃO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='aversao'>
                        <source src=\"./videos/1aversao.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/1aversao.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">MEDO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='medo'>
                        <source src=\"./videos/2medo.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/2medo.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">TRISTE</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='triste'>
                        <source src=\"./videos/3triste.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/3triste.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">SURPRESA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='surpresa'>
                        <source src=\"./videos/4surpresa.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/4surpresa.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">ANTECIPAÇÃO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='antecipacao'>
                        <source src=\"./videos/5antecipacao.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/5antecipacao.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">FELIZ</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='feliz'>
                        <source src=\"./videos/6feliz.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/6feliz.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">CONFIANÇA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" class=\"filter\" value='confianca'>
                        <source src=\"./videos/7confianca.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/7confianca.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ___________________________________ -->
        </div>
    </div>
</div>
<audio preload=\"auto\">
    <source src=\"./videos/fireworks.ogg\" type=\"audio/ogg\">
    <source src=\"./videos/fireworks.mp3\" type=\"audio/mpeg\">
    Seu navegador não suporta tag de audio (HTML5).
</audio>
<!-- ################################### -->
<div class=\"d-flex justify-content-center flex-nowrap\"><button type=\"button\" class=\"btn btn-xl btn-success\" >Confirmar</button></div>
<!-- ==== -->";

exit();

}




//-------------------------------------------------------------------------


$mysalaid = filter_input(INPUT_POST, 'mysalaid', FILTER_SANITIZE_NUMBER_INT);
$mysalaid = substr($mysalaid, 0, 11);
if(!$mysalaid) { echo "noid"; exit(); }
//-------------------------------------------------------------------------
/*
$alunoNaoVotou = "";
//CONTAR QUANTOS ALUNOS NÃO VOTARAM
$queryContaAlunosNaoVotaram = "SELECT
COUNT(*) as contador
FROM
alunos
where sala_id='$mysalaid'
and votou_em <> CURDATE()";

if ($resultContaAlunosNaoVotaram = $mysqli->query($queryContaAlunosNaoVotaram)) {

	while ($rowContaAlunosNaoVotaram = $resultContaAlunosNaoVotaram->fetch_assoc()) {
    $alunoNaoVotou  	=	$rowContaAlunosNaoVotaram["contador"];
    }

}

echo "TOTAL ALUNOS NÃO VOTARAM NESTA SALA: $alunoNaoVotou<br><br>";
*/
//-------------------------------------------------------------------------

$contador = 1;

//LISTAR ALUNOS
$queryListar = "SELECT
id, nome
FROM
alunos
where sala_id='$mysalaid'
and votou_em <> CURDATE()
order by nome ASC
limit 1";

if ($resultListar = $mysqli->query($queryListar)) {

	while ($rowListar = $resultListar->fetch_assoc()) {
    $id_de_Aluno  	=	$rowListar["id"];
    $Nome_Aluno  	=	$rowListar["nome"];

    //echo "|$contador|ALUNO: $id_de_Aluno - $Nome_Aluno |<br>"; $contador++;

//-----------------------------------------------------------------------------------

echo "<!-- ################################### -->
<div class=\"d-flex justify-content-center flex-nowrap mytitulo\"><b><span style=\"color: rgb(200, 20, 20);\">$Nome_Aluno</span></b>,&nbsp;como você se sentindo hoje?</div>
    <div class=\"container\">
        <div class=\"row\">
<!-- ___________________________________ -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">RAIVA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted=\"muted\" defaultMuted playsinline oncontextmenu=\"return false;\" preload=\"auto\" id='myvideo' class=\"filter\" value='raiva'>
                        <source src=\"./videos/0raiva.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/0raiva.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">AVERSÃO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='aversao'>
                        <source src=\"./videos/1aversao.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/1aversao.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">MEDO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='medo'>
                        <source src=\"./videos/2medo.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/2medo.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">TRISTE</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='triste'>
                        <source src=\"./videos/3triste.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/3triste.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">SURPRESA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='surpresa'>
                        <source src=\"./videos/4surpresa.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/4surpresa.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">ANTECIPAÇÃO</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='antecipacao'>
                        <source src=\"./videos/5antecipacao.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/5antecipacao.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">FELIZ</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='feliz'>
                        <source src=\"./videos/6feliz.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/6feliz.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ==== -->
            <div class=\"col d-flex justify-content-center flex-nowrap\">
                <div class=\"xcontainer\">
                    <div class=\"mytext\">CONFIANÇA</div>
                    <video width=\"300\" height=\"300\" autoplay=\"autoplay\" loop=\"loop\" muted defaultMuted playsinline  oncontextmenu=\"return false;\"  preload=\"auto\" id='myvideo' class=\"filter\" value='confianca'>
                        <source src=\"./videos/7confianca.mp4\" type=\"video/mp4\" />
                        <source src=\"./videos/7confianca.ogg\" type=\"video/ogg\" />
                        Seu navegador não suporta tag de vídeo (HTML5).
                    </video>
                </div>
            </div>
<!-- ___________________________________ -->
        </div>
    </div>
</div>
<audio id=\"myAudioElement\" preload=\"auto\">
    <source src=\"./videos/fireworks.ogg\" type=\"audio/ogg\">
    <source src=\"./videos/fireworks.mp3\" type=\"audio/mpeg\">
    Seu navegador não suporta tag de audio (HTML5).
</audio>
<!-- ################################### -->
<div class=\"d-flex justify-content-center flex-nowrap\">
<button type=\"button\" class=\"btn btn-xl btn-success\" id=\"btVotar\">Confirmar</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button type=\"button\" class=\"btn btn-xl btn-danger\" id=\"btAusente\">Aluno Ausente</button>
</div>
<!-- ==== -->";


echo "<script>
//---------------------------------------------
var myemotion = null;
document.querySelectorAll('video').forEach(vid => vid.pause());
$(\"#btVotar\").removeClass('btn btn-success').addClass('btn btn-secondary');
$(\"#btVotar\").prop(\"disabled\",true);

$(\"#btAusente\").removeClass('btn btn-danger').addClass('btn btn-secondary');

//botão confirmar emoção
$(\"#btVotar\").click(function () {
  if(!myemotion) {console.log('selecione para votar!'); return false;}
  $(this).removeClass('btn btn-success').addClass('btn btn-secondary');
  $(this).prop(\"disabled\",true);
  console.log('votado:' + myemotion);
  $(\"#myAudioElement\")[0].play();
  fire(0.25, {
    spread: 26,
    startVelocity: 55,
  });
  fire(0.2, {
    spread: 60,
  });
  fire(0.35, {
    spread: 100,
    decay: 0.91,
    scalar: 0.8
  });
  fire(0.1, {
    spread: 120,
    startVelocity: 25,
    decay: 0.92,
    scalar: 1.2
  });
  fire(0.1, {
    spread: 120,
    startVelocity: 45,
  });

  //------------------------------------------------------------------------------------------------
  var Waction = \"1\";
  var Wtarget = \"3\";
  var Wkey_id = \"$id_de_Aluno\";
  var Wvalue = myemotion;
  var WSalaID = $(\"#masterSalaID\").val();
        $.ajax({
        url:'https://comoestou.app.br/painel/control.php',
        type:'POST',						
        data:{
    
          action:Waction,
          target:Wtarget,
          key_id:Wkey_id,
          value:Wvalue,
          wsalaid:WSalaID
    
        },
        success:function (data){
          if(data != null && data==\"success\") {
          console.log('inserido com sucesso!');

          //################################################################################################
          var WSalaID = $(\"#masterSalaID\").val();
           $.ajax({
            url:'https://comoestou.app.br/painel/alunosvotar.php',
            type:'POST',						
            data:{
        
              mysalaid:WSalaID
        
            },
            success:function (data){
              if(data != null){
                $(\"#avaliarPainelShow\").html(data);
              }
        },
            error:function(r) {
            console.log(r);
            },
        
          });   
        
        //################################################################################################


      }
    },
        error:function(r) {
        console.log(r);
        },
    
      });
  //------------------------------------------------------------------------------------------------



});

//quando passar na área com o mouse/touch
$(document).on('mouseover touchstart',\"#myvideo\", function () {
//var className = $(this).attr('class');
$(this).removeClass().addClass('nofilter');
this.play();
});

//quando sair da área com o mouse/touch
$(document).on('mouseout touchend',\"#myvideo\", function () {
  $(this).removeClass().addClass('filter');
  this.pause();
});

//ao clicar no emoji
$(document).on('click touchstart','#myvideo', function() {
  $(\"#vd_selecionado\").removeClass().addClass('filter');
  $(\"#vd_selecionado\").attr(\"id\",\"myvideo\");
  $(this).removeClass().addClass('selecionado');
  myemotion = $(this).attr('value');
  document.querySelectorAll('video').forEach(vid => vid.pause());
  this.play();
  $(this).attr(\"id\",\"vd_selecionado\");
  console.log(myemotion);
  $(\"#btAusente\").removeClass('btn btn-danger').addClass('btn btn-secondary');
  $(\"#btVotar\").removeClass('btn btn-secondary').addClass('btn btn-success');
  $(\"#btVotar\").prop(\"disabled\",false);
 });

 //ao clicar no botão aluno ausente
 $(\"#btAusente\").click(function () {
    myemotion = 'alunoausente';
    console.log(myemotion);
    $(\"#vd_selecionado\").removeClass().addClass('filter');
    $(\"#vd_selecionado\").attr(\"id\",\"myvideo\");
    $(\"#btAusente\").removeClass('btn btn-secondary').addClass('btn btn-danger');
    $(\"#btVotar\").removeClass('btn btn-secondary').addClass('btn btn-success');
    $(\"#btVotar\").prop(\"disabled\",false);
});
 //--------------------------------------------------------------------
  var count = 200;
  var defaults = {
  origin: { x: 0.5, y: 0.9 }
  };

function fire(particleRatio, opts) {
  confetti(Object.assign({}, defaults, opts, {
    particleCount: Math.floor(count * particleRatio)
  }));
}

//--------------------------------------------------------------------
</script>";
//-----------------------------------------------------------------------------------

    }
}

if(!$Nome_Aluno) { echo "<h3 style=\"padding:2vw;\"><p class=\"adjustfont\">Sem alunos para votar HOJE/nesta sala.</p></h3>"; exit();}

?>