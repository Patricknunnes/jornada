<div class="header">
	<div class="container infos">
		<h4>Editar Região</h4>
		<p>Home - Região - Editar </p>
	</div>
</div>
<div class="container">
	<div class="card">
		<div class="cadastro1">
			<form action="<?= base_url('') ?>index.php/paginas/update/<?= $pages['id'] ?>" enctype="multipart/form-data" class="" method="post">
				<h5>Região</h5>
				<div class="form-group mt-5">
					<label for="nome">Título</label>
					<input type="text" class="form-control" name="titulo" value="<?php echo $pages['titulo'] ?>" id="titulo" placeholder="Digite o título: ">
				</div>
				<div class="form-group mt-5">
					<label for="descricao">Descrição List</label>
					<textarea class="form-control" cols="10" id="descricao" name="descricao"><?php echo $pages['descricao'] ?></textarea>
				</div>
				<div class="form-group mt-5">
					<label for="dash_descricao">Descrição Dashboard</label>
					<textarea class="form-control" cols="10" id="dash_descricao" name="dash_descricao"><?php echo $pages['dash_descricao'] ?></textarea>
				</div>
				<?php /*<!-- <div class="form-group mt-5">
					<label for="questionario">Tipos</label>
					<select name="tipo" id="tipo" class="form-select">
						<option></option>
						<?php for($i=1;$i<=(count($tipo));$i++){ ?>
							<option value='<?php echo $i; ?>' <?php echo $i==$pages['tipo'] ? 'selected="selected"' : ''; ?>><?php echo $tipo[$i]; ?></option>
							<?php } ?>
					</select>
					
				</div> -->*/ ?>
				<div class="form-group mt-5">
					<label for="link_formr">Pesquisa FormR</label>
					<select name="link_formr" id="link_formr" class="form-select">
						<option></option>
						<?php foreach($quiz as $pf){ ?>
							<option value="<?php echo $pf->run_id; ?>"   ><?php echo $pf->run_titulo; ?> </option>
						<?php } ?>
					</select>
					<button type="button" class="btn btn-primary mt-2" onclick="javascript:adicionarPesquisa(<?php echo $pages['id']; ?>)" >Adicionar</button>		
				</div>
				<div class="row mt-5">
						<div class="alert alert-success mb-2" id="msg-delete-regiao" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
							Deletado com sucesso!
								<button type="button" onclick="javascript:fecharalert()" style="background: transparent; border: none; font-family: Poppins;" >
									<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
								</button>
						</div>
					<table class="table">
						<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Pesquisa</th>
							<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody id="table-page">
							<?php 
								foreach( $questionarios as $questionario){ 
							?>
							<tr id="<?php echo $questionario->id; ?>">

								<th class="col-4" scope="row"><?php echo $questionario->id; ?></th>
								<td class="col-4"><?php echo $questionario->run_titulo; ?></td>
								<td class="col-4">
                                                                    <a href="<?= base_url() ?>index.php/paginas/editarPesquisa/<?= $pages['id']; ?>/<?= $questionario->id; ?>" class="btn btn-warning" title="Configurar"><i class="fas fa-gear"></i></a>
                                                                    <a onclick="javascript:deletarRegiaoPage(<?= $questionario->id; ?>, <?= $pages['id']; ?>)" class="btn btn-danger"  title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                                                </td>
							</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>	
				<!-- <div class="row">
					<div class="form-group mt-5 col-2">
						<label for="cor-texto">Cores do texto</label>
						<input type="color" name="cor-texto" id="cor-texto" value="<?php echo $pages['cor-texto'] ?>" class="form-control">
					</div>
					<div class="form-group mt-5 col-2">
						<label for="cor-desc">Cores do fundo</label>
						<input type="color" name="cor_desc" id="cor_desc" value="<?php echo $pages['cor_desc'] ?>" class="form-control">
					</div>
				</div> -->

				<!-- <div class="form-group mt-5">
					<label for="questionario">Questionário</label>
					<input list="browsers" name="questionario" class="form-control" value="<?php echo $pages['questionario'] ?>" id="questionario">
					<datalist id="browsers">			
					</datalist>
				</div> -->

				<div class="row justify-content-between mt-5">
					<div class="col mr-5">
						<button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
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
