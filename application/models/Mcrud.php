<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcrud extends CI_Model
{

	var $tbl_users				 	= 'tbl_user';
	var $tbl_bagian		 		 	= 'tbl_bagian';
	var $tbl_ns		 				= 'tbl_ns';
	var $tbl_sm		 				= 'tbl_sm';
	var $tbl_sk		 				= 'tbl_sk';
	var $tbl_memo	 				= 'tbl_memo';

	//Sent mail
	// public function sent_mail($username, $email, $aksi)
	// {
	// 	$email_saya = "";
	// 	$pass_saya  = "";

	// 	//konfigurasi email
	// 	$config = array();
	// 	$config['charset'] = 'utf-8';
	// 	$config['useragent'] = 'duodragondev.com';
	// 	$config['protocol']= "smtp";
	// 	$config['mailtype']= "html";
	// 	$config['smtp_host']= "ssl://smtp.gmail.com";
	// 	$config['smtp_port']= "465";
	// 	$config['smtp_timeout']= "465";
	// 	$config['smtp_user']= "$email_saya";
	// 	$config['smtp_pass']= "$pass_saya";
	// 	$config['crlf']="\r\n";
	// 	$config['newline']="\r\n";

	// 	$config['wordwrap'] = TRUE;
	// 	//memanggil library email dan set konfigurasi untuk pengiriman email

	// 	$this->email->initialize($config);
	// 	//$ipaddress = get_real_ip(); //untuk mendeteksi alamat IP

	// 	date_default_timezone_set('Asia/Jakarta');
	// 	$waktu 	  = date('Y-m-d H:i:s');
	// 	$tgl 			= date('Y-m-d');

	// 	$id = md5("$email * $tgl");

	// 	if ($aksi == 'reg') {
	// 			$link			= base_url().'web/verify';
	// 			$pesan    = "Hello $username,
	// 										<br /><br />
	// 										Welcome to Jam Kerja Proyek!<br/>
	// 										Untuk melengkapi pendaftaran Anda, silahkan klik link berikut<br/>
	// 										<br /><br />
	// 										<b><a href='$link/$id/$username'>Klik Aktivasi disini :)</a></b>
	// 										<br /><br />
	// 										Terimakasih ^_^,
	// 										";
	// 			$subject = 'Aktivasi Akun | JKP';

	// 	}elseif ($aksi == 'lp') {
	// 			$link			= base_url().'web/konfirm_pass';
	// 			$pesan    = "Hello $username,
	// 										<br /><br />
	// 										Welcome to Jam Kerja Proyek!<br/>
	// 										Untuk membuat password baru, silahkan klik link berikut<br/>
	// 										<br /><br />
	// 										<b><a href='$link/$id/$username'>Klik disini untuk merubah Password baru :)</a></b>
	// 										<br /><br />
	// 										Terimakasih ^_^,
	// 										";
	// 			 $subject = 'Lupa Password | JKP';
	// 	}

	// 	$this->email->from("$email_saya");
	// 	$this->email->to("$email");
	// 	$this->email->subject($subject);
	// 	$this->email->message($pesan);
	// }
	//End Sent mail


	public function get_users()
	{
		$this->db->from($this->tbl_users);
		$query = $this->db->get();
		return $query;
	}

	public function get_users_daftar()
	{
		$this->db->from($this->tbl_users);
		$this->db->where('status', 'terdaftar');
		$query = $this->db->get();
		return $query;
	}

	public function get_level_users()
	{
		$this->db->from($this->tbl_users);
		// $this->db->where('tbl_user.level', 'user');
		$query = $this->db->get();
		return $query;
	}

	public function get_users_by_un($id)
	{
		$this->db->from($this->tbl_users);
		$this->db->where('username', $id);
		$query = $this->db->get();
		return $query;
	}

	public function get_level_users_by_id($id)
	{
		$this->db->from($this->tbl_users);
		$this->db->where('tbl_user.level', 'user');
		$this->db->where('tbl_user.id_user', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}


	public function save_bagian($data)
	{
		$this->db->insert($this->tbl_bagian, $data);
		return $this->db->insert_id();
	}

	public function update_bagian($where, $data)
	{
		$this->db->update($this->tbl_bagian, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_bagian_by_id($id)
	{
		$this->db->where('id_bagian', $id);
		$this->db->delete($this->tbl_bagian);
	}

	public function save_ns($data)
	{
		$this->db->insert($this->tbl_ns, $data);
		return $this->db->insert_id();
	}

	public function update_ns($where, $data)
	{
		$this->db->update($this->tbl_ns, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_ns_by_id($id)
	{
		$this->db->where('id_ns', $id);
		$this->db->delete($this->tbl_ns);
	}

	// get data dropdown
	function data_ns($aksi = '', $id = '')
	{
		// ambil data dari db
		if ($aksi != 'semua') {
			$this->db->where('jenis_ns', $aksi);
		}
		// $this->db->where('id_user', $id);
		$this->db->order_by('no_surat', 'asc');
		$query = $this->db->get('tbl_ns')->result();
		return $query;
	}

	public function save_sm($data)
	{
		$this->db->insert($this->tbl_sm, $data);
		return $this->db->insert_id();
	}

	public function update_sm($where, $data)
	{
		$this->db->update($this->tbl_sm, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_sm_by_id($id)
	{
		$this->db->where('id_sm', $id);
		$this->db->delete($this->tbl_sm);
	}
	// private function _deletefile($id)
	// {
	// 	$filelampiran = $this->getById($id);
	// 	$filename = explode(".", $filelampiran->file_name)[0];
	// }
	public function delete_lampiran($id)
	{
		$this->db->where('token_lampiran', $id);
		$this->db->delete('tbl_lampiran');
	}

	public function save_sk($data)
	{
		$this->db->insert($this->tbl_sk, $data);
		return $this->db->insert_id();
	}

	public function update_sk($where, $data)
	{
		$this->db->update($this->tbl_sk, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_sk_by_id($id)
	{
		$this->db->where('id_sk', $id);
		$this->db->delete($this->tbl_sk);
	}
}
