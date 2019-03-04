<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('mslide');
		$this->load->model('mlienhe');
		$this->load->model('mhinhanh');
		$this->load->model('mbaiviet');
		$this->load->model('mykien');
		$this->load->model('mvideo');
	}
	public function index()
	{
		$data['title'] = 'Trang chủ | Làng nướng Sao Mai';
		$data['slide'] = 'home/slide';
		$data['danhmuc'] = $this->mdanhmuc->get_danhmuc(0);
		$data['sanpham'] = $this->msanpham->get_sanpham_danhmuc(0);
		
		$data['list_slide'] = $this->mslide->danhsach();
		if(isset($_POST['dangky']))
		{
			$dat = array(
				'email' => $this->input->post('email'),
				'dienthoai' => $this->input->post('dienthoai'),
				'noidung' => $this->input->post('noidung'),
				'ngaythem' => date('Y-m-d H:i:s')
			);
			$kq = $this->mlienhe->themlienhe($dat);
			if($kq > 0)
			{
				$data['result'] = 1;
			}
		}
		
		$data['hinhanh'] = $this->mhinhanh->get_hinhanh(10);
		$data['ykien'] = $this->mykien->get_list_ykien(3);
		$data['video'] = $this->mvideo->get_list_video();
		$data['gioithieu'] = $this->mbaiviet->get_baiviet('gioithieu');
		
		$data['content'] = 'home/trangchu';
		$this->load->view('index', $data);
	}
	public function trailer()
	{
		if(isset($_POST['id']))
		{
			$phim = $this->mphim->playphim($_POST['id']);
			$trailer = $phim['trailer'];
			$json['trailer'] = $trailer;
			echo json_encode($json);
		}
	}
	public function timkiem()
	{
		if(isset($_POST['tukhoa']))
		{
			$tukhoa = $_POST['tukhoa'];
			$kq = $this->msanpham->timphim($tukhoa);
			$html = '';
			if(!empty($kq))
			{
				foreach($kq as $item)
				{
					$html .= '<a href="'.base_url('chitiet/'.$item['idsanpham'].'/'.$this->chuanhoa->convert_vi_to_en($item['tensanpham'])).'" >
								<div class="media">
									<img class="align-self-center mr-3" src="'.base_url('img/sanpham/'.$item['hinhanh']).'" alt="Generic placeholder image" width="60px">
									<div class="media-body">
										<h5 class="mt-0">'.$item['tensanpham'].'</h5>
									</div>
								</div>
							</a>
							<div class="space10"></div>';
				}
			}
			else
			{
				$html .= '<p>Không tìm thấy phim bạn đang tìm</p>';
			}
			echo $html;
		}
	}
}
