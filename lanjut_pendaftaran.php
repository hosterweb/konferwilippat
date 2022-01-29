<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Pendaftaran Konferwil IPPAT Jawa Timur</title>
  <!--favicon-->
  <link rel="icon" href="admin/assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="admin/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="admin/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="admin/assets/css/app-style.css" rel="stylesheet"/>
   <!--multi select-->
  <link href="admin/assets/plugins/jquery-multi-select/multi-select.css" rel="stylesheet" type="text/css">
  <!--Select Plugins-->
  <link href="admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  
</head>

<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	   <div class="card-authentication2 mx-auto my-3">
	    <div class="card-group">
	    	<div class="card mb-0">
	    	   <div class="bg-signup2"></div>
	    		<div class="card-img-overlay rounded-left my-5">
                 <h3 class="text-white">PENDAFTARAN KONFERWIL IPPAT JAWA TIMUR</h3>
                 <p class="card-text text-white pt-3">
                 Perlu Di Perhatikan !!! <br>
                 - Peserta harus berusia di bawah 65 Tahun per 22 Januari 2022<br>
                 <br>- Peserta harus membayar biaya pendafaran selambat-lambatnya 1x24 jam<br>
                 <br>- Nomor Pendaftaran akan anda dapatkan setelah membayar biaya pendaftaran 
                 </p>
             </div>
	    	</div>

	    	<div class="card mb-0">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="admin/assets/images/logo_kosong.png" width="125px">
					 	</div>
