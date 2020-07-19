<?php

class m_umum extends CI_Model {
    function __construct() {
        parent::__construct();
		$cek_url = $this->uri->segment(2);
		if( $cek_url != "service" ){
			if(!$this->session->userdata('loginData')){
				redirect('admin/login');
			}
		}
        
    }
	
	function getAllArea(){
        $this->db->select('*');
        $this->db->from('area');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAreaID($id){
        $this->db->select('*');
        $this->db->from('area');
        $this->db->where('id_area',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
	
	function getArea(){
        $this->db->select('id_area,nama_area,latlong_a as latlong');
        $this->db->from('area');
        // $this->db->where('id_area','1');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getTipeAktivitas(){
        $this->db->select('*');
        $this->db->from('tipe_aktifitas');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAllAktifitas(){
        $this->db->select('*');
        $this->db->from('tipe_aktifitas TK');
		$this->db->order_by('TK.id_tipe_aktifitas');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function namaHari($hari){
		$namaHari = array("Monday" => "Senin","Tuesday" => "Selasa", "Wednesday" => "Rabu","Thursday" => "Kamis","Friday" => "Jum'at","Saturday" => "Sabtu", "Sunday" => "Minggu");
		return $namaHari[$hari];							
	}
	
    function generatePesan($pesan, $type) {
        if ($type == "berhasil") {
            $str = '<div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-check green"></i>-->
                        '.$pesan.'
                    </div>';
        } elseif($type=="gagal") {
            $str = '<div class="alert alert-block alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-times red"></i>-->
                        '.$pesan.'
                    </div>';
        }else{
            $str = '<div class="alert alert-block alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        
                        '.$pesan.'
                    </div>';
        }
        
        $this->session->set_flashdata('msgbox',$str);
		
		return $str;
    }
    
    
    
   

    function sendWhatsAppMessage($toNumber,$message){
        $key = '9bd664161dc8bcad0c28c30300b86853';
        $secret = 'c65e4abf04cc85a523923a48712f54b6';
        $message = urlencode($message);
        $urlPair = "http://128.199.178.179/whatapi/api/send_message?nomor=".$toNumber."&pesan=".$message."&secret=".$secret."&key=".$key."";
        $exe  = json_decode(file_get_contents($urlPair));
        $status       = $exe->success;

        if($status==1){
            return true;
        }else{
            return false;
        }
        //return $status;

    }
	
	
    function formatTanggal($datetime,$format='d/m/Y'){
        
        //die($datetime); 
        $time = strtotime($datetime);
        
        
        $myFormatForView = date($format, $time);
        return $myFormatForView;
    
    }

    
}
