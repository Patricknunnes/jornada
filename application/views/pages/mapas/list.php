<?php if ($percent == 100.00 && $gif_regiao[0]['status'] == 1) { ?>
    <div id="overlay_regiao">

    </div>
<?php } ?>

<div class="header-mapas">
    <?php if ($percent == 100.00 && $gif_regiao[0]['status'] == 1) { ?>
        <div class="alert_regiao">
            <div class="gif_regiao">
                <img class="img-fluid" src="<?= base_url() ?>/assets/img/gif.gif" />
                <div class="text_gif">
                    <p>Parabéns!</p>
                    <p> Você completou a região <?php echo $tipo ?>!</p>
                    <p> Acesse o <a href="/index.php/dashboard/#dashboard">Dashboard</a> e veja os resultados!</p>
                </div>
            </div>
            <div class="container" style="position:absolute">
                <div class="container d-flex justify-content-end">
                    <button type="button" onclick="javascript:exitRegiao(<?php echo $page_id ?>)" id="exit-regiao-gif" style="background: none; border: none; z-index: 4;"><i class="fas fa-times" style="font-size: 23px; padding-top: 20px;"></i></button>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container text-left mt-3">
        <div class="mt-5">
            <h3 class="mb-3" style="color:#fff; font-family: Exo, Sans-serif;"><?php echo $title; ?></h3>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>index.php/dashboard" id="exo_subtitle" style="color:#fff">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff" id="exo_subtitle"><?php echo $title; ?></li>
            </ol>
        </nav>
    </div>
</div>
<?php
$session = $_SESSION['logged_user'];
$name = $session['name'];
?>
<div class="container content " style="height: 100%!important">

    <div class="container text-center mt-3 pt-5 pb-5">
        <div class="container text-center mt-3">
            <img class="img-regiao mt-4" src="<?= base_url('') ?>assets/img/<?php echo $icone; ?>" alt="" alt="">
            <div class="d-flex justify-content-start">
                    <!-- <a type="button" id="voltar-valores" class="icon1"><i class="fas fa-chevron-left"></i></a> -->
                <!-- <a type="button" id="voltar-valores1" class="text-4">Voltar região</a> -->

            </div>

            <div class="d-flex justify-content-end">
                    <!-- <a type="button" id="proximo-relacionamento" class="icon"><i class="fas fa-chevron-right"></i></a> -->
            </div>
            <p class="mt-2 pb-3"><span id="exo_title"><?php echo $tipo; ?></span></p>
            <p class=" mt-5" style="color: #424f8b; font-weight: bold; font-family: Exo, Sans-serif;">
                <?php echo number_format($percent, 0, ',', '.'); ?>%
            </p>

            <div class="progress">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: <?php echo $percent; ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="mt-3">
                <p class="text-1" id="poppins_text">
                    A <span id="poppins_title" style="color: #424f8b;">região <?php echo $tipo; ?></span> contém <?php echo $countpesquisa; ?> pesquisas.
                </p>
                <?php foreach ($pages as $page1) { ?>

                    <?php if ($page1['titulo'] == $tipo) { ?>
                        <p class="text-1" id="titles" style=" margin-top: -10px; padding: 0 15%; font-family: Poppins, sans-serif;">
                            <?php echo $page1['descricao'] ?>
                        </p>
                    <?php } ?>

                <?php } ?>

            </div>
            <div class="mt-3">
                <p class="text-1">
                    <img class="img-fluid" src="<?= base_url('') ?>assets/img/<?php echo $banner; ?>" alt="">
                </p>
            </div>
        </div>

        <?php if (empty($pages1)) { ?>
            <a style="text-decoration: none!important; color: #626367" href="<?= base_url() ?>index.php/paginas/editar/<?= $page_id; ?>">
                <p style="padding-bottom: 20px!important; font-family: Poppins;">Adicione novas pesquisas para essa região</p>
            </a>
        <?php } ?>

        <div class="perguntas mt-5" style="position: relative">
            <?php
            $i = 0;
            foreach ($pages1 as $page) {
                $i++
                ?>
            <div class="row" id="row_mobile" style="position:relative; z-index: 0;">
                
                <?php 
                // Recupera a quantidade exibida para o usuário
                foreach( $pageaux as $pagesuxAtu)  {
                    if ($pagesuxAtu["id_page"]==$page->id){
                        $puu = $pagesuxAtu;
                    }
                }                    
                if (($page->qtd_exibicao == 0 ) || ( $puu['cont_exibicao'] <= $page->qtd_exibicao )) { ?>
                    <div class="balao-ld" >
                        <div class="balao-ld-texto">
                            <?php echo str_replace("\r", "<br />", $page->texto_balao ); ?>
                        </div>
                    </div>
                <?php } ?>
                
                    <div class="col-1" style="position:relative; z-index: 0;">

                        <div class="perguntas-1 text-left" id="imagem_desk" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">

                            <div style="display: flex; margin-top: -3px; position: relative;">
                                <img src="<?php echo base_url() ?>/assets/img/icones/hexagon1.svg">
                                <span style="position: absolute; left: 12px; top: 5px; font-weight: bold; color: #fff;"><?php echo $i; ?></span>
                            </div>
                            <!-- <span class="badge" style="background-color:#32549b;"><?php echo $i; ?></span> -->
                            <!-- <br> -->
                            <span style="font-size: 12px"><?php if ($page->percent_new == 100.00) { ?><?php echo number_format($page->percent_new, 0, ',', '.'); ?>%</span><?php } ?>
                        </div>
                    </div>
                    <div class="col-3" id="p_mobile" style="position:relative; z-index: 0;">
                        <p class="text-1 " id="poppins_text" style="text-align: left;color:#32549b;">
                            <?php
                            if ($page->percent_new >= 100.00) {
                                echo 'Conquistado';
                            } else {
                                echo 'A Conquistar';
                            }
                            ?>
                        </p>
                    </div>
                    <div class="col-3" id="p_mobile" style="position:relative; z-index: 0;">
                        <i class="fas fa-check-circle" id="ckeck-i" style=" <?php if ($page->percent_new < 100.00) { ?> color: green; font-size: 32px; opacity: 0.4;
    <?php } else { ?> color: green; font-size: 32px; <?php } ?>">
                        </i>
                        <br />

                        <?php if ($page->percent_new < 100.00 && $page->percent_new > 0.00) { ?>
                            <a href="<?= base_url() ?>index.php/pesquisas/index/<?= $page->run_id; ?>/<?= $page->pag_id ?>" id="button-color-list"><button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Continuar</button></a>
                        <?php } ?>
                        <?php if ($page->percent_new == 0.00) { ?>
                            <a href="<?= base_url() ?>index.php/pesquisas/index/<?= $page->run_id; ?>/<?= $page->pag_id ?>" id="button-color-list"><button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Iniciar</button></a>
                        <?php } ?>

                        <?php if ($page->percent_new >= 100.00) { ?>
                            <a href="<?= base_url() ?>index.php/pesquisas/respostas/<?= $page->run_id; ?>/<?= $page_id; ?>" id="button-color-list">	<button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Ver Respostas</button></a>
    <?php } ?>
                    </div>
                    <div class="col-5" id="p_mobile" style="position:relative; z-index: 0;">
                        <p class="text-1" id="exo_subtitle" style="text-align: left; margin-left:30px;">
                            <b><?php echo $page->run_titulo; ?></b>
                        </p>
                        <p class="text-1 " id="poppins_text" style="text-align: left; margin-left:30px;">
    <?php echo $page->run_descricao; ?>
                        </p>
                    </div>
                    <div class="col-3" id="p_mobile2" style="position:relative; z-index: 0;">
                        <div class="col-3" id="p_mobile3">
                            <div id="p_mobile4" style="display: none; margin-top: -3px; position: relative;">
                                <img src="<?php echo base_url() ?>/assets/img/icones/hexagon1.svg">
                                <span style="position: absolute; left: 12px; top: 5px; font-weight: bold; color: #fff;"><?php echo $i; ?></span>
                            </div>
                            <p class="text-1 " id="poppins_text" style="text-align: left;color:#32549b; padding: 0; margin: 0; padding-left: 38px; padding-bottom: 6px; font-weight: bold;">
                                <?php
                                if ($page->percent_new >= 100.00) {
                                    echo 'Conquistado';
                                } else {
                                    echo 'A Conquistar';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="col-5" id="p_mobile2" style="position:relative; z-index: 0;">
                            <p class="text-1" id="exo_subtitle" style="text-align: left; margin-left:30px; margin-top: 19px;">
                                <b><?php echo $page->run_titulo; ?></b>
                            </p>
                            <p class="text-1 " id="poppins_text" style="text-align: left; margin-left:30px;">
    <?php echo $page->run_descricao; ?>
                            </p>
                        </div>
                        <i class="fas fa-check-circle" id="ckeck-i" style=" <?php if ($page->percent_new < 100.00) { ?> color: green; font-size: 32px; opacity: 0.4;
    <?php } else { ?> color: green; font-size: 32px; <?php } ?>">
                        </i>
                        <br />

    <?php if ($page->percent_new < 100.00 && $page->percent_new > 0.00) { ?>

                            <a href="<?= base_url() ?>index.php/pesquisas/index/<?= $page->run_id; ?>/<?= $page->pag_id ?>" id="button-color-list"><button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Continuar</button></a>

    <?php } ?>
    <?php if ($page->percent_new == 0.00) { ?>

                            <a href="<?= base_url() ?>index.php/pesquisas/index/<?= $page->run_id; ?>/<?= $page->pag_id ?>" id="button-color-list"><button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Iniciar</button></a>

                        <?php } ?>

    <?php if ($page->percent_new >= 100.00) { ?>

                            <a href="<?= base_url() ?>index.php/pesquisas/respostas/<?= $page->run_id; ?>/<?= $page_id; ?>" id="button-color-list"><button type="button" class="btn mt-5" id="exo_subtitle" style="width: 100% !important; padding: 10px 20px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">Ver respostas</button></a>

    <?php } ?>
                    </div>

                </div>
                <hr style="margin-bottom: 40px; position:relative; z-index:1;">
<?php } ?>
            <!-- <button type="button" class="button-pesquisas" onclick="javascript:onContinuar();">Voltar</button> -->

        </div>
    </div>
