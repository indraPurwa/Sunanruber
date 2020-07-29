<div class="col-md-12">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_profile_status') == 'ok'): ?>
			<div class="alert alert-success"><?php echo 'Your profile has been updated successfully'; ?></div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('save_profile_message') != FALSE): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_profile_message'); ?></div>
			<?php endif; ?>
			
			<?=form_open();?>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control border-input" readonly name="username" placeholder="Username" <?=($data->id_pengguna==''?'':'readonly')?> value="<?php echo $data->username; ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control border-input" readonly name="password" placeholder="Password" <?=($data->id_pengguna==''?'required':'')?>>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<Legend>Detail Pengguna</Legend>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nama Pengguna</label>
							<input type="text" class="form-control border-input" name="nama_lengkap" placeholder="Nama Pengguna" value="<?php echo $data->nama_lengkap; ?>" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control border-input" name="email" placeholder="Email" value="<?php echo $data->email; ?>" required>
						</div>
						<div class="form-group">
							<label>No. HP</label>
							<input type="text" class="form-control border-input" name="telepon" placeholder="No. HP" value="<?php echo $data->telepon; ?>" required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea type="text" class="form-control border-input" name="alamat" placeholder="alamat" required><?php echo $data->alamat; ?></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Asal Instansi</label>
							<input type="text" class="form-control border-input" name="instansi" placeholder="instansi" value="<?php echo $data->instansi; ?>">
						</div>
						<div class="form-group">
							<label>Alamat Instansi</label>
							<textarea type="text" class="form-control border-input" name="alamat_instansi" placeholder="Alamat instansi" ><?php echo $data->alamat_instansi; ?></textarea>
						</div>
					</div>
				</div>
				
				<div class="text-left">
					<button type="submit" name="save" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
					<a href="<?php echo site_url('dashboard'); ?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Batal</a>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>