<?php
	class Buat_sep extends CI_Controller
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
			$id_rujukan = $this->input->get('id_rujukan');
			$get_data_rujukan_masuk = $this->m_api_sep->get_rujukan_masuk($id_rujukan);
			$data['rujukan_masuk'] = json_encode($get_data_rujukan_masuk);
			$this->template->load('template', 'form_api_bpjs/form_create_sep', $data);
		}
		function ppk_dirujuk(){
	    	$id_perusahaan 		= $this->session->userdata('outlet');
	    	$id_pegawai         = $this->session->userdata('id_uname');
	    	$jenis_faskes 		= $this->input->post('jns_faskes');
	    	$ppkdirujuk 		= $this->input->post('ppkdirujuk');
	        $get_nip_pegawai    = $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);
	        foreach ($get_nip_pegawai as $key) {
	            $nip_pegawai    	= $key->NIP_PEGAWAI;
	            $id_role        	= $key->ID_ROLE;
	        }
	        $get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
	        if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					$secretKey 	= $key->nokey;
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        $param1 = 1;
		        $param2 = "hancok";
		        $uri 					= $url.'/'.$service_name.'/referensi/faskes/'.$ppkdirujuk.'/'.$jenis_faskes;
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		        $get_code_respon 	= $data->metaData->code;
		        $get_keterangan[] 	= $data->metaData->message;
		        if ($get_code_respon!="200") {
		        	echo json_encode($get_keterangan);
		        }else{
		        	$data_respon 	= $data->response;
			        $list_data 		= $data_respon->faskes;
			        $list_data2 	= '';
			        foreach ($list_data as $row) {
			        	$kode_faskes 	= $row->kode;
			        	$nama_faskes 	= $row->nama;
			        	$list_data2[] 	.= $kode_faskes.','.$nama_faskes;
			        	$datates1['data21'] 	= array($list_data2);
			        }
			        echo json_encode($list_data2);
		        }
			}else{
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}
			// echo json_encode($lokasiLaka);
	    }
	    function get_dokter_DPJP(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$jenis_pelayanan 		= 1;//$this->input->post('rdpilih');
			$tgl_pelayanan 			= "2021-07-30";//$this->input->post('txtNoRujukan_0');
			$sub_spesialis 			= "MAT";//$this->input->post('txtNokartu');
			// $cbasalrujukan_0 		= $this->input->post('cbasalrujukan_0');
			// $norujukan 			= "132210010919P000001";
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					// $data 		= '6231';
					$secretKey 	= $key->nokey;
					// $secretKey 	= 'rgcefsmCIy';
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest-1.1";
		        // $uri 					= $url.'/'.$service_name.'/referensi/dokter/pelayanan/'.$jenis_pelayanan.'/tglPelayanan/'.$tgl_pelayanan.'/Spesialis/'.$sub_spesialis;
		        // $uri 					= $url.'/'.$service_name.'/referensi/poli/'.$sub_spesialis;
		        // $uri 					= $url.'/'.$service_name.'/referensi/dokter/pelayanan/2/2021-08-27/'.$sub_spesialis;
		        $uri 					= $url.'/'.$service_name.'/referensi/diagnosa/'.$sub_spesialis;
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        // $urlencodedSignature = urlencode($encodedSignature);
		     //    echo "X-cons-id: " .$data ." ";
   				// echo "X-timestamp:" .$tStamp ." ";
   				// echo "X-signature: " .$encodedSignature;
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		        echo $send;
		    }//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id
		}
		function get_diagnosa(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$diagnosa 				= $this->input->post('diagnosa');
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					$secretKey 	= $key->nokey;
					// $data 		= '6231';
					// $secretKey 	= 'rgcefsmCIy';
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        // $service_name 			= "vclaim-rest";
		        $service_name 			= "vclaim-rest-1.1";
		        $uri 					= $url.'/'.$service_name.'/referensi/diagnosa/'.$diagnosa;
		        // $uri 					= $url.'/'.$service_name.'/referensi/diagnosa/ICU';
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		       	$get_code_respon 	= $data->metaData->code;
		        $get_keterangan[] 	= $data->metaData->message;
	            if ($get_code_respon!="200"){
	                echo json_encode($get_keterangan);
	            }else{
	                $list_diagnosa   = $data->response->diagnosa;
	                foreach ($list_diagnosa as $key) {
	                	$kode_diagnosa 		= $key->kode;
	                	$nama_diagnosa 		= $key->nama;
	                	$list_hasil_data 	= $nama_diagnosa;
	                	$hasil_data[] 		.= $list_hasil_data;
	                }
	                echo json_encode($hasil_data);
	            }
		        // echo $send;
		    }//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id	
		}
		function get_data_poli_rujukan(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$nm_poli 				= $this->input->post('nm_poli');
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					// $data 		= $key->no_token;
					// $secretKey 	= $key->nokey;
					$data 		= '6231';
					$secretKey 	= 'rgcefsmCIy';
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        // $service_name 			= "vclaim-rest";
		        $service_name 			= "vclaim-rest-1.1";
		        $uri 					= $url.'/'.$service_name.'/referensi/poli/'.$nm_poli;
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		       	$get_code_respon 	= $data->metaData->code;
		        $get_keterangan[] 	= $data->metaData->message;
	            if ($get_code_respon!="200"){
	                echo json_encode($get_keterangan);
	            }else{
	                $list_poli   = $data->response->poli;
	                foreach ($list_poli as $key) {
	                	$kode_poli 		= $key->kode;
	                	$nama_poli 		= $key->nama;
	                	$list_hasil_data 	= $kode_poli.' '.$nama_poli;
	                	$hasil_data[] 		.= $list_hasil_data;
	                }
	                echo json_encode($hasil_data);
	            }
		        // echo $send;
		    }//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id	
		}
		function get_jenis_faskes(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$ppkdirujuk 			= $this->input->post('ppkdirujuk');
			$jenis_faskes 			= $this->input->post('jenis_faskes');
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					$secretKey 	= $key->nokey;
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        $uri 					= $url.'/'.$service_name.'/referensi/faskes/'.$ppkdirujuk.'/'.$jenis_faskes;
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		       	$get_code_respon 	= $data->metaData->code;
		        $get_keterangan[] 	= $data->metaData->message;
	            if ($get_code_respon!="200"){
	                echo json_encode($get_keterangan);
	            }else{
	                $list_faskes   = $data->response->faskes;
	                foreach ($list_faskes as $key) {
	                	$kode_faskes 		= $key->kode;
	                	$nama_faskes 		= $key->nama;
	                	$list_hasil_data 	= $kode_faskes.' '.$nama_faskes;
	                	$hasil_data[] 		.= $list_hasil_data;
	                }
	                echo json_encode($hasil_data);
	            }
		        // echo $send;
		    }//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id	
		}
		function insert_sep_ke_BPJS(){
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

	    	$id_rujukan_masuk 				= $this->input->post('id_rujukan');

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
									// 'ID_TARIF' 		=> $txtID_TARIF,
									// 'TANGGAL_INPUT' => tanggal_sekarang,
									// 'STATUS' 		=> 1,
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
			// $klsRawat 	= array('klsRawatHak' => , 'klsRawatNaik' => , 'pembiayaan' => , 'penanggungJawab' =>);
			$rujukan 	= array("asalRujukan" => $cbasalrujukan , "tglRujukan" => $txttglrujukan, "noRujukan" => $txtnorujukan, "ppkRujukan" => $txtkdppkasalrujukan);
			$poli 		= array("tujuan" => $txtkdpoli, "eksekutif" => strval($eksekutif));
			$cob 		= array("cob" => strval($cobch));
			$katarak 	= array("katarak" => strval($katarakch));
										$lokasiLaka = array("kdPropinsi" => $cbpropinsi, "kdKabupaten" => $cbkabupaten, "kdKecamatan" => $cbkecamatan);
								$suplesi = array("suplesi" => "0", "noSepSuplesi" => "0", "lokasiLaka" => $lokasiLaka);
						$penjamin = array(
											// "penjamin" => "1", 
											"tglKejadian" => $txtTglKejadian, 
											"keterangan" => $txtketkejadian, 
											"suplesi" => $suplesi);
			$jaminan 	= array("lakaLantas" => $cbstatuskll, "penjamin" => $penjamin);
			$skdp 		= array("noSurat" => $txtnosuratkontrol, "kodeDPJP" => $txtkddpjp);
			$t_sep 		= array("noKartu" 		=> $txtnokartu_peserta,
								"tglSep" 		=> $txttglsep,
								"ppkPelayanan" 	=> $kd_pelayanan,
								"jnsPelayanan" 	=> $txtjenpel,
								"klsRawat" 		=> $cbKelas,
								"noMR" 			=> $txtnomr,
								"rujukan" 		=> $rujukan,
								"catatan" 		=> $txtcatatan,
								"diagAwal" 		=> $txtkddiagnosa,
								"poli" 			=> $poli,
								"cob" 			=> $cob,
								"katarak" 		=> $katarak,
								"jaminan" 		=> $jaminan,
								"tujuanKunj" 	=> $tujuanKunj,
								"flagProcedure" => $flagProcedure,
								"kdPenunjang" 	=> $kdPenunjang,
								"assesmentPel" 	=> $assesmentPel,
								"skdp" 			=> $skdp,
								"dpjpLayan" 	=> $dpjpLayan,
								"noTelp" 		=> $txtnotelp,
								"user" 			=> "Coba Ws");
	    	$request['request'] = array("t_sep" => $t_sep);	
	    	$data_request = json_encode($request);
	    	$backup_insert_sep = array(	"ID_PERUSAHAAN" => $id_perusahaan, 
	    								'NODAFTAR' 		=> $txt_nodaftaresyst,
	    								'NIP_PEGAWAI' 	=> $nip_pegawai,
	    								// 'ID_TARIF' 		=> $txtID_TARIF,
	    								'TANGGAL_INPUT' => $tanggal_sekarang, 
	    								'STATUS' 		=> 1,
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
	    								"dpjpLayan" 	=> $dpjpLayan,
	    								'noTelp' 		=> $txtnotelp,
	    								"user" 			=> "Coba Ws");
	    	$insert_sep_backup 		= $this->m_api_sep->simpan_data('insert_sep', $backup_insert_sep);
	    	$get_data_insert_sep 	= $this->m_api_sep->get_data_insert_sep($txtnokartu_peserta);
	    	foreach ($get_data_insert_sep as $key) {
	    		$ID_INSERT_SEP = $key->ID_INSERT_SEP;
	    	}
	    	$data_rujukan_masuk = array('STATUS' => 2, 'ID_RUJUKAN' => $id_rujukan_masuk);
	    	$update_data_rujukan_masuk = $this->m_api_sep->update_data('rujukan_masuk', $data_rujukan_masuk, 'ID_RUJUKAN', $id_rujukan_masuk);
	    	
	  //   	$json = json_encode($arr);
			// $url 					= "https://dvlp.bpjs-kesehatan.go.id";
	  //       $service_name 			= "vclaim-rest";
	  //       $uri = $url."/".$service_name."/SEP/1.1/insert";
			// // Computes the timestamp
	  //       date_default_timezone_set('UTC');
	  //       $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
	  //       // Computes the signature by hashing the salt with the secret key as the key
	  //       $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	  //       // base64 encode…
	  //       $encodedSignature = base64_encode($signature);
	  //       // urlencode…
	  //       // $urlencodedSignature = urlencode($encodedSignature);
	  //       $ch = curl_init();
	  //       curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  //           "X-cons-id: $data", 
	  //           "X-timestamp: $tStamp", 
	  //           "X-signature: $encodedSignature"
	  //       ));
	  //       curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	  //       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  //       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	  //       curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
	  //       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  //       curl_setopt($ch, CURLOPT_URL, $uri);

	  //       $send = curl_exec($ch);
	  //       ////###############
	        $peserta    = array(
			                    'asuransi'  => "-",
			                    'hakKelas'  => "Kelas 1",
			                    'jnsPeserta'=> "PNS PUSAT",
			                    'kelamin'   => "Laki-Laki",
			                    'nama'      => "ZIYADUL",
			                    'noKartu'   => "0001112230666",
			                    'noMr'      => "123456",
			                    'tglLahir'  => "2008-02-05"
			                    );
			$informasi = array(
			                    'Dinsos'      => null,
			                    'prolanisPRB' => null,
			                    'noSKTM'      => null
			                  );
			$sep = array( 
			              'catatan'       => "test",
			              'diagnosa'      => "A00.1 - Cholera due to Vibrio cholerae 01, biovar eltor",
			              'jnsPelayanan'  => "R.Inap",
			              'kelasRawat'    => "1",
			              'noSep'         => "0301R0011117V000008",
			              'penjamin'      => "-",
			              'peserta'       => $peserta,
			              'informasi'     => $informasi,
			              'poli'          => "MATA",
			              'poliEksekutif' => "0",
			              'tglSep'        => "2017-10-12",
			            );
			$data_respon = array(
			                      'metaData' => array('code' => "200", 'message' => "Sukses"),
			                      'response' => array('sep' => $sep),
			                    );
	        ######################
	        $send = json_encode($data_respon);
	        if ($send === false) {
	            die('Error fecthing data: ' .curl_error($ch));
	        }else{
				// $data_reespon 		= json_encode($send);
				$decode 			= json_decode($send);
				$meta 				= $decode->metaData;
				$m_code 			= $meta->code;
				$m_message 			= $meta->message;
				if ($m_code==200) {
					$tes 				= $decode->response;
					$coba 				= $tes->sep;
					$d_catatan 			= $coba->catatan;
					$d_diagnosa			= $coba->diagnosa;
					$d_jnsPelayanan		= $coba->jnsPelayanan;
					$d_kelasRawat		= $coba->kelasRawat;
					$d_noSep			= $coba->noSep;
					$d_penjamin			= $coba->penjamin;
					$d_peserta			= $coba->peserta;
					$d_asuransi			= $d_peserta->asuransi;
					$d_hakKelas			= $d_peserta->hakKelas;
					$d_jnsPeserta		= $d_peserta->jnsPeserta;
					$d_kelamin			= $d_peserta->kelamin;
					$d_nama				= $d_peserta->nama;
					$d_noKartu			= $d_peserta->noKartu;
					$d_noMr				= $d_peserta->noMr;
					$d_tglLahir			= $d_peserta->tglLahir;
					// $d_tglLahir			= $d_peserta->inform;
					$d_informasi		= $coba->informasi;
					$d_Dinsos			= $d_informasi->Dinsos;
					$d_prolanisPRB		= $d_informasi->prolanisPRB;
					$d_noSKTM			= $d_informasi->noSKTM;
					$d_poli				= $coba->poli;
					$d_poliEksekutif	= $coba->poliEksekutif;
					$d_tglSep			= $coba->tglSep;
					$data_sep 			= array('ID_PERUSAHAAN' => $id_perusahaan,
												'ID_INSERT_SEP' => $ID_INSERT_SEP,
												'NODAFTAR' 		=> $txt_nodaftaresyst,
												'NIP_PEGAWAI' 	=> $nip_pegawai,
												// 'ID_TARIF' 		=> $txtID_TARIF,
												'TANGGAL_INPUT' => $tanggal_sekarang,
												'STATUS' 		=> 1,
												'catatan' 		=> $d_catatan,
												'diagnosa' 		=> $d_diagnosa,
												'jnsPelayanan' 	=> $d_jnsPelayanan,
												'kelasRawat' 	=> $d_kelasRawat,
												'noSep' 		=> $d_noSep,
												'penjamin' 		=> $d_penjamin,
												'asuransi' 		=> $d_asuransi,
												'hakKelas' 		=> $d_hakKelas,
												'jnsPeserta' 	=> $d_jnsPeserta,
												'kelamin' 		=> $d_kelamin,
												'nama' 			=> $d_nama,
												'noKartu' 		=> $d_noKartu,
												'noMr' 			=> $d_noMr,
												'tglLahir' 		=> $d_tglLahir,
												'Dinsos' 		=> $d_Dinsos,
												'prolanisPRB' 	=> $d_prolanisPRB,
												'noSKTM' 		=> $d_noSKTM,
												'poli' 			=> $d_poli,
												'poliEksekutif' => $d_poliEksekutif,
												'tglSep' 		=> $d_tglSep);
					$respon_insert_sep_backup 	= $this->m_api_sep->simpan_data('respon_insert_sep', $data_sep);
					// $respon_insert_sep_backup = $this->m_api_sep->simpan_data('respon_insert_sep', $data_sep);
					// echo json_encode($respon_insert_sep_backup);
					$data_hasil['keterangan'] 	= $respon_insert_sep_backup;
					$data_hasil['nosep'] 		= $d_noSep;
					echo json_encode($data_hasil);
				}else{
					echo json_encode($m_message);
					// echo json_encode($data_sep);
				}
	        }
	    	// echo json_encode($data_sep);
	    }


	}
?>