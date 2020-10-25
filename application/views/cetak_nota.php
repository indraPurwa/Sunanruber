<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pesanan</title>
    <style>
        #table-info tr th{
            text-align: left;
        }
    </style>
</head>
<?php
$this->lang->load('pemesanan', $this->session->userdata('language'));

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
    <?php
                $pesanan  =$this->db->query('select * from pesanan
                    join pembayaran
                        on pesanan.id_pesanan=pembayaran.id_pesanan
                    join pengguna
                        on pengguna.id_pengguna=pesanan.id_pengguna
                    where pesanan.id_pesanan='.$id)->row();
                    // print_r($pesanan);

    ?>
	<center><h4 style="margin:0; padding:0;"><?= $this->lang->line('header_nota') ?></h4></center>

    <table id="table-info" style="width:100%;" >
        <tr>
            <th><?= $this->lang->line('col_no') ?></th>
            <td>:</td>
            <td><?=create_orderid($pesanan->time_created, $pesanan->id_pesanan)?></td>
            <td style="min-width:10%"></td>
            <th><?= $this->lang->line('col_alamat') ?></th>
            <td>:</td>
            <td><?=$pesanan->alamat_kirim?></td>
        </tr>
        <tr>
            <th><?= $this->lang->line('tgl_pesan') ?></th>
            <td>:</td>
            <td><?=date('d-m-Y H:i:s', strtotime($pesanan->time_created))?></td>
            <td></td>
            <th><?= $this->lang->line('tgl_bayar') ?></th>
            <td>:</td>
            <td><?=date('d-m-Y', strtotime($pesanan->tanggal))?></td>
        </tr>
        <tr>
            <th><?= $this->lang->line('pemesan') ?></th>
            <td>:</td>
            <td><?=$pesanan->nama_lengkap?></td>
            <td></td>
            <th>Status</th>
            <td>:</td>
            <td><?=$pesanan->status?></td>
        </tr>
    </table>
   
    <table class="table_print" border="1" style="width:100%;" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th><?= $this->lang->line('col_nama_barang') ?></th>
                <th><?= $this->lang->line('harga') ?></th>
                <th><?= $this->lang->line('jumlah') ?></th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $src = $this->db
                ->query('
                    select a.*, b.nama from pesanan_detail as a
                    join barang as b
                        on a.id_barang = b.id_barang
                    where a.id_pesanan = '.$id.'
                ')
                ->result_array();
            // echo '<pre>';
            // print_r($src);
            // echo '</pre>';
            $total=0;
            foreach ($src as $key => $value) {
                echo '<tr>
                    <th>'.($key+1).'</th>
                    <td>'.$value['nama'].'</td>
                    <td style="text-align:right;">'.number_format($value['harga']).'</td>
                    <td style="text-align:center;">'.number_format($value['jumlah']).'</td>
                    <td style="text-align:right;">'.number_format($value['subTotal']).'</td>
                </tr>';
                $total+=$value['subTotal'];
            }
            ?>
            <tr>
                <th colspan="4" style="text-align:right;">Total</th>
                <th style="text-align:right;"><?=number_format($total)?></th>
            </tr>
        </tbody>
        
    </table>
</body>
</html>