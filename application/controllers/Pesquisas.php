<?php

/* 	require '../third_party/api.php';

 */

class Pesquisas extends CI_Controller {

    private $unitid = null;

    public function __construct() {
        parent::__construct();
        permission();
        $this->load->library('session');
        $this->session_data = $this->session->userdata('logged_user');
        $this->load->model("Pesquisas_model");
        $this->load->model("Quiz_model");
        if (!isset($_SESSION['unitid'])) {
            $this->unitid = $this->Pesquisas_model->createSession($this->session_data['id']);
            $_SESSION['unitid'] = $this->unitid;
        }
    }

    public function index($id_page, $page_2, $nr_pesquisa = null) {
        $datas["title"] = 'Jornada de Autoconhecimento';

        $this->load->model("Pages_model");
        $this->load->model("Quiz_model");
        $datas["pages"] = $this->Pages_model->index();

        //A pesquisa com os dados copiados do FORMR
        $datas['pages_runs'] = $this->Quiz_model->showRuns($id_page);

        $datas["page_id"] = $id_page;
        $datas["page_id2"] = $page_2;

        $datas["studies"] = $this->Pesquisas_model->studies($id_page);

        $studies = $datas["studies"];
        
        if (empty($nr_pesquisa)){
            $nr_pesquisa = 1;
        }
        
        $datas["pesquisa_repetida"] = $nr_pesquisa;

//        if (empty($studies_id)) {
            $studies_id = $studies[0]['unit_id'];
            if (count($datas["studies"]) <= 0) {
                redirect("/index.php/dashboard");
            }
//        }

        $result = $this->Pesquisas_model->index($id_page, $studies_id, $studies[0]['id']);
        $survey = $result;
        
//print_r($studies);
//echo "<br />";
//echo '$id_page: ' . $id_page . "<br />";
//echo '$studies_id: ' . $studies_id . "<br />";
//echo '$studies[0][ id ]: ' . $studies[0]['id'] . "<br />";
//print_r($survey);
//echo "<br />";
//exit();

        $datas['success'] = $this->session->flashdata('success');
        $datas['error'] = $this->session->flashdata('error');

        foreach ($survey as $questao) {

            $resultList = $this->Pesquisas_model->choiceList($questao['choice_list'], $studies_id);
            $questao['list'] = $resultList;
            $questoes[] = $questao;
        }
        $datas['questoes'] = $questoes;

        $this->load->view('templates/mapas', $datas);
        $this->load->view('templates/nav-top2', $datas);
        $this->load->view('pages/pesquisas/index', $datas);
        $this->load->view('templates/footer', $datas);
        $this->load->view('templates/js', $datas);
    }

