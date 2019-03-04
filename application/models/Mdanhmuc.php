<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdanhmuc extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function themdanhmuc($data = array())
	{
		$check_theloai = $this->check_id_danhmuc($data['tendanhmuc']);
		if(!empty($check_theloai))
		{
			return $check_theloai['idanhmuc'];
		}
		else
		{
			$this->db->insert('danhmuc',$data);
			return $this->db->insert_id();
		}
	}
	public function capnhat($data = array(), $iddanhmuc) 
	{
		$this->db->where('iddanhmuc',$iddanhmuc);
        return $this->db->update('danhmuc',$data);
	}
	public function check_id_danhmuc($tendanhmuc)
	{
		$this->db->select('*');
		$this->db->from('danhmuc');
		$this->db->like('tendanhmuc', $tendanhmuc);
		return $this->db->get()->row_array();
	}
	public function check_id_danhmuc_kd($tenkhongdau)
	{
		$this->db->select('*');
		$this->db->from('danhmuc');
		$this->db->like('tenkhongdau', $tenkhongdau);
		return $this->db->get()->row_array();
	}
	public function thongtin_danhmuc($iddanhmuc)
	{
		$this->db->select('*');
		$this->db->from('danhmuc');
		$this->db->where('iddanhmuc', $iddanhmuc);
		return $this->db->get()->row_array();
	}
	public function get_danhmuc($iddanhmuc)
	{
		$this->db->from('danhmuc');
		$this->db->where('status', 1);
		$this->db->where('danhmuccha', $iddanhmuc);
		return $this->db->get()->result_array();
	}
	public function list_danhmuc()
	{
		$this->db->from('danhmuc');
		return $this->db->get()->result_array();
	}
	public function xoa_danhmuc($iddanhmuc)
	{
		$this->db->where('iddanhmuc', $iddanhmuc);
		return $this->db->delete('danhmuc');
	}
}