<?php
include "admin/inc/koneksi.php";
	if(isset($_POST['nik'])){
	$nama_lengkap=$_POST['nama_lengkap'];
	$pengda=$_POST['pengda'];	
	$tempat_lahir=$_POST['tempat_lahir'];					
	$tgl_lahir=$_POST['tgl_lahir'];	
	$nik=$_POST['nik'];
	//$kta=$_POST['kta'];
	$tgl_sk_pengangkatan=$_POST['tgl_sk_pengangkatan'];
	$no_sk_pengangkatan=$_POST['no_sk_pengangkatan'];
	$tgl_ba_sumpah=$_POST['tgl_ba_sumpah'];
	$no_ba_sumpah=$_POST['no_ba_sumpah'];
	$email=$_POST['email'];
	$hp=$_POST['hp'];
	$telp_kantor=$_POST['telp_kantor'];
	$alamat_kantor=$_POST['alamat_kantor'];
	//$kabupaten=$_POST['kabupaten'];
	$nama_ktp=$_POST['file_ktp'];
	//$nama_kta=$_POST['file_kta'];
	$nama_sk=$_POST['file_sk'];
	$nama_ba=$_POST['file_ba'];
	$nama_foto=$_POST['file_foto'];
	$tgl_pendaftaran=date("Y-m-d H:i:s");

			
$k=mysqli_query($koneksi,"INSERT INTO pendaftaran_ini SET nama_lengkap='$nama_lengkap', pengda='$pengda', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nik='$nik',tgl_sk_pengangkatan='$tgl_sk_pengangkatan',no_sk_pengangkatan='$no_sk_pengangkatan',tgl_ba_sumpah='$tgl_ba_sumpah',no_ba_sumpah='$no_ba_sumpah',email='$email',hp='$hp',telp_kantor='$telp_kantor',alamat_kantor='$alamat_kantor',status_pembayaran='0',file_ktp='$nama_ktp',file_sk='$nama_sk',file_ba='$nama_ba',file_foto='$nama_foto', tgl_pendaftaran='$tgl_pendaftaran'");
if($k){
?>
		
        
        					<script>
							window.location.href='simpan_pendaftaran.php?nik=<?php echo $nik;?>';
							</script>
                            <?php
	
}
	else {
			echo "<div class='exists' style='color:red'>
				  <strong>Maaf!</strong>Proses Simpan Data Gagal.
				  </div>";
				  }
			  
}
$get_nik=$_GET['nik'];
$g=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini_temp where nik='$get_nik'");
$data=mysqli_fetch_array($g);
						?>  					    
						  
                    <div class="card">
			     <div class="card-body">
				   <div class="card-title text-uppercase text-center py-3">Profil Peserta</div>
				   <hr>
                   
				    <form method="post"  enctype="multipart/form-data">
					<div class="form-group">
                    <label for="input-13">Nama Lengkap</label><br><?php echo $data['nama_lengkap'];?>
                    <input name="nama_lengkap" type="text" value="<?php echo $data['nama_lengkap'];?>" style="display:none">
					</div>
										
                                        	<div class="form-group">
                    <label for="input-13">Pengda</label><br><?php echo $data['pengda'];?>
					<input name="pengda" type="text"  style="display:none" value="<?php echo $data['pengda'];?>">
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Tempat Lahir</label><br>
											<?php echo $data['tempat_lahir'];?>
                    <input name="tempat_lahir" type="text"  style="display:none" value="<?php echo $data['tempat_lahir'];?>">

                                            </div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Tgl Lahir</label><br>
											<?php echo $data['tgl_lahir'];?>
                     <input name="tgl_lahir" type="text"  style="display:none" value="<?php echo $data['tgl_lahir'];?>">
                       
                                            </div>
										
											<div class="form-group">
                                            <label for="input-13">NIK</label><br>
											<?php echo $data['nik'];?>
                     <input name="nik" type="text"  style="display:none" value="<?php echo $data['nik'];?>"> 
                                            </div>
                                            
                                            <div class="form-group">
                                            <label for="input-13">No SK Pengangkatan</label><br>
											<?php echo $data['no_sk_pengangkatan'];?>
                        <input name="no_sk_pengangkatan" type="text"  style="display:none" value="<?php echo $data['no_sk_pengangkatan'];?>">
											</div>
											
                                            <div class="form-group">
                                            <label for="input-13">Tgl SK Pengangkatan</label><br>
											<?php echo $data['tgl_sk_pengangkatan'];?>
                      <input name="tgl_sk_pengangkatan" type="text"  style="display:none" value="<?php echo $data['tgl_sk_pengangkatan'];?>">
                      
                                    		</div>
										
										<div class="form-group">
                                             <label for="input-13">NO BA Sumpah</label><br>
											<?php echo $data['no_ba_sumpah'];?>
                        <input name="no_ba_sumpah" type="text"  style="display:none" value="<?php echo $data['no_ba_sumpah'];?>">
                                            </div>
                                            
											<div class="form-group">
                                            <label for="input-13">Tgl BA Sumpah</label><br>
											<?php echo $data['tgl_ba_sumpah'];?>
                        <input name="tgl_ba_sumpah" type="text"  style="display:none" value="<?php echo $data['tgl_ba_sumpah'];?>">
                                            </div>
										
											<div class="form-group">
                                             <label for="input-13">Email</label>  <br>                                          
											<?php echo $data['email'];?>
                         <input name="email" type="text"  style="display:none" value="<?php echo $data['email'];?>">
                                           
											</div>
									
											<div class="form-group">
                                             <label for="input-13">No. HP</label> <br>                                           
											<?php echo $data['hp'];?>
                         <input name="hp" type="text"  style="display:none" value="<?php echo $data['hp'];?>">
											</div>
										
											<div class="form-group">
                                             <label for="input-13">Telp Kantor</label> <br>                                           
											<?php echo $data['telp_kantor'];?>
                         <input name="telp_kantor" type="text"  style="display:none" value="<?php echo $data['telp_kantor'];?>">
											
                                            </div>
										
											<div class="form-group">
                                              <label for="input-13">Alamat Kantor</label><br>                                            
											<?php echo $data['alamat_kantor'];?>
                         <input name="alamat_kantor" type="text"  style="display:none" value="<?php echo $data['alamat_kantor'];?>">

											</div>
										
                                    <div class="card-title text-uppercase text-center py-3">Upload Berkas Notaris</div>
				   							<hr>             
											<div class="form-group">
                                               <label for="input-13">Upload File KTP (PDF max 5mb)</label><br>
											<a target="_blank" href="images/<?php echo $data['file_ktp'];?>"><?php echo $data['file_ktp'];?></a>
                         <input name="file_ktp" type="text"  style="display:none" value="<?php echo $data['file_ktp'];?>">
											
                                            </div>
											
											<div class="form-group">
                                            <label for="input-13">Upload File SK (PDF max 5mb)</label><br>
											<a target="_blank" href="images/<?php echo $data['file_sk'];?>"><?php echo $data['file_sk'];?></a>
	                         <input name="file_sk" type="text"  style="display:none" value="<?php echo $data['file_sk'];?>">

    										</div>
										
											<div class="form-group">
                                            <label for="input-13">Upload File BA (PDF max 5mb)</label><br>
											<a target="_blank" href="images/<?php echo $data['file_ba'];?>"><?php echo $data['file_ba'];?></a>
						                         <input name="file_ba" type="text"  style="display:none" value="<?php echo $data['file_ba'];?>">
					
                                            </div>
										
											<div class="form-group">
                                            <label for="input-13">Upload File FOTO (PDF max 5mb)</label><br>
											<a target="_blank" href="images/<?php echo $data['file_foto'];?>"><?php echo $data['file_foto'];?></a>
						                         <input name="file_foto" type="text"  style="display:none" value="<?php echo $data['file_foto'];?>">
					
                                            </div>

						 <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">DAFTAR</button>
						 
					</form>
				 </div>
			   </div>
                    
                    
				 </div>
				</div>
	    	</div>
	     </div>
	    </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="admin/assets/js/jquery.min.js"></script>
  <script src="admin/assets/js/popper.min.js"></script>
  <script src="admin/assets/js/bootstrap.min.js"></script>
    <!--Select Plugins Js-->
    <script src="admin/assets/plugins/select2/js/select2.min.js"></script>
    <!--Inputtags Js-->
    <script src="admin/assets/plugins/inputtags/js/bootstrap-tagsinput.js"></script>

    <!--Multi Select Js-->
    <script src="admin/assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
    <script src="admin/assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>
    
    <!--Bootstrap Datepicker Js-->
    <script src="admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
      $('#default-datepicker').datepicker({
        todayHighlight: true
      });
      $('#autoclose-datepicker').datepicker({
        autoclose: true,
		format: 'dd-mm-yyyy',
        todayHighlight: true
      });
	  $('#autoclose-datepicker2').datepicker({
        autoclose: true,
		 format: 'dd-mm-yyyy',
        todayHighlight: true
      });
	  $('#autoclose-datepicker3').datepicker({
        autoclose: true,
		format: 'dd-mm-yyyy',
        todayHighlight: true
      });
	  
        $(document).ready(function() {
            $('.single-select').select2();
      
            $('.multiple-select').select2();

        //multiselect start

            $('#my_multi_select1').multiSelect();
            $('#my_multi_select2').multiSelect({
                selectableOptgroup: true
            });

            $('#my_multi_select3').multiSelect({
                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                afterInit: function (ms) {
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

         $('.custom-header').multiSelect({
              selectableHeader: "<div class='custom-header'>Selectable items</div>",
              selectionHeader: "<div class='custom-header'>Selection items</div>",
              selectableFooter: "<div class='custom-header'>Selectable footer</div>",
              selectionFooter: "<div class='custom-header'>Selection footer</div>"
            });



          });

    </script>

<script type="text/javascript">
    function cek_database_pengda(){
        var nama_lengkap = $("#option_s1").val();
        $.ajax({
            url: 'ajax_cek_pengda.php',
            data:"nama_lengkap="+nama_lengkap ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#pengda').val(obj.pengda);
        });
    }
</script> 	
</body>
</html>
