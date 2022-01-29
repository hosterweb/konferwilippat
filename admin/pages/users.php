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
		    <h4 class="page-title">Data Users</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">User</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar User IPPAT Jatim</div>
            <div class="card-body">
              <?php  if (isset($_GET['hapus'])) {
$id=$_GET['hapus'];
$hapus=mysqli_query($koneksi,"DELETE FROM user where id='$id'");
if($hapus){	
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-message"><strong>Selamat!</strong> Data Berhasil Di Hapus.</div></div>
			</div></div>';
							  }
					else{
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-danger"><br><strong>Maaf!</strong> Data Gagal Di Hapus.<br></div>
			</div></div>';
						}
} ?>
            &nbsp;&nbsp;<a href="?page=tambah_users"> <button type="button" value="Tambah User" class="btn btn-outline-primary waves-effect waves-light">Tambah User</button></a>
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                   <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM user");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama'];?></td>
                        <td><?php echo $ambil['username'];?></td>
                        <td><?php echo $ambil['password'];?></td>
                        <td><?php echo $ambil['level'];?></td>

					<td> 
                                 
                  <a href="?page=edit_users&id=<?php  echo $ambil['id'];?>"><input class="btn btn-info"type="button" value="Edit"></a>
                  <a href="?page=users&hapus=<?php echo $ambil['id'];?>"><input type="button" class="btn btn-danger" value="Hapus"></a><br>
                  <?php 
	  $cari=mysqli_query($koneksi, "SELECT * FROM permis where user='$session_level' AND menu='user'");
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
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
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
    