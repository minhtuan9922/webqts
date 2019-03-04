<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hinhanh extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('mhinhanh');
	}
	public function index()
	{
		$data['title'] = 'Trang chủ | Hình ảnh';
		$list_hinhanh = $this->mhinhanh->get_hinhanh();
		if(!empty($list_hinhanh))
		{
			$list1 = $list2 = $list3 = $list4 = array();
			foreach($list_hinhanh as $key => $item)
			{
				if($key % 4 == 0)
				{
					$list1[] = $item;
				}
				elseif($key % 4 == 1)
				{
					$list2[] = $item;
				}
				elseif($key % 4 == 2)
				{
					$list3[] = $item;
				}
				elseif($key % 4 == 3)
				{
					$list4[] = $item;
				}
			}
			$data['list1'] = $list1;
			$data['list2'] = $list2;
			$data['list3'] = $list3;
			$data['list4'] = $list4;
		}
		
		$data['content'] = 'hinhanh';
		$this->load->view('index', $data);
	}
}
