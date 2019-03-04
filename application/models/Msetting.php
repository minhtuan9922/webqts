<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msetting extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function setting()
	{
		$this->db->select('*');
		$this->db->from('setting');
		return $this->db->get()->result_array();
	}
	public function get_setting($code)
	{
		$this->db->select('*');
		$this->db->from('setting');
		$this->db->where('code', $code);
		$kq = $this->db->get()->row_array();
		if(!empty($kq))
		{
			return $kq['value'];
		}
		else
		{
			return '';
		}
	}
	public function check_password($password,$id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('password', md5($password));
		$this->db->where('id', $id);
		$kq = $this->db->get()->row_array();
		if(empty($kq))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function dangnhap($account, $password)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('account', $account);
		$this->db->where('password', $password);
		$this->db->where('active', 1);
		return $kq = $this->db->get()->row_array();
	}
	public function them_setting($db = array())
	{
		return $this->db->insert('setting',$db);
	}
	public function xoa_setting()
	{
		return $this->db->truncate('setting');
	}
	public function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
	public function capnhat($data=array(),$id)
	{
		$this->db->where('id',$id);
        return $this->db->update('admin',$data);
	}
	public function edit($account)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('account', $account);
		return $this->db->get()->row_array();
	}
}