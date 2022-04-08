<?php

class Users_model extends CI_model
{

	public function index()
	{
		return $this->db->get_where("users", array('ativo' => 'S'))->result_array();
	}


	public function store($user)
	{

		if ($this->db->insert("users", $user)) {

			return true;
		}

		return false;
	}

	public function storeLogin($user)
	{
                $ret = $this->db->insert("users", $user);
                        
		if ($ret) {
			return true;
		}
		return false;
	}

	public function show($id)
	{
		return $this->db->get_where("users", array(
			"id" => $id
		))->row_array();
	}

	public function getEmail($email)
	{
		return $this->db->get_where("users", array(
			"email" => $email
		))->row_array();
	}

	public function getFacebook($id)
	{
		return $this->db->get_where("users", array(
			"token" => $id
		))->row_array();
	}

	public function getCPF($cpf)
	{
		return $this->db->get_where("users", array(
			"cpf" => $cpf
		))->row_array();
	}

	public function update($id, $user)
	{
		$this->db->where("id", $id);
		return $this->db->update("users", $user);
	}

	public function destroy($id)
	{
		$this->db->set("ativo", "N");
		$this->db->where("id", $id);
		return $this->db->update("users");
	}

	public function regioes($orderregiao)
	{
		//$sql = "SELECT * FROM orderregiao WHERE usu_id = {$orderregiao['usu_id']} AND orr_ordem = {$orderregiao['orr_ordem']}"; 
		//$result = $this->db->query($sql);

		$this->db->select('*');
		$this->db->where('use_id', $orderregiao['use_id']);
		$this->db->where('orr_ordem', $orderregiao['orr_ordem']);
		$retorno = $this->db->get('orderregiao')->num_rows();

		if ($retorno <= 0) {
			$this->db->insert("orderregiao", $orderregiao);
			return true;
		} else {

			return false;
		}
	}

	public function deleteOrderUser($user)
	{
		$this->db->where('use_id', $user);
		$this->db->delete('orderregiao');
	}

	public function getRegioes($orderregiao)
	{

		$this->db->select('*');
		$this->db->where('use_id', $orderregiao['use_id']);
		$retorno = $this->db->get('orderregiao')->num_rows();
		return $retorno;
	}

	public function getsRegioes($orderregiao)
	{
		$sql = "SELECT * FROM orderregiao WHERE use_id = {$orderregiao['use_id']}  and orr_ordem <> 0 ORDER BY orr_ordem ASC";
		$retorno = $this->db->query($sql);

		/* 		$this->db->select('*');
		$this->db->where('use_id', $orderregiao['use_id']);
		$query = $this->db->get('orderregiao'); */

		return $retorno->result();
	}

	public function regiaoDestroy($id)
	{
		$this->db->where('use_id', $id['use_id']);

		return $this->db->delete('orderregiao');
	}

	public function regiaoUniqueDestroy($id, $ordem)
	{
		$this->db->where('use_id', $id);
		$this->db->where('orr_ordem', $ordem);
		return $this->db->delete('orderregiao');
	}
}
