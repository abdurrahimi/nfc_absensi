<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class siswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_siswa');
    }

    public function daftar()
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['listData'] = $this->m_siswa->getAllsiswa();
        $data['v_content'] = 'member/siswa/list';
        $this->load->view('member/layout', $data);
    }

    public function add()
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        //$data['listJabatan'] = $this->m_jabatan->getAllJabatan();
        $data['v_content'] = 'member/siswa/add';
        $this->load->view('member/layout', $data);
    }

    public function doAdd()
    {
        $post = $this->input->post();
        $foto = $this->Upload();
        $dataToInsert = array(
            "nis"             => $post['nis'],
            "nama_lengkap"     => $post['txtNamasiswa'],
            "nohp"             => $post['txtNoHp'],
            "jnskel"             => $post['txtJnskel'],
            "foto"              => $foto
        );
        if ($this->db->insert('siswa', $dataToInsert)) {
            $this->m_umum->generatePesan("Berhasil menambahkan siswa", "berhasil");
            redirect('admin/siswa/daftar');
        } else {
            $this->m_umum->generatePesan("Gagal menambahkan karyawn", "gagal");
            redirect('admin/siswa/add');
        }
    }

    public function Upload()
    {
        $foto = "";
        $upload_path = './uploads';
        if ($_FILES['foto']['name'] <> "") {
            $ext           = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $foto = "FI" . date("dmYHis") . rand(100, 999) . "." . $ext;

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'PNG|png|JPG|jpg|JPEG|jpeg';
            $config['file_name']     = $foto;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $error = 'error: ' . $this->upload->display_errors();
                echo $error;
                die;
            }
        }
        return $foto;
    }

    public function doDelete($id)
    {
        $hapus = $this->db->delete('siswa', array('nis' => $id));
        if ($hapus) {
            $this->m_umum->generatePesan("Berhasil menghapus siswa", "berhasil");
        } else {
            $this->m_umum->generatePesan("Gagal menghapus siswa", "gagal");
        }
        redirect('admin/siswa/daftar');
    }

    public function edit($id)
    {
        $datasiswa = $this->m_siswa->getsiswaID($id);
        if (count($datasiswa) == 0) {
            $this->m_umum->generatePesan("Tidak dapat menemukan siswa dengan NIK tsb", "gagal");
            redirect('admin/siswa/daftar');
        } else {
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $datasiswa;
            $data['v_content'] = 'member/siswa/edit';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEdit($id)
    {
        $post = $this->input->post();

        $dataToInsert = array(
            "nis"           => $post['nis'],
            "nama_lengkap"    => $post['txtNamasiswa'],
            "nohp"            => $post['txtNoHp'],
            "jnskel"          => $post['txtJnskel'],
        );
        if ($_FILES['foto']['name'] <> "") {
            $dataToInsert['foto'] = $this->Upload();
        }
        if ($this->db->update('siswa', $dataToInsert, array('nis' => $id))) {
            $this->m_umum->generatePesan("Berhasil update siswa", "berhasil");
        } else {
            $this->m_umum->generatePesan("Gagal update siswa", "gagal");
        }
        redirect('admin/siswa/daftar/');
    }
}
