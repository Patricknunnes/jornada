<div class="header-mapas">
	<div class="container text-left pt-3">
	</div>
</div>

<div class="container content " style="height: 100%!important">
	<div class="container pt-3">
		<div class="container" id="main_c">
		<?php foreach ($pages_runs as $pager) { ?>

			<?php if ($pager->run_id = $id_page) { ?>
				<h3 class="mt-5" style="color:#000; text-align: center; font-size: 30px; font-weight: bold; font-family: Exo, Sans-serif;"><?php echo $pager->run_titulo; ?></h3>
			<?php } ?>
			<?php } ?>
			<form method="post" action="<?= base_url() ?>index.php/pesquisas/resultado/<?php echo $id_page; ?>/<?php echo $unit_id; ?>/<?php echo $id_page2; ?>/<?= $nr_pesquisa?>" style="padding-top: 15%;    padding-bottom: 15%;">
				<?php
				$next = false;
				foreach ($studies as $studie) { ?>
					<?php if ($unit_id != $studie['unit_id'] && $next == false) {
						$next = true;
					?>
						<input type="hidden" name="next_studies_id" value="<?php echo $studie['unit_id']; ?>" />
				<?php }
				} ?>

				<input type="hidden" name="resposta" value="sim" />
				<?php foreach ($perguntas as $pergunta) {
					$i = 0;
					foreach ($respostas as $resposta) {
						$i++; ?>

						<?php
						//$retirarTexto = array("#", 'tel', 'multiple', '-', '_', 'button 5', 'button', 'note', 'selectmultiple', 'multiplebutton', 'select', '![puppy]', '![kitten]', ')', '(', 'timezone', 'oraddone', 'oradd', 'color', 'mc', 'check', 'month', '`', 'text', 'area', 'rating', 'https://upload.wikimedia.org/wikipedia/commons/thumb/', '5/50/Pugglepuppy%28cropped%29.jpg/395pxPugglepuppy%28cropped%29.jpg', 'f/f3/Youngkitten.JPG/320pxYoungkitten.JPG');
						$retirarTexto = array( 'multiple', 'button 5', 'button', 'selectmultiple', 'multiplebutton', 'select', '![puppy]', '![kitten]', ')', '(', 'timezone', 'oraddone', 'oradd', 'color', 'mc', 'check', 'month', 'area', 'rating', 'https://upload.wikimedia.org/wikipedia/commons/thumb/', '5/50/Pugglepuppy%28cropped%29.jpg/395pxPugglepuppy%28cropped%29.jpg', 'f/f3/Youngkitten.JPG/320pxYoungkitten.JPG');
						?>

						<?php if ($pergunta['name'] != 'fbnumber' && $pergunta['name'] != 'note_feedback' && $pergunta['type'] != "submit") { ?>
							<div class="resposta-container-<?php echo $i; ?>" >
								<label class="pb-3 pt-4" for="live" style="font-weight: 500;"><?php echo /*utf8_encode(*/$pergunta['label']/*)*/ ?></label>
								<?php if ($pergunta['type'] != 'note' && $pergunta['type'] != 'mc' && $pergunta['type'] != 'check' && $pergunta['type'] != 'check_button') { ?>
									<input type="text" name="" class="form-control trocar_cor" placeholder="" value="<?php echo $resposta[$pergunta['name']]; ?> ">
								<?php } ?>

								<?php if ($pergunta['type'] == 'mc' || $pergunta['type'] == 'check' || $pergunta['type'] == 'check_button') { ?>
									<?php foreach ($pergunta['list'] as $list) { ?>
										<?php if ($resposta[$pergunta['name']] != $list['name']) { ?>
											<div class="form-check form-check-inline d-flex align-items-center">
                                                                                            <input class="form-check-input" id="inlineRadioOptions" type="radio" name="<?php echo $list['list_name']  ?>" value="<?php echo $list['name']  ?>">&nbsp&nbsp&nbsp<label><?php echo /*utf8_encode(*/str_replace(array( chr(147), chr(148)), '"', $list['label'])/*)*/;  ?></label>
											</div>
										<?php } else { ?>
											<div class="form-check form-check-inline d-flex align-items-center">
                                                                                            <input class="form-check-input" id="inlineRadioOptions" type="radio" name="<?php echo $list['list_name']  ?>" value="<?php echo $list['name']  ?>" checked>&nbsp&nbsp&nbsp<label><?php echo /*utf8_encode(*/str_replace(array( chr(147), chr(148)), '"', $list['label'])/*)*/; ?></label>
											</div>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>

				<button type="submit" class="btn mb-5 mt-5" id="exo_subtitle" style="width: 200px; height: 45px; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Mostrar resultados</button>
			</form>
		</div>
	</div>
</div>
