<?php
class Login extends CI_Controller
{

	public $session_data;

	public function __construct()
	{
		parent::__construct();
		//permission();

		$this->load->library('session');
		$this->session_data = $this->session->userdata('message');
	}

	public function index()
	{
		@session_destroy($this->session_data);
		$data['message'] = $this->session->flashdata('message');
		$data['successLogin'] = $this->session->flashdata('successLogin');
		//	print_r($data);
		//$this->session->unset_userdata(['message','success' ]);

		$data["title"] = 'Login - Pesquisa-r';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/login', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function register()
	{
		$data['message'] = $this->session->flashdata('message');
		$data["title"] = 'Registro - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/registro', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function forgot()
	{
		$data["title"] = 'Esqueci minha senha - Pesquisa-r';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/esqueci');
		$this->load->view('templates/footer');
		$this->load->view('templates/js');
	}

	public function forgot_request()
	{
		$this->load->library('email');
		$this->load->model("Users_model");
		$this->load->model("Login_model");

		$users = $this->Users_model->getEmail($_POST['email']);

		$token = sha1(mt_rand(1, 90000) . 'SALT');
		$password = md5($token);

		foreach ($users as $user) {
			$this->Users_model->update($users['id'], ['email' => $_POST['email']]);

			$message =
				'<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
				<div class="text26982" style="">
					<div style="display: flex; background-color: #32549b; height: 50px; width: 100%;">
						<img width="100" height="45" src="<?= base_url() ?>assets/img/logo.png" />
					</div>

					<div class="text1549">
							<h1 style="margin-top: 20px; margin-bottom: 30px; text-align: center;">Reset de senha realizado com sucesso!</h1>
							<p>
								Você resetou a sua senha em nosso site.
							</p>
							<p>
								Sua nova senha: ' . $token . '
							</p>
							<p>
								Clique no botão abaixo, faça login, entre no seu perfil e redefina sua senha: 
							</p>
							<a href="http://3.226.10.237/index.php/login" class="button-pesquisas mt-5" id="exo_subtitle" style="background: #2C234D; padding: 7px 63px; border-radius: 30px; color: #fff;">Login</a>	
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
				width: 100%; height: 60%; flex-direction: column; padding: 0 25%;
				align-items: center;
				display: flex;
				justify-content: space-around;
				text-align: center;
			}

			@media(max-width: 800px) {
				.text26982 {
					padding: 0 10% 0 7%;
				}
			}
		</style>
		';

			$this->Login_model->update($users['id'], $password);
			$this->email->from('anderson.felix@devcodes.com.br', 'Anderson Felix');
			$this->email->to($_POST['email']);

			$this->email->subject('Nova senha');
			$this->email->message($message);

			$this->email->send();
			echo '';
			die();
		}

		echo 'error';
		die();
	}

	public function store()
	{
		$this->load->model("login_model");
		$email = $_POST["email"];

		if (isset($_POST["password"])) {
			$password = md5($_POST["password"]);
			$user = $this->login_model->store($email, $password);
		} else {
			$password = md5($_POST["token"]);
			$user = $this->login_model->store2($email, $password);
		}



		if ($user) {
			$this->session->set_userdata("logged_user", $user);
			redirect("index.php/termos");
		} else {
			$this->session->set_flashdata("message", 'Senha ou e-mail inválido.');
			redirect("index.php/login");
		}
	}

        /*
         * Logando com o Google
         */
	public function store2()
	{
		$this->load->model("login_model");
		$email = $_POST["email"];

		$password = md5($_POST["token"]);
		$user = $this->login_model->store2($email, $password);

                /*
                 * Caso o usuário já esteja cadastrado
                 */
		if ($user) {
			$this->session->set_userdata("logged_user", $user);
			echo 'success';
		} else {
                    /*
                     *  Cadastro em caso contrário
                     */
                        $this->load->model("Users_model");

                        $user = array(
                                "name" => $_POST["nameGoogle"],
                                "email" => $email,
                                "token" => $password,
                                "ativo" => 'S',
                        );

                        $email = $this->Users_model->getEmail($user['email']);
                        
                        /*
                         * Verifica se o email já é usado em uma conta existente
                         */
                        if (!empty($email)) {
                                echo 'error';
                                die();
                        }

                        /*
                         * Grava o usuário
                         */
                        if ($this->Users_model->storeLogin($user)) {
                            
                                echo 'criado';
                                
                        } else {
                                echo 'error';
                        }
                    
		}
	}

	public function store3()
	{
		$this->load->model("Users_model");
		
		$password = $_POST["id"];
		$user = $this->Users_model->getFacebook($password);
			
		if ($user) {
			$this->session->set_userdata("logged_user", $user);
			echo 'success';
		} else {

                        $user = array(
                                "name" => $_POST["namefacebook"],
                                "token" => $password,
                                "ativo" => 'S',
                        );

                        $userFacebook = $this->Users_model->getFacebook($user['token']);

                        if (!empty($userFacebook)) {
                                echo 'error';
                                die();
                        }

                        if ($this->Users_model->storeLogin($user)) {
                                echo 'criado';
                        } else {
                                echo 'error';
                        }

		}
	}

	public function logout()
	{
		$this->session->unset_userdata("logged_user");
		redirect("index.php/login");
	}

	public function gravar()
	{
		$this->load->model("Users_model");
		$this->load->model("Login_model");

		$user = array(
			"name" => $_POST["nome"],
			"cpf" => $_POST["cpf"],
			"funcao" => 2,
			"datanasc" => $_POST["datanasc"],
			"email" => $_POST["email"],
			"password" => md5($_POST["password"]),
			"ativo" => 'S',
			"img_user" => ''
		);

		$cpf = $this->Users_model->getCPF($user['cpf']);
		//print_r($cpf);
		if (!empty($cpf)) {
			$this->session->set_flashdata('message', 'Já existe uma conta cadastrada com esse CPF');
			redirect("index.php/login/register");
			die();
		}

		$email = $this->Users_model->getEmail($user['email']);
		if (!empty($email)) {

			$this->session->set_flashdata('message', 'Não foi possível criar sua conta pois esse email já esta cadastrado');
			redirect("index.php/login/register");
			die();
		}

		if ($this->Users_model->storeLogin($user)) {
			$this->session->unset_userdata(['message']);
			$this->session->set_flashdata("successLogin", 'Conta criada com sucesso, agora você pode fazer login');
			$this->send_mail($user);
			redirect("index.php/login");
		}
	}


	public function gravar2()
	{
		$this->load->model("Users_model");
		$this->load->model("Login_model");

		$user = array(
			"name" => $_POST["nameGoogle"],
			"email" => $_POST["email"],
			"token" => md5($_POST["token"]),
			"ativo" => 'S',
		);

		$email = $this->Users_model->getEmail($user['email']);

		if (!empty($email)) {
			echo 'error';
			die();
		}

		if ($this->Users_model->storeLogin($user)) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	public function gravar3()
	{
		$this->load->model("Users_model");
		$this->load->model("Login_model");

		$user = array(
			"name" => $_POST["namefacebook"],
			"token" => $_POST["id"],
			"ativo" => 'S',
		);

		$userFacebook = $this->Users_model->getFacebook($user['token']);

		if (!empty($userFacebook)) {
			echo 'error';
			die();
		}

		if ($this->Users_model->storeLogin($user)) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	public function send_mail($user)
	{
		// print_r($user);
		// exit();
		$message =
			'<div style="display: flex; background: #f5f5f5; width: 100%; height: 600px; flex-direction: column; position: relative; justify-content: space-between">
				<div class="text26982" style="">
					<div style="display: flex; background-color: #32549b; height: 50px; width: 100%;">
						<img width="100" height="45" src="<?= base_url() ?>assets/img/logo.png" />
					</div>

					<div class="text1549">
							<h1 style="margin-top: 20px; margin-bottom: 30px; text-align: center;">Cadastro realizado com sucesso!</h1>
							<p>Parabéns! 
								Você se cadastrou no site Idor Saúde Mental.
								Faça login no nosso site através desse link: 
							</p>
							<a href="http://3.226.10.237/" class="button-pesquisas mt-5" id="exo_subtitle" style="background: #2C234D; padding: 7px 63px; border-radius: 30px; color: #fff;">Login</a>	
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
				width: 100%; height: 60%; flex-direction: column; padding: 0 25%;
				align-items: center;
				display: flex;
				justify-content: space-around;
				text-align: center;
			}

			@media(max-width: 800px) {
				.text26982 {
					padding: 0 10% 0 7%;
				}
			}
		</style>
		';


		$this->load->library('email');

		$this->email->from('gabriel.carmo@devcodes.com.br');
		$this->email->to($user['email']);

		$this->email->subject('Cadastro realizado com sucesso!');
		$this->email->message($message);


		if ($this->email->send()) {
		} else {
		}
	}
}
