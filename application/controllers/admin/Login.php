<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		if(isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin'));
		}
		
		$this->load->model('madmin');
		$data['title'] = 'Đăng nhập trang quản trị | phimmt';
		if(isset($_POST['dangnhap']))
		{
			$account = $this->input->post('account');
			$password = md5($this->input->post('password'));
			$check = $this->madmin->dangnhap($account,$password);
			if(!empty($check))
			{
				$this->session->set_userdata("admin_id", $check['id']);
				redirect(base_url('admin'));
			}
			else
			{
				echo '<script>alert("Tài khoản không dúng!")</script>';
			}
		}
		$this->load->view('admin/login', $data);
		
	}	
	
	public function dangxuat()
	{
		$this->session->unset_userdata("admin_id");
		redirect(base_url('admin/login'));
	}
}
