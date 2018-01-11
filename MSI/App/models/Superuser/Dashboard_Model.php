<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

	public function cek_user($tabel, $where){
		return $this->db->get_where($tabel,$where);
	}

	public function update($data,$where){
		$this->db->where('id_login',$where);
		$this->db->update('login', $data);
	}
	
}
