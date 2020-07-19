<?php

class m_siswa extends CI_Model {
    function __construct() {
        parent::__construct();
        
    }

    function getAllsiswa(){
        $this->db->from('siswa TK');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getsiswaID($id){
        $this->db->from('siswa TK');
        $this->db->where('TK.nik',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
    
}
