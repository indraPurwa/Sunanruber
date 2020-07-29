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
<body onload="window.print();">
    <table>
        <tr>
            <td>
                <img src="<?php echo base_url(); ?>assets/img/psr.png" width="30px">
            </td>
            <td>PT.SUNAN RUBER</td>
        </tr>
    </table>
	<center><h4 style="margin:0; padding:0;">LAPORAN PEMESANAN</h4></center>
    <table id="table-info">
        <tr>
            <th>Periode Tanggal</th>
            <td>:</td>
            <td><?=date('d-m-Y', strtotime($tgl_awal) ).' s/d '.date('d-m-Y', strtotime($tgl_akhir) )?></td>
        </tr>
    </table>
    <table class="table_print" border="1" style="width:100%;" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Waktu Pesan</th>
                <th>Pemesan</th>
                <th>Alamat Kirim</th>
                <th>Total</th>
                <th>Status</th>
                <?php
                    echo '<th>Tgl Bayar</th>';
                    echo '<th>Tgl Kirim</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=0;
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            foreach ($data as $key => $value) {
                $no++;
                $captionOrderID = str_pad($value['id_pesanan'], 4, '0', STR_PAD_LEFT);
                echo '<tr>
                        <td>'.($no).'</td>
                        <td>'.date('Ymd',strtotime($value['time_created'])).$captionOrderID.'</td>
                        <td>'.date('d-m-Y H:i:s',strtotime($value['time_created'])).'</td>
                        <td>'.$value['nama_lengkap'].'</td>
                        <td>'.$value['alamat_kirim'].'</td>
                        <td>'.rupiah($value['total']).'</td>
                        <td>'.$value['status'].'</td>';

                        echo '<td>'.($value['tanggal']==''? '':date('d-m-Y',strtotime($value['tanggal'])) ).'</td>';
                        echo '<td>'.($value['tgl_kirim']==''? '':date('d-m-Y',strtotime($value['tgl_kirim'])) ).'</td>';
                       
                        echo '
                    </tr>';
            }
            ?>
            
        </tbody>
    </table>
</body>
</html>