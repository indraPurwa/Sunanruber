<div class="col-md-12">
	<div class="card">
		<div class="content table-responsive">
        <!--
			<a href="<?php echo site_url('/pelanggan/tambah'); ?>"><button class="btn btn-default">Tambah Data Anggota</button></a>
            -->
			<br><br>
			<table class="table datatables table-striped">
				<thead>
					<tr>
						<th>No. Pelanggan</th>
                        <th>No KTP</th>
						<th>Nama</th>
                        <th>Alamat</th>
						<th>Telepon</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($data->result() as $row): ?>
					<tr>
						<td><?php echo $row->id_pelanggan; ?></td>
                        <td><?php echo $row->no_ktp; ?></td>
						<td><?php echo $row->nama_pelanggan; ?></td>
						<td><?php echo $row->alamat; ?></td>
						<td><?php echo $row->telepon; ?></td>
						<td>
                        <!--
							<a href="<?php echo site_url('/pelanggan/ubah/'.$row->id_pelanggan); ?>">Edit</a> -
                            -->
							<a href="<?php echo site_url('/pelanggan/hapus/'.$row->id_pelanggan); ?>">Delete</a> 
                            <!--
                            -
                            <a href="<?php echo site_url('/pelanggan/verifikasi/'.$row->id_pelanggan); ?>">Verifikasi</a>
                            -->
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
		'order': [[0, 'desc']]
	});
});
</script>