<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdienvien extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function themdienvien($data = array())
	{
		$check_dienvien = $this->check_id_dienvien($data['ten_dienvien']);
		if(!empty($check_dienvien))
		{
			return $check_dienvien['id_dienvien'];
		}
		else
		{
			$this->db->insert('dienvien',$data);
			return $this->db->insert_id();
		}
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('id_dienvien',$id);
        return $this->db->update('dienvien',$data);
	}
	public function check_id_dienvien($ten_dienvien)
	{
		$this->db->select('*');
		$this->db->from('dienvien');
		$this->db->where('ten_dienvien like', $ten_dienvien);
		return $this->db->get()->row_array();
	}
	public function thongtin_dienvien($id)
	{
		$this->db->select('*');
		$this->db->from('dienvien');
		$this->db->where('id_dienvien', $id);
		return $this->db->get()->row_array();
	}
}