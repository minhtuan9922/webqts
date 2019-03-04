<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->helper('directory');
	}
	
	public function index()
	{
		$list_file = directory_map('img/sanpham');
		$img = array();
		if($list_file)
		{
			foreach($list_file as $item)
			{
				$img[] = array(
					'url' => base_url('img/sanpham/'.$item),
					'thumb' => base_url('img/sanpham/'.$item),
					'tag' => 'image'
				);
			}
		}
		echo json_encode($img);
	}	
	
	public function delete_file()
	{
		if($this->input->post('src')) 
		{
			//echo base_url(); die();
			$link_file = str_replace(base_url(), './', $this->input->post('src'));
			unlink($link_file);
		}
	}
	public function upload_file()
	{
		$config['upload_path'] = 'img/sanpham';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['file_name'] = $dat['tenkhongdau'];
		$this->load->library("upload", $config);

		if($this->upload->do_upload('file'))
		{
			$img = $this->upload->data();
			$hinhanh = $img['file_name'];
//			$conf['image_library'] = 'gd2';
//			$conf['source_image'] = $config['upload_path'].$img['file_name'];
//			$conf['create_thumb'] = false;
//			$conf['maintain_ratio'] = false;
//			if($img['image_width'] > $img['image_height'])
//			{
//				//$conf['master_dim'] = 'height';
//				$conf['width']         = $img['image_height'];
//				$conf['height']       = $img['image_height'];
//			}
//			else
//			{
//				//$conf['master_dim'] = 'width';
//				$conf['width']         = $img['image_width'];
//				$conf['height']       = $img['image_width'];
//			}
//			$this->load->library('image_lib', $conf);
//			$this->image_lib->crop();
			$json['link'] = base_url('img/sanpham/'.$hinhanh);
			echo json_encode($json);
		}
	}
}
