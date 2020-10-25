<div class="col-md-12">
	<div class="card">
		<div class="content table-responsive">

			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>

			<a href="<?php echo site_url('/barang/tambah'); ?>"><button class="btn btn-default"><?= $this->lang->line('button_add')?></button></a>
			<br><br>
			<table class="table datatables table-striped">
				<thead>
					<tr>
					<th>No.</th>
					<th><?= $this->lang->line('col_id')?></th>
					<th><?= $this->lang->line('col_nama')?></th>
					<th><?= $this->lang->line('col_jenis')?></th>
					<th><?= $this->lang->line('col_jumlah')?></th>
					<th><?= $this->lang->line('col_jenis_packing')?></th>
					<th><?= $this->lang->line('col_stuff_date')?></th>
					<th><?= $this->lang->line('col_rencata')?></th>
					<th><?= $this->lang->line('col_stock')?></th>
					<th><?= $this->lang->line('col_aksi')?></th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($data->result() as $row): ?>
					<tr>
			<th><?php echo $no; ?></th>
						<td><?php echo $row->id_barang; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo $row->jenis_karet; ?></td>
						<td><?php echo $row->jumlah; ?></td>
						<td><?php echo $row->jenis_packing; ?></td>
                        <td><?php echo $row->stuff_date; ?></td>
                        <td><?php echo $row->rencana_stuff; ?></td>
						<td><?php echo number_format($row->stock); ?></td>
						<td>
							<a href="<?php echo site_url('/barang/ubah/'.$row->id_barang); ?>">Edit</a> -
							<a href="<?php echo site_url('/barang/hapus/'.$row->id_barang); ?>">Del</a>
						</td>
					</tr>
					<?php $no++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
$().ready(function() {
	$('.datatables').DataTable({
		'order': [[0, 'desc']]
	});
});
</script>