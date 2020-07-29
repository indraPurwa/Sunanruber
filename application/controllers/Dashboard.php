<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
	}

	private function _count_anggota()
	{
		return
			$this->db
					->select('COUNT(id_pelanggan) AS jumlah_anggota')
					->get('pelanggan')
					->row('jumlah_anggota');
	}
	
	private function _sum_simpanan()
	{
		return
			$this->db
					->select('SUM(nominal) AS total_simpanan')
					->get('simpanan')
					->row('total_simpanan');
	}
	
	private function _sum_pinjaman()
	{
		return
			$this->db
					->select('SUM(plafon) AS total_pinjaman')
					->get('pinjaman')
					->row('total_pinjaman');
	}
	
	private function _sum_piutang()
	{
		$sql = "
			SELECT SUM(a.plafon + ROUND(a.bunga *  a.tenor / 12 * a.plafon / 100)) - SUM(b.nominal) AS total_piutang
			FROM pinjaman AS a
			LEFT JOIN angsuran AS b ON a.id = b.id_pinjaman
			WHERE a.status = '0'
		";
		return $this->db->query($sql)->row('total_piutang');
	}
	
	private function _growth_anggota()
	{
		$tahun = date('Y') - 1;
		$sql = "
			SELECT
				SUM(CASE WHEN MONTH(created_at) <= 1 THEN 1 END) AS bulan_1
				, SUM(CASE WHEN MONTH(created_at) <= 2 THEN 1 END) AS bulan_2
				, SUM(CASE WHEN MONTH(created_at) <= 3 THEN 1 END) AS bulan_3
				, SUM(CASE WHEN MONTH(created_at) <= 4 THEN 1 END) AS bulan_4
				, SUM(CASE WHEN MONTH(created_at) <= 5 THEN 1 END) AS bulan_5
				, SUM(CASE WHEN MONTH(created_at) <= 6 THEN 1 END) AS bulan_6
				, SUM(CASE WHEN MONTH(created_at) <= 7 THEN 1 END) AS bulan_7
				, SUM(CASE WHEN MONTH(created_at) <= 8 THEN 1 END) AS bulan_8
				, SUM(CASE WHEN MONTH(created_at) <= 9 THEN 1 END) AS bulan_9
				, SUM(CASE WHEN MONTH(created_at) <= 10 THEN 1 END) AS bulan_10
				, SUM(CASE WHEN MONTH(created_at) <= 11 THEN 1 END) AS bulan_11
				, SUM(CASE WHEN MONTH(created_at) <= 12 THEN 1 END) AS bulan_12
			FROM anggota
			WHERE YEAR(created_at) = '{$tahun}'
		";
		return $this->db->query($sql)->row();
	}
	
	private function _dist_simpanan()
	{
		$sql = "
			SELECT jenis_simpanan, SUM(nominal) AS jumlah_simpanan
			FROM simpanan
			GROUP BY jenis_simpanan
		";
		return $this->db->query($sql);
	}
	
	public function index()
	{
		if ($this->session->userdata('pengguna')->level=='Admin'  ) {
			redirect('pemesanan');
		}
		else if ($this->session->userdata('pengguna')->level=='Pimpinan'  ) {
			$this->load->view('templates/admin_tpl', array (
				'header' => 'Dasbor',
				'content' => 'dasbor_pimpinan',
				// 'jumlah_anggota' => $this->_count_anggota(),
				//'total_simpanan' => $this->_sum_simpanan(),
				//'total_pinjaman' => $this->_sum_pinjaman(),
				//'total_piutang' => $this->_sum_piutang(),
				//'growth_anggota' => $this->_growth_anggota(),
				//'dist_simpanan' => $this->_dist_simpanan(),
			));
		}
		else if ($this->session->userdata('pengguna')->level=='Pelanggan'  ) {
			redirect('pemesanan');
		}
		else if ($this->session->userdata('pengguna')->level=='Gudang'  ) {
			redirect('pemesanan');
		}
	}
	public function tentang()
	{
		$this->load->view('templates/admin_tpl', array (
			'header' => 'Tentang Nusa Simpin',
			'content' => 'tentang_index',
		));
	}
	
}
