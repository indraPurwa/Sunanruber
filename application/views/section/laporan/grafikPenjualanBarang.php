<div class="col-sm-10">
	<div class="card">
		<div class="content">
			<?php if ($this->session->flashdata('save_message')): ?>
			<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
			<?php endif; ?>
			<legend>Grafik Jumlah Pemesanan Barang Pertahun</legend>
			<?=form_open('', 'target="_self"');?>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Pilih tahun</label>
							<select name="tahun" class="form-control">
                                <?php
                                foreach ($tahuns as $key => $value) {
                                    echo '<option value="'.$value['tahun'].'">'.$value['tahun'].'</option>';
                                }
                                ?>
                            </select>
						</div>
					</div>
				</div>
                <div class="text-left">
					<button type="submit" name="aksi" value="tampil" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px">Lihat</button>
					<a href="<?=site_url('dashboard')?>" class="btn btn-warning btn-fill btn-wd" style="margin-bottom:10px">Kembali</a>
				</div>
            </form>
        </div>
    </div>
</div>
<?php
if ($this->input->post('aksi')=='tampil') {
    ?>
    <div class="col-sm-12">
	<div class="card">
        <div class="content">
            <h4 style="margin:0; padding:0;">Grafik Jumlah Pemesanan Barang Tahun <?=$tahun?></h4>
            <div id="chartActivity" class="ct-chart"></div>
            <div class="footer">
                <div class="chart-legend">
                    <?php
                    foreach ($barangs as $key => $value) {
                        echo '<i class="fa fa-circle" style="color:'.getColor($key).'"></i> '.$value['nama'];
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
        </div>
	<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>
    
    <script>
        type = ['','info','success','warning','danger'];
        demo = {
            initChartist: function(){
                var data = {
                labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                series: [
                    <?php
                    foreach ($barangs as $key => $value) {
                        echo '[';
                        for ($i=1; $i <=12 ; $i++) { 
                            $data=$this->db->query('select sum(pd.jumlah ) as jumlah from pesanan_detail pd 
                                join pesanan ps 
                                    on ps.id_pesanan =pd.id_pesanan 
                                where year(ps.time_created )=? 
                                    and month (ps.time_created )=?
                                    and pd.id_barang =?',[$tahun,$i,$value['id_barang']])->row();
                                    echo ($data->jumlah==''?0:$data->jumlah).',';
                            
                        }
                        echo '],';
                    }
                    ?>
                    ]
                };

                // var options = {
                //     seriesBarDistance: 10,
                //     axisX: {
                //         showGrid: false
                //     },
                //     height: "245px"
                // };

                // var responsiveOptions = [
                //     ['screen and (max-width: 640px)', {
                //         seriesBarDistance: 5,
                //         axisX: {
                //         labelInterpolationFnc: function (value) {
                //             return value[0];
                //         }
                //         }
                //     }]
                // ];

                Chartist.Line('#chartActivity', data);
            },
        }
        $(document).ready(function(){
        	demo.initChartist();
    	});
    </script>
    <?php
}
?>