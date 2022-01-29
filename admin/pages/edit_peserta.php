<?php 
session_start();
?>
<style>
  /* Jendela Pop Up */
#popup {
	width: 100%;
	height: 100%;
	position: fixed;
	background: rgba(0,0,0,.7);
	top: 0;
	left: 0;
	z-index: 9999;
	visibility: visible;
}

.window {
	width: 650px;
	height: 580px;
	background: #fff;
	border-radius: 10px;
	position: relative;
	padding: 10px;
	text-align: center;
	margin: 3% auto;
	overflow:scroll;
}
.window h2 {
	margin: 30px 0 0 0;
}
/* Button Close */
.close-button {
	width: 6%;
	height: 5%;
	line-height: 23px;
	background: #000;
	border-radius: 50%;
	border: 3px solid #fff;
	display: block;
	text-align: center;
	color: #fff;
	text-decoration: none;
	position: absolute;
	top: -10px;
	right: -10px;	
}

  </style>
  
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Peserta</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Edit Peserta</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Edit  Peserta</div>
            <div class="card-body">
            

<?php 
	if(isset($_POST['nama_lengkap'])){
	    $nama_lengkap=$_POST['nama_lengkap'];
	    $pengda=$_POST['pengda'];
	    $email=$_POST['email'];
	    $hp=$_POST['hp'];
	    $kode_kantor=$_POST['kode_kantor'];
	    $telp_kantor=$_POST['telp_kantor'];
	    $id=$_POST['id']; 
	    
$cari=mysqli_query($koneksi, "SELECT * from pendaftaran_ini where id='$id'");	    
$u1=mysqli_fetch_array($cari);

$l=mysqli_query($koneksi, "UPDATE pendaftaran_ini SET nama_lengkap='$nama_lengkap', pengda='$pengda', email='$email', hp='$hp', kode_kantor='$kode_kantor', telp_kantor='$telp_kantor' where id='$id'");
	    
	    if($l){	
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-message"><strong>Selamat!</strong> Data Berhasil Di Simpan.</div></div>';
							  }
					else{
			echo '<div class="alert alert-warning alert-dismissible" role="alert">
<div class="warning-message"><strong>Maaf!</strong> Data Gagal Di Simpan.</div></div>';
					}
	}
	
$id=$_GET['id'];
$k=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id='$id'");	  
$s=mysqli_fetch_array($k);
?>
                    <div class="card">
			     <div class="card-body">
				   <div class="card-title text-uppercase text-center py-3">Profil Peserta IPPAT</div>
				   <hr>
				    <form method="post"  enctype="multipart/form-data">
					<div class="form-group">
                                            <label for="input-13">Nama Lengkap(*)</label>
							<input type="text" name="nama_lengkap" class="form-control required" value="<?php echo $s['nama_lengkap']; ?>" />
							<input style="display:none" type="text" name="id" class="form-control text-uppercase required"  value="<?php echo $s['id']; ?>" />

											</div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Pengda(*)</label>
                                        		<input type="text" name="pengda" id="pengda" value="<?php echo $s['pengda']; ?>" class="form-control text-uppercase required" placeholder="Pengda" required>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tempat Lahir(*)</label>
												<input type="text" name="tempat_lahir" readonly  value="<?php echo $s['pengda']; ?>" class="form-control text-uppercase required" placeholder="Tempat Lahir" required>
											</div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Tanggal Lahir (DD/MM/YYYY)*</label>
												<input type="text" name="tgl_lahir" class="form-control" readonly  value="<?php echo $s['tgl_lahir']; ?>" id="autoclose-datepicker" required>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">No. KTP/NIK(*)</label>
								<input class="form-control required"  type="text" name="nik" readonly  value="<?php echo $s['nik']; ?>"  maxlength="16" required onkeypress="return hanyaAngka(event)" placeholder="No NIK KTP"/>	
											</div>

											<div class="form-group">
                                            <label for="input-13">No. SK Pengangkatan Notaris(*)</label>
												<input type="text" name="no_sk_pengangkatan" value="<?php echo $s['no_sk_pengangkatan']; ?>" readonly class="form-control" required placeholder="No SK Pengangkatan">
											</div>
											
											<div class="form-group">
                                            <label for="input-13">Tanggal SK Pengangkatan Notaris (DD/MM/YYYY)*</label>
									<input type="text" name="tgl_sk_pengangkatan" class="form-control" readonly required placeholder="Tgl SK Pengangkatan" id="autoclose-datepicker2" value="<?php echo $s['tgl_sk_pengangkatan']; ?>">
											</div>
										
											<div class="form-group">
                                             <label for="input-13">NO BA Sumpah</label>
												<input type="text" name="no_ba_sumpah" value="<?php echo $s['no_ba_sumpah']; ?>" readonly class="form-control text-uppercase required" placeholder="No BA Sumpah" >

											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tanggal BA Sumpah (DD/MM/YYYY)*</label>
									<input type="text" name="tgl_ba_sumpah" class="form-control required" value="<?php echo $s['tgl_ba_sumpah']; ?>" readonly placeholder="Tgl BA Sumpah" id="autoclose-datepicker3" required> 
											</div>
										
										
										
											<div class="form-group">
                                             <label for="input-13">Email(*)</label>                                            
												<input type="email" name="email" class="form-control required" value="<?php echo $s['email']; ?>" placeholder="Email" required>
											</div>
									
											<div class="form-group">
                                             <label for="input-13">No. Hp/WhatsApp(*)(awali dengan kode negara cth 628234567890)</label>                                            
