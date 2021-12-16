<div class="header">
	<div class="container infos">
		<h4>Criar Páginas</h4>
		<p>Home - Páginas - Cadastrar </p>
	</div>
</div>
<div class="container">
	<div class="card">
		<div class="cadastro1">
			<form action="<?= base_url('') ?>index.php/paginas/store" enctype="multipart/form-data" class="" method="post">
				<h5>Páginas</h5>
				<!-- <div class="row col-md-12 mt-5">
					<div class="img-paginas shadow"><img class="preview" src="<?= base_url('') ?>assets/img/upload.png"></div>
					<input class="default-btn" id="img-upload" name="img-upload" type="file" hidden>
					<button onclick="defaultBtnActive()" type="button" id="custom-btn" class="btn mt-3">Colocar Banner</button>
				</div> -->

				<div class="form-group mt-5">
					<label for="link_formr">Link run formR</label>
					<select name="link_formr" id="link_formr" class="form-select">
						<option></option>
						<?php foreach($pages_formr as $pf){ ?>
						<option value="<?php echo $pf['id']; ?>"   ><?php echo $pf['name']; ?> </option>
						<?php } ?>
					</select>
				</div>	
				<div class="form-group mt-5">
					<label for="nome">Título</label>
					<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Digite o título: " required>
				</div>
				<div class="form-group mt-5">
					<label for="descricao">Descrição</label>
					<textarea class="form-control" cols="10" id="descricao" name="descricao" required></textarea>
				</div>
				<div class="form-group mt-5">
					<label for="questionario">Tipos</label>
					<select name="tipo" id="tipo" class="form-select">
						<option></option>
						<?php for($i=1;$i<=(count($tipo));$i++){ ?>
							<option value='<?php echo $i; ?>' ><?php echo $tipo[$i]; ?></option>
							<?php } ?>
					</select>
					
				</div>
				<div class="row">
					<div class="form-group mt-5 col-2">
						<label for="cor-texto">Cores do texto</label>
						<input type="color" name="cor-texto" value="cor-texto" class="form-control" >
					</div>
					<div class="form-group mt-5 col-2">
						<label for="cor-desc">Cores do fundo</label>
						<input type="color" name="cor_desc" value="cor_desc" class="form-control" >
					</div>
				</div>
				<!-- <div class="form-group mt-5">
					<label for="questionario">Questionário</label>
					<input list="browsers" name="questionario" class="form-control" value="" id="questionario">
					<datalist id="browsers">
					<?php foreach($quiz as $q){ ?>
						<option value="<?php echo $q['titulo']; ?>">
					<?php } ?>				
					</datalist>
				</div> -->

				<div class="row justify-content-between mt-5">
					<div class="col mr-5">
						<button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas" style=" text-decoration:none; color: white; font-family: Poppins;">Cancelar</a> </button>
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary" style="font-family: Poppins;">Gravar</button>
					</div>
				</div>
		</div>
		</form>
	</div>

</div>
