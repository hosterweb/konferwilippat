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
		    <h4 class="page-title">Data Pendaftaran</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Pendaftaran Peserta</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar Peserta IPPAT Jatim</div>
            <div class="card-body">
              <div class="table-responsive">
  <?php  if (isset($_GET['hapus'])) {
$id=$_GET['hapus'];
$hapus=mysqli_query($koneksi,"DELETE FROM pendaftaran_ini where id='$id'");
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
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>HP</th>
                    <th>Kode Unik Pemb</th>
                    <th>Nomor <br>Pendaftaran</th>
                    <th>Status Pemb</th>
                    <th>Status Exp</th>
                   <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini order by biaya");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td><?php echo $ambil['hp'];?></td>
                        <td>Rp. <?php echo number_format($ambil['biaya']);?></td>
                        <td><?php echo $ambil['id_pendaftaran'];?></td>
                        <td><?php if($ambil['status_pembayaran']==0){echo "Belum Bayar"; } else {echo "Sudah Bayar";}?></td>
                        <td><?php if($ambil['status_expired']==1) { echo "Expired"; }  else {echo "Tidak Expired";}?></td>
					<td> 
				<a href="?page=kirim_notif&id_pendaftaran=<?php  echo $ambil['id_pendaftaran'];?>"><input type="button" value="Kirim Notif Peserta Lagi"></a><br>
                   <a href="?page=edit_peserta&id=<?php echo $ambil['id'];?>"> <input type="button" value="Edit"></a>
                      <a href="?page=data_peserta&hapus=<?php echo $ambil['id'];?>"> <input type="button" value="Hapus"></a>
                  <!-- <a href="aktivasi_pengda.php?id_pendaftaran=<?php // echo $ambil['id_pendaftaran'];?>"> <span class="ti-check" title="Validasi Pengda"></span></a>-->
                  <?php 
	  $cari=mysqli_query($koneksi, "SELECT * FROM permis where user='$session_level' AND menu='peserta'");
	  $data=mysqli_fetch_array($cari);
	  if($data['d']=="y") {
	  ?>  
                  <!-- <a href="hapus_peserta.php?id=<?php echo $ambil['id'];?>"> <span class="ti-trash" title="Hapus Peserta"></span></a>-->
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
                    <th>HP</th>
                    <th>Kode Unik Pemb</th>
                    <th>Nomor <br>Pendaftaran</th>
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
    