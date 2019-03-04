<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
	}
	
	public function index()
	{
		$data['title'] = 'Trang quản trị | phimmt';
		$data['view'] = $this->mview->get_total_view_month();
		
		$data['content'] = 'admin/home/home';
		$this->load->view('admin/layout', $data);
	}
}
