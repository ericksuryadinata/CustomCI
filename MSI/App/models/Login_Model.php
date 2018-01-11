<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

	public function cek_user($tabel, $param = null){
		return $this->db->get_where($tabel,$param);
	}

	public function update($data,$where){
		$this->db->where('id_login',$where);
		$this->db->update('login', $data);
	}
	
}
