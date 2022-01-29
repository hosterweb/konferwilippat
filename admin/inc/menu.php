    <?php 
session_start();
$username=$_SESSION['username'];
$nama=$_SESSION['nama'];
$level=$_SESSION['level'];
if(empty($username)){
echo '<script language="javascript">alert("Maaf Anda Harus Login Dahulu")</script>';
echo '<script language="javascript">window.location = "?page=login"</script>';
	
	}
?>
<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
   <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text"><?php echo $username;?></h5>
     </a>
	 </div>
	 <ul class="sidebar-menu do-nicescrol">
     <li>
          <li><a href="?page=home"><i class="zmdi zmdi-home"></i><span>Halaman Utama</span></li></a>

<?php 
				$x1=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='data_pengda'");
				$v1=mysqli_fetch_array($x1);
				$permision1=$v1['r'];
				if($permision1=="y"){ ?>				
                <li>
					<a href="?page=peserta" class="waves-effect"><i class="zmdi zmdi-plus-square"></i> </i><span class="title">Data Pengda</span></a>
					
				</li>
                <?php }?>          
<?php 
				$x1=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='input_peserta_pensiun'");
				$v1=mysqli_fetch_array($x1);
				$permision1=$v1['r'];
				if($permision1=="y"){ ?>				
                <li>
					<a href="?page=input_peserta" class="waves-effect"><i class="icon-user"></i><span class="title">input Peserta Pensiun</span>
					</a>
					
				</li>
                <?php }?>  
<?php 
				$x2=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='data_pendaftaran'");
				$v2=mysqli_fetch_array($x2);
				$permision2=$v2['r'];
				if($permision2=="y"){ ?>				
                <li>
					<a href="?page=data_peserta" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span>Data Pendaftaran</span></a>
					
				</li>
                <?php }?>  
                				
                <li>
					<a href="?page=peserta_expired" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span>Data Peserta Expired</span></a>
					
				</li>
<?php 
				$x3=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='konfirmasi_peserta'");
				$v3=mysqli_fetch_array($x3);
				$permision3=$v3['r'];
				if($permision3=="y"){ ?>				
                <li>
					<a href="?page=konfirmasi_peserta"class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span class="title">Data Pembayaran</span></a>
					
				</li>
                <?php }?>

<?php 
				$x5=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='laporan_pembayaran'");
				$v5=mysqli_fetch_array($x5);
				$permision5=$v5['r'];
				if($permision5=="y"){ ?>				
                <li>
					<a href="?page=laporan_pembayaran"class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span class="title">Laporan Pembayaran</span></a>
					
				</li>
                <?php }?>
                
<?php 
				$x11=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='backup_pembayaran'");
				$v11=mysqli_fetch_array($x11);
				$permision11=$v11['r'];
				if($permision11=="y"){ ?>				
               <li>
					<a href="?page=backup_pembayaran"class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span class="title">Export Pembayaran</span></a>
					
				</li>
                <?php }?>
                
<?php 
				$x4=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='absensi'");
				$v4=mysqli_fetch_array($x4);
				$permision4=$v4['r'];
				if($permision4=="y"){ ?>				
               <li>
					<a href="?page=absensi" target="_blank" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span class="title">Absensi 1</span></a>
					
				</li>
				 <li>
					<a href="?page=absensi2" target="_blank" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span class="title">Absensi 2</span></a>
					
				</li>
                <?php }?>


<?php 
				$x6=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='lap_absensi1'");
				$v6=mysqli_fetch_array($x6);
				$permision6=$v6['r'];
				if($permision6=="y"){ ?>				
                <li>
					<a href="?page=export_absen_meja">
					<i class="zmdi zmdi-print"></i><span>Absensi Daftar Ulang</span>
					</a>
					
				</li>
                <li>
					<a href="?page=export_absen_sesi1">
					<i class="zmdi zmdi-print"></i><span>Laporan Absensi 1</span>
					</a>
					
				</li>
                <?php }?> 

<?php 
				$x7=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='lap_absensi2'");
				$v7=mysqli_fetch_array($x7);
				$permision7=$v7['r'];
				if($permision7=="y"){ ?>				
                <li>
					<a href="?page=export_absen_sesi2">
					<i class="zmdi zmdi-print"></i><span>Laporan Absensi 2</span>
					</a>
					
				</li>
                <?php }?>  

 
                
                <?php 
				$x100=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='permisi'");
				$v100=mysqli_fetch_array($x100);
				$permision100=$v100['r'];
				if($permision100=="y"){ ?>				
                <li>
					<a href="?page=permis">
						<i class="zmdi zmdi-case-download"></i><span>Permision</span>
					</a>
					
				</li>
                <?php }?>  
                 <?php 
				$x102=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='user'");
				$v102=mysqli_fetch_array($x102);
				$permision102=$v102['r'];
				if($permision102=="y"){ ?>				
                <li>
				<a href="?page=users" class="waves-effect"><i class="icon-user"></i><span class="title">Users</span></a>
					
				</li>
                <?php }?>  
                 <?php 
				$x11=mysqli_query($koneksi, "SELECT * FROM permis where user='$level' AND menu='userlog'");
				$v11=mysqli_fetch_array($x11);
				$permision11=$v11['r'];
				if($permision11=="y"){ ?>				
                <li>
					<a href="?page=userlog">
						<i class="zmdi zmdi-case-download"></i><span>Userlog</span>
					</a>
					
				</li>
                <?php }?>  
<!--		  <li><a href="?page=peserta" class="waves-effect"><i class="zmdi zmdi-account-box"></i><span>Data Pengda</span></a></li>
		  <li><a href="?page=input_peserta" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span>Input Peserta Pensiun</span></a></li>
          <li><a href="?page=data_peserta" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span>Data Pendaftaran</span></a></li>
		  <li><a href="?page=konfirmasi_peserta" class="waves-effect"><i class="zmdi zmdi-plus-square"></i><span>Data Pembayaran</span></a></li>          
          <li><a href="#" class="waves-effect"><i class="icon-fire"></i> <span>Absensi</span></a></li>          
		  <li><a href="?page=lap_pembayaran" class="waves-effect"><i class="zmdi zmdi-shopping-cart"></i><span>Laporan Pembayaran</span></a></li>
		  <li><a href="#"><i class="zmdi zmdi-print"></i><span>Laporan Absensi 1</span></a></li>
		  <li><a href="#" class="waves-effect"><i class="zmdi zmdi-print"></i><span>Laporan Absensi 2</span></a></li>
		  <li><a href="#" class="waves-effect"><i class="zmdi zmdi-print"></i><span>Laporan Absensi 3</span></a></li>
		  <li><a href="#" class="waves-effect"><i class="zmdi zmdi-case-download"></i><span>Download Absensi</span></a></li>-->
		  
      </li>	    
     
    </ul>
	 
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top gradient-scooter">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $nama;?></h6>
            <p class="user-subtitle"><?php echo $level;?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="?page=logout"> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
 