<?php
class Graphic extends CI_Controller
{

    private $unitid = null;
	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->library('session');
		$this->session_data = $this->session->userdata('logged_user');
		$this->load->model("Pesquisas_model");
		
	}

    public function index()
	{
        $logged_user = $_SESSION['logged_user'];
        
        $url = explode(".",$_POST['url']);
        if($url[0] == 'http://opencpu'){
            $data['regiao'] = $_POST['page_id2']; 
            $data['usu_id'] = $logged_user['id']; 
            $data['pesquisa'] = $_POST['pesquisa']; 
            $data['imagem'] = $logged_user['id']."_".$_POST['pesquisa']."_".$_POST['page_id2']."_".$_SESSION['unitid'].'.png'; 
            $data['session_id'] = $_SESSION['unitid'];

            $this->Pesquisas_model->graficos_insert($data);
			
            $image = file_get_contents($_POST['url']);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/graphic//'.$data['imagem'], $image);
        }
        

    }
}
?>