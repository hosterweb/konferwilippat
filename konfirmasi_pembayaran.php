<?php
include "admin/inc/koneksi.php";

$f=$_GET['id'];
$l=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where id_pendaftaran='$f'");
$s=mysqli_fetch_array($l);
if($s['status_expired']==1){
    
?>
	<script>
							alert('Maaf Data anda Sudah Expired. Silakan Melakukan Registrasi Lagi!');
							window.location.href='index.php';
							</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Upload Bukti Bayar Pendaftaran Konferensi Wilayah Jawa Timur IPPAT</title>
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
  <!--Bootstrap Datepicker-->
  <link href="admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
  
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
  
</head>
<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	   <div class="card-authentication2 mx-auto my-3">
	    <div class="card-group">
	    	<div class="card mb-0">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="admin/assets/images/logo_kosong.png" width="125px">
                        <h5 class="text-black">UPLOAD BUKTI BAYAR PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR </h5>
                        <h5 class="text-black">IKATAN PEJABAT PEMBUAT AKTA TANAH (IPPAT)</h5>
					 	</div>
                        <div class="text-dark" align="left" style="background-color:#d7be40; padding:20px">
                <p class="card-text text-black pt-3" align="left"  padding:10px;><strong>Mohon Perhatian :</strong></p>
                 1. Segera melakukan pembayaran dengan <strong>BATAS WAKTU 1X24 jam</strong>, sesuai dengan jumlah yang &nbsp;&nbsp;&nbsp;&nbsp;tertera di email balasan dengan memperhatikan <strong>3 digit terakhir</strong> kode pembayaran.<br>
                 2. Selanjutnya mohon untuk transfer biaya pendaftaran ke rekening:<br>
                 &nbsp;&nbsp;&nbsp;&nbsp;Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <strong>BNI</strong><br>
                 &nbsp;&nbsp;&nbsp;&nbsp;Nomor Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <strong>0650005009</strong><br>
                 &nbsp;&nbsp;&nbsp;&nbsp;Atas Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : IKATAN PEJABAT PEMBUAT AKTA TANAH PERKUMPULAN<br>
                 3. <strong>UPLOAD BUKTI BAYAR</strong> berikut dibawah ini<br>
                 4. Apabila lewat <strong>BATAS WAKTU PEMBAYARAN</strong>, maka pendaftaran online akan hangus, silahkan &nbsp;&nbsp;&nbsp;&nbsp;mendaftar online kembali ke <strong>https://konferwil-jatim-ippat.com/</strong>
                </p>
                <br>
                        </div>
                        <br>
 <?php


				if(isset($_POST['konfirmasi'])){
				$nama_lengkap=$_POST['nama_lengkap'];	
				$pengda=$_POST['pengda'];
				$biaya=$_POST['biaya'];
				$tgl_bayar=$_POST['tgl_lahir'];		
				$id_pendaftaran=$_GET['id'];					
				$file_bukti_pembayaran=$_FILES['file_bukti_pembayaran']['name'];
				$ukuran_file_bukti_pembayaran= $_FILES['file_bukti_pembayaran']['size'];
				//$file_rekom=$_FILES['file_rekom']['name'];
				//$ukuran_file_rekom= $_FILES['file_rekom']['size'];
		
$h=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where where id_pendaftaran='$f'");
$k=mysqli_fetch_array($h);

if($k['id_pendaftaran']==$id){				
$cek_id=mysqli_query($koneksi, "SELECT * FROM bukti_pembayaran where id_pendaftaran='$f'");
$hasil_data=mysqli_num_rows($cek_id);			
if($hasil_data==0){		
				$nama_bukti_pembayaran = $nama_lengkap."- Bukti_Pembayaran - ".$file_bukti_pembayaran;
				//$nama_rekom= $idpendaftaran."- Surat_Rekom - ".$file_rekom;
				
				$ekstensi_diperbolehkan	= array('png','jpg','pdf','jpeg','doc','docx');
				
				$pecah_bukti_pembayaran = explode('.', $nama_bukti_pembayaran);
				$ekstensi_bukti_pembayaran = strtolower(end($pecah_bukti_pembayaran));
	
if(in_array($ekstensi_bukti_pembayaran, $ekstensi_diperbolehkan)=== true){
if($ukuran_file_bukti_pembayaran < 5044070){	
			move_uploaded_file($_FILES['file_bukti_pembayaran']['tmp_name'],'images/'.$nama_bukti_pembayaran);
			//move_uploaded_file($_FILES['file_rekom']['tmp_name'],'../images/'.$nama_rekom);
		
$query=mysqli_query($koneksi, "INSERT INTO bukti_pembayaran SET nama_lengkap='$nama_lengkap',
bukti_pembayaran='$nama_bukti_pembayaran', pengda='$pengda', biaya='$biaya', tgl_bayar='$tgl_bayar', id_pendaftaran='$id_pendaftaran'");


										if($query){		
											?>
							<script>
							alert('Terima Kasih Telah Melakukan Pembayaran, Verifikasi Pembayaran Minimal 1x24 jam. Silakan cek email melalui inbox / spam dan selanjutnya silakan mencetak ID CARD di email balasan.');
							window.location.href='index.php';
							</script>
											<?php	
                                                }
										else{
												echo '<p align="center" style="color:red">GAGAL MENGUPLOAD DOKUMEN</p>';
											}
								}
	                    
								else{
									echo '<p align="center" style="color:red">UKURAN FILE DOKUMEN TERLALU BESAR</p>';
								}
															}
															else{
																echo '<p align="center" style="color:red">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</p>';
															}
}
			else { echo '<p align="center" style="color:red">MAAF ANDA SUDAH MELAKUKAN KONFIRMASI</p>';}
 
			}
			else { echo '<p align="center" style="color:red">MAAF ANDA BELUM MELAKUKAN PENDAFTARAN</p>';}
}

		?>				    
						  
                    <div class="card">
			     <div class="card-body">
				   <div class="card-title text-uppercase text-center py-3">Konfirmasi Pembayaran</div>
				   <hr>
				    <form method="post"  enctype="multipart/form-data">
                   <div class="form-group">
                                            <label for="input-13">Nama Lengkap(*)</label>
							<select class="form-control single-select text-uppercase" onchange="cek_database_pengda()" id="option_s1" name="nama_lengkap" required>
                             <option selected value="<?php echo $s['nama_lengkap'];?>"><?php echo $s['nama_lengkap'];?></option>
                        	</select>
											</div>
										
                                        	<div class="form-group">
                                            <label for="input-13">Pengda(*)</label>
<input type="text" name="pengda" id="pengda" value="<?php echo $s['pengda'];?>" class="form-control text-uppercase required" placeholder="Pengda" required readonly>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Biaya Pendaftaran</label>
<input type="text" name="biaya"  value="<?php echo $s['biaya'];?>" readonly class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Biaya Pendaftaran" required>
											</div>
										
                                        	<div class="form-group">
<label for="input-13">Tanggal Pembayaran (DD/MM/YYYY)*</label>
<input type="text" name="tgl_lahir" class="form-control"  value="<?php if(!(empty($tgl_pembayaran))){ echo $tgl_pembayaran; };?>" id="autoclose-datepicker" required>
											</div>
										
											<div class="form-group">
                                            <label for="input-13">Upload Bukti Pembayaran</label>
								 <input type="file" class="form-control" id="file_bukti_pembayaran" name="file_bukti_pembayaran" maxlength="16" placeholder="File Rekomendasi Pengda" value="<?php if(!empty($file_bukti_pembayaran)){ echo $file_bukti_pembayaran; }?>" required>	
											</div>

											
					
						 <button type="submit" value="konfirmasi" value="konfirmasi" name="konfirmasi" class="btn btn-outline-primary btn-block waves-effect waves-light">KONFIRMASI</button>
						 
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
		startDate: "23-09-1954",
        endDate: "24-01-2022",
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
	var inputQuantity = [];
    $(function() {
      $("#quantity").each(function(i) {
        inputQuantity[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $("#quantity").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 16);
          $field.val(val);
        }
        inputQuantity[$thisIndex]=val;
      });      
    });


var inputQuantity2 = [];
    $(function() {
      $("#quantity2").each(function(i) {
        inputQuantity2[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $("#quantity2").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity2[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 12);
          $field.val(val);
        }
        inputQuantity2[$thisIndex]=val;
      });      
    });
	
	var inputQuantity3 = [];
    $(function() {
      $("#quantity3").each(function(i) {
        inputQuantity3[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $("#quantity3").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity3[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 12);
          $field.val(val);
        }
        inputQuantity3[$thisIndex]=val;
      });      
    });

var inputQuantity4 = [];
    $(function() {
      $("#quantity4").each(function(i) {
        inputQuantity4[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $("#quantity4").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity4[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 5);
          $field.val(val);
        }
        inputQuantity4[$thisIndex]=val;
      });      
    });
	
	var inputQuantity5 = [];
    $(function() {
      $("#quantity5").each(function(i) {
        inputQuantity5[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $("#quantity5").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity5[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 5);
          $field.val(val);
        }
        inputQuantity5[$thisIndex]=val;
      });      
    });
</script>

<script>
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
} 
</script>	
</body>
</html>
