<?php
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->library('session');

		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}
	}

	public function index()
	{

		$data["title"] = 'Home - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}
}
