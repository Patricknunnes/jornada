<div class="container mt-3">
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
			<?php foreach ($pages as $page): ?>
				<tr>
					<td><?php echo $page->run_id; ?></td>
					<td><?php echo $page->run_titulo; ?></td>
					<td>
						<a href="<?= base_url() ?>index.php/runs/editar/<?= $page->run_id; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
						<a href="<?= base_url() ?>index.php/pesquisas/show/<?= $page->run_id ?>" class="btn btn-secondary"><i class="fas fa-clipboard-list"></i></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
