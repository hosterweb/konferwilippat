<?php 
session_start();
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Konfirmasi Pembayaran</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Konfirmasi Pembayaran</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <?php
 $id=$_GET['id'];
 $a=mysqli_query($koneksi, "SELECT * FROM bukti_pembayaran where id='$id'");
 $b=mysqli_fetch_array($a);
 ?>
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Pembayaran Peserta <?php echo $b['nama_lengkap'];?></div>
            <div class="card-body">
 <table border="0" width="100%">
    <tr><td>Nama Peserta</td><td>:</td><td> <?php echo $b['nama_lengkap'];?></td></tr> 
    <tr><td>Pengda</td><td>:</td><td> <?php echo $b['pengda'];?></td></tr> 
    <tr><td>Tgl Pembayaran</td><td>:</td><td> <?php echo $b['tgl_bayar'];?></td></tr> 
     <tr><td>Nominal</td><td>:</td><td>Rp. <?php echo number_format($b['biaya']);?></td></tr> 
         <tr><td>Foto Bukti Pembayaran</td><td>:</td><td> <a href="../images/<?php echo $b['bukti_pembayaran'];?>" target="_blank"><img src="../images/<?php echo $b['bukti_pembayaran'];?>" width='250px'></a>
</td></tr> 
   
 </table>
                  
                 <div class="form-group">
                        <label><a href="?page=konfirmasi_peserta"><input type="button" value="Kembali"></a></label>
                   </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    