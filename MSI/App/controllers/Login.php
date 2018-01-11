<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->is_home();
		$data['pesan'] = $this->session->userdata('pesan');
		$this->load->view('Login',$data);
	}
	
	public function auth(){
		if($this->input->post('submit') == NULL){
			redirect('Login');
			die();
		} else {
			$u = $this->security->xss_clean($this->input->post('username'));
			$p = $this->security->xss_clean($this->input->post('password'));
			$validasi = array('username','password');
			if($this->valid($validasi) === TRUE){
				echo validation_errors();
			}else{
				$this->go_login($u,$p);
			}
		}
	}
	
	private function go_login($u,$p){
		$arr = array('userlogin'=>$u);
		$result = $this->login->cek_user('login',$arr)->row();
		if($result){
			if (password_verify($p, $result->password)) {
				$sess_data['id'] = $result->id_login;
				$sess_data['nama'] = $result->nama;
				$sess_data['tipe'] = $result->tipe;
				$sess_data['userlogin'] = $result->userlogin;
				$sess_data['logged_in'] = TRUE;
				$login['is_login'] = $result->is_login;
				$login['kunjung'] = $result->kunjung;
				$login['status']  = $result->status;
			} else {
				$this->session->set_flashdata("pesan",'<script>$(document).ready(function(){swal("Oopss..", "Username atau Password Salah", "warning");});</script>');
				redirect('Login');
			}
		} else {
			$this->session->set_flashdata("pesan",'<script>$(document).ready(function(){swal("Oopss..", "Username atau Password Salah", "warning");});</script>');
			redirect('Login');
		}

		if($login['status']==1){
			$this->session->set_flashdata("pesan",'<script>$(document).ready(function(){swal("Info !", "Akun Belum Disetujui, Silahkan Hubungi Administrator", "info");});</script>');
			redirect('Login');
		} elseif ($login['status']==2) {
			if($login['is_login'] != 1){
				$this->session->set_userdata($sess_data);
				$ip = $_SERVER['REMOTE_ADDR'];
				$tgl = date("Y-m-d H:i:s");
				$kunjung = strval($login['kunjung']) + 1;
				$data = array('waktu'=>$tgl, 'ip'=>$ip, 'kunjung'=>$kunjung,'is_login'=>1);
				$this->login->update($data, $this->session->userdata('id'));
				$this->cek_tipe();
			}else{
				$this->session->set_flashdata("pesan",'<script>$(document).ready(function(){swal("Oopss..", "Akun Masih Dipakai Orang Lain, Amankan Akun Anda !", "error");});</script>');
				redirect('Login');
			}
		} else {
			$this->session->set_flashdata("pesan",'<script>$(document).ready(function(){swal("Oopss..", "Akun Belum Terdaftar, Silahkan Hubungi Administrator ", "error");});</script>');
			redirect('Login');
		}
	}
	
	public function cek_tipe(){
		if($this->session->userdata('tipe')==1){
			$this->session->set_flashdata("pesan","<script>$(document).ready(function(){swal({title:'Success',text:'Selamat Datang ".$this->session->userdata("nama")."',type:'success', showCancelButton:false,showConfirmButton:false, allowOutsideClick:false, timer:1500}).then(function(){},function(dismiss){if(dismiss==='timer'){window.location='".base_url('Superuser/Dashboard')."'}})});</script>");
			$data['pesan'] = $this->session->userdata('pesan');
			$this->load->view('Login',$data);
		} elseif ($this->session->userdata('tipe')==2) {
			$this->session->set_flashdata("pesan","<script>$(document).ready(function(){swal({title:'Success',text:'Selamat Datang ".$this->session->userdata("nama")."',type:'success', showCancelButton:false,showConfirmButton:false, allowOutsideClick:false, timer:2000}).then(function(){},function(dismiss){if(dismiss==='timer'){window.location='".base_url('Mahasiswa/Dashboard')."'}})});</script>");
			$data['pesan'] = $this->session->userdata('pesan');
			$this->load->view('Login',$data);
		}
	}

	public function csrf_redirect(){
	    $flash = 'Session cookie automatically reset due to expired browser session.&nbsp; Please try again.';
	    $this->session->set_flashdata('pesan', $flash);
	    redirect('Login');
	}
}
