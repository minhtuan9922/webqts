<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mphim extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function phimmoicapnhat()
	{
		$this->db->select('*');
		$this->db->from('phim');
		$this->db->where('active', 1);
		$this->db->order_by('id_phim', 'desc');
		$this->db->limit('12');
		return $this->db->get()->result_array();
	}
	public function playphim($id)
	{
		$this->db->select('*');
		$this->db->from('phim');
		$this->db->where('id_phim', $id);
		return $this->db->get()->row_array();
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('phim');
		$this->db->where('active', 1); 
		$this->db->order_by('ngay_them desc');
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
		$this->db->from('phim');
		$this->db->where('active', 1); 
		return $this->db->count_all_results(); 
	}
	public function themphim($data = array())
	{
		$this->db->insert('phim',$data);
		return $this->db->insert_id();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('id_phim',$id);
        return $this->db->update('phim',$data);
	}
	public function chitietphim($id) 
	{
		$this->db->from('phim');
		$this->db->where('id_phim',$id);
		$this->db->where('active = 1');
        return $this->db->get()->row_array();
	}
	public function phimcungtheloai($data = array(), $id)
	{
		if(!empty($data))
		{
			$sql = '(';
			foreach($data as $item)
			{
				$sql .= 'theloai like \'%"'.$item.'"%\' or ';
			}
			$sql = rtrim($sql, ' or ');
			$sql .= ')';
			
			$this->db->from('phim');
			$this->db->where($sql);
			$this->db->where('id_phim != '.$id);
			$this->db->where('active = 1');
			$this->db->order_by('id_phim', 'RANDOM');
			$this->db->limit(6);
			return $this->db->get()->result_array();
		}
		
		
	}
	public function get_list_phim($id_theloai, $limit = NULL, $start = NULL, $order = NULL)
	{
		$this->db->from('phim');
		$this->db->where('active = 1');
		$this->db->like('theloai', '"'.$id_theloai.'"');
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
	public function count_list_phim($id_theloai)
	{
		$this->db->from('phim');
		$this->db->where('active = 1');
		$this->db->like('theloai', '"'.$id_theloai.'"');
		return $this->db->count_all_results();
	}
	public function timphim($tukhoa)
	{
		$this->db->from('phim');
		$this->db->where("tenphim_vn like '".$tukhoa."%' or tenphim_en like '".$tukhoa."%'");
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}
}