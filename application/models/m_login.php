<?php

class m_login extends CI_Model
{
    function checkLogin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('users as us');
        $this->db->where('us.username', $username);
        $this->db->where('us.password', md5($password));
        //$this->db->where('id_jabatan <> 3');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $querycheck = $query->result();
            $dataArr = array(
                'user_id' => $querycheck[0]->user_id,
                'username' => strtoupper($querycheck[0]->username)
            );
            $this->session->set_userdata('loginData', $dataArr);
            return true;
        } else {
            $this->session->set_flashdata('GagalLogin', 'Ya');
            return false;
        }
    }
}
