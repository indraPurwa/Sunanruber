<div class="row">
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-warning text-center">
							<i class="ti-id-badge"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Anggota</p>
							<?php //echo $jumlah_anggota; ?>
						</div>
					</div>
				</div>
				<div class="footer">
					<hr />
					<div class="stats">
						<i class="ti-reload"></i> Data Terkini
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-success text-center">
							<i class="ti-truck"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Pemesanan</p>
							<?php //echo rupiah((int) ($total_simpanan / 1000000)); ?>+
						</div>
					</div>
				</div>
				<div class="footer">
					<hr />
					<div class="stats">
						<i class="ti-money"></i> Dalam Angka
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
            
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-info text-center">
							<i class="ti-truck"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Pengiriman</p>
							<?php //echo rupiah((int) ($total_pinjaman / 1000000)); ?>+
						</div>
					</div>
				</div>
				<div class="footer">
					<hr />
					<div class="stats">
						<i class="ti-money"></i> Dalam Angka
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-danger text-center">
							<i class="ti-user"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>User</p>
							<?php //echo rupiah((int) ($total_piutang / 1000000)); ?>+
						</div>
					</div>
				</div>
				<div class="footer">
					<hr />
					<div class="stats">
						<i class="ti-money"></i> Dalam Angka
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="header">
				<h4 class="title">Komposisi </h4>
			</div>
			<div class="content">
				<div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

				<div class="footer">
					<div class="chart-legend">
						<i class="fa fa-circle text-info"></i> Pemesanan. 
						<i class="fa fa-circle text-warning"></i> Pengiriman. 
						<i class="fa fa-circle text-danger"></i> . 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card ">
			<div class="header">
				<h4 class="title">Pertumbuhan Pelanggan <?php echo date('Y'); ?></h4>
			</div>
			<div class="content">
				<div id="chartActivity" class="ct-chart"></div>

				<div class="footer">
					<div class="chart-legend">
						<i class="fa fa-circle text-info"></i> Jumlah Pelanggan
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
type = ['','info','success','warning','danger'];


demo = {
    initChartist: function(){

        var dataSales = {
          labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
          series: [
             [287, 385, 490, 562, 594, 626, 698, 895, 952],
            [67, 152, 193, 240, 387, 435, 535, 642, 744],
            [23, 113, 67, 108, 190, 239, 307, 410, 410]
          ]
        };

        var optionsSales = {
          lineSmooth: false,
          low: 0,
          high: 1000,
          showArea: true,
          height: "245px",
          axisX: {
            showGrid: false,
          },
          lineSmooth: Chartist.Interpolation.simple({
            divisor: 3
          }),
          showLine: true,
          showPoint: false,
        };

        var responsiveSales = [
          ['screen and (max-width: 640px)', {
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);

		
		<?php
		
		$growth = array();
		for ($i = 1; $i <= 12; $i++) {
			$field = 'bulan_'.$i;
			$growth[] = $growth_anggota->$field;
		}
		
		$growth_list = implode(', ', $growth);
		
		?>
		
        var data = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
          series: [
            [<?php echo $growth_list; ?>]
          ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Line('#chartActivity', data, options, responsiveOptions);

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);
		
		<?php
		
		$donut = array('pokok' => 0, 'wajib' => 0, 'sukarela' => 0);
		foreach ($dist_simpanan->result() as $row) {
			$donut[$row->jenis_simpanan] = $row->jumlah_simpanan;
		}
		
		?>
		
        Chartist.Pie('#chartPreferences', {
          labels: ['<?php echo rupiah($donut['pokok']); ?>', '<?php echo rupiah($donut['wajib']); ?>', '<?php echo rupiah($donut['sukarela']); ?>'],
          series: [<?php echo $donut['pokok']; ?>, <?php echo $donut['wajib']; ?>, <?php echo $donut['sukarela']; ?>]
        });
    },

}
</script>