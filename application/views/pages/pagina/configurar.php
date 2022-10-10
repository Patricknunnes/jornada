<div class="header">
    <div class="container infos">
        <h4>Configurar Pesquisa da Região</h4>
        <p>Home - Região - Editar - Configurar </p>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="cadastro1">
            <form action="<?= base_url('') ?>index.php/paginas/updateConfiguracao/<?= $pages['id'] ?>/<?= $page["id"] ?>" enctype="multipart/form-data" class="" method="post">
                <h5>Região</h5>
                <h4><?php echo $pages['titulo'] ?></h4>
                <div class="form-group mt-5">
                    <label >Pesquisa</label>
                    <h5><?php echo $page['run_titulo'] ?></h5>
                </div>
                <div class="form-group mt-5">
                    <label for="texto_balao">Texto do Balão Informativo <span class="small">(Use a tecla <ENTER> para quebrar a linha)</span></label>
                    <textarea class="form-control" cols="10" rows="3" id="texto_balao" name="texto_balao" maxlength="120"><?php echo $page['texto_balao']  ?></textarea>
                </div>
                <div class="form-group mt-5">
                    <label for="qtd_exibicao">Número de Vezes que o Balão Será Exibido para Um Usuário</label>                                        
                    <select class="form-select" cols="10" id="qtd_exibicao" name="qtd_exibicao" value="<?php echo $page['qtd_exibicao']  ?>"  >
                        <?php for ($qtd = -1; $qtd <= 20; $qtd++) { ?><option <?php if ($page['qtd_exibicao'] == $qtd ){ echo 'selected="selected"';}  ?>><?php
                                echo $qtd;
                                if ($qtd == -1)
                                    echo " - Desabilitado";
                                if ($qtd == 0)
                                    echo " - Sempre";
                                ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mt-5">
                    <label >Momento da Exibição <?= $page['momento_exibicao'] ?>
                        <?php if ($page['momento_exibicao'] == 0 ){ echo ' True';} else { echo ' False'; }  ?>
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" id="momento_exibicao" name="momento_exibicao" <?php if ($page['momento_exibicao'] == 0 ){ echo ' checked="checked"';}  ?>>
                        <label class="form-check-label" for="momento_exibicao">Automaticamente</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" id="momento_exibicao" name="momento_exibicao" <?php if ($page['momento_exibicao'] == 1 ){ echo ' checked="checked"';}  ?>>
                        <label class="form-check-label" for="momento_exibicao">Quando o Usuário passa o moude pela Pesquisa</label>
                    </div>
                </div>

                <div class="form-group mt-5">
                    <label for="dias_para_refazer">Número de dias de espera para refazer a pesquisa após concluir a jornada</label>                                        
                    <select class="form-select" cols="10" id="dias_para_refazer" name="dias_para_refazer" value="<?php echo $page['dias_para_refazer']  ?>"  >
                        <?php for ($qtd = 0; $qtd <= 90; $qtd++) { ?>
                            <option <?php if ($page['dias_para_refazer'] == $qtd ){ echo ' selected="selected"';}  ?> >
                            <?php
                                echo $qtd;
                                if ($qtd == 0)
                                    echo " - Não pode ser refeita";
                                ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="row justify-content-between mt-5">
                    <div class="col mr-5">
                        <button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas/editar/<?php echo $pages['id']; ?>" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Gravar</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

</div>


<div class="container register">


</div>
