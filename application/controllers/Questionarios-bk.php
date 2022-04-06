<?php
class Questionarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->model("quiz_model");
		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}
	}

	public function index()
	{

		
		$data["title"] = 'Questionarios - Pesquisa-r';
		$response = file_get_contents('http://3.226.10.237/api/surveys.php');
		//print_r($response);
		$jsons = json_decode($response);
		foreach($jsons as $json){
			//print_r($json);
			$validade = $this->quiz_model->validateFormr($json->id);
			if(@count($validade)<=0){
				$quiz = [
					'id_formr' => $json->id, 
					'titulo' => $json->name , 
					'user_formr' => $json->email, 
					'date_formr' => $json->created,
					'link_planilha' => 'https://docs.google.com/spreadsheets/d/'.$json->google_file_id,
				];
				
				$this->quiz_model->store($quiz);
			}		
		}
		$data["quiz"] = $this->quiz_model->index();
		//$data["quiz"] = $this->quiz_model->store($id);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/questionarios/listagem', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function cadastro()
	{
		$data["title"] = 'Cadastro - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/questionarios/cadastro');
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function editar($id)
	{

		$data["quiz"] = $this->quiz_model->show($id);
		$data["title"] = 'Editar - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/questionarios/editar', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function update($id)
	{


		$quiz = array(
			"titulo" => $_POST["titulo"],
			"link_planilha" => $_POST["link_planilha"],
			"ativo" => 'S',
		);

		$this->quiz_model->update($id, $quiz);
		redirect("/index.php/questionarios/");
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
