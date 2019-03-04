<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Danhmuc extends CI_Controller {

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
		$data['title'] = 'Trang quản phim | Danhmuc';
		
		$data['danhsach'] = $this->mdanhmuc->list_danhmuc();
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		
		$data['content'] = 'admin/danhmuc/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function them()
	{
		$data['title'] = 'Thêm danh mục mới';
		$data['content'] = 'admin/danhmuc/them';
		if(isset($_POST['them']))
		{
			$this->form_validation->set_rules('tendanhmuc', 'tên danh mục', 'required', array('required' => 'Vui lòng nhập %s'));

			$file = $_FILES["hinhanh"];
			if($file['error'] != 0)
			{
				$data['error_file'] = 'Vui lòng chọn file';
			}
			
			if($this->form_validation->run() != FALSE && $file['error'] == 0)
			{
				$dat['tendanhmuc'] = trim($this->input->post('tendanhmuc'));
				$dat['tenkhongdau'] = $this->chuanhoa->convert_vi_to_en(trim($this->input->post('tendanhmuc')));

				$config['upload_path'] = 'img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $dat['tenkhongdau'];
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > $img['image_height'])
					{
						//$conf['master_dim'] = 'height';
						$conf['width']         = $img['image_height'];
						$conf['height']       = $img['image_height'];
					}
					else
					{
						//$conf['master_dim'] = 'width';
						$conf['width']         = $img['image_width'];
						$conf['height']       = $img['image_width'];
					}
					$this->load->library('image_lib', $conf);
					$this->image_lib->crop();
				}
				else
				{
					$hinhanh = '';
				}
				$dat['hinhanh'] = $hinhanh;
				$iddanhmuc = $this->mdanhmuc->themdanhmuc($dat);
				if(!empty($iddanhmuc))
				{
					$_SESSION['success'] = 'Thêm danh mục thành công!';
				}
				redirect(base_url('admin/danhmuc'));
			}
			else
			{
				$this->load->view('admin/layout', $data); 
			}
		}
		else 
		{
			$this->load->view('admin/layout', $data); 
		}
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa danh mục';
		
		if(isset($_POST['sua']))
		{
			$this->form_validation->set_rules('tendanhmuc', 'tên danh mục', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('tenkhongdau', 'tên danh mục không dấu', 'required', array('required' => 'Vui lòng nhập %s'));

			if($this->form_validation->run() != FALSE)
			{
				$dat['tendanhmuc'] = trim($this->input->post('tendanhmuc'));
				$dat['tenkhongdau'] = trim($this->input->post('tenkhongdau'));

				$config['upload_path'] = 'img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $dat['tenkhongdau'];
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > $img['image_height'])
					{
						//$conf['master_dim'] = 'height';
						$conf['width']         = $img['image_height'];
						$conf['height']       = $img['image_height'];
					}
					else
					{
						//$conf['master_dim'] = 'width';
						$conf['width']         = $img['image_width'];
						$conf['height']       = $img['image_width'];
					}
					$this->load->library('image_lib', $conf);
					$this->image_lib->crop();
				}
				else
				{
					$hinhanh = $this->input->post['hinhanhcu'];
				}
				$dat['hinhanh'] = $hinhanh;
				$iddanhmuc = $this->mdanhmuc->capnhat($dat, $id);
				if(!empty($iddanhmuc))
				{
					$_SESSION['success'] = 'Thêm danh mục thành công!';
				}
				redirect(base_url('admin/danhmuc'));
			}
			else
			{
				$this->load->view('admin/layout', $data); 
			}
		}
		
		$data['danhmuc'] = $this->mdanhmuc->thongtin_danhmuc($id);
		$data['content'] = 'admin/danhmuc/chinhsua';
		$this->load->view('admin/layout', $data);
	}
	public function xoa_danhmuc()
	{
		$json = array();
		if(isset($_POST['iddanhmuc']))
		{
			$iddanhmuc = $this->input->post('iddanhmuc');
			
			$kq = $this->mdanhmuc->xoa_danhmuc($iddanhmuc);
			if($kq == true)
			{
				$json['success'] = 'Xóa thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
