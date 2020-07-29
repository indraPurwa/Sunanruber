<div class="col-sm-12">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			
			<?php if ($action == 'update'): ?>
			<div class="alert alert-warning">Biarkan password kosong jika anda tidak ingin mengubah password tersebut</div>
			<?php endif; ?>
			
			<?=form_open();?>
				<input type="hidden"name="id_pengguna" value="<?php echo $data->id_pengguna; ?>">

				<div class="row">
					<div class="col-sm-12">
						<Legend>Username dan password untuk login</Legend>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control border-input" name="username" placeholder="Username" <?=($data->id_pengguna==''?'':'readonly')?> value="<?php echo $data->username; ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control border-input" name="password" placeholder="Password" <?=($data->id_pengguna==''?'required':'')?>>
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
						<div class="form-group">
							<label>Level</label>
                            <select class="form-control border-input" name="level" required>
                            <option value="<?php echo $data->level; ?>" selected="selected"><?php echo $data->level; ?></option>
                              <option value="Admin">Admin</option>
                              <option value="Pimpinan">Pimpinan</option>
                              <option value="Pelanggan">Pelanggan</option>
                              <option value="Gudang">Gudang</option>
                            </select>
						</div>
					</div>
				</div>
				<div class="text-left">
					<button type="submit" name="save" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
					<a href="<?=site_url('pengguna')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>