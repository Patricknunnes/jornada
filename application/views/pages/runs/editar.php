<div class="header">
	<div class="container infos">
		<h4>Cadastrar Pesquisas</h4>
		<p>Home - Pesquisas - Editar </p>
	</div>
</div>
<div class="container">
	<div class="card">
		<div class="cadastro">
			<form action="<?= base_url() ?>index.php/runs/update/<?php echo $pages[0]->run_id; ?>" enctype="multipart/form-data" method="post">
				<h5>Pesquisas</h5>
				<div class="form-group mt-5">
					<label for="nome">Título</label>
					<input type="text" id="titulo" name="titulo" class="form-control" id="titulo" value="<?php echo $pages[0]->run_titulo; ?>" placeholder="Digite o título: ">
				</div>
				<div class="form-group mt-5">
					<label for="nome">Descrição</label>
					<input type="text" id="descricao" name="descricao" class="form-control" id="descricao" value="<?php echo $pages[0]->run_descricao; ?>" placeholder="Digite o título: ">
				</div>
				<div class="form-group mt-5">
					<label for="nome">Link pesquisa formR</label>
					<br />
					<a class="btn btn-secondary" target="_blank" href="<?= base_url() ?>index.php/pesquisas/index/<?= $pages[0]->run_id;  ?>" title="pesquisa" target="blank">Abrir <i class="fa fa-external-link-square"></i></a>
				</div>

				<div class="row justify-content-between mt-5">
					<div class="col mr-5">
						<button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/runs" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
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
