<?php

class m_monitoring extends CI_Model {
    function __construct() {
        parent::__construct();
        
    }

    function getAllMonitoring($tgl,$id_user){
        $this->db->select('TK.nama_lengkap,LP.id_user,LP.lat,LP.long long1,LP.waktu_log');
        $this->db->from('(select * from log_posisi order by id_log_presensi desc) LP');
        $this->db->join('siswa TK','LP.id_user = TK.nik');
        $this->db->where('date(LP.waktu_log)',$tgl);
        $this->db->where('LP.id_user like',$id_user);
        $this->db->group_by('LP.id_user');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAreaID($id){
        $this->db->select('*');
        $this->db->from('area');
        $this->db->where('id_area',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
	
	function getAllMonitoringByDate($date,$id_area){
		$data = $this->getAreaID($id_area);
		$sql_lama = "SELECT nik, nama_lengkap,date(waktu_log) waktu_log,hari_log,id_jabatan
						FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik
						WHERE date(waktu_log) = '".$date."' AND Contains(
						GeomFromText('POLYGON((".str_replace(","," ",$data['latlong_a']).", ".str_replace(","," ",$data['latlong_b']).", ".str_replace(","," ",$data['latlong_c']).", ".str_replace(","," ",$data['latlong_d']).", ".str_replace(","," ",$data['latlong_a'])."))'), latlong ) group by nik order by nik;";
		
		$sql_in_lat ="SELECT nik, nama_lengkap,date(waktu_log) waktu_log,hari_log,id_jabatan
						FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik
						WHERE date(waktu_log) = '".$date."' AND id_area = '".$id_area."' group by nik order by nik;";
		$que = $this->db->query($sql_in_lat)->result_array();
		return $que;
	}
	
	function jadwal($id_jabatan,$hari,$i){
        $sql_in_lat =" select DATE_FORMAT(jam_mulai,'%H:%i') as jam_mulai,DATE_FORMAT(jam_selesai,'%H:%i')  as jam_selesai,tipe_aktifitas.nama_aktifitas,jadwal.id_aktifitas
        from jadwal
        inner join tipe_aktifitas on jadwal.id_aktifitas = tipe_aktifitas.id_tipe_aktifitas
		where id_jabatan = '".$id_jabatan."' and
        hari = '".$hari."' and id_aktifitas = '".$i."'
		order by id_aktifitas asc;";
        $que = $this->db->query($sql_in_lat)->result_array();
		return $que[0];
    }
	
	function getAllMonitoringByTipe($nik,$date,$id){
		$data = $this->getAreaID('1');
		$sql_lama = "SELECT DATE_FORMAT(min(waktu_log),'%H:%i') as jam
						FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik
						WHERE date(waktu_log) = '".$date."' and nik = '".$nik."' and id_tipe_aktifitas = '".$id."' AND Contains(
						GeomFromText('POLYGON((".str_replace(","," ",$data['latlong_a']).", ".str_replace(","," ",$data['latlong_b']).", ".str_replace(","," ",$data['latlong_c']).", ".str_replace(","," ",$data['latlong_d']).", ".str_replace(","," ",$data['latlong_a'])."))'), latlong ) group by nik;";
		$sql_in_lat ="	SELECT DATE_FORMAT(min(waktu_log),'%H:%i') as jam
						FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik
						WHERE date(waktu_log) = '".$date."' and nik = '".$nik."' and id_tipe_aktifitas = '".$id."' group by nik;";
		$que = $this->db->query($sql_in_lat)->result_array();
		return $que[0];
	}
	
	function getAllMonitoringByPeriode($bulan,$tahun,$id_area){
		$data = $this->getAreaID($id_area);
		$sql_lama = "select x.nik,x.nama_lengkap,x.jam_masuk,x.jam_pulang,count(x.waktu_log) hari_kerja,SEC_TO_TIME( SUM( TIME_TO_SEC( x.jam_kerja ) ) ) jam_kerja,
		SEC_TO_TIME( SUM( TIME_TO_SEC( x.jam_telat ) ) ) jam_telat		from (
		SELECT nik, nama_lengkap, waktu_log,date(waktu_log),DATE_FORMAT(min(waktu_log),'%H:%i') jam_masuk,DATE_FORMAT(max(waktu_log),'%H:%i') jam_pulang
		,timediff(DATE_FORMAT(max(waktu_log),'%H:%i'),DATE_FORMAT(min(waktu_log),'%H:%i')) jam_kerja,jadwal.jam_selesai,timediff(DATE_FORMAT(min(waktu_log),'%H:%i'),
		DATE_FORMAT(jadwal.jam_mulai,'%H:%i')) jam_telat
		FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik 
						left outer join jadwal on jadwal.hari = log_posisi.hari_log
						WHERE year(waktu_log) = '".$tahun."' and month(waktu_log) = '".$bulan."' AND Contains(
						GeomFromText('POLYGON((".str_replace(","," ",$data['latlong_a']).", ".str_replace(","," ",$data['latlong_b']).", ".str_replace(","," ",$data['latlong_c']).", ".str_replace(","," ",$data['latlong_d']).", ".str_replace(","," ",$data['latlong_a'])."))'), latlong ) group by nik,date(waktu_log) ) x
group by x.nik order by x.nik";
		$sql_in_lat ="select x.nik,
							x.nama_lengkap,
							x.jam_masuk,
							x.jam_pulang,
							count(x.waktu_log) hari_kerja,
							SEC_TO_TIME( SUM( TIME_TO_SEC( x.jam_kerja ) ) ) jam_kerja,
							SEC_TO_TIME( SUM(IF(TIME_TO_SEC( x.jam_telat ) > 0,TIME_TO_SEC( x.jam_telat ),0) ) ) jam_telat,
							SEC_TO_TIME( SUM(IF(TIME_TO_SEC( x.jam_over ) > 0,TIME_TO_SEC( x.jam_over ),0) ) ) jam_over		
							from (
									SELECT 	nik, 
											nama_lengkap, 
											waktu_log,
											date(waktu_log),
											DATE_FORMAT(min(waktu_log),'%H:%i') jam_masuk,
											DATE_FORMAT(max(waktu_log),'%H:%i') jam_pulang,
											timediff(DATE_FORMAT(max(waktu_log),'%H:%i'),
											DATE_FORMAT(min(waktu_log),'%H:%i')) jam_kerja,
											jadwal.jam_selesai,
											timediff(DATE_FORMAT(min(waktu_log),'%H:%i'),
											DATE_FORMAT(jadwal.jam_mulai,'%H:%i')) jam_telat,
											timediff(DATE_FORMAT(max(waktu_log),'%H:%i'),
											DATE_FORMAT(jadwal.jam_selesai,'%H:%i')) jam_over
											FROM log_posisi inner join siswa on log_posisi.id_user = siswa.nik 
						left outer join jadwal on jadwal.hari = log_posisi.hari_log
						WHERE year(waktu_log) = '".$tahun."' and month(waktu_log) = '".$bulan."' AND id_area = '".$id_area."' group by nik,date(waktu_log) ) x
						group by x.nik order by x.nik";
		$que = $this->db->query($sql_in_lat)->result_array();
		return $que;
	}

    
}
