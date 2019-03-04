<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mykien extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function get_ykien($idykien)
	{
		$this->db->from('ykien');
		$this->db->where('idykien', $idykien);
		return $this->db->get()->row_array();
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('ykien');
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
		$this->db->from('ykien');
		return $this->db->count_all_results(); 
	}
	public function themykien($data = array())
	{
		$this->db->insert('ykien',$data);
		return $this->db->insert_id();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idykien',$id);
        return $this->db->update('ykien',$data);
	}
	public function get_list_ykien($limit = NULL)
	{
		$this->db->from('ykien');
		$this->db->where('trangchu = 1');
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		return $this->db->get()->result_array();
	}
	public function xoaykien($idykien)
	{
		$this->db->where('idykien', $idykien);
		return $this->db->delete('ykien');
	}
}