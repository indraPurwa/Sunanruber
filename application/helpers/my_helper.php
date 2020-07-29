<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('pp'))
{
	function pp($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

if ( ! function_exists('get_trx_no'))
{
	function get_trx_no($trx)
	{
		$code_map = array (
			'anggota' => 'AGT',
			'simpanan' => 'SMPN',
			'pinjaman' => 'PNJM',
			'angsuran' => 'ANGS',
		);
		
		$digit = 4;
		
		$ci =& get_instance();
		
		$src = $ci->db->get_where('nomor', array('trx' => $trx));
		
		if ($src->num_rows() == 0) {
			$data = array (
				'trx' => $trx,
				'kode_trx' => $code_map[$trx],
				'no_selanjutnya' => 2,
			);
			
			$ci->db->insert('nomor', $data);
			
			$no = 1;
		}
		else {
			$no = $src->row('no_selanjutnya');
			$ci->db->update('nomor', array('no_selanjutnya' => $no + 1), array('trx' => $trx));
		}
		
		return $code_map[$trx].'-'.str_pad($no, $digit, '0', STR_PAD_LEFT);
	}
}

if ( ! function_exists('rupiah'))
{
	function rupiah($number)
	{
		return 'Rp'.number_format($number, 0, ',', '.');
	}
}

if ( ! function_exists('decimal'))
{
	function decimal($number)
	{
		return number_format($number, 2, ',', '.');
	}
}

if ( ! function_exists('pinjaman_status'))
{
	function pinjaman_status($code)
	{
		return $code == 1 ? '<font color="Green">LUNAS</font>' : '<font color="Crimson">ONGOING</font>';
	}
}

if ( ! function_exists('create_orderid'))
{
	function create_orderid($date, $no, $jum=4)
	{
		$captionOrderID = str_pad($no, $jum, '0', STR_PAD_LEFT);
		return date('Ymd',strtotime($date)).$captionOrderID;
	}
}

if ( ! function_exists('getColor'))
{
	function getColor($id)
	{
		$color=['#68B3C8','#F3BB45','#EB5E28','#7AC29A','#7A9E9F','rgba(104, 179, 200, 0.8)','rgba(122, 194, 154, 0.8)','Gray','Maroon','Olive','Green','Purple','Teal','Navy'];
		return $color[$id];
	}
}