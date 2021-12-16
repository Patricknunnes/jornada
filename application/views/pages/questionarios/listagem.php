<div class="container mt-3">
	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mb-3 mr-2">
			<a href="<?= base_url('') ?>index.php/questionarios/" class="btn btn-sm btn-outline-secondary" class="btn btn-sm btn-outline-secondary"><i class="fas fa-sync-alt"></i> Atualizar Questionário </a>
		</div>
	</div>
	
	<div class="table-responsive">
		<div class="table-responsive">
			
		<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Titulo</th>
				<th scope="col">Link Planilha</th>
				<th scope="col">Usuário formr</th>
				<th scope="col">Dt. Criação</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
	
		<tbody>
		<?php $i = 0 ?>
			<?php foreach ($quiz as $quiz): ?>
				<?php $i++ ?>
				<tr>
					<td><?php echo $quiz['id_formr'] ?></td>
					<td><?php echo $quiz['titulo'] ?></td>
					<td><a href="<?php echo $quiz['link_planilha'] ?>" target="blank"><?php echo substr($quiz['link_planilha'],0,10) ?>... <i class="fa fa-external-link-square"></i></a></td>
					<td><?php echo $quiz['user_formr'] ?></td>
					<td><?php echo $quiz['date_formr'] ?></td>
					<td>
						<a href="<?= base_url() ?>index.php/questionarios/editar/<?= $quiz["id"] ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
						<?php if($quiz['ativo'] == 'S'){ ?>
							<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-<?php echo $i; ?>"><i class="fas fa-trash-alt"></i></a>
						<?php }else{ ?>
						
						<a class="btn btn-success" data-toggle="modal" data-target="#exampleModal-<?php echo $i; ?>"><i class="fas fa-check-circle"></i></a>
						<?php } ?>
						<a href="<?= base_url() ?>index.php/pesquisas/show/<?= $quiz["id_formr"] ?>" class="btn btn-secondary"><i class="fas fa-clipboard-list"></i></a>
					</td>
				</tr>


				<div class="modal fade" id="exampleModal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Exclusão de Usuário</h5>
						</div>
						<div class="modal-body">
							Deseja realmente excluir esse usuário?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Não</button>

							<a href="<?= base_url() ?>index.php/questionarios/destroy/<?= $quiz["id"] ?>" class="btn btn-danger">Sim</a>
						</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
</div>


