<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mvideo');
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách video';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mvideo->countAll();
        $config['base_url'] = base_url()."admin/video";

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'Trang đầu';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Trang cuối';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Sau';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Trước';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a href="" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		
		$config['anchor_class'] = 'follow_link';  
		$config['attributes'] = array('class' => 'page-link'); 
        $this->load->library('pagination', $config);
		
		$data['video'] = $this->mvideo->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/video/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function themvideo()
	{
		$data['title'] = 'Thêm video mới';
		$data['content'] = 'admin/video/them';
		if(isset($_POST['themvideo']))
		{
			$this->form_validation->set_rules('link', 'link video', 'required', array('required' => 'Vui lòng nhập %s'));
			if($this->form_validation->run() != FALSE && $file['error'] == 0)
			{
				$link = $this->input->post('link');

				$dat = array(
					'link' => $link,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idvideo = $this->mvideo->themvideo($dat);
				if($idvideo)
				{
					$_SESSION['success'] = 'Thêm video thành công!';
					redirect(base_url('admin/video'));
				}
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa video';
		$data['content'] = 'admin/video/chinhsua';
		$data['video'] = $this->mvideo->get_video($id);
		if(isset($_POST['chinhsua']))
		{
			$this->form_validation->set_rules('link', 'link video', 'required', array('required' => 'Vui lòng nhập %s'));
			if($this->form_validation->run() != FALSE)
			{
				$link = $this->input->post('link');
				
				$dat = array(
					'link' => $link,
				);
				$result = $this->mvideo->capnhat($dat, $id);
				if($result)
				{
					$_SESSION['success'] = 'Chỉnh sửa video thành công!';
					redirect(base_url('admin/video'));
				}
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	public function capnhat_moi()
	{
		if(isset($_POST['moi']))
		{
			$idsanpham = $this->input->post('idsanpham');
			$moi = $this->input->post('moi');
			
			$kq = $this->mvideo->capnhat(array('moi'=>$moi), $idsanpham);
			if($kq == true)
			{
				echo 'Cập nhật thành công.';
			}
			else
			{
				echo 'Lỗi';
			}
		}
	}
	public function capnhat_trangchu()
	{
		if(isset($_POST['trangchu']))
		{
			$idvideo = $this->input->post('idvideo');
			$trangchu = $this->input->post('trangchu');
			
			$kq = $this->mvideo->capnhat(array('trangchu'=>$trangchu), $idvideo);
			if($kq == true)
			{
				echo 'Cập nhật thành công.';
			}
			else
			{
				echo 'Lỗi';
			}
		}
	}
	public function xoavideo()
	{
		$json = array();
		if(isset($_POST['idvideo']))
		{
			$idvideo = $this->input->post('idvideo');
			
			$kq = $this->mvideo->xoavideo($idvideo);
			if($kq == true)
			{
				$json['success'] = 'Xóa video thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
