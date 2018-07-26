<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uas extends CI_Model{
	
	private $escapeField = array('lokasi', 'wilayah', 'pusat_kota', 'pusat_ukm');
	private $table = 'tb_kumpulan_point_uts';
    public function select($column,$tablename,$where){
        $query = 'select '.$column.' from '.$tablename.' '.$where;
        $data = $this->db->query($query);
        return $data;
    }

	public function insert($data){
		$res = $this->db->insert($this->table,$data);
		return $res;
	}

	public function insertEscape($data){
		foreach ($data as $key => $value) {
            if (in_array($key,$this->escapeField)) {
                $this->db->set($key, $value, false);
                unset($data[$key]);
            }
        }
		$res = $this->db->insert($this->table,$data);
		return $res;
	}

	public function updateEscape($data,$where){
		foreach ($data as $key => $value) {
            if (in_array($key,$this->escapeField)) {
                $this->db->set($key, $value, false);
                unset($data[$key]);
            }
        }
		$res = $this->db->update($this->table,$data,$where);
		return $res;
	}

	public function update($data,$where){
		$res = $this->db->update($this->table,$data,$where);
		return $res;
	}

	public function delete($where){
		$res = $this->db->delete($this->table,$where);
		return $res;
	}

	
}
