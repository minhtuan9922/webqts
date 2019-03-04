<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lienhe extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('mlienhe');
	}
	public function index()
	{
		$data['title'] = 'Liên hệ | Làng nướng Sao Mai';
		
		$data['content'] = 'lienhe';
		
		if(isset($_POST['themlienhe']))
		{
			$this->form_validation->set_rules('ten', 'tên', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('email', 'email', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('dienthoai', 'số điện thoại', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidung', 'nội dung', 'required', array('required' => 'Vui lòng nhập %s'));

			if($this->form_validation->run() != FALSE)
			{
				$ten = $this->input->post('ten');
				$email = $this->input->post('email');
				$dienthoai = $this->input->post('dienthoai');
				$noidung = $this->input->post('noidung');
				
				$dat = array(
					'ten' => $ten,
					'email' => $email,
					'dienthoai' => $dienthoai,
					'noidung' => $noidung,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idlienhe = $this->mlienhe->themlienhe($dat);
				if($idlienhe)
				{
					$_SESSION['success'] = 'Bạn đã gửi nội dung thành công. Chúng tôi sẽ liên hệ trong thời gian sớm nhất';
					redirect(base_url('lienhe'));
				}
			}
		}
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$this->load->view('index', $data);
	}
}
