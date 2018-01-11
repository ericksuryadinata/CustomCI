<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Old extends CI_Controller {

	public function index_old(){
		$this->load->view('App/index_old');
	}
}
