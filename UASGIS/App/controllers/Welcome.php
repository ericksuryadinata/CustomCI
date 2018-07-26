<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form','text'));
		$this->load->model(array('uas'));
	}
	public function index(){
		$data['lokasi'] = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
		$data['select_available'] = $this->uas->select('id, kode_kabupaten, nama_kabupaten','tb_kumpulan_point_uts','')->result_array();
		$this->load->view('welcome_message',$data);
	}

	public function tambah(){
		if(!$this->input->is_ajax_request()){
			exit('no direct script allowed');
		}
		$kode_kabupaten = $this->input->post('kode-kabupaten');
		$nama_kabupaten = $this->input->post('nama-kabupaten');
		$nama_bupati = $this->input->post('nama-bupati');
		$jumlah_penduduk = $this->input->post('jumlah-penduduk');
		$jumlah_ukm = $this->input->post('jumlah-ukm');
		$pusat_kota = $this->input->post('pusat-kota');
		$pusat_ukm = $this->input->post('pusat-ukm');
		$wilayah = $this->input->post('wilayah');
		$data = array(
			'kode_kabupaten' => $kode_kabupaten,
			'nama_kabupaten' => $nama_kabupaten,
			'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
			'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
			'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
			'nama_bupati' => $nama_bupati,
			'jumlah_penduduk' => $jumlah_penduduk,
			'jumlah_ukm' => $jumlah_ukm
		);
		$insert = $this->uas->insertEscape($data);
		$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
		if($insert){
			echo json_encode(array('status' => 'sukses','data'=>$lokasi));
		}else{
			echo json_encode(array('status' => 'error','data'=>$lokasi));
		}
	}

	public function update(){
		if(!$this->input->is_ajax_request()){
			exit('no direct script allowed');
		}
		$id = array('id' => $this->input->post('id-edit'));
		$kode_kabupaten = $this->input->post('kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('nama-kabupaten-edit');
		$nama_bupati = $this->input->post('nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('jumlah-ukm-edit');
		$pusat_kota = $this->input->post('pusat-kota-edit');
		$pusat_ukm = $this->input->post('pusat-ukm-edit');
		$wilayah = $this->input->post('wilayah-edit');
		$data = array(
			'kode_kabupaten' => $kode_kabupaten,
			'nama_kabupaten' => $nama_kabupaten,
			'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
			'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
			'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
			'nama_bupati' => $nama_bupati,
			'jumlah_penduduk' => $jumlah_penduduk,
			'jumlah_ukm' => $jumlah_ukm
		);
		$update = $this->uas->updateEscape($data,$id);
		$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
		if($update){
			echo json_encode(array('status' => 'sukses','data' => $lokasi));
		}else{
			echo json_encode(array('status' => 'error','data' => $lokasi));
		}
	}

	public function edit(){
		$id = $this->input->get('id');
		$result = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id = '.$id)->result_array();
		echo json_encode($result);
	}

	public function delete(){
		$id = array('id' => $this->input->post('id'));
		$delete = $this->uas->delete($id);
		if(!$delete){
			$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
			echo json_encode(array('status' => 'error','data' => $lokasi));
		}else{
			$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
			echo json_encode(array('status' => 'sukses','data' => $lokasi));
		}
	}

	public function view(){
		$id = $this->input->get('id');
		$result = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id = '.$id)->result_array();
		echo json_encode($result);
	}

	public function loadAll(){
		$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
		echo json_encode($lokasi);
	}

	public function jsts(){
		$jsts1 = $this->input->post('jsts1');
		$jsts2 = $this->input->post('jsts2');
		$lokasi = $this->uas->select('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id in ("'.$jsts1.'","'.$jsts2.'")')->result_array();
		echo json_encode($lokasi);
	}
}
