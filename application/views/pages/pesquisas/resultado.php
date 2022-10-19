    <div class="header-mapas">
	<div class="container text-left pt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff; font-family: exo, sans-serif;"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/" id="exo_subtitle" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard/list/<?php echo $page_id2; ?>" id="exo_subtitle" style="color:#fff"><?php echo $title; ?></a></li>
				<?php foreach ($pages as $page) { ?>
					<?php if ($page['id'] == $page_id2) { 
							$page_titulo = $page['titulo'];
						?>
						<li class="breadcrumb-item active" aria-current="page" id="exo_subtitle" style="color:#fff"><?php echo $page['titulo']; ?></li>
					<?php } ?>
				<?php } ?>
			</ol>
		</nav>
	</div>
</div>

<?php
$session = $_SESSION['logged_user'];
$email = $session['email'];
$name = $session['name'];
?>

<div class="container content " style="height: 100%!important">
    <div class="container pt-3">
        <div class="container resposta_resp" id="main_c">
		<?php foreach ($pages_runs as $pager) { ?>
				<?php if ($pager->run_id = $page_id) { ?>
					<h3 class="mt-5" style="color:#000; text-align: center"><?php echo $pager->run_titulo; ?></h3>
				<?php } ?>
			<?php } ?>
            <?php if($next_studies != 'finish'){ ?>    
                <form style="padding-top: 15%;padding-bottom: 15%;" method="post" action="<?= base_url() ?>index.php/pesquisas/index/<?= $page_id ?>/<?php echo $next_studies; ?>">
            <?php }else{ ?>
                <form style="padding-top: 15%;padding-bottom: 15%;" method="post" action="<?= base_url() ?>index.php/pesquisas/finish/<?= $page_id2 ?>">
            <?php } ?>
                <div ><?php 
                //echo $resultados2; 
                
                if ( isset($resultados2 )) {
                    $resltTemp = $resultados2;
                    $base = 0;
                    do {
                        $pos = strpos( $resltTemp, "<img", $base);

                        if ($pos !== false ){
                            $posFim = strpos( $resltTemp, ">", $pos);
                            $posWidth = strpos( $resltTemp, 'width="', $pos);

                            if ( $posWidth < $posFim ){
                                $posAspas1 = strpos( $resltTemp, '"', $posWidth);
                                $posAspas2 = strpos( $resltTemp, '"', $posAspas1+1);
                                $digitos = $posAspas2 - $posAspas1 - 1;

                                if ( $digitos > 0 ) {
                                    $larg = substr($resltTemp, $posAspas1 + 1, $posAspas2 - $posAspas1 - 1);

    //echo "<h1>" . $larg . "</h1>";
    //exit();
                                    $resltTemp = substr_replace( $resltTemp, 'class="w' . $larg . '"', $posWidth, ($posAspas2 - $posWidth + 1 ));
                                }
                            }
                            $base = $posFim;
                        }                    

                    } while ($pos !== false );

                    echo $resltTemp; 
                }
                ?></div>
                <div class="container">
                    <div class="row">
                <?php if(!$rest){ ?>
                    <div class="col"><button class="btn my-2 my-md-3 my-lg-5 btn-resultado" id="exo_subtitle" type="submit" >Voltar para <?php echo $page_titulo ?></button></div>
                <?php }else{ ?>
                    <div class="col"><a  class="btn my-2 my-md-3 my-lg-5 btn-resultado" id="exo_subtitle" href="<?= base_url() ?>index.php/pesquisas/finish/<?= $page_id2 ?>">Voltar para <?php echo $page_titulo ?></a></div>
                <?php } ?> 
                    <div class="col"><a  class="btn my-2 my-md-3 my-lg-5 btn-resultado" id="exo_subtitle" href="<?php echo base_url()?>index.php/pesquisas/pdf/<?= $page_id ?>/<?php echo $session['id']; ?>/<?php echo $study_id; ?>" target="_blank" >Salvar resultado em PDF</a></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
ig(<?php echo $page_id2; ?>);

	
</script>
