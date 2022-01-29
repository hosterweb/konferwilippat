<?php 
session_start();
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
            <div class="card-header text-uppercase">Peserta Pengda</div>
            <div class="card-body">
 <?php
 if(isset($_POST['nama'])){
 $nama=$_POST['nama'];
 $pengda=$_POST['pengda'];
 $id=$_POST['id'];
 
 $o=mysqli_query($koneksi,"UPDATE  pendaftaran SET nama='$nama', pengda='$pengda' WHERE id='$id'");
if($o){	
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-message"><strong>Selamat!</strong> Data Berhasil Di Simpan.</div></div>';
							  }
					else{
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="warning-message"><strong>Maaf!</strong> Data Gagal Di Simpan.</div></div>';
					} }
$id=$_GET['id'];
$a=mysqli_query($koneksi,"SELECT * FROM pendaftaran where id='$id'");
$b=mysqli_fetch_array($a);				
 ?>           
              <form action="" method="post">
                  <div class="form-group">
                      <label>Pilih Pengda</label>
                      <select class="form-control single-select" name="pengda">
                      <option value="<?php echo $b['pengda'];?>"><?php echo $b['pengda'];?></option>

                         <?php 
						 $j=mysqli_query($koneksi, "SELECT * FROM pendaftaran group by pengda");
						 while($k=mysqli_fetch_array($j)){
						 ?>
                          <option value="<?php echo	$k['pengda'];?>"><?php echo $k['pengda'];?></option>
                          <?php }?>
                      </select>
                    </div>
						<div class="form-group">
                        <label>Nama Peserta</label>
                         <input type="text" name="id" style="display:none" class="form-control" value="<?php echo $b['id'];?>">
                       <input type="text" name="nama" class="form-control" value="<?php echo $b['nama'];?>">
                   </div>
                     <div class="form-group">      
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-save mr-1"></i> Simpan</button>
                  <a href="?page=peserta"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-save mr-1"></i> Kembali</button></a>

						</div>
                 </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    