<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkichban extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function themkichban($data = array())
	{
		$check_kichban = $this->check_kichban($data['kichban']);
		if(!empty($check_kichban))
		{
			return $check_kichban['id_kichban'];
		}
		else
		{
			$this->db->insert('kichban',$data);
			return $this->db->insert_id();
		}
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('id_phim',$id);
        return $this->db->update('phim',$data);
	}
	public function check_kichban($kichban)
	{
		$this->db->select('*');
		$this->db->from('kichban');
		$this->db->where('kichban', $kichban);
		return $this->db->get()->row_array();
	}
	public function thongtin_kichban($id)
	{
		$this->db->select('*');
		$this->db->from('kichban');
		$this->db->where('id_kichban', $id);
		return $this->db->get()->row_array();
	}
}