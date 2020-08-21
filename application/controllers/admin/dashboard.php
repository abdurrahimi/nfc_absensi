<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
	}


	public function index()
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['v_content'] = 'member/dashboard/content';
		$this->load->view('member/layout', $data);
	}
}
