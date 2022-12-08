<div class="header-mapas">
	<div class="container text-left mt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard" id="exo_subtitle" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page" style="color:#fff"><?php echo $title; ?></li>
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
		<div class="row" id="c-mobile">
			<div class="col-12" style="text-align:center">

				<img class="img-regiao mt-4" src="<?= base_url('') ?><?php 
                                if( 
                                    file_exists(
                                                "uploads/icones/regiao_" . $regiaoAtual->id . ".png"
                                                )
                                    ){                            
                                    echo "uploads/icones/regiao_" . $regiaoAtual->id;

                                } else {
                                    echo "assets/img/icones/regiao";
                                    if ($regiaoAtual->pertence_a_jornada == 'S') {
                                        echo "_" . $regiaoAtual->id; 
                                    }
                                }
                                ?>.png?<?php echo mt_rand()?>" alt="" style="height: 180px; border: solid 4px #00009C; border-radius: 50%; padding: 25px;">
				<h4 class="mt-1" style="color: #000; font-weight: bold; font-family: Exo, Sans-serif;"><?php echo $regiaoAtual->titulo; ?></h4>
				<h5 class="mt-1 mb-5" style="color: #000; font-family: Exo, Sans-serif; font-weight: bold;">100%</h5>
			</div>

			<div class="card col" id="sombra" style="margin-right: 10px; border-radius: 6px; text-align: center;">
				<div class="card-body">
					<p style="color: #000; font-size:14px; font-family: Exo, Sans-serif;">Pesquisas Respondidas</p>
					<p style="color: #000; font-size:16px; font-weight: bold!important;"><?php echo $countpesquisa ?> pesquisas</p>
				</div>
			</div>
			<div class="card col" id="sombra" style="margin-right: 10px; border-radius: 6px; text-align: center;">
				<div class="card-body">
					<p style="color: #000; font-size:14px; font-family: Exo, Sans-serif;">Questões Respondidas</p>
					<p style="color: #000; font-weight: bold;font-size:16px;"><?php echo $total_questoes ?> questões</p>
				</div>
			</div>
			<!-- <div class="card col" id="sombra" style="border-radius: 6px;">
                <div class="card-body">
                    <p style="color: #000; font-size:14px; font-family: Exo, Sans-serif;">Tempo Respondendo</p>
                    <p style="color: #000; font-weight: bold;font-size:16px;">47 minutos</p>
                </div>
            </div> -->
		</div>

		<div class="row" id='grafico_desk' style="justify-content: space-between; margin-top: 15px; row-gap: 15px;">
			<?php foreach ($graficos as $grafico) { ?>
				<div class="col-6" id='graf1_mobile' style="padding-left: 0;">
					<div class="card col-12" id='sombra' style="border-radius: 6px; text-align: center;">
						<div class="card-body" style="width: 100%; height: 100%;">
							<img width="100%" class="img-fluid"  src="<?= base_url() ?>/uploads/graphic/<?php echo $grafico->imagem; ?>">
                                                        <p style="color: #000; font-size:14px; font-family: Exo, Sans-serif;">Data de Preenchimento</p>
                                                        <p style="color: #000; font-weight: bold;font-size:16px;"><?php echo  date_format( new DateTime($grafico->data_gravacao), 'd/m/Y'); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>


	</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




<style>
	#sombra,
	#piechart {
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
	}
</style>
