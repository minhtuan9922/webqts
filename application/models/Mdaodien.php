<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdaodien extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function themdaodien($data = array())
	{
		$check_daodien = $this->check_id_daodien($data['ten_daodien_kd']);
		if(!empty($check_daodien))
		{
			return $check_daodien['id_daodien'];
		}
		else
		{
			$this->db->insert('daodien',$data);
			return $this->db->insert_id();
		}
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('id_phim',$id);
        return $this->db->update('phim',$data);
	}
	public function check_id_daodien($ten_daodien)
	{
		$this->db->select('*');
		$this->db->from('daodien');
		$this->db->where('ten_daodien', $ten_daodien);
		return $this->db->get()->row_array();
	}
	public function thongtin_daodien($id)
	{
		$this->db->select('*');
		$this->db->from('daodien');
		$this->db->where('id_daodien', $id);
		return $this->db->get()->row_array();
	}
}