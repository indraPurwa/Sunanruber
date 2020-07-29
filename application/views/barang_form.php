<div class="col-sm-10">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			
			<?=form_open();?>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>No. Barang</label>
							<input type="text" class="form-control border-input" name="id_barang" value="<?php echo $data->id_barang; ?>" readonly>
						</div>
					</div>
                    <div class="col-sm-9">
						<div class="form-group">
							<label>Nama Barang</label>
							<input type="text" class="form-control border-input" name="nama" placeholder="Nama Barang" value="<?php echo $data->nama; ?>">
						</div>
					</div>

				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Jenis Karet</label>
							<input type="text" class="form-control border-input" name="jenis_karet" placeholder="Jenis Karet" value="<?php echo ucfirst($data->jenis_karet); ?>">
						</div>
					</div>                
					<div class="col-sm-3">
						<div class="form-group">
							<label>Jumlah</label>
							<input type="number" class="form-control border-input" name="jumlah" placeholder="Jumlah" value="<?php echo ucfirst($data->jumlah); ?>">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Jenis Packing</label>
							<input type="text" class="form-control border-input" name="jenis_packing" placeholder="Jenis Packing" value="<?php echo $data->jenis_packing; ?>">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Harga</label>
						<input type="number" class="form-control border-input" name="harga" placeholder="Harga" value="<?php echo $data->harga; ?>">
						</div>
					</div>                    
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Stuff Date</label>
							<input type="date" class="form-control border-input" name="stuff_date" placeholder="Stuff Date" value="<?php echo $data->stuff_date; ?>">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Rencana Stuff</label>
                            <select name="rencana_stuff" class="form-control border-input" required>
                              <option value="<?php echo $data->rencana_stuff; ?>" selected="selected"><?php echo $data->rencana_stuff; ?></option>
                              <option value="SIANG">SIANG</option>
                              <option value="MALAM">MALAM</option>
                            </select>

						</div>
					</div>
                    <div class="col-sm-4">
						<div class="form-group">
							<label>Stock</label>
							<input type="number" class="form-control border-input" name="stock" placeholder="Stock" value="<?php echo $data->stock; ?>" >
						</div>
					</div>
				</div>
				<div class="text-left">
					<button type="submit" name="save" value="1" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Simpan</button>
					<a href="<?=site_url('barang')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>

<script>
<?php $src = $this->db->like('kode', 'barang_', 'after')->get('konfigurasi'); ?>
<?php foreach ($src->result() as $row): ?>
var <?php echo $row->kode; ?> = <?php echo $row->nilai; ?>;
<?php endforeach; ?>

function nominal_barang()
{
	var jenis_barang = $('[name=jenis_barang]').val();
	var nominal;
	
	switch (jenis_barang) {
		case 'pokok': nominal = barang_pokok; break;
		case 'wajib': nominal = barang_wajib; break;
		default: nominal = '';
	}
	
	$('[name=nominal]').val(nominal);
	
	if (jenis_barang == 'pokok' || jenis_barang == 'wajib')
		$('[name=nominal]').attr('readonly', true);
	
	if (jenis_barang == 'sukarela')
		$('[name=nominal]').attr('readonly', false);
}

$().ready(function() {
	// inisialisasi
	nominal_barang();
	
	// event binding
	$('[name=jenis_barang]').change(nominal_barang);
	
	$('[name=bunga], [name=plafon], [name=tenor]').keyup(function() {
		var bunga = parseFloat($('[name=bunga]').val());
		var plafon = parseInt($('[name=plafon]').val());
		var tenor = parseInt($('[name=tenor]').val());
		var angsuran = 0;
		
		if (isNaN(bunga)) bunga = 0;
		if (isNaN(plafon)) plafon = 0;
		if (isNaN(tenor)) tenor = 0;
		
		if (tenor > 0) angsuran = Math.round(plafon / tenor) + Math.round(plafon * bunga / 100 / tenor);
		$('[name=angsuran]').val(angsuran);
	});
});
</script>