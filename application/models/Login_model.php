<?php

class Login_model extends CI_Model
{
	public function store($email, $password){
		$this->db->where("email", $email);
		$this->db->where("password", $password);
		$this->db->where("ativo", 'S');
		$user = $this->db->get("users")->row_array();
		return $user;
	}

	public function store2($email, $password){
		$this->db->where("email", $email);
		$this->db->where("token", $password);
		$this->db->where("ativo", 'S');
		$user = $this->db->get("users")->row_array();
		return $user;
	}

	public function update($id, $password)
	{
		$sql = "UPDATE users SET password = '$password' WHERE id = $id"; 
		$this->db->query($sql);
		// $result = $query->result();
		// if(!empty($result)){
		// 	return true;
		// } else {
		// 	return false;
		// } 
		
	}
}
