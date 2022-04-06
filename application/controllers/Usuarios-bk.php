<?php
class Usuarios extends CI_Controller
{
	public $perfil = [
		1 => 'Administrador',
		2 => 'Usuário',
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
		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}
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
		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}
		$data["title"] = 'Cadastro - Pesquisa-r';
		$data['perfil'] = $this->perfil;

		$data['message'] = $this->session->flashdata('message');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/usuarios/cadastro', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function editar($id)
	{

		if ($this->session->logged_user['funcao'] == '2') {
			redirect('index.php/dashboard/');
		}	
		$data["users"] = $this->Users_model->show($id);
		$data['perfil'] = $this->perfil;
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

		if (empty($_POST["cpf"])) {
			$_POST["cpf"] = "";
		}

		if (empty($_POST["email"])) {
			$_POST["email"] = "";
		}

		$user = array(
			"name" => $_POST["name"],
			// "funcao" => $_POST["funcao"],
			"datanasc" => $_POST["datanasc"],
			"email" => $_POST["email"] ? $_POST["email"] : " ",
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

		if (empty($_POST["funcao"])) {
			unset($user["funcao"]);
		}

		if (empty($_POST["cpf"])) {
			unset($user["cpf"]);
		}
		// if (empty($_POST["password"])) {
		// 	unset($user["password"]);
		// }


		// print_r(md5($_POST["password2"]));

		// echo '<pre>';
		
		// print_r($user["password"]);
		
		// exit;
		$r = $this->Users_model->show($this->session->logged_user['id']);
		if (md5($_POST["password2"]) == $r['password']) {
			$this->Users_model->update($id, $user);
			$this->session->set_flashdata("success", 'Usuário atualizado com sucesso');
			if ($perfil == 's') {
				redirect("/index.php/dashboard/perfil/".$id);
			} else {
				redirect("/index.php/usuarios/");
			}
		} else {
			$this->session->set_flashdata("success", 'Sua senha atual não é valida');
			if ($perfil == 's') {
				redirect("/index.php/dashboard/perfil/".$id);
			} else {
				redirect("/index.php/usuarios/");
			}
		}
		
	}

	public function store()
	{

		$tmp_name = $_FILES["img-upload"]["tmp_name"];

		$name = basename($_FILES["img-upload"]["name"]);
		move_uploaded_file($tmp_name, "uploads/$name");

		$user = array(
			"name" => $_POST["nome"],
			"funcao" => 2,
			"datanasc" => $_POST["datanasc"],
			"email" => $_POST["email"],
			"password" => md5($_POST["password"]),
			"ativo" => 'S',
			"img_user" => $name
		);

		$email = $this->Users_model->getEmail($user['email']);
		if (!empty($email)) {

			$this->session->set_flashdata('message', 'Esse email já esta cadastrado');
			redirect("index.php/usuarios/cadastro");

			die();
		}

		if ($this->Users_model->store($user)) {
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
