<?php

class Quiz_model extends CI_model
{
	public function index()
	{
		return $this->db->get_where("questionnaires")->result_array();
	}

	public function store($quiz)
	{
		$this->db->insert("questionnaires", $quiz);
	}

	public function show($id)
	{
		return $this->db->get_where("questionnaires", array(
			"id" => $id
		))->row_array();
	}

	
	public function validateFormr($id_formr)
	{
		return $this->db->get_where("questionnaires", array(
			"id_formr" => $id_formr
		))->row_array();
	}

	public function update($id, $quiz)
	{
		$this->db->where("id", $id);
		return $this->db->update("questionnaires", $quiz);
	}

	public function updateRuns($id, $quiz)
	{
		$this->db->where("run_id", $id);
		return $this->db->update("run", $quiz);
	}

	public function destroy($id)
	{
		$this->db->set("ativo", "N");
		$this->db->where("id", $id);
		return $this->db->update("questionnaires");
	}

	public function active($id)
	{
		$this->db->set("ativo", "S");
		$this->db->where("id", $id);
		return $this->db->update("questionnaires");
	}

	public function showRuns($id)
	{
		$sql = "SELECT * FROM run where run_id = {$id}";
        $query = $this->db->query($sql);
		$result = $query->result();
        return $result; 
	}

	public function showReport($id, $id_user)
	{
		$sql = "SELECT * FROM run_report_user where run_id = {$id} AND use_id = {$id_user}";
        $query = $this->db->query($sql);
		$result = $query->result();
        return $result; 
	}

	public function showsRuns()
	{
		$sql = "SELECT * FROM run where run_id != 6 and run_id != 7 and run_id != 9";
        $query = $this->db->query($sql);
		$result = $query->result();
        return $result; 
	}

	public function storeRuns($quiz)
	{
		$this->db->insert("run", $quiz);
	}

	public function storeRunReport($quiz)
	{
		$this->db->insert("run_report", $quiz);
		return;
	}

	public function storeRunsReport($quiz)
	{
		$this->db->insert("run_report_user", $quiz);
		return;
	}

	public function showReportRunsUser($id)
	{
		$sql1 = "SELECT * FROM run INNER JOIN run_report_user ON run.run_id = run_report_user.run_id INNER JOIN users ON users.id = run_report_user.use_id where run_report_user.run_id = {$id}";

		$sql = "SELECT * FROM run_report_user where run_id = {$id} ";
        $query = $this->db->query($sql1);
		$result = $query->result();
        return $result; 
	}
}
