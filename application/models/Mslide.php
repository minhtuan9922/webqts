<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mslide extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function danhsach()
	{
		$this->db->select('*');
		$this->db->from('slide');
		$this->db->order_by('vitri', 'asc');
		return $this->db->get()->result_array();
	}
	public function them_slide($db = array())
	{
		return $this->db->insert('slide',$db);
	}
	public function xoa_slide($id)
	{
		$this->db->where('id_slide', $id);
		return $this->db->delete('slide');
	}
	public function capnhat($data=array(), $id)
	{
		$this->db->where('id_slide',$id);
        return $this->db->update('slide',$data);
	}
	public function get_slide($id)
	{
		$this->db->from('slide');
		$this->db->where('id_slide', $id);
		return $this->db->get()->row_array();
	}
}