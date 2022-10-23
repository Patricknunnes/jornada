<div class="header-mapas">
	<div class="container text-left pt-3">
		<div class="mt-5">
			<h3 class="mb-3" style="color:#fff; font-family: exo, sans-serif;"><?php echo $title; ?></h3>
		</div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard" id="exo_subtitle" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard/list/<?php echo $page_id2; ?>" id="exo_subtitle" style="color:#fff"><?php echo $title; ?></a></li>
				<?php foreach ($pages as $page) { ?>
					<?php if ($page['id'] == $page_id2) { ?>
						<li class="breadcrumb-item active" aria-current="page" id="exo_subtitle" style="color:#fff;"><?php echo $page['titulo']; ?></li>
					<?php } ?>
				<?php } ?>
			</ol>
		</nav>


	</div>
</div>

<?php
$session = $_SESSION['logged_user'];
$email = $session['email'];
?>

<div class="container content " style="height: 100%!important">
	<div class="container pt-3">
		<div class="container" id="main_c">
			<?php foreach ($pages_runs as $pager) { ?>

				<?php if ($pager->run_id = $page_id) { ?>
					<h3 class="mt-5" style="color:#000; text-align: center; font-size: 30px; font-weight: bold; font-family: Exo, Sans-serif;"><?php echo $pager->run_titulo; ?></h3>
				<?php } ?>
			<?php } ?>

			<form method="post" action="<?= base_url() ?>index.php/pesquisas/resultado/<?= $page_id ?>/<?php echo $questoes[0]['unit_id'] ?>/<?= $page_id2 ?>/<?php echo $pesquisa_repetida?>" style="padding-top: 5%;">

				<?php
				$next = false;
				foreach ($studies as $studie) { ?>
					<!-- <input type="hidden" name="description_<?php echo $studie['unit_id']; ?>" value="<?php echo $studie['description'] ?>" /> -->
					<?php if ($questoes[0]['unit_id'] != $studie['unit_id'] && $next == false) {
						$next = true;
					?>
						<input type="hidden" name="next_studies_id" value="<?php echo $studie['unit_id']; ?>" />
				<?php }
				} ?>
				<input type="hidden" name="active_studies" value="<?php echo $questoes[0]['description']; ?>" />
				<input type="hidden" name="active_studies_id" value="<?php echo $questoes[0]['unit_id']; ?>" />

				<?php foreach ($questoes as $questao) {   ?>
					<div data-showif="<?php  echo $questao['showif']; ?>" data-ordenacao="<?php  echo $questao['item_order']; ?>" id="div_<?php  echo $questao['name']; ?>" style="<?php if(!empty($questao['showif'])){ echo 'display:none'; }  ?>"> 

					<?php
					//$retirarTexto = array("#", 'tel', 'multiple', '-', '_', 'button 5', 'button', 'note', 'selectmultiple', 'multiplebutton', 'select', '![puppy]', '![kitten]', ')', '(', 'timezone', 'oraddone', 'oradd', 'color', 'mc', 'check', 'month', '`', 'text', 'area', 'rating', 'https://upload.wikimedia.org/wikipedia/commons/thumb/', '5/50/Pugglepuppy%28cropped%29.jpg/395pxPugglepuppy%28cropped%29.jpg', 'f/f3/Youngkitten.JPG/320pxYoungkitten.JPG');
					$retirarTexto = array( 'multiple', 'button 5', '<button', 'selectmultiple', 'multiplebutton', '<select', '![puppy]', '![kitten]', 'oraddone', 'oradd', 'https://upload.wikimedia.org/wikipedia/commons/thumb/', '5/50/Pugglepuppy%28cropped%29.jpg/395pxPugglepuppy%28cropped%29.jpg', 'f/f3/Youngkitten.JPG/320pxYoungkitten.JPG');

					?>

					<?php if ($questao['type'] == 'note' && $questao['name'] != 'note_for_items_to_follow' && $questao['name'] != 'note_feedback') { ?>
						<label class="pb-3 pt-4" for="live" id="poppins_text" style="font-size: 17px;"><?php echo str_replace ($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
					<?php } ?>

					<?php if ($questao['type'] == 'text' && $questao['name'] != 'email' || $questao['type'] == 'timezone' || $questao['type'] == 'select_or_add_one' || $questao['type'] == 'select_or_add_multiple' || $questao['type'] == 'slider_list' || $questao['type'] == 'slider' || $questao['type'] == 'number' || $questao['type'] == 'tel' || $questao['type'] == 'select_one' || $questao['type'] == 'select_multiple' || $questao['type'] == 'mc_multiple_button' || $questao['type'] == 'mc_multiple' || $questao['type'] == 'mc_button') { ?>
						<label class="pb-3 pt-4" for="live" style="font-weight: 500; font-family: Poppins;"><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<input type="text" name="<?php echo $questao['name'] ?>" class="form-control trocar_cor" placeholder="" required />
					<?php } ?>

					<?php if ($questao['type'] == 'textarea') { ?>
						<label class="pb-3 pt-4" for="live" style="font-weight: 500; font-family: Exo, Sans-serif;" required><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<textarea class="form-control trocar_cor" name="<?php echo $questao['name']  ?>" rows="3" required></textarea>
					<?php } ?>



					<?php if ($questao['name'] == 'email') { ?>
						<label class="pb-3 pt-4" for="live" style="font-weight: 500; font-family: Exo, Sans-serif;" required><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<input type="email" name="<?php echo $questao['name']  ?>" class="form-control trocar_cor" placeholder="<?php echo $email ?>" value="<?php echo $email ?>" required />
					<?php } ?>


					<?php if ($questao['type'] == 'range_ticks') {

						$str = $questao['type_options'];

						$explode = explode(",", $str);
					?>

						<label class="pt-4" for="live" id="exo_subtitle" required><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<div class="d-flex align-items-center">
							<p><?php echo $questao['list'][0]['label']; ?></p>
							<input id="range-mobile" type="range" step="1" name="<?php echo $questao['name']  ?>" min="<?php echo $explode[0]; ?>" max="<?php echo $explode[1]; ?>" class="form-range">
							<p><?php echo /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['list'][1]['label'])/*)*/; ?></p>
						</div>
					<?php } ?>

					<?php if ($questao['type'] == 'mc' || $questao['type'] == 'check' || $questao['type'] == 'check_button') { ?>
						<label class="pt-4" for="live" id="poppins_title" required><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<?php if (
							$questao['type'] == 'mc' &&  empty($questao['choice_list'])
						) { ?>
							<input type="text" name="<?php echo $questao['name'] ?>" class="form-control trocar_cor mt-3" placeholder="" required />
						<?php } else if ($questao['type'] == 'mc') {
						?>
							<div class="perguntas-mobile">
								<?php
								foreach ($questao['list'] as $list) {
								?>

									<div class="form-check form-check-inline d-flex align-items-center">
                                                                            <input class="form-check-input" type="radio" name="<?php echo $list['list_name']  ?>" id="inlineRadioOptions" onChange="javascript:showif('<?php echo $list['list_name']  ?>')" value="<?php echo $list['name']  ?>" <?php if(empty($questao['showif'])){ ?> required <?php } ?> />&nbsp&nbsp&nbsp<label><?php echo /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $list['label'])/*)*/  ?></label>
									</div>


								<?php } ?>
							</div>
					<?php }
					} ?>

					<!--                     <?php if ($questao['type'] == 'select_multiple' || $questao['type'] == 'mc_multiple_button' || $questao['type'] == 'mc_multiple' || $questao['type'] == 'mc_button') { ?>

                        <div class="form-group pt-4">
                            <label class="pb-3" style="font-weight: 500;"><?php echo str_replace($retirarTexto, '', $questao['label']) ?></label>
                            <select class="form-control trocar_cor" name="<?php echo $questao['name']  ?>">
                                <option></option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    <?php } ?> -->

					<?php if ($questao['type'] == 'color') { ?>
						<label class="pb-3 pt-4" style="font-weight: 500;"><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<input type="color" name="<?php echo $questao['name']  ?>" class="form-control form-control-color trocar_cor" value="#563d7c" title="Choose your color" required />
					<?php } ?>


					<?php if ($questao['type'] == 'datetime' || $questao['type'] == 'datetime-local' || $questao['type'] == 'week' || $questao['type'] == 'yearmonth' || $questao['type'] == 'month') { ?>
						<label class="pb-3 pt-4" style="font-weight: 500;"><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<input type="date" name="<?php echo $questao['name']  ?>" required id="inputDataNascimento" class="form-control trocar_cor" placeholder="DD/MM/AAAA" required />
					<?php } ?>

					<?php if ($questao['type'] == 'time') { ?>
						<label class="pb-3 pt-4" style="font-weight: 500;"><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<input type="time" name="<?php echo $questao['name']  ?>" required id="inputDataNascimento" class="form-control trocar_cor" placeholder="DD/MM/AAAA" required />
					<?php } ?>

					<?php if ($questao['type'] == 'rating_button' || $questao['type'] == 'range') { ?>
						<label class="pb-3 pt-4" style="font-weight: 500; font-family: Poppins;"><?php echo str_replace($retirarTexto, '', /*utf8_encode(*/ str_replace(array( chr(147), chr(148)), '"', $questao['label']))/*)*/ ?></label>
						<div class="perguntas-mobile" style="font-family: Poppins;">
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="1" checked />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="2" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="3" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="4" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="5" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="6" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="7" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="8" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="9" />
							</div>
							<div class="form-check form-check-inline d-flex align-items-center">
								<input class="form-check-input" type="radio" name="<?php echo $questao['name']  ?>" id="inlineRadioOptions" value="10" />
							</div>
						</div>
					<?php } ?>
					</div>	
				<?php } ?>

				<button type="submit" class="btn mb-5 mt-5" id="exo_subtitle" style="width: 200px; height: 45px; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Mostrar resultados</button>
			</form>
		</div>
	</div>
</div>

<style>
	.form-check-input:checked {
		background-color: #0d6efd !important;
	}



	.perguntas-mobile {
		display: flex;
		flex-direction: column;
	}
</style>

