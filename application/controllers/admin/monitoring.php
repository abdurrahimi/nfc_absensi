<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_monitoring');
        $this->load->model('m_siswa');
    }


    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        // $data['listData'] = $this->m_umum->getArea();
        // $data['listData'] = $this->m_monitoring->getAllMonitoring();
		// echo "<pre>";
		// var_dump($data['listData']);
		// echo "</pre>";
		// die;

        $data['listsiswa'] = $this->m_siswa->getAllsiswa();
        $data = $this->m_umum->getArea();
        $data['dataDetail'] = $data;
		// $datamonitoring = $this->m_monitoring->getAllMonitoring('2016-12-17','1000001'); 
		// echo $this->db->last_query();
		// echo "<pre>";
		// var_dump($datamonitoring);
		// echo "</pre>";
		// die;
        $data['v_content'] = 'member/monitoring/monitoring';
        $this->load->view('member/layout', $data);

    }
	
	function get_data_json(){
		$tgl = $this->input->post("iTgl");
		$nik = $this->input->post("iNik");
		$datamonitoring = $this->m_monitoring->getAllMonitoring($tgl,$nik);  //get from db
		// echo "<pre>";
		// var_dump($datamonitoring);
		// echo "</pre>";
		// die;
		//$to_json = array("data" => $datamonitoring);
		$json = json_encode ( $datamonitoring );
		header ( 'Access-Control-Allow-Origin: *' );
		header ( 'Access-Control-Expose-Headers: Access-Control-Allow-Origin' );
		header ( "HTTP/1.1 200 OK" );
		header ( 'Content-Type: application/json' );
		echo $json;
		die ();
		// echo json_encode($to_json); 
		// echo "ki";
		// die;
	}
	
    // public function d($id){
        // $data = $this->m_umum->getAreaID($id);
        // if(count($data)==0){
            // $this->m_umum->generatePesan("Tidak dapat menemukan area dengan ID tsb","gagal"); 
            // redirect('admin/areadaftar');
        // }else{
            // $data['userLogin'] = $this->session->userdata('loginData');
            // $data['dataDetail'] = $data;
            // $data['v_content'] = 'member/monitoring/posisi';
            // $this->load->view('member/layout', $data);
        // }
    // }

   
}