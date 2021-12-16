<?php

class Termos_model extends CI_model
{
	public function index($id_user)
	{
		return $this->db->get_where("termos", array('id_user' => $id_user))->result_array();
	}

	public function index2()
	{
		return $this->db->get_where("termos")->result_array();
	}

	public function store($termo)
	{
		$this->db->insert("termos", $termo);
	}

}
