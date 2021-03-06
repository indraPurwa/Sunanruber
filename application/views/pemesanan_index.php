<div class="col-md-12">
	<div class="card">
		<div class="content table-responsive">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			
			<?php
			if ($this->session->userdata('pengguna')->level == 'Pelanggan') 
			{
				?>
					<a href="<?php echo site_url('/pemesanan/tambah'); ?>"><button class="btn btn-default"><?php echo $this->lang->line('button_add'); ?></button></a>
					<br><br>
				<?php
			}
			?>

			<table class="table datatables table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>

							<th><?= $this->lang->line('col_id')?></th>
							<th><?= $this->lang->line('col_waktu')?></th>
							<?php
								if ($this->session->userdata('pengguna')->level == 'Admin' || $this->session->userdata('pengguna')->level == 'Gudang') {
									echo '<th>'.$this->lang->line('col_nama').'</th>';
								}
							?>
							<th><?= $this->lang->line('col_alamat')?></th>
							<th><?= $this->lang->line('col_total')?></th>
							<th><?= $this->lang->line('col_status')?></th>

							<?php
								if ($this->session->userdata('pengguna')->level == 'Admin' || $this->session->userdata('pengguna')->level == 'Gudang') {
									echo '<th>'.$this->lang->line('col_bayar').'</th>';
									echo '<th>'.$this->lang->line('col_kirim').'</th>';
								}
							?>
							<th><?= $this->lang->line('col_aksi')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=0;
						// pp($data);
						foreach ($data as $key => $value) {
							$no++;
							$captionOrderID = str_pad($value['id_pesanan'], 4, '0', STR_PAD_LEFT);
							echo '<tr>
									<td>'.($no).'</td>
									<td>'.date('Ymd',strtotime($value['time_created'])).$captionOrderID.'</td>
									<td>'.date('d-m-Y H:i:s',strtotime($value['time_created'])).'</td>';
							if ($this->session->userdata('pengguna')->level == 'Admin' || $this->session->userdata('pengguna')->level == 'Gudang') {
								echo '<td>'.($value['nama_lengkap']).'</td>';
							}
							echo '<td>'.$value['alamat_kirim'].'</td>
									<td>'.rupiah($value['total']).'</td>
									<td>'.$value['status'].'</td>';
									if ($this->session->userdata('pengguna')->level == 'Admin' || $this->session->userdata('pengguna')->level == 'Gudang') {
										echo '<td>'.($value['tanggal']==''? '':date('d-m-Y',strtotime($value['tanggal'])) ).'</td>';
										echo '<td>'.($value['tgl_kirim']==''? '':date('d-m-Y',strtotime($value['tgl_kirim'])) ).'</td>';
									}

									echo '<td>';
									if ($this->session->userdata('pengguna')->level == 'Pelanggan') 
									{
										echo '
										<a href="'.site_url('pembayaran/pembayaran/'.$value['id_pesanan']).'">Bayar</a> - 
										<a target="_blank" href="'.site_url('pemesanan/cetak_nota/'.$value['id_pesanan']).'">Nota</a> - 
										<a href="'.site_url('pemesanan/ubah/'.$value['id_pesanan']).'">Edit</a>
										- <a href="'.site_url('pemesanan/hapus/'.$value['id_pesanan']).'">Delete</a>';
									}
									else if ($this->session->userdata('pengguna')->level == 'Admin') {
										if ($value['status']=='upload bukti bayar') {
											echo '<a href="'.site_url('pembayaran/pembayaran/'.$value['id_pesanan']).'">Validasi Bayar</a> - ';
										}
										
										echo '<a target="_blank" href="'.site_url('pemesanan/cetak_nota/'.$value['id_pesanan']).'">Nota</a>';
									}
									else if ($this->session->userdata('pengguna')->level == 'Gudang') {
										if ($value['status']=='dibayar') {
											echo '<a href="'.site_url('pengiriman/kirim/'.$value['id_pesanan']).'">Kirim</a> - ';
										}
										echo '<a target="_blank" href="'.site_url('pemesanan/cetak_nota/'.$value['id_pesanan']).'">Nota</a>';

									}
									echo '</td>
								</tr>';
						}
						?>
						
					</tbody>
				</table>
		</div>
	</div>
</div>

<script>
$().ready(function() {
	$('.datatables').DataTable({
		'order': [[0, 'asc']]
	});
});
</script>