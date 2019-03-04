<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thucdon extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('mphim');
	}
	public function index()
	{
		$check_danhmuc = $this->mdanhmuc->check_id_danhmuc_kd($this->uri->segment(2));
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 24;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->msanpham->count_list_sanpham($check_danhmuc['iddanhmuc'], $this->uri->segment(2));
        $config['base_url'] = base_url().'thucdon/'.$check_danhmuc['tenkhongdau'];

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
		
		$data['pagination'] = $this->pagination->create_links();
		
		$data['title'] = 'Trang chủ | '.$check_danhmuc['tendanhmuc'];
		
		$data['danhmuc'] = $check_danhmuc['tendanhmuc'];
		$data['sanpham'] = $this->msanpham->get_list_sanpham($check_danhmuc['iddanhmuc'], $this->uri->segment(2), $config['per_page'], $batdau, 'ngaythem desc');
		
		$data['content'] = 'thucdon';
		$this->load->view('index', $data);
	}
}
