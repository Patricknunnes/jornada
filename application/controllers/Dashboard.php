<?php
class Dashboard extends CI_Controller
{
	public $tipo = [
		4 => ['titulo' => 'Valores', 'icone' => 'icones/Valores.png', 'banner' => 'valores_banner.png'],
		1 => ['titulo' => 'Personalidade', 'icone' => 'icones/regiao-personalidade.png', 'banner' => 'personalidade.png'],
		2 => ['titulo' => 'Relacionamentos', 'icone' => 'icones/regiao-relacionamentos.png', 'banner' => 'relacionamento.png'],
		3 => ['titulo' => 'Bem estar', 'icone' => 'icones/bem-estar.png', 'banner' => 'bem_estar.png'],
		5 => ['titulo' => 'Crenças', 'icone' => 'icones/regiao-crencas.png', 'banner' => 'espiritualidade.png'],
	];
	public $perfil = [
		1 => 'Super Administrador',
		2 => 'Administrador',
		3 => 'Pesquisador',
		4 => 'Usuário',
	];
	private $loggedUser;
	public function __construct()
	{
		parent::__construct();
		$this->loggedUser = permission();
		$this->load->library('session');
		$this->load->model("Termos_model");
		$this->load->model("Pages_model");
		$this->load->model("Pesquisas_model");
		$this->session_data = $this->session->userdata('logged_user');
	}

	public function index()
	{
		$this->load->model("Pages_model");
		$this->load->model("Users_model");
		$id = $this->session_data['id'];
		$regioes = ['use_id' => $id];
		$data["title"] = 'Jornada de Autoconhecimento';
		$data["pages"] = $this->Pages_model->index();

		$data["regioes"] = $this->Users_model->getsRegioes($regioes);

		$data["pages1"] = $this->Pages_model->showQuestions(['pag_id' => 1, 'use_id' => $id]);
		$data["pages2"] = $this->Pages_model->showQuestions(['pag_id' => 2, 'use_id' => $id]);
		$data["pages3"] = $this->Pages_model->showQuestions(['pag_id' => 3, 'use_id' => $id]);
		$data["pages4"] = $this->Pages_model->showQuestions(['pag_id' => 4, 'use_id' => $id]);
		$data["pages5"] = $this->Pages_model->showQuestions(['pag_id' => 5, 'use_id' => $id]);

		$data["countpesquisa"] = count($data["pages1"]);

		$data["countpesquisa2"] = count($data["pages2"]);

		$data["countpesquisa3"] = count($data["pages3"]);

		$data["countpesquisa4"] = count($data["pages4"]);

		$data["countpesquisa5"] = count($data["pages5"]);

		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages1"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'][] = $percent;

		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages2"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'][] = $percent;

		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages3"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'][] = $percent;

		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages4"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'][] = $percent;

		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages5"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'][] = $percent;

		$data["tipos"] = $this->tipo;

		foreach ($data['regioes'] as $ret) {

			if (
				$ret->tipo == 1 && @$data['percent'][0] == 100
				|| $ret->tipo == 2 && @$data['percent'][1] == 100
				|| $ret->tipo == 3 && @$data['percent'][2] == 100
				|| $ret->tipo == 4 && @$data['percent'][3] == 100
				|| $ret->tipo == 5 && @$data['percent'][4] == 100
			) {
				$data['regioes_percent'][] = $ret;
			}
		}

		$this->load->view('templates/mapas', $data);
		$this->load->view('templates/nav-top2', $data);
		$this->load->view('pages/mapas/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function list($op)
	{
		$this->load->model("Pages_model");
		$data['usid'] = $this->loggedUser['id'];
		$data['tipo'] = $this->tipo[$op]['titulo'];
		$data['icone'] = $this->tipo[$op]['icone'];
		$data['banner'] = $this->tipo[$op]['banner'];

		$data['page_id'] = $op;

		$heads["title"] = 'Jornada de Autoconhecimento';
		$data["pages"] = $this->Pages_model->index();

		$data["pages1"] = $this->Pages_model->showQuestions(['pag_id' => $op, 'use_id' => $data['usid']]);
		$conta = 0;
		$percent_new = 0;
		foreach ($data["pages1"] as $page) {
			$percent_new  = $percent_new + $page->percent_new;
			$conta++;
		}
		if ($conta == 0) {
			$conta = 1;
		}
		$percent = $percent_new / $conta;
		$data['percent'] = $percent;
		$data["countpesquisa"] = count($data["pages1"]);

		$getGifRegiao = $this->Pages_model->getRegiao($_SESSION['logged_user']['id'],	$data['page_id']);

		if (empty($getGifRegiao)) {

			$data['gif_regiao'][]['status'] = 1;
		} else {

			$array = json_decode(json_encode($getGifRegiao), true);

			$data['gif_regiao'] = $array;
		}

		$this->load->view('templates/mapas', $heads);
		$this->load->view('templates/nav-top2', $heads);
		$this->load->view('pages/mapas/list', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function perfil($id)
	{
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

	public function feedback($id)
	{
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

	public function send_mail()
	{

		$message =
			'<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
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


		$this->load->library('email');

		$this->email->from($_SESSION['logged_user']['email'], $_SESSION['logged_user']['name']);
		$this->email->to('gabriel.carmo@devcodes.com.br');

		$this->email->subject('FeedBacks');
		$this->email->message($message);

		$id_user = $_SESSION['logged_user']['id'];


		if ($this->email->send()) {
			redirect("/index.php/dashboard/feedback/$id_user");
		} else {
			redirect("/index.php/dashboard/feedback/$id_user");
		}
	}

	public function escolha()
	{
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

	public function storeescolha()
	{
		redirect("/index.php/dashboard");
	}

	public function resultados($regiao = null)
	{


		$this->load->model("Pages_model");
		$this->load->model("Users_model");
		$this->load->model("Pesquisas_model");

		$data['regiao'] = $regiao;
		$data['usu_id'] = $this->session_data['id'];

		$data['graficos'] = $this->Pesquisas_model->graficos_select($data);
		// print_r($data);

		$id = $this->session_data['id'];
		$regioes = ['use_id' => $id];
		$data["title"] = 'Resultados';
		$data["pages"] = $this->Pages_model->index();
		$allRegioes = $this->Users_model->getsRegioes($regioes);
		foreach ($allRegioes as $ret) {
			if ($ret->tipo == $regiao) {
				$data['regioes'] = $ret;
			}
		}

		$questionsAll =  $this->Pages_model->showQuestions(['pag_id' => $regiao, 'use_id' => $id]);
		$conta = 0;
		$percent = 0;
		foreach ($questionsAll as $question) {

			$percent = $question->percent_new;
			$conta++;
			if ($percent == 100) {
				$data["countpesquisa"] = count($questionsAll);
			}
		}

		$filter['pag_id'] = $regiao;

		$results = $this->Pages_model->showQuestions($filter);

		foreach ($results as $ret) {

			$resultTab = $this->Pesquisas_model->studiesTable($ret->run_id);
			// print_r($resultTab);

			if (!empty($resultTab)) {

				$result_respostas = $this->Pesquisas_model->getAllTables($resultTab[0]['results_table']);

				foreach ($result_respostas as $rrep) {
					$total_questoes[] = count($rrep);
				}
				$data['total_questoes'] = array_sum($total_questoes);
			} else {
				$data['total_questoes'] = 0;
			}
		}


		$data["tipos"] = $this->tipo;
		$this->load->view('templates/mapas', $data);
		$this->load->view('templates/nav-top2', $data);
		$this->load->view('pages/mapas/resultados', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}


	public function update_gif_regiao($id_page)
	{

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
