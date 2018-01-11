<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Mahasiswa/Dashboard_Model'=>'dashboard'));
		$this->is_login();
		if($this->session->userdata('tipe') != 2){
			redirect('Login');
		}
	}

	public function index(){
		$this->load->view('Mahasiswa/index');
		$this->load->view('Mahasiswa/Dashboard');
	}

	public function list_praktikum(){
		$praktikum = array('PEMROGRAMAN WEB'=>'WEB', 'PEMROGRAMAN DASAR'=>'DASPRO', 'RANGKAIAN LOGIKA'=>'RL', 'DASAR KOMPUTER DAN INTERNET'=>'DASKOM', 'SISTEM OPERASI'=>'SO', 'PEMROGRAMAN LANJUT'=>'PBO');
		$id = array('id_user'=>$this->session->userdata('userlogin'));
		$sudah_ambil = $this->dashboard->sudah_ambil('tb_ambil_praktikum', $id);
		$kelas = array();
		$id = array('id_user'=>$this->session->userdata('userlogin'));
		$sudah_ambil = $this->dashboard->sudah_ambil('tb_ambil_praktikum', $id);
		if($sudah_ambil->num_rows() > 0){
			$result = $sudah_ambil->result_array();
			for($i = 0; $i < count($result); $i++){
				array_push($kelas,$result[$i]);
			}
		}
        $data = array();
		$no = $_POST['start'];
		$i = 0;
        foreach ($praktikum as $prak=>$value) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prak;
			if(count($kelas) > 0 && $i < count($kelas)){
				if($kelas[$i]['id_praktikum'] == $prak && $kelas[$i]['is_validasi'] == 1){
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat" onclick="lihat_praktikum('."'".$kelas[$i]['id_jadwal_praktikum']."'".')"><i class="glyphicon glyphicon-search"></i>&nbsp;Lihat</a>';
				}else if($kelas[$i]['id_praktikum'] == $prak){
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat" onclick="lihat_praktikum('."'".$kelas[$i]['id_jadwal_praktikum']."'".')"><i class="glyphicon glyphicon-search"></i>&nbsp;Lihat</a> <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_praktikum('."'".$kelas[$i]['id_jadwal_praktikum']."'".','."'".$value."'".')"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Edit Praktikum</a> <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Cetak" onclick="cetak_voucher('."'".$kelas[$i]['id_jadwal_praktikum']."'".')"><i class="glyphicon glyphicon-print"></i>&nbsp;Cetak Voucher</a>';
				}else{
					$row[] = '<a data-id="'.$value.'" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ambil" onclick="ambil_praktikum('."'".$value."'".')"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Ambil Praktikum</a>';
				}
			}else{
				$row[] = '<a data-id="'.$value.'" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ambil" onclick="ambil_praktikum('."'".$value."'".')"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Ambil Praktikum</a>';
			}
			$i++;
            $data[] = $row;
        }
        $output = array("draw"=>$_POST['draw'],
                        "recordsTotal" => count($praktikum),
                        "recordsFiltered" => count($praktikum),
                        "data"=>$data);
        echo json_encode($output);
	}

	public function dataKHK(){
		if($_POST){
			$data = $this->input->post('praktikum');
			$id = array('id_login'=>$this->session->userdata('id'));
			$result = $this->dashboard->cek_user('login',$id)->row();
			$user = array($result->nama, $result->userlogin);
			$praktikum = array('PEMROGRAMAN WEB'=>'WEB', 'PEMROGRAMAN DASAR'=>'DASPRO', 'RANGKAIAN LOGIKA'=>'RL', 'DASAR KOMPUTER DAN INTERNET'=>'DASKOM', 'SISTEM OPERASI'=>'SO', 'PEMROGRAMAN LANJUT'=>'PBO');
			$hari = array('WEB'=>array('senin'=>array('W1','14.30'),'selasa'=>array('W2','14.30'),'rabu'=>array('W3','14.30')),'DASPRO'=>array('rabu'=>array('D1','16.10'),'kamis'=>array('D2','14.30')),'RL'=>array('selasa'=>array('R1','14.30'),'rabu'=>array('R2','14.30'),'kamis'=>array('R3','14.30')),'DASKOM'=>array('senin'=>array('DS1','14.30'),'selasa'=>array('DS2','14.30'),'rabu'=>array('DS3','14.30')),'SO'=>array('senin'=>array('S1','16.10'),'selasa'=>array('S2','16.10'),'rabu'=>array('S3','18.45')),'PBO'=>array('kamis'=>array('J1','16.10'),'jumat'=>array('J2','14.30'),'sabtu'=>array('J3','08.30')));
			foreach($hari as $hr=>$value){
				if($data === $hr){
					$dataHari = $value;
				}
			}
			echo json_encode(array('hari'=>$dataHari,'user'=>$user,'praktikum'=>$praktikum));
		}else{
			redirect('Mahasiswa/Dashboard');
		}
	}

	public function checkKapasitas(){
		$kelas = $this->security->xss_clean($this->input->post('kelas'));
		$kapasitasKelas =  array('W1'=>'40','W2'=>'40','W3'=>'40','D1'=>'40','D2'=>'40','D3'=>'40','R1'=>'12','R2'=>'12','R3'=>'12','DS1'=>'12','DS2'=>'12','DS3'=>'12','S1'=>'40','S2'=>'40','S3'=>'40','J1'=>'40','J2'=>'40','J3'=>'40');
		if(empty($kelas)){
			$kapasitas = 'kosong';
		}else{
			$jumlah = $this->dashboard->kapasitas(array('kelas'=>$kelas));
			foreach($kapasitasKelas as $key=>$val){
				if($kelas == $key){
					$kapasitas = $val - $jumlah;
				}
			}	
		}
		
		echo json_encode($kapasitas);
	}
	
	public function daftar_praktikum(){
		if($_POST){
			$nomor = $this->security->xss_clean($this->input->post("kelas"));
			$nomor .= date('dmyhis');
			$data = array('nomor_pendaftaran_praktikum'=>$nomor,'id_praktikum'=>$this->security->xss_clean($this->input->post("praktikum")), 'id_user'=>$this->security->xss_clean($this->input->post("nbi")),'hari'=>$this->security->xss_clean($this->input->post("hari")),'kelas'=>$this->security->xss_clean($this->input->post("kelas")),'jam'=>$this->security->xss_clean($this->input->post("jam")),'nomor_validasi'=>$this->getToken(8),'is_validasi'=>0);
			$insert = $this->dashboard->daftar('tb_ambil_praktikum',$data);
			echo json_encode(array('status'=>TRUE));
		}else{
			redirect('Mahasiswa/Dashboard');
		}
	}

	public function edit_praktikum(){
		if($_POST){
			$dataPraktikum = $this->input->post('praktikum');
			$data = array('id_jadwal_praktikum'=>$this->security->xss_clean($this->input->post("id")));
			$praktikum = array('PEMROGRAMAN WEB'=>'WEB', 'PEMROGRAMAN DASAR'=>'DASPRO', 'RANGKAIAN LOGIKA'=>'RL', 'DASAR KOMPUTER DAN INTERNET'=>'DASKOM', 'SISTEM OPERASI'=>'SO', 'PEMROGRAMAN LANJUT'=>'PBO');
			$hari = array('WEB'=>array('senin'=>array('W1','14.30'),'selasa'=>array('W2','14.30'),'rabu'=>array('W3','14.30')),'DASPRO'=>array('rabu'=>array('D1','16.10'),'kamis'=>array('D2','14.30')),'RL'=>array('selasa'=>array('R1','14.30'),'rabu'=>array('R2','14.30'),'kamis'=>array('R3','14.30')),'DASKOM'=>array('senin'=>array('DS1','14.30'),'selasa'=>array('DS2','14.30'),'rabu'=>array('DS3','14.30')),'SO'=>array('senin'=>array('S1','16.10'),'selasa'=>array('S2','16.10'),'rabu'=>array('S3','18.45')),'PBO'=>array('kamis'=>array('J1','16.10'),'jumat'=>array('J2','14.30'),'sabtu'=>array('J3','08.30')));
			foreach($hari as $hr=>$value){
				if($dataPraktikum === $hr){
					$dataHari = $value;
				}
			}
			$result = $this->dashboard->edit_praktikum($data);
			echo json_encode(array('hari'=>$dataHari,'result'=>$result->row(),'praktikum'=>$praktikum));
		}else{
			redirect('Mahasiswa/Dashboard');
		}
	}

	public function update_praktikum(){
		if($_POST){
			$where = array('id_jadwal_praktikum'=>$this->security->xss_clean($this->input->post('val')));
			$data = array('hari'=>$this->security->xss_clean($this->input->post("hari")),'kelas'=>$this->security->xss_clean($this->input->post("kelas")),'jam'=>$this->security->xss_clean($this->input->post("jam")), 'nomor_validasi'=>$this->getToken(8),'is_validasi'=>0);
			$this->dashboard->update('tb_ambil_praktikum', $where, $data);
			echo json_encode(array('status'=>TRUE));
		}else{
			redirect('Mahasiswa/Dashboard');
		}
	}

	public function lihat_praktikum(){
		if($_POST){
			$data = array('id_jadwal_praktikum'=>$this->security->xss_clean($this->input->post("id")));
			$result = $this->dashboard->lihat_praktikum($data);
			echo json_encode(array('result'=>$result->row()));
		}else{
			redirect('Mahasiswa/Dashboard');
		}
	}

	private function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited
	
		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[random_int(0, $max-1)];
		}
	
		return $token;
	}
    
	public function logout(){
		$arr = array('id_login'=>$this->session->userdata('id'));
		$result = $this->dashboard->cek_user('login',$arr)->row();
		$data = array('is_login'=>0);
		$this->dashboard->update('login', array('id_login'=>$result->id_login),$data);
		$this->session->sess_destroy();
		redirect('Login');
	}
}
