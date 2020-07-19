<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Service extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( 'm_umum' );
		$this->load->model ( 'm_api' ); 
		$this->load->model ( 'm_login' );
	}
	function index() {
		header ( "location: " . base_url () );
		die ();
	}

	function absensi(){
		$dataArray = array (
				'pic' => 'Absensi'
		);
		$param['tag'] = $this->input->post('TAG');
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$absen = false;
			$absen = $this->db->where('nfc',$param['tag'])->get('siswa')->row_array();
			if (!empty($absen)) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'profile' => $absen
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'NOT_OK' ,
						'msg'	  => 'Not Found'
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}

	}
	
	
	function login() {
		$dataArray = array (
				'pic' => 'Samuel'
		);
		$param['username'] = $this->input->post('username');
		$param['password'] = $this->input->post('password');
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$checkLogin = false;
			$checkLogin = $this->m_login->loginMarketing($param['username'],$param['password']);
			if ($checkLogin) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'profile' => $this->m_login->dataMarketing($param['username'])
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'NOT_OK' ,
						'msg'	  => 'Salah password'
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}

	function updateNFC() {
		$dataArray = array (
				'pic' => 'Samuel'
		);
		$param['nik'] = $this->input->post('nik');
		$param['nfc'] = $this->input->post('nfc');
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$checkLogin = $this->db->update("siswa",["nfc"=>$param['nfc']],["nik"=>$param['nik']]);
			if ($checkLogin) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'msg'	  => 'Berhasil Mengubah Data NFC'
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'NOT_OK' ,
						'msg'	  => 'Gagal Mengubah Data NFC'
				);
				$this->m_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	function Area(){
		$dataArray = array (
				'pic' => 'Samuel' 
		);
		$data = $this->m_umum->getArea();
		//echo $this->db->last_query();die;
		if($data){
			$dataArray ['results'] = $data;
			$this->m_api->sendOutput( $dataArray, 200 );
		}else{
			$this->m_api->sendOutput( $dataArray, 402 ); 
		}
	}
	
	function historyAkfitas()
	{

		$dataArray = array (
				'pic' => 'Samuel' 
		);
		$post = $this->input->post();
		$data = $this->db->query("SELECT 	nik, 
							nama_lengkap, 
							waktu_log,
							date(waktu_log) as tanggalnya,
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
					where nik = '".$post['nik']."'
					group by nik,date(waktu_log)
					order by date(waktu_log) desc")->result();
		if($data){
			foreach ($data as $key => $value) {
				if (!empty($value->jam_telat)) {
					if(substr($value->jam_telat,0,1) <> '-'){
					}else{
						$data[$key]->jam_telat = "-";
					}
				}else{
					$data[$key]->jam_telat = '-';
				}
				if (!empty($value->jam_over)) {
					if(substr($value->jam_over,0,1) <> '-'){
					}else{
						$data[$key]->jam_over = "-";
					}
				}else{
					$data[$key]->jam_over = '-';
				}
			}
			$dataArray ['results'] = [	'data'=>$data,
										'status'=>'OK',
										'msg'=>'Berhasil mengambil aktifitas'];
			$this->m_api->sendOutput( $dataArray, 200 );
		}else{
			$dataArray ['results'] = [	'data'=>$data,
										'status'=>'Not OK',
										'msg'=>'Data Kosong'];
			$this->m_api->sendOutput( $dataArray, 200 );
		}
	}

	function listTipeAktifitas(){
		$dataArray = array (
				'pic' => 'Samuel' 
		);
		$data = $this->m_umum->getTipeAktivitas();
		if($data){
			$dataArray ['results'] = $data;
			$this->m_api->sendOutput( $dataArray, 200 );
		}else{
			$this->m_api->sendOutput( $dataArray, 402 ); 
		}
		
	}
	
	
	function logAktifitas(){
		$dataArray = array (
				'pic' => 'Samuel' 
		);
		
		$param ['id_user'] = $this->input->post ( 'nik' );
		$param ['id_aktifitas'] = $this->input->post ( 'id_aktifitas' );
		$param ['lat_aktifitas'] = $this->input->post ( 'lat_aktifitas' );
		$param ['long_aktifitas'] = $this->input->post ( 'long_aktifitas' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {
			$waktu_log = date('Y-m-d H:i:s');
			$insert_to_log = array("id_user" => $param ['id_user'],
								   "waktu_log" => $waktu_log,
								   "id_aktifitas" => $param ['id_aktifitas'],
								   "lat_aktifitas" => $param ['lat_aktifitas'],
								   "long_aktifitas" => $param ['long_aktifitas']);
			$exe_insert = $this->db->insert("log_aktifitas",$insert_to_log);
			$id_insert = $this->db->insert_id();
			$update = $this->db->query("update log_aktifitas set latlong_aktifitas = POINT('".$param['lat_aktifitas']."','".$param ['long_aktifitas']."') where id_log_aktifitas = '".$id_insert."';");

			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}

	function checkPosition($lat,$long)
	{
		$in_area = false;
		$checkAreaUser = $this->db->query('select * from siswa where nik = "'.$this->input->post ( 'nik' ).'"')->row();
		$dataArea = $this->db->query('select * from area where id_area = "'.$checkAreaUser->id_area.'"')->result();
		foreach ($dataArea as $key => $value) {
			if (!empty($value->latlong_a)) {
				$latlong = explode(", ", $value->latlong_a);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(".$latlong[0].") ) 
							              * cos( radians( ".$lat." ) ) 
							              * cos( radians( ".$long." ) - radians(".$latlong[1].") ) 
							              + sin( radians(".$latlong[0].") ) 
							              * sin( radians( ".$lat." ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_b)) {
				$latlong = explode(", ", $value->latlong_b);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(".$latlong[0].") ) 
							              * cos( radians( ".$lat." ) ) 
							              * cos( radians( ".$long." ) - radians(".$latlong[1].") ) 
							              + sin( radians(".$latlong[0].") ) 
							              * sin( radians( ".$lat." ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_c)) {
				$latlong = explode(", ", $value->latlong_c);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(".$latlong[0].") ) 
							              * cos( radians( ".$lat." ) ) 
							              * cos( radians( ".$long." ) - radians(".$latlong[1].") ) 
							              + sin( radians(".$latlong[0].") ) 
							              * sin( radians( ".$lat." ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_d)) {
				$latlong = explode(", ", $value->latlong_d);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(".$latlong[0].") ) 
							              * cos( radians( ".$lat." ) ) 
							              * cos( radians( ".$long." ) - radians(".$latlong[1].") ) 
							              + sin( radians(".$latlong[0].") ) 
							              * sin( radians( ".$lat." ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
		}
		return $in_area;
	}
	
	function logPosisi(){
		$dataArray = array (
				'pic' => 'Samuel' 
		);
		
		$param ['id_user'] = $this->input->post ( 'nik' );
		$param ['lat'] = $this->input->post ( 'lat' );
		$param ['long'] = $this->input->post ( 'long' );
		$param ['id_tipe_aktifitas'] = $this->input->post ( 'id_tipe_aktifitas' );
		$check_require = $this->m_api->requireValidation ( $param );
		if ($check_require ['status'] == true) {

			if ($this->checkPosition($this->input->post ( 'lat' ),$this->input->post ( 'long' ))) {
				$request_param = array();
				$waktu_log = date('Y-m-d H:i:s');
				$insert_to_log = array("id_user" => $param ['id_user'],
									   "waktu_log" => $waktu_log,
									   "id_tipe_aktifitas" => $param ['id_tipe_aktifitas'],
									   "lat" => $param ['lat'],
									   "long" => $param ['long']);
				$exe_insert = $this->db->insert("log_posisi",$insert_to_log);
				$id_insert = $this->db->insert_id();
				$update = $this->db->query("update log_posisi set latlong = POINT('".$param['lat']."','".$param ['long']."'), hari_log = DAYNAME(waktu_log) where id_log_presensi = '".$id_insert."';");
				
				$dataArray ['results'] = array (
						'status' => 'OK' ,
						'msg'	  => 'Berhasil Log'
				);				
			}else{
				$dataArray ['results'] = array (
						'status' => 'Not_ok' ,
						'msg'	  => 'Anda tidak berada di lokasi'
				);
			}

			$this->m_api->sendOutput ( $dataArray, 200 );
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 );
		}
	}
	
	
	
}