<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rule extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('m_rule');
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_rule->getAllJadwal();
        $data['v_content'] = 'member/rule/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['listJabatan'] = $this->m_jabatan->getAllJabatan();
        $data['listAktifitas'] = $this->m_umum->getAllAktifitas();
        $data['v_content'] = 'member/rule/add';
        $this->load->view('member/layout', $data);
        
    }

    public function doAdd(){
        $post = $this->input->post(); 
		$dataToInsert = array("id_jabatan" => $post['spinJabatan'],
								"id_aktifitas" => $post['spinAktifitas'],
								"hari" => $post['spinHari'],
								"jam_mulai" => $post['txtJamMulai'],
								"jam_selesai" => $post['txtJamSelesai']);
		if($this->db->insert('jadwal',$dataToInsert)){
			$this->m_umum->generatePesan("Berhasil plus rule absensi","berhasil");
			redirect('admin/rule/daftar');
		}else{	
			$this->m_umum->generatePesan("Gagal menambahkan rule absensi","gagal");
			redirect('admin/rule/add');    
		}
        
    }

    public function doDelete($id){
        $hapus = $this->db->delete('jadwal',array('id_jadwal' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus jadwal","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus jadwal","gagal");   
        }
        redirect('admin/rule/daftar');
    }

    public function edit($id){
        $data = $this->m_rule->getJadwalID($id);
        if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan rule absensi dengan ID tsb","gagal"); 
            redirect('admin/rule/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
			$data['listJabatan'] = $this->m_jabatan->getAllJabatan();
			$data['listAktifitas'] = $this->m_umum->getAllAktifitas();
            $data['v_content'] = 'member/rule/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
        $post = $this->input->post(); 
		$dataToInsert = array("id_jabatan" => $post['spinJabatan'],
								"id_aktifitas" => $post['spinAktifitas'],
								"hari" => $post['spinHari'],
								"jam_mulai" => $post['txtJamMulai'],
								"jam_selesai" => $post['txtJamSelesai']);
		if($this->db->update('jadwal',$dataToInsert,array('id_jadwal' => $id))){
			$this->m_umum->generatePesan("Berhasil update rule absensi","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal update rule absensi","gagal");
		}
		redirect('admin/rule/daftar');
    }
}