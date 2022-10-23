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
<div class="container content " style="height: 100%!important">
	<div class="container text-left mt-3 pt-5 pb-5">
		<div class="row">
			<div class="row-container-img">
				<!--width alterado de 80% para 70%-->
				<div class="col-9 text-center" id="texte55">
					<p class="mt-5" id="exo_title">Bem-vindo(a)!</p>
					<!--Melhorando a intensidade da fonte-->
					<div class="mt-5">
						<p class="text-1" id="poppins_text">
							<span id="poppins_title" style="color: #424f8b; text-transform:capitalize;"><?php echo $name; ?></span>, este é o seu mapa. Ele irá te guiar durante a sua expansão de autoconhecimento.
						</p>
						<p class="text-1" id="poppins_text" style="margin-top: -10px">
							Vamos conquistar novas regiões agora mesmo?
						</p>
						<p class="text-1" style="margin-top: -6px;">
							<span id="poppins_title" style="color: #424f8b;"> <i class="fas fa-trophy"></i> 5 regiões</span> estão disponíveis para você conquistar, <span id="poppins_title" style="color: #424f8b;">você já completou
								<?php $i = 0 ?>

								<?php foreach ($percent as $ret) { ?>
									<?php if ($ret == 100) { ?>
										<?php $i++; ?>
									<?php } ?>
								<?php } ?>

								<?php echo $i; ?>.
							</span>
						</p>
						<p class="text-1" id="poppins_text" style=" margin-top: -10px;">
							Para <span id="poppins_title" style="color: #424f8b;"> conquistar uma região</span> você precisa <span id="poppins_title" style="color: #424f8b;">responder todas </span><span id="poppins_title" style="color: #424f8b;">as pesquisas</span> que fazem parte daquela área.
						</p>
						<br>
						<p class="text-1" id="poppins_text" style=" margin-top: -10px;">
						    Ao conquistar uma região você desbloqueia o Dashboard com todos os gráficos daquela área.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12">
				<p class="text-2" style=" margin-top: -10px">
				<div id="row-img" style="text-align: center;">
					<img class="img-fluid" src="<?= base_url('') ?>assets/img/mapa.png" alt="" style="width: 80%!important; text-align: center">

					<?php
					$i = 0;
					foreach ($regioes as $regiao) {
						$i++;
					?>

						<div class="div-regioes-<?php echo $i; ?>">

							<img src="<?= base_url('') ?>assets/img/<?php echo  $tipos[$regiao->tipo]['icone']; ?>" onclick="javascript:onContinuar(<?php echo $regiao->tipo ?>);" style="cursor: pointer;">
							<p class="textItens-<?php echo $i; ?>"><?php print_r($tipos[$regiao->tipo]['titulo']) ?></p>

						</div>


					<?php } ?>


				</div>
				</p>
				<p class="text-1" id="poppins_text" style="margin-left: 20px; color: #989999; margin-top: 80px;">
					Regiões em andamento:
				</p>
			</div>
		</div>

		<div class="container" style="margin-top: 50px; text-align: center;">
			<div class="row">
				<?php
				$i = 0;
				foreach ($regioes as $regiao) {
                                    $i++; 
                                    
                                    foreach ($pages as $page) {
                                        if ($page['id'] == $regiao->tipo) { 
                                            $atuPage =  $page;
                                        }
                                    }
                                    // Recupera a quantidade exibida para o usuário
                                    foreach( $pagesux as $pagesuxAtu)  {
                                        if ($pagesuxAtu["id_pages"]==$atuPage['id']){
                                            $puu = $pagesuxAtu;
                                        }
                                    }
                                    ?>

					<div class="pesquisas col-sm" id="poppins_title" style="margin-right: 30px;" >

                                    <?php
                                    if (($atuPage['qtd_exibicao'] == 0) || ( $puu['cont_exibicao'] <= $atuPage['qtd_exibicao'] )) {
                                    ?>
                            <div id="bl<?php echo $atuPage['id']; ?>" class="balao-qd <?php 
                            if ($atuPage['momento_exibicao'] == 1){
                                echo " balao-d-none ";
                            }
                            ?>" >
                                <div class="balao-texto">
                                    <span><?php echo $atuPage['texto_balao']; ?></span>
                                </div>
                            </div>
                                    <?php }?>

						<img class="img-valores" src="<?= base_url('') ?>assets/img/<?php echo  $tipos[$regiao->tipo]['icone']; ?> ">

						<h5 class="mt-4" style="font-family: Exo, Sans-serif; font-weight: bold;"><?php print_r($tipos[$regiao->tipo]['titulo']) ?></h5>
						<p id="poppins_text" class="text-235"
                                                <?php 
                                                if (($atuPage['momento_exibicao'] == 1) &&
                                                    (
                                                        ($atuPage['qtd_exibicao'] == 0) 
                                                        || ( $puu['cont_exibicao'] <= $atuPage['qtd_exibicao'] )
                                                    )
                                                ){
                                                echo " onmouseenter='document.getElementById(\"bl" . $atuPage['id'] . "\").classList.remove(\"balao-d-none\") '";
                                                echo " onmouseout='document.getElementById(\"bl" . $atuPage['id'] . "\").classList.add(\"balao-d-none\")' ";
                                                }
                                                ?>                                                   
                                                   >
							<?php foreach ($pages as $page) {   ?>
								<?php if ($page['id'] == $regiao->tipo) { ?>
									<?php echo $page['dash_descricao']; ?>
								<?php } ?>
							<?php } ?>
						</p>

						<p class="" id="exo_subtitle" style="color: #424f8b;">
							<?php if ($regiao->tipo == 1) { ?>

								<?php print(number_format(@$percent[0], 0, '.', ','));  ?>%
							<?php } ?>

							<?php if ($regiao->tipo == 2) { ?>
								<?php print(number_format(@$percent[1], 0, '.', ','));  ?>%
							<?php } ?>

							<?php if ($regiao->tipo == 3) { ?>
								<?php print(number_format(@$percent[2], 0, '.', ','));  ?>%
							<?php } ?>

							<?php if ($regiao->tipo == 4) { ?>
								<?php print(number_format(@$percent[3], 0, '.', ','));  ?>%
							<?php } ?>

							<?php if ($regiao->tipo == 5) { ?>
								<?php print(number_format(@$percent[4], 0, '.', ','));  ?>%
							<?php } ?>

						</p>
						<div class="progress">
							<div class="progress-bar" id="progress-bar" role="progressbar" style="width: 
								<?php if ($regiao->tipo == 1) { ?>
									<?php echo (@$percent[0]);  ?>%
								<?php } ?>	

								<?php if ($regiao->tipo == 2) { ?>
									<?php echo (@$percent[1]);  ?>%
								<?php } ?>

								<?php if ($regiao->tipo == 3) { ?>
									<?php echo (@$percent[2]);  ?>%
								<?php } ?>

								<?php if ($regiao->tipo == 4) { ?>
									<?php echo (@$percent[3]);  ?>%
								<?php } ?>

								<?php if ($regiao->tipo == 5) { ?>
									<?php echo (@$percent[4]);  ?>%
								<?php } ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>

						<button type="button" class="button-pesquisas mt-3" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;" onclick="javascript:onContinuar(<?php echo $regiao->tipo ?>);">
							<?php if (
								$regiao->tipo == 1 && @$percent[0] >= 100
								|| $regiao->tipo == 2 && @$percent[1] >= 100
								|| $regiao->tipo == 3 && @$percent[2] >= 100
								|| $regiao->tipo == 4 && @$percent[3] >= 100
								|| $regiao->tipo == 5 && @$percent[4] >= 100
							) { ?>
								Finalizado
							<?php } ?>

							<?php if (
								$regiao->tipo == 1 && @$percent[0] > 0 && @$percent[0] < 100
								|| $regiao->tipo == 2 && @$percent[1] > 0 && @$percent[1] < 100
								|| $regiao->tipo == 3 && @$percent[2] > 0 && @$percent[2] < 100
								|| $regiao->tipo == 4 && @$percent[3] > 0 && @$percent[3] < 100
								|| $regiao->tipo == 5 && @$percent[4] > 0 && @$percent[4] < 100
							) { ?>
								Continuar
							<?php } else if (
								$regiao->tipo == 1 && @$percent[0] <= 0
								|| $regiao->tipo == 2 && @$percent[1] <= 0
								|| $regiao->tipo == 3 && @$percent[2] <= 0
								|| $regiao->tipo == 4 && @$percent[3] <= 0
								|| $regiao->tipo == 5 && @$percent[4] <= 0
							) { ?>
								Iniciar
							<?php } ?>
						</button>
					</div>
				<?php 
                                
                                } 
                                //Fim de foreach ($regioes as $regiao) {
                                ?>
			</div>
		</div>
	</div>
	<hr id="dashboard" style="margin-left: 30px!important; margin-right: 30px!important;">
	<p class="text-1" id="poppins_text" style="color: #989999; margin-left:30px;">Regiões finalizadas:</p>


	<?php if (
		@$percent[0] < 100
		&&  @$percent[1] < 100
		&&  @$percent[2] < 100
		&&  @$percent[3] < 100
		&&  @$percent[4] < 100
	) { ?>
		<div class="container text-center mt-3 pb-3">
			<div class="mt-3">
				<p class="text-235" id="exo_subtitle" style=" margin-top: -10px; ">
					Não existem regiões finalizadas 😔 <br>Responda todas as pesquisas de uma região para desbloquear o Dashboard.
				</p>
			</div>
		</div>
	<?php } else { ?>
		<?php
		$i = 0;
		foreach ($regioes_percent as $regiao) { ?>
			<div class="content-perguntas-<?php echo $i ?> pb-5">
				<div class="container text-center mt-3">
					<img class="img-regiao mt-4" src="<?= base_url('') ?>assets/img/<?php echo  $tipos[$regiao->tipo]['icone']; ?>" alt="" alt="">
					<?php if ($i > 0) { ?>
						<div class="d-flex justify-content-start">
							<a type="button" id="voltar-<?php echo $i ?>" class="icon1"><i class="fas fa-chevron-left"></i></a>
						</div>
					<?php } ?>

					<?php if (count($regioes_percent) - 1 > $i) { ?>
						<div class="d-flex justify-content-end">
							<a type="button" id="proximo-<?php echo $i ?>" class="icon"><i class="fas fa-chevron-right"></i></a>
						</div>
					<?php } else { ?>
						<div class="d-flex justify-content-end">

						</div>
					<?php } ?>

					<p class="mt-2"><span id="exo_title" style="color: #000 !important;"><?php print_r($tipos[$regiao->tipo]['titulo']) ?></span></p>

					<div class="mt-3">
						<p id="poppins_text" class="text-1">
							<?php foreach ($pages as $page) {   ?>
								<?php if ($page['id'] == $regiao->tipo) { ?>
									<?php echo $page['dash_descricao']; ?>
								<p class="text-1" style="text-align:center">
									<a class="button-pesquisas" id="exo_subtitle" style="width: 100% !important; padding: 10px 40px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff; text-decoration: none;" href="<?= base_url('') ?>index.php/dashboard/resultados/<?php echo $regiao->tipo; ?>"> Dashboard </a>
								</p>
								<?php } ?>
							<?php } ?>
						</p>
					</div>
				</div>
			</div>
			<?php $i++ ?>
		<?php } ?>
	<?php } ?>


	<script>
		function onContinuar(tipo) {
			window.location.href = "<?= base_url('') ?>index.php/dashboard/list/" + tipo;
		}
	</script>

	<style>
		.row-container-img {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		#row-img {
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
		}

		.text-235 {
			color: #989999;
			height: 150px;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		@media(max-width: 600px) {
			.text-235 {
				height: 100%;
			}
		}


		@media (max-width: 1024px) {

			/*max-width:768px e 1024px a imagem fica centralizada na parte superior do texto */
			.row-container-img {
				flex-direction: column;
				margin-top: 40px;
				/* Fica com um espaçamento de topo bem legal*/

			}

			#row-img {
				position: relative;
				display: flex;
				align-items: center;
				justify-content: center;
				text-align: center;
			}

			@media (max-width: 600px) {
				.row-container-img {
					flex-direction: column;
				}

				.row-container-img div img {
					width: 160px;
					margin-left: 0;
				}

			}

		}
	</style>
