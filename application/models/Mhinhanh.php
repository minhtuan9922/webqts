<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhinhanh extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function get_hinhanh($limit = null)
	{
		$this->db->from('hinhanh');
		$this->db->order_by('ngaythem', 'desc');
		if($limit != null)
		{
			$this->db->limit(10);
		}
		return $this->db->get()->result_array();
	}
	public function themlienhe($data = array())
	{
		$this->db->insert('lienhe',$data);
		return $this->db->insert_id();
	}
	public function themhinhanh($data = array())
	{
		$this->db->insert('hinhanh',$data);
		return $this->db->insert_id();
	}
	public function countAll(){
		$this->db->from('hinhanh');
		return $this->db->count_all_results(); 
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('hinhanh');
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
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idhinhanh',$id);
        return $this->db->update('hinhanh',$data);
	}
	public function hinhanh($idhinhanh)
	{
		$this->db->from('hinhanh');
		$this->db->where('idhinhanh', $idhinhanh);
		return $this->db->get()->row_array();
	}
}