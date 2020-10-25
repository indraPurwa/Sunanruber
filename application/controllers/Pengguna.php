<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
		$this->lang->load('user', $this->session->userdata('language'));
	}
	public function index()
	{
		$this->load->view('templates/admin_tpl', array (
			'header' => $this->lang->line('header'),
			'content' => 'pengguna_index',
			'data' => $this->db->get('pengguna'),
		));
	}
	
	public function tambah()
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$src_by_username = $this->db->get_where('pengguna', array('username' => $this->input->post('username')))->num_rows();
			if ($src_by_username == 1) {
				$this->session->set_flashdata('save_message', 'Username Sudah digunakan');
				goto error_simpan;	
			}

			$src_by_email = $this->db->get_where('pengguna', array('email' => $this->input->post('email')))->num_rows();
			if ($src_by_email == 1) {
				$this->session->set_flashdata('save_message', 'Email Sudah digunakan');
				goto error_simpan;		
			}
			$params = array(
                'username'=> $this->input->post('username'),
                'password'=> md5($this->input->post('password')),
                'nama_lengkap'=> $this->input->post('nama_lengkap'),
                'email'=> $this->input->post('email'),
                'telepon'=> $this->input->post('telepon'),
                'alamat'=> $this->input->post('alamat'),
                'instansi'=> $this->input->post('instansi'),
                'alamat_instansi'=> $this->input->post('alamat_instansi'),
                'level'=> $this->input->post('level'),
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
			
			$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
			redirect(site_url('/pengguna'));
			exit();
		}
		// $this->form();

		$default = array (
			'id_pengguna' => '',
			'username' => '',
			'nama_lengkap' => '',
			'email' => '',
			'alamat' => '',
			'telepon' => '',
			'instansi' => '',
			'alamat_instansi' => '',
			'level' => '',
		);
		$data = (object) $default;
		if ($this->session->flashdata('pengguna_form')) {
			$data = (object) $this->session->flashdata('pengguna_form');
		}
		$action = 'insert';
		$id = '';

		$this->load->view('templates/admin_tpl', array (
			'header' => 'Form Data Pengguna',
			'content' => 'pengguna_form',
			'data' => $data,
			'action' => $action,
			'id_pengguna' => $id,
		));
	}
	
	public function ubah($id)
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$params = array(
                'password'=> md5($this->input->post('password')),
                'nama_lengkap'=> $this->input->post('nama_lengkap'),
                'email'=> $this->input->post('email'),
                'telepon'=> $this->input->post('telepon'),
                'alamat'=> $this->input->post('alamat'),
                'instansi'=> $this->input->post('instansi'),
                'alamat_instansi'=> $this->input->post('alamat_instansi'),
                'level'=> $this->input->post('level'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->update('pengguna', $params, array('id_pengguna' => $this->input->post('id_pengguna')));
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pengguna_form', $this->input->post());
				redirect($this->agent->referrer());
			}

			$this->session->set_flashdata('save_message', 'Data berhasil diubah');
			redirect(site_url('/pengguna'));
			exit();
		}
		
		// $this->form('update', $id);
		$src = $this->db->get_where('pengguna', array('id_pengguna' => $id));
		if ($src->num_rows() == 0) show_404();
		else $data = $src->row();
		if ($this->session->flashdata('pengguna_form')) {
			$data = (object) $this->session->flashdata('pengguna_form');
		}
		
		$action = 'update';
		$id = $id;
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Form Data Pengguna',
			'content' => 'pengguna_form',
			'data' => $data,
			'action' => $action,
			'id_pengguna' => $id,
		));
	}
	
	public function hapus($id){
		$res = $this->db->delete('pengguna', array('id_pengguna' => $id));
		$res_last_id = $this->db->insert_id();
		
		if ($res != 1) { //gagal simpan
			$this->session->set_flashdata('save_message', 'Data Gagal dihapus');
		}else {
			$this->session->set_flashdata('save_message', 'Data berhasil dihapus');
		}
		redirect($this->agent->referrer());
	}
}
