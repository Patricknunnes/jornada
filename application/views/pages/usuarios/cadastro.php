<div class="header">
	<div class="container infos">
		<h4>Criar Usuário</h4>
		<p>Home - Usuários - Cadastrar </p>
	</div>
</div>

<div class="container card">
	<form action="<?= base_url('') ?>index.php/usuarios/store" enctype="multipart/form-data" method="post" class="cadastro mt-4">
		<div class="row mb-3"><!--Modificar creio que aqui na linha de baixo md-2 para md-3-->
			<div class="col-md-3 mt-3 justify-content-center"  style="margin-right:20px">
				<div class="rounded-circle imagePreview shadow "style="position:relative;margin-left:auto;margin-right:auto;width:150px!important;height:150px!important;"><img class="rounded-circle preview" src="<?= base_url('') ?>assets/img/img.png" alt="" /></div>
				<input class="default-btn" id="img-upload" name="img-upload" type="file" hidden>
				<button  onclick="defaultBtnActive()" type="button" id="custom-btn" class="btn mt-3">Colocar Foto</button>
			</div>

			<div class="col-md-8">
				<h5 class="mt-5 mb-5">Informações do Perfil</h5>
				<div class="form-group mt-5">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="nome" placeholder="Digite o nome: " required>
				</div>
				<div class="row">
					<div class="form-group mt-3 col-md-6">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="Email" required>
						<?php if (!empty($message)) : ?>
							<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
								<?php print_r($message); ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: none;" >
									<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
								</button>
							</div>
						<?php endif; ?>
					</div>
					<div class="form-group mt-3 col-md-6">
						<label for="funcao">Perfil</label>
						<select name="funcao" id="funcao" class="form-select">
						<option></option>
						<?php for($i=1;$i<=(count($perfil));$i++){ ?>
							<option value='<?php echo $i; ?>' ><?php echo $perfil[$i]; ?></option>
						<?php } ?>
					</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group  mt-3 col-md-12">
						<label for="datanasc">Nascimento</label>
						<input type="date" class="form-control" name="datanasc" placeholder="Data Nascimento" required>
					</div>
				</div>

				<h5 class="mt-5">Trocar senha</h5>
				<div class="row">
					<div class="form-group  mt-3">
						<label for="password">Defina senha</label>
						<input type="password" class="form-control" name="password" placeholder="" required>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col mr-5">
						<button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/usuarios" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
					</div>
					<div class="col-auto ml-auto">
						<button type="submit" class="btn btn-success">Confirmar</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<!--Colocado função defaultBtnActive() js aqui na página html-->
<script>
const defaultBtn = document.querySelector(".default-btn");
const customBtn = document.querySelector("#custom-btn");
const img = document.querySelector(".preview, .preview1");

function defaultBtnActive() {
	defaultBtn.click();
}

defaultBtn.addEventListener("change", function () {
	const file = this.files[0];
	if (file) {
		const reader = new FileReader();
		reader.onload = function () {
			const result = reader.result;
			img.src = result;
		};
		reader.readAsDataURL(file);
	}
});
</script>

