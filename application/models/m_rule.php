<?php

class m_rule extends CI_Model {
    function __construct() {
        parent::__construct();
        
    }

    function getAllJadwal(){
        $this->db->select('TK.*,TJ.nama_jabatan,TA.nama_aktifitas');
        $this->db->from('jadwal TK');
        $this->db->join('jabatan TJ','TJ.id_jabatan = TK.id_jabatan');
        $this->db->join('tipe_aktifitas TA','TA.id_tipe_aktifitas = TK.id_aktifitas');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getJadwalID($id){
        $this->db->select('TK.*,TJ.nama_jabatan,TA.nama_aktifitas');
        $this->db->from('jadwal TK');
        $this->db->join('jabatan TJ','TJ.id_jabatan = TK.id_jabatan');
        $this->db->join('tipe_aktifitas TA','TA.id_tipe_aktifitas = TK.id_aktifitas');
        $this->db->where('TK.id_jadwal',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
    
}
