<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phimbo extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Trang chủ | phimmt';
		$data['slide'] = 'home/slide';
		$data['content'] = 'home/home';
		$this->load->view('index', $data);
	}
}
