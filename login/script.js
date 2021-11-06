// Área de Pacote
const wrapper__Area = document.querySelector('#wrapper_Area');

// Área de Formulários
const loginForm = document.querySelector('#loginForm');
const signUpForm = document.querySelector('#signUpForm');

// Todos Inputs 
const allLoginFormFields = Array.from(document.querySelectorAll('#loginForm .input__group .field input'));
const allSignUpFormFields = Array.from(document.querySelectorAll('#signUpForm .input__group:not(.confirm__group) .field input'));

// Campos de Senha/Confirmação
const passwordField = document.querySelector('#signUpPassword');
const confirmPassword = document.querySelector('#signUpConfirmPassword');

// Botões Formulários
const loginFormSubmitBtn = document.querySelector('#loginSubmitBtn');
const signUpFormSubmitBtn = document.querySelector('#signUpSubmitBtn');

// Botão de mostrar a Senha
const showHidePassDom = Array.from(document.querySelectorAll('.showHide__Icon i'));

// Área Info Lateral
const aside__Area = document.querySelector('#aside_Area');

// Botões Área Info Lateral
const aside__SignUp_Button = document.querySelector('#aside_signUp_Btn');
const aside__SignIn_Button = document.querySelector('#aside_signIn_Btn');

// - - - - -  Eventos - - - - - //

// When Submitting On Login & Sign-Up Forms


// Ao clicar no botão, mudar área de info lateral
aside__Area.addEventListener('click', chnageFormMode);
aside__Area.addEventListener('click', chnageFormMode);

// - - - - -  Funções - - - - - //

// Mudar Área Info Lateral
function chnageFormMode(e) {
  // Verifica se o botão é o de cadastro
  if(e.target === aside__SignUp_Button){
    // Adiciona Classe [ cadastro ] na Área de Pacote
    wrapper__Area.classList.add('sign-up__Mode-active');
  };
  // Verifica se o botão é o de login
  if(e.target === aside__SignIn_Button){
    // Adiciona Classe [ login ] na Área de Pacote
    wrapper__Area.classList.remove('sign-up__Mode-active');
  };
};

// Mostra/Oculta Senha
(function showHidePass() {
  // Verifica todos icones de senha
  showHidePassDom.forEach(icon =>{
    // quando clicar em mostrar senha
    icon.addEventListener('click', () => {
      // seleciona o input de senha
      const targetAreaInput = icon.parentElement.parentElement.querySelector('.field input');
      // se o icone estiver como oculto
      if(icon.className === 'bx bx-hide'){
        // mudar o icone para mostrar
        icon.className = 'bx bx-show';
        // muda o tipo de input de password para texto
        targetAreaInput.setAttribute('type', 'text');
      }else{ // caso contrário
        // muda o icone da oculto
        icon.className = 'bx bx-hide';
        // muda o tipo de input de texto para password
        targetAreaInput.setAttribute('type', 'password');
      };
    });
  });
})();

//função checar email
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


//VERIFICAR DADOS DO FORMULARIO DE LOGIN

