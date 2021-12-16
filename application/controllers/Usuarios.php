<?php
class Usuarios extends CI_Controller
{
	public $perfil = [
		1 => 'Super Administrador', 
		2 => 'Administrador',
		3 => 'Pesquisador',
		4 => 'Usuário', 
	];

	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->model("Users_model");
		$this->load->model("Termos_model");
		$this->load->library('session');
		$this->session_data = $this->session->userdata('message');
	}

	public function index()
	{
		$data["users"] = $this->Users_model->index();
		$data["termos"] = $this->Termos_model->index2();
		$data["title"] = 'Usuarios - Pesquisa-r';

		$data['success'] = $this->session->flashdata('success');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/usuarios/listagem', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function cadastro()
	{
		$data["title"] = 'Cadastro - Pesquisa-r';
		$data['perfil']= $this->perfil;

		$data['message'] = $this->session->flashdata('message');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/usuarios/cadastro',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function editar($id)
	{

		$data["users"] = $this->Users_model->show($id);
		$data['perfil']= $this->perfil;
		$data["title"] = 'Editar - Pesquisa-r';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/usuarios/editar', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function update($id, $perfil)
	{

		if (!empty($_FILES["img-upload"]["name"])) {
			$tmp_name = $_FILES["img-upload"]["tmp_name"];

			$name = basename($_FILES["img-upload"]["name"]);
			move_uploaded_file($tmp_name, "uploads/$name");
		} else {
			$name = $_POST["d-img-upload"];
		}

		$user = array(
			"name" => $_POST["name"],
			"funcao" => $_POST["funcao"], 
			"datanasc" => $_POST["datanasc"],
			"email" => $_POST["email"],
			"cpf" => $_POST["cpf"],
			"password" => md5($_POST["password"]),
			"ativo" => 'S',
			"img_user" => $name
		);

		if (empty($_POST["funcao"])) {
			unset($user["funcao"]);
		}

		if (empty($_POST["email"])) {
			unset($user["email"]);
		}

		if (empty($_POST["cpf"])) {
			unset($user["cpf"]);
		}

		if (empty($_POST["password"])) {
			unset($user["password"]);
		}

		$this->Users_model->update($id, $user);
		$this->session->set_flashdata("success", 'Usuário atualizado com sucesso');

		if($perfil == 's'){
			redirect("/index.php/dashboard/");
		} else {
			redirect("/index.php/usuarios/");
		}
	}

	public function store()
	{

		$tmp_name = $_FILES["img-upload"]["tmp_name"];

		$name = basename($_FILES["img-upload"]["name"]);
		move_uploaded_file($tmp_name, "uploads/$name");

		$user = array(
			"name" => $_POST["nome"],
			"funcao" => $_POST["funcao"],
			"datanasc" => $_POST["datanasc"],
			"email" => $_POST["email"],
			"password" => md5($_POST["password"]),
			"ativo" => 'S',
			"img_user" => $name
		);

		$email = $this->Users_model->getEmail($user['email']);
		if(!empty($email)){

			$this->session->set_flashdata('message', 'Esse email já esta cadastrado');
			redirect("index.php/usuarios/cadastro");

			die();
		}

		if($this->Users_model->store($user)){
			$this->session->set_flashdata("success", 'Usuário criado com sucesso');
			redirect("index.php/usuarios");		
		}
	}

	public function destroy($id)
	{
		$this->Users_model->destroy($id);
		$this->session->set_flashdata("success", 'Usuário deletado com sucesso');
		redirect("/index.php/usuarios/");
	}
}
