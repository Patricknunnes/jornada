<div class="header-mapas">
	<div class="container text-left mt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff; font-family: Exo, Sans-serif;"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item" style="color:#fff"><a href="<?= base_url() ?>index.php/dashboard" style="color:#fff; font-family: Exo, Sans-serif;">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page" style="color:#fff; font-family: Exo, Sans-serif;"><?php echo $title; ?></li>
			</ol>
		</nav>
	</div>
</div>
<?php
$session = $_SESSION['logged_user'];
$name = $session['name'];
$perfild = 's';
?>

<!-- <?php print_r($termos)  ?>


<?php echo $users['id']  ?> -->

<div class="container content " style="height: 100%!important">
	<div class="container text-left mt-3 pt-5 pb-5">
		<div class="row">

			<form action="<?= base_url() ?>index.php/usuarios/update/<?= $users['id'] ?>/<?php echo $perfild ?>" enctype="multipart/form-data" method="post" class="cadastro mt-4">
				<div class="row mb-3">
					<div class="col-md-2 mt-3 justify-content-center" style="margin-right: 20px;">
					
					
						<!-- <div class="rounded-circle imagePreview shadow "><img class="rounded-circle preview" src="<?php echo base_url("uploads/") . $users['img_user'] ?>" alt="" /></div> -->
						<input class="default-btn" id="img-upload" name="img-upload" type="file" hidden>
						<input type="hidden" id="d-img-upload" name="d-img-upload" value="<?php echo $users['img_user'] ?>">
						<!-- <button onclick="defaultBtnActive()" type="button" id="custom-btn" class="btn mt-3">Colocar Foto</button> -->
					</div>

					<div class="col-md-8">
						<h5 class="mt-5 mb-5" style="font-family: Exo, Sans-serif; font-weight: 600; font-size: 30px;">Informações do Perfil</h5>
						<div class="form-group mt-5">
						<?php if(strlen($message)>0){ ?>
						<div class="alert alert-warning" role="alert">
							<?php echo $message; ?>
						</div>
						<?php } ?>
							<label for="nome">Nome</label>
							<input type="text" class="form-control" name="name" value="<?php echo $users['name'] ?>" placeholder="Digite o nome: ">

						</div>
						<div class="row">
							<div class="form-group mt-3 col-md-6">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" value="<?php echo $users['email'] ?>" placeholder="Email" disabled>
							</div>
							<div class="form-group mt-3 col-md-6">
								<label for="funcao">Função</label>
								<select name="funcao" id="funcao" class="form-select" disabled>
									<option></option>
									<?php for ($i = 1; $i <= (count($perfil)); $i++) { ?>
										<option value='<?php echo $i; ?>' <?php echo $i == $users['funcao'] ? 'selected="selected"' : ''; ?>><?php echo $perfil[$i]; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="row">
							<?php foreach ($termos as $termo) { ?>
								<div class="form-group  mt-3 col-md-6">
									<label for="">Termo Status</label>
									<br>
									<input disabled class="form-control" value="<?php if ($termo['status'] == 'sc' || $termo['status'] == 'sn') {
																					echo 'Aceito';
																				} else {
																					'Não Aceito';
																				} ?>">
								</div>
								<div class="form-group  mt-3 col-md-6">
									<label for="">Data do Termo</label>
									<br>

									<input disabled class="form-control" value="<?php $datatermo = date_create($termo['data_hora']);
																				echo date_format($datatermo, 'd/m/Y');  ?>">
								</div>
							<?php } ?>
						</div>

						<div class="row">
							<div class="form-group  mt-3 col-md-6">
								<label for="datanasc">Nascimento</label>
								<input type="date" class="form-control" name="datanasc" value="<?php echo $users['datanasc'] ?>" placeholder="Data Nascimento">
							</div>
							<div class="form-group mt-3 col-md-6">
								<label for="cpf">CPF</label>
								<input type="cpf" class="form-control" name="cpf" value="<?php echo $users['cpf'] ?>" placeholder="CPF" disabled onkeyup="mascaraCpf ('___.___.___-__', this)">
							</div>
						</div>

						<h5 class="mt-5">Trocar senha</h5>
						<div class="row">
							<div class="form-group  mt-3">
								<label for="password">Senha Atual</label>
								<input type="password" class="form-control" name="password2" placeholder="">
								<label class="mt-3" for="password">Nova senha</label>
								<input type="password" class="form-control" name="password" placeholder="">
							</div>
						</div>
						<div class="row mt-5 mb-5" id="b_mobile" style="display: flex;">
							<div class="col mr-5" id="b_mobile2" style="display: flex;">
								<button type="button" class="btn" id="exo_subtitle"><a href="<?= base_url('') ?>index.php/usuarios" style="width: 200px; height: 45px; padding: 14px 68px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff; text-decoration: none;">Cancelar</a> </button>
							</div>
							<div class="col-auto ml-auto" id="b_mobile3">
								<button type="submit" class="btn" id="exo_subtitle" style="width: 200px; height: 45px; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Confirmar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>


	<style>
		@media(max-width: 768px) {
			#b_mobile {
				display: flex;
				justify-content: center;
			}

			#b_mobile2 {
				display: flex;
				justify-content: center;
				margin-bottom: 14px;
			}

			#b_mobile3 {
				display: flex;
			}
		}
	</style>