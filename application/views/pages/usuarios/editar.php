<div class="header">
	<div class="container infos">
		<h4>Editar Usuário</h4>
		<p>Home - Usuários - Editar </p>
	</div>
</div>
<br >

<?php $perfild = 'n' ?>

<div class="container card">

	<form action="<?= base_url() ?>index.php/usuarios/update/<?= $users['id'] ?>/<?php echo $perfild ?>" enctype="multipart/form-data" method="post" class="cadastro mt-4">
		<div class="row mb-3">
			<div class="col-md-2 mt-3 justify-content-center" style="margin-right: 20px;">
				<!-- <div class="rounded-circle imagePreview shadow "><img class="rounded-circle preview" src="<?php echo base_url("uploads/") . $users['img_user'] ?>" alt="" /></div> -->
				<input class="default-btn" id="img-upload" name="img-upload" type="file" hidden>
				<input type="hidden" id="d-img-upload" name="d-img-upload" value="<?php echo $users['img_user'] ?>">
				<!-- <button onclick="defaultBtnActive()" type="button" id="custom-btn" class="btn mt-3">Colocar Foto</button> -->
			</div>

			<div class="col-md-8">
				<h5 class="mt-5 mb-5">Informações do Perfil</h5>
				<div class="form-group mt-5">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="name" value="<?php echo $users['name'] ?>" placeholder="Digite o nome: ">

				</div>
				<div class="row">
					<div class="form-group mt-3 col-md-6">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $users['email'] ?>" placeholder="Email">
					</div>
					<div class="form-group mt-3 col-md-6">
						<label for="funcao">Função</label>
						<select name="funcao" id="funcao" class="form-select">
						<option></option>
						<?php for($i=1;$i<=(count($perfil));$i++){ ?>
							<option value='<?php echo $i; ?>'<?php echo $i==$users['funcao'] ? 'selected="selected"' : ''; ?> ><?php echo $perfil[$i]; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group  mt-3 col-md-12">
						<label for="datanasc">Nascimento</label>
						<input type="date" class="form-control" name="datanasc" value="<?php echo $users['datanasc'] ?>" placeholder="Data Nascimento">
					</div>
				</div>

				<h5 class="mt-5">Trocar senha</h5>
				<div class="row">
					<div class="form-group  mt-3">
						<label for="password">Defina senha</label>
						<input type="password" class="form-control" name="password" placeholder="">
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
