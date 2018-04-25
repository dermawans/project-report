<!DOCTYPE html>
<html lang="en" class="fixed"> 
 
<head>
<!-- Basic -->
<meta charset="utf-8"/>

<title><?php echo $title?></title>  
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="Project Report SYB" name="description"/>
<meta content="PT Sarana Yukti Bandhana" name="author"/>  

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
  
<script src="<?php echo base_url('assets/vendor/chartjs/Chart.bundle.js')?>"></script>
<script src="<?php echo base_url('assets/utils.js')?>"></script>

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />

<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/magnific-popup/magnific-popup.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-datepicker/css/datepicker3.css')?>" /> 

<link rel="stylesheet" href="<?php echo base_url('assets/chosen.css')?>">
<script src="<?php echo base_url('assets/jquery.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/chosen.jquery.js');?>"></script>
 
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/select2.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/dropzone/css/basic.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/dropzone/css/dropzone.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/summernote/summernote.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/summernote/summernote-bs3.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/codemirror/lib/codemirror.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/codemirror/theme/monokai.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')?>" />
		
   
<!-- Grafik CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/morris/morris.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/chartist/chartist.css')?>" />

<link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/pnotify/pnotify.custom.css')?>" /> 

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme.css')?>" />

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/skins/default.css')?>" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme-custom.css')?>">
 
<!-- Head Libs -->
<script src="<?php echo base_url('assets/vendor/modernizr/modernizr.js')?>"></script> 

<style> 
#users-countries-bar-chart {
	height: 360px; 
	margin-top: 2rem;
	width: 100%;
}
</style>
   
<script type="text/javascript">
        $(function(){
            $('.chzn-select').chosen();
            $('.chzn-select-deselect').chosen({allow_single_deselect:true});
        });
</script>
    
<script type="text/javascript">
		$(function () { 
					new PNotify({
						title: 'Update Info',
						text: '<?php foreach($data_master_info as $row){ ?><p><?php echo $row->isi_info; ?></p><?php } ?>',
						addclass: 'notification-success',
						icon: 'fa fa-info' 
				}); 
		}); 
</script> 

<?php
	if ($this->session->userdata('ROLEID') == '1') {  
?>
<script type="text/javascript">
		$(function () { 
					new PNotify({
						title: 'Hai QT',
						text: 'Kamu memiliki <?php echo $jumlah_project_aktif_qt;?> project aktif <br> <?php echo $jumlah_new_project_qt;?> project baru <br> dan <?php echo $jumlah_project_expired_qt;?> project expired',
						addclass: 'notification-primary',
						icon: 'fa fa-inbox' 
				}); 
		}); 
</script>  
<?php } 
	if ($this->session->userdata('ROLEID') == '2') { 
?>
<script type="text/javascript">
		$(function () { 
					new PNotify({
						title: 'Hai QT Koordinator',
						text: 'Ada <?php echo $jumlah_new_project;?> project baru dari PMO  <br> Ada <?php echo $jumlah_all_project_aktif;?> project yang sedang aktif <br> Ada <?php echo $jumlah_all_project_expired;?> project expired',
						addclass: 'notification-primary',
						icon: 'fa fa-inbox' 
				}); 
		}); 
</script> 
<?php }
	if ($this->session->userdata('ROLEID') == '3') {  
?>
<script type="text/javascript">
		$(function () { 
					new PNotify({
						title: 'Hai PMO',
						text: 'Kamu memiliki <?php echo $jumlah_project_aktif_pmo;?> project aktif  <br> <?php echo $jumlah_new_project_pmo;?> project baru <br> <?php echo $jumlah_project_expired_pmo;?> project expired',
						addclass: 'notification-primary',
						icon: 'fa fa-inbox' 
				}); 
		}); 
</script>  
<?php } 
if ($this->session->userdata('ROLEID') == '4') { 
?>
<script type="text/javascript">
		$(function () { 
					new PNotify({
						title: 'Hai PMO Koordinator',
						text: 'Ada <?php echo $jumlah_new_project_pmo_kordinator; ?> project baru <br> Ada <?php echo $jumlah_all_project_aktif;?> project yang sedang aktif <br> Ada <?php echo $jumlah_all_project_expired;?> project expired',
						addclass: 'notification-primary',
						icon: 'fa fa-inbox' 
				}); 
		}); 
</script> 
<?php } ?>
<style>
canvas {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
</style>

</head>

<body  class="loading-overlay-showing" data-loading-overlay>
		<div class="loading-overlay dark">
			<div class="loader white"></div>
		</div>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="<?php echo base_url('assets/images/logo.png')?>" height="35" alt="Logo" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			 
             		<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url('assets/images/!logged-user.jpg')?>" alt="Foto" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
							</figure>
							<div class="profile-info">
								<span class="name"><?php echo $this->session->userdata('USERNAME'); ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li> 
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo site_url('login/logout')?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
					
                    <!--========================= Header + Navbar ==============================--> 
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-<?php if(isset($active_dashboard)){echo $active_dashboard ;}?>">
										<a href="<?php echo site_url('dashboard')?>">
											<i class="fa fa-dashboard" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li> 
									<li class="nav-<?php if(isset($active_project)){echo $active_project ;}?>">
										<a href="<?php echo site_url('project')?>">
										<?php
											if ($this->session->userdata('ROLEID') == '1') {  
										?>
											<span class="pull-right label label-primary"><?php echo $jumlah_allproject_qt; ?></span>
										<?php } ?>
										<?php
											if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '4') {  
										?>
											<span class="pull-right label label-primary"><?php echo $jumlah_allproject_kordinator; ?></span>
										<?php } ?>
										<?php
											if ($this->session->userdata('ROLEID') == '3') {  
										?>
											<span class="pull-right label label-primary"><?php echo $jumlah_allproject_pmo; ?></span>
										<?php } ?>
											<i class="fa fa-dashcube" aria-hidden="true"></i>
											<span>Project</span>
										</a>
									</li> 
									<?php
										if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1' or $this->session->userdata('ROLEID') == '4'  or $this->session->userdata('ROLEID') == '6') {  
									?>
									<li class="nav-<?php if(isset($active_icl)){echo $active_icl ;}?>">
										<a href="<?php echo site_url('icl')?>"> 
											<i class="fa fa-dashcube" aria-hidden="true"></i>
											<span>ICL</span>
										</a>
									</li>
									<?php } ?>
									<!--
									<li class="nav-<?php if(isset($active_report)){echo $active_report ;}?>">
										<a href="<?php echo site_url('report')?>">
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>Report</span>
										</a>
									</li>
									<li class="nav-<?php if(isset($active_settings)){echo $active_settings ;}?>">
										<a href="<?php echo site_url('settings')?>">
											<i class="fa fa-gear" aria-hidden="true"></i>
											<span>Settings</span>
										</a>
									</li>
									-->
									<li class="nav-<?php if(isset($active_users)){echo $active_users ;}?>">
										<a href="<?php echo site_url('users')?>">
											<span class="pull-right label label-primary"></span>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Users</span>
										</a> 
									</li> 
									<?php if ($this->session->userdata('ROLEID') == '5'){ ?>
									<li class="nav">
										<a href="<?php echo site_url('log')?>">
											<span class="pull-right label label-primary"></span>
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>Log</span>
										</a> 
									</li> 
									<?php } ?>
								</ul>
							</nav>
						</div>
					</div> 
                    
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">  
					</header>

				

