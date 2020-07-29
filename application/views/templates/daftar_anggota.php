<!DOCTYPE html>
<html lang="en">
<head>
	<title>PT. Sunan Ruber</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<?php if ($this->session->flashdata('save_message')): ?>
				<div class="alert alert-warning"><?php echo $this->session->flashdata('save_message'); ?></div>
				<?php endif; ?>
				
				<?=form_open('', 'class="login100-form validate-form flex-sb flex-w"');?>
             
					<span class="login100-form-title p-b-51">
						Daftar Sebagai Pelanggan
					</span>

					
					<?php if ($this->session->flashdata('login_status') == 'err'): ?>
					<div class="alert alert-danger" style="padding:20px;text-align:center;width:100%">
						Login gagal: Username atau Password salah!
					</div>
					<?php endif; ?>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username tidak boleh kosong!">
						<input class="input100" type="email" name="email" placeholder="Email" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
                    
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Nama tidak boleh kosong!">
						<input class="input100" type="text" name="nama_lengkap" placeholder="Nama" autocomplete="off">
						<span class="focus-input100"></span>
					</div>                    
			
                    
					<div class="wrap-input100 validate-input m-b-16" data-validate = "No HP tidak boleh kosong!">
						<input class="input100" type="text" name="telepon" placeholder="No HP" autocomplete="off">
						<span class="focus-input100"></span>
					</div>     
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Alamat tidak boleh kosong!">
						<input class="input100" type="text" name="alamat" placeholder="Alamat" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
                    
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Instansi tidak boleh kosong!">
						<input class="input100" type="text" name="instansi" placeholder="Asal Instansi" autocomplete="off">
						<span class="focus-input100"></span>
					</div>             
                    
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Alamat Instansi tidak boleh kosong!">
						<input class="input100" type="text" name="alamat_instansi" placeholder="Alamat Instansi" autocomplete="off">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Alamat Instansi tidak boleh kosong!">
						<input class="input100" type="password" name="password" placeholder="Password" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Alamat Instansi tidak boleh kosong!">
						<input class="input100" type="password" name="re_password" placeholder="Ulangi password" autocomplete="off">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button name="save" value="1" class="login100-form-btn">
							Daftar
						</button>
					</div>
                    <div class="container-login100-form-btn m-t-17">
						<a href="<?php echo site_url('/auth/login'); ?>" class="login100-form-btn">
							Batal
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>

</body>
</html>