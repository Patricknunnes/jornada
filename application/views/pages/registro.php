<!-- https://imasters.com.br/apis-microsservicos/login-com-facebook-em-seu-site-sdk-php -->
<!-- https://developers.google.com/identity/sign-in/web/sign-in -->
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-5 bg-image" style="background-color:#e6f7ff">
			<div class="row  no-gutter">
				<div class="col-md-12 col-lg-12 " style="display: flex; align-items: center; justify-content: center;">
					<p>
						<img class="img-fluid" src="<?= base_url() ?>/assets/img/capa_login.png" />
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-7">

			<div class="login d-flex align-items-center">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-lg-6 mx-auto mt-5">
							<h3 class="login-heading" style="text-align: center;">Bem-vindo(a)! Crie uma conta:</h3>
							<?php if (!empty($message)) : ?>
								<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
									<?php print_r($message); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: none;">
										<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
									</button>
								</div>
							<?php endif; ?>
							<form method="post" action="<?= base_url() ?>index.php/login/gravar">
								<div class="form-label-group  mt-3">
									<label for="inputEmail">Seu nome:</label>
									<input type="text" name="nome" id="inputNome" class="form-control" placeholder="Nome" required autofocus>
								</div>

								<div class="form-label-group  mt-3">
									<label for="inputEmail">Seu CPF:</label>
									<input type="text" name="cpf" id="cpf" class="form-control" onkeyup=" mascaraCpf('___.___.___-__', this)" placeholder="CPF" required autofocus>
								</div>

								<div class="form-label-group  mt-3">
									<label for="inputEmail">Data de nascimento:</label>
									<input type="date" name="datanasc" id="inputDataNascimento" class="form-control" placeholder="DD/MM/AAAA" required autofocus>
								</div>

								<div class="form-label-group  mt-3">
									<label for="inputEmail">Seu e-mail:</label>
									<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
								</div>

								<div class="form-label-group mt-3">
									<label for="inputPassword">Sua senha:</label>
									<input type="password" name="password" id="inputPassword" class="form-control mb-3" placeholder="Senha" required>
								</div>

								<div class="text-center">
									<button type="submit" class="btn" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Criar conta</button>
								</div>
								<hr class="my-4">
								<!-- <button class="btn btn-google" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button> -->
								<center>
									<div id="gSignInWrapper">
										<div id="customBtn1" class="customGPlusSignIn">
											<span class="icon"></span>
											<span class="buttonText">Entrar com o Google</span>
										</div>
									</div>
									<div id="name"></div>
									<script>
										startApp1();
									</script>
								</center>
								
								<center>
									<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v11.0&appId=269594148410799&autoLogAppEvents=1" nonce="XWgDyiNR"></script>
									<button onclick="loginFB(); return false;" style="background-color: #1877f2;
                                                                border: 0px;
                                                                border-radius: 5px;
                                                                color: white;
                                                                height: 40px;
                                                                text-align: center;
                                                                width: 236px;
                                                                margin-top: 10px;
                                                                margin-bottom: 5px;
                                                                font-weight: bold;"><img class="img" style="margin-right: 11px;
                                                                margin-top: -4px;" 
                                                                src="<?= base_url()?>/assets/img/facebook_btn.png" 
                                                                alt="" width="24" height="24">Entrar com o Facebook</button>

<div id="status" hidden>
</div>
								</center>

								

								<div class="text-center  mb-3">
									<a class="button" href="<?= base_url() ?>index.php/login" style="text-decoration:none;">Possui uma conta cadastrada? Faça o login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
/*
 * 
 * reescrevendo
 */    
    
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '269594148410799',
            cookie     : true,                     // Enable cookies to allow the server to access the session.
            xfbml      : true,                     // Parse social plugins on this webpage.
            version    : 'v12.0',           // Use this Graph API version for this call.
            channelUrl : 'https://www..idor.org/channel.html'
        });


        
