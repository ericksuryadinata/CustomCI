<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

	public function cek_user($tabel, $where){
		return $this->db->get_where($tabel,$where);
	}

	public function ambil_data($tabel, $where){
		$this->db->where($where);
		$this->db->from($tabel);
		return $this->db->get();
	}

	public function sudah_ambil($tabel, $where){
		$this->db->select('id_jadwal_praktikum, id_praktikum, is_validasi');
		$this->db->where($where);
		$this->db->from($tabel);
		return $this->db->get();
	}

	public function edit_praktikum($where){
		$this->db->select('id_jadwal_praktikum, id_praktikum, id_user, hari, kelas, jam, nama');
		$this->db->join('login','login.userlogin = tb_ambil_praktikum.id_user');
		$this->db->where($where);
		$this->db->from('tb_ambil_praktikum');
		return $this->db->get();
	}

	public function lihat_praktikum($where){
		$this->db->select('nomor_pendaftaran_praktikum, id_praktikum, id_user, hari, kelas, jam, nama, is_validasi, nomor_validasi');
		$this->db->join('login','login.userlogin = tb_ambil_praktikum.id_user');
		$this->db->where($where);
		$this->db->from('tb_ambil_praktikum');
		return $this->db->get();
	}

	public function update($tabel,$where,$data){
		$this->db->where($where);
		$this->db->update($tabel, $data);
	}

	
	public function daftar($tabel, $data){
		$this->db->insert($tabel, $data);
	}

	public function kapasitas($where){
		$this->db->where($where);
		$this->db->from('tb_ambil_praktikum');
		return $this->db->count_all_results();
	}


	
}
