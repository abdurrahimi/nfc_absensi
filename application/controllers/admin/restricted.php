<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restricted extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_member');
        $this->load->model('m_ewallet');
    }


    public function index()
	{
		// $data['listRemaining'] = $this->m_barang->remainingBarangHabis()->result();
		// die(var_dump($data['listRemaining']));
		$data['userLogin'] = $this->session->userdata('DataLoginMember');
		$data['detailUser'] = $this->m_member->getMemberByID($data['userLogin']['MemberID']);
             
		$data['v_content'] = 'member/dashboard/restrict_stokist';
		$this->load->view('member/layout',$data);
	}
    

}
