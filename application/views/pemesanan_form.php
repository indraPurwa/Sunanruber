<div class="col-sm-12">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			<legend>Data Pemesanan</legend>
			<?=form_open();?>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>No Pemesanan</label>
							<input type="text" class="form-control border-input" name="id_pesanan" value="<?php echo $data->id_pesanan; ?>" readonly>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Waktu Pemesanan</label>
							<input type="text" class="form-control border-input" name="time_created" placeholder="Waktu. Pemesanan" value="<?php echo $data->time_created; ?>" readonly>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Alamat Kirim</label>
							<textarea class="form-control border-input" name="alamat_kirim" ><?php echo $data->alamat_kirim; ?></textarea>
						</div>
					</div>
					<div class="col-sm-6" style="    padding-top: 30px;">
						<button type="submit" name="save" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
						<a href="<?=site_url('pemesanan')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
					</div>

				</div>
			</form>

			<?php
			if ($action=='update') {
			?>
			<?=form_open('pemesanan/tambah_detail');?>
				<input type="hidden"name="id_pesanan" value="<?php echo $data->id_pesanan; ?>" readonly>
				<div class="row">
					<div class="col-sm-9">
						<?php
						
						$src = $this->db
										->select("*")
										->order_by('id_barang')
										->get('barang');
						?>
						<div class="form-group">
							<label>No. / Nama Barang</label>
							<select class="form-control border-input" name="id_barang" required>
								<option value="" selected="selected">- Pilih Barang -</option>
								<?php foreach ($src->result() as $row): ?>
								<option value="<?php echo $row->id_barang; ?>">
									<?php echo $row->nama.', Harga: Rp.'.number_format($row->harga).', Stok: '.$row->stock; ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Jumlah</label>
							<input type="number" class="form-control border-input" name="jumlah" placeholder="Jumlah" value="" required>
						</div>
					</div>
				</div>
				<div class="text-left">
					<button type="submit" name="save_detail" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
				</div>
			</form>

			<table class="table datatables table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Sub Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$src = $this->db
						->query('
							select a.*, b.nama from pesanan_detail as a
							join barang as b
								on a.id_barang = b.id_barang
							where a.id_pesanan = '.$id.'
						')
						->result_array();
					// echo '<pre>';
					// print_r($src);
					// echo '</pre>';
					foreach ($src as $key => $value) {
						echo '<tr>
							<td>'.($key+1).'</td>
							<td>'.$value['nama'].'</td>
							<td>'.number_format($value['harga']).'</td>
							<td>'.number_format($value['jumlah']).'</td>
							<td>'.number_format($value['subTotal']).'</td>
							<td>
								<a href="'.site_url('pemesanan/hapus_detail/'.$value['id'].'/'.$value['id_barang'].'/'.$value['jumlah']).'">Del</a>
							</td>
						</tr>';
					}
					?>
				</tbody>
			</table>

			<?php
			}
			?>
		</div>
	</div>
</div>
