<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model(array('Superuser/Dashboard_Model'=>'dashboard'));
		$this->is_login();
		if($this->session->userdata('tipe') != 1){
			redirect('Login');
		}
    }
	public function index(){
		$this->load->view('Superuser/index');
    }
    
    public function logout(){
		$arr = array('id_login'=>$this->session->userdata('id'));
		$result = $this->dashboard->cek_user('login',$arr)->row();
		$data = array('is_login'=>0);
		$this->dashboard->update($data, $result->id_login);
		$this->session->sess_destroy();
		redirect('Login');
	}
}
