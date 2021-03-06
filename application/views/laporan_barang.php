<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <style>
        #table-info tr th{
            text-align: left;
        }
    </style>
</head>
<?php
$this->lang->load('barang', $this->session->userdata('language'));
?>
<body onload="window.print();">
    <table>
        <tr>
            <td>
                <img src="<?php echo base_url(); ?>assets/img/psr.png" width="30px">
            </td>
            <td>PT.SUNAN RUBER</td>
        </tr>
    </table>
	<center><h4 style="margin:0; padding:0;"><?= $this->lang->line('laporan_barang')?></h4></center>
    <table id="table-info">
        <tr>
            <th><?= $this->lang->line('tanggal_cetak')?></th>
            <td>:</td>
            <td><?=date('d-m-Y')?></td>
        </tr>
    </table>
    <table class="table_print" border="1" style="width:100%;" cellpadding="0" cellspacing="0">
	<thead>
		<!-- <tr>
			<th>No.</th>
			<th>ID Barang.</th>
			<th>Nama Barang.</th>
			<th>Jenis Karet.</th>
			<th>Jumlah.</th>
			<th>Jenis Packing.</th>
			<th>Stuff Date</th>
			<th>Rencana Stuff</th>
			<tH>Stok</th>
		</tr> -->
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
		</tr>
		<?php $no++; endforeach; ?>
	</tbody>
</table>
</body>
</html>