<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
	}
	
	public function index()
	{
		if ($this->session->userdata('pengguna')->level == 'Admin') {
			$data = $this->db
							->query('select a.*, b.tanggal, c.tgl_kirim, pa.nama_lengkap,
								(select sum(b.subTotal) from pesanan_detail as b where a.id_pesanan=b.id_pesanan) as total
							from pesanan as a
								left join pembayaran as b	
									on a.id_pesanan=b.id_pesanan
								left join pengiriman as c
									on a.id_pesanan=c.id_pesanan
								join pengguna pa
									on pa.id_pengguna=a.id_pengguna
								')
							->result_array();
		}
		elseif ( ($this->session->userdata('pengguna')->level == 'Pelanggan') ) {
			$data = $this->db
							->query('select *,
								(select sum(b.subTotal) from pesanan_detail as b where a.id_pesanan=b.id_pesanan) as total
							 from pesanan as a
								where a.id_pengguna='.$this->session->userdata('pengguna')->id_pengguna
								)
							->result_array();
		}
		elseif ( ($this->session->userdata('pengguna')->level == 'Gudang') ) {
			$data = $this->db
							->query('select a.*, b.tanggal, c.tgl_kirim, pa.nama_lengkap,
								(select sum(b.subTotal) from pesanan_detail as b where a.id_pesanan=b.id_pesanan) as total
							 from pesanan as a
								left join pembayaran as b	
									on a.id_pesanan=b.id_pesanan
								left join pengiriman as c
									on a.id_pesanan=c.id_pesanan
								join pengguna pa
								on pa.id_pengguna=a.id_pengguna
								')
							->result_array();
		}
		
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Pemesanan',
			'content' => 'pemesanan_index',
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
				'id_pengguna'=> $this->session->userdata('pengguna')->id_pengguna,
				'alamat_kirim'=> $this->input->post('alamat_kirim'),
				'status'=> 'dipesan',
                'time_created'=> date('Y-m-d H:i:s', strtotime($this->input->post('time_created'))),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->insert('pesanan', $params);
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pesanan', $this->input->post());
				redirect($this->agent->referrer());
			}else { //berhasil
				$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
				redirect('pemesanan/ubah/'.$res_last_id);
				exit();
			}
			
		}

		$default = array (
			'id_pesanan' => '- No. Otomatis -',
			'alamat_kirim' => $this->session->userdata('pengguna')->alamat_instansi,
			'time_created' => date('d-m-Y H:i:s'),
		);
		$data = (object) $default;
		if ($this->session->flashdata('pesanan')) {
			$data = (object) $this->session->flashdata('pesanan');
		}
		$action = 'insert';
		$id = '';

		$this->load->view('templates/admin_tpl', array (
			'header' => 'Form Pemesanan',
			'content' => 'pemesanan_form',
			'data' => $data,
			'action' => $action,
			'id' => $id,
		));

		// $this->form();
	}
	public function tambah_detail()
	{
		if ($this->input->post('save_detail')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$barang = $this->db->get_where('barang', array('id_barang' => $this->input->post('id_barang')))->row();
			if ( ($barang->stock-$this->input->post('jumlah') ) < 0) {
				$this->session->set_flashdata('save_message', 'Stok barang tidak cukup. Pemesanan gagal');
				goto error_simpan2;
			}
			$params = array(
                'id_pesanan'=> $this->input->post('id_pesanan'),
                'id_barang'=> $this->input->post('id_barang'),
                'jumlah'=> $this->input->post('jumlah'),
                'harga'=> $barang->harga,
                'subTotal'=> $this->input->post('jumlah')*$barang->harga,
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->insert('pesanan_detail', $params);
			$res_last_id = $this->db->insert_id();


			$params = array(
                'stock'=> $barang->stock - $this->input->post('jumlah'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$this->db->update('barang', $params, array('id_barang' => $this->input->post('id_barang')));
		
			
			if ($res != 1) { //gagal simpan
				error_simpan2:
				$this->session->set_flashdata('pesanan_detail', $this->input->post());
				redirect($this->agent->referrer());
			}else { //berhasil
				$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
				redirect('pemesanan/ubah/'.$this->input->post('id_pesanan'));
				exit();
			}
		}
	}
	
	public function ubah($id)
	{
		if ($this->input->post('save')==1) {
			// echo '<pre>';
			// print_r($this->input->post()); echo '</pre>';
			// exit();
			$params = array(
				'alamat_kirim'=> $this->input->post('alamat_kirim'),
			);
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$res = $this->db->update('pesanan', $params, array('id_pesanan' => $this->input->post('id_pesanan')));
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pesanan', $this->input->post());
				redirect($this->agent->referrer());
			}

			$this->session->set_flashdata('save_message', 'Data berhasil diubah');
			redirect($this->agent->referrer());
			exit();
		}

		$src = $this->db->get_where('pesanan', array('id_pesanan' => $id));
		if ($src->num_rows() == 0) show_404();
		else $data = $src->row();
		if ($this->session->flashdata('pesanan')) {
			$data = (object) $this->session->flashdata('pesanan');
		}
		$action = 'update';
		$id = $id;

		$this->load->view('templates/admin_tpl', array (
			'header' => 'Form Pemesanan',
			'content' => 'pemesanan_form',
			'data' => $data,
			'action' => $action,
			'id' => $id,
		));
	}
	
	public function hapus($id)
	{
		$pesanan_detail = $this->db->get_where('pesanan_detail', array('id_pesanan' => $id) )->num_rows();
		if ($pesanan_detail==0) {
			$res = $this->db->delete('pesanan', array('id_pesanan' => $id));
			$res_last_id = $this->db->insert_id();
	
			if ($res != 1) { //gagal simpan
				$this->session->set_flashdata('save_message', 'Data Gagal dihapus');
			}else {
				$this->session->set_flashdata('save_message', 'Data berhasil dihapus');
			}
			redirect($this->agent->referrer());
		}
		else {
			$this->session->set_flashdata('save_message', 'Terdapat barang dalam pesanan ini. Hapus barang terlebih dahulu');
			redirect($this->agent->referrer());
		}
	}
	public function hapus_detail($id, $id_barang, $jumlah)
	{
		$res = $this->db->delete('pesanan_detail', array('id' => $id));
		$res_last_id = $this->db->insert_id();

		$barang = $this->db->get_where('barang', array('id_barang' => $id_barang) )->row();
		$params = array(
			'stock'=> $barang->stock + $jumlah,
		);
		$this->db->update('barang', $params, array('id_barang' => $id_barang) );

		if ($res != 1) { //gagal simpan
			$this->session->set_flashdata('save_message', 'Data Gagal dihapus');
		}else {
			$this->session->set_flashdata('save_message', 'Data berhasil dihapus');
		}
		redirect($this->agent->referrer());
	}

	public function cetak_nota($id)
	{
		$this->load->view('cetak_nota',[
			'id'=> $id
		]);
	}
}
