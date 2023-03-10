<?php

class Dashboard extends CI_Controller {

    /*
    public $tipo = [
        4 => ['titulo' => 'Valores', 'icone' => 'icones/Valores.png', 'banner' => 'valores_banner.png'],
        1 => ['titulo' => 'Personalidade', 'icone' => 'icones/regiao-personalidade.png', 'banner' => 'personalidade.png'],
        2 => ['titulo' => 'Relacionamentos', 'icone' => 'icones/regiao-relacionamentos.png', 'banner' => 'relacionamento.png'],
        3 => ['titulo' => 'Bem estar', 'icone' => 'icones/bem-estar.png', 'banner' => 'bem_estar.png'],
        5 => ['titulo' => 'Crenças', 'icone' => 'icones/regiao-crencas.png', 'banner' => 'espiritualidade.png'],
    ];
    */
    
    public $perfil = [
        1 => 'Administrador',
        2 => 'Usuário',
    ];
    private $loggedUser;

    public function __construct() {
        parent::__construct();
        $this->loggedUser = permission();
        $this->load->library('session');
        $this->load->model("Termos_model");
        $this->load->model("Pages_model");
        $this->load->model("Pesquisas_model");
        $this->session_data = $this->session->userdata('logged_user');
    }

    public function index() {
        
        $this->load->model("Pages_model");
        $this->load->model("Users_model");

        $id = $this->session_data['id'];
        $regioes = ['use_id' => $id];
        $data["title"] = 'Jornada de Autoconhecimento';

        $data["pages"] = $this->Pages_model->index();

        //Apresentação do balão
        $data["pagesux"] = $this->Pages_model->updateContaUx($id);
        $data['percent'] = $this->Pages_model->showQuestionsPerc( $id );


        $data['regioes_percent'] = array();
        $data['jornada_percent'] = array();
        foreach ($data['pages'] as $ret) {
            $retId = $ret["id"];
            $percRegiao = array_values( array_filter(
                                        $data['percent'],
                                        function($obj) use ( $retId) { 
                                            return $obj->pag_id == $retId; 
                                         })); 

            if (count($percRegiao) > 0) {
                if ( $percRegiao[0]->perc == 100 ) {
                    $data['regioes_percent'][] = $ret;
                }
                if ( 
                    ($percRegiao[0]->perc == 100)
                    &&
                    ($ret["pertence_a_jornada"]  == "S")
                    ) {
                    $data['jornada_percent'][] = $ret;
                }
            }
        }
                
        $data["pagesOrdensConclusas"] = $this->Pages_model->getOrdensConclusasExibicao( $id, 0 );
       
        $this->load->view('templates/mapas', $data);
        $this->load->view('templates/nav-top2', $data);
        $this->load->view('pages/mapas/index', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/js');
    }

    public function list($op) {
        //$op = região

        $this->load->model("Pages_model");
        $data['usid'] = $this->loggedUser['id'];
        
        $regioes =  $this->Pages_model->gets($op);

        if (count($regioes) <= 0) {
            redirect("/index.php/dashboard");
        }
        
        $data['regiao'] = $regioes[0];
        
        $pagesOrdensConclusas = $this->Pages_model->getOrdensConclusasExibicao( $data['usid'], $op );
        $pagesOrdensConclusas = $pagesOrdensConclusas[0];
        
        $percents = $this->Pages_model->showQuestionsPerc( $data['usid'] );
        $cont100perc = 0;
        foreach ( $percents as $percent) {
            if (($percent->perc == 100) && ($percent->pertence_a_jornada == 'S')) {
                $cont100perc++;
            }
        }
        
        if (
            ($pagesOrdensConclusas->necessita_regiao == 'S') && ( $pagesOrdensConclusas->perc < 100)
            ||
            ( $data['regiao']->aguarda_jornada == "S"
            &&
            $cont100perc < 5 )
            ) {
           redirect("/index.php/dashboard"); 
        }
                            
        $data['page_id'] = $op;
        if (isset($_SESSION['unitid'])) {
            $data['session_id'] = $_SESSION['unitid'];
        } else {
            $data['session_id'] = -1;
        }

        //Apresentação do balão
        $data["pageaux"] = $this->Pages_model->updateContaUxPesq($data['usid'], $data['page_id']);

        $heads["title"] = 'Jornada de Autoconhecimento';
        $data["pages"] = $this->Pages_model->index();

        //Retorna as Pesquisas da região informada
        $data["pages1"] = $this->Pages_model->showQuestions(['pag_id' => $op, 'use_id' => $data['usid']]);

        $conta = 0;
        $percent_new = 0;
        foreach ($data["pages1"] as $page) {
            $percent_new = $percent_new + $page->percent_new;
            $conta++;
        }
        if ($conta == 0) {
            $conta = 1;
        }
        $percent = $percent_new / $conta;

        //Percentual total da Região
        $data['percent'] = $percent;

        //Número de pesqusisas da região
        $data["countpesquisa"] = count($data["pages1"]);

        $getGifRegiao = $this->Pages_model->getRegiao($_SESSION['logged_user']['id'], $data['page_id']);

        if (empty($getGifRegiao)) {

            $data['gif_regiao'][]['status'] = 1;
        } else {

            $array = json_decode(json_encode($getGifRegiao), true);

            $data['gif_regiao'] = $array;
        }

        $data["pesquisas_jornada"] = $this->Pages_model->getTotPesquisasJornada($data['usid']);
        $data["pesquisas_repetidas"] = $this->Pages_model->getPesquisasRepetidas($data['usid'], $data['page_id']);

        $this->load->view('templates/mapas', $heads);
        $this->load->view('templates/nav-top2', $heads);
        $this->load->view('pages/mapas/list', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/js');
    }

    public function perfil($id) {
        $id = $this->session_data['id'];
        $data['message'] = $this->session->flashdata('success');
        $this->load->model("Users_model");
        $data["users"] = $this->Users_model->show($id);
        $data['perfil'] = $this->perfil;
        $data["title"] = 'Perfil';
        $data["termos"] = $this->Termos_model->index($id);

        $this->load->view('templates/mapas', $data);
        $this->load->view('templates/nav-top2', $data);
        $this->load->view('pages/mapas/perfil', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('templates/js', $data);
    }

    public function feedback($id) {
        $this->load->model("Users_model");
        $data["users"] = $this->Users_model->show($id);
        $data['perfil'] = $this->perfil;
        $data["title"] = 'Contato';
        $this->load->view('templates/mapas', $data);
        $this->load->view('templates/nav-top2', $data);
        $this->load->view('pages/mapas/feedback', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('templates/js', $data);
    }

    public function send_mail() {

        $id_user = $_SESSION['logged_user']['id'];

        $message = '<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
				<div class="text26982" style="">
					<div style="display: flex; background-color: #32549b; height: 50px; width: 100%;">
						<img width="100" height="45" src="<?= base_url() ?>assets/img/logo.png" />
					</div>

					<div class="text1549">
							<h1 style="margin-top: 20px;	margin-bottom: 30px;">Feedbacks</h1>

								
							<p style="word-break: break-word; text-align: justify;">' . $_POST['texto'] . '<p>
					</div>

				</div>

				<div style="display: flex; background-color: rgb(237,237,237); height: 80px; width: 100%; align-items: center; justify-content: center;">
					<span style="text-align: center; font-size: 15px; color: rgb(140,140,140)">IDOR Saúde Mental</span>
				</div>
			</div>
		</div>
		
		<style>
			.text26982 {
				width: 100%; height: 100%; flex-direction: column; padding: 0 25%;
				display: flex;
				align-items: center;
			}

			.text1549 {
				width: 100%; height: 100%; flex-direction: column; padding: 0 25%;
				align-items: center;
				display: flex;
			}

			@media(max-width: 800px) {
				.text26982 {
					padding: 0 10% 0 7%;
				}
			}
		</style>
		';

        if (email_padrao(
                        $_SESSION['logged_user']['email'],
                        $_SESSION['logged_user']['name'],
                        EMAIL_CONTATO,
                        'Contato Saúde Mental Idor',
                        $message,
                        'FeedBacks')) {
            redirect("/index.php/dashboard/feedback/$id_user");
        } else {
            redirect("/index.php/dashboard/feedback/$id_user");
        }
    }

    public function escolha() {
        $this->load->model("Users_model");
        $id = $this->session_data['id'];
        $data["users"] = $this->Users_model->show($id);
        $data['perfil'] = $this->perfil;
        $data['tipos'] = $this->tipo;
        $data["title"] = 'Escolha a ordem das regiões de autoconhecimento';

        $regioes = ['use_id' => $id];

        $data["regioes"] = $this->Users_model->getRegioes($regioes);

        if (!empty($data["regioes"])) {

            //redirect("/index.php/dashboard");
        }

        $this->load->view('templates/mapas', $data);
        $this->load->view('templates/nav-top2', $data);
        $this->load->view('pages/mapas/escolha', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('templates/js', $data);
    }

    public function storeescolha() {
        redirect("/index.php/dashboard");
    }

    public function resultados($regiao = null) {


        $this->load->model("Pages_model");
        $this->load->model("Users_model");
        $this->load->model("Pesquisas_model");

        if ( $regiao < 6 ) {
            $regiaoVet = ($this->Pages_model->gets($regiao));
            $data["regiaoAtual"] = $regiaoVet[0];
            
        } else  {
            redirect("/index.php/dashboard");
        }
        
        $data['regiao'] = $regiao;
        $data['usu_id'] = $this->session_data['id'];

        $data['graficos'] = $this->Pesquisas_model->graficos_survey_studies($data);
        // print_r($data);

        $id = $this->session_data['id'];
        $regioes = ['use_id' => $id];
        $data["title"] = 'Resultados';
        $data["pages"] = $this->Pages_model->index();
        
        $questionsAll = $this->Pages_model->showQuestions(['pag_id' => $regiao, 'use_id' => $id]);

        $conta = 0;
        $percent = 0;
        foreach ($questionsAll as $question) {

            $percent = $question->percent_new;
            $conta++;
            if ($percent == 100) {
                $data["countpesquisa"] = count($questionsAll);
            }
        }

        $results = $this->Pages_model->showQuestionsUserStudiesId(
                ['pag_id' => $regiao, 'use_id' => $id]);

        $sessionsIds = $this->Pesquisas_model->getSessions($id);

        $sessions = array();
        foreach ($sessionsIds as $sessionId) {
            $sessions[] = $sessionId->session_id;
        }

        foreach ($results as $ret) {

            $resultTab = $this->Pesquisas_model->studiesTable($ret->studies_id);


            if (!empty($resultTab)) {

                $result_respostas = $this->Pesquisas_model->getAllTablesFindSession(
                        $resultTab[0]['results_table'],
                        $sessions);

                foreach ($result_respostas as $rrep) {
                    $total_questoes[] = count($rrep);
                }

                //Foram reduzidas 9 colunas da tabela
                // que estavam sendo contadas como respostas
                // session_id, study_id, created, modified, ended, fbnumber
                // note_fb_2, note_fb_3, note_fb_4
                $data['total_questoes'] = array_sum($total_questoes) - 9;
            } else {
                $data['total_questoes'] = 0;
            }
        }
        

        $this->load->view('templates/mapas', $data);
        $this->load->view('templates/nav-top2', $data);
        $this->load->view('pages/mapas/resultados', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/js');
    }

    public function update_gif_regiao($id_page) {

        $getGifRegiao = $this->Pages_model->getRegiao($_SESSION['logged_user']['id'], $id_page);

        if (empty($getGifRegiao)) {

            $regiao = array(
                "id_page" => $id_page,
                "id_user" => $_SESSION['logged_user']['id'],
                "status" => 0
            );

            $this->Pages_model->insertRegiaoGif($regiao);
        } else {
            return;
        }
    }

}
