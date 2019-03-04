<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtheloai extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function themtheloai($data = array())
	{
		$check_theloai = $this->check_id_theloai($data['tentheloai']);
		if(!empty($check_theloai))
		{
			return $check_theloai['id_theloai'];
		}
		else
		{
			$this->db->insert('theloai',$data);
			return $this->db->insert_id();
		}
	}
	public function capnhat($data = array(), $id_theloai) 
	{
		$this->db->where('id_theloai',$id_theloai);
        return $this->db->update('theloai',$data);
	}
	public function check_id_theloai($tentheloai)
	{
		$this->db->select('*');
		$this->db->from('theloai');
		$this->db->like('tentheloai', $tentheloai);
		return $this->db->get()->row_array();
	}
	public function check_id_theloai_kd($tentheloai_kd)
	{
		$this->db->select('*');
		$this->db->from('theloai');
		$this->db->like('tentheloai_kd', $tentheloai_kd);
		return $this->db->get()->row_array();
	}
	public function thongtin_theloai($id)
	{
		$this->db->select('*');
		$this->db->from('theloai');
		$this->db->where('id_theloai', $id);
		return $this->db->get()->row_array();
	}
	public function theloai()
	{
		$this->db->from('theloai');
		$this->db->where('status', 1);
		return $this->db->get()->result_array();
	}
	public function list_theloai()
	{
		$this->db->from('theloai');
		return $this->db->get()->result_array();
	}
	public function xoa_theloai($id_theloai)
	{
		$this->db->where('id_theloai', $id_theloai);
		return $this->db->delete('theloai');
	}
}