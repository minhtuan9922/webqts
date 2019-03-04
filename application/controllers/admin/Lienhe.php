<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lienhe extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mlienhe');
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách liên hệ';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mlienhe->countAll();
        $config['base_url'] = base_url()."admin/lienhe";

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
		
		$data['lienhe'] = $this->mlienhe->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/lienhe/danhsach';
		$this->load->view('admin/layout', $data);
	}
	
	public function xemlienhe($id)
	{
		$data['title'] = 'Xem liên hệ';
		$data['content'] = 'admin/lienhe/xem';
		$data['lienhe'] = $this->mlienhe->get_lienhe($id);
		$this->mlienhe->capnhat(array('trangthai'=>1), $id);
		$this->load->view('admin/layout', $data); 
	}
	public function xoalienhe()
	{
		$json = array();
		if(isset($_POST['idlienhe']))
		{
			$idlienhe = $this->input->post('idlienhe');
			
			$kq = $this->mlienhe->xoalienhe($idlienhe);
			if($kq == true)
			{
				$json['success'] = 'Xóa liên hệ thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
