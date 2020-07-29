<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
	}
	
	public function kirim($id)
	{
        $params = array(
            'id_pesanan'=> $id,
        );
        $res = $this->db->insert('pengiriman', $params);

        $params = array(
            'status'=> 'dikirim',
        );
        $res = $this->db->update('pesanan', $params, array('id_pesanan' => $id) );
        $res_last_id = $this->db->insert_id();
        
        if ($res != 1) { //gagal simpan
            $this->session->set_flashdata('save_message', 'Data Gagal disimpan');

        }else { //berhasil
            $this->session->set_flashdata('save_message', 'Data berhasil disimpan');
        }
        redirect($this->agent->referrer());
    }
}