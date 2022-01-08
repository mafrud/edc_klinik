<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	date_default_timezone_set('Asia/Jakarta');
	class M_notifikasi extends CI_Model
	{
		function perubahan_kode_golongan($id_perusahaan){
			$this->db->SELECT('	mp.NAMA,
								p.NODAFTAR,
								p.NORM,
								p.KETERANGAN,
								p.STATUS_PERUBAHAN,
								p.KODE_PERUBAHAN,
								p.TGL_PERUBAHAN,
								p.JAM_PERUBAHAN');
			$this->db->FROM('ts_pendaftaran p');
			$this->db->JOIN('ms_pasien mp', 'p.NORM=mp.NORM');
			$this->db->WHERE('p.STATUS_PERUBAHAN=1');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			return $this->db->get();
		}
		function get_total_semua_notif($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('COUNT(p.ID_NO_ANTRI) total_semua_antrian');
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.STATUS_NO_ANTRIAN', 2);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.PANGGIL', 0);
			return $this->db->get()->result();
		}
		function get_jum_notif_umum($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('COUNT(p.ID_NO_ANTRI) total_antrian_umum');
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.STATUS_NO_ANTRIAN', 2);
			$this->db->WHERE('p.KODE_GOLONGAN', 1);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.PANGGIL', 0);
			return $this->db->get()->result();
		}
		function get_jum_notif_bpjs($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('COUNT(p.ID_NO_ANTRI) total_antrian_bpjs');
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.STATUS_NO_ANTRIAN', 2);
			$this->db->WHERE('p.KODE_GOLONGAN', 2);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.PANGGIL', 0);
			return $this->db->get()->result();
		}
		function get_data_antrian_awal($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT(	'MIN(p.NO_ANTRIAN) no_antri, 
								MIN(p.ID_NO_ANTRI) id_antrian, 
								p.NAMA_PENDAFTAR nm_pasien, 
								p.NIK nik_pasien,
								p.ALAMAT alamat_p,
								p.ID_PERUSAHAAN,
								p.NORM,
								p.NO_RUJUKAN,
								p.GOLONGAN_PASIEN,
								p.JK,
								p.TGL_LAHIR,
								p.TEMPAT_LAHIR,
								p.PEKERJAAN,
								p.PROV,
								p.KAB,
								p.KEC,
								p.DESA,
								p.TOKEN_VOUCHER,
								p.NO_TELP'
						);
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.KODE_GOLONGAN', 1);
			$this->db->WHERE('p.STATUS_NO_ANTRIAN', 2);
			$this->db->WHERE('p.PANGGIL=', 0);
			$this->db->group_by('p.ID_NO_ANTRI');
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function get_data_antrian_awal_bpjs($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('MIN(p.NO_ANTRIAN) no_antri, 
								MIN(p.ID_NO_ANTRI) id_antrian, 
								p.NAMA_PENDAFTAR nm_pasien, 
								p.NIK nik_pasien,
								p.ALAMAT alamat_p,
								p.ID_PERUSAHAAN,
								p.NORM,
								p.NO_RUJUKAN,
								p.GOLONGAN_PASIEN,
								p.JK,
								p.TGL_LAHIR,
								p.TEMPAT_LAHIR,
								p.PEKERJAAN,
								p.PROV,
								p.KAB,
								p.KEC,
								p.DESA,
								p.TOKEN_VOUCHER,
								p.NO_TELP'
						);
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.KODE_GOLONGAN', 2);
			$this->db->WHERE('p.STATUS_NO_ANTRIAN', 2);
			$this->db->WHERE('p.PANGGIL=', 0);
			$this->db->group_by('p.ID_NO_ANTRI');
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function get_data_lengkap_antrian($id_antrian, $no_antri){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri p');
			// $this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.NO_ANTRIAN', $no_antri);
			$this->db->WHERE('p.ID_NO_ANTRI', $id_antrian);
			return $this->db->get()->result();
		}
		function get_data_ruang_periksa($id_perusahaan){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.STATUS_POSISI_PASIEN', 1);
			return $this->db->get()->result();
		}
		function get_data_antrian($id_no_antrian){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri p');
			// $this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			// $this->db->WHERE('p.NO_ANTRIAN', $no_antri);
			$this->db->WHERE('p.ID_NO_ANTRI', $id_no_antrian);
			return $this->db->get()->result();	
		}
		function get_data_pasien_lama($norm, $nik){
			
		}
		function update_notifikasi($table, $field_tabel, $data, $id){
			$this->db->WHERE($field_tabel, $id);
			$update = $this->db->update($table, $data);
			if ($update==TRUE) {
				return "Benar";
			}else{
				return "Salah";
			}	
		}
	}
?>