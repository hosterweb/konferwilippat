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
		    <h4 class="page-title">Data Permission</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Hak Akses</a></li>
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
            <div class="card-header"><i class="fa fa-table"></i> Data Hak Akses</div>
            <div class="card-body">
            
              <div class="table-responsive">
             
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>User</th>
                    <th>Create</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM permis order by id_permis");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                     	<td><?php echo $ambil['menu'];?></td>
                     	<td><?php echo $ambil['user'];?></td>
                        <td><?php if ($ambil['c']=='y'){ echo "Ya"; }	else { echo "Tidak"; } ?></td>
                        <td><?php if ($ambil['r']=='y'){ echo "Ya"; }	else { echo "Tidak"; } ?></td>
                        <td><?php if ($ambil['u']=='y'){ echo "Ya"; }	else { echo "Tidak"; } ?></td>
                        <td><?php if ($ambil['d']=='y'){ echo "Ya"; }	else { echo "Tidak"; } ?></td>
					    <td><a href="?page=edit_permis&edit=<?php echo $db['id_permis'];?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
                <tfoot>
                    <tr>
                     <th>No</th>
                    <th>Menu</th>
                    <th>User</th>
                    <th>Create</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Aksi</th>
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
    