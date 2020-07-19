<?php
class m_api extends CI_Model {
	private $signature_valid;
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		//var_dump($_POST); exit;
		$this->checking_signature ( $_POST ['signature'] );
	} 
	
	function loginGuest($kode, $param = array()) {
		$this->db->where ( "kode", $kode );
		$this->db->where ( "password", md5 ( $param ['password'] ) );
		$query = $this->db->get ( "runner" );
		if ($query->num_rows () == 1) {
			$data = $query->result_array ();
			$this->db->flush_cache ();
			$exe = array (
					'kode' => $data [0] ['kode'],
					'nama' => $data [0] ['nama']
			);
		} 
		return $exe;
	}
	
	function loginMhs($kode, $param = array()) {
		$this->db->where ( "username", $kode );
		$this->db->where ( "password", md5 ( $param ['password'] ) );
		$query = $this->db->get ( "mhs" );
		if ($query->num_rows () == 1) {
			$data = $query->result_array ();
			$this->db->flush_cache ();
			$exe = array (
					'mhs_id' => $data [0] ['mhs_id'],
					'mhs_name' => $data [0] ['mhs_name'],
					'kelas_id' => $data [0] ['kelas_id']
			);
		} 
		return $exe;
	}
	
	function loginDosen($kode, $param = array()) {
		$this->db->where ( "username", $kode );
		$this->db->where ( "password", md5 ( $param ['password'] ) );
		$query = $this->db->get ( "dosen" );
		if ($query->num_rows () == 1) {
			$data = $query->result_array ();
			$this->db->flush_cache ();
			$exe = array (
					'dosen_id' => $data [0] ['dosen_id'],
					'dosen_name' => $data [0] ['dosen_name']
			);
		} 
		return $exe;
	}
	
	function listJadwal($param){
		$newparam = array();
		if(isset($param['hari'])){
			
		$newparam['hari'] =  $param['hari'];
		
		}
		$newparam['id_kelas'] = $param['id_kelas'];
		$newparam['id_semester'] = $param['id_semester'];
		$newparam['id_akademik'] = $param['id_akademik'];
		
		$sqlwhere = "";
		foreach($newparam as $key => $value){
			if($sqlwhere!=""){
				$sqlwhere.=" AND ";
			}
			$sqlwhere.=" ".$key." = '".$value."'";
		}
		
		$sql = "SELECT
					MYJ.*, K.kelas,
					K.id_prodi,
					P.prodi,
					P.id_jurusan,
					J.jurusan,
					S.semester,
					AK.akademik,
					MYR.ruangan,
					MYR.lantai,
					MYR.latlong_a,
					MYR.latlong_b,
					MYR.latlong_c,
					MYR.latlong_d,
					MP.mata_kuliah,
					MP.bobot,
					D.nama_dosen,
					D.no_hp,
					D.id_jabatan,
					JB.jabatan
				FROM
					`jadwal` MYJ
				JOIN kelas K ON MYJ.id_kelas = K.kode
				JOIN prodi P ON K.id_prodi = P.kode
				JOIN jurusan J ON P.id_jurusan = J.kode
				JOIN semester S ON MYJ.id_semester = S.kode
				JOIN akademik AK ON MYJ.id_akademik = AK.kode
				JOIN ruangan MYR ON MYJ.id_ruangan = MYR.kode
				JOIN mata_kuliah MP ON MYJ.id_mk = MP.kode
				JOIN dosen D ON MYJ.id_dosen = D.nip
				JOIN jabatan JB ON D.id_jabatan = JB.kode WHERE ".$sqlwhere;
		
		
		
		$que = $this->db->query($sql)->result_array();
		return $que;
		
		
	}
	
	function listJadwalForDosen($param){
		$newparam = array();
		if(isset($param['hari'])){
			
		$newparam['hari'] =  $param['hari'];
		
		}
		$newparam['id_dosen'] = $param['id_dosen'];
		$newparam['id_semester'] = $param['id_semester'];
		// $newparam['id_akademik'] = $param['id_akademik'];
		
		$sqlwhere = "";
		foreach($newparam as $key => $value){
			if($sqlwhere!=""){
				$sqlwhere.=" AND ";
			}
			$sqlwhere.=" ".$key." = '".$value."'";
		}
		
		$sql = "SELECT
					MYJ.*, K.kelas,
					K.id_prodi,
					P.prodi,
					P.id_jurusan,
					J.jurusan,
					S.semester,
					AK.akademik,
					MYR.ruangan,
					MYR.lantai,
					MYR.latlong_a,
					MYR.latlong_b,
					MYR.latlong_c,
					MYR.latlong_d,
					MP.mata_kuliah,
					MP.bobot,
					D.nama_dosen,
					D.no_hp,
					D.id_jabatan,
					JB.jabatan
				FROM
					`jadwal` MYJ
				JOIN kelas K ON MYJ.id_kelas = K.kode
				JOIN prodi P ON K.id_prodi = P.kode
				JOIN jurusan J ON P.id_jurusan = J.kode
				JOIN semester S ON MYJ.id_semester = S.kode
				JOIN akademik AK ON MYJ.id_akademik = AK.kode
				JOIN ruangan MYR ON MYJ.id_ruangan = MYR.kode
				JOIN mata_kuliah MP ON MYJ.id_mk = MP.kode
				JOIN dosen D ON MYJ.id_dosen = D.nip
				JOIN jabatan JB ON D.id_jabatan = JB.kode WHERE ".$sqlwhere;
		
		
		
		$que = $this->db->query($sql)->result_array();
		return $que;
		
		
	}
	
	function get_hari_id(){
		$hari=date('l');
		$sql = "SELECT * FROM hari where nama_hari_inggris = '{$hari}'";
		// die($sql);
		$que = $this->db->query($sql)->result_array();
		return $que[0]['kode'];
	}
	
	function get_all_hari(){
		$sql = "SELECT * FROM hari";
		$que = $this->db->query($sql)->result_array();
		return $que;
		
	}
	
	function check_validation_absen($id_jadwal,$last_id){
		
		$data_jadwal = $this->detail_jadwal($id_jadwal);
		
		$sql_in_lat = "SELECT *, AsText(LatLong) FROM log_presensi 
						 WHERE LogPresensiID = '{$last_id}' AND Contains(
						 GeomFromText('POLYGON((".str_replace(","," ",$data_jadwal['latlong_a']).", ".str_replace(","," ",$data_jadwal['latlong_b']).", ".str_replace(","," ",$data_jadwal['latlong_c']).", ".str_replace(","," ",$data_jadwal['latlong_d']).", ".str_replace(","," ",$data_jadwal['latlong_a'])."))'), LatLong );";
		
		
		$exe_in_lat = $this->db->query($sql_in_lat)->result_array();
		if(count($exe_in_lat)>0){
			return true;
		}else{
			return false;
		}
	}
	
	function detail_jadwal($id_jadwal){
		$sql_jadwal = "SELECT * FROM jadwal J join ruangan K on J.id_ruangan = K.kode WHERE J.kode = '{$id_jadwal}'";
		$exe_jadwal = $this->db->query($sql_jadwal)->result_array();
		$data_jadwal = $exe_jadwal[0];
		return $data_jadwal;
	}
	
	function detail_siswa($nim){
		$sql_jadwal = "SELECT * FROM mahasiswa M WHERE M.nim = '{$nim}'";
		$exe_jadwal = $this->db->query($sql_jadwal)->result_array();
		$data_jadwal = $exe_jadwal[0];
		return $data_jadwal;
	}
	
	function copy_default($id_kelas,$id_jadwal){
		$sql = "SELECT * FROM mahasiswa WHERE id_kelas = '{$id_kelas}'";
		$que = $this->db->query($sql)->result_array();
		foreach($que as $value){
			$cari_dulu = "SELECT * FROM kehadiran where tanggal = '".date('Y-m-d')."' AND nim = '{$value['nim']}' AND id_jadwal = '{$id_jadwal}'";
			$que_cari_dulu = $this->db->query($cari_dulu)->result_array();
			if(count($que_cari_dulu)==0){
				$to_insert = array("tanggal" => date('Y-m-d'), 
								   "nim" => $value['nim'],
								   "id_jadwal" => $id_jadwal,
								   "jam_presensi" => date('Y-m-d H:i:s'),
								   "status" => 4,
								   "keterlambatan" => 0,
								   "created_at" =>  date('Y-m-d H:i:s'),
								   "update_at" => date('Y-m-d H:i:s')
								   );
				$this->db->insert('kehadiran',$to_insert);
			}	
		}
	}
	
	function insert_kehadiran($id_jadwal,$nim,$waktu_absen,$status_absen){
		$data_jadwal = $this->detail_jadwal($id_jadwal);
		$data_siswa  = $this->detail_siswa($nim);
		$tgl_skrg = date('Y-m-d');
		$batas_toleransi = date('Y-m-d H:i:s',strtotime($tgl_skrg.' '.$data_jadwal['jam_mulai'].' + '.$data_siswa['kompensasi'].' minutes'));
		$durasi_telat = "";
		$status="";
		
		$this->copy_default($data_siswa['id_kelas'],$id_jadwal);
		if($status_absen=="ok"){
			if($waktu_absen < $batas_toleransi){ //ga telat
			$durasi_telat = 0;
			$status = 1;
			}else{ //
				
				$durasi_telat = date("i",(strtotime($waktu_absen) - strtotime($tgl_skrg.' '.$data_jadwal['jam_mulai'].' + '.$data_siswa['kompensasi'].' minute')));
				
				$status = 2; 
			}
			$cari_dulu = "SELECT * FROM kehadiran where tanggal = '".date('Y-m-d')."' AND nim = '{$nim}' AND id_jadwal = '{$id_jadwal}'";
			$que_cari_dulu = $this->db->query($cari_dulu)->result_array();
			if(count($que_cari_dulu)==0){
				
				$to_insert = array("tanggal" => date('Y-m-d'),
								   "nim" => $nim,
								   "id_jadwal" => $id_jadwal,
								   "jam_presensi" => $waktu_absen,
								   "status" => $status,
								   "keterlambatan" => $durasi_telat,
								   "created_at" =>  date('Y-m-d H:i:s'),
								   "update_at" => date('Y-m-d H:i:s')
								   );
				$this->db->insert('kehadiran',$to_insert);
			}else{
				$to_insert = array("tanggal" => date('Y-m-d'),
								   "nim" => $nim,
								   "id_jadwal" => $id_jadwal,
								   "jam_presensi" => $waktu_absen,
								   "status" => $status,
								   "keterlambatan" => $durasi_telat,
								   "created_at" =>  date('Y-m-d H:i:s'),
								   "update_at" => date('Y-m-d H:i:s')
								   );
				$this->db->update('kehadiran',$to_insert,array("tanggal" =>date('Y-m-d'),"nim" => $nim,"id_jadwal" => $id_jadwal));
				
			}
		}else{
			$cari_dulu = "SELECT * FROM kehadiran where tanggal = '".date('Y-m-d')."' AND nim = '{$nim}' AND id_jadwal = '{$id_jadwal}'";
			$que_cari_dulu = $this->db->query($cari_dulu)->result_array();
			
			if(count($que_cari_dulu)==0){
				
				$to_insert = array("tanggal" => date('Y-m-d'), 
								   "nim" => $nim,
								   "id_jadwal" => $id_jadwal,
								   "jam_presensi" => $waktu_absen,
								   "status" => 4,
								   "keterlambatan" => 0,
								   "created_at" =>  date('Y-m-d H:i:s'),
								   "update_at" => date('Y-m-d H:i:s')
								   );
				$this->db->insert('kehadiran',$to_insert);
			}else{
				$to_insert = array("tanggal" => date('Y-m-d'),
								   "nim" => $nim,
								   "id_jadwal" => $id_jadwal,
								   "jam_presensi" => $waktu_absen,
								   "status" => 4,
								   "keterlambatan" => 0,
								   "created_at" =>  date('Y-m-d H:i:s'),
								   "update_at" => date('Y-m-d H:i:s')
								   );
				$this->db->update('kehadiran',$to_insert,array("tanggal" =>date('Y-m-d'),"nim" => $nim,"id_jadwal" => $id_jadwal));
				
			}
		}
		
		return true;
		
	}
	
	function sendOutput($dataArray, $status, $miss_param = array()) {
		$descriptionStatus = array ( 
				"200" => "OK",
				"400" => "Validation Error", // harusnya int dia kirim str
				"401" => "Auth Denied", // signature salah
				"402" => "Invalid Parameter", // kurang paramater post
				"403" => "User Access Token Expired",
				"501" => "Internal Server Error" 
		); 
		
		$defaultArray = array (
				'greeting' => 'Welcome',
				'pic' => 'Ayu Hartinah <ayu@kpptechnology.co.id>', 
				'server_time' => date ( 'd-m-Y H:i:s' ),
				'status' => $status,
				'status_desc' => $descriptionStatus [$status],
				'results' => array () 
		);
		
		$defaultArray = array_merge ( $defaultArray, $dataArray );
		$json = json_encode ( $defaultArray );
		$this->save_access_log ( $json, $status, $miss_param ); // saving access log
		header ( 'Access-Control-Allow-Origin: *' );
		header ( 'Access-Control-Expose-Headers: Access-Control-Allow-Origin' );
		header ( "HTTP/1.1 200 OK" );
		header ( 'Content-Type: application/json' );
		echo $json;
		die ();
	}
	
	/*
	 * Untuk memvalidasi parameter benar semuanya terkirim dan tidak null
	 * Untuk memvalidasi parameter benar semuanya terkirim dan tidak null
	 *
	 */
	function requireValidation($param) {
		// function utk check requirement wajib
		$invalid = 0;
		$invalid_param = array ();
		foreach ( $param as $key => $value ) {
			if ($value == "" || ! ($key) || $value == " ") {
				$invalid ++;
				$invalid_param [] = $key;
			}
		}
		
		$hasil = array (
				'invalid' => $invalid,
				'invalid_index' => $invalid_param,
				'status' => ($invalid > 0) ? false : true 
		);
		if (! $hasil ['status']) {
			$this->sendOutput ( array (
					'pic' => "Yulia. F <yulia@kpptechnology.co.id>" 
			), 402, $invalid_param );
		} else {
			return $hasil;
		}
	}
	function get_fb_email($key) {
		$url = 'https://graph.facebook.com/me?fields=email&access_token=' . $key;
		$get = file_get_contents ( $url );
		$export = json_decode ( $get, true );
		return $export ['email'];
	}
	function checking_signature($key) {
		$this->db->select ( "*" );
		$this->db->from ( "api_signature TSA" );
		$this->db->where ( 'SignatureKey', $key ); 
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$this->signature_valid = $key; 
			return true;
		} else {
			$this->sendOutput ( array (
					'pic' => "Ayu Hartinah <ayu@kpptechnology.co.id>" 
			), 401 );
		}
	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv ( 'HTTP_CLIENT_IP' ))
			$ipaddress = getenv ( 'HTTP_CLIENT_IP' );
		else if (getenv ( 'HTTP_X_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_X_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED' );
		else if (getenv ( 'HTTP_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED' );
		else if (getenv ( 'REMOTE_ADDR' ))
			$ipaddress = getenv ( 'REMOTE_ADDR' );
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function save_access_log($output, $status, $miss_param = array()) {
		$method_request = $this->uri->segment ( 3 ); // not use 
		$request_param = $this->input->post (); // will return the array ?  
		 
		$data_insert = array (
				"SignatureKey" => $this->input->post ( 'signature' ),
				"IpClient" => $this->get_client_ip (),
				"UserAccessToken" => $this->input->post ( 'user_access_token' ),
				"MethodRequest" => $this->uri->segment ( 3 ),
				"RequestParam" => json_encode ( $request_param ),
				"ResponseApi" => $output,
				"ResponseStatus" => $status,
				"CreatedDate" => date ( 'Y-m-d H:i:s' ),
				"MissedParam" => json_encode ( $miss_param ) 
		);
		$this->db->insert ( 'api_log', $data_insert );
		return true;
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen ( $characters );
		$randomString = '';
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, $charactersLength - 1 )];
		}
		return $randomString;
	}
	
	function getAllRoom($param = array()){
		
		$sql = "SELECT
					*,
				IF (
					(
						SELECT
							COUNT(id)
						FROM
							jadwal J
						WHERE
							J.id_ruangan = R.kode
						AND J.hari = '{$param['kode_hari']}'
						AND TIME(NOW()) >= J.jam_mulai
						AND J.jam_selesai >= TIME(NOW())
					) > 0,
					'ada',
					'kosong'
				) AS status_ruangan
				FROM
					ruangan R;";
		$grab = $this->db->query($sql)->result_array();
		return $grab;
	}
	
	function daftarKehadiran($param=array()){
		$sql = "SELECT * FROM kehadiran WHERE id_jadwal = '{$param['id_jadwal']}' and tanggal = '{$param['tanggal']}'";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	
}

?>