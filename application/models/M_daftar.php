<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_daftar extends CI_Model
{
	function get_data_dokter_aktif_ttd($id_perusahaan){
		$this->db->SELECT('ms_tarif_dokter.ID_DOKTER,
						ms_tarif_dokter.ID_TARIF,
						ms_dokter.NAMA_DOKTER,
						ms_tarif_dokter.STATUS,
						ms_tarif_dokter.TTD_DOKTER,
						ms_tarif_dokter.STATUS_CETAK');
		$this->db->FROM('ms_tarif_dokter');
		$this->db->JOIN('ms_dokter', 'ms_tarif_dokter.ID_DOKTER=ms_dokter.ID_DOKTER');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('ms_tarif_dokter.TTD_DOKTER',1);
		return $this->db->get()->result();
	}
	function update_status_ttd_cetak($data, $id){
		$this->db->WHERE('ID_TARIF', $id);
		$update = $this->db->UPDATE('ms_tarif_dokter', $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function get_semua_pasien($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening){
		$this->db->SELECT(	'p.NORM norm,
							p.NAMA nm_pas,
							p.NIK nik_pasien,
							p.JK jk,
							p.ALAMAT alamat,
							p.DESA desa,
							p.KEC kecamatan,
							p.KAB kabupaten,
							p.PROVINSI provinsi,
							p.TANGGAL_LAHIR tgl_lahir,
							p.PEKERJAAN pekerjaan,
							p.KODE_GOLONGAN kode_gol,
							p.NOKPST nokpst,
							p.TELP telp,
							p.TEMPAT_LAHIR temp_lahir,
							p.BATAS_GOLONGAN batas');
		$this->db->FROM('ms_pasien p');
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		// $this->db->LIKE('p.NIK', $nik_pasien_screening);
		$this->db->LIKE('p.NORM', $no_rm_pasien_lama);
		$this->db->LIKE('p.NAMA', $nama_pasien_lama);
		return $this->db->get()->result();
	}
	function get_semua_pasien2($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening){
		$this->db->SELECT(	'p.NORM norm,
							p.NAMA nm_pas,
							p.NIK nik_pasien,
							p.JK jk,
							p.ALAMAT alamat,
							p.DESA desa,
							p.KEC kecamatan,
							p.KAB kabupaten,
							p.PROVINSI provinsi,
							p.TANGGAL_LAHIR tgl_lahir,
							p.PEKERJAAN pekerjaan,
							p.KODE_GOLONGAN kode_gol,
							p.NOKPST nokpst,
							p.TELP telp,
							p.TEMPAT_LAHIR temp_lahir,
							p.BATAS_GOLONGAN batas');
		$this->db->FROM('ms_pasien p');
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('p.NIK', $nik_pasien_screening);
		// $this->db->LIKE('p.NORM', $no_rm_pasien_lama);
		$this->db->LIKE('p.NAMA', $nama_pasien_lama);
		return $this->db->get()->result();
	}
	function get_pasien_screening($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening){
		$this->db->SELECT(	'ID_KUNJUNGAN_PASIEN,
							NAMA_PASIEN,
							JK,
							ALAMAT_PASIEN,
							NIK,
							GOLONGAN_PASIEN');
		$this->db->FROM('humas_kunjungan_pasien ');
		$this->db->WHERE('STATUS_KEHADIRAN!=', 2);
		$this->db->WHERE('POSISI_PESERTA!=', 0);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('NIK', $nik_pasien_screening);
		$this->db->LIKE('NAMA_PASIEN', $nama_pasien_lama);
		return $this->db->get()->result();
	}
	function get_pasien_screening2($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening){
		$this->db->SELECT(	'ID_KUNJUNGAN_PASIEN,
							NAMA_PASIEN,
							JK,
							ALAMAT_PASIEN,
							NIK,
							GOLONGAN_PASIEN');
		$this->db->FROM('humas_kunjungan_pasien ');
		$this->db->WHERE('STATUS_KEHADIRAN!=', 2);
		$this->db->WHERE('POSISI_PESERTA!=', 0);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		// $this->db->LIKE('NIK', $nik_pasien_screening);
		$this->db->LIKE('NAMA_PASIEN', $nama_pasien_lama);
		return $this->db->get()->result();
	}
	function cari_data_kunjungan_sama($id_perusahaan, $nama_pasien, $nik_pasien){
		$this->db->SELECT(	'ID_KUNJUNGAN_PASIEN,
							NAMA_PASIEN,
							JK,
							ALAMAT_PASIEN,
							NIK,
							GOLONGAN_PASIEN');
		$this->db->FROM('humas_kunjungan_pasien ');
		$this->db->WHERE('STATUS_KEHADIRAN!=', 2);
		$this->db->WHERE('POSISI_PESERTA!=', 0);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('NIK', $nik_pasien);
		// $this->db->WHERE('NAMA_PASIEN', $nama_pasien);
		// nanti akan ada update untuk, jika tanggal hari ini melebihi tanggal expired, maka tidak di tampilkan, atau dianggap humas tidak mendapat fee
		return $this->db->get()->result();
	}
	function get_pasien_dos($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan){
		$this->db->SELECT(	'id_backup_dos,
							no_pasien,
							nm_pasien,
							tgl_lahir,
							j_kelamin,
							alamat,
							kota,
							tgl_daftar,
							phone');
		$this->db->FROM('data_backup_pasien_dos ');
		// $this->db->WHERE('STATUS!=', 1);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->LIKE('no_pasien', $no_rm_pasien_lama);
		$this->db->LIKE('nm_pasien', $nama_pasien_lama);
		return $this->db->get()->result();
	}
	function get_pendaftaran($nodaftar){
		$this->db->SELECT('p.TGL_DAFTAR,
							p.NORM,
							p.NODAFTAR,
							np.NAMA,
							p.NIP_PEGAWAI,
							np.JK,
							np.ALAMAT,
							np.KODE_GOLONGAN,
							np.TELP,
							p.ID_TARIF');
		$this->db->FROM('ts_pendaftaran p');
		$this->db->JOIN('ms_pasien np', 'p.NORM=np.NORM');
		$this->db->WHERE('p.NODAFTAR', $nodaftar);
		return $this->db->get()->result();
	}
	function get_pendaftaran_pasien_hari_ini($tgl_sekarang, $id_perusahaan, $nip_pegawai){
		$this->db->SELECT('p.TGL_DAFTAR,
							p.NORM,
							p.NODAFTAR,
							np.NAMA,
							np.NIK,
							np.JK,
							np.ALAMAT,
							p.KODE_GOLONGAN,
							np.TELP,
							p.ID_TARIF,
							np.PEKERJAAN,
							np.TEMPAT_LAHIR,
							np.TANGGAL_LAHIR,
							np.NOKPST,
							np.NORM_LAMA');
		$this->db->FROM('ts_pendaftaran p');
		$this->db->JOIN('ms_pasien np', 'p.NORM=np.NORM');
		$this->db->WHERE('p.TGL_DAFTAR', $tgl_sekarang);
		$this->db->WHERE('p.STATUS_PENDAFTARAN', 1);
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('NIP_PEGAWAI', $nip_pegawai);
		$this->db->order_by('p.NODAFTAR', 'DESC');
		return $this->db->get()->result();
	}
	function get_pendaftaran_pasien_hari_ini2($tgl_sekarang, $id_perusahaan){
		$this->db->SELECT('p.TGL_DAFTAR,
							p.NORM,
							p.NODAFTAR,
							np.NAMA,
							np.NIK,
							np.JK,
							np.ALAMAT,
							p.KODE_GOLONGAN,
							np.TELP,
							p.ID_TARIF,
							np.PEKERJAAN,
							np.TEMPAT_LAHIR,
							np.TANGGAL_LAHIR,
							np.NOKPST,
							np.NORM_LAMA');
		$this->db->FROM('ts_pendaftaran p');
		$this->db->JOIN('ms_pasien np', 'p.NORM=np.NORM');
		$this->db->WHERE('p.TGL_DAFTAR', $tgl_sekarang);
		$this->db->WHERE('p.STATUS_PENDAFTARAN', 1);
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		// $this->db->WHERE('NIP_PEGAWAI', $nip_pegawai);
		$this->db->order_by('p.NODAFTAR', 'DESC');
		return $this->db->get()->result();
	}
	function detail_pasien($norm, $id_perusahaan){
		$this->db->SELECT('	np.NAMA,
							np.JK,
							np.ALAMAT,
							np.TELP,
							np.NORM_LAMA');
		$this->db->FROM('ms_pasien np');
		$this->db->WHERE('np.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('np.NORM', $norm);
		return $this->db->get()->result();	
	}
	function get_data_riwayat($id_perusahaan, $nip_pegawai, $tanggal1, $tanggal2){
		$this->db->SELECT('p.TGL_DAFTAR,
							p.NORM,
							p.NODAFTAR,
							np.NAMA,
							np.JK,
							np.ALAMAT,
							p.KODE_GOLONGAN,
							np.TELP,
							p.ID_TARIF');
		$this->db->FROM('ts_pendaftaran p');
		$this->db->JOIN('ms_pasien np', 'p.NORM=np.NORM');
		$this->db->WHERE('p.STATUS_PENDAFTARAN!=', 0);
		$this->db->where('p.TGL_DAFTAR >=', $tanggal1);
		$this->db->where('p.TGL_DAFTAR <=', $tanggal2);
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->order_by('p.NODAFTAR', DESC);
		return $this->db->get()->result();	
	}
	function get_stok_obat($id_stok_retur){
		$this->db->SELECT('ID_STOK, STOK_READY');
		$this->db->FROM('ms_stok_obat');
		$this->db->WHERE('ID_STOK', $id_stok_retur);
		return $this->db->get()->result();
	}
	function get_penjualan_optik_hari_ini($nodaftar, $tgl_sekarang){
		$this->db->SELECT('po.ID_PENJUALAN_OPTIK id_optik,
						   po.ID_STOK_OPTIK id_stok,
						   po.KODE_OPTIK kd_obat,
						   po.KODE_STATUS kode_status,
						   po.NORM norm,
						   po.ID_PERUSAHAAN id_outlet,
						   po.NIP_PEGAWAI nip_peg,
						   po.QTY qty,
						   po.HARGA_SATUAN hrg_satuan,
						   po.TOTAL_HARGA tot_hrg,
						   po.TANGGAL_PENJUALAN tgl_jual,
						   po.NAMA_BARANG nm_obat,
						   po.NAMA_FRAME nm_frame,
						   po.NAMA_LENSA nm_lensa,
						   po.STATUS_BAYAR status_byr,
						   po.TANGGAL_BAYAR tgl_byr,
						   po.KETERANGAN keterangan,
						   po.PRINT
						   ');
		$this->db->FROM('ts_penjualan_optik po');
		$this->db->JOIN('ms_pasien mp', 'po.NORM=mp.NORM','LEFT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		// $this->db->WHERE('po.TANGGAL_PENJUALAN', $tgl_sekarang);
		$this->db->WHERE('po.STATUS_BARANG=', '');
		return $this->db->get()->result();			
	}
	function get_nama_obat(){
		$this->db->SELECT(	'KODE_OBAT kd_obat,
							NAMA_OBAT nm_obat');
		$this->db->FROM('ms_obat');
		return $this->db->get()->result();
	}
	function get_nama_optik($id_perusahaan){
		$this->db->SELECT('sop.ID_STOK_OPTIK, op.NAMA_MERK, op.KODE_MEREK, op.KODE_OPTIK, sop.HARGA_JUAL');
		$this->db->FROM('ms_optik op');
		$this->db->JOIN('ms_stok_optik sop', 'op.KODE_OPTIK=sop.KODE_OPTIK');
		$this->db->WHERE('sop.ID_PERUSAHAAN=', $id_perusahaan);
		$this->db->WHERE('sop.STATUS', 1);
		return $this->db->get()->result();
	}
	function get_id_stok($id_perusahaan, $nama_obat_stok){
		$this->db->SELECT('ID_STOK,
						  STOK_READY');
		$this->db->FROM('ms_stok_obat');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('KODE_OBAT', $nama_obat_stok);
		return $this->db->get()->result();
	}
	function get_id_stok_optik($id_perusahaan, $id_stok_optik){
		$this->db->SELECT('ID_STOK_OPTIK,
						  STOK_READY');
		$this->db->FROM('ms_stok_optik');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('KODE_OPTIK', $id_stok_optik);
		return $this->db->get()->result();
	}
	function get_penjualan_optik_sama($norm_optik, $id_stok_optik, $tanggal_pengeluaran_optik){
		$this->db->SELECT('ID_PENJUALAN_OPTIK,
						   NAMA_PEMBELI,
						   QTY,
						   HARGA_SATUAN,
						   TOTAL_HARGA,');
		$this->db->FROM('ts_penjualan_optik');
		$this->db->WHERE('NORM', $norm_optik);
		$this->db->WHERE('KODE_OPTIK', $id_stok_optik);
		$this->db->WHERE('TANGGAL_PENJUALAN', $tanggal_pengeluaran_optik);
		return $this->db->get()->result();					
	}
	function get_harga_barang($id_stok, $id_perusahaan){
		$this->db->SELECT('ID_STOK,HARGA_JUAL, HARGA_HET, TGL_EXPIRED');
		$this->db->FROM('ms_stok_obat');
		$this->db->WHERE('KODE_OBAT', $id_stok);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_harga_optik($id_stok, $id_perusahaan){
		$this->db->SELECT('ID_STOK_OPTIK, HARGA_JUAL');
		$this->db->FROM('ms_stok_optik');
		$this->db->WHERE('KODE_OPTIK', $id_stok);
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_penjualan_optik($id_optik){
		$this->db->SELECT('*');
		$this->db->FROM('ts_penjualan_optik');
		$this->db->WHERE('ID_PENJUALAN_OPTIK', $id_optik);
		return $this->db->get()->result();
	}
	function get_list_sewa_mobil($id_perusahaan){
		$this->db->SELECT('ID_TARIF_SEWA id_tarif_sewa,
						   NAMA_TUJUAN nm_list');
		$this->db->FROM('ms_tarif_sewa_ambulance');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	function get_harga_sewa($id_sewa){
		$this->db->SELECT('HARGA_TARIF hrg_tarif');
		$this->db->FROM('ms_tarif_sewa_ambulance');
		$this->db->WHERE('ID_TARIF_SEWA', $id_sewa);
		return $this->db->get()->result();		
	}
	function get_data_sewa($daftar){
		$this->db->SELECT('tsk.ID_SEWA id_sewa,
						  tsk.ID_TARIF_SEWA trf_sewa,
						  tsk.LOKASI_TUJUAN tujuan,
						  tsk.KODE_STATUS kd_status,
						  tsk.HARGA_SEWA hrg_sewa,
						  tsa.NAMA_TUJUAN nm_tujuan,
						  tsk.PRINT');
		$this->db->FROM('ts_sewa_kendaraan tsk');
		$this->db->JOIN('ms_tarif_sewa_ambulance tsa', 'tsk.ID_TARIF_SEWA=tsa.ID_TARIF_SEWA', 'LEFT');
		$this->db->WHERE('NODAFTAR', $daftar);
		return $this->db->get()->result();			
	}
	function get_data_optik($daftar){
		$this->db->SELECT('*');
		$this->db->FROM('ts_penjualan_optik po');
		$this->db->WHERE('po.NODAFTAR', $daftar);
		$this->db->WHERE('po.KODE_STATUS', 1);
		$this->db->WHERE('po.STATUS_BARANG=', '');
		return $this->db->get()->result();			
	}
	function get_tot_sewa($daftar){
		$this->db->SELECT('SUM(tsk.HARGA_SEWA) tot_sewa');
		$this->db->FROM('ts_sewa_kendaraan tsk');
		$this->db->WHERE('NODAFTAR', $daftar);
		return $this->db->get()->result();			
	}
	function get_tagihan_sewa($nodaftar){
		$this->db->SELECT('SUM(tsk.HARGA_SEWA) tot_tagihan_sewa');
		$this->db->FROM('ts_sewa_kendaraan tsk');
		$this->db->WHERE('tsk.NODAFTAR', $nodaftar);
		$this->db->WHERE('tsk.KODE_STATUS', 1);
		return $this->db->get()->result();				
	}
	function get_penjualan_obat($id_penjualan){
		$this->db->SELECT('ID_PENJUALAN, QTY, HARGA_JUAL, NODAFTAR, NORM, KODE_OBAT, ID_STOK');
		$this->db->FROM('ts_penjualan_obat');
		$this->db->WHERE('ID_PENJUALAN', $id_penjualan);
		return $this->db->get()->result();	
	}
	function riwayat_terapi_tindakan($nodaftar){
		$this->db->SELECT('tb.ID_PERAWATAN id_perawatan,
						   tb.NODAFTAR nodaftar,
						   tb.ID_TARIF id_tarif,
						   tb.NORM no_pasien,
						   tb.ID_TARIF_TINDAKAN id_tarif_tindakan,
						   tb.TARIF tarif,
						   tb.QTY_TINDAKAN qty,
						   tb.BIAYA biaya,
						   tb.DISKON diskon,
						   mt.NAMA_TINDAKAN nm_tindakan');
		$this->db->FROM('ts_biayaperawatan tb');
		$this->db->JOIN('ms_tarif_tindakan mtt', 'tb.ID_TARIF_TINDAKAN=mtt.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan mt', 'mtt.KODE_TINDAKAN=mt.KODE_TINDAKAN');
		$this->db->WHERE('tb.NODAFTAR', $nodaftar);
		$this->db->WHERE('tb.KODE_STATUS', 2);
		return $this->db->get()->result();
	}
	function riwayat_terapi_obat($nodaftar){
		$this->db->SELECT('tp.ID_PENJUALAN id_penjualan,
						   tp.NODAFTAR nodaftar,
						   tp.NORM no_pasien,
						   tp.KODE_OBAT kd_obat,
						   tp.ID_STOK id_stok,
						   tp.ID_TARIF id_tarif,
						   tp.HARGA_JUAL hrg_jual,
						   tp.QTY qty,
						   tp.BIAYA biaya,
						   tp.DISKON diskon,
						   mo.NAMA_OBAT nm_obat');
		$this->db->FROM('ts_penjualan_obat tp');
		$this->db->JOIN('ms_obat mo', 'tp.KODE_OBAT=mo.KODE_OBAT');
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tp.KODE_STATUS', 2);
		return $this->db->get()->result();
	}
	function riwayat_terapi_optik($nodaftar){
		$this->db->SELECT(' po.ID_PENJUALAN_OPTIK,
							po.NODAFTAR,
							po.NORM,
							po.HARGA_SATUAN,
							po.QTY,
							po.TOTAL_HARGA,
							po.NAMA_BARANG');
		$this->db->FROM('ts_penjualan_optik po');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.KODE_STATUS', 2);
		return $this->db->get()->result();
	}
	function riwayat_sewa($nodaftar){
		$this->db->SELECT('tsk.ID_SEWA id_sewa,
						  tsk.ID_TARIF_SEWA trf_sewa,
						  tsk.LOKASI_TUJUAN tujuan,
						  tsk.KODE_STATUS kd_status,
						  tsk.HARGA_SEWA hrg_sewa,
						  tsa.NAMA_TUJUAN nm_tujuan');
		$this->db->FROM('ts_sewa_kendaraan tsk');
		$this->db->JOIN('ms_tarif_sewa_ambulance tsa', 'tsk.ID_TARIF_SEWA=tsa.ID_TARIF_SEWA', 'LEFT');
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$this->db->WHERE('KODE_STATUS', 2);
		return $this->db->get()->result();
	}
	function get_pembatalan_obat($nodaftar){
		$this->db->SELECT('tp.ID_PENJUALAN id_penjualan,
						   tp.NODAFTAR nodaftar,
						   tp.NORM no_pasien,
						   tp.KODE_OBAT kd_obat,
						   tp.ID_STOK id_stok,
						   tp.ID_TARIF id_tarif,
						   tp.HARGA_JUAL hrg_jual,
						   tp.QTY qty,
						   tp.BIAYA biaya,
						   tp.DISKON diskon');
		$this->db->FROM('ts_penjualan_obat tp');
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		return $this->db->get();
	}
	function get_pembatalan_tindakan($nodaftar){
		$this->db->SELECT('tp.ID_PERAWATAN id_tindakan,
						   tp.NODAFTAR nodaftar,
						   tp.NORM no_pasien,
						   tp.ID_TARIF id_tarif,
						   mtt.KODE_TINDAKAN kd_tindakan,
						   tp.ID_TARIF_TINDAKAN id_tarif_tindakan,
						   tp.TARIF tarif,
						   tp.QTY_TINDAKAN qty_tindakan,
						   tp.BIAYA biaya,
						   tp.DISKON diskon');
		$this->db->FROM('ts_biayaperawatan tp');
		$this->db->JOIN('ms_tarif_tindakan mtt', 'mtt.ID_TARIF_TINDAKAN=tp.ID_TARIF_TINDAKAN');
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		return $this->db->get();
	}
	function get_bata_riwayat_tindakan($id, $nodaftar){
		$this->db->SELECT('tp.ID_PERAWATAN id_tindakan,
						   tp.NODAFTAR nodaftar,
						   tp.NORM no_pasien,
						   tp.ID_TARIF id_tarif,
						   mtt.KODE_TINDAKAN kd_tindakan,
						   tp.ID_TARIF_TINDAKAN id_tarif_tindakan,
						   tp.TARIF tarif,
						   tp.QTY_TINDAKAN qty_tindakan,
						   tp.BIAYA biaya,
						   tp.DISKON diskon');
		$this->db->FROM('ts_biayaperawatan tp');
		$this->db->JOIN('ms_tarif_tindakan mtt', 'mtt.ID_TARIF_TINDAKAN=tp.ID_TARIF_TINDAKAN');
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tp.ID_PERAWATAN', $id);
		return $this->db->get();
	}
	function get_karcis($outlet){
		$this->db->SELECT( 'ms_tarif_tindakan.ID_TARIF_TINDAKAN,
							ms_tindakan.KODE_TINDAKAN,
							ms_tarif_tindakan.ID_PERUSAHAAN,
							ms_tarif_tindakan.TARIF,
							ms_tindakan.NAMA_TINDAKAN,
							ms_tindakan.KODE_JENISTINDAKAN');
		$this->db->FROM('ms_tarif_tindakan');
		$this->db->JOIN('ms_tindakan', 'ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tarif_tindakan.ID_PERUSAHAAN', $outlet);
		$this->db->WHERE('ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tindakan.KODE_JENISTINDAKAN', 9);
		$this->db->NOT_LIKE('ms_tindakan.NAMA_TINDAKAN', 'PEMERIKSAAN');
		$this->db->WHERE('ms_tarif_tindakan.STATUS', 1);
		return $this->db->get()->result();
	}
	function get_karcis_pemeriksaan($outlet){
		$this->db->SELECT( 'ms_tarif_tindakan.ID_TARIF_TINDAKAN,
							ms_tindakan.KODE_TINDAKAN,
							ms_tarif_tindakan.ID_PERUSAHAAN,
							ms_tarif_tindakan.TARIF,
							ms_tindakan.NAMA_TINDAKAN,
							ms_tindakan.KODE_JENISTINDAKAN');
		$this->db->FROM('ms_tarif_tindakan');
		$this->db->JOIN('ms_tindakan', 'ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tarif_tindakan.ID_PERUSAHAAN', $outlet);
		$this->db->WHERE('ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tindakan.KODE_JENISTINDAKAN', 9);
		$this->db->LIKE('ms_tindakan.NAMA_TINDAKAN', 'PEMERIKSAAN');
		$this->db->WHERE('ms_tarif_tindakan.STATUS', 1);
		return $this->db->get()->result();
	}
	function get_terif_dokter_aktif($outlet, $id_dokter){
		$this->db->SELECT( 'ID_TARIF,
							ID_DOKTER,
							ID_PERUSAHAAN,
							JUMLAH_TARIF,
							TARIF_MATA');
		$this->db->FROM('ms_tarif_dokter');
		$this->db->WHERE('ID_TARIF', $id_dokter);
		$this->db->WHERE('ID_PERUSAHAAN', $outlet);
		$this->db->WHERE('STATUS', 1);
		return $this->db->get()->result();	
	}
	function get_karcis_urgen($id_perusahaan, $id_tindakan){
		$this->db->SELECT( 'ms_tarif_tindakan.ID_TARIF_TINDAKAN,
							ms_tindakan.KODE_TINDAKAN,
							ms_tarif_tindakan.ID_PERUSAHAAN,
							ms_tarif_tindakan.TARIF,
							ms_tindakan.NAMA_TINDAKAN,
							ms_tindakan.KODE_JENISTINDAKAN');
		$this->db->FROM('ms_tarif_tindakan');
		$this->db->JOIN('ms_tindakan', 'ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tarif_tindakan.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('ms_tarif_tindakan.ID_TARIF_TINDAKAN', $id_tindakan);
		$this->db->WHERE('ms_tarif_tindakan.KODE_TINDAKAN=ms_tindakan.KODE_TINDAKAN');
		$this->db->WHERE('ms_tindakan.KODE_JENISTINDAKAN', 9);
		return $this->db->get()->result();
	}
	function cari_pasien_sama($id_perusahaan, $nama_pasien, $tempat_lahir, $tgl_lahir, $pekerjaan, $alamat, $desa, $nik_pasien){
		$this->db->SELECT ('*');
		$this->db->FROM ('ms_pasien');
		$this->db->WHERE ('NAMA', $nama_pasien);
		$this->db->WHERE ('NIK', $nik_pasien);
		$this->db->WHERE ('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE ('TEMPAT_LAHIR', $tempat_lahir);
		$this->db->WHERE ('TANGGAL_LAHIR', $tgl_lahir);
		$this->db->WHERE ('PEKERJAAN', $pekerjaan);
		$this->db->WHERE ('ALAMAT', $alamat);
		$this->db->WHERE ('DESA', $desa);
		return $this->db->get()->result();
	}
	function get_nip_pegawai($id_pegawai, $id_perusahaan, $username){
		$get_nip 		= "SELECT NIP_PEGAWAI, ID_ROLE FROM ms_user WHERE NIP_PEGAWAI='$id_pegawai' AND ID_PERUSAHAAN='$id_perusahaan' AND UNAME='$username'";
		$get_data_nip 	= $this->db->query($get_nip)->result();
		return $get_data_nip;
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
	function get_validasi_norm($norm_pasien, $id_perusahaan){
		$get_v_norm = "SELECT NORM FROM ms_pasien WHERE NORM='$norm_pasien' AND ID_PERUSAHAAN='$id_perusahaan'";
		return $this->db->query($get_v_norm)->result();
	}
	function get_pendaftaran_norm_satukali($norm_pasien, $tanggal_hariini, $gol_pasien, $nip_p){
		$get_pendaftaran_norm = "SELECT NODAFTAR FROM ts_pendaftaran WHERE NORM='$norm_pasien' AND TGL_DAFTAR='$tanggal_hariini' AND STATUS_PENDAFTARAN='1' AND KODE_GOLONGAN='$gol_pasien' AND  NIP_PEGAWAI='$nip_p' ";
		return $this->db->query($get_pendaftaran_norm)->result();
	}
	function get_dokter($id_perusahaan){
		$q_dokter = "SELECT
							ms_tarif_dokter.ID_DOKTER,
							ms_tarif_dokter.ID_TARIF,
							ms_dokter.NAMA_DOKTER,
							ms_tarif_dokter.`STATUS`
							FROM 
							ms_tarif_dokter 
							JOIN ms_dokter 
							ON ms_tarif_dokter.ID_DOKTER=ms_dokter.ID_DOKTER 
							WHERE ID_PERUSAHAAN='$id_perusahaan' AND ms_tarif_dokter.STATUS='1'";
		$get_dokter = $this->db->query($q_dokter)->result();
		return $get_dokter;
	}
	function get_dokter_nodaftar($id_perusahaan, $nodaftar){
		$q_dokter = "SELECT
							mtd.ID_DOKTER,
							mtd.ID_TARIF,
							md.NAMA_DOKTER,
							mtd.`STATUS`
							FROM ts_pendaftaran as tp
							JOIN ms_tarif_dokter as mtd
							ON tp.ID_TARIF=mtd.ID_TARIF
							JOIN ms_dokter as md
							ON mtd.ID_DOKTER=md.ID_DOKTER 
							WHERE tp.ID_PERUSAHAAN='$id_perusahaan' 
							AND tp.NODAFTAR='$nodaftar'";
		$get_dokter = $this->db->query($q_dokter)->result();
		return $get_dokter;
	}
	function get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan){
		$this->db->SELECT('bp.ID_PERAWATAN,
						bp.NODAFTAR,
						tn.NAMA_TINDAKAN,
						bp.ID_TARIF_TINDAKAN,
						bp.KODE_STATUS,
						bp.BIAYA,
						bp.QTY_TINDAKAN,
						bp.PRINT');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan tr', 'bp.ID_TARIF_TINDAKAN=tr.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan tn', 'tr.KODE_TINDAKAN=tn.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tn.KODE_JENISTINDAKAN', 9);
		$this->db->WHERE('tr.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('bp.KODE_STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_jasmed_dokter($id_tarif, $id_perusahaan){
		$this->db->SELECT('mt.ID_TARIF_TINDAKAN,
						   mt.ERD,
						   mt.SPM_LAIN');
		$this->db->FROM('ms_tarif_tindakan mt');
		$this->db->WHERE('mt.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('mt.ID_TARIF_TINDAKAN', $id_tarif);
		return $this->db->get()->result();
	}
	function get_kode_dokter($id_dokter){
		$this->db->SELECT('mt.ID_DOKTER');
		$this->db->FROM('ms_tarif_dokter mt');
		$this->db->WHERE('mt.ID_TARIF', $id_dokter);
		return $this->db->get()->result();
	}
	function get_tindakan_perawatan_bynodaf($nodaftar, $id_perusahaan){
		$this->db->SELECT('bp.ID_PERAWATAN,
						bp.NODAFTAR,
						tn.NAMA_TINDAKAN,
						bp.ID_TARIF_TINDAKAN,
						bp.BIAYA,
						bp.QTY_TINDAKAN');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan tr', 'bp.ID_TARIF_TINDAKAN=tr.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan tn', 'tr.KODE_TINDAKAN=tn.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tn.KODE_JENISTINDAKAN!=', 9);
		$this->db->WHERE('tr.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('bp.KODE_STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_tarif_bayar_karcis($nodaftar,$tgl_sekarang){
		$get_biaya = "	SELECT 
						p.ID_PERAWATAN as id_p,
						p.KODE_STATUS as ks_status,
						p.BIAYA as tarif_dokter
						FROM ts_biayaperawatan as p 
						JOIN ms_tarif_tindakan AS mt 
						ON p.ID_TARIF_TINDAKAN=mt.ID_TARIF_TINDAKAN
						JOIN ms_tindakan AS t
						ON mt.KODE_TINDAKAN=t.KODE_TINDAKAN
						WHERE mt.KODE_TINDAKAN!=89
						AND mt.KODE_TINDAKAN!=20
						AND mt.KODE_TINDAKAN!=21
						AND mt.KODE_TINDAKAN!=91
						AND t.KODE_JENISTINDAKAN=9
						AND p.NODAFTAR='$nodaftar' 
						-- AND p.TGL_TINDAKAN='$tgl_sekarang'
						AND p.KODE_STATUS=1";
		return $this->db->query($get_biaya)->result();
	}
	function get_tarif_bayar_karcis2($nodaftar,$tgl_sekarang){
		$get_biaya = "	SELECT 
						SUM(p.BIAYA) tarif_admin
						FROM ts_biayaperawatan as p 
						JOIN ms_tarif_tindakan AS mt 
						ON p.ID_TARIF_TINDAKAN=mt.ID_TARIF_TINDAKAN
						JOIN ms_tindakan AS t
						ON mt.KODE_TINDAKAN=t.KODE_TINDAKAN
						WHERE mt.KODE_TINDAKAN!=19
						AND mt.KODE_TINDAKAN!=90
						AND mt.KODE_TINDAKAN!=96
						AND mt.KODE_TINDAKAN!=97
						AND t.KODE_JENISTINDAKAN=9
						AND p.NODAFTAR='$nodaftar' 
						-- AND p.TGL_TINDAKAN='$tgl_sekarang'
						AND p.KODE_STATUS=1";
		return $this->db->query($get_biaya)->result();
	}
	function get_nama_dokter_bayar_karcis($nodaftar,$tgl_sekarang){
		$q_dokter = "	SELECT
						d.NAMA_DOKTER AS nm_dokter,
						td.JUMLAH_TARIF,
						td.TARIF_MATA
						FROM ts_biayaperawatan AS bp
						JOIN ms_tarif_dokter AS td
						ON bp.ID_TARIF=td.ID_TARIF
						JOIN ms_dokter AS d
						ON td.ID_DOKTER=d.ID_DOKTER
						WHERE bp.NODAFTAR='$nodaftar'
						-- AND bp.TGL_TINDAKAN='$tgl_sekarang'
						LIMIT 1";
		return $this->db->query($q_dokter)->result();
	}
	function get_nama_dokter_karcis_urgen($dokter){
		$q_dokter = "	SELECT
						d.NAMA_DOKTER AS nm_dokter,
						td.JUMLAH_TARIF,
						td.TARIF_MATA
						FROM  ms_tarif_dokter AS td
						JOIN ms_dokter AS d
						ON td.ID_DOKTER=d.ID_DOKTER
						WHERE td.ID_TARIF = '$dokter'";
		return $this->db->query($q_dokter)->result();
	}
	function get_idbayar_max($id_perusahaan){
		$get_idbayar = "SELECT MAX(CONVERT(SUBSTRING(ID_PEMBAYARAN,4),SIGNED)) AS idbiaya FROM ts_pembayaran WHERE ID_PEMBAYARAN LIKE '%$id_perusahaan%'";
		return $this->db->query($get_idbayar)->result();
	}
	function get_obat_outlet($id_perusahaan){
		$get_obat = "SELECT so.ID_STOK AS id_o,
					o.NAMA_OBAT AS nm_o,
					so.HARGA_BELI AS hrg_b,
					so.HARGA_JUAL AS hrg_j,
					so.STOK_READY AS stk_r
					FROM ms_stok_obat AS so
					JOIN ms_obat AS o
					ON so.KODE_OBAT=o.KODE_OBAT
					WHERE so.ID_PERUSAHAAN='$id_perusahaan' AND so.`STATUS`='1' AND so.STOK_READY!=0";
		return $this->db->query($get_obat)->result();
	}
	function get_obat_resep($id_perusahaan){
		$get_obat = "SELECT so.ID_STOK AS id_o,
					o.NAMA_OBAT AS nm_o,
					so.HARGA_BELI AS hrg_b,
					so.HARGA_JUAL AS hrg_j,
					so.STOK_READY AS stk_r
					FROM ms_stok_obat AS so
					JOIN ms_obat AS o
					ON so.KODE_OBAT=o.KODE_OBAT
					WHERE so.ID_PERUSAHAAN='$id_perusahaan' AND so.STOK_READY!=0";
		return $this->db->query($get_obat)->result();
	}
	function get_resep_pasien($nodaftar){//nod 3 sebagai Kode Status, apabila obat tersebut tidak terdapat pengeluaran, melainkan hanya untuk resep saja
		$this->db->SELECT('	mo.NAMA_OBAT,
							tpo.ID_STOK,
							tpo.ID_PENJUALAN,
							tpo.TGL_JUAL,
							tpo.KETERANGAN,
							tpo.QTY,
							tpo.BIAYA,
							tpo.KODE_STATUS');
		$this->db->FROM('ts_penjualan_obat tpo');
		$this->db->JOIN('ms_obat mo', 'tpo.KODE_OBAT=mo.KODE_OBAT');
		$this->db->WHERE('tpo.NODAFTAR', $nodaftar);
		$this->db->WHERE('tpo.KODE_STATUS', 3);
		return $this->db->get()->result();
	}
	function get_id_penjualan($id_perusahaan){
		$get_data = "SELECT MAX(CONVERT(SUBSTRING(ID_PENJUALAN,4),SIGNED)) AS id_jual FROM ts_penjualan_obat WHERE ID_PENJUALAN LIKE '%$id_perusahaan%'";
		return $this->db->query($get_data)->result();
	}
	function get_kode_obat_yang_sama($id_obat, $tgl_sekarang, $nodaftar){
		$get_kobat = 	"SELECT
						o.ID_PENJUALAN AS id_jual,
		 				o.KODE_OBAT AS kode_o,
		 				o.ID_STOK as idstok,
		 				o.QTY as qty
						FROM ts_penjualan_obat AS o
						WHERE o.KODE_OBAT='$id_obat'
						AND o.TGL_JUAL='$tgl_sekarang'
						AND o.NODAFTAR='$nodaftar'
						AND o.KODE_STATUS='1'";
		return $this->db->query($get_kobat)->result();
	}
	function get_kode_obat($id_obat){
		$this->db->select('a.ID_STOK kod_obt, a.KODE_OBAT kode_o, a.HARGA_BELI hrg_beli, a.HARGA_JUAL hrg_jual, a.STOK_READY jum_stock, a.HARGA_HET hrg_het, a.TGL_EXPIRED tgl_expired');
		$this->db->from('ms_stok_obat a');
		$this->db->where('a.ID_STOK',$id_obat);
		return $this->db->get()->result();
	}
	function get_data_obat_pasien_belum_bayar($nodaftar){
		$get_data_obat = 	"SELECT
							po.ID_PENJUALAN AS id_jual,
							po.ID_STOK AS id_stok,
							po.TGL_JUAL AS tgl_jual,
							ob.NAMA_OBAT AS nm_obat,
							po.KETERANGAN AS keterangan,
							po.QTY AS qty,
							po.BIAYA AS biaya
							FROM ts_penjualan_obat AS po
							JOIN ms_obat AS ob
							ON po.KODE_OBAT=ob.KODE_OBAT
							WHERE po.NODAFTAR='$nodaftar'
							AND po.KODE_STATUS=1";
		return $this->db->query($get_data_obat)->result();
	}
	function data_tindakan_outlet($id_perusahaan){
		$this->db->select( 'td.ID_TARIF_TINDAKAN id_tarif, 
							t.NAMA_TINDAKAN nm_tarif, 
							td.ID_PERUSAHAAN outlet, 
							td.KODE_TINDAKAN id_tindakan, 
							td.TARIF tarif');
		$this->db->from('ms_tarif_tindakan td');
		$this->db->JOIN('ms_tindakan t','td.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->where('td.ID_PERUSAHAAN',$id_perusahaan);
		$this->db->where('td.STATUS', 1);
		$this->db->where('t.KODE_JENISTINDAKAN!=', 9);
		return $this->db->get()->result();
	}
	function get_data_validasi_tindakan($id_tarif_tindakan){
		$this->db->select( 'td.ID_TARIF_TINDAKAN id_tarif, 
							t.KODE_JENISTINDAKAN kode_jenis, 
							t.NAMA_TINDAKAN nm_tarif, 
							td.ID_PERUSAHAAN outlet, 
							td.KODE_TINDAKAN id_tindakan, 
							td.TARIF tarif');
		$this->db->from('ms_tarif_tindakan td');
		$this->db->JOIN('ms_tindakan t','td.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->where('td.ID_TARIF_TINDAKAN',$id_tarif_tindakan);
		$this->db->where('td.STATUS', 1);
		// $this->db->where('t.KODE_JENISTINDAKAN!=', 9);
		return $this->db->get()->result();
	}
	function cari_tindakan_yang_sama($id_tindakan, $id_perusahaan, $nodaftar){
		$this->db->select(	'bp.ID_PERAWATAN id_b_perawatan,
							bp.QTY_TINDAKAN jumlah,
							bp.BIAYA biaya,
							bp.ID_TARIF_TINDAKAN tarif');
		$this->db->from('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan td', 'bp.ID_TARIF_TINDAKAN=td.ID_TARIF_TINDAKAN');
		$this->db->where('bp.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->where('bp.NODAFTAR', $nodaftar);
		$this->db->where('bp.ID_TARIF_TINDAKAN', $id_tindakan);
		$this->db->where('bp.KODE_STATUS', 1);
		return $this->db->get()->result();
	}
	function cari_tarif_tindakan($id_perusahaan, $id_tindakan){
		$this->db->select( 'td.ID_TARIF_TINDAKAN id_tarif, 
							t.NAMA_TINDAKAN nm_tarif, 
							td.ID_PERUSAHAAN outlet, 
							td.KODE_TINDAKAN id_tindakan, 
							td.TARIF tarif');
		$this->db->from('ms_tarif_tindakan td');
		$this->db->JOIN('ms_tindakan t','td.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->where('td.ID_PERUSAHAAN',$id_perusahaan);
		$this->db->where('td.STATUS', 1);
		$this->db->where('t.KODE_JENISTINDAKAN!=', 9);
		$this->db->where('td.ID_TARIF_TINDAKAN', $id_tindakan);
		return $this->db->get()->result();
	}
	function get_daftar_tindakan_kepada_pasien($nodaftar, $tgl_sekarang){
		$this->db->select(	'bp.ID_PERAWATAN AS id_perawatan,
							bp.TGL_TINDAKAN tgl_tindakan,
							t.NAMA_TINDAKAN nm_tindakan,
							tt.ID_TARIF_TINDAKAN tar_tindakan,
							bp.KETERANGAN keterangan,
							bp.QTY_TINDAKAN qty,
							bp.BIAYA biaya_t');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->join('ms_tarif_tindakan tt', 'bp.ID_TARIF_TINDAKAN=tt.ID_TARIF_TINDAKAN');
		$this->db->join('ms_tindakan t', 'tt.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('bp.KODE_STATUS', 1);
		// $this->db->WHERE('bp.TGL_TINDAKAN', $tgl_sekarang);
		$this->db->WHERE('t.KODE_JENISTINDAKAN!=',9);
		return $this->db->get()->result();
	}
	function get_tindakan_global($nodaftar, $tgl_sekarang){
		$this->db->select(	'bp.ID_PERAWATAN id_perawatan,
							bp.TGL_TINDAKAN tgl_tindakan,
							t.NAMA_TINDAKAN nm_tindakan,
							tt.ID_TARIF_TINDAKAN tar_tindakan,
							bp.KETERANGAN keterangan,
							bp.QTY_TINDAKAN qty,
							bp.BIAYA biaya_p,
							bp.TARIF tarif_t,
							bp.PRINT');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->join('ms_tarif_tindakan tt', 'bp.ID_TARIF_TINDAKAN=tt.ID_TARIF_TINDAKAN');
		$this->db->join('ms_tindakan t', 'tt.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		// $this->db->WHERE('bp.TGL_TINDAKAN', $tgl_sekarang);
		$this->db->WHERE('t.KODE_JENISTINDAKAN!=',9);
		return $this->db->get()->result();	
	}
	function get_tot_tindakan_global($nodaftar, $tgl_sekarang){
		$this->db->select(	'SUM(bp.BIAYA) tot_biaya');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->join('ms_tarif_tindakan tt', 'bp.ID_TARIF_TINDAKAN=tt.ID_TARIF_TINDAKAN');
		$this->db->join('ms_tindakan t', 'tt.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		// $this->db->WHERE('bp.TGL_TINDAKAN', $tgl_sekarang);
		$this->db->WHERE('t.KODE_JENISTINDAKAN!=',9);
		return $this->db->get()->result();	
	}
	function get_obat_global($nodaftar, $tgl_sekarang){
		$this->db->SELECT(	'po.ID_PENJUALAN id_jual,
							po.ID_STOK id_stok,
							po.TGL_JUAL tgl_jual,
							ob.NAMA_OBAT nm_obat,
							ob.SATUAN satuan,
							po.KETERANGAN keterangan,
							po.QTY qty,
							po.BIAYA biaya,
							po.HARGA_JUAL hrg_jual_o,
							po.PRINT');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->JOIN('ms_obat ob', 'po.KODE_OBAT=ob.KODE_OBAT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.KODE_STATUS!=', 0);
		return $this->db->get()->result();
	}
	function get_tot_obat_global($nodaftar, $tgl_sekarang){
		$this->db->SELECT(	'SUM(po.BIAYA) tot_biaya');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->JOIN('ms_obat ob', 'po.KODE_OBAT=ob.KODE_OBAT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.KODE_STATUS!=', 0);
		// $this->db->WHERE('po.TGL_JUAL', $tgl_sekarang);
		return $this->db->get()->result();
	}
	function get_tot_optik_global($nodaftar, $tgl_sekarang){
		$this->db->SELECT('SUM(po.TOTAL_HARGA) tot_biaya');
		$this->db->FROM('ts_penjualan_optik po');
		
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		// $this->db->WHERE('po.TANGGAL_PENJUALAN', $tgl_sekarang);
		$this->db->WHERE('po.STATUS_BARANG=', '');
		return $this->db->get()->result();
	}
	function get_tagihan_optik($nodaftar){
		$this->db->SELECT('SUM(po.TOTAL_HARGA) tot_biaya');
		$this->db->FROM('ts_penjualan_optik po');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.KODE_STATUS', 1);
		$this->db->WHERE('po.STATUS_BARANG=', '');
		return $this->db->get()->result();
	}
	function get_biaya_bayar_operasi($nodaftar, $tgl_sekarang){
		$this->db->SELECT(	'tb.ID_PERAWATAN as id_biaya_perawatan,
							tb.NODAFTAR nodaftar,
							tb.BIAYA tot_biaya_op');
		$this->db->FROM('ts_biayaperawatan tb');
		$this->db->JOIN('ms_tarif_tindakan td', 'tb.ID_TARIF_TINDAKAN = td.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan t', 'td.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->WHERE('tb.NODAFTAR', $nodaftar);
		$this->db->WHERE('tb.KODE_STATUS', 1);
		$this->db->WHERE('tb.TGL_TINDAKAN', $tgl_sekarang);
		$this->db->where('t.KODE_JENISTINDAKAN >=', 4);
		$this->db->where('t.KODE_JENISTINDAKAN <=', 5);
		return $this->db->get()->result();
	}
	function get_baiaya_bayar_bukan_operasi($nodaftar, $tgl_sekarang){
		$this->db->SELECT(	'tb.NODAFTAR nodaftar,
							SUM(tb.BIAYA) tot_biaya_op');
		$this->db->FROM('ts_biayaperawatan tb');
		$this->db->JOIN('ms_tarif_tindakan td', 'tb.ID_TARIF_TINDAKAN = td.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan t', 'td.KODE_TINDAKAN=t.KODE_TINDAKAN');
		$this->db->WHERE('tb.NODAFTAR', $nodaftar);
		$this->db->WHERE('tb.KODE_STATUS', 1);
		$this->db->WHERE('tb.TGL_TINDAKAN', $tgl_sekarang);
		$this->db->where('tb.ID_TARIF_TINDAKAN IN (SELECT a.ID_TARIF_TINDAKAN FROM ms_tarif_tindakan AS a JOIN ms_tindakan AS b ON a.KODE_TINDAKAN=b.KODE_TINDAKAN WHERE b.KODE_JENISTINDAKAN!=4)');
		$this->db->where('tb.ID_TARIF_TINDAKAN IN (SELECT a.ID_TARIF_TINDAKAN FROM ms_tarif_tindakan AS a JOIN ms_tindakan AS b ON a.KODE_TINDAKAN=b.KODE_TINDAKAN WHERE b.KODE_JENISTINDAKAN!=5)');
		$this->db->where('tb.ID_TARIF_TINDAKAN IN (SELECT a.ID_TARIF_TINDAKAN FROM ms_tarif_tindakan AS a JOIN ms_tindakan AS b ON a.KODE_TINDAKAN=b.KODE_TINDAKAN WHERE b.KODE_JENISTINDAKAN!=9)');
		return $this->db->get()->result();	
	}
	function get_biaya_bayar_obat($nodaftar, $tgl_sekarang){
		$this->db->SELECT(	'po.NODAFTAR nodaftar_obt,
							SUM(po.BIAYA) tot_biaya_obt');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->WHERE('nodaftar', $nodaftar);
		$this->db->WHERE('po.KODE_STATUS', 1);
		$this->db->WHERE('po.TGL_JUAL', $tgl_sekarang);
		return $this->db->get()->result();
	}
	function get_id_pembayaran_yang_sama($id_perusahaan, $nodaftar, $norm, $tgl_sekarang){
		$this->db->SELECT(	'p.ID_PEMBAYARAN id_bayar,
							p.JUMLAH_TAGIHAN jum_tagihan,
							p.BAYAR jum_bayar,
							p.KEMBALI jum_kembalian,
							p.UANG_BULAT bulat');
		$this->db->FROM('ts_pembayaran p');
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('p.NODAFTAR', $nodaftar);
		$this->db->WHERE('p.NORM', $norm);
		$this->db->WHERE('p.TGL_BAYAR', $tgl_sekarang);
		$this->db->WHERE('p.KODEJENIS', 2);
		return $this->db->get()->result();
	}
	function get_pembayarna_karcis_sama($id_perusahaan, $nodaftar, $norm){
		$this->db->SELECT(	'p.ID_PEMBAYARAN id_bayar,
							p.JUMLAH_TAGIHAN jum_tagihan,
							p.BAYAR jum_bayar,
							p.KEMBALI jum_kembalian,
							p.UANG_BULAT bulat');
		$this->db->FROM('ts_pembayaran p');
		$this->db->WHERE('p.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('p.NODAFTAR', $nodaftar);
		$this->db->WHERE('p.NORM', $norm);
		// $this->db->WHERE('p.TGL_BAYAR', $tgl_sekarang);
		$this->db->WHERE('p.KODEJENIS', 1);
		return $this->db->get()->result();
	}
	function get_data_pasien_karcis_($nodaftar){
		$this->db->SELECT( 'pr.NAMA_PERUSAHAAN,
							pr.ALAMAT_PERUSAHAAN,
							pr.NO_TELPON,
							pr.EMAIL,
							pm.CETAK,
							pm.PEMBAYAR,
							pm.ID_PEMBAYARAN,
							bp.NODAFTAR,
							p.NORM,
							p.NAMA,
							bp.TGL_TINDAKAN,
							p.ALAMAT,
							p.JK,
							p.TANGGAL_LAHIR,
							p.NOKPST,
							pm.JENIS_PEMBAYARAN,
							pr.KOTA,
							pr.KODE_POS,
							pg.NAMA pgw');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_pasien p', 'bp.NORM=p.NORM');
		$this->db->JOIN('ms_pegawai pg', 'bp.NIP_PEGAWAI=pg.NIP_PEGAWAI');
		$this->db->JOIN('ms_perusahaan pr', 'bp.ID_PERUSAHAAN=pr.ID_PERUSAHAAN');
		$this->db->JOIN('ts_pembayaran pm', 'bp.NODAFTAR=pm.NODAFTAR');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		// $this->db->WHERE('pm.KODEJENIS', 1);
		$this->db->LIMIT('1');
		return $this->db->get();
	}
	function get_data_pasien_rincian($nodaftar){
		$this->db->SELECT( 'pr.NAMA_PERUSAHAAN,
							pr.ALAMAT_PERUSAHAAN,
							pr.NO_TELPON,
							pr.EMAIL,
							pm.CETAK,
							pm.PEMBAYAR,
							pm.ID_PEMBAYARAN,
							bp.NODAFTAR,
							p.NORM,
							p.NAMA,
							bp.TGL_TINDAKAN,
							p.ALAMAT,
							p.JK,
							p.TANGGAL_LAHIR,
							p.NOKPST,
							pm.JENIS_PEMBAYARAN,
							pr.KOTA,
							pr.KODE_POS,
							pg.NAMA pgw');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_pasien p', 'bp.NORM=p.NORM');
		$this->db->JOIN('ms_pegawai pg', 'bp.NIP_PEGAWAI=pg.NIP_PEGAWAI');
		$this->db->JOIN('ms_perusahaan pr', 'bp.ID_PERUSAHAAN=pr.ID_PERUSAHAAN');
		$this->db->JOIN('ts_pembayaran pm', 'bp.NODAFTAR=pm.NODAFTAR');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		// $this->db->WHERE('pm.KODEJENIS', 1);
		$this->db->LIMIT('1');
		return $this->db->get();
	}
	function get_tindakan_pasien($nodaftar){
		$this->db->SELECT('	tb.ID_PERAWATAN,
							mtt.KODE_TINDAKAN,
							tb.ID_TARIF_TINDAKAN,
							tb.QTY_TINDAKAN,
							tb.BIAYA');
		$this->db->FROM('ts_biayaperawatan tb');
		$this->db->JOIN('ms_tarif_tindakan mtt', 'tb.ID_TARIF_TINDAKAN=mtt.ID_TARIF_TINDAKAN');
		$this->db->WHERE('tb.NODAFTAR', $nodaftar);
		return $this->db->get()->result();
	}
	function cetak_kwitansi_karcis($nodaftar, $id_perusahaan){
		$this->db->SELECT(	'bp.NODAFTAR,
							tn.NAMA_TINDAKAN,
							bp.ID_TARIF_TINDAKAN,
							bp.TARIF,
							bp.QTY_TINDAKAN,
							bp.BIAYA,
							bp.DISKON');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan tr', 'bp.ID_TARIF_TINDAKAN=tr.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan tn', 'tr.KODE_TINDAKAN=tn.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tn.KODE_JENISTINDAKAN',9);
		$this->db->WHERE('bp.KODE_STATUS',2);
		$this->db->WHERE('bp.PRINT',1);
		$this->db->WHERE('tr.ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get();	
	}
	function cetak_pendaftaran($nodaftar, $id_perusahaan){
		$this->db->SELECT('	tp.NODAFTAR, tp.TGL_DAFTAR');
		$this->db->FROM('ts_pendaftaran tp');
		$this->db->WHERE('tp.NODAFTAR', $nodaftar);
		$this->db->WHERE('tp.ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();
	}
	function cetak_kwitansi_tagihan($nodaftar, $id_perusahaan){
		$this->db->SELECT(	'bp.NODAFTAR,
							tn.NAMA_TINDAKAN,
							bp.ID_TARIF_TINDAKAN,
							bp.TARIF,
							bp.QTY_TINDAKAN,
							bp.BIAYA,
							bp.DISKON');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan tr', 'bp.ID_TARIF_TINDAKAN=tr.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan tn', 'tr.KODE_TINDAKAN=tn.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('bp.KODE_STATUS', 2);
		$this->db->WHERE('bp.PRINT', 1);
		$this->db->WHERE('tn.KODE_JENISTINDAKAN!=',9);
		$this->db->WHERE('bp.KODE_STATUS',2);
		$this->db->WHERE('tr.ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get();	
	}
	function cetak_rincian_tindakan($nodaftar, $id_perusahaan){
		$this->db->SELECT(	'bp.NODAFTAR,
							tn.NAMA_TINDAKAN,
							bp.ID_TARIF_TINDAKAN,
							bp.TARIF,
							bp.QTY_TINDAKAN,
							bp.BIAYA,
							bp.DISKON');
		$this->db->FROM('ts_biayaperawatan bp');
		$this->db->JOIN('ms_tarif_tindakan tr', 'bp.ID_TARIF_TINDAKAN=tr.ID_TARIF_TINDAKAN');
		$this->db->JOIN('ms_tindakan tn', 'tr.KODE_TINDAKAN=tn.KODE_TINDAKAN');
		$this->db->WHERE('bp.NODAFTAR', $nodaftar);
		$this->db->WHERE('bp.KODE_STATUS', 2);
		$this->db->WHERE('bp.PRINT', 1);
		$this->db->WHERE('tr.ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get();	
	}
	function cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan){
		$this->db->SELECT( 'po.NODAFTAR,
							o.NAMA_OBAT,
							po.ID_STOK,
							po.HARGA_JUAL,
							po.QTY,
							po.BIAYA,
							po.DISKON');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->JOIN('ms_obat o', 'po.KODE_OBAT=o.KODE_OBAT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('po.KODE_STATUS', 2);
		$this->db->WHERE('po.PRINT', 1);
		return $this->db->get()->result();
	}
	function cetak_kwitansi_tagihan_obat_manual($nodaftar, $id_perusahaan){
		$this->db->SELECT( 'po.NODAFTAR,
							o.NAMA_OBAT,
							po.ID_STOK,
							po.HARGA_JUAL,
							po.QTY,
							po.BIAYA,
							po.DISKON');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->JOIN('ms_obat o', 'po.KODE_OBAT=o.KODE_OBAT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('po.KETERANGAN', 'Resep');
		return $this->db->get()->result();
	}
	function cetak_kwitansi_tagihan_obat2($nodaftar, $id_perusahaan){
		$this->db->SELECT( 'po.NODAFTAR,
							SUM(po.QTY) QTY,
							SUM(po.BIAYA) BIAYA,
							SUM(po.DISKON) DISKON');
		$this->db->FROM('ts_penjualan_obat po');
		$this->db->JOIN('ms_obat o', 'po.KODE_OBAT=o.KODE_OBAT');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('po.KODE_STATUS', 2);
		$this->db->group_by('po.NODAFTAR');
		return $this->db->get()->result();
	}
	// function cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan){
	// 	$this->db->SELECT( 'op.NODAFTAR,
	// 						o.NAMA_OBAT,
	// 						op.ID_STOK,
	// 						op.HARGA_SATUAN,
	// 						op.QTY,
	// 						op.TOTAL_HARGA');
	// 	$this->db->FROM('ts_penjualan_optik op');
	// 	$this->db->JOIN('ms_obat o', 'op.KODE_OBAT=o.KODE_OBAT');
	// 	$this->db->WHERE('op.NODAFTAR', $nodaftar);
	// 	$this->db->WHERE('op.ID_PERUSAHAAN', $id_perusahaan);
	// 	$this->db->WHERE('op.KODE_STATUS', 2);
	// 	return $this->db->get()->result();
	// }
	function cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan){
		$this->db->SELECT('po.NAMA_BARANG, po.HARGA_SATUAN, po.QTY, po.TOTAL_HARGA');
		$this->db->FROM('ts_penjualan_optik po');
		$this->db->WHERE('po.NODAFTAR', $nodaftar);
		$this->db->WHERE('po.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('po.KODE_STATUS=', 2);
		$this->db->WHERE('po.PRINT', 1);
		$this->db->WHERE('po.STATUS_BARANG=', '');
		return $this->db->get()->result();
	}
	function cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan){
		$this->db->SELECT('tsk.ID_SEWA id_sewa,
						  tsk.ID_TARIF_SEWA trf_sewa,
						  tsk.LOKASI_TUJUAN tujuan,
						  tsk.KODE_STATUS kd_status,
						  tsk.HARGA_SEWA hrg_sewa,
						  tsa.NAMA_TUJUAN nm_tujuan');
		$this->db->FROM('ts_sewa_kendaraan tsk');
		$this->db->JOIN('ms_tarif_sewa_ambulance tsa', 'tsk.ID_TARIF_SEWA=tsa.ID_TARIF_SEWA', 'LEFT');
		$this->db->WHERE('tsk.NODAFTAR', $nodaftar);
		$this->db->WHERE('tsk.ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('tsk.KODE_STATUS', 2);
		$this->db->WHERE('tsk.PRINT', 1);
		return $this->db->get()->result();			
	}
	function get_ttd_nama_dokter($id_perusahaan){
		$this->db->SELECT('ms_tarif_dokter.ID_DOKTER,
						ms_tarif_dokter.ID_TARIF,
						ms_dokter.NAMA_DOKTER,
						ms_tarif_dokter.STATUS');
		$this->db->FROM('ms_tarif_dokter');
		$this->db->JOIN('ms_dokter', 'ms_tarif_dokter.ID_DOKTER=ms_dokter.ID_DOKTER');
		$this->db->WHERE('ID_PERUSAHAAN', $id_perusahaan);
		$this->db->WHERE('ms_tarif_dokter.TTD_DOKTER',1);
		$this->db->WHERE('ms_tarif_dokter.STATUS_CETAK',1);
		return $this->db->get()->result();
	}
	function get_karcis_yang_sama($nodaftar){
		$this->db->SELECT('pm.ID_PEMBAYARAN,
						  pm.CETAK');
		$this->db->FROM('ts_pembayaran pm');
		$this->db->WHERE('pm.NODAFTAR', $nodaftar);
		$this->db->WHERE('pm.KODEJENIS', 1);
		return $this->db->get()->result();
	}
	function get_tagihan_yang_sama($nodaftar){
		$this->db->SELECT('pm.ID_PEMBAYARAN,
						  pm.CETAK');
		$this->db->FROM('ts_pembayaran pm');
		$this->db->WHERE('pm.NODAFTAR', $nodaftar);
		$this->db->WHERE('pm.KODEJENIS', 2);
		return $this->db->get()->result();
	}
	function simpan_penjualan_optik($data_optik){
		$simpan = $this->db->insert('ts_penjualan_optik', $data_optik);
		if ($simpan==TRUE) {
			return 'Benar';
		}else{
			return 'Salah';
		}
	}
	function update_penjualan_optik($data_optik, $id_penjualan_optik){
		$this->db->WHERE('ID_PENJUALAN_OPTIK', $id_penjualan_optik);
		$update = $this->db->UPDATE('ts_penjualan_optik', $data_optik);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_norm($data_simpan){
		$simpan = $this->db->insert('ms_pasien', $data_simpan);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_pendaftaran($data_pendaftaran){
		$this->db->insert('ts_pendaftaran', $data_pendaftaran);
	}
	function simpan_tindakan_karcis($table, $data_tindakan){
		$this->db->insert($table, $data_tindakan);
	}
	function simpan_pembayaran_karcis($pembayaran){
		$simpan = $this->db->insert('ts_pembayaran', $pembayaran);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_obat_pasien($data_penjualan_obat){
		$simpan = $this->db->insert('ts_penjualan_obat', $data_penjualan_obat);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_pelayanan_tindakan_pasien($data_tindakan){
		$simpan = $this->db->insert('ts_biayaperawatan', $data_tindakan);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_pembayaran_tindakan($pembayaran){
		$simpan = $this->db->insert('ts_pembayaran', $pembayaran);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_retur($table, $data){
		$simpan = $this->db->insert($table, $data);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_sewa($table, $data){
		$simpan = $this->db->insert($table, $data);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function simpan_resep_obat($table, $data){
		$simpan = $this->db->insert($table, $data);
		if ($simpan==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_kode_status_BP($id_perawatan, $nodaftar,$kode_status){
		$this->db->where('ID_PERAWATAN', $id_perawatan);
		$this->db->where('NODAFTAR', $nodaftar);
		$this->db->update('ts_biayaperawatan',$kode_status);
	}
	function update_diskon_tindakan($id_biaya_perawatan, $diskon){
		$this->db->where('ID_PERAWATAN',$id_biaya_perawatan);
		$this->db->update('ts_biayaperawatan', $diskon);
	}
	function update_stok_obat($id_obat, $data_update_stok){
		$this->db->where('ID_STOK', $id_obat);
		$update = $this->db->update('ms_stok_obat', $data_update_stok);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_stok_optik($id_obat, $data_update_stok){
		$this->db->where('ID_STOK_OPTIK', $id_obat);
		$update = $this->db->update('ms_stok_optik', $data_update_stok);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_obat_pasien($data_penjualan_obat, $ms_kode_obat){
		$this->db->where('ID_PENJUALAN', $ms_kode_obat);
		$update = $this->db->update('ts_penjualan_obat', $data_penjualan_obat);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_data_tindakan_pasien($id_biaya_perawatan_u, $data_tindakan){
		$this->db->where('ID_PERAWATAN',$id_biaya_perawatan_u);
		$update = $this->db->update('ts_biayaperawatan', $data_tindakan);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_status_cetak($tabel, $field, $id, $data){
		$this->db->where($field,$id);
		$update = $this->db->update($tabel, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function delete_tindakan_karcis_pasien($id_perawatan){
		$this->db->where('ID_PERAWATAN', $id_perawatan);
		$hapus = $this->db->delete('ts_biayaperawatan');
		if ($hapus==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_biaya_obat_gratis($tgl_bayar, $nodaftar, $data_obat){
		$this->db->where('NODAFTAR', $nodaftar);
		// $this->db->where('TGL_JUAL', $tgl_bayar);
		$this->db->where('KODE_STATUS', 1);
		$update = $this->db->update('ts_penjualan_obat', $data_obat);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_biaya_obat_gratis_dua($id_jual_obat, $nodaftar, $data_obat){
		$this->db->where('ID_PENJUALAN', $id_jual_obat);
		$this->db->where('KODE_STATUS', 1);
		$update = $this->db->update('ts_penjualan_obat', $data_obat);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_data_biaya_perawatan($id_perawatan, $nodaftar, $data_biaya_perawatan){
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$this->db->WHERE('ID_PERAWATAN', $id_perawatan);
		$this->db->WHERE('KODE_STATUS', 1);
		$update = $this->db->update('ts_biayaperawatan', $data_biaya_perawatan);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_data_biaya_perawatan_diskon($id_biaya_operasi, $data_biaya_diskon){
		$this->db->WHERE('ID_PERAWATAN', $id_biaya_operasi, 'KODE_STATUS', 1);
		$update = $this->db->update('ts_biayaperawatan', $data_biaya_diskon);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_pembayaran_tindakan($pembayaran, $id_bayar_tindakan){
		$this->db->WHERE('ID_PEMBAYARAN', $id_bayar_tindakan);
		$update = $this->db->update('ts_pembayaran', $pembayaran);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_pembayaran_karcis($pembayaran, $id_bayar_karcis){
		$this->db->WHERE('ID_PEMBAYARAN', $id_bayar_karcis);
		$update = $this->db->update('ts_pembayaran', $pembayaran);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_cetak_karcis($no_karcis, $data){
		$this->db->WHERE('ID_PEMBAYARAN', $no_karcis);
		$update = $this->db->update('ts_pembayaran', $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_cetak_dan_keterangan($data, $nokarcis){
		$this->db->WHERE('ID_PEMBAYARAN', $nokarcis);
		$update = $this->db->update('ts_pembayaran', $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_pasien($norm_pasien, $data_pasien){
		$this->db->WHERE('NORM', $norm_pasien);
		$this->db->update('ms_pasien', $data_pasien);
		// if ($update==TRUE) {
		// 	return "Benar";
		// }else{
		// 	return "Salah";
		// }
	}
	function update_pendaftaran($data_pendaftaran, $nodaftar){
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$update = $this->db->update('ts_pendaftaran', $data_pendaftaran);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function update_batal_b_perawatan($tgl_sekarang, $nodaftar, $data_biaya_perawatan){
		$this->db->WHERE('NODAFTAR', $nodaftar, 'TGL_TINDAKAN', $tgl_sekarang);
		$update = $this->db->update('ts_biayaperawatan', $data_biaya_perawatan);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_b_perawatan($nodaftar, $data_biaya_perawatan){
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$update = $this->db->update('ts_biayaperawatan', $data_biaya_perawatan);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_batal_tindakan($id_tindakan, $data_biaya_perawatan){
		$this->db->WHERE('ID_PERAWATAN', $id_tindakan);
		$update = $this->db->update('ts_biayaperawatan', $data_biaya_perawatan);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_batal_p_obat($tgl_sekarang, $nodaftar, $data_penjualan_obat){
		$this->db->WHERE('NODAFTAR', $nodaftar, 'TGL_JUAL', $tgl_sekarang);
		$update = $this->db->update('ts_penjualan_obat', $data_penjualan_obat);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_retur($table, $field_tabel, $id, $data){
		$this->db->WHERE($field_tabel, $id);
		$update = $this->db->update($table, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_sewa($table, $field_tabel, $data, $id){
		$this->db->WHERE($field_tabel, $id);
		$update = $this->db->update($table, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_resep_obat($table, $field_tabel, $data, $id){
		$this->db->WHERE($field_tabel, $id);
		$update = $this->db->update($table, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_data_double_field($table, $field_tabel1, $field_tabel2, $data, $id1, $id2){
		$this->db->WHERE($field_tabel1, $id1);
		$this->db->WHERE($field_tabel2, $id2);
		$update = $this->db->update($table, $data);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function update_jasmed_op($nodaftar, $data_jasmed_op){
		$this->db->WHERE('NODAFTAR', $nodaftar);
		$update = $this->db->update('ts_pendaftaran', $data_jasmed_op);
		if ($update==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function delete_list_obat_pasien($id_penjualan){
		$this->db->where('ID_PENJUALAN', $id_penjualan);
		$hapus = $this->db->delete('ts_penjualan_obat');
		if ($hapus==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function hapus_list_tindakan_pasien($id_biaya_perawatan){
		$this->db->where('ID_PERAWATAN', $id_biaya_perawatan);
		$hapus = $this->db->delete('ts_biayaperawatan');
		if ($hapus==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}
	}
	function hapus_sewa($table, $field_tabel, $id){
		$this->db->where($field_tabel, $id);
		$hapus = $this->db->delete($table);
		if ($hapus==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
	function hapus_data($table, $field_tabel, $id){
		$this->db->where($field_tabel, $id);
		$hapus = $this->db->delete($table);
		if ($hapus==TRUE) {
			return "Benar";
		}else{
			return "Salah";
		}	
	}
}