<?php
	class M_antrian extends CI_Model
	{
		function get_data_cabang_outlet(){
			$this->db->SELECT('ID_PERUSAHAAN code_perusahaan, NAMA_PERUSAHAAN nm_cabang, PELAYANAN_BPJS kode_pelayanan');
			$this->db->FROM('ms_perusahaan');
			$this->db->WHERE('STATUS_PELAYANAN', 1);
			return $this->db->get()->result();
		}
		function get_nip_pegawai($id_pegawai, $id_perusahaan){
			$get_nip 		= "SELECT NIP_PEGAWAI, ID_ROLE FROM ms_pegawai WHERE NIP_PEGAWAI='$id_pegawai' AND ID_PERUSAHAAN='$id_perusahaan'";
			$get_data_nip 	= $this->db->query($get_nip)->result();
			return $get_data_nip;
		}
		function waktunya_pemanggilan_pasien($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('MIN(p.NO_ANTRIAN) no_antri, 
							MIN(p.ID_NO_ANTRI) id_antrian, 
							p.NAMA_PENDAFTAR nm_pasien, 
							p.NIK nik_pasien,
							p.ALAMAT alamat_p'
						);
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.KODE_GOLONGAN', 1);
			$this->db->WHERE('p.PANGGIL', 1);
			$this->db->group_by('p.ID_NO_ANTRI');
			$this->db->order_by('p.ID_NO_ANTRI', 'DESC');
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function waktunya_pemanggilan_pasien_bpjs($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('MIN(p.NO_ANTRIAN) no_antri, 
							MIN(p.ID_NO_ANTRI) id_antrian, 
							p.NAMA_PENDAFTAR nm_pasien, 
							p.NIK nik_pasien,
							p.ALAMAT alamat_p'
						);
			$this->db->FROM('ts_pendaftaran_no_antri p');
			$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('p.TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('p.KODE_GOLONGAN', 2);
			$this->db->WHERE('p.PANGGIL', 1);
			$this->db->group_by('p.ID_NO_ANTRI');
			$this->db->order_by('p.ID_NO_ANTRI', 'DESC');
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function get_dokter($id_perusahaan){
			$q_dokter = "SELECT
								ms_tarif_dokter.ID_DOKTER,
								ms_tarif_dokter.ID_TARIF,
								ms_dokter.NAMA_DOKTER
								-- ms_tarif_dokter.`STATUS`
								FROM 
								ms_tarif_dokter 
								JOIN ms_dokter 
								ON ms_tarif_dokter.ID_DOKTER=ms_dokter.ID_DOKTER 
								WHERE ID_PERUSAHAAN='$id_perusahaan' AND ms_tarif_dokter.STATUS='1'";
			$get_dokter = $this->db->query($q_dokter)->result();
			return $get_dokter;
		}
		function cari_pasian_lama($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$this->db->SELECT('*');
			$this->db->FROM('ms_pasien');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->LIKE('NORM', $nomor_rm);
			$this->db->LIKE('NIK', $nik);
			$this->db->LIKE('NAMA', $nama_pasien_lama);
			$this->db->LIKE('ALAMAT', $alamat_pasien_lama);
			$this->db->LIKE('TANGGAL_LAHIR', $tgl_lahir_lama);
			// $this->db->OR_WHERE('NIK', $nik);
			return $this->db->get()->result();
		}
		function cari_data_pasien_lama_norm($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					AND p.NORM LIKE '%$nomor_rm%'
					");
			return $this->db->query($sql)->result();
		}
		function cari_data_pasien_lama_norm_dos($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$sql = (" SELECT * FROM 
					data_backup_pasien_dos p 
					-- WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					WHERE p.ID_PERUSAHAAN='MJG' 
					AND p.no_pasien LIKE '%$nomor_rm%'
					");
			return $this->db->query($sql)->result();
		}
		function cari_pasien_lama2($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					AND p.NORM LIKE '%$nomor_rm%' 
					-- AND p.NAMA LIKE '%$nama_pasien_lama%' 
					-- AND p.ALAMAT LIKE '%$alamat_pasien_lama%' 
					-- AND p.TANGGAL_LAHIR LIKE '%$tgl_lahir_lama%'
					AND p.NIK LIKE '%$nik%' 
					");
			return $this->db->query($sql)->result();
		}
		function cari_pasien_lama3($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					-- AND p.NORM LIKE '%$nomor_rm%' 
					AND p.NAMA LIKE '%$nama_pasien_lama%' 
					AND p.ALAMAT LIKE '%$alamat_pasien_lama%' 
					AND p.TANGGAL_LAHIR LIKE '%$tgl_lahir_lama%'
					-- OR p.NIK LIKE '%$nik%' 
					");
			return $this->db->query($sql)->result();
		}
		function get_datakunjungan_humas($id_perusahaan, $nomor_rm, $nik, $nama_pasien_lama, $tgl_lahir_lama, $alamat_pasien_lama){
			$sql = "SELECT
					p.ID_KUNJUNGAN_PASIEN,
					p.ID_KEGIATAN_BAKSOS,
					p.NIK,
					p.NAMA_PASIEN,
					p.KASUS,
					p.GOLONGAN_PASIEN,
					p.ALAMAT_PASIEN,
					p.TUJUAN_KUNJUNGAN,
					p.TGL_INPUT,
					p.TGL_KUNJUNGAN,
					p.TGL_EXPIRED_VAOUCHER,
					p.JK,
					p.STATUS_KEHADIRAN,
					p.POSISI_PESERTA,
					p.TGL_PASIEN_BERKUNJUNG,
					p.UPDATE_TGL_EXPIRED,
					p.NIP_PEGAWAI,
					p.ID_PERUSAHAAN,
					p.TANGGAL_LAHIR,
					TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE()) AS selisih_hari
					FROM humas_kunjungan_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan'
					AND p.STATUS_KEHADIRAN=1 
					AND p.POSISI_PESERTA!=0 
					AND TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE())<=30
					-- AND p.NAMA_PASIEN LIKE '%$nama_pasien_lama%' 
					-- AND p.ALAMAT_PASIEN LIKE '%alamat_pasien_lama%'
					-- AND p.TANGGAL_LAHIR LIKE '%$tgl_lahir_lama%'
					AND p.NIK LIKE '%$nik%' ";
					return $this->db->query($sql)->result();
		}
		function get_datakunjungan_humas2(){
			$this->db->SELECT('	p.ID_KUNJUNGAN_PASIEN,
								p.ID_KEGIATAN_BAKSOS,
								p.NIK,
								p.NAMA_PASIEN,
								p.KASUS,
								p.GOLONGAN_PASIEN,
								p.ALAMAT_PASIEN,
								p.TUJUAN_KUNJUNGAN,
								p.TGL_INPUT,
								p.TGL_KUNJUNGAN,
								p.TGL_EXPIRED_VAOUCHER,
								p.JK,
								p.STATUS_KEHADIRAN,
								p.POSISI_PESERTA,
								p.TGL_PASIEN_BERKUNJUNG,
								p.UPDATE_TGL_EXPIRED,
								p.NIP_PEGAWAI,
								p.ID_PERUSAHAAN,
								p.TANGGAL_LAHIR,
								TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE()) AS selisih_hari', FALSE);
			$this->db->FROM('humas_kunjungan_pasien p');
			$this->db->WHERE('p.STATUS_KEHADIRAN', 1);
			$this->db->WHERE('p.POSISI_PESERTA!=', 0);
			$this->db->WHERE('TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE())<=30', FALSE);
			return $this->db->get()->result();
		}
		function cari_pasien_lama_webumum($id_perusahaan, $nomor_rm, $nik){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					AND p.NORM LIKE '%$nomor_rm%' 
					-- AND p.NIK LIKE '%$nik%' 
					");
			return $this->db->query($sql)->result();
		}
		function get_datakunjungan_humas_webumum($id_perusahaan, $nomor_rm, $nik){
			$sql = "SELECT
					p.ID_KUNJUNGAN_PASIEN,
					p.ID_KEGIATAN_BAKSOS,
					p.NIK,
					p.NAMA_PASIEN,
					p.KASUS,
					p.GOLONGAN_PASIEN,
					p.ALAMAT_PASIEN,
					p.TUJUAN_KUNJUNGAN,
					p.TGL_INPUT,
					p.TGL_KUNJUNGAN,
					p.TGL_EXPIRED_VAOUCHER,
					p.JK,
					p.STATUS_KEHADIRAN,
					p.POSISI_PESERTA,
					p.TGL_PASIEN_BERKUNJUNG,
					p.UPDATE_TGL_EXPIRED,
					p.NIP_PEGAWAI,
					p.ID_PERUSAHAAN,
					p.TANGGAL_LAHIR,
					TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE()) AS selisih_hari
					FROM humas_kunjungan_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan'
					AND p.STATUS_KEHADIRAN=1 
					AND p.POSISI_PESERTA!=0 
					AND TIMESTAMPDIFF(DAY, p.TGL_KUNJUNGAN, CURDATE())<=30
					-- AND p.NIK LIKE '%$nik%' ";
					return $this->db->query($sql)->result();
		}
		function cari_data_pasien_lama_norm_webumum($id_perusahaan, $nomor_rm, $nik){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					AND p.NORM='$nomor_rm'
					");
			return $this->db->query($sql)->result();
		}
		function cari_pasien_lama2_webumum($id_perusahaan, $nomor_rm, $nik){
			$sql = (" SELECT * FROM 
					ms_pasien p 
					WHERE p.ID_PERUSAHAAN='$id_perusahaan' 
					-- AND p.NORM LIKE '%$nomor_rm%'
					AND p.NIK LIKE '%$nik%' 
					");
			return $this->db->query($sql)->result();
		}
		function get_noantrian_terakhir($id_perusahaan, $tgl_kunjungan_pasien, $kode_golongan){
			$this->db->select_max('NO_ANTRIAN');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_kunjungan_pasien);
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('KODE_GOLONGAN', $kode_golongan);
			$this->db->WHERE('STATUS_NO_ANTRIAN', 2);
			return $this->db->get()->result();
		}
		function get_data_validasi($nik_pasien_baru, $id_outlet){
			$this->db->select('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			// $this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_kunjungan_pasien);
			$this->db->WHERE('NIK', $nik_pasien_baru);
			$this->db->WHERE('ID_PERUSAHAAN', $id_outlet);
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function get_data_hasil_validasi($ID_NO_ANTRI){
			$this->db->select('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('ID_NO_ANTRI', $ID_NO_ANTRI);
			// $this->db->WHERE('ID_PERUSAHAAN', $id_outlet);
			$this->db->limit(1);
			return $this->db->get()->result();
		}
		function get_pendaftaran_sama($nik_pasen_lama, $id_perusahaan, $tgl_kunjungan_pasien){
			$this->db->select('NO_ANTRIAN');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_kunjungan_pasien);
			$this->db->WHERE('NIK', $nik_pasen_lama);
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			return $this->db->get()->result();
		}
		function list_antrian_hari_ini($id_perusahaan, $tgl_sekarang){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_sekarang);
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('STATUS_NO_ANTRIAN', 2);
			$this->db->ORDER_BY('NO_ANTRIAN', 'ASC');
			return $this->db->get()->result();
		}
		function get_antrian_pasien($id_antrian_pasien, $id_perusahaan){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('ID_NO_ANTRI', $id_antrian_pasien);
			return $this->db->get()->result();
		}
		function cari_pasien_sama($id_perusahaan, $nik_pasien_baru, $nama_pasien_baru, $alamat_pasien_baru){
			$this->db->SELECT('*');
			$this->db->FROM('ms_pasien');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->LIKE('NIK', $nik_pasien_baru);
			$this->db->LIKE('NAMA', $nama_pasien_baru);
			$this->db->LIKE('ALAMAT', $alamat_pasien_baru);
			return $this->db->get()->result();
		}
		function get_daftar_antrian_sama($id_perusahaan, $nik_pasien_baru, $nama_pasien_baru, $tgl_kunjungan_pasien_baru, $tgl_sekarang, $tgl_kunjungan_pasien_baru, $mac_adress){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('TGL_INPUT_PENDAFTARAN', $tgl_sekarang);
			$this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_kunjungan_pasien_baru);
			// $this->db->WHERE('MAC_ADRESS', $mac_adress);
			$this->db->LIKE('NIK', $nik_pasien_baru);
			// $this->db->LIKE('NAMA', $nama_pasien_baru);
			// $this->db->LIKE('ALAMAT', $alamat_pasien_baru);
			return $this->db->get()->result();
		}
		function cari_data_antrian_sama($id_perusahaan, $nik_pasien_baru, $tgl_kunjungan_pasien_baru, $token_voucher){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->LIKE('NIK', $nik_pasien_baru);
			$this->db->LIKE('TOKEN_VOUCHER', $token_voucher);
			// $this->db->LIKE('NAMA_PENDAFTAR', $nama_pasien_baru);
			$this->db->WHERE('TGL_REQUEST_DAFTAR', $tgl_kunjungan_pasien_baru);
			return $this->db->get()->result();
		}
		function get_norm_terakhir($id_perusahaan){
			$get 		= "SELECT MAX(CONVERT(SUBSTRING(NORM,4),SIGNED)) AS norm FROM ms_pasien WHERE NORM LIKE '%$id_perusahaan%'";
			$get_norm 	= $this->db->query($get)->result();
			return $get_norm;
		}
		function get_nodaftar_terakhir($id_perusahaan){
			$get 		= "SELECT MAX(CONVERT(SUBSTRING(NODAFTAR,4),SIGNED)) AS nodaftar FROM ts_pendaftaran WHERE NODAFTAR LIKE '%$id_perusahaan%'";
			$get_nd 	= $this->db->query($get)->result();
			return $get_nd;
		}
		function get_detail_antrian_cetak(){
			$this->db->SELECT('*');
			$this->db->FROM('ts_pendaftaran_no_antri');
			$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
			$this->db->WHERE('ID_NO_ANTRI', $id_antrian_pasien);
			return $this->db->get()->result();	
		}
		function simpan_data($nm_tabel, $data){
			$simpan = $this->db->insert($nm_tabel, $data);
			if ($simpan==TRUE) {
				return "Benar";
			}else{
				return "Salah";
			}
		}
		function update_data($tabel, $data, $field, $id){
			$this->db->where($field, $id);
			$update = $this->db->update($tabel, $data);
			if ($update==TRUE) {
				return "Benar";
			}else{
				return "Salah";
			}
		}
	}
?>