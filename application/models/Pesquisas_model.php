<?php

class Pesquisas_model extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		permission();

                $mysqliConn = new mysqli("formr.ceopv2fs3ucf.us-east-1.rds.amazonaws.com", "admin", "FormR2021", "formr");
                $mysqliConn->set_charset("utf8");
	 	@$this->banco = $mysqliConn;
                
                //@$this->banco = $this->load->database('formR', TRUE);
                        
                //new mysqli("formr.ceopv2fs3ucf.us-east-1.rds.amazonaws.com", "admin", "FormR2021", "formr");
		// $this->banco = new mysqli("157.245.219.190", "formr", "dev123", "formr");
                
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

	public function getSessions($user_id){
		$sql = "SELECT session_id FROM survey_unit_sessions "
                        . "WHERE use_id = {$user_id} ";								
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

	public function getAllTables($tables, $unit_session = null){
		$itens =  null;
		$where = null;
		if(!empty($unit_session)){
			$where = " AND session_id =  {$unit_session}";
		}
		$sql = "SELECT * FROM {$tables} where 1=1 {$where} limit 1 ";
		
		
		$result = $this->banco->query($sql);
		$itens = $result->fetch_all(MYSQLI_ASSOC);
		
		return $itens;
	}

	public function getAllTablesFindSession($tables, $unit_sessions){
		$itens =  null;
		$where = null;

                $sessionsIn = "(". implode(",", $unit_sessions) . ")";
//echo '$sessionsIn<br/>';                 
//echo $sessionsIn;
//echo  '<br/>';                
                
		if(!empty($unit_sessions)){
			$in = " AND session_id IN {$sessionsIn} ";
		}
		$sql = "SELECT * FROM {$tables} where 1=1 {$in} limit 1 ";
		
//echo $sql;
//echo  '<br/>';
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

	public function choiceList($list, $studies_id){
		$sql = "SELECT * FROM survey_item_choices sic 
				WHERE sic.list_name  ='{$list}'
                                AND study_id = '{$studies_id}' ";

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

	public function showif($campo){
		$sql = "SELECT x.* FROM formr.survey_items x
		WHERE showif like '{$campo}%'";
		$result = $this->banco->query($sql);
		$itens = $result->fetch_all(MYSQLI_ASSOC);
		return $itens;
	}
	
}
