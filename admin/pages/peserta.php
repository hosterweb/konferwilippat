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
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=peserta">Peserta Daftar</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
     <?php  if (isset($_GET['hapus'])) {
$id=$_GET['hapus'];
$hapus=mysqli_query($koneksi,"DELETE FROM pendaftaran where id='$id'");
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
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Data Peserta</div>
            <div class="card-body">
            &nbsp;&nbsp;<a href="?page=tambah_peserta_pengda"> <button type="button" value="Tambah Peserta Pengda"  class="btn btn-outline-primary waves-effect waves-light">Tambah Peserta Pengda</button></a>
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                   <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran order by pengda,nama");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
					<td> 
                   <a href="?page=edit_peserta_pengda&id=<?php echo $ambil['id'];?>"><input type="button" value="Edit Peserta" /></a>

                   <a href="?page=peserta&hapus=<?php echo $ambil['id'];?>"><input type="button" value="Hapus Peserta" /></a>
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
    