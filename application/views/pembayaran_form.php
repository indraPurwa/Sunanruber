<div class="col-sm-12">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>

			<?php
				$pesanan  =$this->db->query('select * from pesanan where id_pesanan='.$id)->row();
				$pesanan_detail = $this->db->query('select sum(a.subTotal) as grandtotal from pesanan_detail as a where id_pesanan='.$id)->row();
				$pembayaran = $this->db->query('select * from pembayaran where id_pesanan='.$id)->result_array();
				// print_r($pembayaran);
			?>
			<legend>Data Pembayaran</legend>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>No Pemesanan</label>
							<input type="text" class="form-control border-input" value="<?php echo create_orderid($pesanan->time_created, $pesanan->id_pesanan); ?>" readonly>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Waktu Pemesanan</label>
							<input type="text" class="form-control border-input" name="time_created" placeholder="Waktu. Pemesanan" value="<?php echo $pesanan->time_created; ?>" readonly>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Alamat Kirim</label>
							<textarea readonly class="form-control border-input" name="alamat_kirim" ><?php echo $pesanan->alamat_kirim; ?></textarea>
						</div>
					</div>

					<?php
					if (count($pembayaran)==0) 
					{
						?>
						<?=form_open_multipart('');?>
						<input type="hidden" class="form-control border-input" name="id_pesanan" value="<?php echo $pesanan->id_pesanan; ?>" readonly>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Tgl Bayar</label>
								<input type="date" class="form-control border-input" name="tanggal" placeholder="Tanggal bayar" required>
							</div>
							<div class="form-group">
								<label>Jumlah Bayar</label>
								<input required type="hidden" class="form-control border-input" name="jumlah" placeholder="Jumlah" value="<?php echo ($pesanan_detail->grandtotal); ?>" readonly>
								<input required type="text" class="form-control border-input" placeholder="Jumlah" value="<?php echo rupiah($pesanan_detail->grandtotal); ?>" readonly>
							</div>
							<div class="form-group">
								<label>Upload bukti bayar</label>
								<!-- <input required type="file" class="form-control border-input" name="file_data"> -->
								<input type="file" class="form-control" name="buktiBayar">
	
							</div>
						</div>
						<div class="col-sm-12" style="padding-top: 30px;">
							<button type="submit" name="save" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
							<a href="<?=site_url('pemesanan')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
						</div>
						</form>

						<?php
					}
					else 
					{
						?>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Tgl Bayar</label>
								<input type="text" class="form-control border-input" readonly name="tanggal" placeholder="Tanggal bayar" value="<?=date('d-m-Y', strtotime($pembayaran[0]['tanggal']))?>" required>
							</div>
							<div class="form-group">
								<label>Jumlah Bayar</label>
								<input required type="text" class="form-control border-input" placeholder="Jumlah" value="<?php echo rupiah($pembayaran[0]['jumlah']); ?>" readonly>
							</div>
							<?php
								if ($this->session->userdata('pengguna')->level == 'Admin') {
									echo form_open_multipart('pembayaran/pembayaran_verifikasi', 'class="form-horizontal" style="display:inline;"')
										.'<input type="hidden" name="id_pesanan" value="'.$id.'">
										<button title="validasi pembayaran" type="submit" name="save" value="1" class="btn btn-fill btn-wd btn-primary">Validasi</button>
										</form>';
								}
							?>
							<a href="<?=site_url('pemesanan')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>

						</div>
						<div class="col-sm-6">
							<label>Bukti Bayar</label>

							<img src="<?=base_url($pembayaran[0]['file'])?>" class="img-responsive" alt="Image">
							
						</div>

						<?php
					}
					?>
				</div>

		</div>
	</div>
</div>