<table border="0" width="100%"><tr><td width="100%">
<input class="form-control required"  type="text" name="hp" value="<?php echo $s['hp']; ?>"/>	</td></tr></table>
											</div>
										
											<div class="form-group">
                                             <label for="input-13">Telp Kantor(*)</label>
                                             <table border="0" width="100%"><tr><td width="20%">
<input type="text" name="kode_kantor" maxlength="4" required onkeypress="return hanyaAngka(event)" value="<?php echo $s['kode_kantor']; ?>" class="form-control required" /></td><td>
<input type="text" name="telp_kantor" maxlength="8" required onkeypress="return hanyaAngka(event)" value="<?php echo $s['telp_kantor']; ?>" class="form-control required" /></td></tr>
</table>
											</div>
										
											<div class="form-group">
                                              <label for="input-13">Alamat Kantor(*)</label>                                            
												<textarea  cols="10" rows="5" readonly name="alamat_kantor" class="form-control text-uppercase required" required placeholder="Alamat Kantor">
                                               <?php echo $s['alamat_kantor']; ?>
                                                </textarea>
											</div>
										
											<br>										
                                    <div class="card-title text-uppercase text-center py-3">Upload Dokumen</div>
				   							<hr>       
<?php
$pecah_file_ktp = explode('.', $s['file_ktp']);
$ekstensi_file_ktp = strtolower(end($pecah_file_ktp));
$j1=$ekstensi_file_ktp['0'].$ekstensi_file_ktp['1'].$ekstensi_file_ktp['2']; 
?>
											<div class="form-group">
                                               <label for="input-13">KTP (JPEG,PNG, PDF maksimal berukuran 5Mb)*</label>
                                               <?php if($j1=="pdf") { ?>
<a target="_blank" href="../images/<?php echo $s['file_ktp'];?>"><img width="75px" src="assets/images/pdf.jpg"></a>
<?php } else { ?><img src="../images/<?php echo $s['file_ktp']; ?>" width="75px"> <?php }?>
											</div>
										
										
											<div class="form-group">
                                            <label for="input-13">SK INI (PDF maskimal berukuran 5Mb)*</label>
<a target="_blank" href="../images/<?php echo $s['file_sk'];?>"><img width="75px" src="assets/images/pdf.jpg"></a>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">BA INI (PDF maskimal berukuran 5Mb)*</label>
<a target="_blank" href="../images/<?php echo $s['file_ba'];?>"><img width="75px" src="assets/images/pdf.jpg"></a>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Pas Foto Berwarna <br>(jpg,png,jpeg Max. 5Mb)*</label>
<?php
$pecah_file_foto = explode('.', $s['file_foto']);
$ekstensi_file_foto = strtolower(end($pecah_file_foto));
$j3=$ekstensi_file_foto['0'].$ekstensi_file_foto['1'].$ekstensi_file_foto['2']; 
?>                                            
												 <?php if($j3=="pdf") { ?>
<a target="_blank" href="../images/<?php echo $s['file_foto'];?>"><img width="75px" src="assets/images/pdf.jpg"></a>
<?php } else { ?><img src="../images/<?php echo $s['file_foto']; ?>" width="100px"> <?php }?>												
											</div>
                                            
						 <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">UPDATE</button>
						 <a href="?page=data_peserta"><button type="button" class="btn btn-outline-primary btn-block waves-effect waves-light">KEMBALI</button></a>
					</form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
 