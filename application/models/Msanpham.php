<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msanpham extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function get_sanpham_danhmuc($iddanhmuc)
	{
		$this->db->select('*, sanpham.hinhanh as hinhanh_sp');
		$this->db->from('danhmuc, sanpham');
		$this->db->where('danhmuc.iddanhmuc = sanpham.danhmuc');
		$this->db->where('danhmuc.danhmuccha', $iddanhmuc);
		$this->db->where('danhmuc.status', 1);
		$this->db->where('sanpham.status', 1);
		$this->db->where('sanpham.trangchu', 1);
		$this->db->order_by('sanpham.danhmuc', 'asc');
//		$this->db->limit(8);
		return $this->db->get()->result_array();
	}
	public function get_sanpham($idsanpham)
	{
		$this->db->from('sanpham');
		$this->db->where('idsanpham', $idsanpham);
		return $this->db->get()->row_array();
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->select('s.*, d.tendanhmuc');
		$this->db->from('sanpham s, danhmuc d');
		$this->db->where('s.status', 1); 
		$this->db->where('s.danhmuc = d.iddanhmuc'); 
		$this->db->order_by('ngaythem desc');
		if($limit != NULL && $start == NULL)
		{
			$this->db->limit($limit);
		}
		elseif($limit != NULL && $start != NULL)
		{
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result_array();
	}
	public function countAll(){
		$this->db->from('sanpham');
		$this->db->where('status', 1); 
		return $this->db->count_all_results(); 
	}
	public function themsanpham($data = array())
	{
		$this->db->insert('sanpham',$data);
		return $this->db->insert_id();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idsanpham',$id);
        return $this->db->update('sanpham',$data);
	}
	public function chitietphim($id) 
	{
		$this->db->from('phim');
		$this->db->where('id_phim',$id);
		$this->db->where('active = 1');
        return $this->db->get()->row_array();
	}
	public function sanphamcungloai($iddanhmuc, $idsanpham)
	{
		$this->db->from('sanpham');
		$this->db->where('idsanpham != '.$idsanpham);
		$this->db->where('danhmuc', $iddanhmuc);
		$this->db->where('status = 1');
		$this->db->order_by('idsanpham', 'RANDOM');
		$this->db->limit(4);
		return $this->db->get()->result_array();
	}
	public function get_list_sanpham($iddanhmuc, $moi, $limit = NULL, $start = NULL, $order = NULL)
	{
		$this->db->from('sanpham');
		$this->db->where('status = 1');
		if($moi == 'monmoi')
		{
			$this->db->where('moi', 1);
		}
		$this->db->like('danhmuc', $iddanhmuc);
		if($limit != NULL && $start == NULL)
		{
			$this->db->limit($limit);
		}
		if($limit != NULL && $start != NULL)
		{
			$this->db->limit($limit, $start);
		}
		if($order != NULL)
		{
			$this->db->order_by($order);
		}
		return $this->db->get()->result_array();
	}
	public function count_list_sanpham($iddanhmuc, $moi)
	{
		$this->db->from('sanpham');
		$this->db->where('status = 1');
		if($moi == 'monmoi')
		{
			$this->db->where('moi', 1);
		}
		$this->db->like('danhmuc', $iddanhmuc);
		return $this->db->count_all_results();
	}
	public function timphim($tukhoa)
	{
		$this->db->from('sanpham');
		$this->db->where("tensanpham like '".$tukhoa."%'");
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	public function xoasanpham($idsanpham)
	{
		$this->db->where('idsanpham', $idsanpham);
		return $this->db->delete('sanpham');
	}
}