<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xemphim extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('mdaodien');
		$this->load->model('mdienvien');
		$this->load->model('mkichban');
	}
	public function index($id)
	{
		$data['title'] = 'Xem phim | phimmt';
		$phim = $this->mphim->playphim($id);
		
		$kichban = json_decode($phim['kichban']);
		$thongtin_kichban = '';
		if(!empty($kichban))
		{
			foreach($kichban as $tmp)
			{
				$thongtin_kichban .= $this->mkichban->thongtin_kichban($tmp)['kichban'].', ';
			}
		}
		$thongtin_kichban = rtrim($thongtin_kichban, ', ');

		$dienvien = json_decode($phim['dienvien']);
		$thongtin_dienvien = '';
		if(!empty($dienvien))
		{
			foreach($dienvien as $tmp)
			{
				$thongtin_dienvien .= $this->mdienvien->thongtin_dienvien($tmp)['ten_dienvien'].', ';
			}
		}
		$thongtin_dienvien = rtrim($thongtin_dienvien, ', ');

		$theloai = json_decode($phim['theloai']);
		$thongtin_theloai = '';
		if(!empty($theloai))
		{
			foreach($theloai as $tmp)
			{
				$thongtin_theloai .= $this->mtheloai->thongtin_theloai($tmp)['tentheloai'].', ';
			}
		}
		$thongtin_theloai = rtrim($thongtin_theloai, ', ');

		$data['phim'] = array(
			'id_phim' => $phim['id_phim'],
			'tenphim_vn' => $phim['tenphim_vn'],
			'tenphim_en' => $phim['tenphim_en'],
			'daodien' => $this->mdaodien->thongtin_daodien($phim['daodien'])['ten_daodien'],
			'kichban' => $thongtin_kichban,
			'dienvien' => $thongtin_dienvien,
			'theloai' => $thongtin_theloai,
			'poster' => $phim['poster'],
			'active' => $phim['active'],
			'luotxem' => $phim['luotxem'],
			'phimbo' => $phim['phimbo'],
			'trailer' => $phim['trailer'],
			'ngay_them' => $phim['ngay_them'],
			'nam_sanxuat' => $phim['nam_sanxuat'],
			'thoiluong' => $phim['thoiluong'],
			'diem_imdb' => $phim['diem_imdb'],
			'link_phude' => $phim['link_phude'],
			'link_thuyetminh' => $phim['link_thuyetminh'],
			'gioithieu' => $phim['gioithieu'],
		);
		
		$data['phimcungtheloai'] = $this->mphim->phimcungtheloai($theloai, $phim['id_phim']);
		
		$luotxem = $phim['luotxem'] + 1;
		$this->mphim->capnhat(array('luotxem' => $luotxem), $phim['id_phim']);
		
		$data['content'] = 'xemphim';
		$this->load->view('index', $data);
	}
}
