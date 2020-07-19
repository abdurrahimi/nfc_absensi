<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		  $this->load->model('m_admin');
    }

    public function daftar(){

        //$this->m_umum->generatePesan('<h4>Contact Our Stokist today!</h4> Below list of Our Stokist.','warning');
        
        $data['userLogin'] = $this->session->userdata('loginData'); 

        $data['listData'] = $this->m_admin->getAllAdmin(); 
        $data['v_content'] = 'member/admin/list';
        $this->load->view('member/layout', $data);

    }

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $data['v_content'] = 'member/admin/add';
        $this->load->view('member/layout', $data);
        
    }
	
	public function add_modal(){
        $data['userLogin'] = $this->session->userdata('loginData');
        
        $v_content = 'member/admin/add_modal';
        $this->load->view($v_content, $data);
        
    }

    public function doAdd(){
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtUsername', 'Username', 'required|is_unique[tb_admin.Username]');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('oldPost',$post);
            $this->m_umum->generatePesan(validation_errors(),"gagal");
            redirect('admin/admin/add');
        }else{    
            $dataToInsert = array("NamaUser" => $post['txtNama'],
                                  "Username" => $post['txtUsername'],
                                  "Password" => md5($post['txtPassword']));

            if($this->db->insert('tb_admin',$dataToInsert)){
				$this->m_umum->generatePesan("Berhasil menambahkan admin","berhasil");
				redirect('admin/admin/daftar');
            }else{
				$this->m_umum->generatePesan("Gagal menambahkan admin","gagal");
				redirect('admin/admin/add');
            }
            
        }
    }

    public function doDelete($id){
        $hapus = $this->db->delete('tb_admin',array('UserID	' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus admin","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus admin","gagal");   
        }
        redirect('admin/admin/daftar');
    }

    public function edit($id){
        $data = $this->m_admin->getAdminId($id);
        if(count($data)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan admin dengan ID tsb","gagal"); 
            redirect('admin/admin/daftar');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $data;
            $data['v_content'] = 'member/admin/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id){
            $post = $this->input->post();
			$data = $this->m_admin->getAdminId($id);
			if($data['Password'] == $post['txtPassword']){
				$dataToInsert = array("NamaUser" => $post['txtNama'],
									  "Username" => $post['txtUsername']);
			}else{
				$dataToInsert = array("NamaUser" => $post['txtNama'],
									  "Username" => $post['txtUsername'],
									  "Password" => md5($post['txtPassword']));
			}

            if($this->db->update('tb_admin',$dataToInsert,array('UserID' => $id))){
				$this->m_umum->generatePesan("Berhasil update admin","berhasil");
            }else{
				$this->m_umum->generatePesan("Gagal update admin","gagal");
            }

            redirect('admin/admin/daftar/');
    
    }
	
}