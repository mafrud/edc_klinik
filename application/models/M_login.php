<?php
session_save_path('/var/lib/php/sessions');
// session_start();
class M_login extends CI_Model
{
	function cek_login($username,$password){
		// return $this->db->get_where("ms_usser",$where);
		$check = $this->db->get_where('ms_user', array('UNAME' => $username, 'PASS'=> md5($password), 'STATUS'=> 1));
		if ($check->num_rows()>0) {
			return 1;
		}else{
			return 0;
		}
	}
	public function update_tgl($username,$password){
		// $this->db->get_where('ms_user', array('UNAME' => $username, 'PASS'=> md5($password)));
		// $this->db->update('ms_user', array('last_login' => date('Y-m-d'), 'STATUS' => 1));
		$query = $this->db->get_where('ms_user', array('UNAME' => $username, 'PASS'=> md5($password)));
		foreach ($query->result() as $row) {
			$data_id 	= $row->ID_USER;
			$data_per 	= $row->ID_PERUSAHAAN;
		}
		$where = "ID_USER = '".$data_id."'";
		$this->db->update('ms_user', array('last_login' => date('Y-m-d'), 'STATUS' => 1), $where);
		$data_get = array('id' => $data_id,'outlet' => $data_per);
	}
	function get_data($username,$password){
		$query = $this->db->get_where('ms_user', array('UNAME' => $username, 'PASS'=> md5($password), 'STATUS'=> 1));
		// $data_get = array('id' => $data_id,'outlet' => $data_per);
		return $query;
	}
	function get_outlet($id_perusahaan){
		$this->db->select('NAMA_PERUSAHAAN nm_outlet');
		$this->db->from('ms_perusahaan');
		$this->db->where('ID_PERUSAHAAN',$id_perusahaan);
		return $this->db->get()->result();
	}
	function get_user_role($id_uname, $username, $id_perusahaan){
		$this->db->select('ID_ROLE role');
		$this->db->from('ms_user');
		$this->db->where('NIP_PEGAWAI', $id_uname);
		$this->db->where('UNAME', $username);
		$this->db->where('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->get()->result();	
	}
}