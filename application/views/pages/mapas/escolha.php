<div class="header-mapas">
	<div class="container text-left mt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff; font-family: exo, sans-serif;"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard" id="exo_subtitle" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page" style="color:#fff;"><?php echo $title; ?></li>
			</ol>
		</nav>
	</div>
</div>
<?php
$session = $_SESSION['logged_user'];
$name = $session['name'];
?>
<div class="container content " id="d24" style="height: auto!important">
	<div class="container text-left mt-5 pt-5 pb-5">
		<form action="Javascript:Void(0)" method="POST" id="form-escolha">
			<div class="container text-left mt-5">
				<h5 class="mt-5 mb-5 mt-5" id="exo_subtitle" style="text-align: justify; font-size: 20px; font-weight: bold;">Personalize sua trilha de autoconhecimento escolhendo a ordem das regiões conforme sua preferência: a região número 1 aparecerá primeiro, enquanto que a região número 5 aparecerá por último</h5>
				<div class="perguntas mt-5" id="perguntas" style="margin-left: 0px!important; margin-right: 0px!important">
					<?php foreach ($tipos as $key => $tp) {  	?>
						<div class="perguntas-1">
							<div class="perguntas-container">
								<p class="text-1" style="font-weight: bold;text-align: center; width: 100%;">
									<img class="img-regiao mt-4" src="<?= base_url('') ?>assets/img/<?php echo $tp['icone']; ?>" alt="" alt="">
								</p>
								<p class="text-1" id="poppins_title" style="font-weight: bold; text-align: center;"> <?php echo $tp['titulo']; ?></p>
							</div>
							<div class="text-1" style="font-weight: bold; width: 100%">
								<select name="ordem_<?php echo $key; ?>" id="ordem<?php echo $key; ?>" class="form-select" style="width: 100%;">
									<option></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>

							</div>
							<hr>
						</div>
					<?php } ?>
					<div class="alert alert-light msg-tipo" role="alert" id="msg-tipo">
					</div>
				</div>
			</div>
			<div class="row" style="justify-content: center">
				<div class="col-auto mr-5">
					<div class="alert alert-danger" role="alert" id="msg-avanca" style="display:none">
					</div>
					<div class="mb-4" id="buttons_alinhar">
						<button type="button" class="btn" id="exo_subtitle" style="padding: 10px 40px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;" onclick="javascript:limpar()">Cancelar</button>
						<button type="button" class="btn" id="exo_subtitle" style="padding: 10px 40px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;" onclick="javascript:gravar2()">Avançar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$('.msg-tipo').hide();

	function gravar2() {
		$(function() {
			$.ajax({
				url: '<?php echo $this->config->base_url(); ?>index.php/regioes/store2/',
				type: "POST",
				data: $("#form-escolha").serialize(),
				success: function(data) {
					$('#msg-tipo').html(data);
					$('#msg-tipo').show();

					if (data == 'Já existe uma região nesta ordem, por favor, escolha outra') {
						return 0;
					}
					if (data == 'index.php/dashboard') {
						window.location.href = '<?php echo $this->config->base_url(); ?>' + data;
					}
				}
			});
		});
	}

	function gravar(tipo, ordem) {
		$(function() {
			$.ajax({
				url: '<?php echo $this->config->base_url(); ?>index.php/regioes/store/',
				type: "POST",
				data: "tipo=" + tipo + '&ordem=' + ordem + '&usu=<?php echo  $session['id']; ?>',
				success: function(data) {

					$('#msg-tipo').html(data);
					$('#msg-tipo').show();
					$('#ordem').attr("disabled", "disabled");

					if (data == 'Já existe uma região nesta ordem, por favor, escolha outra') {
						$('#ordem' + ordem).removeAttr('disabled');
					}
				}
			});
		});
	}
	$("#msg-avanca").hide();

	function go() {
		$(function() {
			$.ajax({
				url: '<?php echo $this->config->base_url(); ?>index.php/regioes/validate/<?php echo  $session['id']; ?>',
				type: "POST",
				data: "",
				success: function(data) {
					if (data != 'go') {
						$("#msg-avanca").html(data);
						$("#msg-avanca").show();
					} else {
						window.location.href = "<?= base_url('') ?>index.php/dashboard";
					}
				}
			});
		});
	}

	function limpar() {
		$(function() {
			$.ajax({
				url: '<?php echo $this->config->base_url(); ?>index.php/regioes/cancelar/<?php echo  $session['id']; ?>',
				type: "POST",
				success: function(data) {
					if (data != 'go') {
						$("#msg-avanca").html(data);
						$("#msg-avanca").show();
					} else {
						window.location.href = "<?= base_url('') ?>index.php/dashboard/escolha";
					}
				}
			});
		});
	}
</script>

<style>
	.perguntas-container {
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		text-align: center;
		height: 100%;
		width: 250px;
	}

	.perguntas-1 {
		display: flex;
		align-items: center;
		justify-content: space-between;
		height: 100%;
		width: 50%;
		cursor: initial !important;
		margin-left: -5%;
	}

	#perguntas {
		display: flex;
		align-items: center;
		flex-direction: column;
		justify-content: center;
	}

	#buttons_alinhar {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 20px;
	}

	#buttons_alinhar button {
		margin-left: 20px;
		margin-right: 20px;
	}


	@media(max-width: 750px) {
		.perguntas-1 {
			width: 100%;
			flex-direction: column;
			margin-left: 0%;
		}

		#d24 {
			margin-bottom: 0 !important;
			border-bottom-left-radius: 0 !important;
			border-bottom-right-radius: 0 !important;
		}

		.text-1 .form-select {
			width: 100% !important;
		}
	}
</style>
