<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phim extends CI_Controller {

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
		$data['title'] = 'Trang quản phim | phimmt';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mphim->countAll();
        $config['base_url'] = base_url()."admin/phim";

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
		
		$danhsach = $this->mphim->danhsach($batdau, $config['per_page']);
		if(!empty($danhsach))
		{
			foreach($danhsach as $item)
			{
				$kichban = json_decode($item['kichban']);
				$thongtin_kichban = '';
				if(!empty($kichban))
				{
					foreach($kichban as $tmp)
					{
						$thongtin_kichban .= $this->mkichban->thongtin_kichban($tmp)['kichban'].', ';
					}
				}
				$thongtin_kichban = rtrim($thongtin_kichban, ', ');
				
				$dienvien = json_decode($item['dienvien']);
				$thongtin_dienvien = '';
				if(!empty($dienvien))
				{
					foreach($dienvien as $tmp)
					{
						$thongtin_dienvien .= $this->mdienvien->thongtin_dienvien($tmp)['ten_dienvien'].', ';
					}
				}
				$thongtin_dienvien = rtrim($thongtin_dienvien, ', ');
				
				$theloai = json_decode($item['theloai']);
				$thongtin_theloai = '';
				if(!empty($theloai))
				{
					foreach($theloai as $tmp)
					{
						$thongtin_theloai .= $this->mtheloai->thongtin_theloai($tmp)['tentheloai'].', ';
					}
				}
				$thongtin_theloai = rtrim($thongtin_theloai, ', ');
				
				$data['danhsach'][] = array(
					'id_phim' => $item['id_phim'],
					'tenphim_vn' => $item['tenphim_vn'],
					'tenphim_en' => $item['tenphim_en'],
					'daodien' => $this->mdaodien->thongtin_daodien($item['daodien'])['ten_daodien'],
					'kichban' => $thongtin_kichban,
					'dienvien' => $thongtin_dienvien,
					'theloai' => $thongtin_theloai,
					'poster' => $item['poster'],
					'active' => $item['active'],
					'luotxem' => $item['luotxem'],
					'phimbo' => $item['phimbo'],
					'trailer' => $item['trailer'],
					'ngay_them' => $item['ngay_them'],
					'nam_sanxuat' => $item['nam_sanxuat'],
					'thoiluong' => $item['thoiluong'],
					'diem_imdb' => $item['diem_imdb'],
					'link_phude' => $item['link_phude'],
					'link_thuyetminh' => $item['link_thuyetminh'],
				);
			}
		}
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/phim/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function themphim()
	{
		$data['title'] = 'Thêm phim mới';
		$data['content'] = 'admin/phim/them';
		if(isset($_POST['themphim']))
		{
			$tenphim_vn = $this->input->post('tenphim_vn');
			$tenphim_en = $this->input->post('tenphim_en');
			$daodien = $this->input->post('daodien');
			$kichban = explode(',',$this->input->post('kichban')); 
			$dienvien = explode(',',$this->input->post('dienvien'));
			$nam_sanxuat = $this->input->post('nam_sanxuat');
			$theloai = explode(',',$this->input->post('theloai'));
			$thoiluong = $this->input->post('thoiluong');
			$diem_imdb = $this->input->post('diem_imdb');
			
			$link_phude = strstr($this->input->post('link_phude'), '=');
			$link_phude = ltrim($link_phude, '=');
			if($link_phude != '')
			{
				$link_phude = 'https://drive.google.com/file/d/'.$link_phude.'/preview';
			}
			
			$link_thuyetminh = strstr($this->input->post('link_thuyetminh'), '=');
			$link_thuyetminh = ltrim($link_thuyetminh, '=');
			if($link_thuyetminh != '')
			{
				$link_thuyetminh = 'https://drive.google.com/file/d/'.$link_thuyetminh.'/preview';
			}
			
			$gioithieu = $this->input->post('gioithieu');
			
			$trailer = strstr($this->input->post('trailer'), '=');
			$trailer = ltrim($trailer, '=');
			if($trailer != '')
			{
				$trailer = 'https://www.youtube.com/embed/'.$trailer;
			}
			
			$phimbo = $this->input->post('phimbo');
			
			if(empty($phimbo))
			{
				$phimbo = 0;
			}
			
			$tenhinh = $this->chuanhoa->gach_noi($tenphim_en);
			$config['upload_path'] = 'img/poster/';
            $config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $tenhinh;
            $this->load->library("upload", $config);

            if($this->upload->do_upload('poster'))
			{
				$img = $this->upload->data();
				$poster = $img['file_name'];
				$conf['image_library'] = 'gd2';
				$conf['source_image'] = $config['upload_path'].$img['file_name'];
				$conf['create_thumb'] = false;
				$conf['maintain_ratio'] = false;
				$conf['width']         = 500;
				$conf['height']       = 750;
				$this->load->library('image_lib', $conf);
				$this->image_lib->resize();
			}
			else
			{
				$poster = '';
			}
			$dat_daodien = array(
				'ten_daodien' => trim($daodien),
				'ten_daodien_kd' => $this->chuanhoa->convert_vi_to_en(trim($daodien)),
			);
			$id_daodien = $this->mdaodien->themdaodien($dat_daodien);
			$dat_kichban = array();
			if(!empty($kichban))
			{
				foreach($kichban as $key => $item)
				{
					$tam['kichban'] = trim($item);
					$tam['kichban_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_kichban = $this->mkichban->themkichban($tam);
					$dat_kichban[] = $id_kichban;
				}
			}
			$dat_dienvien = array();
			if(!empty($dienvien))
			{
				foreach($dienvien as $item)
				{
					$tam1['ten_dienvien'] = trim($item);
					$tam1['ten_dienvien_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_dienvien = $this->mdienvien->themdienvien($tam1);
					$dat_dienvien[] = $id_dienvien;
				}
			}
			$dat_theloai = array();
			if(!empty($theloai))
			{
				foreach($theloai as $item)
				{
					$tam2['tentheloai'] = trim($item);
					$tam2['tentheloai_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_theloai = $this->mtheloai->themtheloai($tam2);
					$dat_theloai[] = (string)$id_theloai;
				}
			}
			$dat = array(
				'tenphim_vn' => $tenphim_vn,
				'tenphim_en' => $tenphim_en,
				'daodien' => $id_daodien,
				'kichban' => json_encode($dat_kichban),
				'dienvien' => json_encode($dat_dienvien),
				'theloai' => json_encode($dat_theloai),
				'nam_sanxuat' => $nam_sanxuat,
				'thoiluong' => $thoiluong,
				'diem_imdb' => $diem_imdb,
				'link_phude' => $link_phude,
				'link_thuyetminh' => $link_thuyetminh,
				'poster' => $poster,
				'gioithieu' => $gioithieu,
				'phimbo' => $phimbo,
				'trailer' => $trailer,
				'ngay_them' => date('Y-m-d H:i:s'),
			);
			$id_phim = $this->mphim->themphim($dat);
			if($id_phim)
			{
				$_SESSION['success'] = 'Thêm phim thành công!';
				redirect(base_url('admin/phim'));
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
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa phim';
		
		if(isset($_POST['luu']))
		{
			$tenphim_vn = $this->input->post('tenphim_vn');
			$tenphim_en = $this->input->post('tenphim_en');
			$daodien = $this->input->post('daodien');
			$kichban = explode(',',$this->input->post('kichban')); 
			$dienvien = explode(',',$this->input->post('dienvien'));
			$nam_sanxuat = $this->input->post('nam_sanxuat');
			$theloai = explode(',',$this->input->post('theloai'));
			$thoiluong = $this->input->post('thoiluong');
			$diem_imdb = $this->input->post('diem_imdb');
			$link_phude = trim($this->input->post('link_phude'));
			if(strpos($link_phude, '=') !== false)
			{
				$link_phude = strstr($link_phude, '=');
				$link_phude = ltrim($link_phude, '=');
				$link_phude = 'https://drive.google.com/file/d/'.$link_phude.'/preview';
			}
			$link_thuyetminh = trim($this->input->post('link_thuyetminh'));
			if(strpos($link_thuyetminh, '=') !== false)
			{
				$link_thuyetminh = strstr($link_thuyetminh, '=');
				$link_thuyetminh = ltrim($link_thuyetminh, '=');
				$link_thuyetminh = 'https://drive.google.com/file/d/'.$link_thuyetminh.'/preview';
			}
			$gioithieu = $this->input->post('gioithieu');
			$trailer = trim($this->input->post('trailer'));
			if(strpos($trailer, '=') !== false)
			{
				$trailer = strstr($trailer, '=');
				$trailer = ltrim($trailer, '=');
				$trailer = 'https://www.youtube.com/embed/'.$trailer;
			}
			$phimbo = $this->input->post('phimbo');
			
			if(empty($phimbo))
			{
				$phimbo = 0;
			}
			
			$tenhinh = $this->chuanhoa->gach_noi($tenphim_en);
			$config['upload_path'] = 'img/poster/';
            $config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $tenhinh;
            $this->load->library("upload", $config);

            if($this->upload->do_upload('poster'))
			{
				$img = $this->upload->data();
				$poster = $img['file_name'];
				$conf['image_library'] = 'gd2';
				$conf['source_image'] = $config['upload_path'].$img['file_name'];
				$conf['create_thumb'] = false;
				$conf['maintain_ratio'] = false;
				$conf['width']         = 500;
				$conf['height']       = 750;
				$this->load->library('image_lib', $conf);
				$this->image_lib->resize();
			}
			else
			{
				$poster = $this->input->post('poster_cu');
			}
			$dat_daodien = array(
				'ten_daodien' => trim($daodien),
				'ten_daodien_kd' => $this->chuanhoa->convert_vi_to_en(trim($daodien)),
			);
			$id_daodien = $this->mdaodien->themdaodien($dat_daodien);
			$dat_kichban = array();
			if(!empty($kichban))
			{
				foreach($kichban as $key => $item)
				{
					$tam['kichban'] = trim($item);
					$tam['kichban_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$tam['kichban_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_kichban = $this->mkichban->themkichban($tam);
					$dat_kichban[] = $id_kichban;
				}
			}
			$dat_dienvien = array();
			if(!empty($dienvien))
			{
				foreach($dienvien as $item)
				{
					$tam1['ten_dienvien'] = trim($item);
					$tam1['ten_dienvien_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_dienvien = $this->mdienvien->themdienvien($tam1);
					$dat_dienvien[] = $id_dienvien;
				}
			}
			$dat_theloai = array();
			if(!empty($theloai))
			{
				foreach($theloai as $item)
				{
					$tam2['tentheloai'] = trim($item);
					$tam2['tentheloai_kd'] = $this->chuanhoa->convert_vi_to_en(trim($item));
					$id_theloai = $this->mtheloai->themtheloai($tam2);
					$dat_theloai[] = $id_theloai;
				}
			}
			$dat = array(
				'tenphim_vn' => $tenphim_vn,
				'tenphim_en' => $tenphim_en,
				'daodien' => $id_daodien,
				'kichban' => json_encode($dat_kichban),
				'dienvien' => json_encode($dat_dienvien),
				'theloai' => json_encode($dat_theloai),
				'nam_sanxuat' => $nam_sanxuat,
				'thoiluong' => $thoiluong,
				'diem_imdb' => $diem_imdb,
				'link_phude' => $link_phude,
				'link_thuyetminh' => $link_thuyetminh,
				'poster' => $poster,
				'gioithieu' => $gioithieu,
				'phimbo' => $phimbo,
				'trailer' => $trailer,
			);
			$id_phim = $this->mphim->capnhat($dat, $id);
			if($id_phim)
			{
				$_SESSION['success'] = 'Cập nhật thành công!';
				redirect(base_url('admin/phim'));
			}
		}
		
		$chitietphim = $this->mphim->chitietphim($id);
		if(!empty($chitietphim))
		{
			$kichban = json_decode($chitietphim['kichban']);
			$thongtin_kichban = '';
			if(!empty($kichban))
			{
				foreach($kichban as $tmp)
				{
					$thongtin_kichban .= $this->mkichban->thongtin_kichban($tmp)['kichban'].', ';
				}
			}
			$thongtin_kichban = rtrim($thongtin_kichban, ', ');

			$dienvien = json_decode($chitietphim['dienvien']);
			$thongtin_dienvien = '';
			if(!empty($dienvien))
			{
				foreach($dienvien as $tmp)
				{
					$thongtin_dienvien .= $this->mdienvien->thongtin_dienvien($tmp)['ten_dienvien'].', ';
				}
			}
			$thongtin_dienvien = rtrim($thongtin_dienvien, ', ');

			$theloai = json_decode($chitietphim['theloai']);
			$thongtin_theloai = '';
			if(!empty($theloai))
			{
				foreach($theloai as $tmp)
				{
					$thongtin_theloai .= $this->mtheloai->thongtin_theloai($tmp)['tentheloai'].', ';
				}
			}
			$thongtin_theloai = rtrim($thongtin_theloai, ', ');

			$data['chitietphim'] = array(
				'id_phim' => $chitietphim['id_phim'],
				'tenphim_vn' => $chitietphim['tenphim_vn'],
				'tenphim_en' => $chitietphim['tenphim_en'],
				'daodien' => $this->mdaodien->thongtin_daodien($chitietphim['daodien'])['ten_daodien'],
				'kichban' => $thongtin_kichban,
				'dienvien' => $thongtin_dienvien,
				'theloai' => $thongtin_theloai,
				'poster' => $chitietphim['poster'],
				'active' => $chitietphim['active'],
				'luotxem' => $chitietphim['luotxem'],
				'phimbo' => $chitietphim['phimbo'],
				'trailer' => $chitietphim['trailer'],
				'ngay_them' => $chitietphim['ngay_them'],
				'nam_sanxuat' => $chitietphim['nam_sanxuat'],
				'thoiluong' => $chitietphim['thoiluong'],
				'diem_imdb' => $chitietphim['diem_imdb'],
				'link_phude' => $chitietphim['link_phude'],
				'link_thuyetminh' => $chitietphim['link_thuyetminh'],
				'gioithieu' => $chitietphim['gioithieu'],
			);
		}
		$data['content'] = 'admin/phim/chinhsua';
		$this->load->view('admin/layout', $data);
	}
	public function capnhat_phimbo_active()
	{
		if(isset($_POST['active']))
		{
			$id_phim = $this->input->post('id_phim');
			$active = $this->input->post('active');
			
			$kq = $this->mphim->capnhat(array('active'=>$active), $id_phim);
			if($kq == true)
			{
				echo 'Xóa thành công.';
			}
			else
			{
				echo 'Lỗi';
			}
		}
		if(isset($_POST['phimbo']))
		{
			$id_phim = $this->input->post('id_phim');
			$phimbo = $this->input->post('phimbo');
			
			$kq = $this->mphim->capnhat(array('phimbo'=>$phimbo), $id_phim);
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
}
