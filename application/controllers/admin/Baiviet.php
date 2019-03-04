<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baiviet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mbaiviet');
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách bài viết';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mbaiviet->countAll();
        $config['base_url'] = base_url()."admin/baiviet";

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
		
		$data['baiviet'] = $this->mbaiviet->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/baiviet/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function thembaiviet()
	{
		$data['title'] = 'Thêm bài viết mới';
		$data['content'] = 'admin/baiviet/them';
		if(isset($_POST['thembaiviet']))
		{
			$this->form_validation->set_rules('tenbaiviet', 'tên bài viết', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('mabaiviet', 'mã bài viet', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidungxemtruoc', 'nội dung xem trước', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidung', 'nội dung', 'required', array('required' => 'Vui lòng nhập %s'));

			if($this->form_validation->run() != FALSE)
			{
				$tenbaiviet = $this->input->post('tenbaiviet');
				$mabaiviet = $this->input->post('mabaiviet');
				$noidungxemtruoc = $this->input->post('noidungxemtruoc');
				$noidung = $this->input->post('noidung');
				$themeta = $this->input->post('themeta');
				$keymeta = $this->input->post('keymeta');
				$motameta = $this->input->post('motameta');
				
				$dat = array(
					'tenbaiviet' => $tenbaiviet,
					'mabaiviet' => $mabaiviet,
					'noidungxemtruoc' => $noidungxemtruoc,
					'noidung' => $noidung,
					'themeta' => $themeta,
					'keymeta' => $keymeta,
					'motameta' => $motameta,
					'ngaythem' => date('Y-m-d H:i:s'),
					'tacgia' => $_SESSION['admin_id'],
				);
				$idsanpham = $this->mbaiviet->thembaiviet($dat);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Thêm bài viết thành công!';
					redirect(base_url('admin/baiviet'));
				}
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa bài viết';
		$data['content'] = 'admin/baiviet/chinhsua';
		$data['baiviet'] = $this->mbaiviet->get_baiviet_id($id);
		if(isset($_POST['chinhsua']))
		{
			$this->form_validation->set_rules('tenbaiviet', 'tên bài viết', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('mabaiviet', 'mã bài viet', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidungxemtruoc', 'nội dung xem trước', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidung', 'nội dung', 'required', array('required' => 'Vui lòng nhập %s'));

			if($this->form_validation->run() != FALSE)
			{
				$tenbaiviet = $this->input->post('tenbaiviet');
				$mabaiviet = $this->input->post('mabaiviet');
				$noidungxemtruoc = $this->input->post('noidungxemtruoc');
				$noidung = $this->input->post('noidung');
				$themeta = $this->input->post('themeta');
				$keymeta = $this->input->post('keymeta');
				$motameta = $this->input->post('motameta');
				
				$dat = array(
					'tenbaiviet' => $tenbaiviet,
					'mabaiviet' => $mabaiviet,
					'noidungxemtruoc' => $noidungxemtruoc,
					'noidung' => $noidung,
					'themeta' => $themeta,
					'keymeta' => $keymeta,
					'motameta' => $motameta,
					'ngaythem' => date('Y-m-d H:i:s'),
					'tacgia' => $_SESSION['admin_id'],
				);
				$idsanpham = $this->mbaiviet->capnhat($dat, $id);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Cập nhật bài viết thành công!';
					redirect(base_url('admin/baiviet'));
				}
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	
	public function xulyfile_xml()
	{
		if(isset($_POST))
		{
			$path = "upload/";
			$movie = $_FILES['file_xml']['name'];
			$movie_tmp = $_FILES['file_xml']['tmp_name'];
			move_uploaded_file($movie_tmp,$path.$movie);
			$xml = simplexml_load_file(base_url('upload/'.$movie)) or die("Error: Cannot create object");
			$tenphim_en = $xml->LocalTitle;
			$nam_sanxuat = $xml->ProductionYear;
			$diem_imdb = $xml->IMDBrating;
			$thoiluong = $xml->RunningTime;
			$daodien = $xml->Director;
			$kichban = str_replace('|', ',', $xml->WritersList);
			$tieude = $xml->LocalTitle;
			$theloai = $xml->Genres;
			$dienvien = $xml->Persons;
			$trailer = $xml->Trailer;
			
			$dulieu = '{
				"tenphim_en":"'.$tenphim_en.'",
				"nam_sanxuat":"'.$nam_sanxuat.'",
				"diem_imdb":"'.$diem_imdb.'",
				"thoiluong":"'.$thoiluong.'",
				"daodien":"'.$daodien.'",
				"kichban":"'.$kichban.'",
				"trailer":"'.($trailer).'"
				';
			$theloai_tam = '';
			foreach($theloai->Genre as $val)
			{
				$theloai_tam .= $val.',';
			}
			$theloai_tam = rtrim($theloai_tam, ',');
			$dulieu .= ',"theloai":"'.$theloai_tam.'"';
			$dienvien_tam = '';
			$i = 0;
			foreach($dienvien->Person as $val)
			{
				$dienvien_tam .= $val->Name.',';
				if($i > 10) 
				{
					break;
				}
				$i++;
			}
			$dienvien_tam = rtrim($dienvien_tam, ',');
			$dulieu .= ',"dienvien":"'.$dienvien_tam.'"';
			$dulieu .= '}';
			echo $dulieu;
		}
	}
	public function capnhat_moi()
	{
		if(isset($_POST['moi']))
		{
			$idsanpham = $this->input->post('idsanpham');
			$moi = $this->input->post('moi');
			
			$kq = $this->mbaiviet->capnhat(array('moi'=>$moi), $idsanpham);
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
			$idsanpham = $this->input->post('idsanpham');
			$trangchu = $this->input->post('trangchu');
			
			$kq = $this->mbaiviet->capnhat(array('trangchu'=>$trangchu), $idsanpham);
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
	public function xoabaiviet()
	{
		$json = array();
		if(isset($_POST['idbaiviet']))
		{
			$idbaiviet = $this->input->post('idbaiviet');
			
			$kq = $this->mbaiviet->xoabaiviet($idbaiviet);
			if($kq == true)
			{
				$json['success'] = 'Xóa bài viết thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
