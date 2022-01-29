<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication2 mx-auto my-5 animated bounceInDown">
	
	 <div class="row">
        <div class="col-lg-12">
            
		<div class="card-body">
		 <div class="card-content p-1">
		 	<div class="text-center">
		 		<img src="assets/images/logo_ippat.png" width="10%">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Absensi Sesi 1 <br> Konferensi Wilayah Jawa Timur<br>Ikatan Pejabat Pembuat Akta Tanah (IPPAT)</div>
          			<?php
 session_start();

?>
		     <form action="" method="post">
		         <table border="0" width="100%" style="align:center; text-align:center;">
               <tr>
                    <td><input type="text" name="id_pendaftaran" class="form-control" style="width:100%" autofocus="autofocus" /></td>
                    <td><input type="submit" value="absen" name="absen" class="btn btn-primary" id="absen"></td>
               </tr>
            </table></form>
			 <br>
			  <?php
			  if(isset($_POST['absen'])){
	$id_pendaftaran=$_POST['id_pendaftaran'];
	$a=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran' AND status_pembayaran='1'");
	$b=mysqli_fetch_array($a);
	$c=mysqli_num_rows($a);
		if($c>0){
	
	$tgl_skg=date("Y-m-d H:i:s");
	$cari=mysqli_query($koneksi, "SELECT * FROM absen where id_pendaftaran='$id_pendaftaran' AND jenis_absen='1'");
	$hasil_cari=mysqli_num_rows($cari);
	if($hasil_cari<1){
	$c=mysqli_query($koneksi, "INSERT INTO absen SET id_pendaftaran='$id_pendaftaran', waktu='$tgl_skg', jenis_absen='1', pengda='$b[pengda]'");
	?>
        <h4 style="color:green;  text-align:center">Absensi Sukses</h4></span>

    <?php
	}
	else {?>
    
			    <h4 style="color:red; text-align:center">Peserta Sudah Melakukan Absensi</h4>
<?php
		}
	?>
<table id="example" class="table table-bordered" style="font-size:8pt" width="100%">
    <tr><td colspan="4"><img src="../images/<?php echo $b['file_foto']?>" class="rounded mx-auto d-block" style="width:75px;"></td></tr>
    <tr>
    <td width="5%"><?php echo $b['id_pendaftaran']?></td>
    <td width="70%"><?php echo $b['nama_lengkap']?></td>
    <td width="10%">Pengda <?php echo $b['pengda']?></td>
    <td width="15%"><?php echo $tgl_skg;?></td>
    </tr>
 </table>   
    <?php
	}
	else {
			?>
					    <h4 style="color:red; text-align:center">Peserta Tidak Ditemukan</h4>
<?php
		}
		  }
?>
		   </div>
		  </div>
		  </div>
		  </div>
		  </div>
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper--></div>