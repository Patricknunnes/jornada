<?php

class Pesquisas_model extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		permission();

		$this->banco = new mysqli("157.245.219.190", "formr", "dev123", "formr");
	}

	public function index($run_id , $studies_id = null)
	{
		$sql = "SELECT sis.*,sru.description, ss.id unit_id, sru.position 
				FROM survey_runs sr 
					INNER JOIN survey_run_units sru on sr.id = sru.run_id
					INNER JOin survey_studies ss ON ss.id  = sru.unit_id  
					INNER JOIN survey_items sis ON sis.study_id = ss.id 
					where sr.id = {$run_id} and ss.id  = {$studies_id}
					AND sis.name not LIKE '%_fb%'
					order by sru.position, sis.item_order ";
		$result = $this->banco->query($sql);
		return $result;
	}

	public function indexResposta($run_id , $studies_id = null)
	{
		$sql = "SELECT sis.*,sru.description, ss.id unit_id, sru.position 
				FROM survey_runs sr 
					INNER JOIN survey_run_units sru on sr.id = sru.run_id
					INNER JOin survey_studies ss ON ss.id  = sru.unit_id  
					INNER JOIN survey_items sis ON sis.study_id = ss.id 
					where sr.id = {$run_id} and ss.id  = {$studies_id}
					AND sis.name not LIKE '%_fb%'
					order by sru.position, sis.item_order ";
		$result = $this->banco->query($sql);
		$itens = $result->fetch_all(MYSQLI_ASSOC);	
		return $itens;
	}

	public function result($run_id , $studies_id = null)
	{
		$result = $this->banco->query("SELECT sis.*,sru.description, ss.id unit_id,sru.position FROM survey_runs sr 
										INNER JOIN survey_run_units sru on sr.id = sru.run_id
										INNER JOin survey_studies ss ON ss.id  = sru.unit_id  
										INNER JOIN survey_items sis ON sis.study_id = ss.id 
										where sr.id = {$run_id} and ss.id  = {$studies_id} 
										and sis.name  = 'note_feedback'
										order by sru.position, sis.`order` ");
		$itens = $result->fetch_all(MYSQLI_ASSOC);									
		return $itens;
	}
	
	public function studies($study_id)
	{
		$result = $this->banco->query("SELECT sru.* FROM survey_runs sr 
										INNER JOIN survey_run_units sru on sr.id = sru.run_id
										INNER JOin survey_studies ss ON ss.id  = sru.unit_id   
										where sr.id = {$study_id}
										order by sru.position");
		$itens = $result->fetch_all(MYSQLI_ASSOC);									
		return $itens;
	}

	public function createSession($user_id){
		$result = $this->banco->query("INSERT INTO survey_unit_sessions(
												unit_id,
  												created)
										VALUES(1,NOW())");
		$session_id =  $this->banco->insert_id; 										
		$this->db->insert("survey_unit_sessions", ['use_id'=>$user_id, 'session_id' =>  $session_id]);								
		return $session_id;
		
	}

	public function getSession($user_id,$unit_id){
		$sql = "SELECT * FROM survey_unit_sessions WHERE use_id = {$user_id} AND ";								
		$query = $this->db->query($sql);
		$result = $query->result();
        return $result; 
		
	}

	public function createPerceResp($data){
		
		$this->db->insert("survey_studies", $data);
		
	}

	public function storeAll($keys, $table, $resposts )
	{
		$coluns = null;
		$res    = NULL;     
		$i      = 0;	
		foreach($keys as $key){
			$i++;
			if(count($keys)==$i){
				$coluns = $coluns.$key;
				$res = $res."'".$resposts[$key]."'";
			}else{
				$coluns = $coluns.$key.', ';
				$res = $res."'".$resposts[$key]."',";
			}
			
		}
		$sql = "INSERT INTO $table($coluns) VALUES({$res})";
		$result = $this->banco->query($sql);
		if($result){
			return true; 
		}
		return false;

	}

	public function getAllTables($tables){
		$itens =  null;
		$sql = "SELECT * FROM {$tables} limit 1 ";
		$result = $this->banco->query($sql);
		$itens = $result->fetch_all(MYSQLI_ASSOC);
		
		return $itens;
	}

	public function studiesTable($study_id)
	{
		// $teste = "SELECT * FROM survey_studies
		// where id = {$study_id}
		// limit 1";
		// echo 
		$result = $this->banco->query("SELECT * FROM survey_studies
										where id = {$study_id}
										limit 1");
		$itens = $result->fetch_all(MYSQLI_ASSOC);									
		return $itens;
	}

	public function choiceList($list){
		$sql = "SELECT * FROM survey_item_choices sic 
				WHERE sic.list_name  ='{$list}'";
		$result = $this->banco->query($sql);
		$itens = $result->fetch_all(MYSQLI_ASSOC);
		return $itens;
	}

	public function graficos_insert($pages)
	{
		$this->db->insert("graficos", $pages);
	}

	public function graficos_select($pages)
	{
		$sql = "SELECT distinct * FROM graficos 
				WHERE regiao = {$pages['regiao']}  
				AND   usu_id = {$pages['usu_id']}";
        $query = $this->db->query($sql);
		$result = $query->result();
        return $result; 
	}
	
}
