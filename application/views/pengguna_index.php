<div class="col-md-12">
	<div class="card">
		<div class="content table-responsive">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			
			<a href="<?php echo site_url('/pengguna/tambah'); ?>"><button class="btn btn-default">Tambah Pengguna</button></a>
			<br><br>
			<table class="table datatables table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pengguna</th>
						<th>Username</th>
						<th>Email</th>
						<th>No HP</th>
						<th>Alamat</th>
                        <th>Asal Instansi</th>
                        <th>Alamat Instansi</th>
                        <th>Level</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0; ?>
					<?php 
					foreach ($data->result() as $row): 
						// echo '<pre>';
						// print_r($row);
						// echo '</pre>';
						$no++;
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $row->nama_lengkap; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->telepon; ?></td>
                        <td><?php echo $row->alamat; ?></td>
                        <td><?php echo $row->instansi; ?></td>
                        <td><?php echo $row->alamat_instansi; ?></td>
                        <td><?php echo $row->level; ?></td>
						<td>
							<a href="<?php echo site_url('/pengguna/ubah/'.$row->id_pengguna); ?>">Edit</a>
							<?php if ($row->id_pengguna > 1): ?>
							- <a href="<?php echo site_url('/pengguna/hapus/'.$row->id_pengguna); ?>">Delete</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
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