<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
session_save_path('/var/lib/php/sessions');

ini_set('display_errors','off');
// session_start();
class For_Get_Session extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
        $this->load->model('m_login');
        $this->load->model('m_daftar');
        $this->load->library('datatables');
        $this->load->library('session');
        $session_status = $this->session->userdata('status_login');
        if ($session_status!='Oke') {
            redirect('login/cek_login');
        }
    }
    function get_data_login(){
    	// $this->session->set_userdata(array('status_login' => 'Oke', 'username' => $username, 'id_uname' => $data_id, 'outlet' => $data_per));
    	$id_perusahaan 	= $this->session->userdata('outlet');
    	$perusahaan 	= $this->m_login->get_outlet($id_perusahaan);
    	echo json_encode($perusahaan);
    }
    function get_role_permision(){
        $id_uname       = $this->session->userdata('id_uname');
        $username       = $this->session->userdata('username');
        $id_perusahaan  = $this->session->userdata('outlet');
        $role_parent    = $this->m_login->get_user_role($id_uname, $username, $id_perusahaan);
        echo json_encode($role_parent);
    }
}
?>