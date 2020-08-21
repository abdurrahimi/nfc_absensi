<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Service extends CI_Controller
{
	private $signature;
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array(
			'url',
			'form',
			'language'
		));
		$this->load->model('m_umum');
		$this->load->model('m_api');
		$this->load->model('m_login');
	}
	function index()
	{
		header("location: " . base_url());
		die();
	}


	function login()
	{
		$dataArray = array(
			'pic' => 'Samuel'
		);
		$param['username'] = $this->input->post('username');
		$param['password'] = $this->input->post('password');
		$check_require = $this->m_api->requireValidation($param);
		if ($check_require['status'] == true) {
			$checkLogin = false;
			$checkLogin = $this->m_login->checkLogin($param['username'], $param['password']);
			if ($checkLogin) {
				$dataArray['results'] = array(
					'success' => 'OK',
					'msg'	 => 'Berhasil Login',
					'profile' => $this->session->userdata('loginData'),
				);
				$this->m_api->sendOutput($dataArray, 200);
			} else {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Salah password',
					'profile' => []
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
		} else {
			$this->m_api->sendOutput($dataArray, 402);
		}
	}

	function updateNFC()
	{
		$dataArray = array(
			'pic' => 'Samuel'
		);
		$param['nis'] = $this->input->post('nis');
		$param['nfc'] = $this->input->post('nfc');
		$check_require = $this->m_api->requireValidation($param);
		if ($check_require['status'] == true) {
			$validasi = $this->db->where('nfc', $param['nfc'])->get('siswa')->row();
			if (empty($validasi)) {
				$checkLogin = $this->db->update("siswa", ["nfc" => $param['nfc']], ["nis" => $param['nis']]);
				if ($checkLogin) {
					$dataArray['results'] = array(
						'success' => 'OK',
						'msg'	  => 'Berhasil Mengubah Data NFC'
					);
					$this->m_api->sendOutput($dataArray, 200);
				} else {
					$dataArray['results'] = array(
						'success' => 'NOT_OK',
						'msg'	  => 'Gagal Mengubah Data NFC'
					);
					$this->m_api->sendOutput($dataArray, 200);
				}
			} else {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Kartu sudah digunakan'
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
		} else {
			$this->m_api->sendOutput($dataArray, 402);
		}
	}

	function list_siswa()
	{
		$dataArray = array(
			'pic' => 'Samuel'
		);
		$check_require['status'] = true;
		if ($check_require['status'] == true) {
			$listData = $this->db->get('siswa')->result();
			if (!empty($listData)) {
				$dataArray['results'] = array(
					'success' => 'OK',
					'msg'	  => 'Berhasil Mengambil Data',
					'data'	  => $listData,
					'url'	  => base_url()
				);
				$this->m_api->sendOutput($dataArray, 200);
			} else {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Data kosong',
					'data'	  => []
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
		} else {
			$this->m_api->sendOutput($dataArray, 402);
		}
	}

	function list_jadwal()
	{
		$dataArray = array(
			'pic' => 'Samuel'
		);
		$check_require['status'] = true;
		if ($check_require['status'] == true) {
			$listData = $this->db->where('hari', date('l'))->get('jadwal')->result();
			if (!empty($listData)) {
				$dataArray['results'] = array(
					'success' => 'OK',
					'msg'	  => 'Berhasil Mengambil Data',
					'data'	  => $listData
				);
				$this->m_api->sendOutput($dataArray, 200);
			} else {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Data kosong',
					'data'	  => []
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
		} else {
			$this->m_api->sendOutput($dataArray, 402);
		}
	}

	function absensi()
	{
		$dataArray = array(
			'pic' => 'Absensi'
		);
		$param = [
			"tag" 			=> $this->input->post('nfc'),
			"lat" 			=> $this->input->post('lat'),
			"lng" 			=> $this->input->post('lng'),
			"id_jadwal" 	=> $this->input->post('id_jadwal'),
		];
		$check_require = $this->m_api->requireValidation($param);
		if ($check_require['status'] == true) {
			$checkLokasi = $this->checkPosition($param['lat'], $param['lng']);
			if (!$checkLokasi) {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Anda tidak berada pada area absensi'
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
			$absen = $this->db->where('nfc', $param['tag'])->get('siswa')->row_array();
			if (!empty($absen)) {
				$log = $this->simpan_log($param['id_jadwal'], $absen['nis']);
				if ($log['status']) {
					$dataArray['results'] = array(
						'success' => 'OK',
						'msg'		=> $log['msg'],
						'profile' => $absen
					);
				} else {
					$dataArray['results'] = array(
						'success' => 'NOT_OK',
						'msg'		=> $log['msg'],
						'profile' => []
					);
				}

				$this->m_api->sendOutput($dataArray, 200);
			} else {
				$dataArray['results'] = array(
					'success' => 'NOT_OK',
					'msg'	  => 'Data NFC Anda Tidak ditemukan'
				);
				$this->m_api->sendOutput($dataArray, 200);
			}
		} else {
			$this->m_api->sendOutput($dataArray, 402);
		}
	}

	public function simpan_log($id_jadwal, $nis)
	{
		$check = $this->db->where('tanggal', date('Y-m-d'))->where('nis', $nis)->get('log_jadwal')->row();
		if (!empty($check->jam_selesai)) {
			return ["status" => false, "msg" => "Sudah melakukan absen"];
		}
		if (!empty($check)) {
			$data = [
				"id_jadwal" =>  $id_jadwal,
				"jam_selesai" => date('H:i:s'),
			];
			$this->db->where('id_log_absensi', $check->id_log_absensi)->update('log_jadwal', $data);
			return ["status" => true, "msg" => "Berhasil melakukan absen pulang"];
		} else {
			$data = [
				"id_jadwal" =>  $id_jadwal,
				"jam_mulai" => date('H:i:s'),
				"tanggal"	=> date('Y-m-d'),
				"nis"		=> $nis
			];
			$this->db->insert('log_jadwal', $data);
			return ["status" => true, "msg" => "Berhasil melakukan absen masuk"];
		}
	}

	function checkPosition($lat, $long)
	{
		$in_area = false;
		//$checkAreaUser = $this->db->query('select * from siswa where nik = "' . $this->input->post('nik') . '"')->row();
		$dataArea = $this->db->query('select * from area')->result();
		foreach ($dataArea as $key => $value) {
			if (!empty($value->latlong_a)) {
				$latlong = explode(", ", $value->latlong_a);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(" . $latlong[0] . ") ) 
							              * cos( radians( " . $lat . " ) ) 
							              * cos( radians( " . $long . " ) - radians(" . $latlong[1] . ") ) 
							              + sin( radians(" . $latlong[0] . ") ) 
							              * sin( radians( " . $lat . " ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_b)) {
				$latlong = explode(", ", $value->latlong_b);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(" . $latlong[0] . ") ) 
							              * cos( radians( " . $lat . " ) ) 
							              * cos( radians( " . $long . " ) - radians(" . $latlong[1] . ") ) 
							              + sin( radians(" . $latlong[0] . ") ) 
							              * sin( radians( " . $lat . " ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_c)) {
				$latlong = explode(", ", $value->latlong_c);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(" . $latlong[0] . ") ) 
							              * cos( radians( " . $lat . " ) ) 
							              * cos( radians( " . $long . " ) - radians(" . $latlong[1] . ") ) 
							              + sin( radians(" . $latlong[0] . ") ) 
							              * sin( radians( " . $lat . " ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
			if (!empty($value->latlong_d)) {
				$latlong = explode(", ", $value->latlong_d);
				$check = $this->db->query("SELECT (6371 * acos( 
							                cos( radians(" . $latlong[0] . ") ) 
							              * cos( radians( " . $lat . " ) ) 
							              * cos( radians( " . $long . " ) - radians(" . $latlong[1] . ") ) 
							              + sin( radians(" . $latlong[0] . ") ) 
							              * sin( radians( " . $lat . " ) )
							                ) ) as distance")->row();
				if (floatval($check->distance) < 0.5) {
					$in_area = true;
				}
			}
		}
		return $in_area;
	}
}
