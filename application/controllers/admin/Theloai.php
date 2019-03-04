<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theloai extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mphim');
		$this->load->model('mdaodien');
		$this->load->model('mkichban');
		$this->load->model('mdienvien');
		$this->load->model('mtheloai');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function index()
	{
		$data['title'] = 'Trang quản phim | Thể loại';
		
		$data['danhsach'] = $this->mtheloai->list_theloai();
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		
		$data['content'] = 'admin/theloai/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function them()
	{
		$data['title'] = 'Thêm thể loại mới';
		$data['content'] = 'admin/theloai/them';
		if(!empty($_POST['tentheloai']))
		{
			$dat['tentheloai'] = trim($this->input->post('tentheloai'));
			$dat['tentheloai_kd'] = $this->chuanhoa->convert_vi_to_en(trim($this->input->post('tentheloai')));
			$id_theloai = $this->mtheloai->themtheloai($dat);
			if(!empty($id_theloai))
			{
				$_SESSION['success'] = 'Thêm thể loại thành công!';
			}
			redirect(base_url('admin/theloai'));
		}
		else 
		{
			$this->load->view('admin/layout', $data); 
		}
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa thể loại';
		
		if(isset($_POST['luu']))
		{
			$dat['tentheloai'] = trim($this->input->post('tentheloai'));
			$dat['tentheloai_kd'] = trim($this->input->post('tentheloai_kd'));
			$kq = $this->mtheloai->capnhat($dat, $id);
			if(!empty($kq))
			{
				$_SESSION['success'] = 'Chỉnh sửa thể loại thành công!';
			}
			redirect(base_url('admin/theloai'));
		}
		
		$data['theloai'] = $this->mtheloai->thongtin_theloai($id);
		$data['content'] = 'admin/theloai/chinhsua';
		$this->load->view('admin/layout', $data);
	}
	public function xoa_theloai()
	{
		if(isset($_POST['id_theloai']))
		{
			$id_theloai = $this->input->post('id_theloai');
			
			$kq = $this->mtheloai->xoa_theloai($id_theloai);
			if($kq == true)
			{
				echo 'Xóa thành công.';
			}
			else
			{
				echo 'Lỗi';
			}
		}
	}
}