//        FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
//            if (response.status === 'connected') { 
//                deconect();
//            }
//
//        });
        
        
   };

   
    function loginFB() {
                
        //Verifica se já está logado
        FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
           
            if (response.status === 'connected') {
                
                statusChangeCallback(response, false);
                
            } else {
                FB.login(function(response){

                    statusChangeCallback(response, true);

                });
            }
        });
    }
    
    function checkLoginState() {               // Called when a person is finished with the Login Button.
        
        FB.getLoginStatus(function(response) {   // See the onlogin handler
            statusChangeCallback(response);
        });
    }    

    function deconect(){
        FB.logout(function(response) {
            Swal.fire("Facebook", "Usuário desconectado!" );
        });
    }

    function statusChangeCallback(response, login) {
                
        if(login) {
            titulo = 'Login Realizado!';
        } else {
            titulo = 'Usuário está logado!';
        }
        
        if (response.status === 'connected') {            
            Swal.fire({
                icon: 'question',
                title: titulo,
                html: 'Olá, percebemos que você já está conectado com sua conta Facebook.<br /><br /> ' +
                        'Se deseja continuar, clique Ok.<br />' +  
                        'Para criar ou logar com outra conta, clique em Cancelar.',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Ok"
                          
                }).then((result) => {
                    if (result.isConfirmed) {
                        testAPI();
                    } else {
                        deconect();
                    }
                });        
        } else {
            Swal.fire("Facebook", "Usuário não logou no facebook!" );
        }
    }
    
    function testAPI() {
        
        FB.api('/me', function(response) {
            storefblogin(response);
        });
    }  
    
/*
 * Antigo
 */

/*
  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    alert('statusChangeCallback');
    alert(response.authResponse);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI(response);  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    alert("checkLoginState");
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '269594148410799',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v12.0'           // Use this Graph API version for this call.
    });


//    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
//      statusChangeCallback(response);        // Returns the login status.
//    });
    
  };
 
  function testAPI(outher) {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    alert('Welcome!  Fetching your information.... ');
	
    FB.api('/me', function(response) {
	  console.log(response);
	  storefblogin(response);
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
*/
</script>
<script>
	function onSignIn(googleUser) {
		// Useful data for your client-side scripts:
		var profile = googleUser.getBasicProfile();
		console.log("ID: " + profile.getId()); // Don't send this directly to your server!
		console.log('Full Name: ' + profile.getName());
		console.log('Given Name: ' + profile.getGivenName());
		console.log('Family Name: ' + profile.getFamilyName());
		console.log("Image URL: " + profile.getImageUrl());
		console.log("Email: " + profile.getEmail());

		// The ID token you need to pass to your backend:
		var id_token = googleUser.getAuthResponse().id_token;
		console.log("ID Token: " + id_token);
	}
</script>



<script>
	function mascaraCpf(mascara, input) {
		const vetMask = mascara.split("")
		const numCpf = input.value.replace(/\D/g, "")
		const cursor = input.selectionStart
		const tecla = (window.event) ? event.keyCode : event.which

		for (let i = 0; i < numCpf.length; i++) {
			vetMask.splice(vetMask.indexOf("_"), 1, numCpf[i])
		}

		input.value = vetMask.join("")

		if (tecla != 8 && (cursor == 3 || cursor == 7 || cursor == 11)) {
			input.setSelectionRange(cursor + 1, cursor + 1)
		} else {
			input.setSelectionRange(cursor, cursor)

		}



	}
</script>




<style type="text/css">
	#customBtn1 {
		display: flex;
		background: #0d6efd;
		color: #fff;
		width: 240px;
		height: 40px;
		border-radius: 5px;
		white-space: nowrap;
		justify-content: center;
		align-items: center;
	}

	#customBtn1:hover {
		cursor: pointer;
	}

	span.label {
		font-family: serif;
		font-weight: normal;
	}

	span.icon {
		background: url('https://developers-dot-devsite-v2-prod.appspot.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
		display: inline-block;
		vertical-align: middle;
		width: 42px;
		height: 42px;
	}

	span.buttonText {
		display: inline-block;
		vertical-align: middle;
		padding-left: 10px;
		padding-right: 42px;
		font-size: 14px;
		font-weight: bold;
		/* Use the Roboto font that is loaded in the <head> */
		font-family: 'Roboto', sans-serif;
	}
</style>
