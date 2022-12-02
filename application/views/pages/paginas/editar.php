<div class="header">
    <div class="container infos">
        <h4>Editar Região</h4>
        <p>Home - Região - Editar </p>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="cadastro1">
            <form action="<?= base_url('') ?>index.php/paginas/update/<?= $pages['id'] ?>" enctype="multipart/form-data" class="" method="post">
                <h5>Região</h5>
                <div class="form-group mt-5">
                    <label for="nome">Título</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo $pages['titulo'] ?>" id="titulo" placeholder="Digite o título: ">
                </div>
                <div class="form-group mt-5">
                    <label for="descricao">Descrição List</label>
                    <textarea class="form-control" cols="10" id="descricao" name="descricao"><?php echo $pages['descricao'] ?></textarea>
                </div>
                <div class="form-group mt-5">
                    <label for="dash_descricao">Descrição Dashboard</label>
                    <textarea class="form-control" cols="10" id="dash_descricao" name="dash_descricao"><?php echo $pages['dash_descricao'] ?></textarea>
                </div>
                <div class="form-group mt-5">
                    <label for="texto_balao">Texto do Balão Informativo <span class="small">(Use a tecla <ENTER> para quebrar a linha)</span></label>
                    <textarea class="form-control" cols="10" rows="3" id="texto_balao" name="texto_balao" maxlength="120"><?php echo $pages['texto_balao'] ?></textarea>
                </div>
                <div class="form-group mt-5">
                    <label for="qtd_exibicao_bl">Número de Vezes que o Balão Será Exibido para Um Usuário</label>                                        
                    <select class="form-select" cols="10" id="qtd_exibicao_bl" name="qtd_exibicao_bl" value="<?php echo $pages['qtd_exibicao_bl'] ?>"  >
                        <?php for ($qtd = -1; $qtd <= 20; $qtd++) { ?><option <?php if ($pages['qtd_exibicao_bl'] == $qtd) {
                            echo 'selected="selected"';
                        } ?>><?php
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
                    <label >Reiniciar Comtagem dos Usuários                         
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reiniciar_contagem" name="reiniciar_contagem" />
                        <label class="form-check-label" for="reiniciar_contagem">
                            Transformar em zero a contagem para a Região, exibindo o balão novamente. Deve ser selecionado ao alterar a configuração do Balão.
                        </label>
                    </div>
                </div>                
                <div class="form-group mt-5">
                    <label >Momento da Exibição                         
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" id="momento_exibicao_bl" name="momento_exibicao_bl" <?php 
                            if ($pages['momento_exibicao_bl'] == 0) {
                                echo ' checked="checked"';
                            } ?> />
                        <label class="form-check-label" for="momento_exibicao_bl">Automaticamente</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" id="momento_exibicao_bl" name="momento_exibicao_bl" <?php 
                            if ($pages['momento_exibicao_bl'] == 1) {
                                echo ' checked="checked"';
                            } ?> />
                        <label class="form-check-label" for="momento_exibicao_bl">Quando o Usuário passa o mouse pela Região</label>
                    </div>
                </div>
                
                <div class="form-group mt-5">
                    <label for="link_formr">Pesquisa FormR</label>
                    <select name="link_formr" id="link_formr" class="form-select">
                        <option></option>
                        <?php foreach ($quiz as $pf) { ?>
                        <option value="<?php echo $pf->run_id; ?>"   ><?php echo $pf->run_titulo; ?> </option>
                        <?php } ?>
                    </select>
                    <button type="button" class="btn btn-primary mt-2" onclick="javascript:adicionarPesquisa(<?php echo $pages['id']; ?>)" >Adicionar</button>		
                </div>
                <div class="row mt-5">
                    <div class="alert alert-success mb-2" id="msg-delete-regiao" role="alert" style="display: flex; justify-content: space-between; margin-top: 10px; padding-right: 1rem!important; align-items: center;">
                        Deletado com sucesso!
                        <button type="button" onclick="javascript:fecharalert()" style="background: transparent; border: none; font-family: Poppins;" >
                            <span aria-hidden="true" style="font-size: 20px; color: #fff">&times;</span>
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-2" scope="col">#</th>
                                <th class="col-4" scope="col">Pesquisa</th>
                                <th class="col-1" scope="col">Balão</th>
                                <th class="col-1" scope="col">Repetir</th>
                                <th class="col-4" scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="table-page">
                            <?php
                            foreach ($questionarios as $questionario) {
                                ?>
                                <tr id="<?php echo $questionario->id; ?>">

                                    <th class="col-2" scope="row"><?php echo $questionario->id; ?></th>
                                    <td class="col-4"><?php echo $questionario->run_titulo; ?></td>
                                    <td class="col-1"><?php echo $questionario->qtd_exibicao_bl; ?></td>
                                    <td class="col-1"><?php echo $questionario->dias_para_refazer; ?></td>
                                    <td class="col-4">
                                        <a href="<?= base_url() ?>index.php/paginas/editarPesquisa/<?= $pages['id']; ?>/<?= $questionario->id; ?>" class="btn btn-warning  btn-adm" title="Configurar"><i class="fas fa-gear"></i></a>
                                        <a onclick="javascript:deletarRegiaoPage(<?= $questionario->id; ?>, <?= $pages['id']; ?>)" class="btn btn-danger  btn-adm"  title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-between mt-5">
                    <div class="col mr-5">
                        <button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Gravar</button>
                    </div>
                </div>
        </form>
        </div>
    </div>

</div>


<div class="container register">


</div>
