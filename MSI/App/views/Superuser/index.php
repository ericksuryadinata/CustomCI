<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <title>Dashboard</title>
        <?php $this->load->view('Partials/Head')?>
        <?php $this->load->view('Partials/Foot')?>
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">  
      		<header class="main-header">
      			<a href="#" class="logo">
		          <!-- mini logo for sidebar mini 50x50 pixels -->
		          <span class="logo-mini"><b>S</b>IA</span>
		          <!-- logo for regular state and mobile devices -->
		          <span class="logo-lg"><b>Sistem Informasi Praktikum</b></span>
		        </a>
		        <nav class="navbar navbar-static-top" role="navigation">
		          <!-- Sidebar toggle button-->
		          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		            <span class="sr-only">Toggle navigation</span>

		          </a>
		          <!--
		          <div class="navbar-custom-menu">
		          	<ul class="nav navbar-nav"> -->
		          		
		          		<!-- User Account: style can be found in dropdown.less -->
		              	<!--
		              	<li class="dropdown user user-menu">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			                  <img src="assets/dist/img/avatar5.png" class="user-image">
			                  <span class="hidden-xs">Admin </span>
			                </a>

			                <ul class="dropdown-menu"> -->
			                	<!-- User image -->
			                	<!--
								<li class="user-header">
			                    	<img src="assets/dist/img/avatar5.png">
			                    	<p><small></small></p>
			                  	</li> -->
			                  	<!-- Menu Body -->
			                  	<!-- Menu Footer-->
			                  	<!--
			                  	<li class="user-footer">
			                    	<div class="pull-left">
			                        	<a href="profil.php">Profile</a>
			                        </div>
			                        <div class="pull-right">
			                            <a href="logout.php">Sign out</a>
			                        </div>
			                    </li>
			                </ul>
		              	</li>
		            </ul>
		          </div> -->
		        </nav>
		    </header>
		    <aside class="main-sidebar">
		        <div clas="user-panel">
		        	
		        </div>
		        <section class="sidebar" style="height:auto;">
		         	<ul class="sidebar-menu">
		         	    <li class="header">MAIN NAVIGATION</li>
		         	    	<li class="">
	                            <a href="<?php echo site_url('Utama');?>">
	                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
	                            </a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/hadir');?>">
	                        		<i class="fa fa-book"></i> <span>Daftar Hadir</span>
	                        	</a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/anggota');?>">
	                        		<i class="fa fa-book"></i> <span>Data Anggota</span>
	                        	</a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/divisi');?>">
	                        		<i class="fa fa-book"></i> <span>Data Divisi</span>
	                        	</a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/kelas');?>">
	                        		<i class="fa fa-book"></i> <span>Data Kelas</span>
	                        	</a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/tahun_ajar');?>">
	                        		<i class="fa fa-book"></i> <span>Tahun Ajaran</span>
	                        	</a>
	                        </li>
	                        <li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/data_admin');?>">
	                        		<i class="fa fa-book"></i> <span>Data Administrator</span>
	                        	</a>
	                        </li>
							<li class="icn_view_users">
	                        	<a href="<?php echo site_url('Utama/data_backup');?>">
	                        		<i class="fa fa-book"></i> <span>Backup Database</span>
	                        	</a>
	                        </li>
							<li class="header"><a href="<?php echo site_url('Superuser/Dashboard/logout');?>">Logout</a></li>
		         	</ul>
		        </section> 
		    </aside>
		    <!-- Dashboard-->
	</body>
</html>
			
    