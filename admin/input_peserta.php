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
            <li class="breadcrumb-item"><a href="">Tambah Peserta</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Tambah Peserta</div>
            <div class="card-body">
            

<?php
	if(isset($_POST['nik'])){
	$nama_lengkap=$_POST['nama_lengkap'];
	$pengda=$_POST['pengda'];	
	$tempat_lahir=$_POST['tempat_lahir'];					
	$tgl_lahir=$_POST['tgl_lahir'];	
	$nik=$_POST['nik'];
	$kta=$_POST['kta'];
	$tgl_sk_pengangkatan=$_POST['tgl_sk_pengangkatan'];
	$no_sk_pengangkatan=$_POST['no_sk_pengangkatan'];
	$tgl_ba_sumpah=$_POST['tgl_ba_sumpah'];
	$no_ba_sumpah=$_POST['no_ba_sumpah'];
	$email=$_POST['email'];
	$hp="62".$_POST['hp'];
	$kode_kantor=$_POST['kode_kantor'];
	$telp_kantor=$_POST['telp_kantor'];
	$alamat_kantor=$_POST['alamat_kantor'];
	$kabupaten=$_POST['kabupaten'];
	$file_ktp=$_FILES['file_ktp']['name'];
	$file_kta=$_FILES['file_kta']['name'];
	$file_sk=$_FILES['file_sk']['name'];
	$file_ba=$_FILES['file_ba']['name'];
	$file_foto=$_FILES['file_foto']['name'];
	$ukuran_file_ktp= $_FILES['file_ktp']['size'];
	$ukuran_file_kta= $_FILES['file_kta']['size'];
	$ukuran_file_sk= $_FILES['file_sk']['size'];
	$ukuran_file_ba= $_FILES['file_ba']['size'];
	$ukuran_file_foto= $_FILES['file_foto']['size'];
	
	
	$nama=$nama_lengkap;
	
	$tgl_pendaftaran=date("Y-m-d H:i:s");
	
				$nama_ktp = $nik."-".$file_ktp;
				$nama_kta= $nik."-".$file_kta;
				$nama_sk= $nik."-".$file_sk;
				$nama_ba= $nik."-".$file_ba;
				$nama_foto= $nik."-".$file_foto;
				
				$ekstensi_foto_dibolehkan	= array('png','jpg','jpeg');
				$ekstensi_pdf_dibolehkan	= array('pdf');
				
				$pecah_ktp = explode('.', $nama_ktp);
				$ekstensi_ktp = strtolower(end($pecah_ktp));
				
				$pecah_kta = explode('.', $nama_kta);
				$ekstensi_kta = strtolower(end($pecah_kta));
					
				$pecah_sk = explode('.', $nama_sk);
				$ekstensi_sk= strtolower(end($pecah_sk));
				
				$pecah_ba = explode('.', $nama_ba);
				$ekstensi_ba = strtolower(end($pecah_ba));
				
				$pecah_foto = explode('.', $nama_foto);
				$ekstensi_foto = strtolower(end($pecah_foto));
					
$tgl_acara = strtotime('2019-09-23');
$tgl_lahir2=date('Y-m-d', strtotime('$tgl_lahir'));
$diff  = $tgl_acara - $tgl_lahir;

$sel2= 23740 ;

$u=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where nik='$nik'");
if(mysqli_num_rows($u) == 1) {
echo "<div class='exists' style='color:red'>
				  <strong>Maaf!</strong> Proses Pendaftaran Gagal Karena NIK sudah Didaftarkan.
				  </div>";	
}
else {
if($sel2 == 23740){
			if(in_array($ekstensi_foto, $ekstensi_foto_dibolehkan)=== true){
		if($ukuran_file_ktp < 5044070){	
			move_uploaded_file($_FILES['file_ktp']['tmp_name'],'../images/'.$nama_ktp);
			move_uploaded_file($_FILES['file_kta']['tmp_name'],'../images/'.$nama_kta);
			move_uploaded_file($_FILES['file_sk']['tmp_name'],'../images/'.$nama_sk);
			move_uploaded_file($_FILES['file_ba']['tmp_name'],'../images/'.$nama_ba);
			move_uploaded_file($_FILES['file_foto']['tmp_name'],'../images/'.$nama_foto);
			
$k=mysqli_query($koneksi,"INSERT INTO pendaftaran_ini_temp SET nama_lengkap='$nama', pengda='$pengda', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nik='$nik',tgl_sk_pengangkatan='$tgl_sk_pengangkatan',no_sk_pengangkatan='$no_sk_pengangkatan',tgl_ba_sumpah='$tgl_ba_sumpah',no_ba_sumpah='$no_ba_sumpah',email='$email',hp='$hp',telp_kantor='$telp_kantor',alamat_kantor='$alamat_kantor',kabupaten='$kabupaten',status_pembayaran='0',file_ktp='$nama_ktp',file_sk='$nama_sk',file_ba='$nama_ba',file_foto='$nama_foto',file_kta='$nama_kta', tgl_pendaftaran='$tgl_pendaftaran', kta='$kta', kode_kantor='$kode_kantor'");	
if($k){
?>
 <div id="popup">
    	<div class="window">
        	
            <?php
            $g=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini_temp where nik='$nik'");
$data=mysqli_fetch_array($g);
						?>  					    
						  
                   <hr>
				   <div class="card-title text-uppercase text-center py-3">Profil Notaris</div>
				   <hr>
                   
				    <form method="post" action="?page=simpan_pendaftaran"  enctype="multipart/form-data">
                    <table border="0" style="text-align:left">
                    <tr><td><label for="input-13">Nama Lengkap</label></td><td>:</td><td class="text-uppercase"><?php echo $data['nama_lengkap']?></td></tr>
                   <input name="nama_lengkap" type="text" value="<?php echo $data['nama_lengkap'];?>" style="display:none">
					
                    <tr><td><label for="input-13">Pengda</label></td><td>:</td><td class="text-uppercase"><?php echo $data['pengda'];?></td></tr>
					<input name="pengda" type="text"  style="display:none" value="<?php echo $data['pengda'];?>">
					
                    <tr><td><label for="input-13">Tempat Lahir</label></td><td>:</td><td class="text-uppercase"><?php echo $data['tempat_lahir'];?></td></tr>
                    <input name="tempat_lahir" type="text"  style="display:none" value="<?php echo $data['tempat_lahir'];?>">

					<tr><td> <label for="input-13">Tgl Lahir</label></td><td>:</td><td><?php echo $data['tgl_lahir'];?></td></tr>
                     <input name="tgl_lahir" type="text"  style="display:none" value="<?php echo $data['tgl_lahir'];?>">
                     
                     <tr><td><label for="input-13">NIK</label></td><td>:</td><td><?php echo $data['nik'];?></td></tr>
                     <input name="nik" type="text"  style="display:none" value="<?php echo $data['nik'];?>"> 
                                          
                     <tr><td><label for="input-13">No KTA</label></td><td>:</td><td><?php echo $data['kta'];?></td></tr>
                     <input name="kta" type="text"  style="display:none" value="<?php echo $data['kta'];?>"> 
                     
                     <tr><td><label for="input-13">Tgl SK Pengangkatan</label></td><td>:</td><td><?php echo $data['tgl_sk_pengangkatan'];?></td></tr>
                      <input name="tgl_sk_pengangkatan" type="text"  style="display:none" value="<?php echo $data['tgl_sk_pengangkatan'];?>">
                      
                      <tr><td><label for="input-13">No SK Pengangkatan</label></td><td>:</td><td><?php echo $data['no_sk_pengangkatan'];?></td></tr>
                        <input name="no_sk_pengangkatan" type="text"  style="display:none" value="<?php echo $data['no_sk_pengangkatan'];?>">
                      
                      <tr><td><label for="input-13">Tgl BA Sumpah</label></td><td>:</td><td><?php echo $data['tgl_ba_sumpah'];?></td></tr>
                        <input name="tgl_ba_sumpah" type="text"  style="display:none" value="<?php echo $data['tgl_ba_sumpah'];?>">
											
                        <tr><td><label for="input-13">NO BA Sumpah</label></td><td>:</td><td><?php echo $data['no_ba_sumpah'];?></td></tr>
                        <input name="no_ba_sumpah" type="text"  style="display:none" value="<?php echo $data['no_ba_sumpah'];?>">
                                            
                        <tr><td><label for="input-13">Email</label></td><td>:</td><td><?php echo $data['email'];?></td></tr>
                         <input name="email" type="text"  style="display:none" value="<?php echo $data['email'];?>">
                                           
						<tr><td><label for="input-13">No. HP</label></td><td>:</td><td><?php echo $data['hp'];?></td></tr>
                         <input name="hp" type="text"  style="display:none" value="<?php echo $data['hp'];?>">
											
                         <tr><td><label for="input-13">Telp Kantor</label></td><td>:</td><td><?php echo $data['kode_kantor'];?>-<?php echo $data['telp_kantor'];?></td></tr>
                         <input name="kode_kantor" type="text"  style="display:none" value="<?php echo $data['kode_kantor'];?>">
                         <input name="telp_kantor" type="text"  style="display:none" value="<?php echo $data['telp_kantor'];?>">
											
                         <tr><td><label for="input-13">Alamat Kantor</label></td><td>:</td><td class="text-uppercase"><?php echo $data['alamat_kantor'];?></td></tr>
                         <input name="alamat_kantor" type="text"  style="display:none" value="<?php echo $data['alamat_kantor'];?>">

						<tr><td><label for="input-13">Kabupaten/Kota</label></td><td>:</td><td class="text-uppercase"><?php echo $data['kabupaten'];?></td></tr>
                         <input name="kabupaten" type="text"  style="display:none" value="<?php echo $data['kabupaten'];?>">
                                            
																					
                       <tr><td colspan="3"> <div class="card-title text-uppercase text-center py-3">Upload Berkas Notaris</div><hr> </td></tr>            
						<tr><td><label for="input-13">Upload File KTP (PDF max 5mb)</label></td><td>:</td>
<?php
$pecah_file_ktp = explode('.', $data['file_ktp']);
$ekstensi_file_ktp = strtolower(end($pecah_file_ktp));
$j=$ekstensi_file_ktp['0'].$ekstensi_file_ktp['1'].$ekstensi_file_ktp['2']; 
if($j=="jpg"){
	?> 
 <td><a target="_blank" href="images/<?php echo $data['file_ktp'];?>"><img width="125px" src="assets/images/image.png"></a></td>
    <?php
	}
	else {
		?>
 <td><a target="_blank" href="images/<?php echo $data['file_ktp'];?>"><img width="125px" src="assets/images/pdf.jpg"></a></td>
<?php } ?>                        
                        
                        </tr>
                         <input name="file_ktp" type="text"  style="display:none" value="<?php echo $data['file_ktp'];?>">
											
                        <tr><td><label for="input-13">Upload File KTA (PDF max 5mb)</label></td><td>:</td>
                        
                        
                        <?php
$pecah_file_kta = explode('.', $data['file_kta']);
$ekstensi_file_kta = strtolower(end($pecah_file_kta));
$j1=$ekstensi_file_kta['0'].$ekstensi_file_kta['1'].$ekstensi_file_kta['2']; 
if($j1=="jpg"){
	?> 
 <td><a target="_blank" href="images/<?php echo $data['file_kta'];?>"><img width="125px" src="assets/images/image.png"></a></td>
    <?php
	}
	else {
		?>
 <td><a target="_blank" href="images/<?php echo $data['file_kta'];?>"><img width="125px" src="assets/images/pdf.jpg"></a></td>
<?php } ?>                        
                        
                        
                        
                        </tr>
                         <input name="file_kta" type="text"  style="display:none" value="<?php echo $data['file_kta'];?>">
						
                        <tr><td><label for="input-13">Upload File SK (PDF max 5mb)</label></td><td>:</td>

<?php
$pecah_file_sk = explode('.', $data['file_sk']);
$ekstensi_file_sk = strtolower(end($pecah_file_sk));
$j2=$ekstensi_file_sk['0'].$ekstensi_file_sk['1'].$ekstensi_file_sk['2']; 
if($j2=="jpg"){
	?> 
 <td><a target="_blank" href="images/<?php echo $data['file_sk'];?>"><img width="125px" src="assets/images/image.png"></a></td>
    <?php
	}
	else {
		?>
 <td><a target="_blank" href="images/<?php echo $data['file_sk'];?>"><img width="125px" src="assets/images/pdf.jpg"></a></td>
<?php } ?>                                                
                        </tr>
	                         <input name="file_sk" type="text"  style="display:none" value="<?php echo $data['file_sk'];?>">
<tr><td> <label for="input-13">Upload File BA (PDF max 5mb)</label></td><td>:</td>

<?php
$pecah_file_ba = explode('.', $data['file_ba']);
$ekstensi_file_ba = strtolower(end($pecah_file_ba));
$j4=$ekstensi_file_ba['0'].$ekstensi_file_ba['1'].$ekstensi_file_ba['2']; 
if($j4=="jpg"){
	?> 
 <td><a target="_blank" href="images/<?php echo $data['file_ba'];?>"><img width="125px" src="assets/images/image.png"></a></td>
    <?php
	}
	else {
		?>
 <td><a target="_blank" href="images/<?php echo $data['file_ba'];?>"><img width="125px" src="assets/images/pdf.jpg"></a></td>
<?php } ?>                        </tr>
						          
                                                 <input name="file_ba" type="text"  style="display:none" value="<?php echo $data['file_ba'];?>">
					
                    <tr><td><label for="input-13">Upload File FOTO (PDF max 5mb)</label></td><td>:</td>
<?php
$pecah_file_foto = explode('.', $data['file_foto']);
$ekstensi_file_foto = strtolower(end($pecah_file_foto));
$j5=$ekstensi_file_foto['0'].$ekstensi_file_foto['1'].$ekstensi_file_foto['2']; 
if($j5=="jpg"){
	?> 
 <td><a target="_blank" href="images/<?php echo $data['file_foto'];?>"><img width="125px" src="../images/<?php echo $data['file_foto'];?>"></a></td>
    <?php
	}
	else {
		?>
 <td><a target="_blank" href="images/<?php echo $data['file_foto'];?>"><img width="125px" src="../images/<?php echo $data['file_foto'];?>"></a></td>
<?php } ?>                        
                        
                                                                    
                                            </tr>

<input name="file_foto" type="text"  style="display:none" value="<?php echo $data['file_foto'];?>">
					
						 <tr><td>
                         <a href="edit_pendaftaran.php?nik=<?php echo $data['id'];?>"><button type="button" class="btn btn-outline-primary btn-block waves-effect waves-light">Edit</button></a></td><td>&nbsp;</td><td>
                         <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">Simpan</button></td></tr></table>
						
					</form>
				
            
        </div>
    </div>
							
                            <?php
}
		}
		else {
echo "<div class='exists' style='color:red'>
				  <strong>Maaf!</strong> Proses Pendaftaran Gagal.
				  </div>";	}
} 

else {
echo "<div class='exists' style='color:red'>
				  <strong>Maaf!</strong> Proses Pendaftaran Gagal.
				  </div>";	}
}
	
	else {
			echo "<div class='exists' style='color:red'>
				  <strong>Maaf!</strong> Usia Anda Tidak Memenuhi Kriteria.
				  </div>";
				  }
	} 
	}

						?>  					    
						  
                    <div class="card">
			     <div class="card-body">
				   <div class="card-title text-uppercase text-center py-3">Profil Notaris</div>
				   <hr>
				    <form method="post"  enctype="multipart/form-data">
					<div class="form-group">
                                            <label for="input-13">Nama Lengkap(*)</label>
							<input type="text" name="nama_lengkap" class="form-control text-uppercase required"  value="<?php if(!(empty($nama_lengkap))){ echo $nama_lengkap; };?>" />
											</div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Pengda(*)</label>
                                        <!-- <input type="text" name="pengda" id="pengda" value="<?php //echo $sel2;?>" class="form-control text-uppercase required" placeholder="Pengda" required readonly>   -->
												<input type="text" name="pengda" id="pengda" value="<?php if(!(empty($pengda))){ echo $pengda; };?>" class="form-control text-uppercase required" placeholder="Pengda" required>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tempat Lahir(*)</label>
												<input type="text" name="tempat_lahir"  value="<?php if(!(empty($tempat_lahir))){ echo $tempat_lahir; };?>" class="form-control text-uppercase required" placeholder="Tempat Lahir" required>
											</div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Tanggal Lahir (DD/MM/YYYY)*</label>
												<input type="text" name="tgl_lahir" class="form-control"  value="<?php if(!(empty($tgl_lahir))){ echo $tgl_lahir; };?>" id="autoclose-datepicker" required>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">No. KTP/NIK(*)</label>
								<input class="form-control required"  type="text" name="nik"  value="<?php if(!(empty($nik))){ echo $nik; };?>"  maxlength="16" required onkeypress="return hanyaAngka(event)" placeholder="No NIK KTP"/>	
											</div>

											<div class="form-group">
                                            <label for="input-13">No. KTA INI</label>
												<input type="text" name="kta" class="form-control" value="<?php if(!(empty($kta))){ echo $kta; };?>" placeholder="No KTA INI">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tanggal SK Pengangkatan Notaris (DD/MM/YYYY)*</label>
									<input type="text" name="tgl_sk_pengangkatan" class="form-control" required placeholder="Tgl SK Pengangkatan" id="autoclose-datepicker2" value="<?php if(!(empty($tgl_sk_pengangkatan))){ echo $tgl_sk_pengangkatan; };?>">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">No. SK Pengangkatan Notaris(*)</label>
												<input type="text" name="no_sk_pengangkatan" value="<?php if(!(empty($no_sk_pengangkatan))){ echo $no_sk_pengangkatan; };?>" class="form-control" required placeholder="No SK Pengangkatan">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tanggal BA Sumpah (DD/MM/YYYY)*</label>
									<input type="text" name="tgl_ba_sumpah" class="form-control required" value="<?php if(!(empty($tgl_ba_sumpah))){ echo $tgl_ba_sumpah; };?>" placeholder="Tgl BA Sumpah" id="autoclose-datepicker3" required> 
											</div>
										
											<div class="form-group">
                                             <label for="input-13">NO BA Sumpah</label>
												<input type="text" name="no_ba_sumpah" value="<?php if(!(empty($no_ba_sumpah))){ echo $no_ba_sumpah; };?>" class="form-control text-uppercase required" placeholder="No BA Sumpah" >

											</div>
										
											<div class="form-group">
                                             <label for="input-13">Email(*)</label>                                            
												<input type="email" name="email" class="form-control required" value="<?php if(!(empty($email))){ echo $email; };?>" placeholder="Email" required>
											</div>
									
											<div class="form-group">
                                             <label for="input-13">No. Hp/WhatsApp(*)(awali dengan kode negara cth 628234567890)</label>                                            
<table border="0" width="100%"><tr><td width="20%">
<input type="text" readonly name="kode_hp" value="62" class="form-control required" ></td><td width="80%">
<input class="form-control required"  type="text" name="hp" maxlength="11" required onkeypress="return hanyaAngka(event)"/>	</td></tr></table>
											</div>
										
											<div class="form-group">
                                             <label for="input-13">Telp Kantor(*)</label>
                                             <table border="0" width="100%"><tr><td width="20%">
<input type="text" name="kode_kantor" maxlength="4" required onkeypress="return hanyaAngka(event)" value="<?php if(!(empty($kode_kantor))){ echo $kode_kantor; };?>" class="form-control required" /></td><td>
<input type="text" name="telp_kantor" maxlength="8" required onkeypress="return hanyaAngka(event)" value="<?php if(!(empty($telp_kantor))){ echo $telp_kantor; };?>" class="form-control required" /></td></tr>
</table>
											</div>
										
											<div class="form-group">
                                              <label for="input-13">Alamat Kantor(*)</label>                                            
												<textarea  cols="10" rows="5" name="alamat_kantor" class="form-control text-uppercase required" required placeholder="Alamat Kantor">
                                               <?php if(!(empty($alamat_kantor))){ echo $alamat_kantor; };?>
                                                </textarea>
											</div>
										
											<div class="form-group">
                                             <label for="input-13">Kabupaten/Kota*(*)</label> 
                                            <input type="text" name="kabupaten" class="form-control text-uppercase required" value="<?php if(!(empty($kabupaten))){ echo $kabupaten; };?>" placeholder="Nama Kabupaten" >
												</div>	<br>										
                                    <div class="card-title text-uppercase text-center py-3">Upload Dokumen</div>
				   							<hr>             
											<div class="form-group">
                                               <label for="input-13">KTP (JPEG,PNG, PDF maksimal berukuran 5Mb)*</label>
												<input type="file" name="file_ktp" class="form-control required" required placeholder="Upload File KTP">
											</div>
											<div class="form-group">
                                            <label for="input-13">KTA INI (JPEG,PNG, PDF maksimal berukuran 5Mb)</label>
												<input type="file" name="file_kta" class="form-control" placeholder="Upload File KTA">
											</div>
											<div class="form-group">
                                            <label for="input-13">SK INI (PDF maskimal berukuran 5Mb)*</label>
												<input type="file" name="file_sk" class="form-control" required placeholder="Upload File SK">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">BA INI (PDF maskimal berukuran 5Mb)*</label>
												<input type="file" name="file_ba" class="form-control" required placeholder="Upload File BA">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Pas Foto Berwarna <br>(jpg,png,jpeg Max. 5Mb)*</label>
												<input type="file" name="file_foto" class="form-control" required placeholder="Upload File Foto">
											</div>
                                            
                                            
					<div class="form-group">
						   <div class="icheck-primary">
			                <input type="checkbox" id="user-checkbox" required/>
			                <label for="user-checkbox">Bahwa saya telah mengisi data dengan benar
Bahwa saya mengerti dan bertanggung jawab terhadap data yang saya isi dan upload.
</label>
						  </div>
						 </div>
						 <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">DAFTAR</button>
						 
					</form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
 