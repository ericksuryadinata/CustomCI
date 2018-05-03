<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anu extends CI_Controller{

    public function daya_serap($id,$type){
        if($id == ''){
            redirect('assesment_report');
        }

        $simulasi   = $this->m_assesment->selectData('*','soal_profil_tes','WHERE `id` = '.$id)->first_row();

        if(!$simulasi){
                $this->restapi->error("Maaf ! Simulasi tidak di temukan");
        }

        if($type ==='preview'){
            $field_tingkat         = $this->input->post('radiotingkat');
            $field_jurusan         = $this->input->post('jurusan');
            $field_mataujian       = $this->input->post('mataujian');
            $field_radiowilayah    = $this->input->post('radiowilayah');
            $field_propinsi        = $this->input->post('propinsi');
            $field_kota            = $this->input->post('kota');
            $field_jenissekolah    = $this->input->post('jenissekolah');
            $field_jenisanalisis    = $this->input->post('radioanalisis');
            $field_jenislaporan   = $this->input->post('radiolaporan');
            $field_status          = $this->input->post('status');
        }else{
            $field_tingkat         = $this->input->post('radiotingkat');
            $field_jurusan         = $this->input->post('jurusan');
            $field_mataujian       = $this->input->post('mataujian');
            $field_radiowilayah    = $this->input->post('radiowilayah');
            $field_propinsi        = $this->input->post('propinsi');
            $field_kota            = $this->input->post('kota');
            $field_jenissekolah    = $this->input->post('jenissekolah');
            $field_jenisanalisis    = $this->input->post('radioanalisis');
            $field_jenislaporan   = $this->input->post('radiolaporan');
            $field_status          = $this->input->post('status'); 
        }

        $response = [];

        if($field_tingkat==""){
            $this->restapi->error("Silahkan Pilih Tingkatan");
        }

        $tingkat    = $this->m_assesment->selectData('id,tingkatan','tingkatan','WHERE `id` = '.$field_tingkat)->first_row();

        if(!$tingkat){
            $this->restapi->error("Maaf ! Tingkatan tidak di temukan");
        }
        
        $response['tingkat']    = $tingkat->tingkatan;

        if($field_radiowilayah==''){
            $this->restapi->error("Silahkan Pilih Wilayah");
        }

        if($field_radiowilayah === 'propinsi'){
            $propinsi   = $this->m_wilayah->selectData('*','provinsi','WHERE `id` = '.$field_propinsi)->first_row();

            if(!$propinsi){
                $this->restapi->error("Maaf ! Provinsi tidak di temukan");
            }
            $response['wilayah']    = "PROVINSI";
            $response['provinsi']   = $propinsi->nama;
        }
        if($field_radiowilayah=='kotakab') {

            if($field_kota==""){
                $this->restapi->error("Silahkan Pilih Kota / Kabupaten");
            }
            $kota    = $this->m_wilayah->selectData('*','kabupaten','WHERE `id` = '.$field_kota)->first_row();

            if (!$kota) {
                $this->restapi->error("Maaf ! Kota / Kabupaten tidak di temukan");
            }

            $response['kota']       = $kota->nama;
            $response['wilayah']    = "KOTA/KAB";
        }
    }
}