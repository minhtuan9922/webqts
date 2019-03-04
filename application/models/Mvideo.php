<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mvideo extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function get_video($idvideo)
	{
		$this->db->from('video');
		$this->db->where('idvideo', $idvideo);
		return $this->db->get()->row_array();
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('video');
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
		$this->db->from('video');
		return $this->db->count_all_results(); 
	}
	public function themvideo($data = array())
	{
		$this->db->insert('video',$data);
		return $this->db->insert_id();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idvideo',$id);
        return $this->db->update('video',$data);
	}
	public function get_list_video($limit = NULL)
	{
		$this->db->from('video');
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		return $this->db->get()->result_array();
	}
	public function xoavideo($idvideo)
	{
		$this->db->where('idvideo', $idvideo);
		return $this->db->delete('video');
	}
}