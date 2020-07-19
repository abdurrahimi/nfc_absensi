<?php

class m_laporan extends CI_Model {
    function __construct() {
        parent::__construct();
		
        
    }

    function getAllGajihan(){
        $this->db->select('TK.*,TJ.NamaJabatan,TGP.NamaGolongan,TGP.NominalPKP');
        $this->db->from('tb_siswa TK');
		$this->db->join('tb_jabatan TJ','TK.JabatanID = TJ.JabatanID');
		$this->db->join('tb_golongan_pkp TGP','TK.GolonganPajakID = TGP.GolonganPajakID');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getAllsiswaByJabatan($id){
        $this->db->select('TK.*,TJ.NamaJabatan,TGP.NamaGolongan,TGP.NominalPKP');
        $this->db->from('tb_siswa TK');
        $this->db->join('tb_jabatan TJ','TK.JabatanID = TJ.JabatanID');
        $this->db->join('tb_golongan_pkp TGP','TK.GolonganPajakID = TGP.GolonganPajakID');
        $this->db->where('TK.JabatanID',$id); 
        $que = $this->db->get()->result_array();
        return $que;
    }

    function checkSudahGajihan($id,$bulan,$tahun){
        $sql = "SELECT * FROM tb_gaji where siswaID = '{$id}' AND PeriodeBulan = '{$bulan}' AND PeriodeTahun = '{$tahun}'";
        $query = $this->db->query($sql)->result_array();
        if(count($query)>0){
            return true;
        }else{
            return false;
        }
    }

    function getsiswaID($id){
        $this->db->select('TK.*,TJ.NamaJabatan,TJ.TarifLembur,TGP.NamaGolongan,TGP.NominalPKP');
        $this->db->from('tb_siswa TK');
        $this->db->join('tb_jabatan TJ','TK.JabatanID = TJ.JabatanID');
        $this->db->join('tb_golongan_pkp TGP','TK.GolonganPajakID = TGP.GolonganPajakID');
        $this->db->where('TK.siswaID',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }

    function getGajihan($jabatan,$periodeBulan,$periodeTahun){
        $this->db->select('TG.*,TK.Namasiswa,TK.NIK,TK.GajiUtama,TK.NoRek,TK.JabatanID,TK.GolonganPajakID,TJ.NamaJabatan,TJ.TarifLembur,TGP.NamaGolongan,TGP.NominalPKP');
        $this->db->from('tb_gaji TG');
        $this->db->join('tb_siswa TK','TG.siswaID = TK.siswaID');
        $this->db->join('tb_jabatan TJ','TK.JabatanID = TJ.JabatanID');
        $this->db->join('tb_golongan_pkp TGP','TK.GolonganPajakID = TGP.GolonganPajakID');
        $this->db->where('TG.PeriodeBulan',$periodeBulan);
        $this->db->where('TG.PeriodeTahun',$periodeTahun);
        $this->db->where('TK.JabatanID',$jabatan);
        $que = $this->db->get()->result_array();
        return $que;

    }

    function getDetailGajihan($gajihanID){
        $this->db->select('TG.*,TK.Namasiswa,TK.NIK,TK.GajiUtama,TK.NoRek,TK.JabatanID,TK.GolonganPajakID,TJ.NamaJabatan,TJ.TarifLembur,TGP.NamaGolongan,TGP.NominalPKP');
        $this->db->from('tb_gaji TG');
        $this->db->join('tb_siswa TK','TG.siswaID = TK.siswaID');
        $this->db->join('tb_jabatan TJ','TK.JabatanID = TJ.JabatanID');
        $this->db->join('tb_golongan_pkp TGP','TK.GolonganPajakID = TGP.GolonganPajakID');
        $this->db->where('TG.GajiID',$gajihanID);
        $que = $this->db->get()->result_array();
        return $que[0]; 
    }


	
	
	
	
    

    
}
