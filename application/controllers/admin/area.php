<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
    }


    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->m_umum->getAllArea();
        $data['v_content'] = 'member/area/list';
        $this->load->view('member/layout', $data);

    }
	
	public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        //$dat['dataDetail'] = $this->m_umum->
        $data['v_content'] = 'member/area/add';
        $this->load->view('member/layout', $data);

    }

    public function edit($id){
        $data = $this->m_umum->getAreaID($id);
        if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan area dengan ID tsb","gagal"); 
            redirect('admin/areadaftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/area/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
            $post = $this->input->post();
			$longlat1 = str_replace('(', '', $post['txtKoor1']);
			$longlat2 = str_replace('(', '', $post['txtKoor2']);
			$longlat3 = str_replace('(', '', $post['txtKoor3']);
			$longlat4 = str_replace('(', '', $post['txtKoor4']);
			$longlat1 = str_replace(')', '', $longlat1); 
			$longlat2 = str_replace(')', '', $longlat2); 
			$longlat3 = str_replace(')', '', $longlat3); 
			$longlat4 = str_replace(')', '', $longlat4);
            $dataToInsert = array("nama_area" => $post['txtArea'],
								  "latlong_a" => $longlat1,
								  "latlong_b" => $longlat2,
								  "latlong_c" => $longlat3,
								  "latlong_d" => $longlat4
								);
            if($this->db->update('area',$dataToInsert,array('id_area' => $id))){
				$this->m_umum->generatePesan("Berhasil update area","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update area","gagal");
            }
            redirect('admin/area/daftar');
    }
	
	public function doAdd(){
            $post = $this->input->post();
			$longlat1 = str_replace('(', '', $post['txtKoor1']);
			$longlat2 = str_replace('(', '', $post['txtKoor2']);
			$longlat3 = str_replace('(', '', $post['txtKoor3']);
			$longlat4 = str_replace('(', '', $post['txtKoor4']);
			$longlat1 = str_replace(')', '', $longlat1); 
			$longlat2 = str_replace(')', '', $longlat2); 
			$longlat3 = str_replace(')', '', $longlat3); 
			$longlat4 = str_replace(')', '', $longlat4);
            $dataToInsert = array("nama_area" => $post['txtArea'],
								  "latlong_a" => $longlat1,
								  "latlong_b" => $longlat2, 
								  "latlong_c" => $longlat3,
								  "latlong_d" => $longlat4
								);
            if($this->db->insert('area',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil insert area","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal insert area","gagal");
            }
            redirect('admin/area/daftar');
    }
	
	public function doDelete($id){
		if($id == 1){
			$this->m_umum->generatePesan("Gagal hapus area, area kantor utama tidak bisa dihapus","gagal");
			redirect('admin/area/daftar');
		}
		$delete = $this->db->delete('area',array('id_area' => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil hapus area","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal hapus area","gagal");
		}
		redirect('admin/area/daftar');
    }
}