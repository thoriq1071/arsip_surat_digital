<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function index()
	{
		$ceks = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Beranda ";

			$this->load->view('users/header', $data);
			$this->load->view('users/beranda', $data);
			$this->load->view('users/footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profile ";

			$this->load->view('users/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('users/footer');

			if (isset($_POST['btnupdate'])) {
				$nama_lengkap	 		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
				$email	 				= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
				$telp	 				= htmlentities(strip_tags($this->input->post('telp')));
				$pengalaman	 	  		= htmlentities(strip_tags($this->input->post('pengalaman')));

				$data = array(
					'nama_lengkap'	=> $nama_lengkap,
					'email'					=> $email,
					'alamat'				=> $alamat,
					'telp'					=> $telp,
					'pengalaman'	  => $pengalaman
				);
				$this->Mcrud->update_user(array('username' => $ceks), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Profil berhasil disimpan.
					</div>'
				);
				redirect('users/profile');
			}

			if (isset($_POST['btnupdate2'])) {
				$password 	= htmlentities(strip_tags($this->input->post('password')));
				$password2 	= htmlentities(strip_tags($this->input->post('password2')));

				if ($password != $password2) {
					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Kata sandi tidak cocok.
						</div>'
					);
				} else {
					$data = array(
						'password'	=> md5($password)
					);
					$this->Mcrud->update_user(array('username' => $ceks), $data);

					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Katasandi berhasil disimpan.
						</div>'
					);
				}
				redirect('users/profile');
			}
		}
	}
	public function pengguna($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'admin' or $data['user']->row()->level == 'user') {
				redirect('404_content');
			}

			$this->db->order_by('id_user', 'DESC');
			$data['level_users']  = $this->Mcrud->get_level_users();

			if ($aksi == 't') {
				$p = "pengguna_tambah";

				$data['judul_web'] 	  = "Tambah Pengguna ";
			} elseif ($aksi == 'd') {
				$p = "pengguna_detail";

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Detail Pengguna ";
			} elseif ($aksi == 'e') {
				$p = "pengguna_edit";

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Edit Pengguna ";
			} elseif ($aksi == 'h') {

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Hapus Pengguna ";

				if ($ceks == $data['query']->username) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Maaf, Anda tidak bisa menghapus Nama Pengguna "' . $ceks . '" ini.
						</div>'
					);
				} else {
					$this->Mcrud->delete_user_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Pengguna berhasil dihapus.
						</div>'
					);
				}
				redirect('users/pengguna');
			} else {
				$p = "pengguna";

				$data['judul_web'] 	  = "Pengguna ";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('d-m-Y H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$username   	 		= htmlentities(strip_tags($this->input->post('username')));
				$password	 		  	= htmlentities(strip_tags($this->input->post('password')));
				$password2	 			= htmlentities(strip_tags($this->input->post('password2')));
				$level	 				= htmlentities(strip_tags($this->input->post('level')));

				$cek_user = $this->db->get_where("tbl_user", "username = '$username'")->num_rows();
				if ($cek_user != 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Nama Pengguna "' . $username . '" Sudah ada.
						</div>'
					);
				} else {
					if ($password != $password2) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>Gagal!</strong> Katasandi tidak cocok.
							</div>'
						);
					} else {
						$data = array(
							'username'	 	 	=> $username,
							'nama_lengkap'	 	=> $username,
							'password'	 	 	=> md5($password),
							'email' 			=> '-',
							'alamat' 			=> '-',
							'telp' 				 => '-',
							'pengalaman' 	 	=> '-',
							'status' 			=> 'aktif',
							'level'			 	=> $level,
							'tgl_daftar' 	 	=> $tgl
						);
						$this->Mcrud->save_user($data);

						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>Sukses!</strong> Pengguna berhasil ditambahkan.
							</div>'
						);
					}
				}

				redirect('users/pengguna/t');
			}

			if (isset($_POST['btnupdate'])) {
				$nama_lengkap	 		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
				$email	 				= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
				$telp	 				= htmlentities(strip_tags($this->input->post('telp')));
				$pengalaman	 	  		= htmlentities(strip_tags($this->input->post('pengalaman')));
				$level	 				= htmlentities(strip_tags($this->input->post('level')));

				$data = array(
					'nama_lengkap' => $nama_lengkap,
					'email'				 => $email,
					'alamat'			 => $alamat,
					'telp'				 => $telp,
					'pengalaman'	  => $pengalaman,
					'status' 			 => 'aktif',
					'level'			 	 => $level,
					'tgl_daftar' 	 => $tgl
				);
				$this->Mcrud->update_user(array('id_user' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Pengguna berhasil diupdate.
					</div>'
				);
				redirect('users/pengguna');
			}
		}
	}
	public function bagian($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
				redirect('404_content');
			}

			$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
				$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get("tbl_bagian");

			if ($aksi == 't') {
				$p = "bagian_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}

				$data['judul_web'] 	  = "Tambah Bagian ";
			} elseif ($aksi == 'e') {
				$p = "bagian_edit";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}

				$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
				$data['judul_web'] 	  = "Edit Bagian ";
			} elseif ($aksi == 'h') {

				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
				$data['judul_web'] 	  = "Hapus Bagian ";
				$this->Mcrud->delete_bagian_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Bagian berhasil dihapus.
					</div>'
				);
				redirect('users/bagian');
			} else {
				$p = "bagian";
				$data['judul_web'] 	  = "Bagian ";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('d-m-Y H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

				$data = array(
					'nama_bagian'	 	=> $nama_bagian,
					'id_user'		   => $id_user
				);
				$this->Mcrud->save_bagian($data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Bagian berhasil ditambahkan.
					</div>'
				);

				redirect('users/bagian/t');
			}

			if (isset($_POST['btnupdate'])) {
				$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

				$data = array(
					'nama_bagian'	 => $nama_bagian
				);
				$this->Mcrud->update_bagian(array('id_bagian' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Bagian berhasil diupdate.
					</div>'
				);
				redirect('users/bagian');
			}
		}
	}

	public function sm($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user'] = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('tbl_sm.id_sm', 'DESC');
			$data['sm'] = $this->db->get("tbl_sm");

			if ($aksi == 't') {
				$p = "sm_tambah";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['judul_web'] 	= "Tambah Surat Masuk ";
			} elseif ($aksi == 'd') {
				$p = "sm_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Detail Surat Masuk ";
				if (isset($_POST['btndisposisi'])) {
					$data2 = array(
						'disposisi' => '1'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);

					redirect('users/sm');
				}

				if (isset($_POST['btndisposisi0'])) {
					$data2 = array(
						'disposisi' => '0'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);

					redirect('users/sm');
				}
			} elseif ($aksi == 'e') {
				$p = "sm_edit";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Edit Surat Masuk ";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "Hapus Surat Masuk ";

				if ($data['query']->level != '') {
					$data2 = array(
						'id_user'		   	 => ''
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
				} else {
					$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
					foreach ($query_h->result() as $baris) {
						unlink('./lampiran/surat_masuk/' . $baris->nama_berkas);
					}
					$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
					$this->Mcrud->delete_sm_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>BERHASIL!</strong> DATA BERHASIL DIHAPUS.
						</div>'
					);
				}

				redirect('users/sm');
			} else {
				$p = "sm";
				$data['judul_web'] 	  = "Surat Masuk ";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');

			if (isset($_POST['no_asal'])) {
				$namafile = date('dmy') . '_ARSIP_SURAT_MASUK_' . 'SM_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_masuk/",
					"allowed_types" => "*" //jpg|jpeg|png|gif|bmp|pdf,
				));

				if ($this->upload->do_upload('userfile')) {
					$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
					$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
					$tgl_sm   		= htmlentities(strip_tags($this->input->post('tgl_sm')));
					$tgl_no_asal  	= htmlentities(strip_tags($this->input->post('tgl_no_asal')));
					$pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
					$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
					$bagian   		= htmlentities(strip_tags($this->input->post('bagian')));
					$disposisi   	= htmlentities(strip_tags($this->input->post('disposisi')));
					$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));

					date_default_timezone_set('Asia/Jakarta');
					$waktu = date('Y-m-d H:m:s');
					$tgl 	 = date('d-m-Y');

					$token = md5("$id_user-$no_asal-$waktu");

					$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'no_surat'			=> $ns,
							'tgl_ns'		   	=> $tgl,
							'no_asal'		  	=> $no_asal,
							'tgl_no_asal'		=> $tgl_no_asal,
							'pengirim'		   	=> $pengirim,
							'penerima'	 		=> $penerima,
							'perihal'		   	=> $perihal,
							'token_lampiran' 	=> $token,
							'id_user'			=> $id_user,
							'bagian'			=> $bagian,
							'disposisi'	 		=> $disposisi,
							'tgl_sm'			=> $tgl_sm,
						);
						$this->Mcrud->save_sm($data);
					}

					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');

					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
				}
			}

			if (isset($_POST['btnupdate'])) {
				$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
				$tgl_sm   		= htmlentities(strip_tags($this->input->post('tgl_sm')));
				$tgl_no_asal  	= htmlentities(strip_tags($this->input->post('tgl_no_asal')));
				$pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
				$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
				$bagian   		= htmlentities(strip_tags($this->input->post('bagian')));
				$disposisi   	= htmlentities(strip_tags($this->input->post('disposisi')));
				$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));

				$data = array(
					'no_asal'		  	=> $no_asal,
					'tgl_no_asal'	   	=> $tgl_no_asal,
					'pengirim'		   	=> $pengirim,
					'penerima'	 		=> $penerima,
					'perihal'		   	=> $perihal,
					'bagian'			=> $bagian,
					'disposisi'	 		=> $disposisi,
					'tgl_sm'			=> $tgl_sm,
				);
				$this->Mcrud->update_sm(array('id_sm' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>BERHASIL!</strong> DATA BERHASIL DIPERBAHARUI.
					</div>'
				);
				redirect('users/sm');
			}
		}
	}

	public function sk($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
			$this->db->order_by('tbl_sk.id_sk', 'DESC');
			$data['sk'] 		  = $this->db->get("tbl_sk");

			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get_where("tbl_bagian", "id_user='$id_user'")->result();

			if ($aksi == 't') {
				$p = "sk_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['judul_web'] 	  = "Tambah Surat Keluar ";
			} elseif ($aksi == 'd') {
				$p = "sk_detail";

				$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id"))->row();
				$data['judul_web'] 	  = "Detail Surat Keluar ";

				if ($data['user']->row()->level == 'admin') {
					$data2 = array(
						'dibaca' => '1'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
				}

				if (isset($_POST['btndisposisi'])) {
					$data2 = array(
						'disposisi' => $_POST['bagian']
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}

				if (isset($_POST['btndisposisi0'])) {
					$data2 = array(
						'disposisi' => '0'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}

				if (isset($_POST['btnperingatan'])) {
					$data2 = array(
						'peringatan' => '1'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
					redirect('users/sk');
				}

				if (isset($_POST['btnperingatan0'])) {
					$data2 = array(
						'peringatan' => '0'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}
			} elseif ($aksi == 'e') {
				$p = "sk_edit";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}

				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "Edit Surat Keluar ";

				if ($data['query']->id_user == '') {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
						</div>'
					);

					redirect('users/sk');
				}
			} elseif ($aksi == 'h') {

				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}

				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "Hapus Surat Keluar ";

				if ($data['query']->id_user != '') {
					$data2 = array(
						'id_user'		   	 => ''
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
				} else {

					$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
					foreach ($query_h->result() as $baris) {
						unlink("./lampiran/surat_keluar/" . $baris->nama_berkas);
					}

					$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
					$this->Mcrud->delete_sk_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Surat keluar berhasil dihapus.
						</div>'
					);
				}

				redirect('users/sk');
			} else {
				$p = "sk";
				$data['judul_web'] 	  = "Surat Keluar ";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');

			if (isset($_POST['no_surat'])) {
				$namafile = date('dmy') . '_ARSIP_SURAT_KELUAR_' . 'SK_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_keluar/",
					"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
				));

				if ($this->upload->do_upload('userfile')) {
					$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
					$tgl_id_surat   = htmlentities(strip_tags($this->input->post('tgl_id_surat')));
					$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
					$tgl_sk   	 	= htmlentities(strip_tags($this->input->post('tgl_sk')));
					$status   	 	= htmlentities(strip_tags($this->input->post('status')));
					$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
					$tujuan   	 	= htmlentities(strip_tags($this->input->post('tujuan')));

					date_default_timezone_set('Asia/Jakarta');
					$waktu = date('Y-m-d H:m:s');
					$tgl 	 = date('d-m-Y');

					$token = md5("$id_user-$ns-$waktu");

					$cek_status = $this->db->get_where('tbl_sk', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'id_surat'			 	=> $ns,
							'tgl_id_surat'	   	 	=> $tgl_id_surat,
							'no_surat'			 	=> $no_surat,
							'tgl_sk'	 		 	=> $tgl_sk,
							'status'		 	 	=> $status,
							'perihal'		   	 	=> $perihal,
							'tujuan'		   	 	=> $tujuan,
							'token_lampiran' 		=> $token,
							'id_user'				=> $id_user,
						);
						$this->Mcrud->save_sk($data);
					}

					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');
					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
				}
			}

			if (isset($_POST['btnupdate'])) {
				$tgl_id_surat   = htmlentities(strip_tags($this->input->post('tgl_id_surat')));
				$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
				$tgl_sk   	 	= htmlentities(strip_tags($this->input->post('tgl_sk')));
				$status   	 	= htmlentities(strip_tags($this->input->post('status')));
				$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
				$tujuan   	 	= htmlentities(strip_tags($this->input->post('tujuan')));
				$data = array(
					'no_surat'			 	=> $no_surat,
					'tgl_sk'	 		 	=> $tgl_sk,
					'status'		 	 	=> $status,
					'perihal'		   	 	=> $perihal,
					'tujuan'		   	 	=> $tujuan,
				);
				$this->Mcrud->update_sk(array('id_sk' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Surat Keluar berhasil diupdate.
					</div>'
				);
				redirect('users/sk');
			}
		}
	}

	public function lap_sk()
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Keluar ";

			$this->load->view('users/header', $data);
			$this->load->view('users/laporan/lap_sk', $data);
			$this->load->view('users/footer');

			if (isset($_POST['data_lap'])) {
				$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
				$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

				redirect("users/data_sk/$tgl1/$tgl2");
			}
		}
	}

	public function data_sk($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {

			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");

				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Data Laporan Surat Keluar ";
				$this->load->view('users/header', $data);
				$this->load->view('users/laporan/data_sk', $data);
				$this->load->view('users/footer', $data);

				if (isset($_POST['btncetak'])) {
					redirect("users/cetak_sk/$tgl1/$tgl2");
				}
			} else {
				redirect('404_content');
			}
		}
	}
	public function cetak_sk($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['users']  	 = $this->Mcrud->get_users();
				$data['judul_web'] = "Data Laporan Surat Keluar ";
				$data['t_awal'] = $tgl1;
				$data['t_akhir'] = $tgl2;
				$this->load->view('users/laporan/cetak_sk', $data);
			} else {
				redirect('404_content');
			}
		}
	}

	public function lap_sm()
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Masuk ";

			$this->load->view('users/header', $data);
			$this->load->view('users/laporan/lap_sm', $data);
			$this->load->view('users/footer');

			if (isset($_POST['data_lap'])) {
				$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
				$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

				redirect("users/data_sm/$tgl1/$tgl2");
			}
		}
	}

	public function data_sm($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {

			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");

				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Data Laporan Surat Masuk ";
				$this->load->view('users/header', $data);
				$this->load->view('users/laporan/data_sm', $data);
				$this->load->view('users/footer', $data);

				if (isset($_POST['btncetak'])) {
					redirect("users/cetak_sm/$tgl1/$tgl2");
				}
			} else {
				redirect('404_content');
			}
		}
	}

	public function cetak_sm($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Data Laporan Surat Masuk ";
				$data['t_awal'] = $tgl1;
				$data['t_akhir'] = $tgl2;
				$this->load->view('users/laporan/cetak_sm', $data);
			} else {
				redirect('404_content');
			}
		}
	}
}
