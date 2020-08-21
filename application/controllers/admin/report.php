<?php

use Aws\Common\Enum\Time;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $data['id'] = $id;
        $data['siswa'] = $this->db->where('nis', $id)->get('siswa')->row();
        if (empty($data['siswa'])) {
            echo "Siswa tidak ditemukan";
        } else {
            $this->load->view('member/report/index', $data);
        }
    }

    public function getData()
    {
        $post = $this->input->post();
        $id = $post['id'];
        $datalog = $this->db->where('nis', $id)->where('year(tanggal)', $post['tahun'])->where('month(tanggal)', $post['bulan'])->get('log_jadwal')->result();
        $datajadwal = $this->db->get('jadwal')->result();
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $post['bulan'], $post['tahun']);
        foreach ($datajadwal as $value) {
            $hari = $this->nama_hari($value->hari);
            $jadwal[$hari]['jam_mulai'] = $value->jam_mulai;
            $jadwal[$hari]['jam_selesai'] = $value->jam_selesai;
            $jadwal[$hari]['aktifitas'] = $value->aktifitas;
        }
        for ($i = 1; $i <= $tanggal; $i++) {
            $day = $this->nama_hari(date('l', strtotime($post['tahun'] . '-' . $post['bulan'] . '-' . $i)));
            if (!empty($jadwal[$day])) {
                $data[$i] = [
                    "hari" => $day,
                    "tanggal" => $post['tahun'] . '-' . $post['bulan'] . '-' . $i,
                    "jam_mulai" => $jadwal[$day]['jam_mulai'],
                    "jam_selesai" => $jadwal[$day]['jam_selesai'],
                    "aktifitas" => $jadwal[$day]['aktifitas'],
                ];
            } else {
                $data[$i] = [
                    "hari" => $day,
                    "tanggal" => $post['tahun'] . '-' . $post['bulan'] . '-' . $i,
                    "jam_mulai" => "-",
                    "jam_selesai" => "-",
                    "aktifitas" => "-",
                ];
            }
            $data[$i]['absen_mulai'] = "-";
            $data[$i]['absen_selesai'] = "-";
            $data[$i]['telat'] = "-";
            foreach ($datalog as $values) {
                if (strtotime($values->tanggal) == strtotime($post['tahun'] . '-' . $post['bulan'] . '-' . $i)) {
                    $data[$i]['absen_mulai'] = $values->jam_mulai;
                    $data[$i]['absen_selesai'] = $values->jam_selesai;
                    $data[$i]['telat'] = "-";
                    if (!empty($jadwal[$day])) {
                        $diff  = date_diff(new Datetime($jadwal[$day]['jam_mulai']), new Datetime($values->jam_mulai));
                        $data[$i]['telat'] = $diff->h . ' jam ' . $diff->i . ' menit';
                    }
                }
            }
        }
        $json_data = $data;
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($json_data);
        die();
    }

    public function nama_hari($hari)
    {
        switch ($hari) {
            case 'Sunday':
                $hari_ini = "Minggu";
                break;

            case 'Monday':
                $hari_ini = "Senin";
                break;

            case 'Tuesday':
                $hari_ini = "Selasa";
                break;

            case 'Wednesday':
                $hari_ini = "Rabu";
                break;

            case 'Thursday':
                $hari_ini = "Kamis";
                break;

            case 'Friday':
                $hari_ini = "Jumat";
                break;

            case 'Saturday':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }
        return $hari_ini;
    }
}
