<?php
	class Ambil_rujukan_masuk extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();

			$this->load->helper('form');
	        $this->load->database();
	        $this->load->library('session');
	        $this->load->model('m_login');
	        $this->load->model('m_api_sep');
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
		function index(){
			$id_perusahaan 	= $this->session->userdata('outlet');
			$tgl_sekarang 	= date('Y-m-d');
			$data['get_data_bpjs'] = $this->m_api_sep->get_data_bpjs($id_perusahaan, $tgl_sekarang);
			$this->template->load('template', 'form_api_bpjs/form_ambil_rujukan', $data);
		}
		function get_data_pasien_nodaftar(){
			$id_perusahaan 	= $this->session->userdata('outlet');
			$nodaftar 		= $this->input->post('nodaftar');
			$tgl_sekarang 	= date('Y-m-d');
			$get_data_pasien_nodaftar = $this->m_api_sep->get_data_pasien_nodaftar($id_perusahaan, $nodaftar);
			echo json_encode($get_data_pasien_nodaftar);
		}
		function tes_http_request(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$jenis_input_rujukan 	= $this->input->post('rdpilih');
			$norujukan 				= $this->input->post('txtNoRujukan_0');
			$txtNokartu 			= $this->input->post('txtNokartu');
			$cbasalrujukan_0 		= $this->input->post('cbasalrujukan_0');
			// $norujukan 				= "132210010919P000001";
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			// if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
			// 	foreach ($get_token_bpjs->result() as $key) {
			// 		$data 		= $key->no_token;
			// 		$secretKey 	= $key->nokey;
			// 	}
			// 	$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		 //        $service_name 			= "vclaim-rest";
		 //        // $service_name 			= "vclaim-rest-1.1";
		 //        if ($jenis_input_rujukan==2) {
		 //        	if ($cbasalrujukan_0==1) {
		 //        		$uri = $url."/".$service_name."/Rujukan/".$norujukan;
		 //        	}else{
		 //        		$uri = $url."/".$service_name."/Rujukan/RS/".$norujukan;
		 //        	}
		 //        }else {
		 //        	$uri = $url."/".$service_name."/Rujukan/Peserta/".$txtNokartu;
		 //        }
			// 	// Computes the timestamp
		 //        date_default_timezone_set('UTC');
		 //        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		 //        // Computes the signature by hashing the salt with the secret key as the key
		 //        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		 //        // base64 encode…
		 //        $encodedSignature = base64_encode($signature);
		 //        // urlencode…
		 //        // $urlencodedSignature = urlencode($encodedSignature);
		 //        $ch = curl_init();
		 //        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 //            "X-cons-id: $data", 
		 //            "X-timestamp: $tStamp", 
		 //            "X-signature: $encodedSignature"
		 //        ));
		 //        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 //        // curl_setopt($ch, CURLOPT_URL, $uri);

		 //        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		 //        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 //        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		 //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 //        curl_setopt($ch, CURLOPT_URL, $uri);

		 //        $send = curl_exec($ch);

		 //        if ($send === false) {
		 //            die('Error fecthing data: ' .curl_error($ch));
		 //        }
		 //        $data = json_decode($send);
		 //        echo $send;
			// }//penutup if jika ditemukan cons id
			// else{//pembuka if jika tidak ditemukan cons id
			// 	echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			// }//penutup if jika tidak ditemukan cons id
			$diagnosa = array(
                "kode" => "I21.9",
                "nama" => "Acute myocardial infarction, unspecified"
             );
			$pelayanan = array(
			                "kode" => "1",
			                "nama" => "Rawat Inap"
			             );
			$cob = array(
			           "nmAsuransi" => null,
			           "noAsuransi" => null,
			           "tglTAT" => null,
			           "tglTMT" => null
			        );
			$hakKelas = array(
			                 "keterangan" => "KELAS III",
			                 "kode" => "3"
			              );
			$informasi = array(
			                 "dinsos" => null,
			                 "noSKTM" => null,
			                 "prolanisPRB" => null
			              );
			$jenisPeserta = array(
			                 "keterangan" => "PBI (APBN)",
			                 "kode" => "21"
			              );
			$mr  = array(
			           "noMR" => "971430",
			           "noTelepon" => null
			        );
			$provUmum = array(
			                 "kdProvider" => "03050301",
			                 "nmProvider" => "BASO"
			              );
			$statusPeserta = array(
			                   "keterangan" => "AKTIF",
			                   "kode" => "0"
			                );
			$umur = array(
			             "umurSaatPelayanan" => "63 tahun ,7 bulan ,23 hari",
			             "umurSekarang" => "64 tahun ,4 bulan ,12 hari"
			          );
			$poliRujukan = array(
			                    "kode" => "",
			                    "nama" => ""
			                 );
			$provPerujuk = array(
			                  "kode" => "0304R005",
			                  "nama" => "RSI IBNU SINA"
			               );

			$data_rujukan = array(
			       "metaData" => array(
			          "code" => "200",
			          "message" => "OK"
			       ),
			       "response" => array(
			          "rujukan" => array(
			             "diagnosa" => $diagnosa,
			             "keluhan" => "",
			             "noKunjungan " => "0304R0050217A000079",
			             "pelayanan" => $pelayanan,
			             "peserta" => array(
			                "cob" => $cob,
			                "hakKelas" => $hakKelas,
			                "informasi" => $informasi,
			                "jenisPeserta" => $jenisPeserta,
			                "mr" => $mr,
			                "nama" => "MUHAMMAD JUSAR",
			                "nik" => "1106081301530001",
			                "noKartu" => "0105986780439",
			                "pisa" => "1",
			                "provUmum" => $provUmum,
			                "sex" => "L",
			                "statusPeserta" => $statusPeserta,
			                "tglCetakKartu" => "2017-11-13",
			                "tglLahir" => "1953-07-01",
			                "tglTAT" => "2053-07-01",
			                "tglTMT " => "2013-01-01",
			                "umur" => $umur
			             ),
			             "poliRujukan" => $poliRujukan,
			             "provPerujuk" => $provPerujuk,
			             "tglKunjungan " => "2017-02-24"
			          ),
			       ),
			    );
			echo json_encode($data_rujukan);
		}

		function simpan_data_rujukan(){
			$rujukan_asal_faskes_ambil 						= $this->input->post('rujukan_asal_faskes_ambil');
			$rujukan_diagnosa_kode_ambil 					= $this->input->post('rujukan_diagnosa_kode_ambil');
			$rujukan_diagnosa_nama_ambil 					= $this->input->post('rujukan_diagnosa_nama_ambil');
			$rujukan_keluhan_ambil 							= $this->input->post('rujukan_keluhan_ambil');
			$rujukan_noKunjungan_ambil 						= $this->input->post('rujukan_noKunjungan_ambil');
			$rujukan_pelayanan_kode_ambil 					= $this->input->post('rujukan_pelayanan_kode_ambil');
			$rujukan_pelayanan_nama_ambil 					= $this->input->post('rujukan_pelayanan_nama_ambil');
			$peserta_cob_nmasuransi_ambil 					= $this->input->post('peserta_cob_nmasuransi_ambil');
			$peserta_cob_noasuransi_ambil 					= $this->input->post('peserta_cob_noasuransi_ambil');
			$peserta_cob_tglTAT_ambil 						= $this->input->post('peserta_cob_tglTAT_ambil');
			$peserta_cob_tglTMT_ambil 						= $this->input->post('peserta_cob_tglTMT_ambil');
			$peserta_hakKelas_kode_ambil 					= $this->input->post('peserta_hakKelas_kode_ambil');
			$peserta_hakKelas_keterangan_ambil 				= $this->input->post('peserta_hakKelas_keterangan_ambil');
			$rujukan_peserta_informasi_dinsos_ambil 		= $this->input->post('rujukan_peserta_informasi_dinsos_ambil');
			$rujukan_peserta_informasi_noSKTM_ambil 		= $this->input->post('rujukan_peserta_informasi_noSKTM_ambil');
			$rujukan_peserta_informasi_prolanisPRB_ambil 	= $this->input->post('rujukan_peserta_informasi_prolanisPRB_ambil');
			$rujukan_peserta_jenisPeserta_keterangan_ambil 	= $this->input->post('rujukan_peserta_jenisPeserta_keterangan_ambil');
			$rujukan_peserta_jenisPeserta_kode_ambil 		= $this->input->post('rujukan_peserta_jenisPeserta_kode_ambil');
			$norm_bpjs 					 					= $this->input->post('rujukan_peserta_mr_noMR_ambil');
			$rujukan_peserta_mr_noMR_ambil 					= $id_perusahaan.$norm_bpjs;
			$rujukan_peserta_mr_noTelepon_ambil 			= $this->input->post('rujukan_peserta_mr_noTelepon_ambil');
			$rujukan_peserta_nama_ambil 					= $this->input->post('rujukan_peserta_nama_ambil');
			$rujukan_peserta_nik_ambil 						= $this->input->post('rujukan_peserta_nik_ambil');
			$rujukan_peserta_noKartu_ambil 					= $this->input->post('rujukan_peserta_noKartu_ambil');
			$rujukan_peserta_pisa_ambil 					= $this->input->post('rujukan_peserta_pisa_ambil');
			$rujukan_peserta_provUmum_kdProvider_ambil 		= $this->input->post('rujukan_peserta_provUmum_kdProvider_ambil');
			$rujukan_peserta_provUmum_nmProvider_ambil 		= $this->input->post('rujukan_peserta_provUmum_nmProvider_ambil');
			$rujukan_peserta_sex_ambil 						= $this->input->post('rujukan_peserta_sex_ambil');
			$rujukan_peserta_statusPeserta_keterangan_ambil = $this->input->post('rujukan_peserta_statusPeserta_keterangan_ambil');
			$rujukan_peserta_statusPeserta_kode_ambil 		= $this->input->post('rujukan_peserta_statusPeserta_kode_ambil');
			$rujukan_peserta_tglCetakKartu_ambil 			= $this->input->post('rujukan_peserta_tglCetakKartu_ambil');
			$rujukan_peserta_tglLahir_ambil 				= $this->input->post('rujukan_peserta_tglLahir_ambil');
			$rujukan_peserta_tglTAT_ambil 					= $this->input->post('rujukan_peserta_tglTAT_ambil');
			$rujukan_peserta_tglTMT_ambil 					= $this->input->post('rujukan_peserta_tglTMT_ambil');
			$rujukan_peserta_umur_umurSaatPelayanan_ambil 	= $this->input->post('rujukan_peserta_umur_umurSaatPelayanan_ambil');
			$rujukan_peserta_umur_umurSekarang_ambil 		= $this->input->post('rujukan_peserta_umur_umurSekarang_ambil');
			$rujukan_peserta_umur_umurSekarang_ambil 		= $this->input->post('rujukan_peserta_umur_umurSekarang_ambil');
			$rujukan_poliRujukan_kode_ambil 				= $this->input->post('rujukan_poliRujukan_kode_ambil');
			$rujukan_poliRujukan_nama_ambil 				= $this->input->post('rujukan_poliRujukan_nama_ambil');
			$rujukan_provPerujuk_kode_ambil 				= $this->input->post('rujukan_provPerujuk_kode_ambil');
			$rujukan_provPerujuk_nama_ambil 				= $this->input->post('rujukan_provPerujuk_nama_ambil');
			$rujukan_tglKunjungan_ambil 					= $this->input->post('rujukan_tglKunjungan_ambil');
			$NORM_sistem   									= $this->input->post('norm_pasien');
			$tempat_lahir   								= $this->input->post('tempat_lahir');
			$pekerjaan      								= $this->input->post('pekerjaan');
        	$alamat         								= $this->input->post('alamat');
        	$provinsi       								= $this->input->post('provinsi');
	        $nama_provinsi  								= $this->input->post('nama_provinsi');
	        $kabupaten      								= $this->input->post('kabupaten');
	        $kecamatan      								= $this->input->post('kecamatan');
	        $desa           								= $this->input->post('desa');
	        $id_dokter      								= $this->input->post('id_dokter');
	        $nodaftar_pasien   								= $this->input->post('nodaftar_pasien');
	        $norm_pasien   									= $this->input->post('norm_pasien');
	        $norm_bpjs   									= $this->input->post('norm_bpjs');
			$tanggal_sekarang 								= date('Y-m-d');
			$jam_sekarang   								= date("h:i:s");
			$id_perusahaan 									= $this->session->userdata('outlet');
			$id_pegawai         							= $this->session->userdata('id_uname');
	        $get_nip_pegawai    							= $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);

	        foreach ($get_nip_pegawai as $key) {
	            $nip_pegawai    = $key->NIP_PEGAWAI;
	            $id_role        = $key->ID_ROLE;
	        }
	        if (empty($rujukan_peserta_tglTAT_ambil)) {
	        	$tgl_TAT = $tanggal_sekarang;
	        }else{
	        	$tgl_TAT = $rujukan_peserta_tglTAT_ambil;
	        }
	        if (empty($rujukan_peserta_tglTMT_ambil)) {
	        	$tgl_TMT = $tanggal_sekarang;
	        }else{
	        	$tgl_TMT = $rujukan_peserta_tglTMT_ambil;
	        }
	        //digunakan untuk mencari No rujukan yang sama
	        $cari_data_nokunjungan_sama = $this->m_api_sep->cari_data_nokunjungan_sama($rujukan_noKunjungan_ambil, $id_perusahaan);
	        if (!empty($cari_data_nokunjungan_sama)) {
	        	foreach ($cari_data_nokunjungan_sama as $key) {
	        		$no_kunjungan 	= $key->noKunjungan;
	        		$nm_pasien 		= $key->nama;
	        		$NORM_p 		= $key->mr_noMR;
	        		$NO_DAFTAR 		= $key->NODAFTAR;
	        	}
	        	echo json_encode("Maaf No Rujukan Pasien Sudah Terdaftar dengan NORM : $NORM_p Dengan Nama : $nm_pasien dan NODAFTAR : $NO_DAFTAR");
	        }else{
	        	//digunakan untuk mencari No rujukan yang sama
		        if ($rujukan_peserta_sex_ambil=='P') {####
		        	$jenis_kelamin = 'Perempuan';
		        }else {
		        	$jenis_kelamin = 'Laki-Laki';
		        }####
		        $get_nodaftar = $this->m_api_sep->get_last_nodaftar($id_perusahaan);####
		        // untuk membuka if nodaftar
		        if (empty($get_nodaftar)) {####
		        	$nodaftar_baru = $id_perusahaan."1";
		        }else {
		        	foreach ($get_nodaftar as $key) {
		        		$last_nodaftar = $key->nodaftar+1;
		        		$nodaftar_baru = $id_perusahaan.$last_nodaftar;
		        	}
		        }####
		        // untuk penutuo if nodaftar
		        //untuk Pembuka if NORM BPJS kosong
				if (empty($rujukan_peserta_mr_noMR_ambil)) {
					$norm_pasien_bpjs = $norm_bpjs;
				}else{
					$get_data_norm_sama = $this->m_api_sep->get_data_norm_sama($rujukan_peserta_mr_noMR_ambil, $id_perusahaan);
					foreach ($get_data_norm_sama as $key) {
						$data_norm = $key->norm;
					}
					if (empty($get_data_norm_sama)) {
						$pot_rm 	= substr($norm_bpjs, 3);
					}else{
						$pot_rm 	= substr($data_norm, 3);
					}
					$norm_pasien_bpjs = $pot_rm;
				}
				//penutup untuk jika noRM BPJS tidak kosong
				// $get_last_norm = $this->m_api_sep->get_last_norm($id_perusahaan);
				// foreach ($get_last_norm as $key) {
				// 	$norm 		= $key->norm;
				// 	//diambil dan dikeluarkan ketika melakukan echo
				// 	$norm_baru 	= $norm+1;
				// }
				$ms_pasien 		= array(
										// 'NORM' 				=> $id_perusahaan.$norm_baru,
										'ID_PERUSAHAAN' 	=> $id_perusahaan,
										'NAMA' 				=> $rujukan_peserta_nama_ambil,
										'NIK' 				=> $rujukan_peserta_nik_ambil,
										'TANGGAL_LAHIR' 	=> $rujukan_peserta_tglLahir_ambil,
										'TELP' 				=> $rujukan_peserta_mr_noTelepon_ambil,
										'NOKPST' 			=> $rujukan_peserta_noKartu_ambil,
										);
				// $simpan_data_pasien = $this->m_api_sep->simpan_data('ms_pasien', $ms_pasien);
				$simpan_data_pasien = $this->m_api_sep->update_data('ms_pasien', $ms_pasien, 'NORM', $id_perusahaan.$norm_pasien_bpjs);
				// update_data($table, $data, $field_table, $id)
				$ms_rujukan_masuk = array(	'ID_PERUSAHAAN' 			=> $id_perusahaan,
											'NODAFTAR' 					=> $nodaftar_baru,
											'NIP_PEGAWAI' 				=> $nip_pegawai,
											'ID_TARIF' 					=> $id_dokter,
											'TANGGAL_INPUT' 			=> $tanggal_sekarang,
											'STATUS' 					=> 1,
											'asalFaskes' 				=> $rujukan_asal_faskes_ambil,
											'diagnosa_kode' 			=> $rujukan_diagnosa_kode_ambil,
											'diagnosa_nama' 			=> $rujukan_diagnosa_nama_ambil,
											'keluhan' 					=> $rujukan_keluhan_ambil,
											'noKunjungan' 				=> $rujukan_noKunjungan_ambil,
											'pelayanan_kode' 			=> $rujukan_pelayanan_kode_ambil,
											'pelayanan_nama' 			=> $rujukan_pelayanan_nama_ambil,
											'cob_noAsuransi' 			=> $peserta_cob_noasuransi_ambil,
											'cob_nmAsuransi' 			=> $peserta_cob_nmasuransi_ambil,
											'cob_tglTAT' 				=> $tgl_TAT,//$peserta_cob_tglTAT_ambil,
											'cob_tglTMT' 				=> $tgl_TMT,//$peserta_cob_tglTMT_ambil,
											'hakKelas_kode' 			=> $peserta_hakKelas_kode_ambil,
											'hakKelas_keterangan' 		=> $peserta_hakKelas_keterangan_ambil,
											'informasi_dinsos' 			=> $rujukan_peserta_informasi_dinsos_ambil,
											'informasi_noSKTM' 			=> $rujukan_peserta_informasi_noSKTM_ambil,
											'informasi_prolanisPRB' 	=> $rujukan_peserta_informasi_prolanisPRB_ambil,
											'jenisPeserta_kode' 		=> $rujukan_peserta_jenisPeserta_kode_ambil,
											'jenisPeserta_keterangan' 	=> $rujukan_peserta_jenisPeserta_keterangan_ambil,
											'mr_noMR' 					=> $id_perusahaan.$norm_pasien_bpjs,
											'mr_noTelepon' 				=> $rujukan_peserta_mr_noTelepon_ambil,
											'nama' 						=> $rujukan_peserta_nama_ambil,
											'nik' 						=> $rujukan_peserta_nik_ambil,
											'noKartu' 					=> $rujukan_peserta_noKartu_ambil,
											'pisa' 						=> $rujukan_peserta_pisa_ambil,
											'provUmum_kdProvider' 		=> $rujukan_peserta_provUmum_kdProvider_ambil,
											'provUmum_nmProvider' 		=> $rujukan_peserta_provUmum_nmProvider_ambil,
											'sex' 						=> $rujukan_peserta_sex_ambil,
											'statusPeserta_kode' 		=> $rujukan_peserta_statusPeserta_kode_ambil,
											'statusPeserta_keterangan' 	=> $rujukan_peserta_statusPeserta_keterangan_ambil,
											'tglCetakKartu' 			=> $rujukan_peserta_tglCetakKartu_ambil,
											'tglLahir' 					=> $rujukan_peserta_tglLahir_ambil,
											'tglTAT' 					=> $rujukan_peserta_tglTAT_ambil,
											'tglTMT' 					=> $rujukan_peserta_tglTMT_ambil,
											'umurSaatPelayanan' 		=> $rujukan_peserta_umur_umurSaatPelayanan_ambil,
											'umurSekarang' 				=> $rujukan_peserta_umur_umurSekarang_ambil,
											'poliRujukan_kode' 			=> $rujukan_poliRujukan_kode_ambil,
											'poliRujukan_nama' 			=> $rujukan_poliRujukan_nama_ambil,
											'provPerujuk_kode' 			=> $rujukan_provPerujuk_kode_ambil,
											'provPerujuk_nama' 			=> $rujukan_provPerujuk_nama_ambil,
											'tglKunjungan' 				=> $rujukan_tglKunjungan_ambil,);
				$simpan_rujukan_db_sim = $this->m_api_sep->simpan_data('rujukan_masuk', $ms_rujukan_masuk);

                // $arrayAngka = array("Satu" => $data_tindakan2, "Dua");
                // $arrayAngka = array("Satu" => array("nama" => "coba", "untuk" => "tes"), "Dua");
                // $gabung["data"] =  $data_tindakan2;
                // array_push($response["data"], $data_tindakan2);
                // echo json_encode($simpan_tindakan);
                // array_push($response["data"], $data_tindakan2);

                echo json_encode($simpan_rujukan_db_sim);
                // echo json_encode('Benar');
	        }
	        
		}
		


	}
?>