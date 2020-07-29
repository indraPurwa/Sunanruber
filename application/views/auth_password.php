<div class="col-md-6">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_password_status') == 'ok'): ?>
			<div class="alert alert-success"><?php echo 'Password berhasil diubah'; ?></div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('save_password_message') != FALSE): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_password_message'); ?></div>
			<?php endif; ?>
			
			<?=form_open();?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Password Lama</label>
							<input type="password" class="form-control border-input" name="old_password" placeholder="Password Lama">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Password Baru</label>
							<input type="password" class="form-control border-input" name="new_password" placeholder="Password Baru">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Ketik Ulang Password</label>
							<input type="password" class="form-control border-input" name="retype_password" placeholder="Ketik Ulang Password">
						</div>
					</div>
				</div>
				<div class="text-left">
					<button name="save" value="1" type="submit" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
					<a href="<?php echo site_url('dashboard'); ?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Batal</a>

				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>