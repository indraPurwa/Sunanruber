<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
		}
		
		$this->lang->load('barang', $this->session->userdata('language'));
	}
	
	public function index()
	{

		$data = $this->db
						->select ('
							a.id_barang
							, a.nama
							, a.jenis_karet
							, a.jumlah
							, a.jenis_packing
							, a.harga
							, a.stuff_date
							, a.rencana_stuff
							, a.stock
						')
						->from('barang AS a')
						//->join('anggota AS b', 'a.id_anggota = b.id')
						->order_by('a.nama ASC')
						->get();
		
		$this->load->view('templates/admin_tpl', array (
			'header' => $this->lang->line('header'),
			'content' => 'barang_index',
			'data' => $data,
		));
	}
	
	public function tambah()
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$params = array(
                'nama'=> $this->input->post('nama'),
                'jenis_karet'=> $this->input->post('jenis_karet'),
                'jumlah'=> $this->input->post('jumlah'),
                'jenis_packing'=> $this->input->post('jenis_packing'),
                'harga'=> $this->input->post('harga'),
                'stuff_date'=> $this->input->post('stuff_date'),
                'rencana_stuff'=> $this->input->post('rencana_stuff'),
                'stock'=> $this->input->post('stock'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->insert('barang', $params);
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('barang', $this->input->post());
				redirect($this->agent->referrer());
			}
			
			$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
			redirect(site_url('/barang'));
			exit();
		}

		$default = array (
			'id_barang' => '- No. Otomatis -',
			'nama' => '',
			'jenis_karet' => '',
			'jumlah' => '',
			'jenis_packing' => '',
			'harga' => '',
			'stuff_date' => date('Y-m-d'),
			'rencana_stuff' => '',
			'stock' => '',
		);
		$data = (object) $default;
		if ($this->session->flashdata('barang')) {
			$data = (object) $this->session->flashdata('barang');
		}
		$action = 'insert';
		$id = '';

		$this->load->view('templates/admin_tpl', array (
			'header' => $this->lang->line('header_form'),
			'content' => 'barang_form',
			'data' => $data,
			'action' => $action,
			'id_barang' => $id,
		));
	}
	
	public function ubah($id)
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$params = array(
                'nama'=> $this->input->post('nama'),
                'jenis_karet'=> $this->input->post('jenis_karet'),
                'jumlah'=> $this->input->post('jumlah'),
                'jenis_packing'=> $this->input->post('jenis_packing'),
                'harga'=> $this->input->post('harga'),
                'stuff_date'=> $this->input->post('stuff_date'),
                'rencana_stuff'=> $this->input->post('rencana_stuff'),
                'stock'=> $this->input->post('stock'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->update('barang', $params, array('id_barang' => $this->input->post('id_barang')));
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('barang', $this->input->post());
				redirect($this->agent->referrer());
			}

			$this->session->set_flashdata('save_message', 'Data berhasil diubah');
			redirect(site_url('/barang'));
			exit();
		}
		
		// $this->form('update', $id);
		$src = $this->db->get_where('barang', array('id_barang' => $id));
		if ($src->num_rows() == 0) show_404();
		else $data = $src->row();
		if ($this->session->flashdata('barang')) {
			$data = (object) $this->session->flashdata('barang');
		}
		
		$action = 'update';
		$id = $id;
		$this->load->view('templates/admin_tpl', array (
			'header' => $this->lang->line('header_form'),
			'content' => 'barang_form',
			'data' => $data,
			'action' => $action,
			'id_barang' => $id,
		));
		// $this->form('update', $id);
	}
	
	public function hapus($id){
		$res = $this->db->delete('barang', array('id_barang' => $id));
		$res_last_id = $this->db->insert_id();
		
		if ($res != 1) { //gagal simpan
			$this->session->set_flashdata('save_message', 'Data Gagal dihapus');
		}else {
			$this->session->set_flashdata('save_message', 'Data berhasil dihapus');
		}
		redirect($this->agent->referrer());
	}
}
