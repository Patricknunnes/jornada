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
        <div class="container" id="main_c">
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
                <div ><?php echo $resultados2; ?></div>
                <?php if(!$rest){ ?>
                    <button type="submit" class="btn mb-5 mt-5" id="exo_subtitle" style="width: 270px; height: 45px; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Voltar para <?php echo $page_titulo ?></button>
                <?php }else{ ?>
                    <a  class="btn mb-5 mt-5" id="exo_subtitle" style="width: 270px; height: 45px; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;" href="<?= base_url() ?>index.php/pesquisas/finish/<?= $page_id2 ?>">Voltar para <?php echo $page_titulo ?></a>
                <?php } ?> 
                    <a  target="_blank" class="btn mb-5 mt-5" id="exo_subtitle" style="width: 250px; height: 45px; padding: 10px 20px; min-height: 46px; background: #2C234D; border-radius: 30px; color: #fff;" href="<?php echo base_url()?>index.php/pesquisas/pdf/<?= $page_id ?>/<?php echo $session['id']; ?>/<?php echo $study_id; ?>">Salvar resultado em PDF</a>      
            </form>
        </div>
    </div>
</div>
<script>
ig(<?php echo $page_id2; ?>);

	
</script>
