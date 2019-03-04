<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ykien extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['admin_id']))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('mykien');
	}
	
	public function index()
	{
		$data['title'] = 'Danh sách ý kiến';
		
		if($this->uri->segment(3))
			$batdau = $this->uri->segment(3);
		else
			$batdau =0;
		//cấu hình phân trang
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		//phân trang
		$config['total_rows'] = $this->mykien->countAll();
        $config['base_url'] = base_url()."admin/ykien";

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
		
		$data['ykien'] = $this->mykien->danhsach($batdau, $config['per_page']);
		
		if(isset($_SESSION['success']))
		{
			$data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}
		$data['content'] = 'admin/ykien/danhsach';
		$this->load->view('admin/layout', $data);
	}
	public function themykien()
	{
		$data['title'] = 'Thêm ý kiến mới';
		$data['content'] = 'admin/ykien/them';
		if(isset($_POST['themykien']))
		{
			$this->form_validation->set_rules('hoten', 'họ tên', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidung', 'nọi dung', 'required', array('required' => 'Vui lòng nhập %s'));
			$file = $_FILES["hinhanh"];
			if($file['error'] != 0)
			{
				$data['error_file'] = 'Vui lòng chọn file';
			}
			if($this->form_validation->run() != FALSE && $file['error'] == 0)
			{
				$hoten = $this->input->post('hoten');
				$noidung = $this->input->post('noidung');
				$trangchu = !empty($this->input->post('trangchu')) ? $this->input->post('trangchu') : 0;

				$config['upload_path'] = 'img/ykien/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > ($img['image_height']))
					{
						$conf['width'] = $img['image_height'];
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
					'hoten' => $hoten,
					'noidung' => $noidung,
					'trangchu' => $trangchu,
					'hinhanh' => $hinhanh,
					'ngaythem' => date('Y-m-d H:i:s'),
				);
				$idykien = $this->mykien->themykien($dat);
				if($idykien)
				{
					$_SESSION['success'] = 'Thêm ý kiến thành công!';
					redirect(base_url('admin/ykien'));
				}
			}
		}
		$this->load->view('admin/layout', $data); 
	}
	public function chinhsua($id)
	{
		$data['title'] = 'Chỉnh sửa ý kiến';
		$data['content'] = 'admin/ykien/chinhsua';
		$data['ykien'] = $this->mykien->get_ykien($id);
		if(isset($_POST['chinhsua']))
		{
			$this->form_validation->set_rules('hoten', 'họ tên', 'required', array('required' => 'Vui lòng nhập %s'));
			$this->form_validation->set_rules('noidung', 'nọi dung', 'required', array('required' => 'Vui lòng nhập %s'));
			if($this->form_validation->run() != FALSE)
			{
				$hoten = $this->input->post('hoten');
				$noidung = $this->input->post('noidung');
				$trangchu = !empty($this->input->post('trangchu')) ? $this->input->post('trangchu') : 0;

				$config['upload_path'] = 'img/ykien/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library("upload", $config);

				if($this->upload->do_upload('hinhanh'))
				{
					$img = $this->upload->data();
					$hinhanh = $img['file_name'];
					$conf['image_library'] = 'gd2';
					$conf['source_image'] = $config['upload_path'].$img['file_name'];
					$conf['create_thumb'] = false;
					$conf['maintain_ratio'] = false;
					if($img['image_width'] > ($img['image_height']))
					{
						$conf['width'] = $img['image_height'];
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
					'hoten' => $hoten,
					'noidung' => $noidung,
					'trangchu' => $trangchu,
					'hinhanh' => $hinhanh,
				);
				$result = $this->mykien->capnhat($dat, $id);
				if($result)
				{
					$_SESSION['success'] = 'Chỉnh sửa ý kiến thành công!';
					redirect(base_url('admin/ykien'));
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
			
			$kq = $this->mykien->capnhat(array('moi'=>$moi), $idsanpham);
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
			$idykien = $this->input->post('idykien');
			$trangchu = $this->input->post('trangchu');
			
			$kq = $this->mykien->capnhat(array('trangchu'=>$trangchu), $idykien);
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
	public function xoaykien()
	{
		$json = array();
		if(isset($_POST['idykien']))
		{
			$idykien = $this->input->post('idykien');
			
			$kq = $this->mykien->xoaykien($idykien);
			if($kq == true)
			{
				$json['success'] = 'Xóa ý kiến thành công.';
			}
			else
			{
				$json['error'] = 'Lỗi';
			}
		}
		echo json_encode($json);
	}
}
