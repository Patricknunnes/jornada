<div class="container mt-3">
	<?php if ($success) : ?>
		<div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
			<?php print_r($success); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: none;">
				<span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
			</button>
		</div>
	<?php endif; ?>    
	<div class="btn-toolbar mb-2 mb-md-0">
		<!-- <div class="btn-group mb-3 mr-2">
			<a href="<?= base_url('') ?>index.php/questionarios/" class="btn btn-sm btn-outline-secondary" class="btn btn-sm btn-outline-secondary"><i class="fas fa-sync-alt"></i> Atualizar Pesquisas </a>
		</div> -->
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Titulo</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
                        <?php $i = 0 ?>
			<?php foreach ($pages as $page): ?>
                                <?php $i++ ?>
				<tr>
					<td><?php echo $page->run_id; ?></td>
					<td><?php echo $page->run_titulo; ?></td>
					<td>
						<a href="<?= base_url() ?>index.php/runs/editar/<?= $page->run_id; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
						<a href="<?= base_url() ?>index.php/pesquisas/show/<?= $page->run_id ?>" class="btn btn-secondary"><i class="fas fa-clipboard-list"></i></a>
                                                <a href="#" class="btn btn-danger" class="btn btn-danger" data-toggle="modal" data-target="#runModal-<?php echo $i; ?>"><i class="fas fa-trash-alt"></i></a>
					</td>
				</tr>
				<div class="modal fade" id="runModal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="runModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="runModalLabel">Exclusão de Usuário</h5>
							</div>
							<div class="modal-body">
								Deseja realmente excluir essa Pesquisa?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">Não</button>

								<a href="<?= base_url() ?>index.php/runs/destroyRun/<?= $page->run_id ?>" class="btn btn-danger">Sim</a>
							</div>
						</div>
					</div>
				</div>
                                
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
