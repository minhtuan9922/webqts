<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model{

	public function __construct() {
	parent::__construct();
	}

	public function danhsach()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('active', 1);
		return $this->db->get()->result_array();
	}
	public function check_account($account)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('account', $account);
		$kq = $this->db->get()->row_array();
		if(count($kq) != 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function check_password($password,$id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('password', md5($password));
		$this->db->where('id_admin', $id);
		$kq = $this->db->get()->row_array();
		if(count($kq) == 0)
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
	public function them_ad($db = array())
	{
		return $this->db->insert('admin',$db);
	}
	public function xoa_ad($id)
	{
		$this->db->where('id_admin', $id);
		return $this->db->delete('admin');
	}
	public function chinhsua($id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id_admin', $id);
		return $this->db->get()->row_array();
	}
	public function capnhat($data=array(),$id)
	{
		$this->db->where('id_admin',$id);
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