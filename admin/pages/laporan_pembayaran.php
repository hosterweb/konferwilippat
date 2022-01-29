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
		    <h4 class="page-title">Laporan Pembayaran Peserta</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Lap Pembayaran Peserta</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar  Pembayaran Peserta IPPAT Jatim</div>
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
                   <th>Bukti Bayar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM bukti_pembayaran where status='1'");
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
                        ?>
                        <td><?php  echo $y3['email'];
                        ?>
                        </td>
                        <td><?php echo $ambil['tgl_bayar'];?></td>
                       
					<td> 
                   <a target="_blank" href="?page=lihat_bukti&id=<?php echo $ambil['id'];?>"><input class="btn btn-primary" type="button" value="Lihat Bukti"></a><br>
                   <a target="_blank" href="../kartu_peserta.php?id=<?php echo $ambil['id_pendaftaran'];?>"><input class="btn btn-info" type="button" value="Id Card Peserta"></a>
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
                    <th>No. HP</th>
                    <th>Tgl Bayar</th>
                   <th>Bukti Bayar</th>
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
    