</div>

<style>
    @media(max-width: 768px) {
        #row_mobile {
            display: flex;
            flex-direction: column;
        }

        #ckeck-i {
            display: none !important;
        }

        .text-1 {
            text-align: center !important;
            margin-left: 0px !important;
        }

        #p_mobile {
            display: none;
            width: 100%;
            height: 100%;
        }

        #titles {
            padding: 0 !important;
        }

        #p_mobile2 {
            display: flex !important;
            width: 100%;
            height: 100%;
            flex-direction: column;
        }

        #p_mobile3 {
            display: flex !important;
            width: 100%;
        }
        #p_mobile4 {
            display: flex !important;

        }

        #imagem_desk {
            display: none!important;
        }
    }

    #p_mobile2,
    #p_mobile3 {
        display: none;
    }

    #button-color-list {
        color: #fff;
        width: 100%;
        height: 100%;
        text-decoration: none;
    }

    #button-color-list:hover {
        color: #fff;
    }
</style>

<script>
    if (<?php echo $percent ?> == 100.00 && <?php echo $gif_regiao[0]['status'] ?> == 1) {
        setTimeout(function () {
            $(".alert_regiao").css("display", "none");
            $("#overlay_regiao").css("display", "none");

            $.ajax({
                url: "<?php echo base_url() ?>index.php/dashboard/update_gif_regiao/<?php echo $page_id ?>",
                                type: "POST",
                            });
                        }, 30000);
                    }
</script>
