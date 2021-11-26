$(document).ready(function() {

  //FORCE VIDEO/AUDIO PRELOAD
//################################################################################################
var WSalaID = "preloadme";

   $.ajax({
    url:'https://comoestou.app.br/painel/alunosvotar.php',
    type:'POST',						
    data:{

      preloadme:WSalaID

    },
    success:function (data){
      if(data != null){
        $("#trash").html(data);
        console.log("audio e vídeos carregados!");  
      }
},
    error:function(r) {
    console.log(r);
    },

  });


//################################################################################################

$("#logoutMe").click(function () {

  window.location = "https://comoestou.app.br/logout/";
  
  });

$("#btcancelNovoAluno").click(function () {

  $("#NovoAlunovalue").val("");
  $('#ShowMyNovoAluno').hide(500);
  $('#NovoAlunovalue').val("");
  $('#btNovaSalaAluno').removeClass('btn btn-success').addClass('btn btn-secondary');
  $('#btNovaSalaAluno').prop("disabled",true);  
  });  

$("#btcancelListarAluno").click(function () {

  $("#sHOWlistarMeusAlunos").val("");
  $('#sHOWlistarMeusAlunos').hide(500);
  });  




// LISTAR ALUNOS ------------------------------------------------------------------------------------------------
$("#btListarAlunos").click(function () {

  $('#ListarlunosModal').modal({
      backdrop: 'static',
      keyboard: false
  });

//################################################################################################
  
            $.ajax({
    url:'https://comoestou.app.br/painel/alunolistarsalas.php',
    type:'POST',						
    data:{

    },
    success:function (data){
      if(data != null){
        $("#inputListarSalaAluno").html(data);
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});


$('#inputListarSalaAluno').on('change', function() {
  var mysalaid = $('#inputListarSalaAluno option:selected').val();

  if(this.value) {

    

         //################################################################################################
  
         $.ajax({
          url:'https://comoestou.app.br/painel/listarmeusalunos.php',
          type:'POST',						
          data:{

            mysalaid:mysalaid
      
          },
          success:function (data){
            if(data != null){
              $("#sHOWlistarMeusAlunos").html(data);
            }
      },
          error:function(r) {
          console.log(r);
          },
      
        });   
      
      //################################################################################################



      $('#sHOWlistarMeusAlunos').show(500);

    } else {
      $('#sHOWlistarMeusAlunos').hide(500); $("#NovoAlunovalue").val("");

    }
  
});








// RELATÓRIO  ------------------------------------------------------------------------------------------------
$("#btRelatorioAccess").click(function () {

  $('#RelatoriosModal').modal({
      backdrop: 'static',
      keyboard: false
  });

//################################################################################################
  
            $.ajax({
    url:'https://comoestou.app.br/painel/alunolistarsalas.php',
    type:'POST',						
    data:{

    },
    success:function (data){
      if(data != null){
        $("#inputListarSalaAlunoRelatorio").html(data);
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});


$('#inputListarSalaAlunoRelatorio').on('change', function() {
  var mysalaid = $('#inputListarSalaAlunoRelatorio option:selected').val();

  if(this.value) {

    

         //################################################################################################
  
         $.ajax({
          url:'https://comoestou.app.br/painel/relatoriolistaralunos.php',
          type:'POST',						
          data:{

            mysalaid:mysalaid
      
          },
          success:function (data){
            if(data != null){
              $("#sHOWlistarMeusAlunosRelatorio").html(data);
            }
      },
          error:function(r) {
          console.log(r);
          },
      
        });   
      
      //################################################################################################



      $('#sHOWlistarMeusAlunosRelatorio').show(500);

    } else {
      $('#sHOWlistarMeusAlunosRelatorio').hide(500);;

    }
  
});
$("#btcancelRelatorio").click(function () {

  $("#sHOWlistarMeusAlunosRelatorio").val("");
  $('#sHOWlistarMeusAlunosRelatorio').hide(500);
  }); 












// AVALIAR ALUNOS ------------------------------------------------------------------------------------------------
$("#btAvaliarAlunos").click(function () {

  $('#avaliarSalaModal').modal({
      backdrop: 'static',
      keyboard: false
  });

//################################################################################################
  
            $.ajax({
    url:'https://comoestou.app.br/painel/alunolistarsalas.php',
    type:'POST',						
    data:{

    },
    success:function (data){
      if(data != null){
        $("#inputListarAvaliarSalaAluno").html(data)
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});


$('#inputListarAvaliarSalaAluno').on('change', function() {

  if(this.value) {
    
    $("#masterSalaID").val(this.value);
      $('#btActionAvaliarSalaAluno').removeClass('btn btn-secondary').addClass('btn btn-success');
      $('#btActionAvaliarSalaAluno').prop("disabled",false);
    } else {
      $('#btActionAvaliarSalaAluno').removeClass('btn btn-success').addClass('btn btn-secondary');
      $('#btActionAvaliarSalaAluno').prop("disabled",true);
    }
  
});
$(".close").click(function () {
  $('#backcover').hide();
  $("#avaliarPainelShow").html("");
  

});


$("#btActionAvaliarSalaAluno").click(function () {
  $('#avaliarSalaModal').hide(500).delay(1500);
  $('#backcover').show(100);
  var WSalaID = $("#masterSalaID").val();
  //$("#avaliarPainelShow").html(WSalaID);
     //################################################################################################
  
     $.ajax({
      url:'https://comoestou.app.br/painel/alunosvotar.php',
      type:'POST',						
      data:{
  
        mysalaid:WSalaID
  
      },
      success:function (data){
        if(data != null){
          $("#avaliarPainelShow").html(data);
        }
  },
      error:function(r) {
      console.log(r);
      },
  
    });   
  
  //################################################################################################
  
});














//======= ALUNO EDIT/DELETE

$(document).on('click', '#btAlunoListDelete', function(e) {

  //################################################################################################
  
  //METODOS DE ACAO: 1 - INSERT, 2 - UPDATE, 3 - DELETE
  var Waction = "3";
  //--
  //ALVO: 1 - SALAS, 2 - ALUNOS, 3 - EMOTIONS
  var Wtarget = "2";
  //--
  //KEY_ID
  var Wkey_id = this.value;
  //--
  //VALOR
  //var Wvalue = this.value;
  //------------------------------------------------------------------------------------------------
  
  
              $.ajax({
      url:'https://comoestou.app.br/painel/control.php',
      type:'POST',						
      data:{
  
        action:Waction,
        target:Wtarget,
        key_id:Wkey_id,
        //value:Wvalue
  
      },
      success:function (data){
        if(data != null && data=="success") {
        
          var mysalaid = $('#inputListarSalaAluno option:selected').val();
  
         //################################################################################################
  
         $.ajax({
          url:'https://comoestou.app.br/painel/listarmeusalunos.php',
          type:'POST',						
          data:{

            mysalaid:mysalaid
      
          },
          success:function (data){
            if(data != null){
              $("#sHOWlistarMeusAlunos").html(data);
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
  
  //################################################################################################
  
  });
































//CADASTRAR NOVO ALUNO ------------------------------------------------------------------------------------------------
$("#btAdicionarAluno").click(function () {

  $('#NovoAlunoModal').modal({
      backdrop: 'static',
      keyboard: false
  });

          //################################################################################################
  
          $.ajax({
            url:'https://comoestou.app.br/painel/alunolistarsalas.php',
            type:'POST',						
            data:{
        
            },
            success:function (data){
              if(data != null){
                $("#inputNovoAluno").html(data);
              }
        },
            error:function(r) {
            console.log(r);
            },
        
          });   
        
        //################################################################################################


});  

$('#inputNovoAluno').on('change', function() {

  if(this.value) {
      $('#ShowMyNovoAluno').show(500);
      $('#btNovaSalaAluno').removeClass('btn btn-secondary').addClass('btn btn-success');
      $('#btNovaSalaAluno').prop("disabled",false);
    } else {
      $('#ShowMyNovoAluno').hide(500); $("#NovoAlunovalue").val("");
      $('#btNovaSalaAluno').removeClass('btn btn-success').addClass('btn btn-secondary');
      $('#btNovaSalaAluno').prop("disabled",true);
    }
  
});


//------------------------------------------------------------------------------------------------
$("#btNovaSalaAluno").click(function () {

  if ($("#NovoAlunovalue").val() == "") {
  

    $('#msg6').show(500).html("O nome do ALUNO não pode estar vazio!").delay(2000).hide(500);
    return false;

}

//################################################################################################

//METODOS DE ACAO: 1 - INSERT, 2 - UPDATE, 3 - DELETE
var Waction = "1";
//--
//ALVO: 1 - SALAS, 2 - ALUNOS, 3 - EMOTIONS
var Wtarget = "2";
//--
//KEY_ID
var Wkey_id = $('#inputNovoAluno option:selected').val();
//--
//VALOR
var Wvalue = $("#NovoAlunovalue").val();
//------------------------------------------------------------------------------------------------


            $.ajax({
    url:'https://comoestou.app.br/painel/control.php',
    type:'POST',						
    data:{

      action:Waction,
      target:Wtarget,
      key_id:Wkey_id,
      value:Wvalue

    },
    success:function (data){
      if(data != null && data=="success") {
        $('#msg6').show(500).html("Aluno cadastrado com sucesso!").delay(2000).hide(500);
        $("#NovoAlunovalue").val("");
        //$('#NovaSalaModal').modal('hide');
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});
//------------------------------------------------------------------------------------------------
























//======= SALA DE AULA EDIT/DELETE

$(document).on('click', '#btSalaAulaDelete', function(e) {

//################################################################################################

//METODOS DE ACAO: 1 - INSERT, 2 - UPDATE, 3 - DELETE
var Waction = "3";
//--
//ALVO: 1 - SALAS, 2 - ALUNOS, 3 - EMOTIONS
var Wtarget = "1";
//--
//KEY_ID
var Wkey_id = this.value;
//--
//VALOR
//var Wvalue = this.value;
//------------------------------------------------------------------------------------------------


            $.ajax({
    url:'https://comoestou.app.br/painel/control.php',
    type:'POST',						
    data:{

      action:Waction,
      target:Wtarget,
      key_id:Wkey_id,
      //value:Wvalue

    },
    success:function (data){
      if(data != null && data=="success") {


          //################################################################################################
  
          $.ajax({
            url:'https://comoestou.app.br/painel/listarsalas.php',
            type:'POST',						
            data:{
        
            },
            success:function (data){
              if(data != null){
                $("#listarSalas").html(data);
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

//################################################################################################

});

// LISTAR SALAS ------------------------------------------------------------------------------------------------
$("#btListarSalas").click(function () {

  $('#ListarSalaModal').modal({
      backdrop: 'static',
      keyboard: false
  });

//################################################################################################
  
            $.ajax({
    url:'https://comoestou.app.br/painel/listarsalas.php',
    type:'POST',						
    data:{

    },
    success:function (data){
      if(data != null){
        $("#listarSalas").html(data);
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});


//CRIAR SALAS ------------------------------------------------------------------------------------------------
$("#btCriarSalas").click(function () {

  $('#NovaSalaModal').modal({
      backdrop: 'static',
      keyboard: false
  });
});  
//------------------------------------------------------------------------------------------------
$("#btNovaSala").click(function () {

  if ($("#NovaSalavalue").val() == "") {
  

    $('#msg5').show(500).html("O nome da SALA não pode estar vazio!").delay(2000).hide(500);
    return false;

}


//################################################################################################

//METODOS DE ACAO: 1 - INSERT, 2 - UPDATE, 3 - DELETE
var Waction = "1";
//--
//ALVO: 1 - SALAS, 2 - ALUNOS, 3 - EMOTIONS
var Wtarget = "1";
//--
//KEY_ID
//var Wkey_id = "1";
//--
//VALOR
var Wvalue = $("#NovaSalavalue").val();
//------------------------------------------------------------------------------------------------


            $.ajax({
    url:'https://comoestou.app.br/painel/control.php',
    type:'POST',						
    data:{

      action:Waction,
      target:Wtarget,
      //key_id:Wkey_id,
      value:Wvalue

    },
    success:function (data){
      if(data != null && data=="success") {
        $('#msg5').show(500).html("Sala criada com sucesso!").delay(2000).hide(500);
        $("#NovaSalavalue").val("");
        //$('#NovaSalaModal').modal('hide');
      }
},
    error:function(r) {
    console.log(r);
    },

  });   

//################################################################################################
});
//------------------------------------------------------------------------------------------------

});