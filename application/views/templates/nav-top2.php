<nav class="navbar navbar-expand-xl navbar shadow" style="background-color:#32549b">
	<div class="container">
		<!-- <a href="<?= base_url('') ?>index.php/dashboard" class="navbar-brand" style="color:#fff" ><img class="img-fluid" width="30%" src="<?= base_url()?>/assets/img/logo-idor-fundo-escuro.png" /></a> -->
		<a class="navbar-brand" href="<?= base_url('') ?>index.php/dashboard"><img width="100" height="45" src="<?= base_url()?>/assets/img/logo.png" /></a>
		<button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false" style="color:#fff">
			<i class="fas fa-bars" style="color: #fff"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav">
				<a class="nav-link" style="color:#fff" href="<?= base_url('') ?>index.php/dashboard/">Jornada de Autoconhecimento</a>
				<a class="nav-link" style="color:#fff" href="<?= base_url('') ?>index.php/dashboard/feedback/<?php echo $_SESSION['logged_user']['id']; ?>">Contato</a>
				<a class="nav-link" target="_blank" style="color:#fff" href="https://saudemental.idor.org/">Portal de Saúde Mental</a>
			</div>
			 <div class="navbar-nav" style="margin-left: auto !important;">
				<div class="nav-item dropdown">
					<a href="#" data-toggle="dropdown" class="nav-link user-action" aria-expanded="false" style="color:#fff;text-transform:capitalize!important;">
						<?php echo $_SESSION['logged_user']['name'] ?>
						<!-- <img class="rounded-circle" style="height: 30px; width: 35px; margin-left: 10px;" src="<?php echo base_url("uploads/") .$_SESSION['logged_user']['img_user'] ?>" class="avatar" alt="Avatar"> -->
					</a>
					<div class="dropdown-menu">
						<a href="<?= base_url('') ?>index.php/dashboard/perfil/<?php echo $_SESSION['logged_user']['id']; ?>" class="dropdown-item"><i class="fa fa-user-o"></i> Minha conta</a>
						<div class="dropdown-divider"></div>
						<a href="<?= base_url('') ?>index.php/login/logout" class="dropdown-item" style="display: flex; align-items: center;"><img src="<?= base_url('') ?>assets/img/icones/log-out.svg" alt="" style="width: 14px; height: 16px;margin-right: 3px;">Logout</a>
					</div>
				</div>
			</div> 
		</div>
	</div>
</nav>
