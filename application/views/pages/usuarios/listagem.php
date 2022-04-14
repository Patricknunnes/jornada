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
		<div class="btn-group mb-3 mr-2">
			<a href="<?= base_url('') ?>index.php/usuarios/cadastro" class="btn btn-sm btn-outline-secondary" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Usuário </a>
		</div>
	</div>
	<div></div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nome</th>
				<th scope="col">Email</th>
				<th scope="col">Termo</th>

				<th style="margin-right:5px" scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 0 ?>
			<?php foreach ($users as $user) { ?>
				<?php $i++ ?>
				<tr>
					<td><?php echo $user['id'] ?></td>
					<!--Modificando a primeira letra em maiúsculo-->
					<td style="text-transform: capitalize!important;"><?php echo $user['name'] ?></td>

					<td><?php echo $user['email'] ?></td>

					<?php 
                                            $achado = 0;
                                            foreach ($termos as $termo) { ?>
						<?php if ($termo['id_user'] == $user['id']) { ?>
							<td>
								<?php if ($termo['status'] == 'sc') {
									echo 'Termo aceito e ser contatado.';
								} ?>
								<?php if ($termo['status'] == 'sn') {
									echo 'Termo aceito e contato não aceito.';
								} ?>
								<?php if ($termo['status'] == 'n') {
									echo 'Termo não aceito.';
								} ?>
							</td>
						<?php 
                                                    $achado = 1;
                                                    } ?>
					<?php } ?>
                                                        
                                        <?php if ( $achado == 0){ ?>
                                                        <td> &nbsp;</td>          
                                        <?php } ?>               

					<td>
						<a href="<?= base_url() ?>index.php/usuarios/editar/<?= $user["id"] ?>" class="btn btn-warning mb-2 mt-2"><i class="fas fa-pencil-alt"></i></a>
						<a href="<?= base_url() ?>index.php/usuarios/destroy/<?= $user["id"] ?>" class="btn btn-danger" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-<?php echo $i; ?>"><i class="fas fa-trash-alt"></i></a>
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

								<a href="<?= base_url() ?>index.php/usuarios/destroy/<?= $user["id"] ?>" class="btn btn-danger">Sim</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</tbody>
	</table>
</div>
