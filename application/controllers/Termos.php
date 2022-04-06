<?php
class Termos extends CI_Controller
{

	public $session_data;

	public function __construct()
	{
		parent::__construct();
		//permission();

		$this->load->library('session');
		$this->session_data = $this->session->userdata('logged_user');

		$this->load->model("Termos_model");
	}

	public function index()
	{
		$id = @$this->session_data['id'];
		
		$return = $this->Termos_model->index($id);

		 if (count($return) > 0) {
		 	redirect("/index.php/dashboard/");
		 }

		$data["title"] = 'Termos - Pesquisa-r';

		$this->load->view('templates/header', $data);

		$this->load->view('pages/termos/index');
		// $this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function store()
	{
		print_r($this->session_data);
		$id = $this->session_data['id'];

		if ($_POST["flexRadioDefault"] != 'n') {
			$termo = array(
				"data_hora" => date('Y-m-d H:i:s'),
				"ip" => $_SERVER["REMOTE_ADDR"],
				"id_user" =>  $id,
				"status" => $_POST["flexRadioDefault"],
			);

			$this->Termos_model->store($termo);
			redirect("/index.php/dashboard/escolha");
		} else {
			redirect("/index.php/login/");
		}
	}
}
