<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/dangnhap'));
		}
	}
	
	public function dangnhap()
	{
		$data['title'] = 'Đăng nhập trang quản trị | phimmt';
//		$data['slide'] = 'home/slide';
		$data['content'] = 'admin/home/home';
		$this->load->view('admin/layout', $data);
	}
}
