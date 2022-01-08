<?php
/**
 * 
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_api_sep extends CI_Model
{
	
	function det_outlet($id_perusahaan){
		$this->db->SELECT('NAMA_PERUSAHAAN nm_perusahaan,
						  TOKEN_BPJS no_token,
						  SECRETKEY nokey,
						  KODE_PELAYANAN kd_pelayanan');
		$this->db->FROM('ms_perusahaan');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('TOKEN_BPJS!=', "");
		return $this->db->get();
	}
	function get_nip_pegawai($id_pegawai, $id_perusahaan){
		$this->db->SELECT('ID_USER, NIP_PEGAWAI, ID_ROLE');
		$this->db->FROM('ms_user');
		$this->db->WHERE('NIP_PEGAWAI', $id_pegawai);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_pasien_hari_ini($id_perusahaan, $tanggal_sekarang){
		$this->db->SELECT(	'p.ID_RUJUKAN id,
							p.TANGGAL_INPUT tgl_daftar,
							p.mr_noMR norm,
							p.NODAFTAR no_pendaftaran,
							p.nama nm_pasien,
							p.sex jk,
							p.noKunjungan no_rujuk,
							p.noKartu no_kpst,
							p.STATUS status');
		$this->db->FROM('rujukan_masuk p');
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('p.TANGGAL_INPUT', $tanggal_sekarang);
		$this->db->WHERE('p.STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_last_norm($id_perusahaan){
		$this->db->SELECT('MAX(CONVERT(SUBSTRING(NORM,4),SIGNED)) AS norm', FALSE);
		$this->db->FROM('ms_pasien');
		$this->db->LIKE('NORM', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_last_nodaftar($id_perusahaan){
		$this->db->SELECT('MAX(CONVERT(SUBSTRING(NODAFTAR,4),SIGNED)) AS nodaftar', FALSE);
		$this->db->FROM('ts_pendaftaran');
		$this->db->LIKE('NODAFTAR', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_data_bpjs($id_perusahaan, $tgl_sekarang){
		$this->db->SELECT('tp.NODAFTAR, p.NORM, p.NAMA');
		$this->db->FROM('ts_pendaftaran tp');
		$this->db->JOIN('ms_pasien p', 'tp.NORM=p.NORM');
		$this->db->WHERE('tp.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('tp.TGL_DAFTAR', $tgl_sekarang);
		$this->db->WHERE('tp.KODE_GOLONGAN', 'BPJS');
		return $this->db->get()->result();
	}
	function get_data_pasien_nodaftar($id_perusahaan, $nodaftar){
		$this->db->SELECT('*');
		$this->db->FROM('ts_pendaftaran tp');
		$this->db->WHERE('tp.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tp.KODE_GOLONGAN', 'BPJS');
		return $this->db->get()->result();
	}
	function cari_data_nokunjungan_sama($rujukan_noKunjungan_ambil, $id_perusahaan){
		$this->db->SELECT('noKunjungan, nama, mr_noMR, NODAFTAR');
		$this->db->FROM('rujukan_masuk');
		$this->db->WHERE('noKunjungan', $rujukan_noKunjungan_ambil);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_data_norm_sama($norm, $id_perusahaan){
		$this->db->SELECT('*');
		$this->db->FROM('ms_pasien');
		$this->db->WHERE('NORM', $norm);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		// $this->db->WHERE('STATUS!=', 0);
		return $this->db->get()->result();	
	}
	function get_norm_sama($rujukan_peserta_nik_ambil, $rujukan_peserta_mr_noMR_ambil, $rujukan_peserta_nama_ambil, $alamat, $tempat_lahir,$kecamatan, $desa, $id_perusahaan){
		$this->db->SELECT('NORM, NAMA, NIK, ALAMAT, TEMPAT_LAHIR, DESA, ID_PERUSAHAAN');
		$this->db->FROM('ms_pasien');
		$this->db->LIKE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('TANGGAL_LAHIR', '');
		$this->db->LIKE('NAMA', $rujukan_peserta_nama_ambil);
		$this->db->LIKE('NIK', $rujukan_peserta_nik_ambil);
		$this->db->LIKE('ALAMAT', '');
		$this->db->LIKE('TEMPAT_LAHIR', '');
		// $this->db->LIKE('KEC', 'tes');
		$this->db->LIKE('DESA', $desa);
		return $this->db->get()->result();
	}
	function get_norm_pasien($nama, $nik, $jenis_kelamin, $tgl_lahir, $nokartu, $id_perusahaan){
		$this->db->SELECT('NORM norm, NAMA nm_pasien, NIK nik_pas, ALAMAT alm_pas, TEMPAT_LAHIR tmp_pas, PEKERJAAN pekerjaan, ID_PERUSAHAAN outlet, PROVINSI prov, KAB kabp, KEC kect, DESA ds');
		$this->db->FROM('ms_pasien');
		$this->db->LIKE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('NAMA', $nama);
		$this->db->LIKE('NIK', $nik);
		$this->db->LIKE('JK', $jenis_kelamin);
		$this->db->LIKE('TANGGAL_LAHIR', $tgl_lahir);
		$this->db->LIKE('NOKPST', $nokartu);
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	function get_data_insert_rujukan_keluar($nodaftar){
		$this->db->SELECT('*');
		$this->db->FROM('insert_rujukan_keluar');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		return $this->db->get()->result();
	}
	function get_data_sep_pasien($nodaftar, $norm){
		$this->db->SELECT('*');
		$this->db->FROM('respon_insert_sep');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$this->db->WHERE('STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_data_cetak_sep_pasien($noSep){
		$this->db->SELECT('*');
		$this->db->FROM('respon_insert_sep');
		$this->db->WHERE('noSep', $noSep);
		return $this->db->get()->result();
	}
	function get_data_rujukan_lama_by_sep($nodaftar){
		$this->db->SELECT('asalFaskes, noKunjungan, noKartu, nama, poliRujukan_nama, provPerujuk_nama, asalFaskes, tglKunjungan');
		$this->db->FROM('rujukan_masuk');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		return $this->db->get()->result();
	}
	function get_pasien_nodaftar(){
		
	}
	function get_rujukan_masuk($id){
		$this->db->WHERE('ID_RUJUKAN', $id);
		$this->db->WHERE('STATUS!=', 0);
		return $this->db->get('rujukan_masuk')->result();
	}
	function get_data_response_insert($noRujukan, $id_perusahaan){
		$this->db->SELECT('*');
		$this->db->FROM('respon_insert_rujukan');
		$this->db->WHERE('noRujukan', $noRujukan);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	// function get_data_respon_rujukan($nodaftar, $id_perusahaan){
	// 	$this->db->SELECT('ID_RESPON_INSERT_RUJUKAN, noRujukan');
	// 	$this->db->FROM('respon_insert_rujukan');
	// 	$this->db->WHERE('NODAFTAR', $nodaftar);
	// 	$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
	// 	return $this->db->get()->result();		
	// }
	function data_respon_insert_sep($nodaftar, $id_perusahaan){
		$this->db->SELECT('ID_RESPON_SEP, catatan, diagnosa, jnsPelayanan, kelasRawat, noSep, penjamin, asuransi, hakKelas, jnsPeserta, kelamin, nama, noKartu, noMr, tglLahir, Dinsos, prolanisPRB, noSKTM, poli, poliEksekutif, tglSep');
		$this->db->FROM('respon_insert_sep');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIMIT(1);
		return $this->db->get()->result();
	}
	function data_insert_sep($nodaftar, $id_perusahaan){
		$this->db->SELECT('*');
		$this->db->FROM('insert_sep');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIMIT(1);
		return $this->db->get()->result();
	}
	function get_data_insert_sep($noka_peserta){
		$this->db->SELECT('*');
		$this->db->FROM('insert_sep');
		$this->db->WHERE('noKartu', $noka_peserta);
		// $this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->ORDER_BY('ID_INSERT_SEP', 'DESC');
		$this->db->LIMIT(1);
		return $this->db->get()->result();
	}
	function get_data_sep($id_rujukan){
		$this->db->SELECT('*');
		$this->db->FROM('respon_insert_sep');
		$this->db->WHERE('ID_INSERT_SEP', $id_rujukan);
		// $this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->ORDER_BY('ID_INSERT_SEP', 'DESC');
		$this->db->LIMIT(1);
		return $this->db->get()->result();
	}
	function simpan_data($table, $data){
		$simpan = $this->db->insert($table, $data);
		if ($simpan==TRUE) {
			return 'Benar';
		}else{
			return 'Salah';
		}
	}
	function update_data($table, $data, $field_table, $id){
		$this->db->WHERE($field_table, $id);
		$update = $this->db->UPDATE($table, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	// function simpan_resep_obat($table, $data){
	// 	$simpan = $this->db->insert($table, $data);
	// 	if ($simpan==TRUE) {
	// 		return "Benar";
	// 	}else{
	// 		return "Salah";
	// 	}	
	// }
	
}
?>