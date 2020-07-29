<div class="col-sm-10">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			<legend>Laporan Pemesanan</legend>
			<?=form_open('', 'target="_blank"');?>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Periode Awal</label>
							<input type="date" class="form-control border-input" name="p1" >
						</div>
					</div>
                    <div class="col-sm-3">
						<div class="form-group">
							<label>Periode Akhir</label>
							<input type="date" class="form-control border-input" name="p2">
						</div>
					</div>
				</div>
                <div class="text-left">
					<button type="submit" name="aksi" value="tampil" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Cetak</button>
					<a href="<?=site_url('dashboard')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
				</div>
            </form>
        </div>
        </div>
        </div>