<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function index()
	{
		$this->login();
	}
	
	public function login()
	{
		if ($this->input->post('login')==1) {
			# ambil data dari form
			$params=[
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
			];
			# ambil data dari database
			$src = $this->db->get_where('pengguna', $params);
			
			# cek apakah ada data yg sesuai atau tidak
			if ($src->num_rows() > 0) {
				# simpan session untuk simpan data pengguna
				$this->session->set_userdata('pengguna', $src->row());
				$this->session->set_userdata('status_login', 1);
				$this->session->set_userdata('language', 'indonesia');
				// $plgn = strtoupper($this->session->userdata('pengguna')->id_user);
				// $src2 = $this->db->get_where('pelanggan', $plgn);
				// $this->session->set_userdata('pelanggan', $src2->row());
				
				# flash data untuk pesan selamat datang di dashboard
				$this->session->set_flashdata('login_status', 'ok');
						
				# redirect ke halaman dashboard
				redirect(site_url('/dashboard'));
			}
			else {
				# login gagal, simpan pesan melalui flash data
				$this->session->set_flashdata('login_status', 'err');
				
				# redirect kembali ke halaman login
				redirect(site_url());
			}
		}
		else {
			$this->load->view('templates/login_tpl');
		}
	}
	
	public function daftar()
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			
			if ($this->input->post('password')!=$this->input->post('re_password')) {
				$this->session->set_flashdata('save_message', 'Password dan ulangi password tidak sama');
				goto error_simpan;	
			}

			$src_by_email = $this->db->get_where('pengguna', array('email' => $this->input->post('email')))->num_rows();
			if ($src_by_email == 1) {
				$this->session->set_flashdata('save_message', 'Email Sudah digunakan');
				goto error_simpan;		
			}
			$params = array(
                'username'=> $this->input->post('email'),
                'password'=> md5($this->input->post('password')),
                'nama_lengkap'=> $this->input->post('nama_lengkap'),
                'email'=> $this->input->post('email'),
                'telepon'=> $this->input->post('telepon'),
                'alamat'=> $this->input->post('alamat'),
                'instansi'=> $this->input->post('instansi'),
                'alamat_instansi'=> $this->input->post('alamat_instansi'),
                'level'=> 'Pelanggan',
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->insert('pengguna', $params);
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pengguna_form', $this->input->post());
				redirect($this->agent->referrer());
			}
			
			$this->session->set_flashdata('save_message', 'Berhasil daftar sebagai pelanggan. Silahkan login');
			redirect(site_url('auth'));
			exit();
		}
		$this->load->view('templates/daftar_anggota');
	}
	
	public function logout()
	{
		# hancurkan session
		$this->session->sess_destroy();
		
		# redirect ke halaman login
		redirect(site_url());
	}
	
	public function profil()
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$params = array(
                'nama_lengkap'=> $this->input->post('nama_lengkap'),
                'email'=> $this->input->post('email'),
                'telepon'=> $this->input->post('telepon'),
                'alamat'=> $this->input->post('alamat'),
                'instansi'=> $this->input->post('instansi'),
                'alamat_instansi'=> $this->input->post('alamat_instansi'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->update('pengguna', $params, array('id_pengguna' => $this->session->userdata('pengguna')->id_pengguna));
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pengguna_form', $this->input->post());
				redirect($this->agent->referrer());
			}

			$this->session->set_flashdata('save_message', 'Profil pribadi berhasil diubah');
			redirect(site_url('dashboard'));
			exit();
		}
		
		if ($this->session->flashdata('pengguna') != FALSE) $data = $this->session->flashdata('pengguna');
		else $data = $this->session->userdata('pengguna');
		
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Profil Pengguna',
			'content' => 'auth_profil',
			'data' => $data,
		));
	}
	
	public function password()
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			# atur rule untuk form
			$this->form_validation->set_rules('old_password', 'Password Lama', 'required');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'required');
			$this->form_validation->set_rules('retype_password', 'Ketik Ulang Password', 'required');
			
			# cek validasi form
			if ($this->form_validation->run() == TRUE) {
				# ambil data dari form
				$old_password = md5($this->input->post('old_password'));
				$new_password = md5($this->input->post('new_password'));
				$retype_password = md5($this->input->post('retype_password'));
				
				# cek new_password dan retype_password, harus sama
				if ($new_password != $retype_password) {
					# field ada yg kosong
					$this->session->set_flashdata('save_password_message', 'Password Baru and Ketik Ulang Password do not match');
				}
				else {
					# ambil id pengguna
					$id = $this->session->userdata('pengguna')->id_pengguna;
					
					# cek apakah old_password sudah benar
					$src = $this->db->get_where('pengguna', array('id_pengguna' => $id, 'password' => $old_password));
					
					# old_password tidak benar
					if ($src->num_rows() == 0) {
						$this->session->set_flashdata('save_password_message', 'Password Lama salah');
					}
					# old_password benar, update password
					else {
						$data = array (
							'password' => $new_password,
						);
						$this->db->update('pengguna', $data, array('id_pengguna' => $id));
						$this->session->set_flashdata('save_password_status', 'ok');
					}
				}
			}
			else {
				# field ada yg kosong
				$this->session->set_flashdata('save_password_message', validation_errors());
			}
			
			# redirect
			redirect(site_url('/auth/password'));
		}
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Ubah Password',
			'content' => 'auth_password',
		));
	}

	public function language($language)
	{
		$this->session->set_userdata('language', $language);
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function cek()
	{
		echo '<pre>';
		print_r($this->session->userdata());
		echo '</pre>';
	}
	
}
