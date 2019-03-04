<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanpham extends CI_Controller {

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
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách sản phẩm';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->msanpham->countAll();
        $config['base_url'] = base_url()."admin/sanpham";

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
		
		$data['sanpham'] = $this->msanpham->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/sanpham/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function themsanpham()
	{
		$data['title'] = 'Thêm sản phẩm mới';
		$data['content'] = 'admin/sanpham/them';
		$data['list_danhmuc'] = $this->mdanhmuc->list_danhmuc();
		if(isset($_POST['themsanpham']))
		{
			$this->form_validation->set_rules('tensanpham', 'tên sản phẩm', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('gia', 'giá', 'integer', array('integer' => 'Giá phải là số'));
			$this->form_validation->set_rules('danhmuc', 'danh mục', 'required', array('required' => 'Vui lòng chọn %s'));

			$file = $_FILES["hinhanh"];
			if($file['error'] != 0)
			{
				$data['error_file'] = 'Vui lòng chọn file';
			}
			
			if($this->form_validation->run() != FALSE && $file['error'] == 0)
			{
				$tensanpham = $this->input->post('tensanpham');
				$mota = $this->input->post('mota');
				$gia = $this->input->post('gia');
				$danhmuc = $this->input->post('danhmuc');
				//$status = $this->input->post('status');
				$moi = !empty($this->input->post('moi')) ? $this->input->post('moi') : 0;
				$trangchu = !empty($this->input->post('trangchu')) ? $this->input->post('trangchu') : 0;
				$themeta = $this->input->post('themeta');
				$keymeta = $this->input->post('keymeta');
				$motameta = $this->input->post('motameta');

				$tenhinh = $this->chuanhoa->convert_vi_to_en(trim($tensanpham));
				$config['upload_path'] = 'img/sanpham/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $tenhinh;
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > ($img['image_height'] * 4 / 3))
					{
						$conf['width'] = $img['image_height'] * 4 / 3;
						$conf['height'] = $img['image_height'];
					}
					else
					{
						$conf['width'] = $img['image_width'];
						$conf['height'] = $img['image_width'] * 3 / 4;
					}
					$this->load->library('image_lib', $conf);
					$this->image_lib->resize();
				}
				else
				{
					$hinhanh = '';
				}
				
				$dat = array(
					'tensanpham' => $tensanpham,
					'mota' => $mota,
					'gia' => $gia,
					'danhmuc' => $danhmuc,
					//'status' => $status,
					'moi' => $moi,
					'trangchu' => $trangchu,
					'hinhanh' => $hinhanh,
					'themeta' => $themeta,
					'keymeta' => $keymeta,
					'motameta' => $motameta,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idsanpham = $this->msanpham->themsanpham($dat);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Thêm sản phẩm thành công!';
					redirect(base_url('admin/sanpham'));
				}
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
		$data['title'] = 'Chỉnh sửa sản phẩm mới';
		$data['content'] = 'admin/sanpham/chinhsua';
		$data['list_danhmuc'] = $this->mdanhmuc->list_danhmuc();
		$data['sanpham'] = $this->msanpham->get_sanpham($id);
		if(isset($_POST['chinhsua']))
		{
			$this->form_validation->set_rules('tensanpham', 'tên sản phẩm', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('gia', 'giá', 'integer', array('integer' => 'Giá phải là số'));
			$this->form_validation->set_rules('danhmuc', 'danh mục', 'required', array('required' => 'Vui lòng chọn %s'));

			if($this->form_validation->run() != FALSE)
			{
				$tensanpham = $this->input->post('tensanpham');
				$mota = $this->input->post('mota');
				$gia = $this->input->post('gia');
				$danhmuc = $this->input->post('danhmuc');
				//$status = $this->input->post('status');
				$moi = !empty($this->input->post('moi')) ? $this->input->post('moi') : 0;
				$trangchu = !empty($this->input->post('trangchu')) ? $this->input->post('trangchu') : 0;
				$themeta = $this->input->post('themeta');
				$keymeta = $this->input->post('keymeta');
				$motameta = $this->input->post('motameta');

				$tenhinh = $this->chuanhoa->convert_vi_to_en(trim($tensanpham));
				$config['upload_path'] = 'img/sanpham/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $tenhinh;
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > ($img['image_height'] * 4 / 3))
					{
						$conf['width'] = $img['image_height'] * 4 / 3;
						$conf['height'] = $img['image_height'];
					}
					else
					{
						$conf['width'] = $img['image_width'];
						$conf['height'] = $img['image_width'] * 3 / 4;
					}
					$this->load->library('image_lib', $conf);
					$this->image_lib->resize();
				}
				else
				{
					$hinhanh = $this->input->post('hinhanhcu');
				}
				
				$dat = array(
					'tensanpham' => $tensanpham,
					'mota' => $mota,
					'gia' => $gia,
					'danhmuc' => $danhmuc,
					//'status' => $status,
					'moi' => $moi,
					'trangchu' => $trangchu,
					'hinhanh' => $hinhanh,
					'themeta' => $themeta,
					'keymeta' => $keymeta,
					'motameta' => $motameta,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idsanpham = $this->msanpham->capnhat($dat, $id);
				if($idsanpham)
				{
					$_SESSION['success'] = 'Thêm sản phẩm thành công!';
					redirect(base_url('admin/sanpham'));
				}
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
