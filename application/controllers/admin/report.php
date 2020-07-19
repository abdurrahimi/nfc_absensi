<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_monitoring');
    }

    public function wizard(){
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['v_content'] = 'member/report/wizard';
        $this->load->view('member/layout', $data);

    }
	
	public function daftar($id){
        $data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		if($id=="harian"){
			$data['tgl'] = $post['txtTgl'];
			$data['id_area'] = $post['id_area'];
			$data['listData'] = $this->m_monitoring->getAllMonitoringByDate($data['tgl'],$data['id_area']);
			//echo $this->db->last_query();die;
			$this->load->view('member/report/laporan_harian', $data);
		}else{
			$data['bulan'] = $post['spinPeriodeBulan'];
			$data['tahun'] = $post['txtTahun'];
			$data['id_area'] = $post['id_area'];
			$data['listData'] = $this->m_monitoring->getAllMonitoringByPeriode($data['bulan'],$data['tahun'],$data['id_area']);
			$this->load->view('member/report/laporan_bulanan', $data);
		}

    }
	
	
	
}