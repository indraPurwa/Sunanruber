<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('status_login') == 1) {
        }
        else {
            redirect('auth');
            exit();
        }
	}

	public function pembayaran($id)
	{
		// echo '<pre>';
		// print_r($this->input->post()); echo '</pre>';
		// exit();
		if(@$_FILES['buktiBayar']['size'] != 0 ){
            $config['upload_path'] = './assets/upload/bukti_bayar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $this->input->post('id_penjualan').'_'.uniqid();
            $config['max_size']     = '1000';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('buktiBayar')){
                $msg = $this->upload->display_errors();
                $msg = '<div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Maaf!</h4>
                            '.$msg.'
                        </div>';
            } else {
                $foto = $this->upload->data('file_name');
                
				$params = array(
					'tanggal'=> date('Y-m-d', strtotime($this->input->post('tanggal'))),
					'id_pesanan'=> $this->input->post('id_pesanan'),
					'jumlah'=> $this->input->post('jumlah'),
					'file'=> 'assets/upload/bukti_bayar/'.$foto,
				);
				// echo '<pre>';
				// print_r($params); echo '</pre>';
				// exit();
				$res = $this->db->insert('pembayaran', $params);

				$params = array(
					'status'=> 'upload bukti bayar',
				);
				$res = $this->db->update('pesanan', $params, array('id_pesanan' => $this->input->post('id_pesanan')) );

				$res_last_id = $this->db->insert_id();
				
				if ($res != 1) { //gagal simpan
					error_simpan:
					$this->session->set_flashdata('pembayaran', $this->input->post());
					redirect($this->agent->referrer());
				}else { //berhasil
					$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
					redirect('pembayaran/pembayaran/'.$this->input->post('id_pesanan'));
					exit();
				}
			}
			echo $msg;
			exit();
        }
		

		$this->load->view('templates/admin_tpl', array (
			'header' => 'Form Pemesanan',
			'content' => 'pembayaran_form',
			// 'data' => $data,
			// 'action' => $action,
			'id' => $id,
		));

	}
	public function pembayaran_verifikasi()
	{
		if ($this->input->post('save')==1) {
			
			// echo '<pre>';
			// print_r($params); echo '</pre>';
			// exit();
			$params = array(
				'id_pengguna_verifikator'=> $this->session->userdata('pengguna')->id_pengguna,
			);
			$res = $this->db->update('pembayaran', $params, array('id_pesanan'=>$this->input->post('id_pesanan')) );

			$params = array(
				'status'=> 'dibayar',
			);
			$res = $this->db->update('pesanan', $params, array('id_pesanan' => $this->input->post('id_pesanan')) );
			$res_last_id = $this->db->insert_id();
			
			if ($res != 1) { //gagal simpan
				error_simpan:
				$this->session->set_flashdata('pesanan', $this->input->post());
				redirect($this->agent->referrer());
			}else { //berhasil
				$this->session->set_flashdata('save_message', 'Data berhasil disimpan');
				redirect('pemesanan/');
				exit();
			}
			
		}
	}
	
}
