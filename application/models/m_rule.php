<?php

class m_rule extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllJadwal()
    {
        $this->db->select('TK.*');
        $this->db->from('jadwal TK');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getJadwalID($id)
    {
        $this->db->select('TK.*');
        $this->db->from('jadwal TK');
        $this->db->where('TK.id_jadwal', $id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
}
