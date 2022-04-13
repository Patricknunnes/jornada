<?php
class Runs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->model("quiz_model");

		$this->load->library('session');

		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}
	}

	public function index()
	{

		$this->load->model("Quiz_model");

		$data["title"] = 'Pesquisa - Pesquisa-r';
		$response = file_get_contents(''. $this->config->base_url() .'api/runs.php');
		$jsons = json_decode($response);
		foreach ($jsons as $json) {
			$pages = [
				'run_id' => $json->id,
				'run_titulo' => $json->name,
				'run_original' => $json->name,
			];
			$run = $this->Quiz_model->showRuns($json->id);
			if (count($run) <= 0) {
				$this->Quiz_model->storeRuns($pages);
			}
		}

		$data['pages'] = $this->Quiz_model->showsRuns();


		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/runs/listagem', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function show($id)
	{

		$this->load->model("Quiz_model");
		$this->load->model("Users_model");

		$data["title"] = 'Pesquisa - Pesquisa-r';

		$data['users'] = $this->Quiz_model->showReportRunsUser($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/runs/respostas', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function editar($id)
	{

		$this->load->model("Quiz_model");
		$data['pages'] = $this->Quiz_model->showRuns($id);
		$data["title"] = 'Editar - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/runs/editar', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function update($id)
	{
		$this->load->model("Quiz_model");
		$quiz = array(
			"run_titulo" => $_POST["titulo"],
			"run_descricao" => $_POST["descricao"]
		);

		$this->Quiz_model->updateRuns($id, $quiz);
		redirect("/index.php/runs/");
	}

	public function store()
	{


		$quiz = array(
			"titulo" => $_POST["titulo"],
			"link_planilha" => $_POST["link_planilha"],
			"ativo" => 'S',
		);

		$this->quiz_model->store($quiz);
		redirect("/index.php/questionarios/");
	}

	public function destroy($id)
	{

		$this->quiz_model->destroy($id);
		redirect("/index.php/questionarios/");
	}

	public function active($id)
	{

		$this->quiz_model->active($id);
		redirect("/index.php/questionarios/");
	}
}
