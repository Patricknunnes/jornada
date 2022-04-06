<!-- https://imasters.com.br/apis-microsservicos/login-com-facebook-em-seu-site-sdk-php -->
<!-- https://developers.google.com/identity/sign-in/web/sign-in -->
<div class="container-fluid pb-3">
	<div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-5 bg-image" style="background-color:#e6f7ff">
			<div class="row  no-gutter"  >
				<div class="col-md-12 col-lg-12 " style="margin-top:20px; display:flex; align-items: center; justify-content: center;">
					<p style="display:flex; align-items: center; justify-content: center;">
					<img class="img-fluid" src="<?= base_url()?>/assets/img/capa_login.png" style="width: 90%!important ;" />	
					</p>
				</div>
			</div>	
		</div>
		<div class="col-md-8 col-lg-7" >
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-lg-6 mx-auto">
							<h3 class="login-heading mb-4" style="text-align: center;">Bem-vindo(a)! Faça login ou crie uma conta</h3>
							<?php if ($message && empty($successLogin)) : ?>
								<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
									<?php print_r($message); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: none;" >
										<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
									</button>
								</div>
							<?php endif; ?>

							<?php if ($successLogin) : ?>
								<div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
									<?php print_r($successLogin); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: none;" >
										<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
									</button>
								</div>
							<?php endif; ?>
							<form method="post" action="<?= base_url()?>index.php/login/store">
								<div class="form-label-group">
									<label for="inputEmail">Seu e-mail</label>
									<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
								</div>

								<div class="form-label-group  mt-3">
									<label for="inputPassword">Sua senha</label>
									<input type="password" name="password" id="inputPassword" class="form-control mb-3" placeholder="Senha" required>
								</div>

								<div class="text-center">
									<button type="submit" class="btn" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Entrar</button>
								</div>


								<hr class="my-4">
								<!-- <button class="btn btn-google" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button> -->
								<center>
								<div id="gSignInWrapper" style="margin-bottom: 10px;" >
									<div id="customBtn" class="customGPlusSignIn">
									<span class="icon"></span>
									<span class="buttonText">Entrar com o Google</span>
									</div>
								</div>
								<div id="name"></div>
								<script>startApp();</script>

								</center>
								<center>
								  <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" onclick="checkLoginState();" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" style="
												border-radius: 5px;
												color: white;
												height: 40px;
												text-align: center;
												width: 100%;
												margin-top: 10px;
    										margin-bottom: 5px;
												" 
												></div>
								<!-- <div id="fb-root" hidden></div>  -->
									<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v11.0&appId=269594148410799&autoLogAppEvents=1" nonce="XWgDyiNR"></script> -->
								
								 <!-- <fb:login-button class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();"  style="
												border-radius: 5px;
												color: white;
												height: 40px;
												text-align: center;
												width: 100%;
												margin-top: 10px;
    										margin-bottom: 5px;
												" ></fb:login-button> -->

<!-- <div id="status">
</div> -->
								<!-- <div id="fb-root"></div>
									<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v12.0&appId=269594148410799&autoLogAppEvents=1" nonce="LZ4QIIXP"></script>
									<div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div>
								<button class="btn btn-facebook mt-3 mb-3" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
								</center>
								<div class="text-center" style="margin-top: 14px;">
									<a class="button" href="<?= base_url()?>index.php/login/register" style="text-decoration:none;">Criar conta</a>  | <a class="button" href="<?= base_url()?>index.php/login/forgot" style="text-decoration:none;">Esqueci minha senha</a>
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

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
 //   console.log(response);  
	
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
		if (confirm("Você esta conectado pelo facebook na aplicação deseja continuar ? ")) {
			testAPI();  
			} else {
				deconect();		
			}
      
    } else {                                 // Not logged into your webpage or we are unable to tell.
      console.log('Desconectado');
    }
  }


  function checkLoginState() { 
	alert('Checando');                 // Called when a person is finished with the Login Button.
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


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
  function deconect(){
	FB.logout(function(response) {
		checkLoginState();

		// Person is now logged out
		});
  }
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
	
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
	  alert('Conectando pelo facebook');
	  fblogin(response);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

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
	  <style type="text/css">
    #customBtn {
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
    #customBtn:hover {
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
			font-size: 16px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
  </style>