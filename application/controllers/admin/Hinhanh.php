<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hinhanh extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mhinhanh');
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách hình ảnh';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mhinhanh->countAll();
        $config['base_url'] = base_url()."admin/hinhanh";

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
		
		$data['hinhanh'] = $this->mhinhanh->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/hinhanh/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function themhinhanh()
	{
		$data['title'] = 'Thêm hình ảnh mới';
		$data['content'] = 'admin/hinhanh/them';
		if(isset($_POST['themhinhanh']))
		{
			$config['upload_path'] = 'img/hinhanh/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library("upload", $config);

			if($this->upload->do_upload('hinhanh'))
			{
				$img = $this->upload->data();
				$hinhanh = $img['file_name'];
			}
			else
			{
				$hinhanh = '';
			}
			if($hinhanh != '')
			{
				$dat = array(
					'hinhanh' => $hinhanh,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idsanpham = $this->mhinhanh->themhinhanh($dat);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Thêm hình ảnh thành công!';
					redirect(base_url('admin/hinhanh'));
				}
			}
			else
			{
				$data['error_hinhanh'] = 'Bạn chưa chọn hình ảnh!';
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa hình ảnh';
		$data['content'] = 'admin/hinhanh/chinhsua';
		$data['hinhanh'] = $this->mhinhanh->hinhanh($id);
		if(isset($_POST['chinhsua']))
		{
			$config['upload_path'] = 'img/hinhanh/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library("upload", $config);

			if($this->upload->do_upload('hinhanh'))
			{
				$img = $this->upload->data();
				$hinhanh = $img['file_name'];
			}
			else
			{
				$hinhanh = $this->input->post('hinhanhcu');
			}
			if($hinhanh != '')
			{
				$dat = array(
					'hinhanh' => $hinhanh,
				);
				$idsanpham = $this->mhinhanh->capnhat($dat, $id);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Chỉnh sửa hình ảnh thành công!';
					redirect(base_url('admin/hinhanh'));
				}
			}
			else
			{
				$data['error_hinhanh'] = 'Bạn chưa chọn hình ảnh!';
				$this->load->view('admin/layout', $data); 
			}
		}
		else 
		{
			$this->load->view('admin/layout', $data); 
		}
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
			
			$kq = $this->msanpham->capnhat(array('moi'=>$moi), $idsanpham);
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
			
			$kq = $this->msanpham->capnhat(array('trangchu'=>$trangchu), $idsanpham);
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
	public function xoasanpham()
	{
		$json = array();
		if(isset($_POST['idsanpham']))
		{
			$idsanpham = $this->input->post('idsanpham');
			
			$kq = $this->msanpham->xoasanpham($idsanpham);
			if($kq == true)
			{
				$json['success'] = 'Xóa sản phẩm thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
