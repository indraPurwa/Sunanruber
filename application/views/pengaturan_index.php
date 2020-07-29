<div class="col-md-7">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_config_status') == 'ok'): ?>
			<div class="alert alert-success"><?php echo 'Your config has been updated'; ?></div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('save_config_message') != FALSE): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_config_message'); ?></div>
			<?php endif; ?>
			
			<form method="post" action="<?php echo site_url('/pengaturan/save'); ?>">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Koperasi</label>
							<input type="text" class="form-control border-input" name="nama_koperasi" placeholder="Nama Koperasi" value="<?php echo $data->nama_koperasi; ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Alamat Koperasi</label>
							<textarea class="form-control border-input" name="alamat_koperasi" rows="5"><?php echo $data->alamat_koperasi; ?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>No. Telepon</label>
							<input type="text" class="form-control border-input" name="no_telp" placeholder="No. Telepon" value="<?php echo $data->no_telp; ?>">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control border-input" name="email" placeholder="Email" value="<?php echo $data->email; ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Simpanan Pokok (Rp)</label>
							<input type="text" class="form-control border-input" name="simpanan_pokok" placeholder="Simpanan Pokok (Rp)" value="<?php echo $data->simpanan_pokok; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Simpanan Wajib (Rp)</label>
							<input type="text" class="form-control border-input" name="simpanan_wajib" placeholder="Simpanan Wajib (Rp)" value="<?php echo $data->simpanan_wajib; ?>">
						</div>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>