<div class="header">
    <div class="container infos">
        <h4>Ordenar Regiões</h4>
        <p>Home - Região - Ordenar </p>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="cadastro1">
            <h5>Regiões</h5>
            <div class="container mt-5">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">Título - Jornada</th>
                            <th scope="col">Ordens que devem estar conclusas</th>
                            <th scope="col" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagesJornada as $page) { ?>
                        <tr>                            
                            <td id="regiaoS<?php echo $page->ordem ?>"><?php echo $page->titulo ?></td>
                            <td>
                                <form onsubmit="return false;">
                                <?php
                                    for($cont=1; $cont < $page->ordem; $cont++){
                                        $ordemAtual = $page->ordem;
                                        $conclusaBD = array_filter(
                                                                    $pagesOrdensConclusas,
                                                                    function($obj) use ( $ordemAtual, $cont) { 
                                                                        return $obj["jornada"] == 'S' 
                                                                                && $obj["ordem"] == $ordemAtual
                                                                                && $obj["ordem_ant"] == $cont;
                                                                     });
                                ?>
                                    <input type="checkbox" name="conclusaS<?php echo $page->ordem?>_<?php echo $cont; ?>" 
                                           id="conclusaS<?php echo $page->ordem?>_<?php echo $cont; ?>" 
                                           onclick="javascript:salvarOrdemConclusa( <?php echo $page->ordem ?>, <?php echo $cont ?>, 'S')" <?php
                                           if(sizeof($conclusaBD) == 1){
                                               echo 'checked="checked"';
                                           } ?> />
                                <?php
                                        echo $cont;
                                    }
                                    ?>&nbsp;
                                </form>
                            </td>
                            <td class="ordemJornada">
                                <?php if ($page->ordem > 1) {?>
                                <a href="#" onclick="javascript:OrdenarRegiaoPages(<?php echo $page->ordem?>,<?php echo ($page->ordem-1)?>, 'S'); return false;" class="btn btn-warning  btn-adm" title="Subir">
                                    <i class="fas fa-chevron-up"></i>
                                </a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-dark btn-adm" title="Região Permanente" onclick="return false;"><i class="fas fa-times"></i></a>
                                <?php } ?>

                                <?php if ($page->ordem < 5) {?>
                                <a href="#" onclick="javascript:OrdenarRegiaoPages(<?php echo $page->ordem?>,<?php echo ($page->ordem+1)?>, 'S'); return false;" class="btn btn-warning  btn-adm" title="Descer">
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-dark btn-adm" title="Região Permanente" onclick="return false;"><i class="fas fa-times"></i></a>
                                <?php } ?>                            </td>
                        </tr>                        
                        <?php } ?>
                    </tbody>            
                </table>
            </div>

            <div class="container mt-5">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">Título - Outras</th>
                            <th scope="col">Aguardar Jornada</th>
                            <th scope="col">Sempre Visível</th>
                            <th scope="col">Ordens que devem estar conclusas</th>                            
                            <th scope="col" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagesOutras as $page) { ?>
                        <tr>                            
                            <td id="regiaoN<?php echo $page->ordem ?>"><?php echo $page->titulo ?></td>
                            <td id="aguardar<?php echo $page->ordem ?>" >
                                <form onsubmit="return false;">
                                    <input type="checkbox" name="aguardarCH<?php echo $page->id ?>" id="aguardarCH<?php echo $page->id ?>" <?php
                                    if ($page->aguarda_jornada == 'S'){
                                        echo 'checked="checked"';
                                    }
                                    ?>  onclick="javascript:AlterarAguardaJornada( <?php echo $page->id ?>)" /> Sim
                                </form>
                            </td>
                            <td id="visivel<?php echo $page->ordem ?>" >
                                <form onsubmit="return false;">
                                    <input type="checkbox" name="visivelCH<?php echo $page->id ?>" id="visivelCH<?php echo $page->id ?>" <?php
                                    if ($page->sempre_visivel == 'S'){
                                        echo 'checked="checked"';
                                    }
                                    ?>  onclick="javascript:AlterarSempreVisivel( <?php echo $page->id ?>, <?php echo $page->ordem ?>)" /> Sim
                                </form>
                            </td>
                            <td>
                                <form onsubmit="return false;">
                                <?php
                                    for($cont=1; $cont < $page->ordem; $cont++){
                                        $ordemAtual = $page->ordem;
                                        $conclusaBD = array_filter(
                                                                    $pagesOrdensConclusas,
                                                                    function($obj) use ( $ordemAtual, $cont) { 
                                                                        return $obj["jornada"] == 'N' 
                                                                                && $obj["ordem"] == $ordemAtual
                                                                                && $obj["ordem_ant"] == $cont;
                                                                     });
                                ?>
                                    <input type="checkbox" name="conclusaN<?php echo $page->ordem?>_<?php echo $cont; ?>" 
                                           id="conclusaN<?php echo $page->ordem?>_<?php echo $cont;?>" 
                                           onclick="javascript:salvarOrdemConclusa( <?php echo $page->ordem ?>, <?php echo $cont ?>, 'N')"  <?php
                                           if(sizeof($conclusaBD) == 1){
                                               echo 'checked="checked"';
                                           } ?>/>
                                <?php
                                        echo $cont;
                                    }
                                    ?>&nbsp;
                                </form>
                                
                            </td>
                            <td class="ordemJornada">
                                <?php if ($page->ordem > 1) {?>
                                <a href="#" onclick="javascript:OrdenarRegiaoPages(<?php echo $page->ordem?>,<?php echo ($page->ordem-1)?>, 'N'); return false;" class="btn btn-warning  btn-adm" title="Subir">
                                    <i class="fas fa-chevron-up"></i>
                                </a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-dark btn-adm" title="Região Permanente" onclick="return false;"><i class="fas fa-times"></i></a>
                                <?php } ?>

                                <?php if ($page->ordem < $countOutras) {?>
                                <a href="#" onclick="javascript:OrdenarRegiaoPages(<?php echo $page->ordem?>,<?php echo ($page->ordem+1)?>, 'N'); return false;" class="btn btn-warning  btn-adm" title="Descer">
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-dark btn-adm" title="Região Permanente" onclick="return false;"><i class="fas fa-times"></i></a>
                                <?php } ?>                            </td>
                        </tr>                        
                        <?php } ?>
                    </tbody>            
                </table>
            </div>

            <div class="row justify-content-between mt-5">
                <div class="col mr-5">
                    <button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas" style=" text-decoration:none; color: white; ">Cancelar</a> </button>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="container register">


</div>
