<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/dangnhap'));
		}
	}
	
	public function index()
	{
		$data['title'] = 'Thông tin website';
		
		if($this->input->post())
		{
			$this->msetting->xoa_setting();
			foreach($this->input->post() as $key => $item)
			{
				$dat = array(
					'code' => $key,
					'value' => $item
				);
				$this->msetting->them_setting($dat);
			}
		}
		$setting = $this->msetting->setting();
		foreach($setting as $item)
		{
			$data[$item['code']] = $item['value'];
		}
		$data['content'] = 'admin/setting/setting';
		$this->load->view('admin/layout', $data);
	}
}
