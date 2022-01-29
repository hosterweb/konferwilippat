<?php 
session_start();
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Users</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Tambah Users</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Data Users</div>
            <div class="card-body">
 <?php
 if(isset($_POST['nama'])){
 $nama=$_POST['nama'];
 $username=$_POST['username'];
 $password=$_POST['password'];
 $level=$_POST['level'];
 $tgl_pembuatan_akun=date("d/m/Y");
 
 $o=mysqli_query($koneksi,"INSERT INTO user SET nama='$nama', username='$username', password='$password', level='$level', tgl_pembuatan_akun='$tgl_pembuatan_akun'");
if($o){	
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-message"><strong>Selamat!</strong> Data Berhasil Di Simpan.</div></div>';
							  }
					else{
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-message"><strong>Maaf!</strong> Data Gagal Di Simpan.</div></div>';
					} }
 ?>           
              <form action="?page=tambah_users" method="post">
					<div class="form-group">
                        <label>Nama Lengkap</label>
                       <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                       <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                       <input type="text" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Pilih Level</label>
                      <select class="form-control single-select" name="level">
                            <option value="admin">Admin</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="verivikasi">Verifikasi</option>
                      </select>
                    </div>
                     <div class="form-group">      
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-save mr-1"></i> Simpan</button>
						</div>
                 </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    