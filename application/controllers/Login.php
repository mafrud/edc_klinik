<?php
// error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set("session.save_handler", "files");
// session_save_path ("/full-server-path/public_html/tmp"); 
session_save_path('/var/lib/php/sessions');
// session_start();
	class Login extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
                        $this->load->model('m_login');
			$this->load->helper('form');
			// $this->load->library('session');
			// check_session();
			// $this->session;
		}
		
		function cek_login(){
			if (isset($_POST['submit'])) {
        		// echo "Proses Data";
        		$username = $this->input->post('username');
        		$password = $this->input->post('password');
        		$hasil = $this->m_login->cek_login($username,$password);
        		if ($hasil==1) {
        			$input_tgl 	= $this->m_login->update_tgl($username,$password);
        			$get_data 	= $this->m_login->get_data($username,$password);
        			foreach ($get_data->result() as $row) {
						// $data_id 	= $row->ID_USER;
						$data_per 	= $row->ID_PERUSAHAAN;
                                                $id_role        = $row->ID_ROLE;
                                                $data_id        = $row->NIP_PEGAWAI;
					}
					$oke = "Oke";
        		 	$this->session->set_userdata(array('status_login' => $oke, 'username' => $username, 'id_uname' => $data_id, 'outlet' => $data_per));
        		 	$this->session->set_flashdata('set_userdata_ok', 'You set your user data');
        		 	$id_perusahaan = $this->session->userdata('outlet');
        		 	
                                if ($id_role==1) {
                                        redirect('dashboard');
                                }elseif ($id_role==25) {
                                        // if ($username=='emalemal') {
                                        //      $this->load->view('farmasi/pesan_khusus');
                                        // }else{
                                                redirect('farmasi');
                                        // }
                                }elseif ($id_role==21) {
                                        redirect('farmasi');
                                }elseif ($id_role==23) {
                                        redirect('farmasi');
                                }elseif ($id_role==7) {
                                        redirect('farmasi');
                                }elseif ($id_role==15) {
                                        redirect('dashboard');
                                }elseif ($id_role==9) {
                                        redirect('dashboard');
                                }elseif ($id_role==37) {
                                        redirect('dashboard');
                                }elseif ($id_role==17) {
                                        redirect('lap_faktur_penjualan/laporan_faktur_jual');
                                }elseif ($id_role==34) {
                                        redirect('dashboard');
                                }elseif ($id_role==35) {
                                        redirect('lap_faktur_penjualan/laporan_faktur_jual');
                                }elseif ($id_role==36) {
                                        redirect('lap_faktur_penjualan/laporan_faktur_jual');
                                }elseif ($id_role==18) {
                                        redirect('dashboard');
                                }elseif ($id_role==28) {
                                        // redirect('humas/Data_humas');
                                        redirect('humas/Kegiatan');
                                }elseif ($id_role==29) {
                                        // redirect('humas/Data_humas');
                                        redirect('humas/Kegiatan');
                                }elseif ($id_role==6) {
                                        // redirect('humas/Data_humas/laporan_kunjungan_instansi');
                                        redirect('humas/Kegiatan');
                                }elseif ($id_role==19) {
                                        redirect('daftar_antrian/Daftar_antrian_pasien/tes_halaman_daftar_antrian_pasien');
                                }elseif ($id_role==8) {
                                        redirect('humas/Kegiatan');
                                }
        		 	// redirect('dashboard');
        		 }else{
        		 	// check_session_login();
        		 	$id_perusahaan = $this->session->userdata('outlet');
        		 	// echo json_encode($id_perusahaan);
        		 	redirect('login/cek_login');
        		 }
        	}else{
                        
        		// check_session_login();
        		$id_perusahaan = $this->session->userdata('outlet');
        		 	// echo json_encode($id_perusahaan);
        		$this->template->load('template_login','login');
        		// $this->template->load('template_login','login');
        	}
		}
		function logout(){
			session_destroy();
			redirect('login/cek_login');
		}
	}