<?php
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
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