$("#loginSubmitBtn").click(function () {
//-------------------------------------------------------------------------
var testamail = $("#email").val();

if ($("#email").val() != "") {

 if(!isEmail(testamail)) {
  $('#msg3').show(500).html("Você deve digitar um email válido!").delay(2000).hide(500);
  return false;
 }
} else {
  $('#msg3').show(500).html("Você deve digitar seu email!").delay(2000).hide(500);
  return false;
}


if ($("#senha").val() != "") {

  if($("#senha").val().length < 8 ) {
  
          $('#msg3').show(500).html("A senha deve ter no mínimo 8 digitos!").delay(2000).hide(500);
          return false;

  }

      } else {

          $('#msg3').show(500).html("Você deve informar uma senha.").delay(2000).hide(500);
          return false;
      }

//################################################################################################

var Wemail = $("#email").val();
var Wsenha = $("#senha").val();

                    $.ajax({
						url:'https://comoestou.app.br/login/login.php',
						type:'POST',						
						data:{
                            email:Wemail,
                            senha:Wsenha,

						},
						success:function (data){
							if(data != null && data == "success"){

                $('#loginSubmitBtn').prop('disabled', true);
                $('#loginSubmitBtn').toggleClass("btn-secondary");
                //redirect...
                window.location = "https://comoestou.app.br/painel/";
								
							} else { //report failure...
//								//erro nos dados de cadastro
								console.log(data);
                if(data=="blocked") {
                  $('#msg3').show(500).html("Por segurança seu usuário foi bloqueado!").delay(2000).hide(500);
                } else {
                $('#msg3').show(500).html("Email/Senha incorretos!").delay(2000).hide(500);
							}
            }
},
						error:function(r) {
						console.log(r);
						},

					});
					
					


//################################################################################################
//--------------------------------------------------------------------------
});

//SOLICITAR TOKEN PARA RECUPERAR SENHA

