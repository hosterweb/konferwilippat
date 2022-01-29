<?php 
session_start();
$title = "Daftar Peserta Konferensi IPPAT Jawa Timur";
?>
<body>

<!-- Start wrapper-->
 <div id="wrapper">
 


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
	  
	  <h6 class="text-uppercase">DAFTAR PESERTA KONFERENSI WILAYAH JAWA TIMUR IKATAN PEJABAT PEMBUAT AKTA TANAH</h6>
	  <hr>
      
	  
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Absensi Peserta Sesi 1</div><br>
            <div class="card-body">
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              <form action="" method="post">
               <tr>
               <td><input type="text" name="id_pendaftaran" class="form-control" autofocus="autofocus" /></td>
               <td><input type="submit" value="absen" name="absen" class="btn btn-primary" id="absen"></td></tr>
            </table></form><br>
            
             <?php
		  if(isset($_POST['absen'])){
	$id_pendaftaran=$_POST['id_pendaftaran'];
	$a=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran'");
	$b=mysqli_fetch_array($a);
	$c=mysqli_num_rows($a);
		if($c>0){
	
	$tgl_skg=date("Y-m-d H:i:s");
	$cari=mysqli_query($koneksi, "SELECT * FROM absen where id_pendaftaran='$id_pendaftaran' AND jenis_absen='1'");
	$hasil_cari=mysqli_num_rows($cari);
	if($hasil_cari<1){
	$c=mysqli_query($koneksi, "INSERT INTO absen SET id_pendaftaran='$id_pendaftaran', waktu='$tgl_skg', jenis_absen='1', pengda='$b[pengda]'");
	?>
        <span style="color:green">Absensi Id Pendaftaran <?php echo $id_pendaftaran?> Sukses</span>

    <?php
	}
	else {?>
    
			    <span style="color:red">Peserta <?php echo $id_pendaftaran?> Sudah Melakukan Absensi</span>
<?php
		}
	?>
<table id="example" class="table table-bordered">
    <tr>
    <td><img src="../images/<?php echo $b['file_foto']?>" style="width:125px"></td>
    <td><?php echo $b['id_pendaftaran']?></td><td><?php echo $b['nama_lengkap']?></td>
    <td>Pengda <?php echo $b['pengda']?></td></tr>
 </table>   
    <?php
	}
	else {
			?>
					    <span style="color:red">Peserta <?php echo $id_pendaftaran?> Tidak Ditemukan</span>
<?php
		}
		  }
?>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
      
      
    
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  </div>
  <?php include "components/footer.php";?>