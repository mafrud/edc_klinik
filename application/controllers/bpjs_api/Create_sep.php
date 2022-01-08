<?php
	class Create_sep extends CI_Controller
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
			$this->template->load('template', 'form_api_bpjs/form_sep');
		}
		function get_pasien_hari_ini(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$tanggal_sekarang 		= date('Y-m-d');
			$get_pasien_hari_ini 	= $this->m_api_sep->get_pasien_hari_ini($id_perusahaan, $tanggal_sekarang);
			foreach ($get_pasien_hari_ini as $key) {
				$pot_rm 	= substr($key->norm, 3);
				$pot_pen 	= substr($key->no_pendaftaran, 3);
				$data_pasien_bpjs[] = array('id' 				=> $key->id,
											'tgl_daftar' 		=> $key->tgl_daftar,
											'norm_pot' 			=> $pot_rm,
											'norm' 				=> $key->norm,
											'no_pendaftaran' 	=> $key->no_pendaftaran,
											'pot_nopendaftar' 	=> $pot_pen,
											'nm_pasien' 		=> $key->nm_pasien,
											'jk' 				=> $key->jk,
											'no_rujuk' 			=> $key->no_rujuk,
											'no_kpst' 			=> $key->no_kpst);
			}
			$response = array('data' => $data_pasien_bpjs);
			// contoh pemanggilan function di dalam function di controller codeigniter
 			$data = $this->data_pasien();
			// $data = "tes";
			echo json_encode($response);
		}
		public function data_pasien(){
			$data = "ujiCoba Contoh Public function";
			return $data;
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
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					$secretKey 	= $key->nokey;
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        if ($jenis_input_rujukan==2) {
		        	if ($cbasalrujukan_0==1) {
		        		$uri = $url."/".$service_name."/Rujukan/".$norujukan;
		        	}else{
		        		$uri = $url."/".$service_name."/Rujukan/RS/".$norujukan;
		        	}
		        }else {
		        	$uri = $url."/".$service_name."/Rujukan/Peserta/".$txtNokartu;
		        }
				// Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        // Computes the signature by hashing the salt with the secret key as the key
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        // base64 encode…
		        $encodedSignature = base64_encode($signature);
		        // urlencode…
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
		        echo $send;
			}//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id
		}
		function get_dokter_DPJP(){
			// $id_perusahaan 			= $this->session->userdata('outlet');
			$id_perusahaan 			= 'BKL';
			$jenis_pelayanan 		= 1;//$this->input->post('rdpilih');
			$tgl_pelayanan 			= "2021-09-08";//$this->input->post('txtNoRujukan_0');
			$sub_spesialis 			= "MAT";//$this->input->post('txtNokartu');
			// $cbasalrujukan_0 		= $this->input->post('cbasalrujukan_0');
			// $norujukan 			= "132210010919P000001";
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					// $data 		= $key->no_token;\
					// $secretKey 	= $key->nokey;
					$data 		= '18301';
					$secretKey 	= '2kFBD1DED4';
				}
				$url 					= "https://apijkn-dev.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest-dev";
		        // $uri 					= $url.'/'.$service_name.'/referensi/dokter/pelayanan/'.$jenis_pelayanan.'/tglPelayanan/'.$tgl_pelayanan.'/Spesialis/'.$sub_spesialis;
		        // $uri 					= $url.'/'.$service_name.'/referensi/poli/'.$sub_spesialis;
		        // $uri 					= $url.'/'.$service_name.'/referensi/dokter/pelayanan/2/2021-08-27/'.$sub_spesialis;
		        // $uri 					= $url.'/'.$service_name.'/referensi/poli/'.$sub_spesialis;
		        $uri 					= $url.'/'.$service_name.'/referensi/propinsi';
		        // Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        $encodedSignature = base64_encode($signature);
		        $urlencodedSignature = urlencode($encodedSignature);
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

		  //       $headers=array(
				// 		        'X-cons-id:'.$data.'',
				// 		        'X-timestamp:'.$tStamp.'',
				// 		        'X-signature:'.$encodedSignature.'',
				// 		        'Content-Type:application/json'
				// 		        );
		  //       $ch=curl_init();
				// curl_setopt($ch,CURLOPT_URL,$uri);
				// curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
				// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				// curl_setopt($ch,CURLOPT_TIMEOUT,3);
				// curl_setopt($ch,CURLOPT_HTTPGET,1);
				// curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

				// $send=curl_exec($ch);

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
			// $diagnosa 				= $this->input->post('diagnosa');
			$diagnosa 				= 'A04';
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					// $data 		= $key->no_token;
					// $secretKey 	= $key->nokey;
				}
				$data 		= '6231';
				$secretKey 	= 'U38JIZwo4X';
				$url 					= "https://apijkn-dev.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest-dev";
		        $uri 					= $url.'/'.$service_name.'/referensi/diagnosa/'.$diagnosa;
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
		        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

		        $send = curl_exec($ch);

		        if ($send === false) {
		            die('Error fecthing data: ' .curl_error($ch));
		        }
		        $data = json_decode($send);
		       	// $get_code_respon 	= $data->metaData->code;
		        // $get_keterangan[] 	= $data->metaData->message;
	         //    if ($get_code_respon!="200"){
	         //        echo json_encode($get_keterangan);
	         //    }else{
	         //        $list_diagnosa   = $data->response->diagnosa;
	         //        foreach ($list_diagnosa as $key) {
	         //        	$kode_diagnosa 		= $key->kode;
	         //        	$nama_diagnosa 		= $key->nama;
	         //        	$list_hasil_data 	= $nama_diagnosa;
	         //        	$hasil_data[] 		.= $list_hasil_data;
	         //        }
	         //        echo json_encode($hasil_data);
	         //    }
		        echo $send;
		    }//penutup if jika ditemukan cons id
			else{//pembuka if jika tidak ditemukan cons id
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}//penutup if jika tidak ditemukan cons id	
		}
		function get_karcis(){
	        $id_dokter  = $this->input->post('id_dokter');
	        $outlet     = $this->session->userdata('outlet');
	        // $karcis['admin']        = $this->m_daftar->get_karcis($outlet);
	        // $karcis['pemeriksaan']  = $this->m_daftar->get_karcis_pemeriksaan($outlet);
	        // $karcis['dokter']       = $this->m_daftar->get_terif_dokter_aktif($outlet, $id_dokter);
	        // echo json_encode($karcis);
	    }
	     
	     function get_provinsi(){
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
		        $param1 				= 1;
		        $param2 				= "hancok";
		        $uri 					= $url.'/'.$service_name.'/referensi/propinsi';
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
			        $list_data 		= $data_respon->list;
			        $list_data2 	= '';
			        foreach ($list_data as $row) {
			        	$kode_faskes 	= $row->kode;
			        	$nama_faskes 	= $row->nama;
			        	$list_data2[] 	.= $kode_faskes.','.$nama_faskes;
			        	$datates1['data21'] 	= array($list_data2);
			        }
			        echo json_encode($list_data);
		        }
			}else{
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}
	    }
	    function get_kabupaten(){
	    	$id_perusahaan 		= $this->session->userdata('outlet');
	    	$id_pegawai         = $this->session->userdata('id_uname');
	    	$jenis_faskes 		= $this->input->post('jns_faskes');
	    	$ppkdirujuk 		= $this->input->post('ppkdirujuk');
	    	$id_provinsi 		= $this->input->post('id_provinsi');
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
		        $param1 				= 1;
		        $param2 				= "hancok";
		        $uri 					= $url.'/'.$service_name.'/referensi/kabupaten/propinsi/$id_provinsi';
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
			        $list_data 		= $data_respon->list;
			        $list_data2 	= '';
			        foreach ($list_data as $row) {
			        	$kode_faskes 	= $row->kode;
			        	$nama_faskes 	= $row->nama;
			        	$list_data2[] 	.= $kode_faskes.','.$nama_faskes;
			        	$datates1['data21'] 	= array($list_data2);
			        }
			        echo json_encode($list_data);
		        }
			}else{
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}
	    }
	    function get_kecamatan(){
	    	$id_perusahaan 		= $this->session->userdata('outlet');
	    	$id_pegawai         = $this->session->userdata('id_uname');
	    	$jenis_faskes 		= $this->input->post('jns_faskes');
	    	$ppkdirujuk 		= $this->input->post('ppkdirujuk');
	    	$id_kabupaten 		= $this->input->post('id_kabupaten');
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
		        $param1 				= 1;
		        $param2 				= "hancok";
		        $uri 					= $url.'/'.$service_name.'/referensi/kecamatan/kabupaten/$id_kabupaten';
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
			        $list_data 		= $data_respon->list;
			        $list_data2 	= '';
			        foreach ($list_data as $row) {
			        	$kode_faskes 	= $row->kode;
			        	$nama_faskes 	= $row->nama;
			        	$list_data2[] 	.= $kode_faskes.','.$nama_faskes;
			        	$datates1['data21'] 	= array($list_data2);
			        }
			        echo json_encode($list_data);
		        }
			}else{
				echo json_encode("Maaf Anda Tidak Memiliki Layanan Ini");
			}
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
	    function get_norm_pasien(){
	    	$nama 			= $this->input->post('nama');
	    	$nik 			= $this->input->post('nik');
	    	$jk 			= $this->input->post('jk');
	    	$tgl_lahir 		= $this->input->post('tgl_lahir');
	    	$nokartu 		= $this->input->post('nokartu');
	    	$id_perusahaan 	= $this->session->userdata('outlet');
	    	if ($jk=='P') {
	    		$jenis_kelamin = 'Perempuan';
	    	}else{
	    		$jenis_kelamin = 'Laki-laki';
	    	}
	    	$get_norm_pasien = $this->m_api_sep->get_norm_pasien($nama, $nik, $jenis_kelamin, $tgl_lahir, $nokartu, $id_perusahaan);
	    	if (empty($get_norm_pasien)) {
	    		echo json_encode('Kosong');
	    	}else{
	    		echo json_encode($get_norm_pasien);
	    	}
	    }
	    function get_create_sep_norujukan_keluar(){
	    	$id_rujukan_masuk 	= $this->input->post('id');
	    	$norm 				= $this->input->post('norm');
	    	$nodaftar 			= $this->input->post('nodaftar');
	    	$get_data_rujukan_masuk = $this->m_api_sep->get_rujukan_masuk($id_rujukan_masuk);
	    	echo json_encode($get_data_rujukan_masuk);
	    }
	    function get_data_sep(){
	    	// $hsl_no_sep 		= '0196S0010620V000001';
	    	$norm 				= $this->input->post('norm');
	    	$nodaftar 			= $this->input->post('nodaftar');
	    	$id_perusahaan 		= $this->session->userdata('outlet');
	    	$id_pegawai         = $this->session->userdata('id_uname');
	    	$tanggal_sekarang 	= date('Y-m-d');
	    	// $jenis_faskes 		= $this->input->post('jns_faskes');
	    	// $ppkdirujuk 		= $this->input->post('ppkdirujuk');
	    	$data_insert_sep 	= $this->m_api_sep->data_insert_sep($nodaftar, $id_perusahaan);
	    	$sep_lama 			= $this->m_api_sep->data_respon_insert_sep($nodaftar, $id_perusahaan);
	    	foreach ($sep_lama as $key) {
	    		$nosep_1 	= $key->noSep;
	    		$catatan 	= $key->catatan;
	    		$data = array( 'noSep_1' => $nosep_1, 'catatan' => $catatan,);
	    	}
	    	$data_output['sep_lama'] 	= $sep_lama;
	    	$data_output['insert_sep'] 	= $data_insert_sep;
	    	// $data_output['data'] = $data;
	    	$data_output['no_sep'] = $nosep_1;
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
		        $uri 					= $url.'/'.$service_name.'/SEP/'.$nosep_1;
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
		        $data_output['data_bridg_lama'] = $send;

		        $parse_data 	= json_decode($send);
		        $metaData 		= $parse_data->metaData; 
		        $code 			= $metaData->code; 
		        $message 		= $metaData->message; 
		        $response 		= $parse_data->response;
		        $catatan 		= $response->catatan;
		        $diagnosa 		= $response->diagnosa;
		        $informasi 		= $response->informasi;
		        $jnsPelayanan 	= $response->jnsPelayanan;
		        $kelasRawat 	= $response->kelasRawat;
		        $noRujukan 		= $response->noRujukan;
		        $noSep 			= $response->noSep;
		        $penjamin 		= $response->penjamin;
		        $penjaamin 		= $response->penjamin;
		        $peserta 		= $response->peserta;
		        $asuransi 		= $peserta->asuransi;
		        $hakKelas 		= $peserta->hakKelas;
		        $jnsPeserta 	= $peserta->jnsPeserta;
		        $kelamin 		= $peserta->kelamin;
		        $nama 			= $peserta->nama;
		        $noKartu		= $peserta->noKartu;
		        $noMr			= $peserta->noMr;
		        $tglLahir		= $peserta->tglLahir;
		        $poli 			= $response->poli;
		        $poliEksekutif	= $response->poliEksekutif;
		        $tglSep			= $response->tglSep;
		        // $get_data_response_insert = $this->m_api_sep->get_data_response_insert($noRujukan, $id_perusahaan);
		        $get_data_response_insert = $this->m_api_sep->get_data_response_insert($noRujukan, $id_perusahaan);
		        if (empty($get_data_response_insert)) {
		        	$simpan_respon_sep = array(	'ID_PERUSAHAAN' => $id_perusahaan,
			        							'NODAFTAR' 		=> $nodaftar,
			        							'NIP_PEGAWAI' 	=> $id_pegawai,
			        							// 'ID_TARIF' 		=> $ID_TARIF,
			        							'TANGGAL_INPUT' => $tanggal_sekarang,
			        							'STATUS' 		=> 1,
			        							'catatan' 		=> $catatan,
			        							'diagnosa' 		=> $diagnosa,
			        							'jnsPelayanan' 	=> $jnsPelayanan,
			        							'kelasRawat' 	=> $kelasRawat,
			        							'noSep' 		=> $noSep,
			        							'penjamin' 		=> $penjamin,
			        							'asuransi' 		=> $asuransi,
			        							'hakKelas' 		=> $hakKelas,
			        							'jnsPeserta' 	=> $jnsPeserta,
			        							'kelamin' 		=> $kelamin,
			        							'nama' 			=> $nama,
			        							'noKartu' 		=> $noKartu,
			        							'noMr' 			=> $noMr,
			        							'tglLahir' 		=> $tglLahir,
			        							// 'Dinsos' 		=> $Dinsos,
			        							// 'prolanisPRB' 	=> $prolanisPRB,
			        							// 'noSKTM' 		=> $noSKTM,
			        							'poli' 			=> $poli,
			        							'poliEksekutif' => $poliEksekutif,
			        							'tglSep' 		=> $tglSep);
		        	// $data_output['simpan_sep'] = $this->m_api_sep->simpan_data('respon_insert_sep', $simpan_respon_sep);
		        	// $data_output['simpan_sep'] = $noSep_1;
		        }else{
		        	$data_output['data_ganda'] = "ada datanya";
		        }
		        echo json_encode($data_output);

		    }
	    }
	    function insert_rujukan_keluar(){
	    	
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
	    	// $txttglsep 						= $this->input->post('txttglsep');
	    	// $txtnomr 						= $this->input->post('txtnomr');
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
			$rujukan 	= array("asalRujukan" => $cbasalrujukan , "tglRujukan" => $txttglrujukan, "noRujukan" => $txtnorujukan, "ppkRujukan" => $txtkdppkasalrujukan);
			$poli 		= array("tujuan" => $txtkdpoli, "eksekutif" => strval($eksekutif));
			$cob 		= array("cob" => strval($cobch));
			$katarak 	= array ("katarak" => strval($katarakch));
										$lokasiLaka = array ("kdPropinsi" => $cbpropinsi, "kdKabupaten" => $cbkabupaten, "kdKecamatan" => $cbkecamatan);
								$suplesi = array ("suplesi" => "0", "noSepSuplesi" => "0", "lokasiLaka" => $lokasiLaka);
						$penjamin = array ("penjamin" => "1", "tglKejadian" => $txtTglKejadian, "keterangan" => $txtketkejadian, "suplesi" => $suplesi);
			$jaminan 	= array ("lakaLantas" => $cbstatuskll, "penjamin" => $penjamin);
			$skdp 		= array("noSurat" => $txtnosuratkontrol, "kodeDPJP" => $txtnmdpjp);
			$t_sep 		=  array(	"noKartu" 		=> $txtnokartu_peserta,
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
									"jaminan" 		=> $jaminan ,
									"skdp" 			=> $skdp,
									"noTelp" 		=> $txtnotelp,
									"user" 			=> "Coba Ws");
	    	$request['request'] = array("t_sep" => $t_sep);	
	    	$data_request = json_encode($request);
	    	$backup_insert_sep = array(	"ID_PERUSAHAAN" => $id_perusahaan, 
	    								'NODAFTAR' 		=> $txt_nodaftaresyst,
	    								'NIP_PEGAWAI' 	=> $nip_pegawai,
	    								'ID_TARIF' 		=> $txtID_TARIF,
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
	    								'diagAwal' 		=> $txtkddiagnosa,
	    								'tujuan' 		=> $txtkdpoli,
	    								'eksekutif'		=> $eksekutif,
	    								'cob' 			=> $cobch,
	    								'katarak' 		=> $katarakch,
	    								'lakaLantas' 	=> $cbstatuskll,
	    								'penjamin' 		=> "1",
	    								'tglKejadian' 	=> $txtTglKejadian,
	    								'keterangan' 	=> $txtketkejadian,
	    								'suplesi' 		=> "0",
	    								'noSepSuplesi' 	=> "0",
	    								'kdPropinsi' 	=> $cbpropinsi,
	    								'kdKabupaten' 	=> $cbkabupaten,
	    								'kdKecamatan' 	=> $cbkecamatan,
	    								'noSurat' 		=> $txtnosuratkontrol,
	    								'kodeDPJP' 		=> $txtnmdpjp,
	    								'noTelp' 		=> $txtnotelp,
	    								"user" 			=> "Coba Ws");
	    	$insert_sep_backup = $this->m_api_sep->simpan_data('insert_sep', $backup_insert_sep);
	    	
	    	// $json = json_encode($arr);
			$url 					= "https://dvlp.bpjs-kesehatan.go.id";
	        $service_name 			= "vclaim-rest";
	        $uri = $url."/".$service_name."/SEP/1.1/insert";
			// Computes the timestamp
	        date_default_timezone_set('UTC');
	        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
	        // Computes the signature by hashing the salt with the secret key as the key
	        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	        // base64 encode…
	        $encodedSignature = base64_encode($signature);
	        // urlencode…
	        // $urlencodedSignature = urlencode($encodedSignature);
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            "X-cons-id: $data", 
	            "X-timestamp: $tStamp", 
	            "X-signature: $encodedSignature"
	        ));
	        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_URL, $uri);

	        $send = curl_exec($ch);
	        ////
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
					$d_noSEp			= $coba->noSEp;
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
					$d_tglLahir			= $d_peserta->inform;
					$d_informasi		= $coba->informasi;
					$d_Dinsos			= $d_informasi->Dinsos;
					$d_prolanisPRB		= $d_informasi->prolanisPRB;
					$d_noSKTM			= $d_informasi->noSKTM;
					$d_poli				= $coba->poli;
					$d_poliEksekutif	= $coba->poliEksekutif;
					$d_tglSep			= $coba->tglSep;
					$data_sep 			= array('ID_PERUSAHAAN' => $id_perusahaan,
												'NODAFTAR' 		=> $txt_nodaftaresyst,
												'NIP_PEGAWAI' 	=> $nip_pegawai,
												'ID_TARIF' 		=> $txtID_TARIF,
												'TANGGAL_INPUT' => $tanggal_sekarang,
												'STATUS' 		=> 1,
												'catatan' 		=> $d_catatan,
												'diagnosa' 		=> $d_diagnosa,
												'jnsPelayanan' 	=> $d_jnsPelayanan,
												'kelasRawat' 	=> $d_kelasRawat,
												'noSep' 		=> $d_noSEp,
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
					echo json_encode($respon_insert_sep_backup);
				}else{
					echo json_encode($m_message);
				}
	        }
	    	// echo json_encode($request);
	    }
	    function update_data_sep(){
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
			$rujukan 	= array("asalRujukan" => $cbasalrujukan , "tglRujukan" => $txttglrujukan, "noRujukan" => $txtnorujukan, "ppkRujukan" => $txtkdppkasalrujukan);
			$poli 		= array("eksekutif" => strval($eksekutif));
			$cob 		= array("cob" => $cobch);
			$katarak 	= array("katarak" => strval($katarakch));
										$lokasiLaka = array("kdPropinsi" => $cbpropinsi, "kdKabupaten" => $cbkabupaten, "kdKecamatan" => $cbkecamatan);
								$suplesi = array("suplesi" => "0", "noSepSuplesi" => "0", "lokasiLaka" => $lokasiLaka);
						$penjamin = array("penjamin" => "1", "tglKejadian" => $txtTglKejadian, "keterangan" => $txtketkejadian, "suplesi" => $suplesi);
			$jaminan 	= array("lakaLantas" => $cbstatuskll, "penjamin" => $penjamin);
			$skdp 		= array("noSurat" => $txtnosuratkontrol, "kodeDPJP" => $txtnmdpjp);

			// meninggalan 
			// no noKartu
			// tgl sep
			// ppkpelayanan
			// jns pelayanan

	    	$t_sep = array("noSep" 		=> "0196S0010620V000001",
							"klsRawat" 	=> $cbKelas,
							"noMR" 		=> $txtnomr,
							"rujukan" 	=> $rujukan,
							"catatan" 	=> $txtcatatan,
							"diagAwal" 	=> $txtkddiagnosa,
							"poli" 		=> $poli,
							"cob" 		=> $cob,
							"katarak" 	=> $katarak,
							"skdp" 		=> $skdp,
							"jaminan" 	=> $jaminan,
							"noTelp" 	=> $txtnotelp,
							"user" 		=> "Coba Ws");
	    	$request['request'] = array("t_sep" => $t_sep);
	    	$data_request = json_encode($request);

	    	////
	    	$url 					= "https://dvlp.bpjs-kesehatan.go.id";
	        $service_name 			= "vclaim-rest";
	        $uri = $url."/".$service_name."/SEP/1.1/update";

			// Computes the timestamp
	        date_default_timezone_set('UTC');
	        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
	        // Computes the signature by hashing the salt with the secret key as the key
	        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	        // base64 encode…
	        $encodedSignature = base64_encode($signature);
	        // urlencode…
	        // $urlencodedSignature = urlencode($encodedSignature);
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            "X-cons-id: $data", 
	            "X-timestamp: $tStamp", 
	            "X-signature: $encodedSignature",
	            'Content-Type:Application/x-www-form-urlencoded',
	        ));
	        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL, $uri);

	        $send = curl_exec($ch);
	        ////
	        echo $send;
	   //      if ($send === false) {
	   //          die('Error fecthing data: ' .curl_error($ch));
	   //      }else{
	   //      	$decode 			= json_decode($send);
				// $meta 				= $decode->metaData;
				// $m_code 			= $meta->code;
				// $m_message 			= $meta->message;
				// if ($m_code==200) {
				// 	echo json_encode($m_message);
				// }else{
				// 	echo json_encode($m_message);
				// }//
	   //      }
	    	
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

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch, CURLOPT_URL, $uri);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    $send = curl_exec($ch);
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
			    	$data_status_pendaftaran		 		= array('STATUS_PENDAFTARAN' => 0);
			    	$update_status_ts_pendaftaran 			= $this->m_api_sep->update_data('ts_pendaftaran', $data_status_pendaftaran, 'NODAFTAR', $nodaftar_lengkap);
			    	$data_transaksi 						= array('KODE_STATUS' => 0);
			    	$update_status_data_status_perawatan	= $this->m_api_sep->update_data('ts_biayaperawatan', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	$update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_obat', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	$update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_optik', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
					// echo json_encode($m_message);
					echo $send;
				}else{
					// echo json_encode($m_message);
					echo $send;
				}
	        }
	    	// echo json_encode($send);
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
		        if ($rujukan_peserta_sex_ambil=='P') {
		        	$jenis_kelamin = 'Perempuan';
		        }else {
		        	$jenis_kelamin = 'Laki-Laki';
		        }
		        $get_nodaftar = $this->m_api_sep->get_last_nodaftar($id_perusahaan);
		        // untuk membuka if nodaftar
		        if (empty($get_nodaftar)) {
		        	$nodaftar_baru = $id_perusahaan."1";
		        }else {
		        	foreach ($get_nodaftar as $key) {
		        		$last_nodaftar = $key->nodaftar+1;
		        		$nodaftar_baru = $id_perusahaan.$last_nodaftar;
		        	}
		        }
		        // untuk penutuo if nodaftar
		        //untuk Pembuka if NORM BPJS kosong
				if (empty($rujukan_peserta_mr_noMR_ambil)) {
					if (empty($NORM_sistem)) {//untuk membuka if jika NORM dari sistem Kosong
						$get_last_norm = $this->m_api_sep->get_last_norm($id_perusahaan);
						foreach ($get_last_norm as $key) {
							$norm 		= $key->norm;
							//diambil dan dikeluarkan ketika melakukan echo
							$norm_baru 	= $norm+1;
						}
						$ms_pasien 		= array('NORM' 				=> $id_perusahaan.$norm_baru,
												'ID_PERUSAHAAN' 	=> $id_perusahaan,
												'NAMA' 				=> $rujukan_peserta_nama_ambil,
												'NIK' 				=> $rujukan_peserta_nik_ambil,
												'ALAMAT' 			=> $alamat,
												'TEMPAT_LAHIR' 		=> $tempat_lahir,
												'TANGGAL_LAHIR' 	=> $rujukan_peserta_tglLahir_ambil,
												'PROVINSI' 			=> $provinsi,
												'KAB' 				=> $kabupaten,
												'KEC' 				=> $kecamatan,
												'DESA' 				=> $desa,
												'JK' 				=> $jenis_kelamin,
												'TELP' 				=> $rujukan_peserta_mr_noTelepon_ambil,
												'NOKPST' 			=> $rujukan_peserta_noKartu_ambil,
												'KODE_GOLONGAN' 	=> "BPJS",
												'BATAS_GOLONGAN' 	=> "2",
												'PEKERJAAN' 		=> $pekerjaan,
												'TGL_INPUT' 		=> $tanggal_sekarang, );
						$simpan_data_pasien = $this->m_api_sep->simpan_data('ms_pasien', $ms_pasien);
						$ts_pendaftaran = array('NODAFTAR'          	=> $nodaftar_baru,
		                                        'ID_PERUSAHAAN'     	=> $id_perusahaan,
		                                        'NORM'              	=> $id_perusahaan.$norm_baru,
		                                        'NIP_PEGAWAI'       	=> $nip_pegawai,
		                                        'ID_TARIF'          	=> $id_dokter,
		                                        'TGL_DAFTAR'        	=> $tanggal_sekarang,
		                                        'BARU_LAMA'         	=> "Baru",
		                                        'KODE_GOLONGAN'     	=> "BPJS",
		                                        'STATUS_PENDAFTARAN'    => 1);
						$simpan_data_pendaftaran = $this->m_api_sep->simpan_data('ts_pendaftaran', $ts_pendaftaran);
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
													'mr_noMR' 					=> $id_perusahaan.$norm_baru,
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
						$jum = $this->input->post('jumlah_tindakan');
		                for($i=1;$i<=$jum;$i++)
		                {
		                    $id_tarif       = $this->input->post('karcis'.$i);
		                    $tarif          = $this->input->post('tarif'.$i);
		                    $kode_status    = 1;
		                    $data_tindakan  = array('NODAFTAR'      	=> $nodaftar_baru,
		                                            'ID_PERUSAHAAN'     => $id_perusahaan,
		                                            'NIP_PEGAWAI'       => $nip_pegawai,
		                                            'ID_TARIF'          => $id_dokter,
		                                            'NORM'              => $id_perusahaan.$norm_baru,
		                                            'ID_TARIF_TINDAKAN' => $id_tarif,
		                                            'TGL_TINDAKAN'      => $tanggal_sekarang,
		                                            'JAM_TINDAKAN'      => $jam_sekarang,
		                                            'QTY_TINDAKAN'      => 1,
		                                            'TARIF'             => $tarif,
		                                            'BIAYA'             => $tarif,
		                                            'KODE_STATUS'       => $kode_status);
		                    if(isset($tarif)&&$tarif!='')
		                    {
		                    	// $data_tindakan2[]  = array('NODAFTAR'     => $nodaftar_baru,
		                     //                        'ID_PERUSAHAAN'     => $id_perusahaan,
		                     //                        'NIP_PEGAWAI'       => $nip_pegawai,
		                     //                        'ID_TARIF'          => $id_dokter,
		                     //                        'NORM'              => $id_perusahaan.$norm_baru,
		                     //                        'ID_TARIF_TINDAKAN' => $id_tarif,
		                     //                        'TGL_TINDAKAN'      => $tanggal_sekarang,
		                     //                        'JAM_TINDAKAN'      => $jam_sekarang,
		                     //                        'QTY_TINDAKAN'      => 1,
		                     //                        'TARIF'             => $tarif,
		                     //                        'BIAYA'             => $tarif,
		                     //                        'KODE_STATUS'       => $kode_status);
		                        $simpan_tindakan =  $this->m_api_sep->simpan_data('ts_biayaperawatan' , $data_tindakan);
		                    }
		                    
		                }
		                // $arrayAngka = array("Satu" => $data_tindakan2, "Dua");
		                // $arrayAngka = array("Satu" => array("nama" => "coba", "untuk" => "tes"), "Dua");
		                // $gabung["data"] =  $data_tindakan2;
		                // array_push($response["data"], $data_tindakan2);
		                // echo json_encode($simpan_tindakan);
		                // array_push($response["data"], $data_tindakan2);
		                echo json_encode($simpan_tindakan);
					}//untuk menutup if jika NORM dari sistem Kosong
					else {//untuk membuka if jika NORM dari sistem ditemukan
						$ms_pasien 		= array('ID_PERUSAHAAN' 	=> $id_perusahaan,
												'NAMA' 				=> $rujukan_peserta_nama_ambil,
												'NIK' 				=> $rujukan_peserta_nik_ambil,
												'ALAMAT' 			=> $alamat,
												'TEMPAT_LAHIR' 		=> $tempat_lahir,
												'TANGGAL_LAHIR' 	=> $rujukan_peserta_tglLahir_ambil,
												'PROVINSI' 			=> $provinsi,
												'KAB' 				=> $kabupaten,
												'KEC' 				=> $kecamatan,
												'DESA' 				=> $desa,
												'JK' 				=> $jenis_kelamin,
												'TELP' 				=> $rujukan_peserta_mr_noTelepon_ambil,
												'NOKPST' 			=> $rujukan_peserta_noKartu_ambil,
												'KODE_GOLONGAN' 	=> "BPJS",
												'BATAS_GOLONGAN' 	=> "2",
												'PEKERJAAN' 		=> $pekerjaan);
						$simpan_data_pasien = $this->m_api_sep->update_data('ms_pasien', $ms_pasien,'NORM' , $NORM_sistem);
						$ts_pendaftaran = array('NODAFTAR'          => $nodaftar_baru,
		                                        'ID_PERUSAHAAN'     => $id_perusahaan,
		                                        'NORM'              => $NORM_sistem,
		                                        'NIP_PEGAWAI'       => $nip_pegawai,
		                                        'ID_TARIF'          => $id_dokter,
		                                        'TGL_DAFTAR'        => $tanggal_sekarang,
		                                        'BARU_LAMA'         => "Baru",
		                                        'KODE_GOLONGAN'     => "BPJS",
		                                        'STATUS_PENDAFTARAN'    => 1);
						$simpan_data_pendaftaran = $this->m_api_sep->simpan_data('ts_pendaftaran', $ts_pendaftaran);
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
													'mr_noMR' 					=> $NORM_sistem,
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
						$jum = $this->input->post('jumlah_tindakan');
		                for($i=1;$i<=$jum;$i++)
		                {
		                    $id_tarif       = $this->input->post('karcis'.$i);
		                    $tarif          = $this->input->post('tarif'.$i);
		                    $kode_status    = 1;
		                    $data_tindakan  = array('NODAFTAR'      	=> $nodaftar_baru,
		                                            'ID_PERUSAHAAN'     => $id_perusahaan,
		                                            'NIP_PEGAWAI'       => $nip_pegawai,
		                                            'ID_TARIF'          => $id_dokter,
		                                            'NORM'              => $NORM_sistem,
		                                            'ID_TARIF_TINDAKAN' => $id_tarif,
		                                            'TGL_TINDAKAN'      => $tanggal_sekarang,
		                                            'JAM_TINDAKAN'      => $jam_sekarang,
		                                            'QTY_TINDAKAN'      => 1,
		                                            'TARIF'             => $tarif,
		                                            'BIAYA'             => $tarif,
		                                            'KODE_STATUS'       => $kode_status);
		                    if(isset($tarif)&&$tarif!='')
		                    {
		                        $simpan_tindakan =  $this->m_api_sep->simpan_data('ts_biayaperawatan' , $data_tindakan);
		                    }
		                }
		                echo json_encode($simpan_tindakan);
					}//untuk menutup if jika NORM dari sistem ditemukan
	                
				}//untuk Penutup if NORM BPJS kosong
				else{//pembuka jika Norm BPJS tidak Kosong
					// $get_norm_sama = $this->m_api_sep->get_norm_sama($rujukan_peserta_nik_ambil, $rujukan_peserta_mr_noMR_ambil, $rujukan_peserta_nama_ambil, $alamat, $tempat_lahir, $kecamatan, $desa, $id_perusahaan);
					if ($NORM_sistem == $rujukan_peserta_mr_noMR_ambil) {//pembuka jika norm ada yang sama
						$ms_pasien 		= array('ID_PERUSAHAAN' 	=> $id_perusahaan,
												'NAMA' 				=> $rujukan_peserta_nama_ambil,
												'NIK' 				=> $rujukan_peserta_nik_ambil,
												'ALAMAT' 			=> $alamat,
												'TEMPAT_LAHIR' 		=> $tempat_lahir,
												'TANGGAL_LAHIR' 	=> $rujukan_peserta_tglLahir_ambil,
												'PROVINSI' 			=> $provinsi,
												'KAB' 				=> $kabupaten,
												'KEC' 				=> $kecamatan,
												'DESA' 				=> $desa,
												'JK' 				=> $jenis_kelamin,
												'TELP' 				=> $rujukan_peserta_mr_noTelepon_ambil,
												'NOKPST' 			=> $rujukan_peserta_noKartu_ambil,
												'KODE_GOLONGAN' 	=> "BPJS",
												'BATAS_GOLONGAN' 	=> "2",
												'PEKERJAAN' 		=> $pekerjaan);
						$simpan_data_pasien = $this->m_api_sep->update_data('ms_pasien', $ms_pasien,'NORM' , $NORM_sistem);
						$ts_pendaftaran = array('NODAFTAR'          => $nodaftar_baru,
		                                        'ID_PERUSAHAAN'     => $id_perusahaan,
		                                        'NORM'              => $NORM_sistem,
		                                        'NIP_PEGAWAI'       => $nip_pegawai,
		                                        'ID_TARIF'          => $id_dokter,
		                                        'TGL_DAFTAR'        => $tanggal_sekarang,
		                                        'BARU_LAMA'         => "Lama",
		                                        'KODE_GOLONGAN'     => "BPJS",
		                                        'STATUS_PENDAFTARAN'    => 1);
						$simpan_data_pendaftaran = $this->m_api_sep->simpan_data('ts_pendaftaran', $ts_pendaftaran);
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
													'mr_noMR' 					=> $NORM_sistem,
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
						$jum = $this->input->post('jumlah_tindakan');
		                for($i=1;$i<=$jum;$i++)
		                {
		                    $id_tarif       = $this->input->post('karcis'.$i);
		                    $tarif          = $this->input->post('tarif'.$i);
		                    $kode_status    = 1;
		                    $data_tindakan  = array('NODAFTAR'      	=> $nodaftar_baru,
		                                            'ID_PERUSAHAAN'     => $id_perusahaan,
		                                            'NIP_PEGAWAI'       => $nip_pegawai,
		                                            'ID_TARIF'          => $id_dokter,
		                                            'NORM'              => $NORM_sistem,
		                                            'ID_TARIF_TINDAKAN' => $id_tarif,
		                                            'TGL_TINDAKAN'      => $tanggal_sekarang,
		                                            'JAM_TINDAKAN'      => $jam_sekarang,
		                                            'QTY_TINDAKAN'      => 1,
		                                            'TARIF'             => $tarif,
		                                            'BIAYA'             => $tarif,
		                                            'KODE_STATUS'       => $kode_status);
		                    if(isset($tarif)&&$tarif!='')
		                    {
		                        $simpan_tindakan =  $this->m_api_sep->simpan_data('ts_biayaperawatan' , $data_tindakan);
		                    }
		                }
						echo json_encode($simpan_tindakan);
					}//penutup jika norm ada yang sama
					else{//pembuka jika norm tidak ada yang sama

						$get_last_norm = $this->m_api_sep->get_last_norm($id_perusahaan);
						foreach ($get_last_norm as $key) {
							$norm 		= $key->norm;
							//diambil dan dikeluarkan ketika melakukan echo
							$norm_baru 	= $norm+1;
						}
						$ms_pasien 		= array('NORM' 				=> $id_perusahaan.$norm_baru,
												'ID_PERUSAHAAN' 	=> $id_perusahaan,
												'NAMA' 				=> $rujukan_peserta_nama_ambil,
												'NIK' 				=> $rujukan_peserta_nik_ambil,
												'ALAMAT' 			=> $alamat,
												'TEMPAT_LAHIR' 		=> $tempat_lahir,
												'TANGGAL_LAHIR' 	=> $rujukan_peserta_tglLahir_ambil,
												'PROVINSI' 			=> $provinsi,
												'KAB' 				=> $kabupaten,
												'KEC' 				=> $kecamatan,
												'DESA' 				=> $desa,
												'JK' 				=> $jenis_kelamin,
												'TELP' 				=> $rujukan_peserta_mr_noTelepon_ambil,
												'NOKPST' 			=> $rujukan_peserta_noKartu_ambil,
												'KODE_GOLONGAN' 	=> "BPJS",
												'BATAS_GOLONGAN' 	=> "2",
												'PEKERJAAN' 		=> $pekerjaan,
												'TGL_INPUT' 		=> $tanggal_sekarang,
												'NORM_LAMA' 		=> $rujukan_peserta_mr_noMR_ambil);
						$simpan_data_pasien = $this->m_api_sep->simpan_data('ms_pasien', $ms_pasien);
						$ts_pendaftaran = array('NODAFTAR'          => $nodaftar_baru,
		                                        'ID_PERUSAHAAN'     => $id_perusahaan,
		                                        'NORM'              => $id_perusahaan.$norm_baru,
		                                        'NIP_PEGAWAI'       => $nip_pegawai,
		                                        'ID_TARIF'          => $id_dokter,
		                                        'TGL_DAFTAR'        => $tanggal_sekarang,
		                                        'BARU_LAMA'         => "Baru",
		                                        'KODE_GOLONGAN'     => "BPJS",
		                                        'STATUS_PENDAFTARAN'    => 1);
						$simpan_data_pendaftaran = $this->m_api_sep->simpan_data('ts_pendaftaran', $ts_pendaftaran);
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
													'mr_noMR' 					=> $id_perusahaan.$norm_baru,
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
						$jum = $this->input->post('jumlah_tindakan');
		                for($i=1;$i<=$jum;$i++)
		                {
		                    $id_tarif       = $this->input->post('karcis'.$i);
		                    $tarif          = $this->input->post('tarif'.$i);
		                    $kode_status    = 1;
		                    $data_tindakan  = array('NODAFTAR'      	=> $nodaftar_baru,
		                                            'ID_PERUSAHAAN'     => $id_perusahaan,
		                                            'NIP_PEGAWAI'       => $nip_pegawai,
		                                            'ID_TARIF'          => $id_dokter,
		                                            'NORM'              => $id_perusahaan.$norm_baru,
		                                            'ID_TARIF_TINDAKAN' => $id_tarif,
		                                            'TGL_TINDAKAN'      => $tanggal_sekarang,
		                                            'JAM_TINDAKAN'      => $jam_sekarang,
		                                            'QTY_TINDAKAN'      => 1,
		                                            'TARIF'             => $tarif,
		                                            'BIAYA'             => $tarif,
		                                            'KODE_STATUS'       => $kode_status);
		                    if(isset($tarif)&&$tarif!='')
		                    {
		                        $simpan_tindakan =  $this->m_api_sep->simpan_data('ts_biayaperawatan' , $data_tindakan);
		                    }
		                    
		                }
		                echo json_encode($simpan_tindakan);
					}//penutup jika norm tidak ada yang sama
				}//penutup untuk jika noRM BPJS tidak kosong	
	        }
	        
			// echo json_encode($response);
		}
		function get_sep_pasien_untuk_dirujuk(){
			$norm 					= $this->input->post('norm');
			$nodaftar 				= $this->input->post('nodaftar');
			$id_perusahaan 			= $this->session->userdata('outlet');
			$get_data_sep_pasien 	= $this->m_api_sep->get_data_sep_pasien($nodaftar, $norm);
			if (empty($get_data_sep_pasien)) {
				echo json_encode('Maaf No SEP Pasien Belum Tersimpan');
			}else{
				foreach ($get_data_sep_pasien as $key) {
					// $no_sep = $key->noSep;
					$no_sep = $key->noSep;
				}
				$get_data_insert_rujukan_keluar = $this->m_api_sep->get_data_insert_rujukan_keluar($nodaftar);
				if (empty($get_data_insert_rujukan_keluar)) {
					$get_data_rujukan_keluar_lama = $this->m_api_sep->get_data_rujukan_lama_by_sep($nodaftar);
					foreach ($get_data_rujukan_keluar_lama as $key) {
						$asalFaskes 		= $key->asalFaskes;
						$noKunjungan 		= $key->noKunjungan;
						$noKartu 			= $key->noKartu;
						$nama 				= $key->nama;
						$poliRujukan_nama 	= $key->poliRujukan_nama;
						$provPerujuk_nama 	= $key->provPerujuk_nama;
						$tglKunjungan 		= $key->tglKunjungan;
					}
					$data_rujukan_keluar = array(	'asalFaskes' 		=> $asalFaskes,
													'noKunjungan' 		=> $noKunjungan,
													'noKartu' 			=> $noKartu,
													'nama' 				=> $nama,
													'poliRujukan_nama' 	=> $poliRujukan_nama,
													'provPerujuk_nama' 	=> $provPerujuk_nama,
													'no_sep' 			=> $no_sep,
													'tglKunjungan' 		=> $tglKunjungan,
													'id_insert_rujukan' => '',
													'nodaftar' 			=> $nodaftar
												);
					$data_edit_rujukan_keluar = 'Kosong';
					$data = array('data_rujukan' => $data_rujukan_keluar, 'data_edit' => $data_edit_rujukan_keluar);
					echo json_encode($data);
				}else{
					foreach ($get_data_insert_rujukan_keluar as $key) {
						$id_insert_rujukan 	= $key->ID_INSERT_RUJUKAN;
						$tglRujukan 		= $key->tglRujukan;
						$ppkDirujuk 		= $key->ppkDirujuk;
						$jnsPelayanan 		= $key->jnsPelayanan;
						$catatan 			= $key->catatan;
						$diagRujukan 		= $key->diagRujukan;
						$tipeRujukan 		= $key->tipeRujukan;
						$poliRujukan 		= $key->poliRujukan;
						$user 				= $key->user;
						$jenis_Faskes		= $key->jenis_Faskes;
					}
					$get_data_rujukan_keluar_lama = $this->m_api_sep->get_data_rujukan_lama_by_sep($nodaftar);
					foreach ($get_data_rujukan_keluar_lama as $key) {
						$asalFaskes 		= $key->asalFaskes;
						$noKunjungan 		= $key->noKunjungan;
						$noKartu 			= $key->noKartu;
						$nama 				= $key->nama;
						$poliRujukan_nama 	= $key->poliRujukan_nama;
						$provPerujuk_nama 	= $key->provPerujuk_nama;
						$tglKunjungan 		= $key->tglKunjungan;
					}
					$data_rujukan_keluar = array(	'asalFaskes' 		=> $asalFaskes,
													'noKunjungan' 		=> $noKunjungan,
													'noKartu' 			=> $noKartu,
													'nama' 				=> $nama,
													'poliRujukan_nama' 	=> $poliRujukan_nama,
													'provPerujuk_nama' 	=> $provPerujuk_nama,
													'no_sep' 			=> $no_sep,
													'tglKunjungan' 		=> $tglKunjungan,
													'id_insert_rujukan' => $id_insert_rujukan,
													'nodaftar' 			=> $nodaftar);
					$data_edit_rujukan_keluar = array( 	'id_insert_rujukan' => $id_insert_rujukan, 
														'tglRujukan' 		=> $tglRujukan, 
														'ppkDirujuk' 		=> $ppkDirujuk, 
														'jnsPelayanan' 		=> $jnsPelayanan, 
														'catatan' 			=> $catatan, 
														'diagRujukan' 		=> $diagRujukan, 
														'tipeRujukan' 		=> $tipeRujukan, 
														'poliRujukan' 		=> $poliRujukan,
														'jenis_Faskes'		=> $jenis_Faskes);
					$data = array('data_rujukan' => $data_rujukan_keluar, 'data_edit' => $data_edit_rujukan_keluar);
					echo json_encode($data);
				}
			}
		}
		function simpan_rujukan_keluar(){
			$id_rujukan_keluar 			= $this->input->post('id_rujukan_keluar');
			$nodaftar_rujukan_keluar 	= $this->input->post('nodaftar_rujukan_keluar');
			$sep_pasien 				= $this->input->post('sep_pasien');
			$tgl_rujukan 				= $this->input->post('tgl_rujukan');
			$jenis_faskes 				= $this->input->post('jenis_faskes');
			$ppkdirujuk 				= $this->input->post('ppkdirujuk');
			$kd_ppkdirujuk 				= $this->input->post('kd_ppkdirujuk');
			$jenis_layanan 				= $this->input->post('jenis_layanan');
			$catatanrujukan 			= $this->input->post('catatanrujukan');
			$diagnosa_rujukan_keluar 	= $this->input->post('diagnosa_rujukan_keluar');
			$kd_diagnosa_rujukan_keluar = $this->input->post('kd_diagnosa_rujukan_keluar');
			$type_rujukan_keluar 		= $this->input->post('type_rujukan_keluar');
			$poli_rujukan_keluar 		= $this->input->post('poli_rujukan_keluar');
			$kd_poli_rujukan_keluar 	= $this->input->post('kd_poli_rujukan_keluar');
			// $user 						= $this->input->post('coba ws');
			$user 						= 'coba ws';
			$tanggal_sekarang 			= date('Y-m-d');
	    	$id_perusahaan      		= $this->session->userdata('outlet');
	        $id_pegawai         		= $this->session->userdata('id_uname');
	        $get_nip_pegawai    		= $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);

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
			$data1 				= array('noSep' 		=> $sep_pasien, 
										'tglRujukan' 	=> $tgl_rujukan, 
										'ppkDirujuk' 	=> $kd_ppkdirujuk, 
										'jnsPelayanan' 	=> $jenis_layanan, 
										'catatan' 		=> $catatanrujukan, 
										'diagRujukan' 	=> $diagnosa_rujukan_keluar, 
										'tipeRujukan' 	=> $type_rujukan_keluar, 
										'poliRujukan' 	=> $poli_rujukan_keluar, 
										'user' 			=> $user);
			$data_request 				= array('request' => array('t_rujukan' => $data1));
			$simpan_data_rujukan_keluar = array('ID_PERUSAHAAN' => $id_perusahaan,
												'NODAFTAR' 		=> $nodaftar_rujukan_keluar,
												'NIP_PEGAWAI' 	=> $nip_pegawai,
												// 'ID_TARIF' 		=> ,
												'jenis_Faskes' 	=> $jenis_faskes,
												'STATUS' 		=> 1,
												'noSep' 		=> $sep_pasien,
												'tglRujukan' 	=> $tgl_rujukan,
												'ppkDirujuk' 	=> $ppkdirujuk,
												'ppkDirujuk' 	=> $ppkdirujuk,
												'jnsPelayanan' 	=> $jenis_layanan,
												'catatan' 		=> $catatanrujukan,
												'diagRujukan' 	=> $diagnosa_rujukan_keluar,
												'tipeRujukan' 	=> $type_rujukan_keluar,
												'poliRujukan' 	=> $poli_rujukan_keluar,
												'user' 			=> $user);
			if (empty($id_rujukan_keluar)) {
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        $uri = $url."/".$service_name."/Rujukan/insert";
				// Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        // Computes the signature by hashing the salt with the secret key as the key
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        // base64 encode…
		        $encodedSignature = base64_encode($signature);
		        // urlencode…
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);

		        $send = curl_exec($ch);
		  //       ////
		        if ($send === false) {//1
		            die('Error fecthing data: ' .curl_error($ch));
		            //1
		        }else{//1
		        	if ($type_rujukan_keluar==1) { //2
						$data_kosong = 'Kosong';
					}//2
					else{ //2
						$data_respon 	= json_decode($send);
						$metaData 		= $data_respon->metaData;
						$code 			= $metaData->code;
						$message 		= $metaData->message;
						$response 		= $data_respon->response;
						$rujukan 		= $response->rujukan;
						$AsalRujukan 	= $rujukan->AsalRujukan;
						$kode_rujukan	= $AsalRujukan->kode;
						$nama_rujukan	= $AsalRujukan->nama;
						$diagnosa 		= $rujukan->diagnosa;
						$kode_diagnosa	= $diagnosa->kode;
						$nama_diagnosa 	= $diagnosa->nama;
						$noRujukan 		= $rujukan->noRujukan;
						$peserta 		= $rujukan->peserta;
						$asuransi 		= $peserta->asuransi;
						$hakKelas 		= $peserta->hakKelas;
						$jnsPeserta 	= $peserta->jnsPeserta;
						$kelamin 		= $peserta->kelamin;
						$nama_px 		= $peserta->nama;
						$noKartu 		= $peserta->noKartu;
						$noMr 			= $peserta->noMr;
						$tglLahir 		= $peserta->tglLahir;
						$poliTujuan		= $rujukan->poliTujuan;
						$kode_poli 		= $poliTujuan->kode;
						$nama_poli 		= $poliTujuan->poli;
						$tglRujukan		= $rujukan->tglRujuka;
						$tujuanRujukan	= $rujukan->tujuanRujukan;
						$kode_tujuan	= $tujuanRujukan->kode;
						$nama_tujuan	= $tujuanRujukan->nama;

						$data_respon_rujukan_keluar = array('ID_PERUSAHAAN' 		=> $id_perusahaan,
															'NODAFTAR' 				=> $nodaftar_rujukan_keluar,
															'NIP_PEGAWAI' 			=> $nip_pegawai,
															// 'ID_TARIF' => ,
															'STATUS' 				=> '1',
															'AsalRujukan_kode' 		=> $kode_rujukan,
															'AsalRujukan_nama' 		=> $nama_rujukan,
															'diagnosa_kode' 		=> $kode_diagnosa,
															'diagnosa_nama' 		=> $nama_diagnosa,
															'noRujukan' 			=> $noRujukan,
															'peserta_asuransi' 		=> $asuransi,
															'peserta_hakkelas' 		=> $hakKelas,
															'peserta_jnsPeserta' 	=> $jnsPeserta,
															'peserta_kelamin' 		=> $kelamin,
															'peserta_nama' 			=> $nama_px,
															'peserta_noKartu' 		=> $nokartu,
															'peserta_noMr' 			=> $noMr,
															'peserta_tglLahir' 		=> $tglLahir,
															'poliTujuan_kode' 		=> $kode_poli,
															'poliTujuan_nama' 		=> $nama_poli,
															'tglRujukan' 			=> $tglRujukan,
															'tujuanRujukan_kode' 	=> $kode_tujuan,
															'tujuanRujukan_nama' 	=> $nama_tujuan,
															);
						$simpan_data_respon_insert_rujukan = $this->m_api_sep->simpan_data('respon_insert_rujukan', $data_respon_rujukan_keluar);
					}//2
					$simpan_data = $this->m_api_sep->simpan_data('insert_rujukan_keluar', $simpan_data_rujukan_keluar);
		        }//1
			}else{
				$simpan_data = $this->m_api_sep->update_data('insert_rujukan_keluar', $simpan_data_rujukan_keluar, 'NODAFTAR', $nodaftar_rujukan_keluar);
			}
			echo json_encode($simpan_data);

		}
		function update_data_rujukan(){
			$id_rujukan_keluar 			= $this->input->post('id_rujukan_keluar');
			$nodaftar_rujukan_keluar 	= $this->input->post('nodaftar_rujukan_keluar');
			$sep_pasien 				= $this->input->post('sep_pasien');
			$tgl_rujukan 				= $this->input->post('tgl_rujukan');
			$jenis_faskes 				= $this->input->post('jenis_faskes');
			$ppkdirujuk 				= $this->input->post('ppkdirujuk');
			$kd_ppkdirujuk 				= $this->input->post('kd_ppkdirujuk');
			$jenis_layanan 				= $this->input->post('jenis_layanan');
			$catatanrujukan 			= $this->input->post('catatanrujukan');
			$diagnosa_rujukan_keluar 	= $this->input->post('diagnosa_rujukan_keluar');
			$kd_diagnosa_rujukan_keluar = $this->input->post('kd_diagnosa_rujukan_keluar');
			$type_rujukan_keluar 		= $this->input->post('type_rujukan_keluar');
			$poli_rujukan_keluar 		= $this->input->post('poli_rujukan_keluar');
			$kd_poli_rujukan_keluar 	= $this->input->post('kd_poli_rujukan_keluar');
			// $user 						= $this->input->post('coba ws');
			$user 						= 'coba ws';
			$tanggal_sekarang 			= date('Y-m-d');
	    	$id_perusahaan      		= $this->session->userdata('outlet');
	        $id_pegawai         		= $this->session->userdata('id_uname');
	        $get_nip_pegawai    		= $this->m_api_sep->get_nip_pegawai($id_pegawai, $id_perusahaan);

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
			$get_data_respon_rujukan 	= $this->m_api_sep->get_data_respon_rujukan($nodaftar_rujukan_keluar, $id_perusahaan);
			foreach ($get_data_respon_rujukan as $key) {
				$norujukan 			= $key->noRujukan;
				$id_rujukan_keluar 	= $key->ID_RESPON_INSERT_RUJUKAN;
			}
			$t_rujukan['t_rujukan'] = array('noRujukan' 	=> $norujukan,
											'ppkDirujuk' 	=> $kd_ppkdirujuk,
											'tipe' 			=> $type_rujukan_keluar,
											'jnsPelayanan' 	=> $jenis_layanan,
											'catatan' 		=> $catatanrujukan,
											'diagRujukan' 	=> $kd_diagnosa_rujukan_keluar,
											'tipeRujukan' 	=> $type_rujukan_keluar,
											'poliRujukan' 	=> $kd_poli_rujukan_keluar,
											'user' 			=> 'Coba WS',
										);
			$data_request 	= array('request' => $t_rujukan);
			$simpan_data_rujukan_keluar = array('ID_PERUSAHAAN' => $id_perusahaan,
												'NODAFTAR' 		=> $nodaftar_rujukan_keluar,
												'NIP_PEGAWAI' 	=> $nip_pegawai,
												// 'ID_TARIF' 		=> ,
												'jenis_Faskes' 	=> $jenis_faskes,
												'STATUS' 		=> 1,
												'noSep' 		=> $sep_pasien,
												'tglRujukan' 	=> $tgl_rujukan,
												'ppkDirujuk' 	=> $ppkdirujuk,
												'ppkDirujuk' 	=> $ppkdirujuk,
												'jnsPelayanan' 	=> $jenis_layanan,
												'catatan' 		=> $catatanrujukan,
												'diagRujukan' 	=> $diagnosa_rujukan_keluar,
												'tipeRujukan' 	=> $type_rujukan_keluar,
												'poliRujukan' 	=> $poli_rujukan_keluar,
												'user' 			=> $user);
			// $url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        $uri = $url."/".$service_name."/Rujukan/update";
				// Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        // Computes the signature by hashing the salt with the secret key as the key
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        // base64 encode…
		        $encodedSignature = base64_encode($signature);
		        // urlencode…
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);

		        $send = curl_exec($ch);
		       	////
		        if ($send === false) {//1
		            die('Error fecthing data: ' .curl_error($ch));
		            //1
		        }else{//1
		        	$update_data = $this->m_api_sep->update_data('insert_rujukan_keluar', $simpan_data_rujukan_keluar, 'ID_INSERT_RUJUKAN', $id_rujukan_keluar);
		        }
			echo json_encode($data_update_rujukan);
		}
		function hapus_data_rujukan_keluar(){
			$id_perusahaan 				= $this->session->userdata('outlet');
			$id_rujukan_keluar 			= $this->input->post('id_rujukan_keluar');
			$nodaftar_rujukan_keluar 	= $this->input->post('nodaftar_rujukan_keluar');
			$sep_pasien 				= $this->input->post('sep_pasien');
			$tgl_rujukan 				= $this->input->post('tgl_rujukan');
			$get_data_respon_rujukan 	= $this->m_api_sep->get_data_respon_rujukan($nodaftar_rujukan_keluar, $id_perusahaan);
			foreach ($get_data_respon_rujukan as $key) {
				$norujukan 			= $key->noRujukan;
				$id_rujukan_keluar 	= $key->ID_RESPON_INSERT_RUJUKAN;
			}
			$data_hapus_rujukan_keluar 	=  array('noRujukan' => $norujukan, 'user' => 'Coba Ws');
			$data['request'] = array('t_rujukan' => $data_hapus_rujukan_keluar);

				// $url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
		        $uri = $url."/".$service_name."/Rujukan/delete";
				// Computes the timestamp
		        date_default_timezone_set('UTC');
		        $tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		        // Computes the signature by hashing the salt with the secret key as the key
		        $signature 	= hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		        // base64 encode…
		        $encodedSignature = base64_encode($signature);
		        // urlencode…
		        // $urlencodedSignature = urlencode($encodedSignature);
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		            "X-cons-id: $data", 
		            "X-timestamp: $tStamp", 
		            "X-signature: $encodedSignature"
		        ));
		        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_request);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($ch, CURLOPT_URL, $uri);

		        $send = curl_exec($ch);
		       	////
		        if ($send === false) {//1
		            die('Error fecthing data: ' .curl_error($ch));
		            //1
		        }else{//1
		        	$data_respon 		= json_decode($send);
		        	$metaData 			= $data_respon->metaData;
		        	$code 				= $metaData->code;
		        	$message 			= $metaData->message;
		        	$response 			= $data_respon->response;
		        	$data_update 		= array('tujuanRujukan_nama' => $response, 'STATUS' => 0);
		        	$update_data_hapus 	= $this->m_api_sep->update_data($data_update, $id_rujukan_keluar);
		        }
			echo json_encode($update_data_hapus);
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
		function get_data_poli_rujukan(){
			$id_perusahaan 			= $this->session->userdata('outlet');
			$nm_poli 				= $this->input->post('nm_poli');
			$get_token_bpjs 		= $this->m_api_sep->det_outlet($id_perusahaan);
			$hasil_konfirmasi 		= $get_token_bpjs->num_rows();
			if ($hasil_konfirmasi==1) {//pembuka if jika ditemukan cons id
				foreach ($get_token_bpjs->result() as $key) {
					$data 		= $key->no_token;
					$secretKey 	= $key->nokey;
				}
				$url 					= "https://dvlp.bpjs-kesehatan.go.id";
		        $service_name 			= "vclaim-rest";
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
		function insert_rujukan_pasien(){
			// insert rujukan
			$data_insert_rujukan = array(	'ID_PERUSAHAAN' 	=> $id_perusahaan,
											'NODAFTAR' 			=> $nodaftar,
											'NIP_PEGAWAI' 		=> $nip_pegawai,
											'ID_TARIF' 			=> $id_tarif,
											'STATUS' 			=> $status,
											'noSep' 			=> $nosep,
											'tglRujukan' 		=> $tgl_rujukan,
											'ppkDirujuk' 		=> $ppkdirujuk,
											'jnsPelayanan' 		=> $jnspelayanan,
											'catatan' 			=> $catatan,
											'diagRujukan' 		=> $diagnosa,
											'tipeRujukan' 		=> $tiperujukan,
											'poliRujukan' 		=> $polirujukan,
											'user' 				=> $user);
    		$t_rujukan = array(	"noSep" 		=> "0301R0011017V000014",
								"tglRujukan" 	=> "2017-11-08",
								"ppkDirujuk" 	=> "0301R002",
								"jnsPelayanan" 	=> "1",
								"catatan" 		=> "test",
								"diagRujukan" 	=> "A00.1",
								"tipeRujukan" 	=> "1",
								"poliRujukan" 	=> "INT",
								"user" 			=> "Coba Ws");
			$request = array("t_rujukan" => $t_rujukan);
			$data_insert_rujukan = array("request" => $request);
			// response hasil insert rujukan
							$tujuanRujukan = array("kode" => "0301R002", "nama" => "RS JIWA ULU GADUT");
			                $poliTujuan = array("kode" => "INT", "nama" => "Poli Penyakit Dalam");
			                $peserta = array("asuransi" => "-", "hakKelas" => null, "jnsPeserta" => "PNS PUSAT", "kelamin" => "Laki-Laki", "nama" => "ZIYADUL", "noKartu" => "0000000110156", "noMr" => "123456", "tglLahir" => "2008-02-05");
			                $diagnosa= array("kode" => "A00.1","nama" => "A00.1 - Cholera due to Vibrio cholerae 01, biovar eltor");
			                $AsalRujukan = array("kode" => "0301R001", "nama" => "RSUP DR M JAMIL PADANG");
			        $rujukan = array("AsalRujukan" => $AsalRujukan, "diagnosa" => $diagnosa, "noRujukan" => "0301R0011117B001126", "peserta" => $peserta, "poliTujuan" => $poliTujuan, "tglRujukan" => "2017-11-08", "tujuanRujukan" => $tujuanRujukan);
			$response = array("rujukan" => $rujukan);
			$metaData = array("code" => "200", "message" => "OK");
			$response_insert_rujukan = array("metaData" => $metaData, "response" => $response);
			$send = json_encode($response_insert_rujukan);
			$decode_data = json_decode($send);
			$data_respon = $decode_data->response;
			$d_rujukan 	 = $data_respon->rujukan;
			$d_asalrujukan 	= $d_rujukan->AsalRujukan;
			$d_kode 		= $d_asalrujukan->kode;
			$d_nama 		= $d_asalrujukan->nama;
			$d_diagnosa 	= $d_rujukan->diagnosa;
			$d_kode_di 		= $d_diagnosa->kode;
			$d_nama_di 		= $d_diagnosa->nama;
			$d_norujukan 	= $d_rujukan->noRujukan;
			$d_peserta 		= $d_rujukan->peserta;
			$d_asuransi 	= $d_peserta->asuransi;
			$d_hakkelas 	= $d_peserta->hakKelas;
			$d_jnsPeserta 	= $d_peserta->jnsPeserta;
			$d_kelamin 		= $d_peserta->kelamin;
			$d_nama_pe 		= $d_peserta->nama;
			$d_nokartu 		= $d_peserta->noKartu;
			$d_noMr 		= $d_peserta->noMr;
			$d_tglLahir 	= $d_peserta->tglLahir;
			$d_politujuan	= $d_rujukan->poliTujuan;
			$d_kode_poli	= $d_politujuan->kode;
			$d_nama_poli	= $d_politujuan->nama;
			$d_tglrujukan 	= $d_rujukan->tglRujukan;
			$d_tujuan_ru 	= $d_rujukan->tujuanRujukan;
			$d_kode_ru 		= $d_tujuan_ru->kode;
			$d_nama_ru 		= $d_tujuan_ru->nama;
			$data_respon_insert_rujukan = array('ID_PERUSAHAAN' 		=> $id_perusahaan,
												'NODAFTAR' 				=> $nodaftar,
												'NIP_PEGAWAI' 			=> $nip_pegawai,
												'ID_TARIF' 				=> $id_tarif,
												'STATUS' 				=> $status,
												'AsalRujukan_kode' 		=> $d_kode,
												'AsalRujukan_nama' 		=> $d_nama,
												'diagnosa_kode' 		=> $d_kode_di,
												'diagnosa_nama' 		=> $d_nama_di,
												'noRujukan' 			=> $d_norujukan,
												'peserta_asuransi' 		=> $d_asuransi,
												'peserta_hakkelas' 		=> $d_hakkelas,
												'peserta_jnsPeserta' 	=> $d_jnsPeserta,
												'peserta_kelamin' 		=> $d_kelamin,
												'peserta_nama' 			=> $d_nama_pe,
												'peserta_noKartu' 		=> $d_noKartu,
												'peserta_noMr' 			=> $d_noMr,
												'peserta_tglLahir' 		=> $d_tglLahir,
												'poliTujuan_kode' 		=> $d_kode_poli,
												'poliTujuan_nama' 		=> $d_nama_poli,
												'tglRujukan' 			=> $d_tglrujukan,
												'tujuanRujukan_kode' 	=> $d_kode_ru,
												'tujuanRujukan_nama' 	=> $d_nama_ru);
			echo json_encode($d_nama_ru);	
		}
	}
?>