<div class="header-mapas">
	<div class="container text-left mt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff; font-family: exo, sans-serif;"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard" id="exo_subtitle" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page" id="exo_subtitle" style="color:#fff"><?php echo $title; ?></li>
			</ol>
		</nav>
	</div>
</div>
<?php
$session = $_SESSION['logged_user'];
$name = $session['name'];
?>
<div class="container content " style="padding-top: 9px; height: 100%!important">
	<div class="container text-left mt-5 pt-1 pb-5">
		<form action="<?= base_url('') ?>index.php/dashboard/send_mail" enctype="multipart/form-data" method="post">
			<div class="container text-left mt-5">
				<h5 class="mt-5 mb-5 mt-5" style="font-weight:bold; font-family: Exo, Sans-serif; font-size: 30px; text-align: center;">Enviar sua mensagem</h5>
				<div class="form-group mt-5" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
					<label class="col-6" for="nome" id="poppins_title">Escreva seu feedback, mensagem ou sugestão para nós</label>
					<textarea class="form-control" name="texto" style="width: 50%; height: 120px; margin-top: 14px;" required></textarea>
				</div>
			</div>
			<div class="row mt-3" style="display: flex; justify-content: center">
				<div class="col-auto mr-5">
					<button type="submit" class="button-pesquisas mt-5" id="exo_subtitle" style="background: #2C234D; padding: 7px 63px; border-radius: 30px; color: #fff;">Enviar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	function start(id) {
		for (i = 1; i <= id; i++) {
			$('#st' + i).css('background-color', 'yellow');
		}
	}
</script>

<style>
	@media(max-width: 1000px) {
		#poppins_title {
			width: 100%;
			text-align: center;
		}

		.form-control {
			width: 100%!important;
		}
	}
</style>
