<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chitiet extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
//		$this->load->model('mdaodien');
	}
	public function index($id)
	{
		
		$data['sanpham'] = $this->msanpham->get_sanpham($id);
		$dat = array(
			'luotxem' => $data['sanpham']['luotxem'] + 1,
		);
		$this->msanpham->capnhat($dat, $id);
		$data['title'] = $data['sanpham']['tensanpham'].' | Làng Nướng Sao Mai';
		$data['sanphamcungloai'] = $this->msanpham->sanphamcungloai($data['sanpham']['danhmuc'], $id);
		$data['content'] = 'chitiet';
		$this->load->view('index', $data);
	}
}
