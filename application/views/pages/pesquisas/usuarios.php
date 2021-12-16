<div class="container mt-3">
	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mb-3 mr-2">
			<a href="<?= base_url('') ?>index.php/questionarios/" class="btn btn-sm btn-outline-secondary" class="btn btn-sm btn-outline-secondary"><i class="fas fa-sync-alt"></i> Atualizar Questionário </a>
		</div>
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Criado em</th>
				<th scope="col">Modificado em</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($respostas as $resposta) : ?>
				<tr>
					<td><?php echo $resposta['session_id'] ?></td>
                    <td><?php echo $resposta['created'] ?></td>
                    <td><?php echo $resposta['modified'] ?></td>
					<td>
						<a href="<?= base_url() ?>index.php/pesquisas/respostas/<?= $id_page ?>/<?= $resposta["session_id"] ?>" class="btn btn-info"><i style="color: #fff" class="fas fa-eye"></i></a>
						<a href="<?= base_url() ?>index.php/pesquisas/pdf/<?= $id_page ?>/<?= $resposta["session_id"] ?>" class="btn btn-secondary"><i class="fas fa-clipboard-list"></i></a>
					</td>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>