$(".forgot_password").click(function () {

  $("#senha").val("");

  var testamail = $("#email").val();

  if ($("#email").val() != "") {
  
   if(!isEmail(testamail)) {
    $('#msg3').show(500).html("Você deve digitar um email válido!").delay(2000).hide(500);
    return false;
   }
  } else {
    $('#msg3').show(500).html("Você deve digitar seu email!").delay(2000).hide(500);
    return false;
  }
  
//################################################################################################
  
  var Wemail = $("#email").val();
  
                      $.ajax({
              url:'https://comoestou.app.br/login/token.php',
              type:'POST',						
              data:{
                              email:Wemail
  
              },
              success:function (data){
                if(data != null && data == "success"){
                  //redirect...
                  $('#TokenModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                  
                }
                  if(data != null && data=="blocked") {
                    $('#msg3').show(500).html("Por segurança seu usuário foi bloqueado!").delay(2000).hide(500);
                    
                  }

                  if(data != null && data=="not") {
                    $('#msg3').show(500).html("Email não cadastrado!").delay(2000).hide(500);
                  }
  },
              error:function(r) {
              console.log(r);
              },
  
            });
            
            
  
  
  //################################################################################################
  //--------------------------------------------------------------------------
});

//ENVIA TOKEN PARA VERIFICAÇÃO

$("#tokenverify").click(function () {

$("#senha").val("");

  if ($("#tokenvalue").val() == "") {
  

    $('#msg1').show(500).html("Você deve informar um TOKEN!").delay(2000).hide(500);
    return false;

  }

  if ($("#tokenvalue").val().length <= 5 ) {

    $('#msg1').show(500).html("O TOKEN deve ter 6 digitos!").delay(2000).hide(500);
    return false;

  }

  
//################################################################################################
  
  var Wtoken = $("#tokenvalue").val();
  var Wemail = $("#email").val();
  
                      $.ajax({
              url:'https://comoestou.app.br/login/tokenverify.php',
              type:'POST',						
              data:{
                              token:Wtoken,
                              email:Wemail
                              
  
              },
              success:function (data){
                if(data != null && data == "success"){
                  $("#tokenvalue").val("");
                  $('#TokenModal').modal('hide');
                  $('#PasswordModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#passwordvalue").val("");
                }

                if(data != null && data=="blocked") {
                  $('#msg1').show(500).html("Por segurança seu usuário foi bloqueado!").delay(5000).hide(500);
                }

                var testadata = data.substring(0, 5)

                if(testadata=="error") {
                  $('#msg1').show(500).html("Token inválido!").delay(2000).hide(500);
                }


  },
              error:function(r) {
              console.log(r);
              },
  
            });
            
            
  
  
  //################################################################################################
  //--------------------------------------------------------------------------
  });

  //CADASTRA NOVA SENHA

$("#passwordverify").click(function () {

$("#senha").val("");

  if ($("#passwordvalue").val() == "") {
  

    $('#msg2').show(500).html("Você deve informar uma senha!").delay(2000).hide(500);
    return false;

  }

  if ($("#passwordvalue").val().length <= 7 ) {

    $('#msg2').show(500).html("A senha deve ter no mínimo 8 digitos!").delay(2000).hide(500);
    return false;

  }

  
//################################################################################################
  
  var Wpassword = $("#passwordvalue").val();
  var Wemail = $("#email").val();
  
                      $.ajax({
              url:'https://comoestou.app.br/login/changepass.php',
              type:'POST',						
              data:{
                              password:Wpassword,
                              email:Wemail
                              
  
              },
              success:function (data){
                if(data != null && data == "success"){
                  $('#PasswordModal').modal('hide');
                  $('#msg3').show(500).html("Sua nova senha foi cadastrada com sucesso!").delay(2000).hide(500);
                }

  },
              error:function(r) {
              console.log(r);
              },
  
            });
            
            
  
  
  //################################################################################################
  //--------------------------------------------------------------------------
  });



//VERIFICAR DADOS DO FORMULARIO DE CADASTRO

$("#signUpSubmitBtn").click(function () {
//-------------------------------------------------------------------------

if ($("#cadnome").val() != "") {

  var checkName = $("#cadnome").val();
  
  if (!checkName.match(/^[a-z\.]+ [a-z]+/i)) {
  
      $('#msg4').show(500).html("O nome está incompleto! Verifique.").delay(2000).hide(500);
      return false;

  }    
      } else {
          $('#msg4').show(500).html("Digite seu nome completo!").delay(2000).hide(500);
          return false;
      }

var testamail = $("#cademail").val();

if ($("#cademail").val() != "") {

 if(!isEmail(testamail)) {
  $('#msg4').show(500).html("Você deve digitar um email válido!").delay(2000).hide(500);
  return false;
 }
} else {
  $('#msg4').show(500).html("Você deve digitar seu email!").delay(2000).hide(500);
  return false;
}

if ($("#cadpassword").val() != "") {

  if($("#cadpassword").val().length < 8 ) {
  
          $('#msg4').show(500).html("A senha deve ter no mínimo 8 digitos!").delay(2000).hide(500);
          return false;

  }

      } else {

          $('#msg4').show(500).html("Você deve informar uma senha.").delay(2000).hide(500);
          return false;
}


if ($("#cad_password2").val() != "") {

  if($("#cad_password2").val().length < 8 ) {
  
          $('#msg4').show(500).html("A confirmação deve ter no mínimo 8 digitos!").delay(2000).hide(500);
          return false;

  }

      } else {

          $('#msg4').show(500).html("Você deve confirmar sua senha.").delay(2000).hide(500);
          return false;
}

if($("#cadpassword").val() != $("#cad_password2").val()) {

          $('#msg4').show(500).html("As senhas não são iguais! Verifique.").delay(2000).hide(500);
          return false;

}

//################################################################################################
  
var Wcadnome = $("#cadnome").val();
var Wcademail = $("#cademail").val();
var Wcadpassword = $("#cadpassword").val();

                    $.ajax({
            url:'https://comoestou.app.br/login/cadastro.php',
            type:'POST',						
            data:{
                            cadnome:Wcadnome,
                            cademail:Wcademail,
                            cadpassword:Wcadpassword

            },
            success:function (data){
              if(data != null && data == "success"){
                $('#signUpSubmitBtn').prop('disabled', true);
                $('#signUpSubmitBtn').toggleClass("btn-secondary");
                //redirect...
                window.location = "https://comoestou.app.br/painel/";
              }

              if(data != null && data == "exists"){
                $('#msg4').show(500).html("Já existe um cadastro com este email!").delay(2000).hide(500);
              }

},
            error:function(r) {
            console.log(r);
            },

          });

  //################################################################################################
  //--------------------------------------------------------------------------
});