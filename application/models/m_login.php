<?php

class m_login extends CI_Model {   
    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('users as us');
        $this->db->where('us.username', $username);
        $this->db->where('us.password', md5($password));
        //$this->db->where('id_jabatan <> 3');
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->result();
			$dataArr = array('user_id' => $querycheck[0]->user_id);
			$this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }
       
    }
	
	function loginMarketing($username,$password){
        $this->db->select('*');
        $this->db->from('siswa as us');
        $this->db->where('us.username', $username);
        $this->db->where('us.password', md5($password));
        $this->db->where('us.id_jabatan', '3');
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->result();
			$dataArr = array('id_siswa' => $querycheck[0]->id_siswa,'NamaUser' => $querycheck[0]->username,'id_jabatan' => $querycheck[0]->id_jabatan);
			$this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }
        
        
    }
	
	function dataMarketing($username){
        $this->db->select('*');
        $this->db->from('siswa as us');
        $this->db->where('us.username', $username);
        $this->db->where('us.id_jabatan', '3');
        $que = $this->db->get()->result_array();
        return $que[0];
        
        
    }
	
	
	
	function login_mhs_apps($device_id,$nim){
		$sql = "SELECT M.*,K.kelas,K.id_prodi,P.prodi,P.id_jurusan,J.jurusan FROM mahasiswa M JOIN kelas K on M.id_kelas = K.kode JOIN prodi P on K.id_prodi = P.kode JOIN jurusan J on P.id_jurusan = J.kode where M.device_id = '{$device_id}' AND M.nim = '{$nim}'";
		$que = $this->db->query($sql)->result_array();
		if(count($que)>0){
			
		return $que[0];	
		}else{
		return false;
		}
	}
	
	function login_dosen_apps($device_id,$nonip){
		$sql = "SELECT * FROM dosen D JOIN jabatan J on D.id_jabatan = J.kode where D.device_id='{$device_id}' AND D.nip = '{$nonip}'";
		$que = $this->db->query($sql)->result_array();
		if(count($que)>0){
			
			return $que[0];	
		}else{
			return false;
		}
	}
	
}
