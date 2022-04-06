<?php
class Regioes extends CI_Controller
{

	public $session_data;
	public $tipo = [
		4 => ['titulo' => 'Valores', 'icone' => 'icones/regiao-valores.png', 'banner' => 'valores_banner.png'],
		1 => ['titulo' => 'Personalidade', 'icone' => 'icones/regiao-personalidade.png', 'banner' => 'personalidade.png'],
		2 => ['titulo' => 'Relacionamentos', 'icone' => 'icones/regiao-relacionamentos.png', 'banner' => 'relacionamento.png'],
		3 => ['titulo' => 'Bem estar', 'icone' => 'icones/regiao-bem-estar.png', 'banner' => 'bem_estar.png'],
		5 => ['titulo' => 'Crenças', 'icone' => 'icones/regiao-crencas.png', 'banner' => 'espiritualidade.png'],
	];
	public function __construct()
	{
		parent::__construct();
		permission();

		$this->load->library('session');
		$this->session_data = $this->session->userdata('logged_user');

		$this->load->model("Users_model");

		//if ($this->session->logged_user['funcao'] == '2') {
		//	redirect('index.php/dashboard/');
		//}
	}

	public function store2()
	{

		$id = $this->session_data['id'];
		try{ 
			//$this->Users_model->deleteOrderUser($id);
			for ($i = 1; $i <= 5; $i++) {
				$re[$i] = $_POST['ordem_' . $i];
			}

			$uni = array_unique($re);
			if(count($uni)<=4){
				echo "Uma ou mais regiões estão ordenadas com o número, por favor escolha outro";
				return http_response_code(200);
			}

			for ($i = 1; $i <= 5; $i++) {
				$regioes = [
					'use_id' => $id,
					'orr_ordem' => $_POST['ordem_' . $i],
					'tipo' => $i,
				];

				$return = $this->Users_model->regioes($regioes);
			}

			if (!$return) {

				echo "Uma ou mais regiões estão ordenadas com o número, por favor escolha outro";
				return http_response_code(200);
			}

			if ($return) {
				echo "index.php/dashboard";
				return http_response_code(200);
			}
			return http_response_code(200);
		}catch (Exception $e) {
			echo 'Exceção capturada: ',  $e->getMessage(), "\n";
			return http_response_code(401);
		}
	}



	public function store()
	{
		$regioes = [
			'use_id' => $_POST['usu'],
			'orr_ordem' => $_POST['ordem'],
			'tipo' => $_POST['tipo'],
		];

		$return = $this->Users_model->regioes($regioes);

		if (!$return) {

			echo "Uma ou mais regiões estão ordenadas com o número, por favor escolha outro";
			$this->Users_model->regiaoUniqueDestroy($regioes['use_id'], $regioes['orr_ordem']);
		}
	}

	public function validate($use)
	{

		$regioes = ['use_id' => $use];
		$return = $this->Users_model->getRegioes($regioes);
		if ($return >= count($this->tipo)) {
			echo "go";
		} else {
			echo "Falta selecionar ordem de região";
		}
	}

	public function cancelar($id)
	{
		$id_usuario = ['use_id' => $id];

		$return = $this->Users_model->getRegioes($id_usuario);

		if ($return >= 1) {
			echo "go";
		} else {
			echo "Falta selecionar ordem de região";
		}

		$this->Users_model->regiaoDestroy($id_usuario);
	}
}
