<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
	}
	
	public function barang()
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
		$this->load->view('laporan_barang', array (
			'data' => $data,
		));
	}
	
	public function pesanan()
	{
		if ($this->input->post('aksi')=='tampil') {
			$tgl_awal = date('Y-m-d', strtotime($this->input->post('p1')));
			$tgl_akhir = date('Y-m-d', strtotime($this->input->post('p2')));
			
			$data = $this->db
							->query('select a.*, DATE(time_created) AS tgl_pendaftaran, b.*, c.*, d.*
								,(select sum(e.subTotal) from pesanan_detail as e where a.id_pesanan=e.id_pesanan) as total
								from pesanan AS a
									join pengguna as d
										on d.id_pengguna = a.id_pengguna
									left join pembayaran as b	
										on a.id_pesanan=b.id_pesanan
									left join pengiriman as c
										on a.id_pesanan=c.id_pesanan
								where DATE(time_created) BETWEEN \''.$tgl_awal.'\' AND \''.$tgl_akhir.'\'
								order by a.time_created
							')->result_array();
							
			$this->load->view('laporan_pemesanan_cetak', array (
				'data' => $data,
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
			));
			return true;
		}
		
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Laporan Pendaftaran Anggota',
			'content' => 'laporan_pemesanan',
			// 'tgl_awal' => $tgl_awal,
			// 'tgl_akhir' => $tgl_akhir,
			// 'data' => $data,
		));
	}
	public function grafikPenjualanBarang()
	{
		$tahun=NULL;
		$barangs=[];
		if ($this->input->post('aksi')=='tampil') {
			$barangs=$this->db->query('select * from barang')->result_array();
			$tahun = $this->input->post('tahun');
		}
		$tahuns = $this->db->query('select distinct year(p.time_created ) as tahun from id11232635_db_sunanruber.pesanan p order by p.time_created desc')->result_array();
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Laporan ',
			'content' => 'section/laporan/grafikPenjualanBarang',
			'tahuns'=>$tahuns,
			'tahun'=>$tahun,
			'barangs'=>$barangs,
			// 'tgl_awal' => $tgl_awal,
			// 'tgl_akhir' => $tgl_akhir,
			// 'data' => $data,
		));
	}
}
