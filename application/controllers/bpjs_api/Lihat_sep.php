<?php
	class Lihat_sep extends CI_Controller
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
			$id_rujukan 			= $this->input->get('id_rujukan');
			$noka_peserta 			= $this->input->get('noka_peserta');
			$get_data_rujukan_masuk = $this->m_api_sep->get_rujukan_masuk($id_rujukan);
			$data['rujukan_masuk'] 	= json_encode($get_data_rujukan_masuk);
			$get_data_insert_sep 	= $this->m_api_sep->get_data_insert_sep($noka_peserta);
			foreach ($get_data_insert_sep as $key) {
				$ID_INSERT_SEP = $key->ID_INSERT_SEP;
			}
			$data['insert_sep'] 	= json_encode($get_data_insert_sep);
			$get_data_sep 			= $this->m_api_sep->get_data_sep($ID_INSERT_SEP);
			$data['data_sep'] 		= json_encode($get_data_sep);
			$this->template->load('template', 'form_api_bpjs/form_lihat_sep', $data);
		}
		function cetak_sep(){
			$no_Sep = $this->input->get('no_Sep');
			// $get_data_rujukan_masuk = $this->m_api_sep->get_rujukan_masuk($id_rujukan);
			// $data['rujukan_masuk'] = json_encode($get_data_rujukan_masuk);
			// $this->template->load('template', 'form_api_bpjs/form_create_sep', $data);
			$this->template->load('template', 'form_api_bpjs/vcetak_sep');
		}
		function update_data_sep(){
			$id_insert_sep 					= $this->input->post('id_insert_sep');
	    	$txtnokartu_peserta 			= $this->input->post('txtnokartu_peserta');
	    	$txtprsklaimsep 				= $this->input->post('txtprsklaimsep');
	    	$chkpoliesekutif 				= $this->input->post('chkpoliesekutif');
	    	$txtnmpoli 						= $this->input->post('txtnmpoli');
	    	$txtkdpoli 						= $this->input->post('txtkdpoli');
	    	$cbasalrujukan 					= $this->input->post('cbasalrujukan');
	    	$txtppkasalrujukan 				= $this->input->post('txtppkasalrujukan');
	    	$txtkdppkasalrujukan 			= $this->input->post('txtkdppkasalrujukan');
	    	$txttglrujukan 					= $this->input->post('txttglrujukan');
	    	$txtnorujukan 					= $this->input->post('txtnorujukan');
	    	$lblkontrol 					= $this->input->post('lblkontrol');
	    	$txtnosuratkontrol 				= $this->input->post('txtnosuratkontrol');
	    	$txtidkontrol 					= $this->input->post('txtidkontrol');
	    	$txtnosuratkontrollama 			= $this->input->post('txtnosuratkontrollama');
	    	$txtpoliasalkontrol 			= $this->input->post('txtpoliasalkontrol');
	    	$txttglsepasalkontrol 			= $this->input->post('txttglsepasalkontrol');
	    	$txtnmdpjp 						= $this->input->post('txtnmdpjp');
	    	$txtkddpjp 						= $this->input->post('txtkddpjp');
	    	$txttglsep 						= $this->input->post('txttglsep');
	    	$txtnomr 						= $this->input->post('txtnomr');
	    	$chkCOB 						= $this->input->post('chkCOB');
	    	$cbKelas 						= $this->input->post('cbKelas');
	    	$txtnmdiagnosa 					= $this->input->post('txtnmdiagnosa');
	    	$txtkddiagnosa 					= $this->input->post('txtkddiagnosa');
	    	$txtnotelp 						= $this->input->post('txtnotelp');
	    	$txtcatatan 					= $this->input->post('txtcatatan');
	    	$chkkatarak 					= $this->input->post('chkkatarak');
	    	$cbstatuskll 					= $this->input->post('cbstatuskll');
	    	$txtkasuslaka 					= $this->input->post('txtkasuslaka');
	    	$cbpropinsi 					= $this->input->post('cbpropinsi');
	    	$txtjenpel 						= $this->input->post('txtjenpel');
	    	$txtID_TARIF 					= $this->input->post('txtID_TARIF');
	    	$txtTglKejadian 				= $this->input->post('txtTglKejadian');
	    	$cbkabupaten 					= $this->input->post('cbkabupaten');
	    	$cbkecamatan 					= $this->input->post('cbkecamatan');
	    	$txtketkejadian 				= $this->input->post('txtketkejadian');
	    	$txt_normesyst 					= $this->input->post('txt_normesyst');
	    	$txt_nodaftaresyst 				= $this->input->post('txt_nodaftaresyst');
	    	$tujuanKunj 					= $this->input->post('tujuanKunj');
	    	$flagProcedure 					= $this->input->post('flagProcedure');
	    	$kdPenunjang 					= $this->input->post('kdPenunjang');
	    	$assesmentPel 					= $this->input->post('assesmentPel');
	    	$dpjpLayan 						= $this->input->post('dpjpLayan');

	    	$nmdpjpLayan 					= $this->input->post('nmdpjpLayan');

	    	$tanggal_sekarang 				= date('Y-m-d');
	    	$id_perusahaan      			= $this->session->userdata('outlet');
	        $id_pegawai         			= $this->session->userdata('id_uname');
	        $get_nip_pegawai    			= $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);
	        foreach ($get_nip_pegawai as $key) {
	            $nip_pegawai    = $key->NIP_PEGAWAI;
	            $id_role        = $key->ID_ROLE;
	        }
	        $id_perusahaan 			= $this->session->userdata('outlet');
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
	    	foreach ($get_token_bpjs->result() as $key) {
				$data 			= $key->no_token;
				$secretKey 		= $key->nokey;
				$kd_pelayanan 	= $key->kd_pelayanan;
			}
	    							// 'NIP_PEGAWAI' 	=> $nip_pegawai,
	    	if (empty($chkpoliesekutif)) {
	    		$eksekutif = 0;
	    	}else{
	    		$eksekutif = 1;
	    	}
			if (empty($chkCOB)) {
				$cobch = 0;
			}else{
				$cobch = 1;
			}
			if (empty($chkkatarak)) {
				$katarakch = 0;
			}else{
				$katarakch = 1;
			}
			// $rujukan 	= array("asalRujukan" => $cbasalrujukan , "tglRujukan" => $txttglrujukan, "noRujukan" => $txtnorujukan, "ppkRujukan" => $txtkdppkasalrujukan);
			$poli 		= array("eksekutif" => strval($eksekutif), 'tujuan' => 'IGD');
			$cob 		= array("cob" => $cobch);
			$katarak 	= array("katarak" => strval($katarakch));
										$lokasiLaka = array("kdPropinsi" => $cbpropinsi, "kdKabupaten" => $cbkabupaten, "kdKecamatan" => $cbkecamatan);
								$suplesi = array("suplesi" => "0", "noSepSuplesi" => "0", "lokasiLaka" => $lokasiLaka);
						$penjamin = array(
											// "penjamin" => "1", 
											"tglKejadian" => $txtTglKejadian, 
											"keterangan" => $txtketkejadian, 
											"suplesi" => $suplesi);
			$jaminan 	= array("lakaLantas" => $cbstatuskll, "penjamin" => $penjamin);
			// $skdp 		= array("noSurat" => $txtnosuratkontrol, "kodeDPJP" => $txtnmdpjp);

			// meninggalan 
			$backup_insert_sep = array(	
	    								'noKartu' 		=> $txtnokartu_peserta,
	    								'tglSep' 		=> $txttglsep,
	    								'ppkPelayanan' 	=> $txtkdppkasalrujukan,
	    								'jnsPelayanan' 	=> $txtjenpel,
	    								'klsRawat' 		=> $cbKelas,
	    								'noMR' 			=> $txt_normesyst,
	    								'asalRujukan' 	=> $cbasalrujukan,
	    								'tglRujukan' 	=> $txttglrujukan,
	    								'noRujukan' 	=> $txtnorujukan,
	    								'ppkRujukan' 	=> $txtkdppkasalrujukan,
	    								'catatan' 		=> $txtcatatan,
	    								'nmdiagnosa'	=> $txtnmdiagnosa,
	    								'diagAwal' 		=> $txtkddiagnosa,
	    								'tujuan' 		=> $txtkdpoli,
	    								'eksekutif'		=> $eksekutif,
	    								'cob' 			=> $cobch,
	    								'katarak' 		=> $katarakch,
	    								'lakaLantas' 	=> $cbstatuskll,
	    								// 'penjamin' 		=> "1",
	    								'tglKejadian' 	=> $txtTglKejadian,
	    								'keterangan' 	=> $txtketkejadian,
	    								'suplesi' 		=> "0",
	    								"tujuanKunj" 	=> $tujuanKunj,
										"flagProcedure" => $flagProcedure,
										"kdPenunjang" 	=> $kdPenunjang,
										"assesmentPel" 	=> $assesmentPel,
	    								'noSepSuplesi' 	=> "0",
	    								'kdPropinsi' 	=> $cbpropinsi,
	    								'kdKabupaten' 	=> $cbkabupaten,
	    								'kdKecamatan' 	=> $cbkecamatan,
	    								'noSurat' 		=> $txtnosuratkontrol,
	    								'kodeDPJP' 		=> $txtnmdpjp,
	    								"dpjpLayan" 	=> $nmdpjpLayan,
	    								'noTelp' 		=> $txtnotelp,
	    								"user" 			=> "Coba Ws");
			$update_data_insert_sep = $this->m_api_sep->update_data('insert_sep', $backup_insert_sep, 'ID_INSERT_SEP', $id_insert_sep);

	    	$t_sep = array("noSep" 		=> "0196S0010620V000001",
							"klsRawat" 	=> $cbKelas,
							"noMR" 		=> $txtnomr,
							// "rujukan" 	=> $rujukan,
							"catatan" 	=> $txtcatatan,
							"diagAwal" 	=> $txtkddiagnosa,
							"poli" 		=> $poli,
							"cob" 		=> $cob,
							"katarak" 	=> $katarak,
							// "skdp" 		=> $skdp,
							"jaminan" 	=> $jaminan,
							"dpjpLayan" => $dpjpLayan,
							"noTelp" 	=> $txtnotelp,
							"user" 		=> "Coba Ws");
	    	$request['request'] = array("t_sep" => $t_sep);
	    	$data_request = json_encode($request);

	    	////
	    	$url 					= "https://dvlp.bpjs-kesehatan.go.id";
	        $service_name 			= "vclaim-rest";
	        $uri = $url."/".$service_name."/SEP/1.1/update";

			// Computes the timestamp
	        // date_default_timezone_set('UTC');
	        // $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
	        // // Computes the signature by hashing the salt with the secret key as the key
	        // $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	        // // base64 encode…
	        // $encodedSignature = base64_encode($signature);
	        // // urlencode…
	        // // $urlencodedSignature = urlencode($encodedSignature);
	        // $ch = curl_init();
	        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        //     "X-cons-id: $data", 
	        //     "X-timestamp: $tStamp", 
	        //     "X-signature: $encodedSignature",
	        //     'Content-Type:Application/x-www-form-urlencoded',
	        // ));
	        // curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
	        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        // curl_setopt($ch, CURLOPT_URL, $uri);

	        // $send = curl_exec($ch);
	        ////
	        // echo $send;

	        #########################
	        $metaData 		= array('code' => '200', 'message' => 'Sukses');
	        $data_respon 	= array('metaData' => $metaData, 'response' => '1101R0070420V000017');
	        #########################
	        // $decode 			= json_decode($data_respon);

	        $send = json_encode($data_respon);
	        if ($send === false) {
	            die('Error fecthing data: ' .curl_error($ch));
	        }else{
	        	$decode 			= json_decode($send);
				$meta 				= $decode->metaData;
				$m_code 			= $meta->code;
				$m_message 			= $meta->message;
				$response 			= $decode->response;
				$data_respon_insert_sep = array('noSep' => $response);
				if ($m_code==200) {
					$update_respon_insert_sep = $this->m_api_sep->update_data('respon_insert_sep', $data_respon_insert_sep, 'ID_INSERT_SEP', $id_insert_sep);
					if ($update_respon_insert_sep=='Benar') {
						$data_hasil['keterangan'] 	= $update_respon_insert_sep;
						$data_hasil['nosep'] 		= $response;
						echo json_encode($data_hasil);
					}else{
						echo json_encode($update_respon_insert_sep);
					}
					// echo json_encode($backup_insert_sep);
				}else{
					echo json_encode($m_message);
					// echo json_encode($backup_insert_sep);
				}//
	        }
	        // echo json_encode($data_respon);
	    	
	    }
	    function delete_nosep(){
	    	// $no_sep = $this->input->post('no_sep');
	    	// $user 	= $this->input->post('user');
	    	$nodaftar 		= $this->input->post('nodaftar');
	    	$id_perusahaan 	= $this->session->userdata('outlet');
	    	$hsl_no_sep = '0196S0010620V000001';
	    	$no_sep = (int)$hsl_no_sep;
	    	$user 	= 'Coba Ws';

	    	$nodaftar_lengkap = $id_perusahaan.$nodaftar;

	    	// echo json_encode($nodaftar_lengkap);

	    	$tanggal_sekarang 				= date('Y-m-d');
	    	$id_perusahaan      			= $this->session->userdata('outlet');
	        $id_pegawai         			= $this->session->userdata('id_uname');
	        $get_nip_pegawai    			= $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);
	        foreach ($get_nip_pegawai as $key) {
	            $nip_pegawai    = $key->NIP_PEGAWAI;
	            $id_role        = $key->ID_ROLE;
	        }
	        
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
	    	foreach ($get_token_bpjs->result() as $key) {
				$data 			= $key->no_token;
				$secretKey 		= $key->nokey;
				$kd_pelayanan 	= $key->kd_pelayanan;
			}
			$get_px_by_nodaftar = $this->m_api_sep->get_pasien_nodaftar();



	    	$data 			= array('noSep' => $no_sep, 'user' => $user);
	    	$t_sep 			= array('t_sep' => $data);
	    	$data_request 	= array('request' => $t_sep);
	    	// echo json_encode($data_request);
	    	
	    	$url 					= "https://dvlp.bpjs-kesehatan.go.id";
	        $service_name 			= "vclaim-rest";
	        $uri = $url."/".$service_name."/SEP/Delete";
	        // $uri = $url."/".$service_name."/SEP/Delete";

			// Computes the timestamp
	        date_default_timezone_set('UTC');
	        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
	        // Computes the signature by hashing the salt with the secret key as the key
	        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	        // base64 encode…
	        $encodedSignature = base64_encode($signature);
	        // urlencode…
	        // $urlencodedSignature = urlencode($encodedSignature);

	        // $ch = curl_init();
	        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        //     "X-cons-id: $data", 
	        //     "X-timestamp: $tStamp", 
	        //     "X-signature: $encodedSignature"
	        // ));
	        // curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
	        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        // curl_setopt($ch, CURLOPT_URL, $uri);
	        // $send = curl_exec($ch);

	     //    $ch = curl_init();
	     //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    // curl_setopt($ch, CURLOPT_URL, $uri);
		    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
		    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    // $send = curl_exec($ch);
		    
		    // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		    // curl_close($ch);

	        if ($send === false) {
	            die('Error fecthing data: ' .curl_error($ch));
	        }else{
	        	$decode 			= json_decode($send);
				$meta 				= $decode->metaData;
				$m_code 			= $meta->code;
				$m_message 			= $meta->message;
				if ($m_code==200) {
					$data_status_rujukan_masuk 				= array('STATUS' => 0);
			    	$update_status_data_rujukan_masuk 		= $this->m_api_sep->update_data('rujukan_masuk', $data_status_rujukan_masuk, 'NODAFTAR', $nodaftar_lengkap);
			    	$update_status_data_respon_insert_sep 	= $this->m_api_sep->update_data('respon_insert_sep', $data_status_rujukan_masuk, 'NODAFTAR', $nodaftar_lengkap);
			    	// $data_status_pendaftaran		 		= array('STATUS_PENDAFTARAN' => 0);
			    	// $update_status_ts_pendaftaran 			= $this->m_api_sep->update_data('ts_pendaftaran', $data_status_pendaftaran, 'NODAFTAR', $nodaftar_lengkap);
			    	// $data_transaksi 						= array('KODE_STATUS' => 0);
			    	// $update_status_data_status_perawatan	= $this->m_api_sep->update_data('ts_biayaperawatan', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	// $update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_obat', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	// $update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_optik', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
					// echo json_encode($m_message);
					echo $send;
				}else{
					// echo json_encode($m_message);
					echo $send;
				}
	        }
	    	// echo json_encode($send);
	    }

	    function cetak_sep_pdf(){
	        $no_sep            = $this->input->get('no_sep');
	        // $nodaftar       = base64_decode($get);
	        $tgl_sekarang   = Date('Y-m-d');
	        $tgl_panjang    = Date('d-M-Y');
	        $id_perusahaan  = $this->session->userdata('outlet');
	        $get_nosep    = $this->m_api_sep->get_data_cetak_sep_pasien($no_sep);
	        foreach ($get_nosep as $row) {
	            $ID_RESPON_SEP  = $row->ID_RESPON_SEP;
	            $ID_PERUSAHAAN  = $row->ID_PERUSAHAAN;
	            $NODAFTAR       = $row->NODAFTAR;
	            $NIP_PEGAWAI    = $row->NIP_PEGAWAI;
	            $ID_TARIF       = $row->ID_TARIF;
	            $TANGGAL_INPUT  = $row->TANGGAL_INPUT;
	            $STATUS      	= $row->STATUS;
	            $catatan       	= $row->catatan;
	            $diagnosa      	= $row->diagnosa;
	            $jnsPelayanan   = $row->jnsPelayanan;
	            $kelasRawat     = $row->kelasRawat;
	            $noSep      	= $row->noSep;
	            $penjamin      	= $row->penjamin;
	            $asuransi       = $row->asuransi;
	            $hakKelas    	= $row->hakKelas;
	            $jnsPeserta    	= $row->jnsPeserta;
	            $kelamin     	= $row->kelamin;
	            $nama     		= $row->nama;
	            $noKartu     	= $row->noKartu;
	            $noMr     		= $row->noMr;
	            $tglLahir     	= $row->tglLahir;
	            $Dinsos     	= $row->Dinsos;
	            $prolanisPRB    = $row->prolanisPRB;
	            $noSKTM     	= $row->noSKTM;
	            $poli     		= $row->poli;
	            $poliEksekutif  = $row->poliEksekutif;
	            $tglSep     	= $row->tglSep;
	        }
	        // digunakan untuk meload librari pdf

	        $this->load->library('cfpdf');
	        // digunakan sebagai pembuka untuk membuat halaman pdf
	        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
	        // $pdf = new FPDF('P', 'mm', 'A4');//
	        // $pdf = new FPDF('L', 'mm', array(210, 95));
	        $id_outlet = $this->session->userdata('outlet');
	         if ($id_outlet=='SPJ') {
	             $pdf = new FPDF('P', 'mm', array(210, 210));
	         }else{
	            $pdf = new FPDF('L', 'mm', array(210, 95));
	         }
	        // $pdf = new FPDF('P', 'mm', array(210, 210));
	        // $pdf->SetMargins(6,5,3, 6);
	        $pdf->setTopMargin(6);
	        $pdf->setLeftMargin(10);
	        $pdf->setRightMargin(10);
	        $pdf->SetAutoPageBreak(false); // I'll have to add page breaks myself 
	        $pdf->SetAutoPageBreak(true, 1); // Pages with auto-break, with a bottom margin of 40 pts.
	        // $pdf->setBottomMargin(5);
	        $pdf->SetFont('helvetica','B', 11);
	        // digunakan untuk mengeadd halaman
	        $pdf->AddPage();

	        //untuk menampilkan gambar
	        $pdf->Image(base_url('./assets/dist/img/logo-bpjs.png'),10,3,48,8);
	        // untuk judul
	        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
	        // $pdf->SetFont('Arial','B',10);
	        // mencetak string 
	        // $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
	        $pdf->SetFont('Arial','',11);
	        $pdf->Cell(190,-2,'SURAT ELEGIBILITAS PESERTA',0,1,'C');
	        $pdf->SetFont('Arial','',11);
	        $pdf->Cell(190,10,'KLINIK MATA EDC GROUP',0,1,'C');
	        // $pdf->SetFont('Arial','',10);
	        // $pdf->Cell(190,4,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
	        //pindah baris
	        // $pdf->Ln(2);
	        //buat garis horisontal
	        // $pdf->SetLineWidth(0.5);
	        // $pdf->Line(10,20,200,20);
	        // $pdf->SetLineWidth(0);
	        // $pdf->Line(10,20,200,20);

	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->setfontsize(9);
	        // $pdf->Cell('170', '3', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->setfontsize(8);
	        // $pdf->Cell('20', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
	        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->setfontsize(5);
	        // untuk menurunkan table
	        $pdf->cell(5, 1, '', '', 1);

	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->setfontsize(9);
	        $pdf->Cell('30', '5', 'No. SEP', '0', 0, 'L');
	        $pdf->Cell('60', '5', ': '.$noSep.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Tgl. SEP', '0', 0, 'L');
	        $pdf->Cell('60', '5', ': '.$tglSep.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'No Kartu', '0', 0, 'L');
	        $pdf->Cell('80', '5', ': '.$noKartu.'', '0', 0, 'L');
	        $pdf->Cell('20', '5', 'Peserta', '0', 0, 'L');
	        $pdf->Cell('55', '5', ': '.$jnsPeserta.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Nama Peserta', '0', 0, 'L');
	        $pdf->Cell('60', '5', ': '.$nama.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Tgl. Lahir', '0', 0, 'L');
	        $pdf->Cell('80', '5', ': '.$tglLahir.'', '0', 0, 'L');
	        $pdf->Cell('20', '5', 'COB', '0', 0, 'L');
	        $pdf->Cell('55', '5', ': ', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Jns. Kelamin', '0', 0, 'L');
	        $pdf->Cell('80', '5', ': '.$kelamin.'', '0', 0, 'L');
	        $pdf->Cell('20', '5', 'Jns. Rawat	', '0', 0, 'L');
	        $pdf->Cell('55', '5', ': '.$jnsPelayanan.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Poli Tujuan', '0', 0, 'L');
	        $pdf->Cell('80', '5', ': '.$poli.'', '0', 0, 'L');
	        $pdf->Cell('20', '5', 'Kls. Rawat', '0', 0, 'L');
	        $pdf->Cell('55', '5', ': '.$kelasRawat.'', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Asal Faskes Tk. I', '0', 0, 'L');
	        $pdf->Cell('60', '5', ': ', '0', 1, 'L');

	        $pdf->Cell('30', '5', 'Diagnosa Awal', '0', 0, 'L');
	        $pdf->Cell('100', '5', ': '.$diagnosa.'', '0', 0, 'L');
	        $pdf->Cell('35', '5', 'Pasien/', '0', 0, 'L');
	        $pdf->Cell('55', '5', 'Petugas', '0', 1, 'L');
	        
	        $pdf->Cell('30', '5', 'Catatan', '0', 0, 'L');
	        $pdf->Cell('100', '5', ': '.$catatan.'', '0', 0, 'L');
	        $pdf->Cell('35', '5', 'Keluarga Pasien	', '0', 0, 'L');
	        $pdf->Cell('55', '5', 'BPJS Kesehatan', '0', 1, 'L');

	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->setfontsize(8);

	        $pdf->SetFont('Arial', 'I', 'L');
	        $pdf->Cell('26', '4', '*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan', '0', 0, 'L');
	        $pdf->cell(155, 4, '', 0, 1, 'L');

	        $pdf->Cell('26', '4', '*SEP bukan sebagai bukti penjamin peserta', '0', 0, 'L');
	        $pdf->cell(155, 4, '', 0, 1, 'L');

	        $pdf->SetFont('Arial', '', 'L');
	        $pdf->Cell('130', '4', ' ', '0', 0, 'L');
	        $pdf->cell(27, 4, '________________', 0, 0, 'C');
	        $pdf->cell(9, 4, '', 0, 0, 'C');
	        $pdf->cell(27, 4, '________________', 0, 1, 'C');

	        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
	        $pdf->cell(45, 4, '', 0, 1, 'C');

	        // $pdf->Cell('140', '5', ' ', '1', 0, 'L');
	        // $pdf->cell(45, 5, '', 1, 1, 'C');

	        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
	        $pdf->cell(45, 4, ' ', 0, 1, 'C');

	        // sebagai penutup untuk menampilkan halaman pdf
	        $pdf->Output();
	    }


	}
?>