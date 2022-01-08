<?php
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
session_save_path('/var/lib/php/sessions');
// session_start();
date_default_timezone_set('Asia/Jakarta');

	class Notifikasi extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->helper('form');
	        $this->load->database();
	        $this->load->library('session');
	        $this->load->model('m_login');
	        $this->load->model('m_notifikasi');
	        $this->load->model('m_daftar');
	        $this->load->library('datatables');
	        $this->load->helper('konversi');
	        // $this->load->helper('html');
	        $session_status = $this->session->userdata('status_login');
	        if ($session_status!='Oke') {
	            redirect('login/cek_login');
	        }
	        $this->output->set_header( "Access-Control-Allow-Origin: *" );
	        $this->output->set_header( "Access-Control-Allow-Credentials: true" );
	        $this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
	        $this->output->set_header( "Access-Control-Max-Age: 604800" );
	        $this->output->set_header( "Access-Control-Request-Headers: x-requested-with" );
	        $this->output->set_header( "Access-Control-Allow-Headers: x-requested-with, x-requested-by" );
		}

		function notifikasi_pasien(){
			$id_perusahaan = $this->session->userdata('outlet');
			$perubahan_kode_golongan = $this->m_notifikasi->perubahan_kode_golongan($id_perusahaan);
			$data['jum_kd_gol'] 	= $perubahan_kode_golongan->num_rows();
			$data['list_kd_gol'] 	= $perubahan_kode_golongan->result();
			echo json_encode($data);
		}
		function update_perubahan_kd_gol(){
			$nodaftar 		= $this->input->post('nodaftar_kd_gol_perubahan');
			$norm 			= $this->input->post('norm_kd_gol_perubahan');
			$kd_golongan 	= $this->input->post('kd_gol_perubahan');
			if ($kd_golongan=='BPJS') {
				$batas_golongan = 2;
				$jenis_bayar 	= 'Piutang';
			}elseif ($kd_golongan=='MNC') {
				$batas_golongan = 1;
				$jenis_bayar 	= 'Piutang';
			}else{
				$batas_golongan = 1;
				$jenis_bayar 	= 'Bayar Cash';
			}
			$data_pendaftaran 	= array('KODE_GOLONGAN' => $kd_golongan, 'STATUS_PERUBAHAN' => 0);
			$data_pasien 		= array('KODE_GOLONGAN' => $kd_golongan, 'BATAS_GOLONGAN' => $batas_golongan);
			$data_pembayaran 	= array('JENIS_PEMBAYARAN' => $jenis_bayar);
			$update_pendaftaran = $this->m_notifikasi->update_notifikasi('ts_pendaftaran' ,'NODAFTAR', $data_pendaftaran, $nodaftar);
			$update_pembayaran	= $this->m_notifikasi->update_notifikasi('ts_pembayaran' ,'NODAFTAR', $data_pembayaran, $nodaftar);
			$update_biayaper	= $this->m_notifikasi->update_notifikasi('ts_biayaperawatan' ,'NODAFTAR', $data_pembayaran, $nodaftar);
			$update_pasien 		= $this->m_notifikasi->update_notifikasi('ms_pasien' ,'NORM', $data_pasien, $norm);
			echo json_encode($update_pasien);
		}
		function get_jum_antrian(){
			$id_perusahaan = $this->session->userdata('outlet');
			$tgl_sekarang  = date('Y-m-d');
			$jam_sekarang  = date("h:i:s");
			$total_semua_notif = $this->m_notifikasi->get_total_semua_notif($id_perusahaan, $tgl_sekarang);
			foreach ($total_semua_notif as $key) {
				$total_semua_antrian = $key->total_semua_antrian;
			}
			$data['jum_semua_antrian'] 	= $total_semua_antrian;
			$get_jum_notif_umum 		= $this->m_notifikasi->get_jum_notif_umum($id_perusahaan, $tgl_sekarang);
			foreach ($get_jum_notif_umum as $key) {
				$total_antrian_umum = $key->total_antrian_umum;
			}
			$data['total_antrian_umum'] 	= $total_antrian_umum;
			$get_jum_notif_bpjs 	= $this->m_notifikasi->get_jum_notif_bpjs($id_perusahaan, $tgl_sekarang);
			foreach ($get_jum_notif_bpjs as $key) {
				$total_antrian_bpjs = $key->total_antrian_bpjs;
			}
			$data['total_antrian_bpjs'] 	= $total_antrian_bpjs;
			echo json_encode($data);

		}
		function update_antrian_umum(){
			$id_perusahaan = $this->session->userdata('outlet');
			$tgl_sekarang  = date('Y-m-d');
			$jam_sekarang  = date("h:i:s");
			$get_data_antrian_awal = $this->m_notifikasi->get_data_antrian_awal($id_perusahaan, $tgl_sekarang);
			foreach ($get_data_antrian_awal as $key) {
				$id_antrian = $key->id_antrian;
				$no_antri 	= $key->no_antri;
				$nm_pasien 	= $key->nm_pasien;
				$nik_pasien = $key->nik_pasien;
				$alamat_p 	= $key->alamat_p;
			}
			$data_ruangan = $this->m_notifikasi->get_data_ruang_periksa($id_perusahaan);
			if (empty($data_ruangan)) {
				$data_pasien = array('PANGGIL' => 1, 'JAM_PANGGIL' => $jam_sekarang);
				$update_data_panggilan_pasien = $this->m_notifikasi->update_notifikasi('ts_pendaftaran_no_antri', 'ID_NO_ANTRI', $data_pasien, $id_antrian);
				$data['umum']  = array('no_antri' => $no_antri, 'nm_pasien' => $nm_pasien, 'nik_pasien' => $nik_pasien, 'alamat_p' => $alamat_p, 'id_antrian' => $id_antrian);
			}
			$data_u['data_ruang_periksa'] 	= $data_ruangan;
			$data_u['data_antrian_awal'] 	= $get_data_antrian_awal;

			// $lempar_data_ke_pendaftaran_pasien = $this->daftarkan_pasien_dari_noantri($id_antrian, $no_antri);
			echo json_encode($data_u);

		}
		function get_data_pasien_lama(){
			$id_perusahaan 	= $this->session->userdata('outlet');
			$norm 			= $this->input->post('norm_pasien_modal');
			$nik 			= $this->input->post('norm_pasien_modal');
			$get_data_pasien_lama = $this->m_notifikasi->get_data_pasien_lama($id_perusahaan, $norm, $nik);
		}
		function update_antrian_bpjs(){
			$id_perusahaan = $this->session->userdata('outlet');
			$tgl_sekarang  = date('Y-m-d');
			$jam_sekarang  = date("h:i:s");
			$get_data_antrian_awal_bpjs = $this->m_notifikasi->get_data_antrian_awal_bpjs($id_perusahaan, $tgl_sekarang);
			foreach ($get_data_antrian_awal_bpjs as $key) {
				$id_antrian2 	= $key->id_antrian;
				$no_antri2 		= $key->no_antri;
				$nm_pasien2 	= $key->nm_pasien;
				$nik_pasien2 	= $key->nik_pasien;
				$alamat_p2 		= $key->alamat_p;
			}
			$data_ruangan = $this->m_notifikasi->get_data_ruang_periksa($id_perusahaan);
			if (empty($data_ruangan)) {
				$data_pasien = array('PANGGIL' => 1, 'JAM_PANGGIL' => $jam_sekarang);
				$update_data_panggilan_pasien = $this->m_notifikasi->update_notifikasi('ts_pendaftaran_no_antri', 'ID_NO_ANTRI', $data_pasien, $id_antrian2);
				$data['bpjs'] = array('no_antri' => $no_antri2, 'nm_pasien' => $nm_pasien2, 'nik_pasien' => $nik_pasien2, 'alamat_p' => $alamat_p2, 'id_antrian' => $id_antrian2 );
			}
			$data_u['data_ruang_periksa'] 	= $data_ruangan;
			$data_u['data_antrian_awal'] 	= $get_data_antrian_awal_bpjs;
			echo json_encode($data_u);
		}
		function batal_daftar_pasien_berdasarkan_no_antri(){
			$id_antrian    	= $this->input->post('id_antrian');
			$no_antri    	= $this->input->post('no_antri');
			$data_pasien 	= array('PANGGIL' => 3, );
			$update_data_panggilan_pasien = $this->m_notifikasi->update_notifikasi('ts_pendaftaran_no_antri', 'ID_NO_ANTRI', $data_pasien, $id_antrian);
			echo json_encode($update_data_panggilan_pasien);
		}
		function panggil_ulang_pasien(){
			$idperusahaan_pasien_modal 	= $this->input->post('idperusahaan_pasien_modal');
			$idantrian_pasien_modal 	= $this->input->post('idantrian_pasien_modal');
			$noantrian_pasien_modal 	= $this->input->post('noantrian_pasien_modal');
			$norm_pasien_modal      	= $this->input->post('norm_pasien_modal');
			$nik_pasien_modal      		= $this->input->post('nik_pasien_modal');
			$nama_pasien_modal      	= $this->input->post('nama_pasien_modal');
			$jenis_kelamin_modal    	= $this->input->post('jenis_kelamin_modal');
			$tgl_lahir_modal      		= $this->input->post('tgl_lahir_modal');
			$tempat_lahir_modal     	= $this->input->post('tempat_lahir_modal');
			$pekerjaan_modal      		= $this->input->post('pekerjaan_modal');
			$provinsi_modal      		= $this->input->post('provinsi_modal');
			$kabupaten_modal      		= $this->input->post('kabupaten_modal');
			$kecamatan_modal      		= $this->input->post('kecamatan_modal');
			$desa_modal      			= $this->input->post('desa_modal');
			$alamat_pasien_modal   		= $this->input->post('alamat_pasien_modal');
			$tlpon_pasien_modal    		= $this->input->post('tlpon_pasien_modal');
			$golongan_pasien_modal 		= $this->input->post('golongan_pasien_modal');
			$token_voucher_modal   		= $this->input->post('token_voucher_modal');
			$no_rujukan_modal      		= $this->input->post('no_rujukan_modal');
			$no_rujukan_modal      		= $this->input->post('no_rujukan_modal');
			$tgl_sekarang  				= date('Y-m-d');
			$jam_sekarang  				= date("h:i:s");
			$cari_data_antrian 			= $this->m_notifikasi->get_data_antrian($idantrian_pasien_modal);
			foreach ($cari_data_antrian as $key) {
				$panggil = $key->PANGGIL;
			}
			$status_antrian 			= array('PANGGIL' => $panggil+1, 'JAM_PANGGIL' => $jam_sekarang);
			$update_data_panggilan_pasien = $this->m_notifikasi->update_notifikasi('ts_pendaftaran_no_antri', 'ID_NO_ANTRI', $status_antrian, $idantrian_pasien_modal);
		}
		function daftarkan_pasien_dari_noantri(){
			$idperusahaan_pasien_modal 	= $this->input->post('idperusahaan_pasien_modal');
			$idantrian_pasien_modal 	= $this->input->post('idantrian_pasien_modal');
			$noantrian_pasien_modal 	= $this->input->post('noantrian_pasien_modal');
			$norm_pasien_modal      	= $this->input->post('norm_pasien_modal');
			$nik_pasien_modal      		= $this->input->post('nik_pasien_modal');
			$nama_pasien_modal      	= $this->input->post('nama_pasien_modal');
			$jenis_kelamin_modal    	= $this->input->post('jenis_kelamin_modal');
			$tgl_lahir_modal      		= $this->input->post('tgl_lahir_modal');
			$tempat_lahir_modal     	= $this->input->post('tempat_lahir_modal');
			$pekerjaan_modal      		= $this->input->post('pekerjaan_modal');
			$provinsi_modal      		= $this->input->post('provinsi_modal');
			$kabupaten_modal      		= $this->input->post('kabupaten_modal');
			$kecamatan_modal      		= $this->input->post('kecamatan_modal');
			$desa_modal      			= $this->input->post('desa_modal');
			$alamat_pasien_modal   		= $this->input->post('alamat_pasien_modal');
			$tlpon_pasien_modal    		= $this->input->post('tlpon_pasien_modal');
			$golongan_pasien_modal 		= $this->input->post('golongan_pasien_modal');
			$token_voucher_modal   		= $this->input->post('token_voucher_modal');
			$no_rujukan_modal      		= $this->input->post('no_rujukan_modal');
			$no_rujukan_modal      		= $this->input->post('no_rujukan_modal');

			$id_pegawai    = $this->session->userdata('id_uname');
			$tgl_sekarang  = date('Y-m-d');
			$jam_sekarang  = date("h:i:s");
			$cari_data_kunjungan_sama = $this->m_daftar->cari_data_kunjungan_sama($idperusahaan_pasien_modal, $nama_pasien_modal, $nik_pasien_modal);
			if (!empty($cari_data_kunjungan_sama)) {
                foreach ($cari_data_kunjungan_sama as $key) {
                    $ID_KUNJUNGAN_PASIEN 	= $key->ID_KUNJUNGAN_PASIEN;
                    $NAMA_PASIEN 			= $key->NAMA_PASIEN;
                    // $NAMA_PASIEN = $key->NAMA_PASIEN;
                }
                $data_status_kunjungan      = array('STATUS_KEHADIRAN' => 2, 'TGL_PASIEN_BERKUNJUNG' => $tgl_sekarang);
                $update_status_kunjungan    = $this->m_daftar->update_resep_obat('humas_kunjungan_pasien', 'ID_KUNJUNGAN_PASIEN', $data_status_kunjungan, $ID_KUNJUNGAN_PASIEN);
            }
            $cari_pasien_sama = $this->m_daftar->cari_pasien_sama($idperusahaan_pasien_modal, $nama_pasien_modal, $tempat_lahir_modal, $tgl_lahir_modal, $pekerjaan_modal, $alamat_pasien_modal, $desa_lama_modal, $nik_pasien_modal);
            foreach ($cari_pasien_sama as $sm) {
                $norm_d = $sm->NORM;
            }
			if (empty($norm_pasien_modal)) {
				$get_norm = $this->m_daftar->get_norm_terakhir($idperusahaan_pasien_modal);
                foreach ($get_norm as $row) {
                    $data = $row->norm;
                    if (empty($data)) {
                        $norm_baru = $idperusahaan_pasien_modal."1";
                    }else{
                        $pot        = $data+1;
                        $norm_baru  = $idperusahaan_pasien_modal.$pot;
                    }
                }
                $data_simpan = array(
                                    'NORM'          => $norm_baru,
                                    'NIK'           => $nik_pasien_modal,
                                    'ID_PERUSAHAAN' => $idperusahaan_pasien_modal,
                                    'NAMA'          => $nama_pasien_modal,
                                    'ALAMAT'        => $alamat_pasien_modal,
                                    'TEMPAT_LAHIR'  => $tempat_lahir_modal,
                                    'TANGGAL_LAHIR' => $tgl_lahir_modal,
                                    'PROVINSI'      => $provinsi_modal,
                                    'KAB'           => $kabupaten_modal,
                                    'KEC'           => $kecamatan_modal,
                                    'DESA'          => $desa_modal,
                                    'JK'            => $jenis_kelamin_modal,
                                    'TELP'          => $tlpon_pasien_modal,
                                    // 'NOKPST'        => $no_kpst,
                                    'KODE_GOLONGAN' => $golongan_pasien_modal,
                                    'PEKERJAAN'     => $pekerjaan_modal,
                                    'TGL_INPUT'     => $tgl_sekarang,
                                   	 // 'BATAS_GOLONGAN'=> $tot_batas,
                                    // 'NORM_LAMA'     => $norm_lama
                                );
                $this->m_daftar->simpan_norm($data_simpan);
                $get_nodaftar = $this->m_daftar->get_nodaftar_terakhir($idperusahaan_pasien_modal);
                foreach ($get_nodaftar as $td) {
                    $d_nodaftar = $td->nodaftar;
                    if (empty($d_nodaftar)) {
                        $nodf_baru = $idperusahaan_pasien_modal."1";
                    }else{
                        $pot_df    = $d_nodaftar+1;
                        $nodf_baru = $idperusahaan_pasien_modal.$pot_df;
                    }
                }
                $baru_lama = "Baru";
                $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $idperusahaan_pasien_modal);
                foreach ($get_nip as $nip) {
                    $nip_p = $nip->NIP_PEGAWAI;
                }
                $data_pendaftaran = array(	'NODAFTAR'            	=> $nodf_baru, 
	                                        'ID_PERUSAHAAN'         => $idperusahaan_pasien_modal,
	                                        'NORM'                  => $norm_baru,
	                                        'NIP_PEGAWAI'           => $nip_p,
	                                        // 'ID_TARIF'              => $id_dokter,
	                                        'TGL_DAFTAR'            => $tgl_sekarang,
	                                        'BARU_LAMA'             => $baru_lama,
	                                        'KODE_GOLONGAN'         => $golongan_pasien_modal,
	                                        'STATUS_PENDAFTARAN'    => 1,
	                                        'STATUS_POSISI_PASIEN' 	=> 2,
	                                        'STATUS_OPERASI' 		=> 0,
	                                        // 'ID_RJ_SEMENTARA'       => $id_rj_sementara,
	                                        // 'TARIF_RJ_SEMENTARA'    => $tarif_rj_sementara
	                                    );
                $this->m_daftar->simpan_pendaftaran($data_pendaftaran);




			}else{
				$get_nodaftar = $this->m_daftar->get_nodaftar_terakhir($idperusahaan_pasien_modal);
                foreach ($get_nodaftar as $td) {
                    $d_nodaftar = $td->nodaftar;
                    if (empty($d_nodaftar)) {
                        $nodf_baru = $idperusahaan_pasien_modal."1";
                    }else{
                        $pot_df    = $d_nodaftar+1;
                        $nodf_baru = $idperusahaan_pasien_modal.$pot_df;
                    }
                }
                $baru_lama = "Lama";
                $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $idperusahaan_pasien_modal);
                foreach ($get_nip as $nip) {
                    $nip_p = $nip->NIP_PEGAWAI;
                }
                $data_pasien = array('KODE_GOLONGAN'    => $golongan_pasien_modal,
                                     // 'BATAS_GOLONGAN'   => $tot_batas,
                                     'NIK'              => $nik_pasien_modal,
                                     'PROVINSI'         => $provinsi_modal,
                                     'KAB'              => $kabupaten_modal,
                                     'KEC'              => $kecamatan_modal,
                                     'DESA'             => $desa_modal,
                                     'NAMA'             => $nama_pasien_modal,
                                     'ALAMAT'           => $alamat_pasien_modal,
                                     'TEMPAT_LAHIR'     => $tempat_lahir_modal,
                                     'TANGGAL_LAHIR'    => $tgl_lahir_modal,
                                 	 'TELP'          	=> $tlpon_pasien_modal,);
                $this->m_daftar->update_pasien($norm_pasien_modal, $data_pasien);
                $data_pendaftaran = array(  'NODAFTAR'              => $nodf_baru, 
                                            'ID_PERUSAHAAN'         => $idperusahaan_pasien_modal,
                                            'NORM'                  => $norm_pasien_modal,
                                            'NIP_PEGAWAI'           => $nip_p,
                                            // 'ID_TARIF'          	=> $id_dokter,
                                            'TGL_DAFTAR'            => $tgl_sekarang,
                                            'BARU_LAMA'             => $baru_lama,
                                            'KODE_GOLONGAN'         => $golongan_pasien_modal,
                                            'STATUS_PENDAFTARAN'    => 1,
                                            'STATUS_POSISI_PASIEN' 	=> 2,
                                            'STATUS_OPERASI' 		=> 0,
                                            // 'ID_RJ_SEMENTARA'       => $id_rj_sementara,
                                            // 'TARIF_RJ_SEMENTARA'    => $tarif_rj_sementara
                                        );
                $this->m_daftar->simpan_pendaftaran($data_pendaftaran);

			}
			$get_data_antrian 	= $this->m_notifikasi->get_data_antrian($idantrian_pasien_modal);
			foreach ($get_data_antrian as $key) {
				$JAM_PANGGIL = $key->JAM_PANGGIL;
			}
			if (empty($JAM_PANGGIL)) {
				$status_antrian 	= array('STATUS_NO_ANTRIAN' => 3, 'PANGGIL' => 1, 'JAM_PANGGIL' => $jam_sekarang);
			}else{
				$status_antrian 	= array('STATUS_NO_ANTRIAN' => 3);
			}
			$update_data_panggilan_pasien = $this->m_notifikasi->update_notifikasi('ts_pendaftaran_no_antri', 'ID_NO_ANTRI', $status_antrian, $idantrian_pasien_modal);
			// echo json_encode($update_data_panggilan_pasien);
	        echo json_encode($update_data_panggilan_pasien);
	    }
	}
?>