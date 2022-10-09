<div class="container mt-3">
	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mb-3 mr-2">
			<!-- <a href="<?= base_url('') ?>index.php/paginas/cadastro" class="btn btn-sm btn-outline-secondary" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Página </a> -->
		</div>
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<!-- <th scope="col">#</th> -->
				<th scope="col">Título</th>
				<th scope="col">Descrição</th>
				<!-- <th scope="col">Cores do texto</th> -->
				<!-- <th scope="col">Cores do fundo</th> -->
				<!-- <th scope="col">Questionário</th> -->
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 0 ?>
			<?php foreach ($pages as $page) : ?>
				<?php $i++ ?>
				<tr>
					<!-- <td><?php echo $page['id'] ?></td> -->
					<td><?php echo $page['titulo'] ?></td>
					<td><?php echo $page['descricao'] ?></td>
					<!-- <td><?php echo $page['cor-texto'] ?></td> -->
					<!-- <td><?php echo $page['cor_desc'] ?></td> -->
					<!-- <td><?php echo $page['questionario'] ?></td> -->
					<td>
						<a href="<?= base_url() ?>index.php/paginas/editar/<?= $page["id"] ?>" class="btn btn-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
						<a href="<?= base_url() ?>index.php/paginas/destroy/<?= $page["id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-<?php echo $i; ?>" title="Excluir"><i class="fas fa-trash-alt"></i></a>
					</td>
				</tr>

				<div class="modal fade" id="exampleModal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Exclusão de Pagina</h5>
						</div>
						<div class="modal-body">
							Deseja realmente excluir essa página?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Não</button>

							<a href="<?= base_url() ?>index.php/paginas/destroy/<?= $page["id"] ?>" class="btn btn-danger">Sim</a>
						</div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>

