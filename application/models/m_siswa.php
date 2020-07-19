<?php

class m_siswa extends CI_Model {
    function __construct() {
        parent::__construct();
        
    }

    function getAllsiswa(){
        $this->db->select('TK.*');
        #$this->db->join('area AR','AR.id_area = TK.id_area','left');
        $this->db->from('siswa TK');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getsiswaID($id){
        $this->db->select('TK.*');
        $this->db->from('siswa TK');
        $this->db->where('TK.nis',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
    
}
