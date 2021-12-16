<div class="header">
	<div class="container infos">
		<h4>Cadastrar Páginas</h4>
		<p>Home - Páginas - Editar </p>
	</div>
</div>
<div class="container">
	<div class="card">
		<div class="cadastro">
			<form action="<?= base_url() ?>index.php/questionarios/update/<?= $quiz['id'] ?>" enctype="multipart/form-data" method="post">
				<h5>Páginas</h5>
				<div class="form-group mt-5">
					<label for="nome">Título</label>
					<input type="text" id="titulo" name="titulo" class="form-control" id="titulo" value="<?php echo $quiz['titulo'] ?>" placeholder="Digite o título: ">
				</div>
				<div class="form-group mt-5">
					<label for="nome">Link planilha google</label>
					<!-- <input type="text" name="link_planilha" class="form-control" id="link_planilha" value="<?php echo $quiz['link_planilha'] ?>" placeholder="Digite o título: "> -->
					<br />
					<a href="<?php echo $quiz['link_planilha'] ?>" title="<?php echo $quiz['link_planilha'] ?>" target="blank"><?php echo substr($quiz['link_planilha'],0,100) ?> <i class="fa fa-external-link-square"></i></a>
				</div>

				<div class="row justify-content-between mt-5">
					<div class="col mr-5">
						<button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/questionarios" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary">Gravar</button>
					</div>
				</div>
		</div>
		</form>
	</div>

</div>


<div class="container register">


</div>
