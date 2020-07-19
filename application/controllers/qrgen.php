<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrgen extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_umum');
        $this->load->helper('captcha');
    }
	
	public function generate($id)
	{
		
        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = $id;
        $this->ciqrcode->generate($params);
	}
    
	
		
	
       
}
