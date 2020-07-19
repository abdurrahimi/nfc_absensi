<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        
    }
	
	public function index()
	{
		
        $this->load->view('member/Login');
	}
    
	
		
	function doLogin() {
        $dataPost = $this->input->post();
		$login = $this->m_login->checkLogin($dataPost['Username'], $dataPost['Password']);
		
        if ($login ) {
            $this->session->set_flashdata('tampil_pesan','yes');
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('admin/login');
        }
        
    }

    function logout() {
        $this->session->unset_userdata('loginData');
        redirect('admin/login');
    }
       
}
