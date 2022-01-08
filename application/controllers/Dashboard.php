<?php 
error_reporting(0);
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) );
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
session_save_path('/var/lib/php/sessions');
// session_start();
date_default_timezone_set('Asia/Jakarta');
class Dashboard extends CI_Controller
{

    public function __construct(){
        parent::__construct();

        $this->load->helper('form');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('m_login');
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
        
        // $this->load->library('session');
            // $this->session;
        // check_session();    
        // load url helper
        // $this->load->helper('url');
    }
    // private function cek_login() {
    //     $session_status = $this->session->userdata('status_login');
    //     if($session_status!='Oke') {
    //     }
    //     else {
    //         // $this->load->helper(array('form'));
    //         // redirect(base_url()."login/cek_login");
    //         redirect('login/cek_login');
    //     }
    // }   
    function index()
    {   
        // $id_perusahaan = $this->session->userdata('status_login');
        // echo json_encode($id_perusahaan);
        $id_perusahaan      = $this->session->userdata('outlet');
        $id_pegawai         = $this->session->userdata('id_uname');
        $username           = $this->session->userdata('username');
        $get_nip_pegawai    = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai    = $key->NIP_PEGAWAI;
            $id_role        = $key->ID_ROLE;
        }
        if ($id_role==1) {
                $this->template->load('template', 'daftar/home_k');
        }elseif ($id_role==25) {
            // if ($username=='emalemal') {
            //     $this->load->view('farmasi/pesan_khusus');
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
                $this->template->load('template', 'daftar/home_k');
        }elseif ($id_role==9) {
                $this->template->load('template', 'daftar/home_k');
        }elseif ($id_role==37) {
                $this->template->load('template', 'daftar/home_k');
        }elseif ($id_role==34) {
                $this->template->load('template', 'daftar/home_k');
        }elseif ($id_role==35) {
                redirect('lap_faktur_penjualan/laporan_faktur_jual');
        }elseif ($id_role==17) {
                redirect('lap_faktur_penjualan/laporan_faktur_jual');
        }elseif ($id_role==36) {
                redirect('lap_faktur_penjualan/laporan_faktur_jual');
        }elseif ($id_role==18) {
                $this->template->load('template', 'daftar/home_k');
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
                // redirect('humas/Data_humas/laporan_kunjungan_instansi');
                redirect('humas/Kegiatan');
        }

    }
    function token(){
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    function get_data_dokter_aktif_ttd(){
        $id_perusahaan      = $this->session->userdata('outlet');
        $get_data_dokter_aktif_ttd    = $this->m_daftar->get_data_dokter_aktif_ttd($id_perusahaan);
        echo json_encode($get_data_dokter_aktif_ttd);
    }
    function update_ttd_data(){
        $status         = $this->input->post('status');
        $id             = $this->input->post('id');
        $id_perusahaan  = $this->session->userdata('outlet');
        if ($status==1) {
            $data = array('STATUS_CETAK' => 0);
        }else{
            $data = array('STATUS_CETAK' => 1);
        }
        $update_status_ttd_cetak = $this->m_daftar->update_status_ttd_cetak($data, $id);
        echo json_encode($update_status_ttd_cetak);
    }
    function get_pasien_lama(){
        $no_rm_pasien_lama  = $this->input->post('no_rm_pasien_lama');
        $nama_pasien_lama   = $this->input->post('nama_pasien_lama');
        $id_perusahaan      = $this->session->userdata('outlet');
        // $id_perusahaan      = 'MJG';
        $get_pasien_lama    = $this->m_daftar->get_pasien_dos($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan);
        echo json_encode($get_pasien_lama);
    }
    function get_pasien_screening(){
        $nik_pasien_screening   = $this->input->post('nik_pasien_screening');
        $no_rm_pasien_lama      = $this->input->post('no_rm_pasien_lama');
        $nama_pasien_lama       = $this->input->post('nama_pasien_lama');
        $id_perusahaan          = $this->session->userdata('outlet');
        if (empty($nik_pasien_screening)) {
            $get_pasien_screening  = $this->m_daftar->get_pasien_screening2($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening);
        }else{
            $get_pasien_screening  = $this->m_daftar->get_pasien_screening($no_rm_pasien_lama, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening);
        }
        echo json_encode($get_pasien_screening);
    }
    function laporan_harian(){
        $this->template->load('template', 'laporan_h/laporan_keuangan');
    }
    function get_data_pasien(){
        $no_rm_pasien_lama  = $this->input->post('no_rm_pasien_lama');
        $nama_pasien_lama   = $this->input->post('nama_pasien_lama');
        $nik_pasien_screening   = $this->input->post('nik_pasien_screening');
        $id_perusahaan      = $this->session->userdata('outlet');
        if (empty($nik_pasien_screening)) {
            if (empty($no_rm_pasien_lama)) {
                $norm_lengkap   = '';
            }else{
                $norm_lengkap   = $id_perusahaan.$no_rm_pasien_lama;
            }
            $get_pasien     = $this->m_daftar->get_semua_pasien($norm_lengkap, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening);
        }else{
            $get_pasien     = $this->m_daftar->get_semua_pasien2($norm_lengkap, $nama_pasien_lama, $id_perusahaan, $nik_pasien_screening);
        }
        echo json_encode($get_pasien);
    }
    function detail_pasien(){
        $norm           = $this->input->post('norm');
        $id_perusahaan  = $this->session->userdata('outlet');
        $detail_pasien  = $this->m_daftar->detail_pasien($norm, $id_perusahaan);
        foreach ($detail_pasien as $row) {
            $norm_lama  =  $row->NORM_LAMA;
        }
        echo json_encode($norm_lama);
    }
    function get_data_pendaftar(){
        $tgl_sekarang       = date('Y-m-d');
        $id_role            = $this->input->post('id_role');
        $id_perusahaan      = $this->session->userdata('outlet');
        $id_pegawai         = $this->session->userdata('id_uname');
        $username           = $this->session->userdata('username');
        $get_nip_pegawai    = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai    = $key->NIP_PEGAWAI;
            $role_id        = $key->ID_ROLE;
        }
        if ($role_id==37) {
            $data['role_id']= $role_id;
            $data['pasien'] = $this->m_daftar->get_pendaftaran_pasien_hari_ini($tgl_sekarang, $id_perusahaan, $nip_pegawai);
            echo json_encode($data);
        }else{
            $data['role_id']= $role_id;
            $data['pasien'] = $this->m_daftar->get_pendaftaran_pasien_hari_ini2($tgl_sekarang, $id_perusahaan);
            echo json_encode($data);
        }
    }
    function get_data_riwayat(){
        $tanggal1       = $this->input->post('tanggal_rwyt1');
        $tanggal2       = $this->input->post('tanggal_rwyt2');
        $id_perusahaan  = $this->session->userdata('outlet');
        $id_pegawai     = $this->session->userdata('id_uname');
        $username       = $this->session->userdata('username');
        $get_nip_pegawai = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai = $key->NIP_PEGAWAI;
        }
        $data           = $this->m_daftar->get_data_riwayat($id_perusahaan, $nip_pegawai, $tanggal1, $tanggal2);
        echo json_encode($data);   
    }
    function riwayat_terapi_pasien(){
        $nodaftar                 = $this->input->post('nodaftar');
        $data['terapi_tindakan']  = $this->m_daftar->riwayat_terapi_tindakan($nodaftar);
        $data['terapi_obat']      = $this->m_daftar->riwayat_terapi_obat($nodaftar);
        $data['terapi_optik']     = $this->m_daftar->riwayat_terapi_optik($nodaftar);
        $data['terapi_sewa']     = $this->m_daftar->riwayat_sewa($nodaftar);
        echo json_encode($data);
    }
    function get_list_sewa_mobil(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_list_sewa =  $this->m_daftar->get_list_sewa_mobil($id_perusahaan);
        echo json_encode($get_list_sewa);
    }
    function get_harga_sewa(){
        $id_sewa        = $this->input->post('id_sewa');
        $get_harga_sewa = $this->m_daftar->get_harga_sewa($id_sewa);
        echo json_encode($get_harga_sewa);
    }
    function get_data_sewa(){
        $norm           = $this->input->post('norm');
        $daftar         = $this->input->post('daftar');
        $get_data_sewa  = $this->m_daftar->get_data_sewa($daftar);
        echo json_encode($get_data_sewa);
    }
    function nama_obat(){
        $nm_obat = $this->m_daftar->get_nama_obat();
        echo json_encode($nm_obat);
    }
    function nama_optik(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $nm_optik       = $this->m_daftar->get_nama_optik($id_perusahaan);
        echo json_encode($nm_optik);
    }
    function get_penjualan_optik_hari_ini(){
        $nodaftar       = $this->input->post('nodaftar');
        $id_perusahaan  = $this->session->userdata('outlet');
        $tgl_sekarang   = $this->input->post('tgl_input_tindakan');
        $get_penjualan_optik = $this->m_daftar->get_penjualan_optik_hari_ini($nodaftar, $tgl_sekarang);
        echo json_encode($get_penjualan_optik);
    }
    function get_harga_barang(){
        $id_stok        = $this->input->post('id_stok');
        $id_perusahaan  = $this->session->userdata('outlet');
        $data           = $this->m_daftar->get_harga_barang($id_stok, $id_perusahaan);
        echo json_encode($data);
    }
    function get_harga_optik(){
        $id_stok        = $this->input->post('id_stok');
        $id_perusahaan  = $this->session->userdata('outlet');
        $data           = $this->m_daftar->get_harga_optik($id_stok, $id_perusahaan);
        echo json_encode($data);
    }
    function update_kd_golongan(){
        $norm           = $this->input->post('norm_perubahan_golongan');
        $nodaftar       = $this->input->post('nodaftar_perubahan_golongan');
        $kd_gol_baru    = $this->input->post('kode_golongan_baru');
        $keterangan     = $this->input->post('keterangan_perubahan');
        $tanggal_skr    = date('Y-m-d');
        $jam_sekarang   = date("h:i:s");
        $data   = array('STATUS_PERUBAHAN' => 1,'KODE_PERUBAHAN' => $kd_gol_baru, 'KETERANGAN' => $keterangan, 'TGL_PERUBAHAN' => $tanggal_skr, 'JAM_PERUBAHAN' => $jam_sekarang);
        $simpan = $this->m_daftar->update_pendaftaran($data, $nodaftar);
        redirect('dashboard');
    }
    function update_detail_pasien(){
        $nik_pasien_detail  = $this->input->post('nik_pasien_detail');
        $norm_pasien    	= $this->input->post('norm_pasien_detail');
        $nama_pasien    	= $this->input->post('nama_pasien_detail');
        $jk             	= $this->input->post('jk_detail');
        $tempat_lahir   	= $this->input->post('tempat_lahir_detail');
        $tgl_lahir      	= $this->input->post('tgl_lahir_detail');
        $pekerjaan      	= $this->input->post('pekerjaan_detail');
        $alamat         	= $this->input->post('alamat_detail');
        $notelp             = $this->input->post('no_telp_detail');
        $no_kpst_detail     = $this->input->post('no_kpst_detail');
        $norm_lama      	= $this->input->post('no_rm_lama');
        
        $data   = array('NAMA'          => $nama_pasien,
                        'NIK'           => $nik_pasien_detail, 
                        'ALAMAT'        => $alamat, 
                        'JK'            => $jk,
                        'TEMPAT_LAHIR'  => $tempat_lahir, 
                        'TANGGAL_LAHIR' => $tgl_lahir, 
                        'TELP'          => $notelp,
                        'PEKERJAAN'     => $pekerjaan,
                        'NOKPST'        => $no_kpst_detail,
                        'NORM_LAMA'     => $norm_lama);
        $simpan = $this->m_daftar->update_pasien($norm_pasien, $data);
        redirect('dashboard');
    }
    function retur_terapi_pasien(){
        $id_penjualan       = $this->input->post('id_penjualan');
        $id_stok_retur      = $this->input->post('id_stok_retur');
        $nm_obat_retur      = $this->input->post('nm_obat_retur');
        $qty_retur_awal     = $this->input->post('qty_retur_awal');
        $qty_retur          = $this->input->post('qty_retur');
        $Keterangan_retur   = $this->input->post('Keterangan_retur');
        $jenis_retur        = $this->input->post('jenis_retur');
        $id_perusahaan      = $this->session->userdata('outlet');
        $id_pegawai         = $this->session->userdata('id_uname');
        $tgl_sekarang       = date('Y-m-d');
        $jam_sekarang       = date("h:i:s");
        $username           = $this->session->userdata('username');
        $get_nip_pegawai    = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai = $key->NIP_PEGAWAI;
        }
        if (empty($id_penjualan&&$id_stok_retur&&$Keterangan_retur&&$qty_retur)) {
            echo json_encode("Maaf Semua Form Harus Di isi");
        }else{
            $get_stok_obat = $this->m_daftar->get_stok_obat($id_stok_retur);
            foreach ($get_stok_obat as $row) {
                $id_stok    = $row->ID_STOK;
                $stok_ready = $row->STOK_READY;
                if (empty($stok_ready)) {
                    $stok_obat = 0;
                }else{
                    $stok_obat = $row->STOK_READY;
                }
                $qty_stok   = $qty_retur+$stok_obat;
            }
            if ($jenis_retur=='obat') {
                $get_penjualan  = $this->m_daftar->get_penjualan_obat($id_penjualan);
                foreach ($get_penjualan as $row) {
                    $idjual         = $row->ID_PENJUALAN;
                    $qtyjual        = $row->QTY;
                    $hrgjual        = $row->HARGA_JUAL;
                    $nodaftar       = $row->NODAFTAR;
                    $norm           = $row->NORM;
                    $kd_obat        = $row->KODE_OBAT;
                    $totalbiaya     = $qty_retur*$hrgjual;
                    $tot_qty        = $qtyjual-$qty_retur;
                    $tot_qty_obt    = $qtyjual-$qty_retur;
                }
            }else{
                $get_penjualan_optik  = $this->m_daftar->get_penjualan_optik($id_penjualan);
                foreach ($get_penjualan_optik as $row) {
                    $idjual     = $row->ID_PENJUALAN_OPTIK;
                    $qtyjual    = $row->QTY;
                    $hrgjual    = $row->HARGA_SATUAN;
                    $nodaftar   = $row->NODAFTAR;
                    $norm       = $row->NORM;
                    $kd_obat    = $row->KODE_OBAT;
                    $totalbiaya = $qty_retur*$hrgjual;
                    $tot_qty    = $qtyjual-$qty_retur;
                    $tot_qty_opt    = $qtyjual-$qty_retur;
                }
            }
            $data_stok      = array('STOK_READY' => $qty_stok);
            // $update_stok    = $this->m_daftar->update_retur('ms_stok_obat', 'ID_STOK', $id_stok_retur, $data_stok);
            if ($jenis_retur=='obat') {
                $data_penjualan = array('QTY'           => $qty_retur,
                                        'KODE_STATUS'   => 0,
                                        'QTY_AWAL'      => $qtyjual);
                $update_jual    = $this->m_daftar->update_retur('ts_penjualan_obat', 'ID_PENJUALAN', $id_penjualan, $data_penjualan);
                $validasi       = "Approve";
                $data_stok              = array('STOK_READY'    => $stok_ready+$qtyjual);
                $update_stok_obat       = $this->m_daftar->update_stok_obat($id_stok, $data_stok);
                // $update_stok    = $this->m_daftar->update_retur('ms_stok_obat', 'ID_STOK', $id_stok_retur, $data_stok);
            }else{
                $data_penjualan = array('QTY'        => $tot_qty_opt,
                                        'QTY_AWAL'   => $qtyjual,
                                        'KODE_STATUS'   => 0);
                $update_jual    = $this->m_daftar->update_retur('ts_penjualan_optik', 'ID_PENJUALAN_OPTIK', $idjual, $data_penjualan);
                $validasi       = "Retur";
            }
            if (empty($kd_obat)) {
                $kdobat3 = 0;
            }else{
                $kdobat3 = $kd_obat;
            }
            if (empty($id_stok_retur)) {
                $idstok3 = 0; 
            }else{
                $idstok3 = $id_stok_retur;
            }
            // $update_jual    = $this->m_daftar->update_retur('ts_penjualan_obat', 'ID_PENJUALAN', $id_penjualan, $data_penjualan);
            if ($jenis_retur=='obat') {
                $data_retur_jual= array('NIP_PEGAWAI'   => $nip_pegawai,
                                    'ID_PERUSAHAAN'     => $id_perusahaan,
                                    'NODAFTAR'          => $nodaftar,
                                    'NORM'              => $norm,
                                    'ID_PENJUALAN'      => $id_penjualan,
                                    'KODE_OBAT'         => $kdobat3,
                                    'ID_STOK'           => $idstok3,
                                    'TGL_RETUR'         => $tgl_sekarang,
                                    'JAM_RETUR'         => $jam_sekarang,
                                    'JUMLAH_SATUAN'     => $qty_retur,
                                    'JUMLAH_TAGIHAN'    => $totalbiaya,
                                    'KETERANGAN'        => $Keterangan_retur,
                                    'VALIDASI'          => $validasi);
            }else{
                $data_retur_jual= array('NIP_PEGAWAI'   => $nip_pegawai,
                                    'ID_PERUSAHAAN'     => $id_perusahaan,
                                    'NODAFTAR'          => $nodaftar,
                                    'NORM'              => $norm,
                                    'ID_PENJUALAN'      => $id_penjualan,
                                    'NAMA_BARANG'       => $nm_obat_retur,
                                    // 'KODE_OBAT'         => $kdobat3,
                                    // 'ID_STOK'           => $idstok3,
                                    'TGL_RETUR'         => $tgl_sekarang,
                                    'JAM_RETUR'         => $jam_sekarang,
                                    'JUMLAH_SATUAN'     => $qty_retur,
                                    'JUMLAH_TAGIHAN'    => $totalbiaya,
                                    'KETERANGAN'        => $Keterangan_retur,
                                    'VALIDASI'          => $validasi);
            }
            $simpan_retur['status']   = $this->m_daftar->simpan_retur('ts_retur_jual', $data_retur_jual);
            $simpan_retur['nodaftar'] = $nodaftar;
        }
        echo json_encode($simpan_retur);
    }
    function provinsi(){
        // $provinsi = "http://jendela.data.kemdikbud.go.id/api/index.php/CWilayah/wilayahGET";

        $url="http://dev.farizdotid.com/api/daerahindonesia/provinsi";
        $get_url = file_get_contents($url);
        $ubah   = json_encode($get_url);
        // $get_url='ok';

        echo $get_url;
        // print_r($get_url);
    }
    function kabupaten(){
        $id_provinsi        = $this->input->post('id_provinsi');
        // $url_kabupaten      = "http://dev.farizdotid.com/api/daerahindonesia/provinsi/$id_provinsi/kabupaten";
        $url_kabupaten      = "http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=$id_provinsi";
        $get_url_kabupaten  = file_get_contents($url_kabupaten);
        // $get_url_kabupaten = 'ok';
        echo $get_url_kabupaten;
    }
    function kecamatan(){
        $id_kabupaten       = $this->input->post('id_kabupaten');
        // $url_kecamatan      = "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/$id_kabupaten/kecamatan";
        $url_kecamatan      = "https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=$id_kabupaten";
        $get_url_kecamatan  = file_get_contents($url_kecamatan);
        // $get_url_kecamatan = 'ok';
        echo $get_url_kecamatan;
    }
    function desa(){
        $id_kecamatan  = $this->input->post('id_kecamatan');
        // $url_desa      = "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/$id_kecamatan/desa";
        $url_desa      = "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=$id_kecamatan";
        $get_url_desa  = file_get_contents($url_desa);
        // $get_url_desa   = 'ok';
        echo $get_url_desa;
    }
    function get_karcis(){
        $id_dokter  = $this->input->post('id_dokter');
        $outlet     = $this->session->userdata('outlet');
        $karcis['admin']        = $this->m_daftar->get_karcis($outlet);
        $karcis['pemeriksaan']  = $this->m_daftar->get_karcis_pemeriksaan($outlet);
        $karcis['dokter']       = $this->m_daftar->get_terif_dokter_aktif($outlet, $id_dokter);
        echo json_encode($karcis);
    }
    function get_dokter(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $dokter         = $this->m_daftar->get_dokter($id_perusahaan);
        echo json_encode($dokter);
    }
    function get_dokter_nodaftar(){
        $nodaftar       = $this->input->post('NODAFTAR');
        $id_perusahaan  = $this->session->userdata('outlet');
        $dokter         = $this->m_daftar->get_dokter_nodaftar($id_perusahaan, $nodaftar);
        echo json_encode($dokter);
    }
    function get_tindakan_karcis_by_nodaftar(){
        $nodaftar       = $this->input->post('NODAFTAR');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_tindakan   = $this->m_daftar->get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan);
        echo json_encode($get_tindakan);
    }
    function status_cetak_karcis(){
    	$id 	= $this->input->post('id');	
    	$status = $this->input->post('status');
    	$data 	= array('PRINT' => $status);
    	$update_status_cetak_k = $this->m_daftar->update_status_cetak('ts_biayaperawatan', 'ID_PERAWATAN', $id, $data);
    	echo json_encode($update_status_cetak_k);
    }
    function status_cetak_obat(){
    	$id 	= $this->input->post('id');	
    	$status = $this->input->post('status');
    	$data 	= array('PRINT' => $status);
    	$update_status_cetak_o = $this->m_daftar->update_status_cetak('ts_penjualan_obat', 'ID_PENJUALAN', $id, $data);
    	echo json_encode($update_status_cetak_o);
    }
    function status_cetak_optik(){
    	$id 	= $this->input->post('id');	
    	$status = $this->input->post('status');
    	$data 	= array('PRINT' => $status);
    	$update_status_cetak_op = $this->m_daftar->update_status_cetak('ts_penjualan_optik', 'ID_PENJUALAN_OPTIK', $id, $data);
    	echo json_encode($update_status_cetak_op);
    }
    function status_cetak_sewa(){
    	$id 	= $this->input->post('id');	
    	$status = $this->input->post('status');
    	$data 	= array('PRINT' => $status);
    	$update_status_cetak_sw = $this->m_daftar->update_status_cetak('ts_sewa_kendaraan', 'ID_SEWA', $id, $data);
    	echo json_encode($update_status_cetak_sw);
    }
    function get_tarif_bayar_karcis(){
        $nodaftar                       = $this->input->post('nodaftar');
        $tgl_sekarang                   = date('Y-m-d');
        $get_biaya_k['tindakan_dok']    = $this->m_daftar->get_tarif_bayar_karcis($nodaftar,$tgl_sekarang);
        $get_biaya_k['admin']           = $this->m_daftar->get_tarif_bayar_karcis2($nodaftar,$tgl_sekarang);
        $get_biaya_k['nama_dokter']     = $this->m_daftar->get_nama_dokter_bayar_karcis($nodaftar,$tgl_sekarang);
        echo json_encode($get_biaya_k);
    }
    function get_harga_karcis_urgen(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $id_tindakan    = $this->input->post('id_tindakan');
        $nodaftar       = $this->input->post('nodaftar');
        $dokter         = $this->input->post('dokter');
        $tgl_sekarang   = date('Y-m-d');
        $get_biaya_k_u['harga']  = $this->m_daftar->get_karcis_urgen($id_perusahaan, $id_tindakan);
        $get_biaya_k_u['dokter'] = $this->m_daftar->get_nama_dokter_karcis_urgen($dokter);
        echo json_encode($get_biaya_k_u);
    }
    function get_obat_outlet(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_obat       = $this->m_daftar->get_obat_outlet($id_perusahaan);
        echo json_encode($get_obat);
    }
    function get_obat_resep(){
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_resep      = $this->m_daftar->get_obat_resep($id_perusahaan);
        echo json_encode($get_resep);
    }
    function simpan_resep_obat(){
        $id_resep       = $this->input->post('id_resep');
        $nodaftar       = $this->input->post('nodaftar_resep');
        $norm           = $this->input->post('norm_resep');
        $idresep        = $this->input->post('idresep');
        $qty            = $this->input->post('qty_resep');
        $tanggal_hariini = date('Y-m-d');
        $jam_sekarang   = date("h:i:s");
        $uname          = $this->session->userdata('id_uname');
        $id_perusahaan  = $this->session->userdata('outlet');
        $username       = $this->session->userdata('username');
        $get_nip_pegawai = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $row) {
            $nip_peg = $row->NIP_PEGAWAI;
        }
        $stok_tarif     = $this->m_daftar->get_kode_obat($idresep);
        foreach ($stok_tarif as $row) {
            $kode_o         = $row->kode_o;
            $hrg_jual       = $row->hrg_jual;
            $total_harga    = $hrg_jual*$qty;
            $hrg_het        = $row->hrg_het;
            $tgl_expired    = $row->tgl_expired;
        }
        if (empty($id_resep)) {
            $data           = array('ID_PERUSAHAAN'    => $id_perusahaan,
                                     'NODAFTAR'         => $nodaftar,
                                     'NORM'             => $norm,
                                     'KODE_OBAT'        => $kode_o,
                                     'ID_STOK'          => $idresep,
                                     'TGL_JUAL'         => $tanggal_hariini,
                                     'JAM_JUAL'         => $jam,
                                     'HARGA_JUAL'       => $hrg_jual,
                                     'NIP_PEGAWAI'      => $nip_peg,
                                     'QTY'              => $qty,
                                     'BIAYA'            => $total_harga,
                                     'HARGA_HET'        => $hrg_het,
                                     'TGL_EXPIRED'      => $hrg_expired_s,
                                     'KODE_STATUS'      => 3);
                                     // 'KETERANGAN'       => 'Resep');
            $simpan['status']    = $this->m_daftar->simpan_resep_obat('ts_penjualan_obat', $data);
        }else{
            $data           = array('ID_PERUSAHAAN'    => $id_perusahaan,
                                     'NODAFTAR'         => $nodaftar,
                                     'NORM'             => $norm,
                                     'KODE_OBAT'        => $kode_o,
                                     'ID_STOK'          => $idresep,
                                     'TGL_JUAL'         => $tanggal_hariini,
                                     'JAM_JUAL'         => $jam,
                                     'HARGA_JUAL'       => $hrg_jual,
                                     'NIP_PEGAWAI'      => $nip_peg,
                                     'QTY'              => $qty,
                                     'BIAYA'            => $total_harga,
                                     'HARGA_HET'        => $hrg_het,
                                     'TGL_EXPIRED'      => $hrg_expired_s,
                                     'KODE_STATUS'      => 3);
                                     // 'KETERANGAN'       => 'Resep');
            $simpan['status'] = $this->m_daftar->update_resep_obat('ts_penjualan_obat', 'ID_PENJUALAN', $data, $id_resep);
        }
        $simpan['nodaftar'] = $nodaftar;
        echo json_encode($simpan);
    }
    function hapus_resep_obat(){
        $id_resep   = $this->input->post('id_resep');
        $delete     = $this->m_daftar->hapus_data('ts_penjualan_obat', 'ID_PENJUALAN', $id_resep);
        echo json_encode($delete);
    }
    function get_resep_pasien(){
        $nodaftar       = $this->input->post('nodaftar');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_data       = $this->m_daftar->get_resep_pasien($nodaftar);
        echo json_encode($get_data);
    }
    function get_data_obat_pasien_belum_bayar(){
        $nodaftar           = $this->input->post('nodaftar');
        $get_obat_pasien    = $this->m_daftar->get_data_obat_pasien_belum_bayar($nodaftar);
        echo json_encode($get_obat_pasien);
    }
    function data_tindakan_outlet(){
        $id_perusahaan      = $this->session->userdata('outlet');
        $get_data_tindakan  = $this->m_daftar->data_tindakan_outlet($id_perusahaan);
        echo json_encode($get_data_tindakan);
    }
    function get_validasi_jenis_tindakan(){
        $id_tarif_tindakan = $this->input->post('id_tarif_tindakan');
        $get_data_validasi_tindakan  = $this->m_daftar->get_data_validasi_tindakan($id_tarif_tindakan);
        foreach ($get_data_validasi_tindakan as $key) {
            $kode_jenis         = $key->kode_jenis;
            $id_tarif_tindakan  = $key->id_tarif;
            $tarif              = $key->tarif;
        }
        if ($kode_jenis==4 || $kode_jenis==5) {
            $data['id_tarif_tindakan']  = $id_tarif_tindakan;
            $data['tarif']              = $tarif;
        }else{
            $data['id_tarif_tindakan']  = 'kosong';
            $data['tarif']              = 'kosong';
        }
        echo json_encode($data);
    }
    function get_daftar_tindakan_kepada_pasien(){
        $nodaftar       = $this->input->post('nodaftar');
        $tgl_sekarang   = $this->input->post('tgl_input_tindakan');
        $get_data       = $this->m_daftar->get_daftar_tindakan_kepada_pasien($nodaftar, $tgl_sekarang);
        echo json_encode($get_data);
    }
    function get_tindakan_global(){
        $nodaftar                       = $this->input->post('nodaftar');
        $tgl_sekarang                   = $this->input->post('tgl_input_tindakan');
        $get_data['list_tindakan']      = $this->m_daftar->get_tindakan_global($nodaftar, $tgl_sekarang);
        $get_data['tot_tindakan']       = $this->m_daftar->get_tot_tindakan_global($nodaftar, $tgl_sekarang);
        echo json_encode($get_data);
    }
    function get_obat_global(){
        $nodaftar       = $this->input->post('nodaftar');
        $tgl_sekarang   = $this->input->post('tgl_input_tindakan');
        $get_data['list_obat']      = $this->m_daftar->get_obat_global($nodaftar, $tgl_sekarang);
        $get_data['tot_obat']       = $this->m_daftar->get_tot_obat_global($nodaftar, $tgl_sekarang);
        $get_data['list_optik']     = $this->m_daftar->get_penjualan_optik_hari_ini($nodaftar, $tgl_sekarang);
        $get_data['tot_optik']      = $this->m_daftar->get_tot_optik_global($nodaftar, $tgl_sekarang);
        $get_data['list_sewa']      = $this->m_daftar->get_data_sewa($nodaftar);
        $get_data['tot_sewa']       = $this->m_daftar->get_tot_sewa($nodaftar);
        echo json_encode($get_data);
    }
    function tagihan_optik(){
        $nodaftar       = $this->input->post('nodaftar');
        $get_data       = $this->m_daftar->get_tagihan_optik($nodaftar);
        echo json_encode($get_data);
    }
    function tagihan_sewa(){
        $nodaftar       = $this->input->post('nodaftar');
        $get_data       = $this->m_daftar->get_tagihan_sewa($nodaftar);
        echo json_encode($get_data);
    }
    function get_biaya_bayar_tindakan(){
        $nodaftar                           = $this->input->post('nodaftar');
        $tgl_sekarang                       = $this->input->post('tgl_input_tindakan');
        $tot_jumlah;
        $biaya_operasi                      = $this->m_daftar->get_biaya_bayar_operasi($nodaftar, $tgl_sekarang);
        foreach ($biaya_operasi as $row) {
            $id_biaya_perawatan = $row->id_biaya_perawatan;
            $tot_biaya_op       = $row->tot_biaya_op;
            $tot_jumlah         = $tot_jumlah+$tot_biaya_op;
        }
        if (empty($tot_jumlah)) {
            $jumlah_operasi = 0;
        }else{
            $jumlah_operasi = $tot_jumlah;
        }
        $get_data['id_biaya_perawatan']     = $id_biaya_perawatan;
        $get_data['biaya_operasi']          = $jumlah_operasi;
        $get_data['biaya_bukan_operasi']    = $this->m_daftar->get_baiaya_bayar_bukan_operasi($nodaftar, $tgl_sekarang);
        $get_data['biaya_obat']             = $this->m_daftar->get_biaya_bayar_obat($nodaftar, $tgl_sekarang);
        echo json_encode($get_data);
    }
    function get_data_session(){
        $username = $this->session->userdata('status_login');
        // $user       = $this->session->has_userdata('username');
        $id_user    = $this->m_login->get_data($username);;
        foreach ($id_user->result() as $row) {
            $data_id    = $row->ID_USER;
            $data_per   = $row->ID_PERUSAHAAN;
        }
        print_r($this->session->userdata('username'));
        echo json_encode($username);
    }
    function hapus_obat_pasien(){
        $id_penjualan       = $this->input->post('id_jualobat');
        $id_obat            = $this->input->post('id_produk');
        $qty                = $this->input->post('qty');
        $stok_tarif         = $this->m_daftar->get_kode_obat($id_obat);
        foreach ($stok_tarif as $row) {
            $stok           = $row->jum_stock;
            $jumlahkan_stok = $stok+$qty;
        }
        $data_update_stok   = array('STOK_READY' => $jumlahkan_stok);
        $update_stok_obat   = $this->m_daftar->update_stok_obat($id_obat, $data_update_stok);
        $delete = $this->m_daftar->delete_list_obat_pasien($id_penjualan);
        echo json_encode($delete);
    }
    function hapus_list_tindakan_pasien(){
        $id_biaya_perawatan = $this->input->post('id_tindakan');
        $hapus = $this->m_daftar->hapus_list_tindakan_pasien($id_biaya_perawatan);
        echo json_encode($hapus);
    }
    function hapus_sewa_mobil(){
        $id_sewa            = $this->input->post('id_sewa');
        $hapus_sewa_mobil   = $this->m_daftar->hapus_sewa('ts_sewa_kendaraan', 'ID_SEWA', $id_sewa);
        echo json_encode($hapus_sewa_mobil);
    }
    function update_cetak_dan_keterangan(){
        $keterangan = $this->input->post('keterangan');
        $id         = $this->input->post('id');
        $nokarcis   = $this->input->post('nokarcis');
        $cetak      = $this->input->post('cetak');
        if (empty($keterangan&&$id&&$nokarcis&&$cetak)) {
            echo json_encode('Salah');
        }else{
            $data   = array('CETAK'     => $cetak+1,
                          'KETERANGAN'  => $keterangan);
            $update = $this->m_daftar->update_cetak_dan_keterangan($data, $nokarcis);
            echo json_encode($update);
        }
    }
    function update_retur_tindakan_karcis(){
        $id_perawatan   = $this->input->post('id');
        $keterangan     = $this->input->post('keterangan');
        if (empty($keterangan)) {
            echo json_encode('Salah');
        }else{
            $data           = array('KETERANGAN'    => $keterangan,
                                    'BIAYA'         => 0,
                                    'KODE_STATUS'   => 0);
            $update         = $this->m_daftar->update_data_tindakan_pasien($id_perawatan, $data);
            echo json_encode($update);
        }
    }
    function hapus_tindakan_karcis(){
        $id_perawatan   = $this->input->post('id');
        $hapus          = $this->m_daftar->delete_tindakan_karcis_pasien($id_perawatan);
        echo json_encode($hapus);
    }
    function simpan_karcis_urgen(){
        $nodaftar           = $this->input->post('nodaf_ksr_urgen');
        $norm               = $this->input->post('norm_ksr_urgen');
        $id_tarif           = $this->input->post('daftar_id_karcis');
        $tarif              = $this->input->post('tagihan_karcis_urgen');
        $id_perusahaan      = $this->session->userdata('outlet');
        $uname              = $this->session->userdata('id_uname');
        $tanggal_hariini    = $this->input->post('tgl_kasir');
        $id_dokter    		= $this->input->post('id_dokter_input_karcis_urgen');
        $jam_sekarang       = date("h:i:s");
        $get_pendaftaran = $this->m_daftar->get_pendaftaran($nodaftar);
        foreach ($get_pendaftaran as $row) {
        	$nip_peg 	= $row->NIP_PEGAWAI;
        	$id_dokter 	= $row->ID_TARIF;
        }
        $get_kode_dokter = $this->m_daftar->get_kode_dokter($id_dokter);
        foreach ($get_kode_dokter as $key) {
        	$kode_dokter = $key->ID_DOKTER;
        }
        $get_jasmed_dokter = $this->m_daftar->get_jasmed_dokter($id_tarif, $id_perusahaan);
        foreach ($get_jasmed_dokter as $key) {
        	if ($kode_dokter==1) {
        		$jasmed = $key->ERD;
        		if (empty($jasmed)) {
        			$tarif_jasmed = 0;
        		}else{
        			$tarif_jasmed = $jasmed;
        		}
        	}else{
        		$jasmed = $key->SPM_LAIN;
        		if (empty($jasmed)) {
        			$tarif_jasmed = 0;
        		}else{
        			$tarif_jasmed = $jasmed;
        		}
        	}
        }
        if (empty($nodaftar&&$norm&&$id_tarif)) {
            echo json_encode("Salah");
        }else{
            $data_tindakan  = array('NODAFTAR'          => $nodaftar,
                                    'ID_PERUSAHAAN'     => $id_perusahaan,
                                    'NIP_PEGAWAI'       => $nip_peg,
                                    'ID_TARIF'          => $id_dokter,
                                    'NORM'              => $norm,
                                    'ID_TARIF_TINDAKAN' => $id_tarif,
                                    'TGL_TINDAKAN'      => $tanggal_hariini,
                                    'JAM_TINDAKAN'      => $jam_sekarang,
                                    'QTY_TINDAKAN'      => 1,
                                    'TARIF'             => $tarif,
                                    'BIAYA'             => $tarif,
                                    'KODE_STATUS'       => 1,
                                    'JASMED_DOKTER'     => $tarif_jasmed,
                                    'PRINT'             => 1);
            $simpan_tindakan =  $this->m_daftar->simpan_tindakan_karcis('ts_biayaperawatan' , $data_tindakan);
            if ($simpan_tindakan==TRUE) {
                $status = "Benar";
            }else{
                $status = "Salah";
            }
            echo json_encode("Benar");
        }
    }
    function simpan_penjualan_optik(){
        $id_optik                   = $this->input->post('id_optik');
        $nodaftar_optik             = $this->input->post('nodaftar_optik');
        $norm_optik                 = $this->input->post('norm_optik');
        $nama_barang_optik          = $this->input->post('nama_barang_optik');
        $nama_frame                 = $this->input->post('nama_frame');
        $nama_lensa                 = $this->input->post('nama_lensa');
        $qty_obat_optik             = $this->input->post('qty_obat_optik');
        $harga_satuan_optik         = $this->input->post('harga_satuan_optik');
        $jumlah_total_optik         = $this->input->post('jumlah_total_optik');
        $tanggal_hutang             = $this->input->post('tanggal_hutang');
        $bayar_dp                   = $this->input->post('bayar_dp');
        $bayar_lunas                = $this->input->post('bayar_lunas');
        $Keterangan_jual_optik      = $this->input->post('Keterangan_jual_optik');
        $tanggal_pengeluaran_optik  = $this->input->post('tgl_input_tindakan');
        $jam                        = Date("H:i:s");
        $id_perusahaan              = $this->session->userdata('outlet');
        $uname                      = $this->session->userdata('id_uname');
        $username                   = $this->session->userdata('username');
        $get_nip_pegawai            = $this->m_daftar->get_nip_pegawai($uname, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $row) {
            $nip_peg = $row->NIP_PEGAWAI;
        }
        if (empty($nama_barang_optik&&$qty_obat_optik&&$harga_satuan_optik&&$jumlah_total_optik)) {
            echo json_encode('Salah');
        }else{
            if ($bayar_dp=='check') {
                $status_bayar_optik = 'Bayar DP';
                $tgl_byr            = $tanggal_pengeluaran_optik;
            }else if ($bayar_lunas=='check') {
                $status_bayar_optik = 'Bayar Pelunasan';
                $tgl_byr            = $tanggal_hutang;
            }else{
                $status_bayar_optik = 'Lunas';
                $tgl_byr            = $tanggal_pengeluaran_optik;
            }
            if (empty($id_optik)) {
                $data_optik = array('NORM'              => $norm_optik, 
                                    'NODAFTAR'          => $nodaftar_optik,
                                    'ID_PERUSAHAAN'     => $id_perusahaan, 
                                    'NIP_PEGAWAI'       => $nip_peg,
                                    'NAMA_BARANG'       => $nama_barang_optik,
                                    'NAMA_FRAME'        => $nama_frame,
                                    'NAMA_LENSA'        => $nama_lensa,
                                    'QTY'               => $qty_obat_optik, 
                                    'HARGA_SATUAN'      => $harga_satuan_optik, 
                                    'TOTAL_HARGA'       => $jumlah_total_optik, 
                                    'KODE_STATUS'       => 1, 
                                    'TANGGAL_PENJUALAN' => $tanggal_pengeluaran_optik, 
                                    'TANGGAL_BAYAR'     => $tgl_byr, 
                                    'KETERANGAN'        => $Keterangan_jual_optik, 
                                    'STATUS_BAYAR'      => $status_bayar_optik, 
                                    'STATUS_BARANG'     => '',
                                    'PRINT'     		=> 1);
                $simpan_penjualan_optik     = $this->m_daftar->simpan_penjualan_optik($data_optik);
                echo json_encode($simpan_penjualan_optik);
            }else{
                $data_optik = array('NORM'              => $norm_optik, 
                                    'NODAFTAR'          => $nodaftar_optik,
                                    'ID_PERUSAHAAN'     => $id_perusahaan, 
                                    'NIP_PEGAWAI'       => $nip_peg,
                                    'NAMA_BARANG'       => $nama_barang_optik,
                                    'NAMA_FRAME'        => $nama_frame,
                                    'NAMA_LENSA'        => $nama_lensa,
                                    'QTY'               => $qty_obat_optik, 
                                    'HARGA_SATUAN'      => $harga_satuan_optik, 
                                    'TOTAL_HARGA'       => $jumlah_total_optik, 
                                    'KODE_STATUS'       => 1, 
                                    'TANGGAL_PENJUALAN' => $tanggal_pengeluaran_optik, 
                                    'TANGGAL_BAYAR'     => $tgl_byr, 
                                    'KETERANGAN'        => $Keterangan_jual_optik, 
                                    'STATUS_BAYAR'      => $status_bayar_optik, 
                                    'STATUS_BARANG'     => '',);
                $update_penjualan_optik = $this->m_daftar->update_penjualan_optik($data_optik, $id_optik);
                echo json_encode($update_penjualan_optik);
            }
        }
        
    }
    function hapus_optik(){
        $id_optik       = $this->input->post('id_optik');
        $id_perusahaan  = $this->session->userdata('outlet');
        $hapus_optik        = $this->m_daftar->hapus_sewa('ts_penjualan_optik', 'ID_PENJUALAN_OPTIK', $id_optik);
        echo json_encode($hapus_optik);
    }
    function retur_penjualan_optik(){
        $id_perusahaan          = $this->session->userdata('outlet');
        $id_pegawai             = $this->session->userdata('id_uname');
        $id_penjualan_optik     = $this->input->post('id');
        $keterangan             = $this->input->post('keterangan');
        $tgl_sekarang           = date('Y-m-d');
        $jam                    = Date("H:i:s");
        $username               = $this->session->userdata('username');
        $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip as $nip) {
            $nip_p = $nip->NIP_PEGAWAI;
        }
        $get_penjualan_optik    = $this->m_daftar->get_penjualan_optik($id_penjualan_optik);
        foreach ($get_penjualan_optik as $row) {
            $NIP_PEGAWAI    = $row->NIP_PEGAWAI;
            $NODAFTAR       = $row->NODAFTAR;
            $NORM           = $row->NORM;
            $nm_barang      = $row->NAMA_BARANG;
            $QTY            = $row->QTY;
            $TOTAL_HARGA    = $row->TOTAL_HARGA;
        };
        $data_retur_jual        = array('NIP_PEGAWAI'       => $nip_p,
                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                        'NODAFTAR'          => $NODAFTAR,
                                        'NORM'              => $NORM,
                                        'ID_PENJUALAN'      => $id_penjualan_optik,
                                        'NAMA_BARANG'       => $nm_barang,
                                        'TGL_RETUR'         => $tgl_sekarang,
                                        'JAM_RETUR'         => $jam,
                                        'JUMLAH_SATUAN'     => $QTY,
                                        'JUMLAH_TAGIHAN'    => $TOTAL_HARGA,
                                        'KETERANGAN'        => $keterangan,
                                        'VALIDASI'          => "Retur");
        $simpan_retur_penjualan = $this->m_daftar->simpan_retur('ts_retur_jual', $data_retur_jual);
        $data                   = array('KETERANGAN'        => $keterangan,
                                        'KODE_STATUS'       => 0,
                                        'STATUS_BARANG'     => 'Retur');
        $retur_penjualan_optik  = $this->m_daftar->update_penjualan_optik($data, $id_penjualan_optik);
        echo json_encode($retur_penjualan_optik);
    }
    
    public function daftarkan_pasien(){
        $id_backup_dos  = $this->input->post('id_backup_dos');
        $ID_KUNJUNGAN_PASIEN  = $this->input->post('ID_KUNJUNGAN_PASIEN');
        $nik_pasien     = $this->input->post('nik_pasien');
        $norm_pasien    = $this->input->post('norm_pasien');
        $norm_lama      = $this->input->post('norm_lama');
        $nama_pasien    = $this->input->post('nama_pasien');
        $jk             = $this->input->post('jk');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $pekerjaan      = $this->input->post('pekerjaan');
        $alamat         = $this->input->post('alamat');
        $gol_pasien     = $this->input->post('jenis_pasien');
        $batas          = $this->input->post('batas');
        $provinsi       = $this->input->post('provinsi');
        $nama_provinsi  = $this->input->post('nama_provinsi');
        $kabupaten      = $this->input->post('kabupaten');
        $kecamatan      = $this->input->post('kecamatan');
        $desa           = $this->input->post('desa');
        $notelp         = $this->input->post('no_telp');
        $kpst           = $this->input->post('no_kpst');
        $id_dokter      = $this->input->post('id_dokter');
        $id_rj_sementara = $this->input->post('id_rj_sementara');
        $tarif_rj_sementara = $this->input->post('tarif_rj_sementara');
        $id_perusahaan  = $this->session->userdata('outlet');
        $id_pegawai     = $this->session->userdata('id_uname');
        $username           = $this->session->userdata('username');
        $tanggal_hariini= date('Y-m-d');
        $jam_sekarang   = date("h:i:s");
        if ($gol_pasien=="UMUM" && $batas=="") {
            $tot_batas = 1;
        }else if ($gol_pasien=="BPJS" && $batas=="") {
            $tot_batas = 2;
        }else if ($gol_pasien=="GRATIS" && $batas=="") {
            $tot_batas = 1;
        }else if ($gol_pasien=="UMUM" && $batas==1) {
            $tot_batas = 1;
        }else if ($gol_pasien=="BPJS" && $batas==1) {
            $tot_batas = 2;
        }else if ($gol_pasien=="GRATIS" && $batas==1) {
            $tot_batas = 1;
        }else if ($gol_pasien=="UMUM" && $batas==2) {
            $tot_batas = 3;
        }else if ($gol_pasien=="BPJS" && $batas==2) {
            $tot_batas = 2;
        }else if ($gol_pasien=="GRATIS" && $batas==2) {
            $tot_batas = 2;
        }else{
            $tot_batas = 3;
        }
        if (empty($nik_pasien&&$nama_pasien&&$jk&&$tempat_lahir&&$tgl_lahir&&$pekerjaan&&$alamat&&$notelp&&$id_dokter&&$id_perusahaan&&$id_pegawai)) {
            echo json_encode('Salah');
        }else{
            if (!empty($id_backup_dos)) {
                $data_dos = array('STATUS' => 1);
                $update_status_data_dos = $this->m_daftar->update_resep_obat('data_backup_pasien_dos', 'id_backup_dos', $data_dos, $id_backup_dos);
            }
            if (!empty($ID_KUNJUNGAN_PASIEN)) {
                $data_sreening = array('TGL_PASIEN_BERKUNJUNG' => $tanggal_hariini, 'STATUS_KEHADIRAN' => 2);
                $update_status_data_screening = $this->m_daftar->update_resep_obat('humas_kunjungan_pasien', 'ID_KUNJUNGAN_PASIEN', $data_sreening, $ID_KUNJUNGAN_PASIEN);
            }
            if (empty($kpst)) {
                $no_kpst = 0;
            }else{
                $no_kpst = $kpst;
            }
            $cari_data_kunjungan_sama = $this->m_daftar->cari_data_kunjungan_sama($id_perusahaan, $nama_pasien, $nik_pasien);
            if (!empty($cari_data_kunjungan_sama)) {
                foreach ($cari_data_kunjungan_sama as $key) {
                    $ID_KUNJUNGAN_PASIEN = $key->ID_KUNJUNGAN_PASIEN;
                    $NAMA_PASIEN = $key->NAMA_PASIEN;
                }
                $data_status_kunjungan      = array('STATUS_KEHADIRAN' => 2, 'TGL_PASIEN_BERKUNJUNG' => $tanggal_hariini);
                $update_status_kunjungan    = $this->m_daftar->update_resep_obat('humas_kunjungan_pasien', 'ID_KUNJUNGAN_PASIEN', $data_status_kunjungan, $ID_KUNJUNGAN_PASIEN);
            }
            $cari_pasien_sama = $this->m_daftar->cari_pasien_sama($id_perusahaan, $nama_pasien, $tempat_lahir, $tgl_lahir, $pekerjaan, $alamat, $desa, $nik_pasien);
            foreach ($cari_pasien_sama as $sm) {
                $norm_d = $sm->NORM;
            }
            if (empty($norm_pasien)){
                if (empty($cari_pasien_sama)) {
                    $get_norm = $this->m_daftar->get_norm_terakhir($id_perusahaan);
                    foreach ($get_norm as $row) {
                        $data = $row->norm;
                        if (empty($data)) {
                            $norm_baru = $id_perusahaan."1";
                        }else{
                            $pot        = $data+1;
                            $norm_baru  = $id_perusahaan.$pot;
                        }
                    }
                    $data_simpan = array(
                                        'NORM'          => $norm_baru,
                                        'NIK'           => $nik_pasien,
                                        'ID_PERUSAHAAN' => $id_perusahaan,
                                        'NAMA'          => $nama_pasien,
                                        'ALAMAT'        => $alamat,
                                        'TEMPAT_LAHIR'  => $tempat_lahir,
                                        'TANGGAL_LAHIR' => $tgl_lahir,
                                        'PROVINSI'      => $provinsi,
                                        'KAB'           => $kabupaten,
                                        'KEC'           => $kecamatan,
                                        'DESA'          => $desa,
                                        'JK'            => $jk,
                                        'TELP'          => $notelp,
                                        'NOKPST'        => $no_kpst,
                                        'KODE_GOLONGAN' => $gol_pasien,
                                        'PEKERJAAN'     => $pekerjaan,
                                        'TGL_INPUT'     => $tanggal_hariini,
                                        'BATAS_GOLONGAN'=> $tot_batas,
                                        'NORM_LAMA'     => $norm_lama);
                    $this->m_daftar->simpan_norm($data_simpan);
                    $get_nodaftar = $this->m_daftar->get_nodaftar_terakhir($id_perusahaan);
                    foreach ($get_nodaftar as $td) {
                        $d_nodaftar = $td->nodaftar;
                        if (empty($d_nodaftar)) {
                            $nodf_baru = $id_perusahaan."1";
                        }else{
                            $pot_df    = $d_nodaftar+1;
                            $nodf_baru = $id_perusahaan.$pot_df;
                        }
                    }
                    $baru_lama = "Baru";
                    $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
                    foreach ($get_nip as $nip) {
                        $nip_p = $nip->NIP_PEGAWAI;
                    }
                    $data_pendaftaran = array('NODAFTAR'            => $nodf_baru, 
                                            'ID_PERUSAHAAN'         => $id_perusahaan,
                                            'NORM'                  => $norm_baru,
                                            'NIP_PEGAWAI'           => $nip_p,
                                            'ID_TARIF'              => $id_dokter,
                                            'TGL_DAFTAR'            => $tanggal_hariini,
                                            'BARU_LAMA'             => $baru_lama,
                                            'KODE_GOLONGAN'         => $gol_pasien,
                                            'STATUS_PENDAFTARAN'    => 1,
                                            'ID_RJ_SEMENTARA'       => $id_rj_sementara,
                                            'TARIF_RJ_SEMENTARA'    => $tarif_rj_sementara);
                    $this->m_daftar->simpan_pendaftaran($data_pendaftaran);
                    $jum = $this->input->post('jumlah_tindakan');
                    for($i=1;$i<=$jum;$i++)
                    {
                        $id_tarif       = $this->input->post('karcis'.$i);
                        $tarif          = $this->input->post('tarif'.$i);
                        $get_kode_dokter = $this->m_daftar->get_kode_dokter($id_dokter);
                        foreach ($get_kode_dokter as $key) {
                        	$kode_dokter = $key->ID_DOKTER;
                        }
                        $get_jasmed_dokter = $this->m_daftar->get_jasmed_dokter($id_tarif, $id_perusahaan);
                        foreach ($get_jasmed_dokter as $key) {
                        	if ($kode_dokter==1) {
                        		$jasmed = $key->ERD;
                        		if (empty($jasmed)) {
                        			$tarif_jasmed = 0;
                        		}else{
                        			$tarif_jasmed = $jasmed;
                        		}
                        	}else{
                        		$jasmed = $key->SPM_LAIN;
                        		if (empty($jasmed)) {
                        			$tarif_jasmed = 0;
                        		}else{
                        			$tarif_jasmed = $jasmed;
                        		}
                        	}
                        }
                        $kode_status    = 1;
                        $data_tindakan  = array('NODAFTAR'      	=> $nodf_baru,
                                                'ID_PERUSAHAAN'     => $id_perusahaan,
                                                'NIP_PEGAWAI'       => $nip_p,
                                                'ID_TARIF'          => $id_dokter,
                                                'NORM'              => $norm_baru,
                                                'ID_TARIF_TINDAKAN' => $id_tarif,
                                                'TGL_TINDAKAN'      => $tanggal_hariini,
                                                'JAM_TINDAKAN'      => $jam_sekarang,
                                                'QTY_TINDAKAN'      => 1,
                                                'TARIF'             => $tarif,
                                                'BIAYA'             => $tarif,
                                                'KODE_STATUS'       => $kode_status,
                                                'JASMED_DOKTER' 	=> $tarif_jasmed,
                                                'PRINT'             => 1);
                        if(isset($tarif)&&$tarif!='')
                        {
                            $simpan_tindakan =  $this->m_daftar->simpan_tindakan_karcis('ts_biayaperawatan' , $data_tindakan);
                        }
                    }
                    if($data_tindakan==TRUE)
                    {
                        $data_daftar['nodaftar']    = $nodf_baru;
                        $data_daftar['norm']        = $norm_baru;
                        $data_daftar['simpan']      = 'Benar';
                        echo json_encode($data_daftar);
                    }else{
                        echo json_encode('Data Gagal Disimpan');
                    }

                }else{
                    echo json_encode('Nama Sudah Ada. Dengan Norm : '.$norm_d);
                }
            }else{
                $cari_validai_norm = $this->m_daftar->get_validasi_norm($norm_pasien, $id_perusahaan);
                foreach ($cari_validai_norm as $key) {
                    $t_norm = $key->NORM;
                }
                if ($norm_pasien==$t_norm) {
                    $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
                    foreach ($get_nip as $nip) {
                        $nip_p = $nip->NIP_PEGAWAI;
                    }
                    $get_pendaftaran_norm = $this->m_daftar->get_pendaftaran_norm_satukali($norm_pasien, $tanggal_hariini, $gol_pasien, $nip_p);
                    foreach ($get_pendaftaran_norm as $qn) {
                        $pend_norm = $qn->NODAFTAR;
                    }
                    if (empty($pend_norm)) {
                        $get_nodaftar = $this->m_daftar->get_nodaftar_terakhir($id_perusahaan);

                        foreach ($get_nodaftar as $td) {
                            $d_nodaftar = $td->nodaftar;
                            if (empty($d_nodaftar)) {
                                $nodf_baru = $id_perusahaan."1";
                            }else{
                                $pot_df    = $d_nodaftar+1;
                                $nodf_baru = $id_perusahaan.$pot_df;
                            }
                        }
                        $baru_lama = "Lama";
                        $data_pasien = array('KODE_GOLONGAN'    => $gol_pasien,
                                             'BATAS_GOLONGAN'   => $tot_batas,
                                             'NIK'              => $nik_pasien,
                                             'PROVINSI'         => $provinsi,
                                             'KAB'              => $kabupaten,
                                             'KEC'              => $kecamatan,
                                             'DESA'             => $desa,
                                             'NAMA'             => $nama_pasien,
                                             'ALAMAT'           => $alamat,
                                             'TEMPAT_LAHIR'     => $tempat_lahir,
                                             'TELP'          	=> $notelp,
                                             'NOKPST'           => $no_kpst,
                                             'TANGGAL_LAHIR'    => $tgl_lahir,);
                        $this->m_daftar->update_pasien($norm_pasien, $data_pasien);
                        $data_pendaftaran = array(  'NODAFTAR'              => $nodf_baru, 
                                                    'ID_PERUSAHAAN'         => $id_perusahaan,
                                                    'NORM'                  => $norm_pasien,
                                                    'NIP_PEGAWAI'           => $nip_p,
                                                    'ID_TARIF'          	=> $id_dokter,
                                                    'TGL_DAFTAR'            => $tanggal_hariini,
                                                    'BARU_LAMA'             => $baru_lama,
                                                    'KODE_GOLONGAN'         => $gol_pasien,
                                                    'STATUS_PENDAFTARAN'    => 1,
                                                    'ID_RJ_SEMENTARA'       => $id_rj_sementara,
                                                    'TARIF_RJ_SEMENTARA'    => $tarif_rj_sementara);
                        $this->m_daftar->simpan_pendaftaran($data_pendaftaran);
                        $jum = $this->input->post('jumlah_tindakan');
                        for($i=1;$i<=$jum;$i++)
                        {
                            $id_tarif       = $this->input->post('karcis'.$i);
                            $tarif          = $this->input->post('tarif'.$i);
                            $get_kode_dokter = $this->m_daftar->get_kode_dokter($id_dokter);
	                        foreach ($get_kode_dokter as $key) {
	                        	$kode_dokter = $key->ID_DOKTER;
	                        }
	                        $get_jasmed_dokter = $this->m_daftar->get_jasmed_dokter($id_tarif, $id_perusahaan);
	                        foreach ($get_jasmed_dokter as $key) {
	                        	if ($kode_dokter==1) {
	                        		$jasmed = $key->ERD;
	                        		if (empty($jasmed)) {
	                        			$tarif_jasmed = 0;
	                        		}else{
	                        			$tarif_jasmed = $jasmed;
	                        		}
	                        	}else{
	                        		$jasmed = $key->SPM_LAIN;
	                        		if (empty($jasmed)) {
	                        			$tarif_jasmed = 0;
	                        		}else{
	                        			$tarif_jasmed = $jasmed;
	                        		}
	                        	}
	                        }
                            $kode_status    = 1;
                            $data_tindakan  = array('NODAFTAR'      	=> $nodf_baru,
                                                    'ID_PERUSAHAAN'     => $id_perusahaan,
                                                    'NIP_PEGAWAI'       => $nip_p,
                                                    'ID_TARIF'          => $id_dokter,
                                                    'NORM'              => $norm_pasien,
                                                    'ID_TARIF_TINDAKAN' => $id_tarif,
                                                    'TGL_TINDAKAN'      => $tanggal_hariini,
                                                    'JAM_TINDAKAN'      => $jam_sekarang,
                                                    'QTY_TINDAKAN'      => 1,
                                                    'TARIF'             => $tarif,
                                                    'BIAYA'             => $tarif,
                                                    'KODE_STATUS'       => $kode_status,
                                                    'JASMED_DOKTER' 	=> $tarif_jasmed,
                                                    'PRINT'             => 1);
                            if(isset($tarif)&&$tarif!='')
                            {
                                $simpan_tindakan =  $this->m_daftar->simpan_tindakan_karcis('ts_biayaperawatan' , $data_tindakan);
                            }
                        }
                        if($data_tindakan==TRUE)
                        {
                            $data_daftar['nodaftar']    = $nodf_baru;
                            $data_daftar['norm']        = $norm_pasien;
                            $data_daftar['simpan']      = 'Benar';
                            echo json_encode($data_daftar);
                        }else{
                            echo json_encode('Data Gagal Disimpan');
                        }
                    }else{
                        echo json_encode('NORM Sudah Terdaftarkan Pada Hari Ini Dengan No Daftar '.$pend_norm);
                    }
                }else{
                    echo json_encode('Data Salah');
                }
            }
        }
    }
    function simpan_pembayaran_karcis(){
        $id_perusahaan      = $this->session->userdata('outlet');
        $tgl_bayar          = $this->input->post('tanggal_pembayaran_k');
        $time               = strtotime($tgl_bayar);
        $newformat          = $this->input->post('tgl_kasir');
        $jam_bayar          = $this->input->post('jam_pembayaran_k');
        $norm               = $this->input->post('norm_pembayar_k');
        $nodaftar           = $this->input->post('nodaftar_pembayar_k');
        $nm_pembayar        = $this->input->post('nama_pembayar_k');
        $diskon             = $this->input->post('diskon_k');
        $hasil_diskon       = $this->input->post('hasil_diskon_k');
        $jum_tagihan        = $this->input->post('jumlah_tagihan_k');
        $jum_uang_bayar     = $this->input->post('jumlah_yang_dibayar_k');
        $jum_uang_kembali   = $this->input->post('uang_kembalian_k');
        $jum_tarif_periksa  = $this->input->post('tarif_periksa_k');
        $jenis_bayar        = $this->input->post('jenis_pembayaran_k');
        $id_biaya_perawatan = $this->input->post('id_biaya_perawatan_k');
        if (empty($id_perusahaan&&$jam_bayar&&$nodaftar&&$jenis_bayar)) {
            echo json_encode('Salah');
        }else{
            $get_pembayarna_karcis_sama = $this->m_daftar->get_pembayarna_karcis_sama($id_perusahaan, $nodaftar, $norm);
            if (empty($get_pembayarna_karcis_sama)) {
                $max_idbayar        = $this->m_daftar->get_idbayar_max($id_perusahaan);
                foreach ($max_idbayar as $row) {
                    $id_bayar = $row->idbiaya;
                    if (empty($id_bayar)) {
                        $idbayar_baru   = $id_perusahaan."1";
                    }else{
                        $pot_idb        = $id_bayar+1;
                        $idbayar_baru   = $id_perusahaan.$pot_idb;
                    }
                }
                $kode_status        = array('KODE_STATUS'       => 2,
                                            'STATUS_FINAL'      => 2,
                                            'JENIS_PEMBAYARAN'  => $jenis_bayar);
                $diskon             = array('DISKON'            => $hasil_diskon,
                                            'BIAYA'             => $jum_tarif_periksa,
                                            'POTONGAN_JASMED'   => $hasil_diskon);
                $pembayaran         = array('ID_PEMBAYARAN'     => $idbayar_baru,
                                            'ID_PERUSAHAAN'     => $id_perusahaan,
                                            'NODAFTAR'          => $nodaftar,
                                            'NORM'              => $norm,
                                            'TGL_BAYAR'         => $newformat,
                                            'JAM_BAYAR'         => $jam_bayar,
                                            'JUMLAH_TAGIHAN'    => $jum_tagihan,
                                            'BAYAR'             => $jum_uang_bayar,
                                            'KEMBALI'           => $jum_uang_kembali,
                                            'KODEJENIS'         => 1,
                                            'STATUS_FINAL'      => 2,
                                            'PEMBAYAR'          => $nm_pembayar,
                                            'JENIS_PEMBAYARAN'  => $jenis_bayar);
                if (empty($hasil_diskon) OR $hasil_diskon==0) {
                    $get_tindakan_karcis    = $this->m_daftar->get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_karcis as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_kode_status = $this->m_daftar->update_kode_status_BP($id_perawatan, $nodaftar,$kode_status);
                    }
                    $simpan_pembayaran_k    = $this->m_daftar->simpan_pembayaran_karcis($pembayaran);
                    if ($simpan_pembayaran_k=="Benar") {
                        echo json_encode($simpan_pembayaran_k);
                    }else{
                        echo json_encode('Data Gagal di Simpan');
                    }
                }else{
                    $get_tindakan_karcis    = $this->m_daftar->get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_karcis as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_kode_status = $this->m_daftar->update_kode_status_BP($id_perawatan, $nodaftar,$kode_status);
                    }
                    $update_diskon_tindakan_dokter  = $this->m_daftar->update_diskon_tindakan($id_biaya_perawatan, $diskon);
                    $simpan_pembayaran_k            = $this->m_daftar->simpan_pembayaran_karcis($pembayaran);
                    if ($simpan_pembayaran_k=="Benar") {
                        echo json_encode('Benar');
                    }else{
                        echo json_encode('Data Gagal di Simpan');
                    }
                }
                // krcis
            }else{
                foreach ($get_pembayarna_karcis_sama as $key) {
                    $id_pembayaran_karcis = $key->id_bayar;
                }
                $kode_status        = array('KODE_STATUS'       => 2,
                                            'STATUS_FINAL'      => 2,
                                            'JENIS_PEMBAYARAN'  => $jenis_bayar);
                $diskon             = array('DISKON'            => $hasil_diskon,
                                            'BIAYA'             => $jum_tarif_periksa,
                                            'POTONGAN_JASMED'   => $hasil_diskon);
                $pembayaran         = array('ID_PERUSAHAAN'     => $id_perusahaan,
                                            'NODAFTAR'          => $nodaftar,
                                            'NORM'              => $norm,
                                            'TGL_BAYAR'         => $newformat,
                                            'JAM_BAYAR'         => $jam_bayar,
                                            'JUMLAH_TAGIHAN'    => $jum_tagihan,
                                            'BAYAR'             => $jum_uang_bayar,
                                            'KEMBALI'           => $jum_uang_kembali,
                                            'KODEJENIS'         => 1,
                                            'STATUS_FINAL'      => 2,
                                            'PEMBAYAR'          => $nm_pembayar,
                                            'JENIS_PEMBAYARAN'  => $jenis_bayar);
                if (empty($hasil_diskon) OR $hasil_diskon==0) {
                    $get_tindakan_karcis    = $this->m_daftar->get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_karcis as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_kode_status = $this->m_daftar->update_kode_status_BP($id_perawatan, $nodaftar,$kode_status);
                    }
                    $update_pembayaran_k    = $this->m_daftar->update_pembayaran_karcis($pembayaran, $id_pembayaran_karcis);
                    if ($update_pembayaran_k=="Benar") {
                        echo json_encode('Benar');
                    }else{
                        echo json_encode('Data Gagal di Simpan');
                    }
                }else{
                    $get_tindakan_karcis    = $this->m_daftar->get_tindakan_karcis_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_karcis as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_kode_status = $this->m_daftar->update_kode_status_BP($id_perawatan, $nodaftar,$kode_status);
                    }
                    $update_diskon_tindakan_dokter  = $this->m_daftar->update_diskon_tindakan($id_biaya_perawatan, $diskon);
                    $update_pembayaran_k    = $this->m_daftar->update_pembayaran_karcis($pembayaran, $id_pembayaran_karcis);
                    if ($update_pembayaran_k=="Benar") {
                        echo json_encode('Benar');
                    }else{
                        echo json_encode('Data Gagal di Simpan');
                    }
                }
            }
        }
    }
    function simpan_data_obat_pasien(){
        $penjualan_obat = $this->input->post('id_proses_tindakan');
        $nodaftar       = $this->input->post('nodaftar_proses_tindakan');
        $norm           = $this->input->post('norm_proses_tindakan');
        $id_obat        = $this->input->post('idobat');
        $qty            = $this->input->post('qty');
        $keterangan     = $this->input->post('Keterangan');
        $obat_pegawai   = $this->input->post('cheklist_obat_pegawai');
        $id_dokter      = $this->input->post('id_dokter_input_tindakan');
        $id_perusahaan  = $this->session->userdata('outlet');
        $tgl_sekarang   = $this->input->post('tgl_input_tindakan');
        $jam            = Date("H:i:s");
        $id_pegawai     = $this->session->userdata('id_uname');
        $username       = $this->session->userdata('username');
        $get_kode_obat  = $this->m_daftar->get_kode_obat($id_obat);
        foreach ($get_kode_obat as $row) {
            $ms_kode_obat  = $row->kod_obt;
            $jum_stok_obat = $row->jum_stock;
        }
        $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip as $nip) {
            $nip_p = $nip->NIP_PEGAWAI;
        }
        $get_id_penjualan = $this->m_daftar->get_id_penjualan($id_perusahaan);
        foreach ($get_id_penjualan as $kode) {
            $kode_penj              = $kode->id_jual;
            if (empty($kode_penj)) {
                $id_penjualan_baru  = $id_perusahaan."1";
            }else{
                $jumlahkan          = $kode_penj+1;
                $id_penjualan_baru  = $id_perusahaan.$jumlahkan;

            }
        }
        $get_data_obat_yang_sama = $this->m_daftar->get_kode_obat_yang_sama($id_obat, $tgl_sekarang, $nodaftar);
        foreach ($get_data_obat_yang_sama as $o_s) {
            $id_jual        = $o_s->id_jual;
            $obat_yg_sama   = $o_s->kode_o;
            $id_stok_obat   = $o_s->idstok;
            $qty_jual       = $o_s->qty;
        }
        $get_kode_obat  = $this->m_daftar->get_kode_obat($id_obat);
        foreach ($get_kode_obat as $row) {
            $ms_kode_obat       = $row->kod_obt;
            $hrg_beli           = $row->hrg_beli;
            $hrg_jual_o         = $row->hrg_jual;
            $ms_stok_obat       = $row->jum_stock;
            $ms_kode_obat       = $row->kode_o;
            $hrg_het_s          = $row->hrg_het;
            $hrg_expired_s      = $row->tgl_expired;
            $tot_harga          = $hrg_jual_o*$qty;
            $hasil_pengurangan  = $ms_stok_obat-$qty;
        }
        if (empty($obat_pegawai)) {
            $hrgjual_o = $hrg_jual_o;
            $tothrg_jual = $hrg_jual_o*$qty;
        }else{
            $hrgjual_o = $hrg_beli;
            $tothrg_jual = $hrg_beli*$qty;
        }
        if (empty($penjualan_obat)) {
            if (empty($nodaftar&&$norm&&$id_obat)) {
                echo json_encode('obat');
            }else{
                if ($qty>$jum_stok_obat) {
                    echo json_encode('kebanyakan');
                }else{
                    if (empty($obat_yg_sama)) {
                        $data_penjualan_obat = array(//'ID_PENJUALAN'     => $id_penjualan_baru,
                                                     'ID_PERUSAHAAN'    => $id_perusahaan,
                                                     'NODAFTAR'         => $nodaftar,
                                                     'NORM'             => $norm,
                                                     'KODE_OBAT'        => $ms_kode_obat,
                                                     'ID_STOK'          => $id_obat,
                                                     'TGL_JUAL'         => $tgl_sekarang,
                                                     'JAM_JUAL'         => $jam,
                                                     'HARGA_BELI'       => $hrg_beli,
                                                     'HARGA_JUAL'       => $hrgjual_o,
                                                     'NIP_PEGAWAI'      => $nip_p,
                                                     'QTY'              => $qty,
                                                     'BIAYA'            => $tothrg_jual,
                                                     'HARGA_HET'        => $hrg_het_s,
                                                     'TGL_EXPIRED'      => $hrg_expired_s,
                                                     'KODE_STATUS'      => 1,
                                                     'KETERANGAN'       => $keterangan,
                                                     'PRINT'       		=> 1);
                        $data_update_stok           = array('STOK_READY' => $hasil_pengurangan);
                        $simpan_obat_dikeranjang    = $this->m_daftar->simpan_obat_pasien($data_penjualan_obat);
                        $update_stok_obat           = $this->m_daftar->update_stok_obat($id_obat, $data_update_stok);
                        echo json_encode($simpan_obat_dikeranjang);
                    }else{
                        $get_kode_obat  = $this->m_daftar->get_kode_obat($id_obat);
                        foreach ($get_kode_obat as $row) {
                            $ms_kode_obat       = $row->kod_obt;
                            $hrg_beli           = $row->hrg_beli;
                            $hrg_jual_o         = $row->hrg_jual;
                            $ms_stok_obat       = $row->jum_stock;
                            $ms_kode_obat       = $row->kode_o;
                            $tot_harga          = $hrg_jual_o*$qty;
                            $hasil_pengurangan  = $ms_stok_obat-$qty;
                        }
                        if (empty($obat_pegawai)) {
                            $hrgjual_o = $hrg_jual_o;
                            $tothrg_jual = $hrg_jual_o*$qty;
                        }else{
                            $hrgjual_o = $hrg_beli;
                            $tothrg_jual = $hrg_beli*$qty;
                        }
                        
                        if ($qty_jual<$qty){
                            $total_akhir_stok   = $qty-$qty_jual;
                            $sisa_stok          = $ms_stok_obat - $total_akhir_stok;
                        }else if($qty_jual>$qty){
                            $total_akhir_stok   = $qty_jual-$qty;
                            $sisa_stok          = $ms_stok_obat + $total_akhir_stok;
                        }else{
                            $sisa_stok          = $ms_stok_obat;
                        }
                        $data_penjualan_obat = array('QTY'              => $qty,
                                                     'BIAYA'            => $tothrg_jual,
                                                     'KETERANGAN'       => $keterangan);
                        $data_update_stok    = array('STOK_READY'       => $sisa_stok);
                        $update_obat_dikeranjang    = $this->m_daftar->update_obat_pasien($data_penjualan_obat, $id_jual);
                        $update_stok_obat           = $this->m_daftar->update_stok_obat($id_obat, $data_update_stok);
                        echo json_encode($update_obat_dikeranjang);
                    }
                }
            }
            
        }else{
            $get_penjualan_obat     = $this->m_daftar->get_penjualan_obat($penjualan_obat);
            foreach ($get_penjualan_obat as $key) {
                $id_stok_jual   =  $key->ID_STOK;
            }
            if ($qty_jual<$qty){
            $total_akhir_stok   = $qty-$qty_jual;
            $sisa_stok          = $ms_stok_obat - $total_akhir_stok;
            }else if($qty_jual>$qty){
                $total_akhir_stok   = $qty_jual-$qty;
                $sisa_stok          = $ms_stok_obat + $total_akhir_stok;
            }else{
                $sisa_stok          = $ms_stok_obat;
            }
            $data_penjualan_obat = array('QTY'              => $qty,
                                         'BIAYA'            => $tot_harga,
                                         'KETERANGAN'       => $keterangan);
            $data_update_stok    = array('STOK_READY'       => $sisa_stok);
            $update_obat_dikeranjang    = $this->m_daftar->update_obat_pasien($data_penjualan_obat, $id_jual);
            $update_stok_obat           = $this->m_daftar->update_stok_obat($id_obat, $data_update_stok);
            echo json_encode($update_obat_dikeranjang);
        }
    }
    function simpan_pelayanan_tindakan_pasien(){
        $id_biayap      = $this->input->post('id_proses_tindakan');
        $nodaftar       = $this->input->post('nodaftar_proses_tindakan');
        $norm           = $this->input->post('norm_proses_tindakan');
        $id_tindakan    = $this->input->post('idtindakan');
        $id_tarif_tindakan_op       = $this->input->post('id_tarif_tindakan_op');
        $biaya_tarif_tindakan_op    = $this->input->post('biaya_tarif_tindakan_op');
        $qty            = $this->input->post('qty');
        $Keterangan     = $this->input->post('Keterangan');
        $id_doker       = $this->input->post('id_dokter_input_tindakan');
        $id_perusahaan  = $this->session->userdata('outlet');
        $id_pegawai     = $this->session->userdata('id_uname');
        $username       = $this->session->userdata('username');
        $tgl_sekarang   = $this->input->post('tgl_input_tindakan');
        $jam            = Date("H:i:s");
        $dp_tindakan    = $this->input->post('checklist_dp_harga_tindakan');
        $nomila_dp_tind = $this->input->post('nominal_dp_tindakan');
        if (empty($nodaftar&&$norm&&$id_tindakan&&$id_perusahaan&&$id_pegawai&&$qty&&$tgl_sekarang)) {
            echo json_encode('Salah');
        }else{
            if (!empty($id_tarif_tindakan_op)) {
                $data_jasmed_op = array('ID_OP_SEMENTARA' => $id_tarif_tindakan_op, 'TARIF_OP_SEMENTARA' => $biaya_tarif_tindakan_op );
                $simpan_jasmed_op   = $this->m_daftar->update_jasmed_op($nodaftar, $data_jasmed_op);
            }
            $get_tarif_tindakan = $this->m_daftar->cari_tarif_tindakan($id_perusahaan, $id_tindakan);
            foreach ($get_tarif_tindakan as $row) {
                $biaya      = $row->tarif;
                $tot_biaya  = $biaya*$qty;
            }
            $cari_tindakan_yang_sama = $this->m_daftar->cari_tindakan_yang_sama($id_tindakan, $id_perusahaan, $nodaftar);
            foreach ($cari_tindakan_yang_sama as $row) {
                $id_tindakan_bp = $row->id_b_perawatan;
                $qty_bp         = $row->jumlah;
                $tot_qty_bp     = $qty_bp+$qty;
                $biaya_bp       = $row->biaya;
                $id_tarif_tind  = $row->tarif;
                $tot_biaya_bp   = $biaya*$tot_qty_bp;
            }
            $get_nip = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
            foreach ($get_nip as $nip) {
                $nip_p = $nip->NIP_PEGAWAI;
            }
            $get_kode_dokter = $this->m_daftar->get_kode_dokter($id_doker);
            foreach ($get_kode_dokter as $key) {
            	$kode_dokter = $key->ID_DOKTER;
            }
            $get_jasmed_dokter = $this->m_daftar->get_jasmed_dokter($id_tindakan, $id_perusahaan);
            foreach ($get_jasmed_dokter as $key) {
            	if ($kode_dokter==1) {
            		$jasmed = $key->ERD;
            		if (empty($jasmed)) {
            			$tarif_jasmed = 0;
            		}else{
            			$tarif_jasmed = $jasmed;
            		}
            	}else{
            		$jasmed = $key->SPM_LAIN;
            		if (empty($jasmed)) {
            			$tarif_jasmed = 0;
            		}else{
            			$tarif_jasmed = $jasmed;
            		}
            	}
            }
            if ($dp_tindakan==0) {
                $hrg_tindakan_px = $tot_biaya;
            }else{
                $hrg_tindakan_px = $nomila_dp_tind;
            }
            if(empty($id_biayap)){
                if (empty($id_tindakan_bp)) {
                    $data_tindakan  = array('NODAFTAR'          => $nodaftar,
                                            'ID_PERUSAHAAN'     => $id_perusahaan,
                                            'ID_TARIF'          => $id_doker,
                                            'NORM'              => $norm,
                                            'ID_TARIF_TINDAKAN' => $id_tindakan,
                                            'NIP_PEGAWAI'       => $nip_p,
                                            'TGL_TINDAKAN'      => $tgl_sekarang,
                                            'JAM_TINDAKAN'      => $jam,
                                            'KODE_STATUS'       => 1,
                                            'KETERANGAN'        => $Keterangan,
                                            'QTY_TINDAKAN'      => $qty,
                                            'TARIF'             => $biaya,
                                            'BIAYA'             => $hrg_tindakan_px,
                                            'JASMED_DOKTER'     => $tarif_jasmed,
                                            'PRINT'             => 1);
                    $simpan = $this->m_daftar->simpan_pelayanan_tindakan_pasien($data_tindakan);
                    echo json_encode($simpan);
                }else{
                    $id_biaya_perawatan_u = $id_tindakan_bp;
                    $data_tindakan = array( 'QTY_TINDAKAN'      => $tot_qty_bp,
                                            'BIAYA'             => $tot_biaya_bp,
                                            'KETERANGAN'        => $Keterangan);
                    $update = $this->m_daftar->update_data_tindakan_pasien($id_biaya_perawatan_u, $data_tindakan);
                    echo json_encode($update);
                }
            }else{
                $id_biaya_perawatan_u = $id_biayap;
                $data_tindakan = array( 'QTY_TINDAKAN'          => $qty,
                                        'TARIF'                 => $biaya,
                                        'BIAYA'                 => $hrg_tindakan_px,
                                        'ID_TARIF_TINDAKAN'     => $id_tindakan,
                                        'KETERANGAN'            => $Keterangan);
                $update = $this->m_daftar->update_data_tindakan_pasien($id_biaya_perawatan_u, $data_tindakan);
                echo json_encode($update);
            }
        }
    }
    function simpan_pembayaran_tindakan(){
        $tgl_bayar          = $this->input->post('tanggal_pembayaran');
        $jam_bayar          = $this->input->post('jam_pembayaran');
        $norm               = $this->input->post('norm_bayar_tindakan');
        $nodaftar           = $this->input->post('nodaftar_bayar_tindakan');
        $nm_pembayar        = $this->input->post('nama_pembayar_tindakan');
        $hasil_diskon       = $this->input->post('hasil_diskon_bt');
        $biaya_operasi      = $this->input->post('biaya_operasi_bt');
        $biaya_rawat_jalan  = $this->input->post('biaya_bukan_operasi_bt');
        $biaya_obat         = $this->input->post('jumlah_tagihan_obat');
        $jumlah_tagihan     = $this->input->post('jumlah_tagihan');
        $jumlah_bayar       = $this->input->post('jumlah_yang_dibayar');
        $uang_kembali       = $this->input->post('uang_kembalian');
        $jenis_bayar        = $this->input->post('jenis_pembayaran');
        $status_bayar       = $this->input->post('status_pembayaran');
        $id_id_dokter       = $this->input->post('id_dokter_bt');
        $nm_dokter          = $this->input->post('dokter_bt');
        $check_box          = $this->input->post('checkbox_gratiskan_obat');
        $id_biaya_operasi   = $this->input->post('id_operasi_bt');
        $jumlah_sewa        = $this->input->post('jumlah_sewa');
        $jumlah_optik       = $this->input->post('jumlah_hrg_optik');
        $id_perusahaan      = $this->session->userdata('outlet');
        $tgl_sekarang       = $this->input->post('tgl_input_tindakan');
        $get_resep_obat     = $this->m_daftar->get_resep_pasien($nodaftar);
        if (empty($norm&&$nodaftar&&$nm_pembayar&&$jenis_bayar&&$status_bayar&&$id_id_dokter&&$tgl_sekarang)) {
            echo json_encode("Maaf Semua Data Tidak Boleh Kosong");
        }else{
            if (!empty($get_resep_obat)) {
                $data_resep = array('KETERANGAN' => 'Resep', 'JENIS_PEMBAYARAN'  => $jenis_bayar); 
                $update = $this->m_daftar->update_data_double_field('ts_penjualan_obat', 'NODAFTAR', 'KODE_STATUS', $data_resep, $nodaftar, '3');
            }

            if(empty($jumlah_sewa)){
            }else{
                $get_data_sewa = $this->m_daftar->get_data_sewa($nodaftar);
                foreach ($get_data_sewa as $row) {
                    $id_sewa        = $row->id_sewa;
                    $data_sewa      = array('KODE_STATUS'       => 2,
                                            'STATUS_FINAL'      => 1,
                                            'JENIS_PEMBAYARAN'  => $jenis_bayar);
                    $update_sewa    = $this->m_daftar->update_sewa('ts_sewa_kendaraan', 'ID_SEWA', $data_sewa, $id_sewa);
                }
            }

            if(empty($jumlah_optik)){
            }else{
                $get_data_optik = $this->m_daftar->get_data_optik($nodaftar);
                foreach ($get_data_optik as $row) {
                    $id_pen_optik    = $row->ID_PENJUALAN_OPTIK;
                    $data_optik      = array('KODE_STATUS'       => 2,
                                             'STATUS_FINAL'      => 1,
                                             'JENIS_PEMBAYARAN'  => $jenis_bayar);
                    $update_optik    = $this->m_daftar->update_penjualan_optik($data_optik, $id_pen_optik);
                }
            }

            if ($check_box==1) {
                $get_obat_hari_ini = $this->m_daftar->get_data_obat_pasien_belum_bayar($nodaftar);
                foreach ($get_obat_hari_ini as $key) {
                    $id_jual_obat   = $key->id_jual;
                    $diskon_obat    = $key->biaya;
                    $data_obat      = array( 'BIAYA'            => $biaya_obat,
                                             'DISKON'           => $diskon_obat,
                                             'KODE_STATUS'      => 2,
                                             'STATUS_FINAL'     => 1,
                                             'JENIS_PEMBAYARAN' => $jenis_bayar);
                    $update_biaya_obat = $this->m_daftar->update_biaya_obat_gratis_dua($id_jual_obat, $nodaftar, $data_obat);
                }
                if (empty($hasil_diskon) || $hasil_diskon==0) {

                    $data_biaya_perawatan   = array('KODE_STATUS'       => 2,
                                                    'STATUS_FINAL'      => 1,
                                                    'JENIS_PEMBAYARAN'  => $jenis_bayar);

                    $get_tindakan_perawatan    = $this->m_daftar->get_tindakan_perawatan_bynodaf($nodaftar, $id_perusahaan);

                    foreach ($get_tindakan_perawatan as $row) {
                        $id_perawatan           = $row->ID_PERAWATAN;
                        $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan($id_perawatan, $nodaftar, $data_biaya_perawatan);
                    }

                    // echo json_encode("Obat Tidak Terdiskon Operasi Tidak Terdiskon");
                    $id_yang_sama = $this->m_daftar->get_id_pembayaran_yang_sama($id_perusahaan, $nodaftar, $norm, $tgl_sekarang);
                    foreach ($id_yang_sama as $row) {
                        $id_bayar_tindakan      = $row->id_bayar;
                        $jum_tagihan_tindakan   = $row->jum_tagihan;
                        $jum_bayar_tindakan     = $row->jum_bayar;
                        $jum_kembalian_tindakan = $row->jum_kembalian;
                        $bulat_tindakan         = $row->bulat;
                    }

                    if (empty($id_bayar_tindakan)) {
                        $max_idbayar        = $this->m_daftar->get_idbayar_max($id_perusahaan);
                        foreach ($max_idbayar as $row) {
                            $id_bayar = $row->idbiaya;
                            if (empty($id_bayar)) {
                                $idbayar_baru   = $id_perusahaan."1";
                            }else{
                                $pot_idb        = $id_bayar+1;
                                $idbayar_baru   = $id_perusahaan.$pot_idb;
                            }
                        }

                        $pembayaran             = array('ID_PEMBAYARAN'     => $idbayar_baru,
                                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                                        'NODAFTAR'          => $nodaftar,
                                                        'NORM'              => $norm,
                                                        'TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan,
                                                        'BAYAR'             => $jumlah_bayar,
                                                        'KEMBALI'           => $uang_kembali,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $simpan_bayar_tindakan = $this->m_daftar->simpan_pembayaran_tindakan($pembayaran);
                        echo json_encode($simpan_bayar_tindakan);
                    }else{
                        $pembayaran             = array('TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan+$jum_tagihan_tindakan,
                                                        'BAYAR'             => $jumlah_bayar+$jum_bayar_tindakan,
                                                        'KEMBALI'           => $uang_kembali+$jum_kembalian_tindakan,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $update_bayar_tindakan = $this->m_daftar->update_pembayaran_tindakan($pembayaran, $id_bayar_tindakan);
                        echo json_encode($update_bayar_tindakan);
                    }

                }else{

                    $data_biaya_diskon      = array('KODE_STATUS'       => 2,
                                                    'DISKON'            => $hasil_diskon,
                                                    'BIAYA'             => $biaya_operasi,
                                                    'STATUS_FINAL'      => 1,
                                                    'JENIS_PEMBAYARAN'  => $jenis_bayar,
                                                    'POTONGAN_JASMED'   => $hasil_diskon);
                    $data_biaya_perawatan   = array('KODE_STATUS'       => 2,
                                                    'STATUS_FINAL'      => 1,
                                                    'JENIS_PEMBAYARAN'  => $jenis_bayar);
                    $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan_diskon($id_biaya_operasi, $data_biaya_diskon);
                    $get_tindakan_perawatan    = $this->m_daftar->get_tindakan_perawatan_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_perawatan as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan($id_perawatan, $nodaftar, $data_biaya_perawatan);
                    }

                    $id_yang_sama = $this->m_daftar->get_id_pembayaran_yang_sama($id_perusahaan, $nodaftar, $norm, $tgl_sekarang);
                    foreach ($id_yang_sama as $row) {
                        $id_bayar_tindakan      = $row->id_bayar;
                        $jum_tagihan_tindakan   = $row->jum_tagihan;
                        $jum_bayar_tindakan     = $row->jum_bayar;
                        $jum_kembalian_tindakan = $row->jum_kembalian;
                        $bulat_tindakan         = $row->bulat;
                    }

                    if (empty($id_bayar_tindakan)) {
                        $max_idbayar        = $this->m_daftar->get_idbayar_max($id_perusahaan);
                        foreach ($max_idbayar as $row) {
                            $id_bayar = $row->idbiaya;
                            if (empty($id_bayar)) {
                                $idbayar_baru   = $id_perusahaan."1";
                            }else{
                                $pot_idb        = $id_bayar+1;
                                $idbayar_baru   = $id_perusahaan.$pot_idb;
                            }
                        }

                        $pembayaran             = array('ID_PEMBAYARAN'     => $idbayar_baru,
                                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                                        'NODAFTAR'          => $nodaftar,
                                                        'NORM'              => $norm,
                                                        'TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan,
                                                        'BAYAR'             => $jumlah_bayar,
                                                        'KEMBALI'           => $uang_kembali,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $simpan_bayar_tindakan = $this->m_daftar->simpan_pembayaran_tindakan($pembayaran);
                        echo json_encode($simpan_bayar_tindakan);

                    }else{
                        $pembayaran             = array('TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan+$jum_tagihan_tindakan,
                                                        'BAYAR'             => $jumlah_bayar+$jum_bayar_tindakan,
                                                        'KEMBALI'           => $uang_kembali+$jum_kembalian_tindakan,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $update_bayar_tindakan = $this->m_daftar->update_pembayaran_tindakan($pembayaran, $id_bayar_tindakan);
                        echo json_encode($update_bayar_tindakan);
                    }
                }
            }else{
                $data_obat = array('KODE_STATUS' => 2, 'JENIS_PEMBAYARAN'  => $jenis_bayar);
                $update_biaya_obat = $this->m_daftar->update_biaya_obat_gratis($tgl_bayar, $nodaftar, $data_obat);
                if (empty($hasil_diskon) || $hasil_diskon==0) {
                    $data_biaya_perawatan       = array('KODE_STATUS'       => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                    $get_tindakan_perawatan     = $this->m_daftar->get_tindakan_perawatan_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_perawatan as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan($id_perawatan, $nodaftar, $data_biaya_perawatan);
                    }
                    // echo json_encode("Obat Tidak Terdiskon Operasi Tidak Terdiskon");
                    $id_yang_sama = $this->m_daftar->get_id_pembayaran_yang_sama($id_perusahaan, $nodaftar, $norm, $tgl_sekarang);
                    foreach ($id_yang_sama as $row) {
                        $id_bayar_tindakan      = $row->id_bayar;
                        $jum_tagihan_tindakan   = $row->jum_tagihan;
                        $jum_bayar_tindakan     = $row->jum_bayar;
                        $jum_kembalian_tindakan = $row->jum_kembalian;
                        $bulat_tindakan         = $row->bulat;
                    }
                    if (empty($id_bayar_tindakan)) {
                        $max_idbayar        = $this->m_daftar->get_idbayar_max($id_perusahaan);
                        foreach ($max_idbayar as $row) {
                            $id_bayar = $row->idbiaya;
                            if (empty($id_bayar)) {
                                $idbayar_baru   = $id_perusahaan."1";
                            }else{
                                $pot_idb        = $id_bayar+1;
                                $idbayar_baru   = $id_perusahaan.$pot_idb;
                            }
                        }
                        $pembayaran             = array('ID_PEMBAYARAN'     => $idbayar_baru,
                                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                                        'NODAFTAR'          => $nodaftar,
                                                        'NORM'              => $norm,
                                                        'TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan,
                                                        'BAYAR'             => $jumlah_bayar,
                                                        'KEMBALI'           => $uang_kembali,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $simpan_bayar_tindakan = $this->m_daftar->simpan_pembayaran_tindakan($pembayaran);
                        echo json_encode($simpan_bayar_tindakan);
                    }else{
                        $pembayaran             = array('TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan+$jum_tagihan_tindakan,
                                                        'BAYAR'             => $jumlah_bayar+$jum_bayar_tindakan,
                                                        'KEMBALI'           => $uang_kembali+$jum_kembalian_tindakan,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $update_bayar_tindakan = $this->m_daftar->update_pembayaran_tindakan($pembayaran, $id_bayar_tindakan);
                        echo json_encode($update_bayar_tindakan);
                    }
                }else{
                    $data_biaya_diskon      = array('KODE_STATUS'       => 2,
                                                    'DISKON'            => $hasil_diskon,
                                                    'BIAYA'             => $biaya_operasi,
                                                    'STATUS_FINAL'      => 1,
                                                    'JENIS_PEMBAYARAN'  => $jenis_bayar,
                                                    'POTONGAN_JASMED'   => $hasil_diskon);
                    $data_biaya_perawatan   = array('KODE_STATUS'       => 2,
                                                    'STATUS_FINAL'      => 1,
                                                    'JENIS_PEMBAYARAN'  => $jenis_bayar);
                    $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan_diskon($id_biaya_operasi, $data_biaya_diskon);
                    $get_tindakan_perawatan    = $this->m_daftar->get_tindakan_perawatan_bynodaf($nodaftar, $id_perusahaan);
                    foreach ($get_tindakan_perawatan as $row) {
                        $id_perawatan       =  $row->ID_PERAWATAN;
                        $update_biaya_perawatan = $this->m_daftar->update_data_biaya_perawatan($id_perawatan, $nodaftar, $data_biaya_perawatan);
                    }
                    $id_yang_sama = $this->m_daftar->get_id_pembayaran_yang_sama($id_perusahaan, $nodaftar, $norm, $tgl_sekarang);
                    foreach ($id_yang_sama as $row) {
                        $id_bayar_tindakan      = $row->id_bayar;
                        $jum_tagihan_tindakan   = $row->jum_tagihan;
                        $jum_bayar_tindakan     = $row->jum_bayar;
                        $jum_kembalian_tindakan = $row->jum_kembalian;
                        $bulat_tindakan         = $row->bulat;
                    }
                    if (empty($id_bayar_tindakan)) {
                        $max_idbayar        = $this->m_daftar->get_idbayar_max($id_perusahaan);
                        foreach ($max_idbayar as $row) {
                            $id_bayar = $row->idbiaya;
                            if (empty($id_bayar)) {
                                $idbayar_baru   = $id_perusahaan."1";
                            }else{
                                $pot_idb        = $id_bayar+1;
                                $idbayar_baru   = $id_perusahaan.$pot_idb;
                            }
                        }
                        $pembayaran             = array('ID_PEMBAYARAN'     => $idbayar_baru,
                                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                                        'NODAFTAR'          => $nodaftar,
                                                        'NORM'              => $norm,
                                                        'TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan,
                                                        'BAYAR'             => $jumlah_bayar,
                                                        'KEMBALI'           => $uang_kembali,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $simpan_bayar_tindakan = $this->m_daftar->simpan_pembayaran_tindakan($pembayaran);
                        echo json_encode($simpan_bayar_tindakan);
                    }else{
                        $pembayaran             = array('TGL_BAYAR'         => $tgl_sekarang,
                                                        'JAM_BAYAR'         => $jam_bayar,
                                                        'JUMLAH_TAGIHAN'    => $jumlah_tagihan+$jum_tagihan_tindakan,
                                                        'BAYAR'             => $jumlah_bayar+$jum_bayar_tindakan,
                                                        'KEMBALI'           => $uang_kembali+$jum_kembalian_tindakan,
                                                        'KODEJENIS'         => 2,
                                                        'STATUS_FINAL'      => 1,
                                                        'PEMBAYAR'          => $nm_pembayar,
                                                        'JENIS_PEMBAYARAN'  => $jenis_bayar);
                        $update_bayar_tindakan = $this->m_daftar->update_pembayaran_tindakan($pembayaran, $id_bayar_tindakan);
                        echo json_encode($update_bayar_tindakan);
                    }
                }
            }
        }
    }
    function simpan_sewa_mobil(){
        $id_sewa            = $this->input->post('id_sewa');
        $nodaftar_sewa      = $this->input->post('nodaftar_sewa');
        $norm_sewa          = $this->input->post('norm_sewa');
        $list_sewa          = $this->input->post('list_sewa');
        $lokasi_tujuan      = $this->input->post('lokasi_tujuan');
        $jumlah_harga       = $this->input->post('jumlah_harga');
        $tgl_sekarang       = $this->input->post('tgl_input_tindakan');
        if ($list_sewa=="lainnya") {
            $id_tarif_sewa = 0;
        }else{
            $id_tarif_sewa = $list_sewa;
        }
        $id_perusahaan  = $this->session->userdata('outlet');
        $id_pegawai     = $this->session->userdata('id_uname');
        $username           = $this->session->userdata('username');
        $get_nip_pegawai = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai = $key->NIP_PEGAWAI;
        }
        if (empty($nodaftar_sewa&&$norm_sewa&&$list_sewa&&$jumlah_harga&&$tgl_sekarang)) {
            echo json_encode("Salah");
        }else{
            if (empty($id_sewa)) {
                $data_sewa = array('ID_TARIF_SEWA'  => $id_tarif_sewa,
                                   'ID_PERUSAHAAN'  => $id_perusahaan,
                                   'NODAFTAR'       => $nodaftar_sewa,
                                   'NORM'           => $norm_sewa,
                                   'NIP_PEGAWAI'    => $nip_pegawai,
                                   'LOKASI_TUJUAN'  => $lokasi_tujuan,
                                   'TGL_SEWA'       => $tgl_sekarang,
                                   'KODE_STATUS'    => 1,
                                   'HARGA_SEWA'     => $jumlah_harga,
                                   'PRINT'     		=> 1);
                $simpan_sewa_mobil = $this->m_daftar->simpan_sewa('ts_sewa_kendaraan', $data_sewa);
                echo json_encode($simpan_sewa_mobil);
            }else{
                $data_sewa = array('ID_TARIF_SEWA'  => $id_tarif_sewa,
                                   'ID_PERUSAHAAN'  => $id_perusahaan,
                                   'NODAFTAR'       => $nodaftar_sewa,
                                   'NORM'           => $norm_sewa,
                                   'NIP_PEGAWAI'    => $nip_pegawai,
                                   'LOKASI_TUJUAN'  => $lokasi_tujuan,
                                   'TGL_SEWA'       => $tgl_sekarang,
                                   'KODE_STATUS'    => 1,
                                   'HARGA_SEWA'     => $jumlah_harga);
                $update_sewa_mobil =$this->m_daftar->update_sewa('ts_sewa_kendaraan', 'ID_SEWA', $data_sewa, $id_sewa);
                echo json_encode($update_sewa_mobil);
            }
        }
    }
    function pdf_bpjs(){
        $get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nokpst         = $row->NOKPST;
            $nodaftar       = $row->NODAFTAR;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $kode_pos       = $row->KODE_POS;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        if (empty($nokpst)) {
            $no_bpjs = "-";
        }else{
            $no_bpjs = $nokpst;
        }
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }

         $nokarcis_pot      = substr($no_karcis, 3);
         $jum_pot_karcis    = strlen($nokarcis_pot);
         if ($jum_pot_karcis==1) {
            $nokarcis_jadi = "000".$nokarcis_pot;
         }else if ($jum_pot_karcis==2) {
            $nokarcis_jadi = "00".$nokarcis_pot;
         }else if ($jum_pot_karcis==3) {
            $nokarcis_jadi = "0".$nokarcis_pot;
         }else{
            $nokarcis_jadi = $nokarcis_pot;
         }
         $nodaftar_pot      = substr($nodaftar, 3);
         $jum_pot_nodaftar  = strlen($nodaftar_pot);
         if ($jum_pot_nodaftar==1) {
            $nodaftar_jadi = "000".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==2) {
            $nodaftar_jadi = "00".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==3) {
            $nodaftar_jadi = "0".$nodaftar_pot;
         }else{
            $nodaftar_jadi = $nodaftar_pot;
         }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $pdf = new FPDF('L', 'mm', array(210, 95));
        $pdf->setTopMargin(6);
        $pdf->setLeftMargin(10);
        $pdf->setRightMargin(10);
        $pdf->SetAutoPageBreak(false); // I'll have to add page breaks myself 
        $pdf->SetAutoPageBreak(true, 1); // Pages with auto-break, with a bottom margin of 40 pts.
        $pdf->SetFont('helvetica','B', 11);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        //untuk menampilkan gambar
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),3,3,20,20);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
         $pdf->SetFont('Arial','B',10);
        // mencetak string 
        // $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,5,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,4,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,4,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->Ln(2);
        //buat garis horisontal
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10,20,200,20);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,200,20);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('170', '3', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('20', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(5);
        // untuk menurunkan table
        $pdf->cell(5, 1, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(10);
        $pdf->Cell('40', '3', 'Sudah Diterima Dari', '0', 0, 'L');
        $pdf->Cell('60', '3', ': '.$pembayar.'', '0', 0, 'L');
        $pdf->Cell('35', '3', 'Nomor / Nodaftar', '0', 0, 'L');
        $pdf->Cell('55', '3', ': '.$nokarcis_jadi.' / '.$nodaftar_jadi.'', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$nm_pasien.'', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Alamat', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$alamat_ps.'', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Dokter', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nm_dok.'', '0', 1, 'L');

        $pdf->Cell('40', '4', 'No KPST', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$no_bpjs.'', '0', 1, 'L');
        // $pdf->Cell('35', '4', 'Dokter', '0', 0, 'L');
        // $pdf->Cell('55', '4', ': '.$nm_dok.'', '0', 1, 'L');

        // $pdf->Cell('40', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        // $pdf->Cell('60', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 0, 'L');
        // $pdf->Cell('30', '5', 'No KPST', '0', 0, 'L');
        // $pdf->Cell('60', '5', ': '.$no_bpjs, '0', 1, 'L');

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        // $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->Cell('10', '5', 'No', '1', 0, 'C');
        $pdf->Cell('90', '5', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('15', '5', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('75', '5', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no         = 1;
        $total      =  0;
        $tot_diskon = 0;
        $data = $this->m_daftar->cetak_kwitansi_karcis($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('90', '5', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('15', '5', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('75', '5','Rp. '.number_format( $r->TARIF).'', '1', 1);
            $total = $total + $r->TARIF;
            $tot_diskon = $tot_diskon+$r->DISKON;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $pdf->cell(115, 5, 'Sub Total', 1, 0, 'C');
        $pdf->Cell('75', '5', 'Rp. '.number_format($total).'', '1', 1);

        // $pdf->SetFont('Arial', 'B', 'L');
        // $pdf->setfontsize(11);
        // $pdf->Cell('10', '6', ' ', '0', 0, 'C');
        // $pdf->cell(100, 6, 'Discount', 0, 0, 'L');
        // $pdf->Cell('75', '6', 'Rp. '.number_format($tot_diskon).'', '0', 1);
        // $pdf->SetFont('Arial', '', 'L');
        // $pdf->setfontsize(9);
        // $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        // $pdf->cell(100, 5, 'Total', 0, 0, 'L');
        // $pdf->Cell('75', '5', 'Rp. '.number_format($total-$tot_diskon).'', '0', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(115, 4, 'Discount', 0, 0, 'L');
        $pdf->Cell('65', '4', 'Rp. '.number_format($tot_diskon).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('10', '4', ' ', '0', 0, 'C');
        $pdf->cell(115, 4, 'Total', 0, 0, 'L');
        $pdf->Cell('65', '4', 'Rp. '.number_format($total-$tot_diskon).'', '0', 1);

        // $pdf->Cell('26', '5', 'Terbilang', '0', 0, 'L');
        // $pdf->cell(155, 5, ': '.strtoupper(terbilang($total-$tot_diskon)).' RUPIAH', 0, 1, 'L');

        // $pdf->Cell('26', '5', 'Tipe Pembayaran', '0', 0, 'L');
        // $pdf->cell(155, 5, ': '.$jenis_bayar.'', 0, 1, 'L');

        $pdf->Cell('26', '4', 'Terbilang', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.strtoupper(terbilang($total-$tot_diskon)).' RUPIAH', 0, 1, 'L');

        $pdf->Cell('26', '4', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.$jenis_bayar.'', 0, 1, 'L');

        // $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        // $pdf->cell(45, 5, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        // $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        // $pdf->cell(45, 5, '', 0, 1, 'C');

        // $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        // $pdf->cell(45, 5, '', 0, 1, 'C');

        // $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        // $pdf->cell(45, 5, ''.$nm_pegawai.'', 0, 1, 'C');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, '', 0, 1, 'C');

        // $pdf->Cell('140', '5', ' ', '1', 0, 'L');
        // $pdf->cell(45, 5, '', 1, 1, 'C');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, ''.$nm_pegawai.'', 0, 1, 'C');
        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
    function cetak_karcis(){
        $nodaftar       = $this->input->post('nodaftar');
        if (empty($nodaftar)) {
            echo json_encode('Salah');
        }else{
            $cek_cetak_karcis = $this->m_daftar->get_karcis_yang_sama($nodaftar);
            foreach ($cek_cetak_karcis as $k) {
                $no_karcis  = $k->ID_PEMBAYARAN;
                $cetak      = $k->CETAK;
            }
            if (empty($cek_cetak_karcis)) {
                echo json_encode('Salah');
            }else{
                if (empty($cetak)) {
                    $data               = array('CETAK' => 1);
                    $data['simpan']     = $this->m_daftar->update_cetak_karcis($no_karcis, $data);
                    $data['id']         = base64_encode($nodaftar);
                    echo json_encode($data);
                }else{
                    // $data   = array('CETAK' => $cetak+1);
                    // $simpan = $this->m_daftar->update_cetak_karcis($no_karcis, $data);
                    $data['id']         = base64_encode($nodaftar);
                    $data['nokarcis']   = $no_karcis;
                    $data['cetak']      = $cetak;
                    $data['keterangan'] = "Lebih Dari 1";
                    echo json_encode($data);
                }
            }
            // $data['id']     = base64_encode($nodaftar);
            // echo json_encode($data);
        }
    }
    function simpan_batalkan_daftar(){
        $nodaftar               = $this->input->post('nodaftar');
        $norm                   = $this->input->post('norm');
        $keterangan             = $this->input->post('keterangan');
        $id_perusahaan          = $this->session->userdata('outlet');
        $id_pegawai             = $this->session->userdata('id_uname');
        $username               = $this->session->userdata('username');
        $tgl_sekarang           = Date('Y-m-d');
        $jam_sekarang           = date("h:i:s");
        $data_pendaftaran       = array('STATUS_PENDAFTARAN' => 0, 'KETERANGAN' => $keterangan);
        $data_biaya_perawatan   = array('KODE_STATUS' => 0, 'KETERANGAN' => $keterangan, 'BIAYA' => 0);

        $get_nip_pegawai = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai = $key->NIP_PEGAWAI;
        }

        $get_pembatalan_obat    = $this->m_daftar->get_pembatalan_obat($nodaftar);
        $data1 = $get_pembatalan_obat->num_rows();
        foreach ($get_pembatalan_obat->result() as $row) {
            $id_stok        = $row->id_stok;
            $kd_obat        = $row->kd_obat;
            $id_penjualan   = $row->id_penjualan;
            $qty_penjualan  = $row->qty;
            $biaya          = $row->biaya;
            $get_stok_obat  = $this->m_daftar->get_stok_obat($id_stok);
            foreach ($get_stok_obat as $key) {
                $id_stok2       = $key->ID_STOK;
                $stok_ready     = $key->STOK_READY;
                $jumlahkan_stok = $qty_penjualan+$stok_ready;
                $data_stok      = array('STOK_READY' => $jumlahkan_stok);
                $update_stok    = $this->m_daftar->update_stok_obat($id_stok, $data_stok);
                $data_retur_jual        = array('NIP_PEGAWAI'       => $nip_pegawai,
                                                'ID_PERUSAHAAN'     => $id_perusahaan,
                                                'NODAFTAR'          => $nodaftar,
                                                'NORM'              => $norm,
                                                'ID_PENJUALAN'      => $id_penjualan,
                                                'KODE_OBAT'         => $kd_obat,
                                                'ID_STOK'           => $id_stok,
                                                'TGL_RETUR'         => $tgl_sekarang,
                                                'JAM_RETUR'         => $jam_sekarang,
                                                'JUMLAH_SATUAN'     => $qty_penjualan,
                                                'JUMLAH_TAGIHAN'    => $biaya,
                                                'KETERANGAN'        => $keterangan,
                                                'VALIDASI'          => "Retur");
                $simpan_retur_penjualan = $this->m_daftar->simpan_retur('ts_retur_jual', $data_retur_jual);
            }
            $data_penjualan_obat    = array('KODE_STATUS' => 0, 'QTY_AWAL' => $qty_penjualan);
            $update_penjualan_obat  = $this->m_daftar->update_batal_p_obat($tgl_sekarang, $nodaftar, $data_penjualan_obat);
        }
        $update_pendaftaran     = $this->m_daftar->update_pendaftaran($data_pendaftaran, $nodaftar);
        $get_tindakan_u_batal   = $this->m_daftar->get_tindakan_pasien($nodaftar);
        foreach ($get_tindakan_u_batal as $row) {
            $id_perawatan2  = $row->ID_PERAWATAN;
            $id_tarif_tind2 = $row->ID_TARIF_TINDAKAN;
            $kd_tindakan2   = $row->KODE_TINDAKAN;
            $qty_tindakan2  = $row->QTY_TINDAKAN;
            $biaya2         = $row->BIAYA;
            $data_tindakan  = array('NIP_PEGAWAI'       => $nip_pegawai,
                                    'ID_PERUSAHAAN'     => $id_perusahaan,
                                    'NODAFTAR'          => $nodaftar,
                                    'NORM'              => $norm,
                                    'ID_PERAWATAN'      => $id_perawatan2,
                                    'KODE_TINDAKAN'     => $kd_tindakan2,
                                    'ID_TARIF_TINDAKAN' => $id_tarif_tind2,
                                    'TGL_RETUR'         => $tgl_sekarang,
                                    'JAM_RETUR'         => $jam_sekarang,
                                    'JUMLAH_SATUAN'     => $qty_tindakan2,
                                    'JUMLAH_TAGIHAN'    => $biaya2,
                                    'KETERANGAN'        => $keterangan,
                                    'VALIDASI'          => 'Retur');            
            $simpan_retur_tindakan = $this->m_daftar->simpan_retur('ts_retur_tindakan', $data_tindakan);
            $update_batal_tindakan = $this->m_daftar->update_batal_tindakan($id_perawatan2, $data_biaya_perawatan);
        }
        $get_sewa_mobil     = $this->m_daftar->get_data_sewa($biaya);
        foreach ($get_sewa_mobil as $key) {
            $id_sewa        = $key->id_sewa;
            $data_sewa      = array('KODE_STATUS' => 0);
            $update_sewa    = $this->m_daftar->update_sewa('ts_sewa_kendaraan', 'ID_SEWA', $data_sewa, $id_sewa);
        }
        echo json_encode($update_pendaftaran);
    }
    function simpan_batalkan_tindakan(){
        $id                     = $this->input->post('id');
        $nodaftar               = $this->input->post('nodaftar');
        $norm                   = $this->input->post('norm');
        $keterangan             = $this->input->post('keterangan');
        $id_perusahaan          = $this->session->userdata('outlet');
        $id_pegawai             = $this->session->userdata('id_uname');
        $username               = $this->session->userdata('username');
        $tgl_sekarang           = Date('Y-m-d');
        $jam_sekarang           = date("h:i:s");
        $data_biaya_perawatan   = array('KODE_STATUS' => 0, 'BIAYA' => 0, 'KETERANGAN' => $keterangan);

        $get_nip_pegawai = $this->m_daftar->get_nip_pegawai($id_pegawai, $id_perusahaan, $username);
        foreach ($get_nip_pegawai as $key) {
            $nip_pegawai = $key->NIP_PEGAWAI;
        }
        $get_bata_riwayat_tindakan    = $this->m_daftar->get_bata_riwayat_tindakan($id, $nodaftar);
        foreach ($get_bata_riwayat_tindakan->result() as $row) {
            $id_tindakan        = $row->id_tindakan;
            $kd_tindakan        = $row->kd_tindakan;
            $id_tarif_tindakan  = $row->id_tarif_tindakan;
            $qty_tindakan       = $row->qty_tindakan;
            $biaya              = $row->biaya;
        }
        $data_retur_jual        = array('NIP_PEGAWAI'       => $nip_pegawai,
                                        'ID_PERUSAHAAN'     => $id_perusahaan,
                                        'NODAFTAR'          => $nodaftar,
                                        'NORM'              => $norm,
                                        'ID_PERAWATAN'      => $id_tindakan,
                                        'KODE_TINDAKAN'     => $kd_tindakan,
                                        'ID_TARIF_TINDAKAN' => $id_tarif_tindakan,
                                        'TGL_RETUR'         => $tgl_sekarang,
                                        'JAM_RETUR'         => $jam_sekarang,
                                        'JUMLAH_SATUAN'     => $qty_tindakan,
                                        'JUMLAH_TAGIHAN'    => $biaya,
                                        'KETERANGAN'        => $keterangan,
                                        'VALIDASI'          => "Retur");
        $simpan_retur_tindakan = $this->m_daftar->simpan_retur('ts_retur_tindakan', $data_retur_jual);
        echo json_encode($simpan_retur_tindakan);
        $update_batal_tindakan = $this->m_daftar->update_batal_tindakan($id_tindakan, $data_biaya_perawatan);
    }
    function cetak_kwitansi(){
        $nodaftar       = $this->input->post('nodaftar');
        if (empty($nodaftar)) {
            echo json_encode('Salah');
        }else{
            $cek_cetak_kwitansi = $this->m_daftar->get_tagihan_yang_sama($nodaftar);
            foreach ($cek_cetak_kwitansi as $row) {
                $no_karcis  = $row->ID_PEMBAYARAN;
                $cetak      = $row->CETAK;
            }
            if (empty($cetak)) {
                $data               = array('CETAK' => 1);
                $data['simpan']     = $this->m_daftar->update_cetak_karcis($no_karcis, $data);
                $data['nokwitansi'] = $no_karcis;
                $data['id']         = base64_encode($nodaftar);
                echo json_encode($data);
            }else{
                $data['id']         = base64_encode($nodaftar);
                $data['nokarcis']   = $no_karcis;
                $data['cetak']      = $cetak;
                $data['keterangan'] = "Lebih Dari 1";
                echo json_encode($data);
            }
        }
    }
    function karcis_umum(){
    	$get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $data['biodata']    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        $data['karcis'] 	= $this->m_daftar->cetak_kwitansi_karcis($nodaftar, $id_perusahaan);
        $data['dokter']     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        $this->load->view('daftar/karcis_umum', $data);
    }
    function pdf_umum(){
        $get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nodaftar       = $row->NODAFTAR;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $kode_pos       = $row->KODE_POS;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
         $nokarcis_pot 		= substr($no_karcis, 3);
         $jum_pot_karcis 	= strlen($nokarcis_pot);
         if ($jum_pot_karcis==1) {
         	$nokarcis_jadi = "000".$nokarcis_pot;
         }else if ($jum_pot_karcis==2) {
         	$nokarcis_jadi = "00".$nokarcis_pot;
         }else if ($jum_pot_karcis==3) {
         	$nokarcis_jadi = "0".$nokarcis_pot;
         }else{
         	$nokarcis_jadi = $nokarcis_pot;
         }
         $nodaftar_pot 		= substr($nodaftar, 3);
         $jum_pot_nodaftar 	= strlen($nodaftar_pot);
         if ($jum_pot_nodaftar==1) {
         	$nodaftar_jadi = "000".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==2) {
         	$nodaftar_jadi = "00".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==3) {
         	$nodaftar_jadi = "0".$nodaftar_pot;
         }else{
         	$nodaftar_jadi = $nodaftar_pot;
         }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $pdf = new FPDF('P', 'mm', array(135, 90));
        $pdf->setTopMargin(3);
        $pdf->setLeftMargin(3);
        $pdf->SetFont('Arial','B', 11);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        //untuk menampilkan gambar
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),1,1,15,15);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
         $pdf->SetFont('Arial','B',10);
        // mencetak string 
        // $pdf->Cell(89,1,'KLINIK MATA EDC GROUP',0,1,'C');
        // $pdf->SetFont('Arial','B',8);
        $pdf->Cell(89,6,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(89,2,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(89,7,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->SetLineWidth(0.3);
        $pdf->Line(1, 17, 89, 17);
        $pdf->SetLineWidth(0);
        $pdf->Line(1, 17, 89, 17);


        $pdf->setTopMargin(5);
        $pdf->setLeftMargin(1);
        $pdf->SetFont('Arial','B', 10);

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(7);
        $pdf->Cell('70','3', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(6);
        $pdf->Cell('10', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(10);
        // untuk menurunkan table
        $pdf->cell(5, 1, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('28', '3', 'Sudah Diterima Dari', '0', 0, 'L');
        $pdf->Cell('77', '3', ': '.$pembayar.'', '0', 1, 'L');
        $pdf->Cell('28', '3', 'Nomor / Nodaftar', '0', 0, 'L');
        $pdf->Cell('77', '3', ': '.$nokarcis_jadi.' / '.$nodaftar_jadi.'', '0', 1, 'L');

        $pdf->Cell('28', '3', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('77', '3', ': '.$nm_pasien.'', '0', 1, 'L');
        // $pdf->Cell('28', '3', 'Tanggal', '0', 0, 'L');
        // $pdf->Cell('77', '3', ': '.$tgl_sekarang.'', '0', 1, 'L');

        $pdf->Cell('28', '3', 'Alamat', '0', 0, 'L');
        $pdf->Cell('77', '3', ': '.$alamat_ps.'', '0', 1, 'L');
        $pdf->Cell('28', '3', 'Dokter', '0', 0, 'L');
        $pdf->Cell('77', '3', ': '.$nm_dok.'', '0', 1, 'L');

        $pdf->Cell('28', '2.5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('77', '2.5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->Cell('28', '2.5', '', '0', 0, 'L');
        $pdf->Cell('77', '2.5', '', '0', 1, 'L');

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(8);
        // $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('4', '4', 'No', '1', 0, 'C');
        $pdf->Cell('50', '4', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('5', '4', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('29', '4', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no     = 1;
        $total  =  0;
        $tot_diskon = 0;
        $data = $this->m_daftar->cetak_kwitansi_karcis($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('4', '4', $no, '1', 0, 'C');
            $pdf->Cell('50', '4', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('5', '4', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('29', '4','Rp. '.number_format( $r->TARIF).'', '1', 1);
            $total = $total + $r->TARIF;
            $tot_diskon = $tot_diskon+$r->DISKON;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $coba = number_format($total);
        $pdf->cell(54, 4, 'Sub Total', 1, 0, 'C');
        $pdf->Cell('34', '4', 'Rp. '.number_format($total).'', '1', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('100', '1', ' ', '0', 1, 'C');
        $pdf->Cell('4', '4', ' ', '0', 0, 'C');
        $pdf->cell(51, 4, 'Discount', 0, 0, 'L');
        $pdf->Cell('45', '4', 'Rp. '.number_format($tot_diskon).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(7);
        $pdf->Cell('4', '4', ' ', '0', 0, 'C');
        $pdf->cell(51, 4, 'Total', 0, 0, 'L');
        $pdf->Cell('45', '4', 'Rp. '.number_format($total).'', '0', 1);

            // $pdf->Cell('23', '4', 'Terbilang', '0', 0, 'L');
            // $pdf->cell(77, 4, ': '.strtoupper(terbilang($total-$tot_diskon)).' RUPIAH', 0, 1, 'L');

        $pdf->Cell('23', '3', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(77, 3, ': Bayar CASH', 0, 1, 'L');

        $pdf->Cell('53', '3', ' ', '0', 0, 'L');
        $pdf->cell(33, 3, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        // $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        // $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('53', '3', ' ', '0', 0, 'L');
        $pdf->cell(33, 3, ''.$nm_pegawai.'', 0, 1, 'C');
        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
    function cetak_resep(){
        $nodaftar = $this->input->post('id');
        $data['id'] = base64_encode($nodaftar);
        echo json_encode($data);
    }
    function cetak_resep_pdf(){
        $get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nodaftar       = $row->NODAFTAR;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $kode_pos       = $row->KODE_POS;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->setTopMargin(5);
        $pdf->setLeftMargin(12);
        $pdf->SetFont('helvetica','B', 11);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        //untuk menampilkan gambar
        $pdf->Image(base_url('./assets/dist/img/logo.png'),3,3,20,20);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
         $pdf->SetFont('Arial','B',10);
        // mencetak string 
        $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,6,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,2,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,7,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->Ln(5);
        //buat garis horisontal
        $pdf->SetLineWidth(1);
        $pdf->Line(3,25,207,25);
        $pdf->SetLineWidth(0);
        $pdf->Line(3,25,207,25);

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(10);
        $pdf->Cell('188', '5', 'Resep Obat', '0', 1, 'C');        
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(10);
        // untuk menurunkan table
        $pdf->cell(5, 2, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('40', '5', 'Sudah Diterima Dari', '0', 0, 'L');
        $pdf->Cell('60', '5', ': '.$pembayar.'', '0', 0, 'L');
        $pdf->Cell('33', '5', 'Nomor / Nodaftar', '0', 0, 'L');
        $pdf->Cell('55', '5', ': '.$no_karcis.' / '.$nodaftar.'', '0', 1, 'L');

        $pdf->Cell('40', '5', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('60', '5', ': '.$nm_pasien.'', '0', 0, 'L');
        $pdf->Cell('33', '5', 'Tanggal', '0', 0, 'L');
        $pdf->Cell('55', '5', ': '.$tgl_tind.'', '0', 1, 'L');

        $pdf->Cell('40', '5', 'Alamat', '0', 0, 'L');
        $pdf->Cell('60', '5', ': '.$alamat_ps.'', '0', 0, 'L');

        $pdf->Cell('33', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('60', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('100', '5', 'Rincian Pembayaran :', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->Cell('10', '5', 'No', '1', 0, 'C');
        $pdf->Cell('145', '5', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('10', '5', 'Qty', '1', 0, 'C');
        $pdf->Cell('20', '5', 'Satuan', '1', 1, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no         = 1;
        $total      =  0;
        $tot_diskon = 0;
        $data = $this->m_daftar->get_obat_global($nodaftar, $tgl_sekarang);
        foreach ($data as $r) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('145', '5', $r->nm_obat, '1', 0);
            $pdf->Cell('10', '5', $r->qty, '1', 0, 'C');
            $pdf->Cell('20', '5', $r->satuan, '1', 1, 'C');
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, '', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, '', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, ''.$nm_dok.'', 0, 1, 'C');
        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
    function Header()
    {
        //Logo
        $this->Image('logo-ubl.jpg',10,8);
        //Arial bold 15
        $this->SetFont('Arial','B',15);
        //pindah ke posisi ke tengah untuk membuat judul
        $this->Cell(80);
        //judul
        $this->Cell(30,10,'LAPORAN REKAPITULASI PENERIMAAN MAHASISWA BARU',0,0,'C');
        //pindah baris
        $this->Ln(20);
        //buat garis horisontal
        $this->Line(10,25,200,25);
    }
    function Content()
    {
        $this->SetFont('Times','',12);
        for($i=1; $i<=40; $i++)
            $this->Cell(0,10,'Laporan Mahasiswa '.$i,0,1);
    }
    function Footer()
    {
        //atur posisi 1.5 cm dari bawah
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10,$this->GetY(),200,$this->GetY());
        //Arial italic 9
        $this->SetFont('Arial','I',9);
        //nomor halaman
        $this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
    }
    // function kwitansi_pdf_umum(){
    //     $this->load->library('cfpdf');
    //     // digunakan sebagai pembuka untuk membuat halaman pdf
    //     // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
    //     $get            = $this->input->get('id');
    //     $nodaftar       = base64_decode($get);
    //     $tgl_sekarang   = Date('Y-m-d');
    //     $tgl_panjang    = Date('d-M-Y');
    //     $id_perusahaan  = $this->session->userdata('outlet');
    //     $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
    //     foreach ($get_biodata->result() as $row) {
    //         $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
    //         $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
    //         $telp_pr        = $row->NO_TELPON;
    //         $email_pr       = $row->EMAIL;
    //         $cetak          = $row->CETAK;
    //         $pembayar       = $row->PEMBAYAR;
    //         $no_karcis      = $row->ID_PEMBAYARAN;
    //         $nodaftar       = $row->NODAFTAR;
    //         $nm_pasien      = $row->NAMA;
    //         $tgl_tind       = $row->TGL_TINDAKAN;
    //         $alamat_ps      = $row->ALAMAT;
    //         $jk_pasien      = $row->JK;
    //         $kode_pos       = $row->KODE_POS;
    //         $tgl_lahir      = $row->TANGGAL_LAHIR;
    //         $jenis_bayar    = $row->JENIS_PEMBAYARAN;
    //         $kota_outlet    = $row->KOTA;
    //         $nm_pegawai     = $row->pgw;
    //     }
    //     $th_lahir       = substr($tgl_lahir, 0,4);
    //     $th_sekarang    = substr($tgl_sekarang, 0,4);
    //     $umur           = $th_sekarang-$th_lahir;
    //     $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
    //     foreach ($ttd_dokter as $d) {
    //          $nm_dok    = $d->NAMA_DOKTER;
    //      }
    //      $nokarcis_pot      = substr($no_karcis, 3);
    //      $jum_pot_karcis    = strlen($nokarcis_pot);
    //      if ($jum_pot_karcis==1) {
    //         $nokarcis_jadi = "000".$nokarcis_pot;
    //      }else if ($jum_pot_karcis==2) {
    //         $nokarcis_jadi = "00".$nokarcis_pot;
    //      }else if ($jum_pot_karcis==3) {
    //         $nokarcis_jadi = "0".$nokarcis_pot;
    //      }else{
    //         $nokarcis_jadi = $nokarcis_pot;
    //      }
    //      $nodaftar_pot      = substr($nodaftar, 3);
    //      $jum_pot_nodaftar  = strlen($nodaftar_pot);
    //      if ($jum_pot_nodaftar==1) {
    //         $nodaftar_jadi = "000".$nodaftar_pot;
    //      }else if ($jum_pot_nodaftar==2) {
    //         $nodaftar_jadi = "00".$nodaftar_pot;
    //      }else if ($jum_pot_nodaftar==3) {
    //         $nodaftar_jadi = "0".$nodaftar_pot;
    //      }else{
    //         $nodaftar_jadi = $nodaftar_pot;
    //      }
    //     // digunakan untuk meload librari pdf

    //     $this->load->library('cfpdf');
    //     // digunakan sebagai pembuka untuk membuat halaman pdf
    //     // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
    //     $pdf = new FPDF('P', 'mm', array(110, 90));
    //     $pdf->setTopMargin(5);
    //     $pdf->setLeftMargin(8);
    //     $pdf->SetFont('Arial','B', 11);
    //     $pdf->SetAutoPageBreak(false);
    //     // digunakan untuk mengeadd halaman
    //     $pdf->AddPage();
    //     $start_awal = $pdf->GetX(); 
    //     $get_xxx    = $pdf->GetX();
    //     $get_yyy    = $pdf->GetY();

    //     $width_cell     = 54;  
    //     $height_cell    = 4;  
    //     //untuk menampilkan gambar
    //     $pdf->Image(base_url('./assets/dist/img/logo.png'),1,1,15,15);
    //     // untuk judul
    //     // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
    //      $pdf->SetFont('Arial','B',8);
    //     // mencetak string 
    //     $pdf->Cell(89,1,'KLINIK MATA EDC GROUP',0,1,'C');
    //     $pdf->SetFont('Arial','B',8);
    //     $pdf->Cell(89,6,$mn_perusahaan,0,1,'C');
    //     $pdf->SetFont('Arial','B',8);
    //     $pdf->Cell(89,2,$alamat_pr,0,1,'C');
    //     $pdf->SetFont('Arial','B',8);
    //     $pdf->Cell(89,6,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
    //     //pindah baris
    //     $pdf->SetLineWidth(1);
    //     $pdf->Line(1, 20, 89, 20);
    //     $pdf->SetLineWidth(0);
    //     $pdf->Line(1, 20, 89, 20);


    //     $pdf->setTopMargin(5);
    //     $pdf->setLeftMargin(1);
    //     $pdf->SetFont('Arial','B', 10);

    //     $pdf->SetFont('Arial', 'B', 'L');
    //     $pdf->setfontsize(7);
    //     $pdf->Cell('70','4', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(6);
    //     $pdf->Cell('10', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
    //     // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
    //     $pdf->SetFont('Arial', 'B', 'L');
    //     $pdf->setfontsize(10);
    //     // untuk menurunkan table
    //     $pdf->cell(5, 0, '', '0', 1);

    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(8);
    //     $pdf->Cell('28', '3', 'Sudah Diterima Dari', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$pembayar.'', '0', 1, 'L');
    //     $pdf->Cell('28', '3', 'Nomor / Nodaftar', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$nokarcis_jadi.' / '.$nodaftar_jadi.'', '0', 1, 'L');

    //     $pdf->Cell('28', '3', 'Nama Pasien', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$nm_pasien.'', '0', 1, 'L');
    //     $pdf->Cell('28', '3', 'Tanggal', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$tgl_sekarang.'', '0', 1, 'L');

    //     $pdf->Cell('28', '3', 'Alamat', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$alamat_ps.'', '0', 1, 'L');
    //     $pdf->Cell('28', '3', 'Dokter', '0', 0, 'L');
    //     $pdf->Cell('77', '3', ': '.$nm_dok.'', '0', 1, 'L');

    //     $pdf->Cell('28', '2.5', 'Jenis Kelamin / Umur', '0', 0, 'L');
    //     $pdf->Cell('77', '2.5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

    //     $pdf->SetFont('Arial', 'B', 'L');
    //     $pdf->setfontsize(8);
    //     $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
    //     // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
    //     $pdf->SetFont('Arial', 'B', 'L');
    //     $pdf->setfontsize(8);
    //     $pdf->Cell('4', '4', 'No', '1', 0, 'C');
    //     $pdf->Cell('50', '4', 'Jenis Layanan', '1', 0, 'C');
    //     $pdf->Cell('5', '4', 'Qty', '1', 0, 'C');
    //     // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
    //     $pdf->Cell('29', '4', 'Harga', '1', 1, 'C');
    //     // tampilkan dari database
    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(7);
    //     // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
    //     $no     = 1;
    //     $total  =  0;
    //     $tot_diskon = 0;
    //     $data = $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
    //     foreach ($data->result() as $r) {
    //         $pdf->Cell('4', '4', $no, '1', 0, 'C');
    //         $pdf->Cell('50', '4', $r->NAMA_TINDAKAN, '1', 0);
    //         $pdf->Cell('5', '4', $r->QTY_TINDAKAN, '1', 0, 'C');
    //         $pdf->Cell('29', '4','Rp. '.number_format( $r->BIAYA).'', '1', 1);
    //         $total = $total + $r->BIAYA;
    //         $tot_diskon = $tot_diskon+$r->DISKON;
    //         $no++;
    //     }
    //     $total_obt      = 0;
    //     $tot_diskon_obt = 0;
    //     $data_obat = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
    //     foreach ($data_obat as $obt) {
    //         $pdf->Cell('4', '4', $no, '1', 0, 'C');
    //         $pdf->Cell('50', '4', $obt->NAMA_OBAT, '1', 0);
    //         $pdf->Cell('5', '4', $obt->QTY, '1', 0, 'C');
    //         // $pdf->Cell('25', '4','Rp. '.number_format( $obt->DISKON).'', '1', 0);
    //         $pdf->Cell('29', '4','Rp. '.number_format( $obt->BIAYA).'', '1', 1);
    //         $total_obt      = $total_obt + $obt->BIAYA;
    //         $tot_diskon_obt = $tot_diskon_obt+$obt->DISKON;
    //         $no++;
    //     }
    //     $total_opt      = 0;
    //     $tot_diskon_opt = 0;
    //     $data_optik = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
    //     foreach ($data_optik as $opt) {
    //         $pdf->Cell('4', '4', $no, '1', 0, 'C');
    //         $pdf->Cell('50', '4', $opt->NAMA_MERK, '1', 0);
    //         $pdf->Cell('5', '4', $opt->QTY, '1', 0, 'C');
    //         // $pdf->Cell('25', '4','Rp. '.number_format( 0).'', '1', 0);
    //         $pdf->Cell('29', '4','Rp. '.number_format( $opt->TOTAL_HARGA).'', '1', 1);
    //         $total_opt      = $total_opt + $opt->TOTAL_HARGA;
    //         $tot_diskon_opt = $tot_diskon_opt+0;
    //         $no++;
    //     }
    //     $total_swa      = 0;
    //     $tot_diskon_swa = 0;
    //     $data_sewa = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
    //     foreach ($data_sewa as $swa) {
    //         $tujuan = $swa->tujuan;
    //         if (empty($tujuan)) {
    //             $nm_tempat = $swa->nm_tujuan;
    //         }else{
    //             $nm_tempat = $swa->tujuan;
    //         }
    //         $pdf->Cell('4', '4', $no, '1', 0, 'C');
    //         $pdf->Cell('50', '4', $nm_tempat, '1', 0);
    //         $pdf->Cell('5', '4', 1, '1', 0, 'C');
    //         // $pdf->Cell('25', '4','Rp. '.number_format( 0).'', '1', 0);
    //         $pdf->Cell('29', '4','Rp. '.number_format( $swa->hrg_sewa).'', '1', 1);
    //         $total_swa      = $total_swa + $swa->hrg_sewa;
    //         $tot_diskon_swa = $tot_diskon_swa+0;
    //         $no++;
    //     }
    //     // membuat total keseluruhan
    //     // paling belakang ditambahkan alighment, L left, R right, C center
    //     $coba = number_format($total);
    //     $pdf->cell(54, 4, 'Sub Total', 1, 0, 'C');
    //     // $pdf->Cell('25', '4', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '1', 0);
    //     $pdf->Cell(34, '4', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '1', 1);

    //     $pdf->SetFont('Arial', 'B', 'L');
    //     $pdf->setfontsize(8);
    //     $pdf->Cell('100', '1', ' ', '0', 1, 'C');
    //     $pdf->Cell('4', '3', ' ', '0', 0, 'C');
    //     $pdf->cell(50, 3, 'Discount', 0, 0, 'L');
    //     $pdf->Cell('31', '3', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '0', 1);
    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(8);
    //     $pdf->Cell('4', '3', ' ', '0', 0, 'C');
    //     $pdf->cell(50, 3, 'Total', 0, 0, 'L');
    //     $pdf->Cell('31', '3', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '0', 1);

    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(7);
    //     $pdf->Cell('20', '3', 'Terbilang', '0', 0, 'L');
    //     $pdf->SetFont('Arial', '', 'L');
    //     $pdf->setfontsize(6);
    //     // $pdf->cell(80, 3, ': '.strtoupper(terbilang($total+$total_obt+$total_opt)).' RUPIAH', 0, 1, 'J');

    //     $cellWidth=69; //lebar sel
    //     $cellHeight=3; //tinggi sel satu baris normal
    //     $xPos=$pdf->GetX();
    //     $yPos=$pdf->GetY();
    //     $pdf->MultiCell($cellWidth,$cellHeight, ': '.strtoupper(terbilang($total+$total_obt+$total_opt+$total_swa)).' RUPIAH',0);

    //     $pdf->Cell('20', '3', 'Tipe Pembayaran', '0', 0, 'L');
    //     $pdf->cell(80, 3, ': '.$jenis_bayar, 0, 1, 'L');
    //     //atur posisi 1.5 cm dari bawah
    //      // Position at 1.5 cm from bottom
        
    //     //buat garis horisontal
    //     $pdf->SetY(-18);
    //     // $pdf->Line(0,$pdf->GetY(),0,$pdf->GetY());
    //     $pdf->Cell('45', '3', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 3, '', 0, 1, 'C');

    //     $pdf->Cell('45', '3', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 3, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

    //     $pdf->Cell('45', '3', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 3, '', 0, 1, 'C');

    //     $pdf->Cell('45', '3', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 3, '', 0, 1, 'C');

    //     $pdf->Cell('45', '3', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 3, '', 0, 1, 'C');

    //     $pdf->Cell('45', '1', ' ', '0', 0, 'L');
    //     $pdf->cell(46, 1, ''.$nm_pegawai.'', 0, 1, 'C');

    //     $pdf->Output();
    // }
    function kwitansi_ujicoba_umum(){
    	$get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $data['pendaftaran']= $this->m_daftar->cetak_pendaftaran($nodaftar, $id_perusahaan);
        $data['biodata']    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        $data['tindakan'] 	= $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
		$data['obat'] 		= $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
		$data['optik'] 		= $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
		$data['sewa'] 		= $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
		$data['dokter']     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        $this->load->view('daftar/kwitansi_umum', $data);
        // $this->template->load('template', 'daftar/home_k');
    }
    function cetak_rincian_umum(){
        $no_daftar      = $this->input->get('nodaftar');
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $nodaftar       = $id_perusahaan.$no_daftar;   
        $data['karcis']     = $this->m_daftar->cetak_kwitansi_karcis($nodaftar, $id_perusahaan);
        $data['pendaftaran']= $this->m_daftar->cetak_pendaftaran($nodaftar, $id_perusahaan);
        $data['biodata']    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        $data['tindakan']   = $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
        $data['obat']       = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
        $data['optik']      = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        $data['sewa']       = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        $data['dokter']     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        $this->load->view('daftar/cetak_rincian_umum', $data);
    }
    function cetak_rincian_manual_umum(){
        $no_daftar      	= $this->input->get('nodaftar');
        $tgl_sekarang   	= Date('Y-m-d');
        $tgl_panjang    	= Date('d-M-Y');
        $id_perusahaan  	= $this->session->userdata('outlet');
        $nodaftar       	= $id_perusahaan.$no_daftar;   
        $data['karcis']     = $this->m_daftar->cetak_kwitansi_karcis($nodaftar, $id_perusahaan);
        $data['pendaftaran']= $this->m_daftar->cetak_pendaftaran($nodaftar, $id_perusahaan);
        $data['biodata']    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        $data['tindakan']   = $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
        $data['obat']       = $this->m_daftar->cetak_kwitansi_tagihan_obat_manual($nodaftar, $id_perusahaan);
        $data['optik']      = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        $data['sewa']       = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        $data['dokter']     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        $this->load->view('daftar/cetak_rincian_umum', $data);
    }
    function kwitansi_pdf_umum(){
        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nodaftar       = $row->NODAFTAR;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $kode_pos       = $row->KODE_POS;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
         $nokarcis_pot      = substr($no_karcis, 3);
         $jum_pot_karcis    = strlen($nokarcis_pot);
         if ($jum_pot_karcis==1) {
            $nokarcis_jadi = "000".$nokarcis_pot;
         }else if ($jum_pot_karcis==2) {
            $nokarcis_jadi = "00".$nokarcis_pot;
         }else if ($jum_pot_karcis==3) {
            $nokarcis_jadi = "0".$nokarcis_pot;
         }else{
            $nokarcis_jadi = $nokarcis_pot;
         }
         $nodaftar_pot      = substr($nodaftar, 3);
         $jum_pot_nodaftar  = strlen($nodaftar_pot);
         if ($jum_pot_nodaftar==1) {
            $nodaftar_jadi = "000".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==2) {
            $nodaftar_jadi = "00".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==3) {
            $nodaftar_jadi = "0".$nodaftar_pot;
         }else{
            $nodaftar_jadi = $nodaftar_pot;
         }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $pdf = new FPDF('P', 'mm', array(160, 95));
        $pdf->setTopMargin(6);
        $pdf->setLeftMargin(3);
        $pdf->SetFont('Arial','B', 11);
        $pdf->SetAutoPageBreak(false);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        $start_awal = $pdf->GetX(); 
        $get_xxx    = $pdf->GetX();
        $get_yyy    = $pdf->GetY();

        $width_cell     = 54;  
        $height_cell    = 4;  
        //untuk menampilkan gambar
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),1,1,15,15);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
         $pdf->SetFont('Arial','B',10);
        // mencetak string 
        $pdf->Cell(89,5,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(89,6,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','B',10);

        $cellWidth=89; //lebar sel
        $cellHeight=3; //tinggi sel satu baris normal
        $xPos=$pdf->GetX();
        $yPos=$pdf->GetY();
        // $pdf->Cell(80, 3, ': '.strtoupper(terbilang($total+$total_obt+$total_opt+$total_swa)).' RUPIAH',0, 1, 'L');

        $pdf->Cell(89,3,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(89,6,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->SetLineWidth(0.3);
        $pdf->Line(1, 25, 89, 25);
        $pdf->SetLineWidth(0);
        $pdf->Line(1, 25, 89, 25);


        $pdf->setTopMargin(5);
        $pdf->setLeftMargin(1);
        $pdf->SetFont('Arial','B', 10);

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(7);
        $pdf->Cell('70','6', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(6);
        $pdf->Cell('10', '4', 'Cetak : '.$cetak.'', '0', 1, 'R');
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(10);
        // untuk menurunkan table
        $pdf->cell(5, 0, '', '0', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('28', '5', 'Sudah Diterima Dari', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$pembayar.'', '0', 1, 'L');
        $pdf->Cell('28', '5', 'Nomor / Nodaftar', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$nokarcis_jadi.' / '.$nodaftar_jadi.'', '0', 1, 'L');

        $pdf->Cell('28', '5', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$nm_pasien.'', '0', 1, 'L');
        $pdf->Cell('28', '5', 'Tanggal', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$tgl_sekarang.'', '0', 1, 'L');

        $pdf->Cell('28', '5', 'Alamat', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$alamat_ps.'', '0', 1, 'L');
        $pdf->Cell('28', '5', 'Dokter', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$nm_dok.'', '0', 1, 'L');

        $pdf->Cell('28', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('77', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('100', '6', 'Rincian Pembayaran :', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('5', '4', 'No', '1', 0, 'C');
        $pdf->Cell('50', '4', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('6', '4', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('29', '4', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no     = 1;
        $total  =  0;
        $tot_diskon = 0;
        $data = $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('5', '5', $no, '1', 0, 'C');
            $pdf->Cell('50', '5', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('6', '5', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('29', '5','Rp. '.number_format( $r->BIAYA).'', '1', 1);
            $total = $total + $r->BIAYA;
            $tot_diskon = $tot_diskon+$r->DISKON;
            $no++;
        }
        $total_obt      = 0;
        $tot_diskon_obt = 0;
        $data_obat = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
        foreach ($data_obat as $obt) {
            $pdf->Cell('5', '5', $no, '1', 0, 'C');
            $pdf->Cell('50', '5', $obt->NAMA_OBAT, '1', 0);
            $pdf->Cell('6', '5', $obt->QTY, '1', 0, 'C');
            // $pdf->Cell('25', '4','Rp. '.number_format( $obt->DISKON).'', '1', 0);
            $pdf->Cell('29', '5','Rp. '.number_format( $obt->BIAYA).'', '1', 1);
            $total_obt      = $total_obt + $obt->BIAYA;
            $tot_diskon_obt = $tot_diskon_obt+$obt->DISKON;
            $no++;
        }
        $total_opt      = 0;
        $tot_diskon_opt = 0;
        $data_optik = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        foreach ($data_optik as $opt) {
            $pdf->Cell('5', '5', $no, '1', 0, 'C');
            $pdf->Cell('50', '5', $opt->NAMA_BARANG, '1', 0);
            $pdf->Cell('6', '5', $opt->QTY, '1', 0, 'C');
            // $pdf->Cell('25', '4','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('29', '5','Rp. '.number_format( $opt->TOTAL_HARGA).'', '1', 1);
            $total_opt      = $total_opt + $opt->TOTAL_HARGA;
            $tot_diskon_opt = $tot_diskon_opt+0;
            $no++;
        }
        $total_swa      = 0;
        $tot_diskon_swa = 0;
        $data_sewa = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        foreach ($data_sewa as $swa) {
            $tujuan = $swa->tujuan;
            if (empty($tujuan)) {
                $nm_tempat = $swa->nm_tujuan;
            }else{
                $nm_tempat = $swa->tujuan;
            }
            $pdf->Cell('5', '5', $no, '1', 0, 'C');
            $pdf->Cell('50', '5', $nm_tempat, '1', 0);
            $pdf->Cell('6', '5', 1, '1', 0, 'C');
            // $pdf->Cell('25', '4','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('29', '5','Rp. '.number_format( $swa->hrg_sewa).'', '1', 1);
            $total_swa      = $total_swa + $swa->hrg_sewa;
            $tot_diskon_swa = $tot_diskon_swa+0;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $coba = number_format($total);
        $pdf->cell(55, 5, 'Sub Total', 1, 0, 'C');
        // $pdf->Cell('25', '4', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '1', 0);
        $pdf->Cell(35, '5', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '1', 1);

        $pdf->SetFont('Arial', 'B', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('100', '1', ' ', '0', 1, 'C');
        $pdf->Cell('4', '3', ' ', '0', 0, 'C');
        $pdf->cell(50, 3, 'Discount', 0, 0, 'L');
        $pdf->Cell('31', '3', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('4', '3', ' ', '0', 0, 'C');
        $pdf->cell(50, 3, 'Total', 0, 0, 'L');
        $pdf->Cell('31', '3', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '0', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(7);
        $pdf->Cell('18', '3', 'Terbilang', '0', 0, 'L');
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(6);
        // $pdf->cell(80, 3, ': '.strtoupper(terbilang($total+$total_obt+$total_opt)).' RUPIAH', 0, 1, 'J');

        $cellWidth=69; //lebar sel
        $cellHeight=3; //tinggi sel satu baris normal
        $xPos=$pdf->GetX();
        $yPos=$pdf->GetY();
        $pdf->Cell(80, 3, ': '.strtoupper(terbilang($total+$total_obt+$total_opt+$total_swa)).' RUPIAH',0, 1, 'L');

        $pdf->Cell('18', '3', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(80, 3, ': '.$jenis_bayar, 0, 1, 'L');
        //atur posisi 1.5 cm dari bawah
         // Position at 1.5 cm from bottom
        
        //buat garis horisontal
        
        // $pdf->Line(0,$pdf->GetY(),0,$pdf->GetY());
        $pdf->Cell('53', '3', ' ', '0', 0, 'L');
        $pdf->cell(33, 3, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        $pdf->cell(46, 3, '', 0, 1, 'C');

        // $pdf->Cell('54', '3', ' ', '0', 0, 'L');
        // $pdf->cell(46, 3, '', 0, 1, 'C');

        $pdf->Cell('53', '3', ' ', '0', 0, 'L');
        $pdf->cell(33, 3, ''.$nm_pegawai.'', 0, 1, 'C');

        $pdf->Output();
    }
    function kwitansi_pdf_bpjs(){
        $get            = $this->input->get('id');
        $nodaftar       = base64_decode($get);
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $id_perusahaan  = $this->session->userdata('outlet');
        $get_biodata    = $this->m_daftar->get_data_pasien_karcis_($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nodaftar       = $row->NODAFTAR;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $kode_pos       = $row->KODE_POS;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
         $nokarcis_pot      = substr($no_karcis, 3);
         $jum_pot_karcis    = strlen($nokarcis_pot);
         if ($jum_pot_karcis==1) {
            $nokarcis_jadi = "000".$nokarcis_pot;
         }else if ($jum_pot_karcis==2) {
            $nokarcis_jadi = "00".$nokarcis_pot;
         }else if ($jum_pot_karcis==3) {
            $nokarcis_jadi = "0".$nokarcis_pot;
         }else{
            $nokarcis_jadi = $nokarcis_pot;
         }
         $nodaftar_pot      = substr($nodaftar, 3);
         $jum_pot_nodaftar  = strlen($nodaftar_pot);
         if ($jum_pot_nodaftar==1) {
            $nodaftar_jadi = "000".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==2) {
            $nodaftar_jadi = "00".$nodaftar_pot;
         }else if ($jum_pot_nodaftar==3) {
            $nodaftar_jadi = "0".$nodaftar_pot;
         }else{
            $nodaftar_jadi = $nodaftar_pot;
         }
         // $id_outlet = 'SPJ';
         // if ($id_outlet=='SPJ') {
         //     $layout = new FPDF('P', 'mm', array(210, 210));
         // }else{
         //    $layout = new FPDF('L', 'mm', array(210, 95));
         // }
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
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),3,3,20,20);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial','B',10);
        // mencetak string 
        // $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,5,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,4,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,4,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->Ln(2);
        //buat garis horisontal
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10,20,200,20);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,200,20);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('170', '3', 'KWITANSI PEMBAYARAN', '0', 0, 'C');
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('20', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(5);
        // untuk menurunkan table
        $pdf->cell(5, 1, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(10);
        $pdf->Cell('40', '3', 'Sudah Diterima Dari', '0', 0, 'L');
        $pdf->Cell('60', '3', ': '.$pembayar.'', '0', 0, 'L');
        $pdf->Cell('35', '3', 'Nomor / Nodaftar', '0', 0, 'L');
        $pdf->Cell('55', '3', ': '.$nokarcis_jadi.' / '.$nodaftar_jadi.'', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$nm_pasien.'', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Alamat', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$alamat_ps.'', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Dokter', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nm_dok.'', '0', 1, 'L');

        // $pdf->Cell('40', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        // $pdf->Cell('60', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->Cell('10', '5', 'No', '1', 0, 'C');
        $pdf->Cell('75', '5', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('15', '5', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('30', '5', 'Discount', '1', 0, 'C');
        $pdf->Cell('60', '5', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no             = 1;
        $total          = 0;
        $total_tarif    = 0;
        $tot_diskon     = 0;
        $data = $this->m_daftar->cetak_kwitansi_tagihan($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('75', '5', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('15', '5', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( $r->DISKON).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $r->BIAYA).'', '1', 1);
            $total          = $total + $r->BIAYA;
            $perkalian      = $r->TARIF*$r->QTY_TINDAKAN;
            $total_tarif    = $total_tarif+$perkalian;
            $tot_diskon     = $tot_diskon+$r->DISKON;
            $no++;
        }
        $total_obt          = 0;
        $jumlah_penjualan   = 0;
        $tot_diskon_obt     = 0;
        $data_obat = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
        foreach ($data_obat as $obt) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('75', '5', $obt->NAMA_OBAT, '1', 0);
            $pdf->Cell('15', '5', $obt->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( $obt->DISKON).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $obt->BIAYA).'', '1', 1);
            $total_obt          = $total_obt + $obt->BIAYA;
            $perkalian          = $obt->QTY*$obt->HARGA_JUAL;
            $jumlah_penjualan   = $jumlah_penjualan+$perkalian;
            $tot_diskon_obt     = $tot_diskon_obt+$obt->DISKON;
            $no++;
        }
        $total_opt      = 0;
        $tot_diskon_opt = 0;
        $data_optik = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        foreach ($data_optik as $opt) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('75', '5', $opt->NAMA_BARANG, '1', 0);
            $pdf->Cell('15', '5', $opt->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $opt->TOTAL_HARGA).'', '1', 1);
            $total_opt      = $total_opt + $opt->TOTAL_HARGA;
            $tot_diskon_opt = $tot_diskon_opt+0;
            $no++;
        }
        $total_swa      = 0;
        $tot_diskon_swa = 0;
        $data_sewa = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        foreach ($data_sewa as $swa) {
            if (empty($swa->tujuan)) {
                $lokasi = $swa->nm_tujuan;
            }else{
                $lokasi = $swa->tujuan;
            }
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('75', '5', $lokasi, '1', 0);
            $pdf->Cell('15', '5', $swa->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $swa->hrg_sewa).'', '1', 1);
            $total_swa      = $total_swa + $swa->hrg_sewa;
            $tot_diskon_swa = $tot_diskon_swa+0;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $pdf->cell(100, 5, 'Sub Total', 1, 0, 'C');
        $pdf->Cell('30', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '1', 0);
        $pdf->Cell('60', '5', 'Rp. '.number_format($total_tarif+$jumlah_penjualan+$total_opt+$total_swa).'', '1', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(115, 5, 'Discount', 0, 0, 'L');
        $pdf->Cell('65', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('10', '4', ' ', '0', 0, 'C');
        $pdf->cell(115, 4, 'Total', 0, 0, 'L');
        $pdf->Cell('65', '4', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '0', 1);

        $pdf->Cell('26', '4', 'Terbilang', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.strtoupper(terbilang($total+$total_obt+$total_opt+$total_swa)).' RUPIAH', 0, 1, 'L');

        $pdf->Cell('26', '4', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.$jenis_bayar.'', 0, 1, 'L');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, ''.$kota_outlet.', '.TanggalIndo($tgl_sekarang).'', 0, 1, 'C');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, '', 0, 1, 'C');

        // $pdf->Cell('140', '5', ' ', '1', 0, 'L');
        // $pdf->cell(45, 5, '', 1, 1, 'C');

        $pdf->Cell('140', '4', ' ', '0', 0, 'L');
        $pdf->cell(45, 4, ''.$nm_pegawai.'', 0, 1, 'C');

        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
    function cetak_rincian(){
        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $no_daftar      = $this->input->get('nodaftar');
        $id_perusahaan  = $this->session->userdata('outlet');
        $nodaftar       = $id_perusahaan.$no_daftar;   
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $panjang_nopend = strlen($no_daftar);
        if ($panjang_nopend==1) {
            $no_pendaftaran = '000'.$no_daftar;
        }else if ($panjang_nopend==2) {
            $no_pendaftaran = '00'.$no_daftar;
        }else if ($panjang_nopend==3) {
            $no_pendaftaran = '0'.$no_daftar;
        }else{
            $no_pendaftaran = $no_daftar;
        }
        $get_biodata    = $this->m_daftar->get_data_pasien_rincian($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nokpst         = $row->NOKPST;
            $nodaftar       = $row->NODAFTAR;
            $norm           = $row->NORM;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $kode_pos       = $row->KODE_POS;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
         $potong_karcis     = substr($norm, 3);
         $panjang_karcis    = strlen($potong_karcis);
         if ($panjang_karcis==1) {
            $karcis_panjang = '000'.$potong_karcis;
        }else if ($panjang_karcis==2) {
            $karcis_panjang = '00'.$potong_karcis;
        }else if ($panjang_karcis==3) {
            $karcis_panjang = '0'.$potong_karcis;
        }else{
            $karcis_panjang = $potong_karcis;
        }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $id_outlet = $this->session->userdata('outlet');
        if ($id_outlet=='SPJ') {
            $pdf = new FPDF('P', 'mm', array(210, 210));
        }else{
           $pdf = new FPDF('L', 'mm', array(210, 95));
        }
        $pdf->setTopMargin(6);
        $pdf->setLeftMargin(10);
        $pdf->setRightMargin(10);
        $pdf->SetAutoPageBreak(false); // I'll have to add page breaks myself 
        $pdf->SetAutoPageBreak(true, 1); // Pages with auto-break, with a bottom margin of 40 pts.
        $pdf->SetFont('helvetica','', 11);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        //untuk menampilkan gambar
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),3,3,20,20);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial','',10);
        // mencetak string 
        // $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,6,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,2,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,7,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->Ln(0);
        //buat garis horisontal
        $pdf->SetLineWidth(0.3);
        $pdf->Line(10,20,190,20);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,190,20);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('160', '3', 'RINCIAN PEMBAYARAN', '0', 0, 'C');  
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('20', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
       // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(5);
        // untuk menurunkan table
        $pdf->cell(5, 1, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(10);
        $pdf->Cell('40', '3', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('60', '3', ': '.$nm_pasien.'', '0', 0, 'L');
        $pdf->Cell('35', '3', 'NORM / Nodaftar', '0', 0, 'L');
        $pdf->Cell('55', '3 ', ': '.$karcis_panjang.' / '.$no_pendaftaran.'', '0', 1, 'L');

        if (strlen($alamat_ps)>30) {
            $alamat_potong = substr($alamat_ps, 0, 30);
        }else{
            $alamat_potong = $alamat_ps;
        }
        $pdf->Cell('40', '4', 'Alamat', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$alamat_potong.'', '0', 0, 'L');

        $pdf->Cell('35', '4', 'No KPST', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nokpst.'', '0', 1, 'L');

        // $pdf->Cell('35', '4', 'Tanggal', '0', 0, 'L');
        // $pdf->Cell('55', '4', ': '.TanggalIndo($tgl_tind).'', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$jk_pasien.' / '.$umur.'th', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Dokter', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nm_dok.'', '0', 1, 'L');

        // $pdf->Cell('40', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        // $pdf->Cell('60', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        // $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
        $pdf->Cell('100', '1', '', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->Cell('10', '5', 'No', '1', 0, 'C');
        $pdf->Cell('70', '5', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('10', '5', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('30', '5', 'Discount', '1', 0, 'C');
        $pdf->Cell('60', '5', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no         = 1;
        $total      =  0;
        $tot_diskon = 0;
        $total_tindakan = 0 ;
        $data = $this->m_daftar->cetak_rincian_tindakan($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('10', '5', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( $r->DISKON).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format($r->TARIF*$r->QTY_TINDAKAN).'', '1', 1);
            $perkalian = $r->TARIF*$r->QTY_TINDAKAN;
            $biaya     = $r->BIAYA;
            $total = $total + $perkalian;
            $total_tindakan = $total_tindakan+$biaya;
            $tot_diskon = $tot_diskon+$r->DISKON;
            $no++;
        }
        $total_obt      = 0;
        $tot_diskon_obt = 0;
        $jumlah_tag_obt = 0;
        $qty_obat 		= 0;
        
        $data_obat = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
		        foreach ($data_obat as $obt) {
		            $pdf->Cell('10', '5', $no, '1', 0, 'C');
		            $pdf->Cell('70', '5', $obt->NAMA_OBAT, '1', 0);
		            $pdf->Cell('10', '5', $obt->QTY, '1', 0, 'C');
		            $pdf->Cell('30', '5','Rp. '.number_format( $obt->DISKON).'', '1', 0);
		            $pdf->Cell('60', '5','Rp. '.number_format( $obt->BIAYA).'', '1', 1);
		            $perkalian      = $obt->HARGA_JUAL*$obt->QTY;
		            $total_obt      = $total_obt + $perkalian;
		            $jumlah_tag_obt = $jumlah_tag_obt + $obt->BIAYA;
		            $tot_diskon_obt = $tot_diskon_obt+$obt->DISKON;
		            $no++;
		        }
        $total_opt      = 0;
        $tot_diskon_opt = 0;
        $data_optik = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        foreach ($data_optik as $opt) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $opt->NAMA_BARANG, '1', 0);
            $pdf->Cell('10', '5', $opt->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $opt->TOTAL_HARGA).'', '1', 1);
            $total_opt      = $total_opt + $opt->TOTAL_HARGA;
            $tot_diskon_opt = $tot_diskon_opt+0;
            $no++;
        }
        $total_swa      = 0;
        $tot_diskon_swa = 0;
        $data_sewa = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        foreach ($data_sewa as $swa) {
            if (empty($swa->tujuan)) {
                $lokasi = $swa->nm_tujuan;
            }else{
                $lokasi = $swa->tujuan;
            }
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $lokasi, '1', 0);
            $pdf->Cell('10', '5', $swa->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $swa->hrg_sewa).'', '1', 1);
            $total_swa      = $total_swa + $swa->hrg_sewa;
            $tot_diskon_swa = $tot_diskon_swa+0;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $pdf->cell(90, 5, 'Sub Total', 1, 0, 'C');
        $pdf->Cell('30', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt+$tot_diskon_opt+$tot_diskon_swa).'', '1', 0);
        $pdf->Cell('60', '5', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '1', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(100, 5, 'Discount', 0, 0, 'L');
        $pdf->Cell('75', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt+$tot_diskon_opt+$tot_diskon_swa).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(100, 4, 'Total', 0, 0, 'L');
        $pdf->Cell('75', '4', 'Rp. '.number_format($total_tindakan+$jumlah_tag_obt+$total_opt+$total_swa).'', '0', 1);

        $pdf->Cell('26', '4', 'Terbilang', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.strtoupper(terbilang($total_tindakan+$jumlah_tag_obt+$total_opt+$total_swa)).' RUPIAH', 0, 1, 'L');

        $pdf->Cell('26', '4', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.$jenis_bayar.'', 0, 1, 'L');

        $pendaftaran = $this->m_daftar->cetak_pendaftaran($nodaftar, $id_perusahaan);
        foreach ($pendaftaran as $key) {
            $tgl_pendaftaran = $key->TGL_DAFTAR;
        }

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(40, 5, ''.$kota_outlet.', '.TanggalIndo($tgl_pendaftaran).'', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, '', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(40, 5, ''.$nm_pegawai.'', 0, 1, 'C');
        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
    function cetak_rincian_total_persub(){
        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $no_daftar      = $this->input->get('nodaftar');
        $id_perusahaan  = $this->session->userdata('outlet');
        $nodaftar       = $id_perusahaan.$no_daftar;   
        $tgl_sekarang   = Date('Y-m-d');
        $tgl_panjang    = Date('d-M-Y');
        $panjang_nopend = strlen($no_daftar);
        if ($panjang_nopend==1) {
            $no_pendaftaran = '000'.$no_daftar;
        }else if ($panjang_nopend==2) {
            $no_pendaftaran = '00'.$no_daftar;
        }else if ($panjang_nopend==3) {
            $no_pendaftaran = '0'.$no_daftar;
        }else{
            $no_pendaftaran = $no_daftar;
        }
        $get_biodata    = $this->m_daftar->get_data_pasien_rincian($nodaftar);
        foreach ($get_biodata->result() as $row) {
            $mn_perusahaan  = $row->NAMA_PERUSAHAAN;
            $alamat_pr      = $row->ALAMAT_PERUSAHAAN;
            $telp_pr        = $row->NO_TELPON;
            $email_pr       = $row->EMAIL;
            $cetak          = $row->CETAK;
            $pembayar       = $row->PEMBAYAR;
            $no_karcis      = $row->ID_PEMBAYARAN;
            $nokpst         = $row->NOKPST;
            $nodaftar       = $row->NODAFTAR;
            $norm           = $row->NORM;
            $nm_pasien      = $row->NAMA;
            $tgl_tind       = $row->TGL_TINDAKAN;
            $alamat_ps      = $row->ALAMAT;
            $jk_pasien      = $row->JK;
            $tgl_lahir      = $row->TANGGAL_LAHIR;
            $kode_pos       = $row->KODE_POS;
            $jenis_bayar    = $row->JENIS_PEMBAYARAN;
            $kota_outlet    = $row->KOTA;
            $nm_pegawai     = $row->pgw;
        }
        $th_lahir       = substr($tgl_lahir, 0,4);
        $th_sekarang    = substr($tgl_sekarang, 0,4);
        $umur           = $th_sekarang-$th_lahir;
        $ttd_dokter     = $this->m_daftar->get_ttd_nama_dokter($id_perusahaan);
        foreach ($ttd_dokter as $d) {
             $nm_dok    = $d->NAMA_DOKTER;
         }
         $potong_karcis     = substr($norm, 3);
         $panjang_karcis    = strlen($potong_karcis);
         if ($panjang_karcis==1) {
            $karcis_panjang = '000'.$potong_karcis;
        }else if ($panjang_karcis==2) {
            $karcis_panjang = '00'.$potong_karcis;
        }else if ($panjang_karcis==3) {
            $karcis_panjang = '0'.$potong_karcis;
        }else{
            $karcis_panjang = $potong_karcis;
        }
        // digunakan untuk meload librari pdf

        $this->load->library('cfpdf');
        // digunakan sebagai pembuka untuk membuat halaman pdf
        // cara membuat file pdf, dalam kurung terdapat model kertas landscape, ukuran milimeter, kertas A4
        $id_outlet = $this->session->userdata('outlet');
        if ($id_outlet=='SPJ') {
            $pdf = new FPDF('P', 'mm', array(210, 210));
        }else{
           $pdf = new FPDF('L', 'mm', array(210, 95));
        }
        $pdf->setTopMargin(6);
        $pdf->setLeftMargin(10);
        $pdf->setRightMargin(10);
        $pdf->SetAutoPageBreak(false); // I'll have to add page breaks myself 
        $pdf->SetAutoPageBreak(true, 1); // Pages with auto-break, with a bottom margin of 40 pts.
        $pdf->SetFont('helvetica','', 11);
        // digunakan untuk mengeadd halaman
        $pdf->AddPage();
        //untuk menampilkan gambar
        // $pdf->Image(base_url('./assets/dist/img/logo.png'),3,3,20,20);
        // untuk judul
        // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial','',10);
        // mencetak string 
        // $pdf->Cell(190,1,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,6,$mn_perusahaan,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,2,$alamat_pr,0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,7,'Kode pos. '.$kode_pos.', Telp. '.$telp_pr.', Email : '.$email_pr.'',0,1,'C');
        //pindah baris
        $pdf->Ln(0);
        //buat garis horisontal
        $pdf->SetLineWidth(0.3);
        $pdf->Line(10,20,190,20);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,190,20);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('160', '3', 'RINCIAN PEMBAYARAN', '0', 0, 'C');  
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(8);
        $pdf->Cell('20', '3', 'Cetak : '.$cetak.'', '0', 1, 'R');
       // untuk menseting font, dimana terdapat jenis font, jenis teks apakah bold atau yang lain, dan posisi
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(5);
        // untuk menurunkan table
        $pdf->cell(5, 1, '', '', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('40', '4', 'Nama Pasien', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$nm_pasien.'', '0', 0, 'L');
        $pdf->Cell('35', '4', 'NORM / Nodaftar', '0', 0, 'L');
        $pdf->Cell('55', '4 ', ': '.$karcis_panjang.' / '.$no_pendaftaran.'', '0', 1, 'L');

        if (strlen($alamat_ps)>30) {
            $alamat_potong = substr($alamat_ps, 0, 30);
        }else{
            $alamat_potong = $alamat_ps;
        }
        $pdf->Cell('40', '4', 'Alamat', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$alamat_potong.'', '0', 0, 'L');

        $pdf->Cell('35', '4', 'No KPST', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nokpst.'', '0', 1, 'L');

        // $pdf->Cell('35', '4', 'Tanggal', '0', 0, 'L');
        // $pdf->Cell('55', '4', ': '.TanggalIndo($tgl_tind).'', '0', 1, 'L');

        $pdf->Cell('40', '4', 'Jenis Kelamin / Umur', '0', 0, 'L');
        $pdf->Cell('60', '4', ': '.$jk_pasien.' / '.$umur.'th', '0', 0, 'L');
        $pdf->Cell('35', '4', 'Dokter', '0', 0, 'L');
        $pdf->Cell('55', '4', ': '.$nm_dok.'', '0', 1, 'L');

        // $pdf->Cell('40', '5', 'Jenis Kelamin / Umur', '0', 0, 'L');
        // $pdf->Cell('60', '5', ': '.$jk_pasien.' / '.$umur.'th', '0', 1, 'L');

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        // $pdf->Cell('100', '4', 'Rincian Pembayaran :', '0', 1, 'L');
        $pdf->Cell('100', '1', '', '0', 1, 'L');
        // digunakan untuk ukuran cell, terdapat width, height, nama text, garis atau border table, dan yang terakhir apakah ada table selanjutnya atu tidak, maksudnya jika table selanjutnya berada posisi disamping maka di berikan nilai 0
        $pdf->Cell('10', '5', 'No', '1', 0, 'C');
        $pdf->Cell('70', '5', 'Jenis Layanan', '1', 0, 'C');
        $pdf->Cell('10', '5', 'Qty', '1', 0, 'C');
        // yang paling akhir diberikan nilai 1 supaya table selajutnya kebawah
        $pdf->Cell('30', '5', 'Discount', '1', 0, 'C');
        $pdf->Cell('60', '5', 'Harga', '1', 1, 'C');
        // tampilkan dari database
        $pdf->SetFont('Arial', '', 'L');
        // meload function dari model transaksi, untuk menampilkan data dari database kedalam pdf
        $no         = 1;
        $total      =  0;
        $tot_diskon = 0;
        $total_tindakan = 0 ;
        $data = $this->m_daftar->cetak_rincian_tindakan($nodaftar, $id_perusahaan);
        foreach ($data->result() as $r) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $r->NAMA_TINDAKAN, '1', 0);
            $pdf->Cell('10', '5', $r->QTY_TINDAKAN, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( $r->DISKON).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format($r->TARIF*$r->QTY_TINDAKAN).'', '1', 1);
            $perkalian = $r->TARIF*$r->QTY_TINDAKAN;
            $biaya     = $r->BIAYA;
            $total = $total + $perkalian;
            $total_tindakan = $total_tindakan+$biaya;
            $tot_diskon = $tot_diskon+$r->DISKON;
            $no++;
        }
            $pdf->cell(90, 5, 'Total Tindakan', 1, 0, 'C');
            $pdf->Cell('30', '5', 'Rp. '.number_format($tot_diskon).'', '1', 0);
            $pdf->Cell('60', '5', 'Rp. '.number_format($total).'', '1', 1);

        $total_obt      = 0;
        $tot_diskon_obt = 0;
        $jumlah_tag_obt = 0;
        $qty_obat       = 0;
        
        $data_obat = $this->m_daftar->cetak_kwitansi_tagihan_obat($nodaftar, $id_perusahaan);
                foreach ($data_obat as $obt) {
                    $pdf->Cell('10', '5', $no, '1', 0, 'C');
                    $pdf->Cell('70', '5', $obt->NAMA_OBAT, '1', 0);
                    $pdf->Cell('10', '5', $obt->QTY, '1', 0, 'C');
                    $pdf->Cell('30', '5','Rp. '.number_format( $obt->DISKON).'', '1', 0);
                    $pdf->Cell('60', '5','Rp. '.number_format( $obt->BIAYA).'', '1', 1);
                    $perkalian      = $obt->HARGA_JUAL*$obt->QTY;
                    $total_obt      = $total_obt + $perkalian;
                    $jumlah_tag_obt = $jumlah_tag_obt + $obt->BIAYA;
                    $tot_diskon_obt = $tot_diskon_obt+$obt->DISKON;
                    $no++;
                }
                $pdf->cell(90, 5, 'Total Farmasi', 1, 0, 'C');
                $pdf->Cell('30', '5', 'Rp. '.number_format($tot_diskon_obt).'', '1', 0);
                $pdf->Cell('60', '5', 'Rp. '.number_format($total_obt).'', '1', 1);
        $total_opt      = 0;
        $tot_diskon_opt = 0;
        $data_optik = $this->m_daftar->cetak_kwitansi_tagihan_optik($nodaftar, $id_perusahaan);
        foreach ($data_optik as $opt) {
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $opt->NAMA_BARANG, '1', 0);
            $pdf->Cell('10', '5', $opt->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $opt->TOTAL_HARGA).'', '1', 1);
            $total_opt      = $total_opt + $opt->TOTAL_HARGA;
            $tot_diskon_opt = $tot_diskon_opt+0;
            $no++;
        }
        $total_swa      = 0;
        $tot_diskon_swa = 0;
        $data_sewa = $this->m_daftar->cetak_kwitansi_tagihan_sewa($nodaftar, $id_perusahaan);
        foreach ($data_sewa as $swa) {
            if (empty($swa->tujuan)) {
                $lokasi = $swa->nm_tujuan;
            }else{
                $lokasi = $swa->tujuan;
            }
            $pdf->Cell('10', '5', $no, '1', 0, 'C');
            $pdf->Cell('70', '5', $lokasi, '1', 0);
            $pdf->Cell('10', '5', $swa->QTY, '1', 0, 'C');
            $pdf->Cell('30', '5','Rp. '.number_format( 0).'', '1', 0);
            $pdf->Cell('60', '5','Rp. '.number_format( $swa->hrg_sewa).'', '1', 1);
            $total_swa      = $total_swa + $swa->hrg_sewa;
            $tot_diskon_swa = $tot_diskon_swa+0;
            $no++;
        }
        // membuat total keseluruhan
        // paling belakang ditambahkan alighment, L left, R right, C center
        $pdf->cell(90, 5, 'Sub Total', 1, 0, 'C');
        $pdf->Cell('30', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt+$tot_diskon_opt+$tot_diskon_swa).'', '1', 0);
        $pdf->Cell('60', '5', 'Rp. '.number_format($total+$total_obt+$total_opt+$total_swa).'', '1', 1);

        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(100, 5, 'Discount', 0, 0, 'L');
        $pdf->Cell('75', '5', 'Rp. '.number_format($tot_diskon+$tot_diskon_obt+$tot_diskon_opt+$tot_diskon_swa).'', '0', 1);
        $pdf->SetFont('Arial', '', 'L');
        $pdf->setfontsize(9);
        $pdf->Cell('10', '5', ' ', '0', 0, 'C');
        $pdf->cell(100, 4, 'Total', 0, 0, 'L');
        $pdf->Cell('75', '4', 'Rp. '.number_format($total_tindakan+$jumlah_tag_obt+$total_opt+$total_swa).'', '0', 1);

        $pdf->Cell('26', '4', 'Terbilang', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.strtoupper(terbilang($total_tindakan+$jumlah_tag_obt+$total_opt+$total_swa)).' RUPIAH', 0, 1, 'L');

        $pdf->Cell('26', '4', 'Tipe Pembayaran', '0', 0, 'L');
        $pdf->cell(155, 4, ': '.$jenis_bayar.'', 0, 1, 'L');

        $pendaftaran = $this->m_daftar->cetak_pendaftaran($nodaftar, $id_perusahaan);
        foreach ($pendaftaran as $key) {
            $tgl_pendaftaran = $key->TGL_DAFTAR;
        }

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(40, 5, ''.$kota_outlet.', '.TanggalIndo($tgl_pendaftaran).'', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(45, 5, '', 0, 1, 'C');

        $pdf->Cell('140', '5', ' ', '0', 0, 'L');
        $pdf->cell(40, 5, ''.$nm_pegawai.'', 0, 1, 'C');
        // sebagai penutup untuk menampilkan halaman pdf
        $pdf->Output();
    }
}?>