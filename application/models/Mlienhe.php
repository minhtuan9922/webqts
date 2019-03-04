<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlienhe extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function get_sanpham_danhmuc($iddanhmuc)
	{
		$this->db->from('lienhe');
		$this->db->order_by('ngaythem', 'desc');
		return $this->db->get()->result_array();
	}
	public function themlienhe($data = array())
	{
		$this->db->insert('lienhe',$data);
		return $this->db->insert_id();
	}
	public function countAll(){
		$this->db->from('lienhe');
		return $this->db->count_all_results(); 
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('lienhe');
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
	public function get_lienhe($idlienhe)
	{
		$this->db->from('lienhe');
		$this->db->where('idlienhe', $idlienhe);
		return $this->db->get()->row_array();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idlienhe',$id);
        return $this->db->update('lienhe',$data);
	}
	public function xoalienhe($idlienhe)
	{
		$this->db->where('idlienhe', $idlienhe);
		return $this->db->delete('lienhe');
	}
	public function dem_chuadoc(){
		$this->db->from('lienhe');
		$this->db->where('trangthai', 0);
		return $this->db->count_all_results(); 
	}
}