<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>PT. Sunan Ruber</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'> -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet">
	
	<!--  Datatables    -->
    <link href="<?php echo base_url(); ?>assets/datatables/datatables.min.css" rel="stylesheet"/>
	
	<!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	
	<script>$().ready(function() { $('[type=text], [type=password]').attr('autocomplete', 'off'); });</script>
	
</head>
<body>

<?php
$this->lang->load('menu', $this->session->userdata('language'));

//TODO print data session
// echo '<pre>'; print_r($this->session->userdata()); echo '</pre>';
// echo $this->session->userdata('pengguna')->level;
?>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">

            <div class="logo">
                    <p align="center"><img src="<?php echo base_url(); ?>assets/img/psr.png" width="100">
                <a href="<?php echo site_url('/dashboard'); ?>" class="simple-text">
                    PT.Sunan Ruber
                </a>
				<div style="font-size:12px;text-align:center">
					<a href="<?php echo site_url('/tentang'); ?>">
                    <?= $this->lang->line('tentang') ?> PT.Sunan Ruber
					</a>
				</div>
            </div>

            <ul class="nav">
                <?php
                // TODO USER ADMIN
                if ($this->session->userdata('pengguna')->level=='Admin') {
                ?>
                    <li class="<?php if ($this->uri->segment(1) == 'barang') echo 'active'; ?>">
                        <a href="<?php echo site_url('/barang'); ?>">
                            <i class="ti-briefcase"></i>
                            <p><?= $this->lang->line('barang') ?></p>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(1) == 'pemesanan') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pemesanan'); ?>">
                            <i class="ti-truck"></i>
                            <p><?= $this->lang->line('pemesanan') ?></p>
                        </a>
                    </li>
                    <!-- <li class="<?php if ($this->uri->segment(1) == 'pengiriman') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pengiriman'); ?>">
                            <i class="ti-truck"></i>
                            <p>Pengiriman</p>
                        </a>
                    </li> -->
                    <li class="<?php if ($this->uri->segment(1) == 'pengguna') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pengguna'); ?>">
                            <i class="ti-user"></i>
                            <p><?= $this->lang->line('pengguna') ?></p>
                        </a>
                    </li>
                <?php
                }
                
                // TODO USER Pelanggan
                elseif($this->session->userdata('pengguna')->level=='Pelanggan') {
                ?>
                    <li class="<?php if ($this->uri->segment(1) == 'pemesanan') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pemesanan'); ?>">
                            <i class="ti-truck"></i>
                            <p><?= $this->lang->line('pemesanan') ?></p>
                        </a>
                    </li>
                <?php
                }
                
                // TODO USER Pimpinan
                elseif ($this->session->userdata('pengguna')->level=='Pimpinan') {
                ?>
                    <li class="<?php if ($this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'barang') echo 'active'; ?>">
                        <a target="_blank" href="<?php echo site_url('laporan/barang'); ?>">
                            <i class="ti-files"></i>
                            <p><?= $this->lang->line('laporan_barang') ?></p>
                            
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'pesanan') echo 'active'; ?>">
                        <a href="<?php echo site_url('laporan/pesanan'); ?>">
                            <i class="ti-files"></i>
                            <p><?= $this->lang->line('laporan_pesanan') ?></p>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'grafikPenjualanBarang') echo 'active'; ?>">
                        <a href="<?php echo site_url('laporan/grafikPenjualanBarang'); ?>">
                            <i class="ti-files"></i>
                            <p><?= $this->lang->line('grafik_pemesanan') ?></p>
                        </a>
                    </li>
                <?php
                }
                
                // TODO USER Gudang
                elseif ($this->session->userdata('pengguna')->level=='Gudang') {
                ?>
                    <!-- <li class="<?php if ($this->uri->segment(1) == 'pengiriman') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pengiriman'); ?>">
                            <i class="ti-truck"></i>
                            <p>Pengiriman</p>
                        </a>
                    </li> -->
                    <li class="<?php if ($this->uri->segment(1) == 'pemesanan') echo 'active'; ?>">
                        <a href="<?php echo site_url('/pemesanan'); ?>">
                            <i class="ti-truck"></i>
                            <p><?= $this->lang->line('pemesanan') ?></p>
                        </a>
                    </li>
                <?php
                }
                ?>

				<li>
                    <a href="<?php echo site_url('/Auth/logout'); ?>">
                        <i class="ti-power-off"></i>
                        <p><?= $this->lang->line('keluar') ?></p>
                        
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $header; ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="ti-user"></i>
								<p><?php echo $this->session->userdata('pengguna')->nama_lengkap; ?></p>
                                <span>(Login As <?= $this->session->userdata('pengguna')->level;?>)</span>
								<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('/Auth/profil'); ?>"><?= $this->lang->line('profil_pengguna') ?></a></li>
                                <li><a href="<?php echo site_url('/Auth/password'); ?>"><?= $this->lang->line('ubah_password') ?></a></li>
                                <li><a href="<?php echo site_url('/Auth/logout'); ?>"><?= $this->lang->line('keluar') ?></a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-language"></i>
                                <span><?= $this->session->userdata('language');?></span>
								<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('/Auth/language/english'); ?>">English</a></li>
                                <li><a href="<?php echo site_url('/Auth/language/indonesia'); ?>">Indonesia</a></li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <?php if (isset($content)) $this->load->view($content); ?>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> &middot; Template made with by <a href="">Honda Maju Mobilindo</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="<?php echo base_url(); ?>assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/demo.js"></script> -->
	
	<!-- Datatables -->
	<script src="<?php echo base_url(); ?>assets/datatables/datatables.min.js"></script>
	
	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();
			
			<?php if ($this->session->flashdata('login_status') == 'ok'): ?>
        	$.notify({
            	icon: 'ti-face-smile',
            	message: "Selamat datang di <b>PT. Sunan ruber</b> - Sistem Informasi Distribusi."

            },{
                type: 'success',
                timer: 300
            });
			<?php endif; ?>

    	});
	</!--> -->

</html>
