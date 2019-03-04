<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mview extends CI_Model{

	public function __construct() {
	parent::__construct();
//		echo '<pre>';
//		print_r($_SERVER);
//		echo '</pre>';
		$ip = $_SERVER['REMOTE_ADDR'];
		$diachitruoc = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$diachisau = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$lichsu = $this->get_lichsu($ip, date('Y-m-d H:i:s', strtotime('-1 hour')));
		if(empty($lichsu))
		{
			$data = array(
				'ip' => $ip,
				'diachitruoc' => $diachitruoc,
				'diachisau' => $diachisau,
				'ngaygio' => date('Y-m-d H:i:s')
			);
			$this->themlichsu($data);
		}
	}

	public function get_lichsu($ip, $date)
	{
		$this->db->from('lichsuxem');
		$this->db->where('ip', $ip);
		$this->db->where('ngaygio >', $date);
		return $this->db->get()->row_array();
	}
	public function danhsach($start = NULL, $limit = NULL) 
	{
		$this->db->from('video');
		$this->db->order_by('ngaythem desc');
		if($limit != NULL && $start == NULL)
		{
			$this->db->limit($limit);
		}
		elseif($limit != NULL && $start != NULL)
		{
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result_array();
	}
	public function countAll(){
		$this->db->from('video');
		return $this->db->count_all_results(); 
	}
	public function themlichsu($data = array())
	{
		$this->db->insert('lichsuxem',$data);
		return $this->db->insert_id();
	}
	public function capnhat($data = array(), $id) 
	{
		$this->db->where('idvideo',$id);
        return $this->db->update('video',$data);
	}
	public function get_list_video($limit = NULL)
	{
		$this->db->from('video');
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		return $this->db->get()->result_array();
	}
	public function xoavideo($idvideo)
	{
		$this->db->where('idvideo', $idvideo);
		return $this->db->delete('video');
	}
	public function get_total_view_day() {
		$view_data = array();

		for ($i = 0; $i < 24; $i++) {
			$view_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}
		$this->db->select('count(*) as total, hour(ngaygio) as hour');
		$this->db->from('lichsuxem');
		$this->db->where('date(ngaygio) = date(now())');
		$this->db->group_by('hour(ngaygio)');
		$this->db->order_by('ngaygio', 'asc');

		foreach ($this->db->get()->result_array() as $result) {
			$view_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}

		return $view_data;
	}

	public function get_total_view_week() {
		$implode = array();

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `" . DB_PREFIX . "order` WHERE order_status_id IN(" . implode(",", $implode) . ") AND DATE(date_added) >= DATE('" . $this->db->escape(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(date_added)");

		foreach ($query->rows as $result) {
			$order_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function get_total_view_month() {
		$order_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$order_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}
		
		$this->db->select('count(*) as total, ngaygio');
		$this->db->from('lichsuxem');
		$this->db->where("date(ngaygio) >= '". date('Y-m-1') ."'");
		$this->db->group_by('date(ngaygio)');
		$this->db->order_by('ngaygio', 'asc');
		
		foreach ($this->db->get()->result_array() as $result) {
			$order_data[date('j', strtotime($result['ngaygio']))] = array(
				'day'   => date('d', strtotime($result['ngaygio'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByYear() {
		$implode = array();

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$order_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `" . DB_PREFIX . "order` WHERE order_status_id IN(" . implode(",", $implode) . ") AND YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->rows as $result) {
			$order_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}
}