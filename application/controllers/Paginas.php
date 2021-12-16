<?php
class Paginas extends CI_Controller
{

	public $tipo = [
		4 => 'Valores',
		1 => 'Personalidade',
		2 => 'Relacionamentos',
		3 => 'Bem estar',
		5 => 'Crenças',
	];
	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->model("Pages_model");
		$this->load->model("Quiz_model");
		$this->load->model("Users_model");
		$this->load->library('session');
		$this->session_data = $this->session->flashdata('success');
	}

	public function index()
	{

		$data["pages"] = $this->Pages_model->index();

		$data["title"] = 'Paginas - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/paginas/listagem', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function cadastro()
	{
		$data["title"] = 'Cadastro - Pesquisa-r';
		$data["quiz"] = $this->Quiz_model->index();

		$response = file_get_contents('http://157.245.219.190/api/runs.php');
		$jsons = json_decode($response);
		foreach ($jsons as $json) {
			$pages[] = [
				'id' => $json->id,
				'name' => $json->name,
			];
		}
		$data['pages_formr'] = $pages;
		$data['tipo'] = $this->tipo;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/paginas/cadastro');
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function store()
	{
		$tmp_name = $_FILES["img-upload"]["tmp_name"];

		$name = basename($_FILES["img-upload"]["name"]);
		move_uploaded_file($tmp_name, "uploads/$name");

		$pages = array(
			"titulo" => $_POST["titulo"],
			"descricao" => $_POST["descricao"],
			"cor-texto" => $_POST["cor-texto"],
			"cor_desc" => $_POST["cor_desc"],
			"questionario" => $_POST["questionario"],
			"img_pages" => $name,
			"link_formr" => $_POST["link_formr"],
			"tipo" => $_POST["tipo"],
		);

		$this->Pages_model->store($pages);

		redirect("/index.php/paginas/");
	}

	public function editar($id)
	{

		$filter['pag_id'] = $id;
		$data["questionarios"] = $this->Pages_model->showQuestions($filter);

		$data["pages"] = $this->Pages_model->show($id);
		$data["quiz"] = $this->Quiz_model->showsRuns();
		$response = file_get_contents('http://157.245.219.190/api/runs.php');
		$jsons = json_decode($response);
		foreach ($jsons as $json) {
			$pages[] = [
				'id' => $json->id,
				'name' => $json->name,
			];
		}
		//print_r($pages);

		$data['success'] = $this->session->flashdata('success');

		$data['pages_formr'] = $pages; //$this->Quiz_model->showsRuns(); 
		$data['tipo'] = $this->tipo;
		$data["title"] = 'Editar - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/paginas/editar', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function update($id)
	{

		if (!empty($_FILES["img-upload"]["name"])) {
			$tmp_name = $_FILES["img-upload"]["tmp_name"];

			$name = basename($_FILES["img-upload"]["name"]);
			move_uploaded_file($tmp_name, "uploads/$name");
		} else {
			$name = $_POST["d-img-upload"];
		}

		$page = array(
			"titulo" => $_POST["titulo"],
			"descricao" => $_POST["descricao"],
			"dash_descricao" => $_POST["dash_descricao"],
			"cor-texto" => $_POST["cor-texto"],
			"cor_desc" => $_POST["cor_desc"],
			"questionario" => $_POST["questionario"],
			"link_formr" => $_POST["link_formr"],
			"tipo" => $_POST["tipo"],
			"img_pages" => $name
		);

		$this->Pages_model->update($id, $page);
		redirect("/index.php/paginas/");
	}

	public function destroy($id)
	{
		$this->load->model("Pages_model");
		$this->Pages_model->destroy($id);
		redirect("/index.php/paginas/");
	}

	public function destroyRegiao()
	{

		$id = $_POST["id"];
		$pag_id = $_POST["pag_id"];

		$this->load->model("Pages_model");
		$this->Pages_model->destroyRegiao($id, $pag_id);
	}

	public function pages()
	{
		$data["title"] = 'Dashboard - Pesquisa-r';

		$this->load->view('templates/mapas', $data);
		$this->load->view('pages/paginas/pages');
	}

	public function setPesquisa()
	{
		$page = array(
			"pag_id" => $_POST["pag_id"],
			"id" => $_POST["id"],
			"run_titulo" => $_POST["run_titulo"],
		);

		$this->Pages_model->setPage($page);
		echo '<tr id=' . $_POST["id"] . '><th>' . $_POST["id"] . '</th><td>' . $_POST["run_titulo"] . '</td><td><a onclick="javascript:deletarRegiaoPage(' . $_POST["id"] . ', ' . $_POST["pag_id"] . ')"  class="btn btn-danger"><i class="fas fa-trash-alt"></i></a><td></tr>';
	}

	public function send_mail()
	{
		$message =
			'<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
				<div class="text26982" style="">
					<div style="display: flex; background-color: #32549b; height: 50px; width: 100%;">
						<img width="100" height="45" src="<?= base_url() ?>assets/img/logo.png" />
					</div>

					<div class="text1549" style="text-align: center;">
							<h1 style="margin-top: 20px; margin-bottom: 30px; text-align: center;">Novos Questionários</h1>
							<p>
								Novos Questionários cadastrados na plataforma,  
							</p>
							<p>
								Para acessar clique no botão abaixo:
							</p>
							<a href="http://157.245.219.190/" class="button-pesquisas mt-5" id="exo_subtitle" style="background: #2C234D; padding: 7px 63px; border-radius: 30px; color: #fff;">Acessar</a>	
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

		$users = $this->Users_model->index();

		$this->load->library('email');

		foreach ($users as $user) {
			$this->email->from('gabriel.carmo@devcodes.com.br');
			$this->email->to($user['email']);

			$this->email->subject('Novos Questionários');
			$this->email->message($message);
	
			if ($this->email->send()) {
	
			} else {
	
			}
		}
	}
}
