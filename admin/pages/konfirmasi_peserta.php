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
		    <h4 class="page-title">Data Konfirmasi Peserta</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Konfirmasi Peserta</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar Konfirmasi Pembayaran Peserta IPPAT Jatim</div>
            <div class="card-body">
              <?php  if (isset($_GET['hapus'])) {
$id=$_GET['hapus'];
$hapus=mysqli_query($koneksi,"DELETE FROM bukti_pembayaran where id='$id'");
if($hapus){	
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-success"><strong>Selamat!</strong> Data Berhasil Di Hapus.</div>
			</div></div>';
							  }
					else{
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-danger"><strong>Maaf!</strong> Data Gagal Di Hapus.</div>
			</div></div>';
						}
} ?>
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Pengda</th>
                    <th>Biaya</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Tgl Bayar</th>
                    <th>Status</th>
                   <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM bukti_pembayaran where status=''");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td>Rp. <?php echo number_format($ambil['biaya']);?></td>
                        <td><?php 
                        $idpendaftaran=$ambil['id_pendaftaran'];
                        $x2=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where id_pendaftaran='$idpendaftaran'");
                        $y3=mysqli_fetch_array($x2);
                        echo $y3['hp'];
                        ?></td>
                        <td><?php echo $y3['email']; ?></td>
                        <td><?php echo $ambil['tgl_bayar'];?></td>
                        <td><?php if($ambil['status']==1){ echo "Sudah Di Konnfirmasi";} else {echo "Belum Di Konfirmasi";};?></td>

					<td> 
                   <a target="_blank" href="?page=lihat_foto&id=<?php echo $ambil['id'];?>"><input class="btn btn-primary" type="button" value="Lihat Foto"></a><br>
                   <!--<a target="_blank" href="lihat_foto.php?id=<?php // echo $ambil['id'];?>"> <span class="ti-eye" title="Lihat Foto"></<br>span></a> -->                  
     <?php if($ambil['status']==0){ ?> 
                  <a href="?page=validasi_peserta&id_pendaftaran=<?php  echo $ambil['id_pendaftaran'];?>"><input class="btn btn-success" type="button" value="Validasi Peserta"></a><br>
    <?php }?>              
     <?php if($ambil['status']==1){ ?>             
                  <a href="?page=kirim_email_wa&id_pendaftaran=<?php  echo $ambil['id_pendaftaran'];?>"><input class="btn btn-info"type="button" value="Kirim Notif Peserta Lagi"></a><br>
<?php }?>
                  
                  <a href="?page=konfirmasi_peserta&hapus=<?php echo $ambil['id'];?>"><input type="button" class="btn btn-danger" value="Hapus Data"></a><br>
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
                    <th>Nama Lengkap</th>
                    <th>Pengda</th>
                    <th>Biaya</th>
                    <th>Tgl Bayar</th>
                    <th>Status</th>
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
    