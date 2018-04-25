<!DOCTYPE html>
<html lang="en" class="fixed"> 
 
<head>

<!-- Basic -->
<meta charset="utf-8"/>

<title><?php echo $title?></title>  
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="Report Project Dashboard" name="description"/>
<meta content="PT. Sarana Yukti Bandhana" name="author"/>  

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.css')?>" /> 

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme.css')?>" />

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/skins/default.css')?>" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme-custom.css')?>">

<!-- Head Libs -->
<script src="<?php echo base_url('assets/vendor/modernizr/modernizr.js')?>"></script>

<?php echo $script_captcha; // javascript recaptcha ?>

</head>

<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="<?php echo base_url('assets/images/logo.png')?>" height="54" alt="Logo" />
				</a>
				<label class="logo pull-left">
					<div class="col-md-12"><h3>Report Project Dashboard</h3></div>
				</label>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Log In</h2>
					</div>
					<div class="panel-body">
                    <!-- NOTIF -->
            <?php
            $message = $this->session->flashdata('notif');
            if($message){
                echo '<p class="alert alert-danger text-center">'.$message .'</p>';
            }?>
    					
						<?php echo form_open('login/cek_login','class="form-horizontal"'); ?> 
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" autofocus  required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label> 
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg"> 
								<div class="input-group input-group-icon">
             					   <?php echo $captcha // tampilkan recaptcha ?>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Log In</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. PT. Sarana Yukti Bandhana. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url('assets/vendor/jquery/jquery.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.js')?>"></script>  
		<script src="<?php echo base_url('assets/vendor/jquery-placeholder/jquery.placeholder.js')?>"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url('assets/javascripts/theme.js')?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url('assets/javascripts/theme.custom.js')?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url('assets/javascripts/theme.init.js')?>"></script>

	</body>
</html>