    public function resultado($id_page, $studies_id = null, $page_2 = null, $nr_pesquisa = null) {
        
                
        $datas["title"] = 'Jornada de Autoconhecimento';
        $datas["page_id"] = $id_page;
        $id_user = $this->session_data['id'];
        $now = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));       

        $datastudies = $_POST;
        $datastudies["session_id"] = $_SESSION['unitid'];
        $datastudies["study_id"] = $studies_id;
        $datas["study_id"] = $studies_id;
        
        //Validar a repeti????o na mesma sess??o - n??o permitir que grave duas vezes na mesma sess??o
        $this->load->model("Pages_model");       
        $qtd_session_id = $this->Pages_model->verificaEstudoSession($id_user, $id_page, $datastudies["session_id"], $nr_pesquisa);
        
        $datastudies["created"] = $now->format('Y-m-d H:i:s');
        $datastudies["modified"] = $now->format('Y-m-d H:i:s');
        $datastudies["ended"] = $now->format('Y-m-d H:i:s');
        unset($datastudies["next_studies_id"]);
        unset($datastudies["active_studies"]);
        unset($datastudies["active_studies_id"]);

        $result = $this->Pesquisas_model->studiesTable($studies_id);
        $keys = array_keys($datastudies);
        try {            
            $results_table = $result[0]['results_table'];
        } catch (Exception $e) {
            echo 'Exce????o capturada: ', $e->getMessage(), "\n";
        }

        if (empty($nr_pesquisa)) {
            $nr_pesquisa = 1;
        }
        
        $survey_studies_where = [
            'use_id' => $id_user,
            'id_page' => $id_page,
            'studies_id' => $studies_id,
            'nr_pesquisa' => $nr_pesquisa ];
        
        $find_survey_studies = $this->Pesquisas_model->countPerceResp($survey_studies_where);
        
        $datas['rest'] = false;
        if ((!isset($_POST['resposta'])) && ($find_survey_studies == 0)) {
            if ($qtd_session_id != 0){
                redirect("/index.php/dashboard");
            }
            // Grava no banco FORMR na tabela para a pesquisa as escolhas do usu??rio
            $this->Pesquisas_model->storeAll($keys, $results_table, $datastudies);
            
            $session_id = $_SESSION['unitid'];
        } else {
            $datas['rest'] = true;
            
            $sessionId = $this->Pages_model->getEstudoSession($id_user, $id_page, $nr_pesquisa);
            $session_id = $sessionId["session_id"];
        }

        //$content = file_get_contents('http://54.164.116.69/formr_org/tests/teste1.php/' . $_SESSION['unitid'] . '/' . $studies_id);
        //$content = file_get_contents('http://54.164.116.69/formr_org/tests/teste1.php/' . $session_id . '/' . $studies_id);

        if ( $this->config->item('base_url') != 'http://localhost:81/idor/') {
            $content = file_get_contents(CAMINHO_FORMR . $session_id . '/' . $studies_id);
            
            $datas["resultados2"] = $content;
        }
        $datas["resultados"] = $this->Pesquisas_model->result($id_page, $studies_id);
        
        if (count($datas["resultados"]) <= 0) {
            redirect("/index.php/dashboard");
        }
        $datas["studies"] = $this->Pesquisas_model->studies($id_page);
        $position = null;
        $resultado = $datas["resultados"][0];
        $flag = false;
        foreach ($datas["studies"] as $studies) {
            if ($studies['position'] > $resultado['position'] && $flag == false) {
                $datas['next_studies'] = $studies['unit_id'];
                $flag = true;
            }
        }
        if (!$flag) {
            $datas['next_studies'] = 'finish';
        }
        $countstudies = $this->Pesquisas_model->studies($id_page);
        


        // Gravar o percentual de execu????o quando gravar as respostas
        if ((!isset($_POST['resposta'])) && ($find_survey_studies == 0)) {
            $percent = [
                'use_id' => $id_user,
                'id_page' => $id_page,
                'studies_id' => $studies_id,
                'total' => count($countstudies),
                'percet' => (1 / count($countstudies)) * 100,
                'session_id' => $_SESSION['unitid'],
                'data_gravacao' => $now->format('Y-m-d '),
                'nr_pesquisa' => $nr_pesquisa
            ];
            $this->Pesquisas_model->createPerceResp($percent);
            
            //Envia email apenas quando grava os dados
            $this->send_mail($id_page, $studies_id, $page_2);            
        }

        $this->load->model("Pages_model");
        $this->load->model("Quiz_model");
        $datas["pages"] = $this->Pages_model->index();
        $datas['pages_runs'] = $this->Quiz_model->showRuns($id_page);

        $datas["page_id"] = $id_page;
        if (!empty($page_2)) {
            $datas["page_id2"] = $page_2; // nao entendi oq ?? esse page_2  tive que retirar pq estava quebrado os resultados do formR
        } else {
            $datas["page_id2"] = $id_page; //
        }

        $this->load->view('templates/mapas', $datas);
        $this->load->view('templates/nav-top2', $datas);
        $this->load->view('pages/pesquisas/resultado', $datas);
        $this->load->view('templates/footer', $datas);
        $this->load->view('templates/js', $datas);
    }

    public function send_mail($id_page, $studies_id, $page_2) {
        $id_user = $_SESSION['logged_user']['id'];

        $message = '<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
				<div class="text26982" style="">
					<div style="display: flex; background-color: #32549b; height: 50px; width: 100%;">
						<img width="100" height="45" src="<?= base_url() ?>assets/img/logo.png" />
					</div>

					<div class="text1549">
							<h1 style="margin-top: 20px; margin-bottom: 30px; text-align: center;">Questin??rio completo com sucesso!</h1>
							<p>Parab??ns! 
								Voc?? respondeu um question??rio no site Idor Sa??de Mental.
								Veja o resultado atrav??s desse link: 
							</p>
							<a href="' . $this->config->base_url() . 'index.php/pesquisas/pdf/' . $id_page . '/' . $id_user . '/' . $studies_id . '" class="button-pesquisas mt-5" id="exo_subtitle" style="background: #2C234D; padding: 7px 63px; border-radius: 30px; color: #fff;">Resultado</a>	
					</div>

				</div>

				<div style="display: flex; background-color: rgb(237,237,237); height: 80px; width: 100%; align-items: center; justify-content: center;">
					<span style="text-align: center; font-size: 15px; color: rgb(140,140,140)">IDOR Sa??de Mental</span>
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
				width: 100%; height: 60%; flex-direction: column; padding: 0 25%;
				align-items: center;
				display: flex;
				justify-content: space-around;
				text-align: center;
			}

			@media(max-width: 800px) {
				.text26982 {
					padding: 0 10% 0 7%;
				}
			}
		</style>
		';

        //email_padrao( $emailRemetente, $nomeRemetente, 
        //              $emailDestinatario, $nomeDestinatario, 
        //              $mensagem_html, $titulo)
        email_padrao(
                EMAIL_CONTATO,
                'Contato Sa??de Mental Idor',
                $_SESSION['logged_user']['email'],
                $_SESSION['logged_user']['name'],
                $message,
                'Questin??rio completo com sucesso!');
    }

    public function pdf($id_page, $id_user, $studies_id) {

        $datas['pages_runs'] = $this->Quiz_model->showRuns($id_page);
        $datas['id_page'] = $id_page;
        $datas["title"] = 'Respostas - Pesquisa-r';

        $content = file_get_contents('http://54.164.116.69/formr_org/tests/teste1.php/' . $_SESSION['unitid'] . '/' . $studies_id);

        $datas["resultados2"] = $content;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 20,
            'margin_bottom' => 30,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P',
        ]);
        $mpdf->showImageErrors = true;
        $mpdf->SetHTMLHeader('
		<div style="height: 30px; width: 100%; background-color: #32549b;">
		</div>');

        $mpdf->SetHTMLFooter('
		<div style="width: 100%; background-color: #32549b; text-align: center; padding: 20px 0; color: #fff; font-size: 12px;">
			<p>IDOR Sa??de Mental</p>
		</div>');

        ini_set("pcre.backtrack_limit", "100000000");
        $html = $this->load->view('pages/pesquisas/resposta-pdf', $datas, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function finish($id_page) {
        redirect("/index.php/dashboard/list/" . $id_page . "");
    }

    public function respostas($id_page, $page_id, $studies_id = null,  $nr_pesquisa = null) {
        $datas["title"] = 'Respostas - Pesquisa-r';

        if ($studies_id == 'finish') {
            redirect("/index.php/dashboard");
        }
        $this->load->model("Quiz_model");
        $this->load->model("Pesquisas_model");
        $this->load->model("Pages_model");

        $datas['pages_runs'] = $this->Quiz_model->showRuns($id_page);
        $datas["studies"] = $this->Pesquisas_model->studies($id_page);
        $studies = $datas["studies"];
        
        //$datas["page_id"] = $id_page;
        if (empty($studies_id)) {            
            $studies_id = $studies[0]['unit_id'];
            if (count($datas["studies"]) <= 0) {
                redirect("/index.php/dashboard");
            }
        }

        if(empty($nr_pesquisa)){

            $sessionsIds = $this->Pesquisas_model->getSessions($this->session_data['id']);
            $sessions = array();
            foreach ($sessionsIds as $sessionId) {
                $sessions[] = $sessionId->session_id;
            }
            $nr_pesquisa = 1;
        } else {

            $sessionId = $this->Pages_model->getEstudoSession($this->session_data['id'], $id_page, $nr_pesquisa);
                        
            if ($sessionId ) {
                if(! is_null( $sessionId["session_id"] ) ) {
                    $sessions = array();
                    $sessions[] = $sessionId["session_id"];
                } else {
                    redirect("/index.php/dashboard");
                }
            } else {
                redirect("/index.php/dashboard");
            }
        }

        $datas["nr_pesquisa"] = $nr_pesquisa;
        
        $resultTab = $this->Pesquisas_model->studiesTable($studies_id);
        
        if (sizeof($resultTab) == 0) {
            redirect("/index.php/dashboard");
        }        
        $result = $this->Pesquisas_model->getAllTablesFindSession(
                $resultTab[0]['results_table'],
                $sessions);
        //$result = $this->Pesquisas_model->getAllTables($resultTab[0]['results_table'], $_SESSION['unitid']);
//print_r($sessionsIds);
//echo '<br>';
//echo 'results_table: ' . $resultTab[0]['results_table'];
//echo '<br>';
//echo '$_SESSION[\'unitid\']: ' . $_SESSION['unitid'];
//echo '<br>';
//
//echo 'count($result): '. count($result);
//echo '<br>';
//
//exit();

        if (count($result) == 0) {
            redirect("/index.php/dashboard");
        }

        $result_perguntas = $this->Pesquisas_model->index($id_page, $studies_id, $studies[0]['id']);

        foreach ($result_perguntas as $result_pergunta) {
            $resultList = $this->Pesquisas_model->choiceList($result_pergunta['choice_list'], $studies_id);
            //print_r($resultList);
            $result_pergunta['list'] = $resultList;
            $perguntas[] = $result_pergunta;
        }

        $datas['perguntas'] = $perguntas;

        $datas['respostas'] = $result;
        $datas['next_studies'] = 'finish';

        $datas['unit_id'] = $studies_id;
        $datas['id_page'] = $id_page;

        $datas['id_page2'] = $page_id;

        $this->load->view('templates/mapas', $datas);
        $this->load->view('templates/nav-top2', $datas);
        $this->load->view('pages/pesquisas/resposta', $datas);
        $this->load->view('templates/footer', $datas);
        $this->load->view('templates/js', $datas);
    }

    public function pesquisashowif() {
        $resultList = $this->Pesquisas_model->showif($_POST['campo']);

        echo $resultList[0]['name'];
    }

}
