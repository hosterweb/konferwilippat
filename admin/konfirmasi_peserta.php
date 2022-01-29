<?php 
session_start();

$start_date = new DateTime("2018-11-14");
$end_date = new DateTime();
$interval = $start_date->diff($end_date);

$cari=mysqli_query($koneksi,"SELECT COUNT(id) AS sudah_bayar FROM pendaftaran where status_pembayaran='1'");
$data=mysqli_fetch_array($cari);
$sudah_bayar=$data['sudah_bayar'];

$cari1=mysqli_query($koneksi,"SELECT COUNT(id) AS belum_bayar FROM pendaftaran where status_pembayaran='0'");
$data1=mysqli_fetch_array($cari1);
$belum_bayar=$data1['belum_bayar'];

$cari2=mysqli_query($koneksi,"SELECT COUNT(id) AS data_peserta FROM pendaftaran");
$data2=mysqli_fetch_array($cari2);
$data_peserta=$data2['data_peserta'];

$username=$_SESSION['username'];
$cari=mysqli_query($koneksi,"SELECT * FROM user where username='$username'");
$data=mysqli_fetch_array($cari);
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Peserta di Pengda</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Peserta Pengda</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar Konfirmasi Pembayaran Peserta Konferwil Jatim IPPAT</div>
            <div class="card-body">
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>Nominal</th>
                    <th>Tanggal <br>Pembayaran</th>
                   <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM bukti_pembayaran");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td><?php echo $ambil['biaya'];?></td>
                        <td><?php echo $ambil['tgl_bayar'];?></td>
					<td> 
                   <a target="_blank" href="lihat_foto.php?id=<?php echo $ambil['id'];?>"> <span class="ti-eye" title="Lihat Foto"></span></a>
                   <!--<a target="_blank" href="lihat_foto.php?id=<?php // echo $ambil['id'];?>"> <span class="ti-eye" title="Lihat Foto"></span></a> -->                  
                  <a href="aktivasi_peserta.php?id_pendaftaran=<?php echo $ambil['id_pendaftaran'];?>"> <span class="ti-check" title="Validasi Pengda"></span></a>
                  <a href="hapus_peserta.php?id=<?php echo $ambil['id'];?>"> <span class="ti-trash" title="Hapus Peserta"></span></a>
                  <?php 
	  $cari=mysqli_query($koneksi, "SELECT * FROM permis where user='$session_level' AND menu='peserta'");
	  $data=mysqli_fetch_array($cari);
	  if($data['d']=="y") {
	  ?>  
        <?php } ?> 
                    </td>
                    </tr>
                    <?php }?>
                   
                </tbody>
                <tfoot>
                    <tr>
                     <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>Nominal</th>
                    <th>Tanggal <br>Pembayaran</th>
                    <th>Tindakan</th>
                    </tr>
                </tfoot>
             </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    