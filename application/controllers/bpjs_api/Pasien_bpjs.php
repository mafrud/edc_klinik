<?php
	class Pasien_bpjs extends CI_Controller
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
			$this->template->load('template', 'form_api_bpjs/data_pasien_bpjs');
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
											'no_kpst' 			=> $key->no_kpst,
											'status' 			=> $key->status);
			}
			$response = array('data' => $data_pasien_bpjs);
			// contoh pemanggilan function di dalam function di controller codeigniter
 			$data = $this->data_pasien();
			// $data = "tes";
			echo json_encode($response);
		}

		function delete_nosep(){
	    	// $no_sep = $this->input->post('no_sep');
	    	// $user 	= $this->input->post('user');
	    	$nodaftar 		= $this->input->post('nodaftar');
	    	$id_perusahaan 	= $this->session->userdata('outlet');
	    	$nodaftar_lengkap = $id_perusahaan.$nodaftar;
	    	$get_data_nosep = $this->m_api_sep->get_data_sep_pasien($nodaftar_lengkap, $norm);
	    	foreach ($get_data_nosep as $key) {
	    		$no_sep = $key->noSep;
	    	}
	    	// $hsl_no_sep = '0196S0010620V000001';
	    	// $no_sep = $hsl_no_sep;
	    	$user 	= 'Coba Ws';

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

		    $metaData 			= array('code' => '200', 'message' => 'OK');
	    	$data_request 	= array('metaData' => $metaData, 'response' => '0301R0011017V000007');
	    	$send = json_encode($data_request);

	        if ($send === false) {
	            die('Error fecthing data: ' .curl_error($ch));
	        }else{
	        	$decode 			= json_decode($send);
				$meta 				= $decode->metaData;
				$m_code 			= $meta->code;
				$m_message 			= $meta->message;
				$response 			= $decode->response;
				if ($m_code==200) {
					$data_status_rujukan_masuk 				= array('STATUS' => 0);
					$data_respon_insert_sepe_delete			= array('STATUS' => 0, 'noSep' => $response);
			    	$update_status_data_rujukan_masuk 		= $this->m_api_sep->update_data('rujukan_masuk', $data_status_rujukan_masuk, 'NODAFTAR', $nodaftar_lengkap);
			    	$update_status_data_respon_insert_sep 	= $this->m_api_sep->update_data('respon_insert_sep', $data_respon_insert_sepe_delete, 'NODAFTAR', $nodaftar_lengkap);
			    	$update_status_data_respon_insert_sep 	= $this->m_api_sep->update_data('insert_sep', $data_status_rujukan_masuk, 'NODAFTAR', $nodaftar_lengkap);
			    	// $data_status_pendaftaran		 		= array('STATUS_PENDAFTARAN' => 0);
			    	// $update_status_ts_pendaftaran 			= $this->m_api_sep->update_data('ts_pendaftaran', $data_status_pendaftaran, 'NODAFTAR', $nodaftar_lengkap);
			    	// $data_transaksi 						= array('KODE_STATUS' => 0);
			    	// $update_status_data_status_perawatan	= $this->m_api_sep->update_data('ts_biayaperawatan', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	// $update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_obat', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
			    	// $update_status_data_penjualan_obat		= $this->m_api_sep->update_data('ts_penjualan_optik', $data_transaksi, 'NODAFTAR', $nodaftar_lengkap);
					// echo json_encode($m_message);
					echo json_encode($update_status_data_respon_insert_sep);
				}else{
					echo json_encode($m_message);
					// echo $m_message;
				}
	        }
	    	// echo json_encode($data_request);
	    }

		public function data_pasien(){
			$data = "ujiCoba Contoh Public function";
			return $data;
		}
	}
?>