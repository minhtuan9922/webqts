<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gioithieu extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('mbaiviet');
	}
	public function index()
	{
		$data['title'] = 'Trang chủ | Giới thiệu';
		$data['gioithieu'] = $this->mbaiviet->get_baiviet('gioithieu');
		
		$data['content'] = 'gioithieu';
		$this->load->view('index', $data);
	}
}
