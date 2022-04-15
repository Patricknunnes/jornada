<!-- https://imasters.com.br/apis-microsservicos/login-com-facebook-em-seu-site-sdk-php -->
<!-- https://developers.google.com/identity/sign-in/web/sign-in -->
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="d-none d-md-flex col-md-2 col-lg-4 bg-image" style="background-image: url('<?= base_url() ?>/assets/img/capa_login.png');">

		</div>
		<div class="col-md-10 col-lg-8">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-lg-6 mx-auto">
							<h3 class="login-heading mb-4">Redefinir senha</h3>
							<form method="post" action="<?= base_url() ?>index.php/login/forgot_request" id="form-forgot">
								<div class="form-label-group  mt-3">
									<label for="inputEmail">Seu e-mail</label>
									<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
								</div>

								<div class="text-center my-4">
									<button type="button" onclick="forgot()" class="btn" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Enviar</button>
								</div>
								<hr class="my-4">
								<!-- <button class="btn btn-google" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button> -->
								<div class="text-center mt-3">
									<a class="button" href="<?= base_url() ?>index.php/login" style="text-decoration:none;">Voltar</a>
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


	function forgot() {
            
            if ( ($("#inputEmail").val()).trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Informar o email!'
                });
            } else {
		$.ajax({
			url: '<?php echo $this->config->base_url(); ?>index.php/login/forgot_request',
			type: "POST",
			data: $("#form-forgot").serialize(),
			success: function(data) {
                            
				if (data == 'success') {

					Swal.fire({
						icon: 'success',
						title: 'Sua nova senha foi enviada com sucesso',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '<?php echo $this->config->base_url(); ?>index.php/login';
						}
					})

				} else if (data == 'social'){
                                
					Swal.fire({
						icon: 'error',
						title: 'O email informado é usado no login do Gmail.<br />Não pode se alterado.',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = "";
						}
					})
                                
                                } else {
					Swal.fire({
						icon: 'error',
						title: 'Não foi possível enviar esse <span style="white-space: nowrap;">e-mail</span>'
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = "";
						}
					})
				}

			},

		})
            }
	}
</script>
