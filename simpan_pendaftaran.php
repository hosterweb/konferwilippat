
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Sistem Pendaftaran Konferensi Wilayah Jawa Timur Ikatan Notaris Indonesia"/>
  <meta name="author" content=""/>
  <title>Pendaftaran Konferensi Wilayah Jawa Timur IPPAT</title>
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
<?php
error_reporting(1);
include "admin/inc/koneksi.php";


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
	$hp=$_POST['hp'];
	$kode_kantor=$_POST['kode_kantor'];
	$telp_kantor=$_POST['telp_kantor'];
	$alamat_kantor=$_POST['alamat_kantor'];
	//$kabupaten=$_POST['kabupaten'];
	$nama_ktp=$_POST['file_ktp'];
	$nama_kta=$_POST['file_kta'];
	$nama_sk=$_POST['file_sk'];
	$nama_ba=$_POST['file_ba'];
	$nama_foto=$_POST['file_foto'];
	$tgl_pendaftaran=date("Y-m-d H:i:s");
	
	if(empty($nik))
	{
		echo "<script>
							alert('Data Anda Sudah Kami Terima Dan Status Pendaftaran Anda Masih Aktif Segera Lakukan Pembayaran Sebelum Batas Waktu Berakhir,');
							window.location.href='index.php';
							</script>";
	}
else {
     $z=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini WHERE nik = '$nik'");
 		    $u1=mysqli_fetch_array($z);
 		    
$cek_dobel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini WHERE nik = '$nik'"));
 		   
            $status_expirede=$u1['status_expired'];
		if ( $cek_dobel > 0 ){
		        if($u1['status_expired'] = 0){
		    	echo "<script>
							alert('Data Anda Sudah Kami Terima Dan Status Pendaftaran Anda Masih Aktif Segera Lakukan Pembayaran Sebelum Batas Waktu Berakhir,');
							window.location.href='index.php';
							</script>";
		        }
		 else {       
            $tgl_skg=date("Y-m-d");
	        $jangka_waktu = strtotime('+1 days', strtotime($tgl_skg));// jangka waktu + 1 hari
	        $tgl_besok=date("Y-m-d ",$jangka_waktu).date("H:i:s");//tanggal expired

            $tgl_expired2=date("d-m-Y");
        	$jam_expired=date("H:i:s");
	        $tgl_expired = date("d-m-Y ",$jangka_waktu);//tanggal expired

            mysqli_query($koneksi, "UPDATE pendaftaran_ini SET status_expired='0', tgl_expired='$tgl_besok', email='$email', hp='$hp' WHERE nik='$nik'");   
            date_default_timezone_set('Asia/Jakarta'); // setting time zone;

            require_once('PHPMailer/PHPMailerAutoload.php');    
            $mail             = new PHPMailer();
            $body             = "
            <h3>Berikut adalah data invoice pendaftaran sbb: </h3>
            <table border='0' width='70%'>
            <tr><td width='25%'>Nama</td><td>:</td><td>".$u1['nama_lengkap']."</td></tr>
            <tr><td width='25%'>Pengda</td><td>:</td><td>".$u1['pengda']."</td></tr>
            <tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".$u1['tgl_pendaftaran']." WIB</td></tr>
            <tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($u1['biaya'])."</td></tr>
            <tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired." ".$jam_expired."  WIB</td></tr>
            <tr><td colspan='3'><br></td></tr>
            <tr><td colspan='3'>Selanjutnya mohon untuk transfer biaya pendaftaran ke <strong>REKENING</strong> di bawah ini:</td></tr><br>
            <tr><td width='25%'><strong>BANK</strong></td><td>:</td><td><strong>BNI</strong></td></tr>
            <tr><td width='25%'><strong>No.Account</strong></td><td>:</td><td><strong>0650005009</strong></td></tr>
            <tr><td width='25%'><strong>Atas Nama</strong></td><td>:</td><td><strong>IKATAN PEJABAT PEMBUAT AKTA TANAH PERKUMPULAN</strong></td></tr>
            </table>
            <br>			
            <table border='0' width='70%'>
            <tr><td colspan='2'>Mohon Perhatian:</td></tr>
            <tr><td width='3%'>1.</td><td>Melakukan pembayaran sesuai dengan jumlah diatas dengan memperhatikan 3 digit terakhir kode pembayaran, dan segera upload bukti bayar, dengan cara klik tombol UPLOAD BUKTI BAYAR dibawah ini, dalam waktu terhitung 1X24 jam
            <br><a href='http://konferwil-jatim-ippat.com/konfirmasi_pembayaran.php?id=".$u1['id_pendaftaran']."'><input type='button' value='UPLOAD BUKTI BAYAR'></a>
            </td></tr>
            <tr><td width='3%'>2.</td><td>Menunggu VERIFIKASI PEMBAYARAN minimal 1x24 jam.<br>
            </td></tr>
            <tr><td width='3%'>3.</td><td>Silakan cek EMAIL balasan  di inbox/spam untuk mencetak ID CARD</td></tr>
            <tr><td width='3%'>4.</td><td>Apabila PEMBAYARAN dan UPLOAD BUKTI BAYAR lewat 1X24 jam, maka pendaftaran online akan hangus, silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com</td></tr>
            </table><br>
            Terima kasih atas perhatian dan kerjasamanya.<br>
            "; //isi dari email
            $mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
            $mail->SMTPDebug  = 0;                     // mengaktifkan debug mode (untuk ujicoba)
                                                       // 1 = Error dan pesan
                                                       // 2 = Pesan saja
            $mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
            $mail->SMTPSecure = "TLS";                 // jenis kemananan
            $mail->Host       = "smtp.gmail.com";      // masukkan GMAIL sebagai smtp server
            $mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
            $mail->Username   = "info@konferwil-jatim-ippat.com";  // GMAIL username
            $mail->Password   = "LoginMasuk*123";            // GMAIL password
            $mail->SetFrom('info@konferwil-jatim-ippat.com', 'Admin Konferwil Jatim IPPAT'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
            $mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IPPAT";//masukkan subject
            $mail->MsgHTML($body);//masukkan isi dari email
            
            $address = $u1['email']; //masukkan penerima
            $mail->AddAddress($address, $u1['nama_lengkap']); //masukkan penerima
            
            $mail->AddCC('info@konferwil-jatim-ippat.com', 'Pengwil IPPAT Jatim');
            
            $mail->Send();
            
            //send wa
            $key='de74023993da56ebf427ad67914c3593c1a369c937e159e6'; //this is demo key please change with your own key
$url='http://116.203.191.58/api/send_message';
$hpne=$u1['hp'];
$data = array(
  "phone_no"  => $hpne,
  "key"       => $key,
  "message"   => '*SELAMAT PENDAFTARAN ONLINE BERHASIL*
*TERIMA KASIH TELAH MENDAFTAR*
            
Silakan *CEK EMAIL INBOX/SPAM*, Lakukan pembayaran dengan jumlah dan nomer rekening yang tertera di email balasan,dan segera *UPLOAD BUKTI BAYAR*, dengan cara klik link *UPLOAD BUKTI BAYAR* diemail balasan.
            
*BATAS WAKTU* maximal 1x24 jam,apabila lewat batas waktu tersebut pendaftaran online hangus silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com
            
Menunggu *VERIFIKASI PEMBAYARAN* minimal 1x24 jam, dan selanjutnya cek EMAIL balasan di inbox/spam untuk mencetak *ID CARD*
            ',
  "skip_link" => False // This optional for skip snapshot of link in message
);
$data_string = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 360);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($data_string))
);
echo $res=curl_exec($ch);
curl_close($ch);
            
            	
            			echo "<script>
            							alert('Terima Kasih Data Anda Sudah Aktif Kembali. Segera Cek Email Inbox/Spam Anda Untuk Konfirmasi Pembayaran ');
            							window.location.href='index.php';
            							</script>";
            		} }
else {
	$tgl_skg=date("Y-m-d");
	$jangka_waktu = strtotime('+1 days', strtotime($tgl_skg));// jangka waktu + 1 hari
	$tgl_besok=date("Y-m-d ",$jangka_waktu).$spasi. date("H:i:s");//tanggal expired
	$tgl_expired2=date("d-m-Y");
	$jam_expired=date("H:i:s");
	$tgl_expired = date("d-m-Y ",$jangka_waktu);//tanggal expired

$pecahhp1 = explode('62', $hp);
$pecah_hp = strtolower(end($pecahhp1));
$j1=$pecah_hp['3'].$pecah_hp['4'].$pecah_hp['5'].$pecah_hp['6'];
$j2=date("dHis");
$va="98800412".$j2;
$trx_id=date("dm").$j1;

//genereta kode unik dan nomor pendaftaran
				$hasil_singkatan=substr($nama_lengkap,00,001);
								
				$bilangan="499000"; // Nilai Proses
				$aa=mysqli_query($koneksi,"SELECT count(*) as total from pendaftaran_ini");
				$ba=mysqli_fetch_array($aa);
				$total_peserta=$ba['total']+1;
				
				$tiga_angka = sprintf("%04d", $total_peserta);
				$idpendaftaran= $hasil_singkatan.$tiga_angka;
				//tiga_angka = sprintf("%03d", $bilangan);
				
				//$tiga_digit=substr($jam_skg,7);
				$biaya=$bilangan+$total_peserta;
				
				

mysqli_query($koneksi,"INSERT INTO pendaftaran_ini SET nama_lengkap='$nama_lengkap', pengda='$pengda', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nik='$nik', tgl_sk_pengangkatan='$tgl_sk_pengangkatan', no_sk_pengangkatan='$no_sk_pengangkatan', tgl_ba_sumpah='$tgl_ba_sumpah', no_ba_sumpah='$no_ba_sumpah', email='$email' ,hp='$hp', telp_kantor='$telp_kantor', alamat_kantor='$alamat_kantor', status_pembayaran='0', file_ktp='$nama_ktp', file_sk='$nama_sk', file_ba='$nama_ba' ,file_foto='$nama_foto', file_kta='$nama_kta', tgl_pendaftaran='$tgl_pendaftaran', kta='$kta', kode_kantor='$kode_kantor', tgl_expired='$tgl_besok',biaya='$biaya', id_pendaftaran='$idpendaftaran', status_pendaftaran='peserta', status_expired='0'");
mysqli_query($koneksi, "DELETE pendaftaran_ini_temp where nik='$nik'");
$k=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where nik='$nik'");
$u=mysqli_fetch_array($k);

date_default_timezone_set('Asia/Jakarta'); // setting time zone;

require_once('PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>Berikut adalah data invoice pendaftaran sbb: </h3>
<table border='0' width='70%'>
<tr><td width='25%'>Nama</td><td>:</td><td>".$u['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$u['pengda']."</td></tr>
<tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".date('d-m-Y', strtotime($u['tgl_pendaftaran']))." ".$jam_expired." WIB</td></tr>
<tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($u['biaya'])."</td></tr>
<tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired." ".$jam_expired." WIB</td></tr>
<tr><td colspan='3'><br></td></tr>
<tr><td colspan='3'>Selanjutnya mohon untuk transfer biaya pendaftaran ke <strong>REKENING</strong> di bawah ini:</td></tr><br>
<tr><td width='25%'><strong>BANK</strong></td><td>:</td><td><strong>BNI</strong></td></tr>
<tr><td width='25%'><strong>No.Account</strong></td><td>:</td><td><strong>0650005009</strong></td></tr>
<tr><td width='25%'><strong>Atas Nama</strong></td><td>:</td><td><strong>IKATAN PEJABAT PEMBUAT AKTA TANAH PERKUMPULAN</strong></td></tr>
</table>
<br>			
<table border='0' width='70%'>
<tr><td colspan='2'>Mohon Perhatian:</td></tr>
<tr><td width='3%'>1.</td><td>Melakukan pembayaran sesuai dengan jumlah diatas dengan memperhatikan 3 digit terakhir kode pembayaran, dan segera upload bukti bayar, dengan cara klik tombol UPLOAD BUKTI BAYAR dibawah ini, dalam waktu terhitung 1X24 jam<br>
<a href='https://konferwil-jatim-ippat.com/konfirmasi_pembayaran.php?id=".$u['id_pendaftaran']."'><input type='button' value='UPLOAD BUKTI BAYAR'></a></td></tr>
<tr><td width='3%'>2.</td><td>Menunggu VERIFIKASI PEMBAYARAN minimal 1x24 jam.<br>
<tr><td width='3%'>3.</td><td>Silakan cek EMAIL balasan  di inbox/spam untuk mencetak ID CARD</td></tr>
<tr><td width='3%'>4.</td><td>Apabila PEMBAYARAN dan UPLOAD BUKTI BAYAR lewat 1X24 jam, maka pendaftaran online akan hangus, silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com</td></tr>
</table><br>
Terima kasih atas perhatian dan kerjasamanya.<br>
"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 0;                     // mengaktifkan debug mode (untuk ujicoba)
                                           // 1 = Error dan pesan
                                           // 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "tls";                 // jenis kemananan
$mail->Host       = "smtp.gmail.com";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "info@konferwil-jatim-ippat.com";  // GMAIL username
$mail->Password   = "LoginMasuk*123";            // GMAIL password
$mail->SetFrom('info@konferwil-jatim-ippat.com', 'Admin Konferwil Jatim IPPAT'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IPPAT";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $u['email']; //masukkan penerima
$mail->AddAddress($address, $u['nama_lengkap']); //masukkan penerima

$mail->AddCC('info@konferwil-jatim-ippat.com', 'Pengwil IPPAT Jatim');

$mail->Send();
?>


<?php
$key='de74023993da56ebf427ad67914c3593c1a369c937e159e6'; //this is demo key please change with your own key
$url='http://116.203.191.58/api/send_message';
$hpne=$u['hp'];
$data = array(
  "phone_no"  => $hpne,
  "key"       => $key,
  "message"   => '*SELAMAT PENDAFTARAN ONLINE BERHASIL*
*TERIMA KASIH TELAH MENDAFTAR*
            
Silakan *CEK EMAIL INBOX/SPAM*, Lakukan pembayaran dengan jumlah dan nomer rekening yang tertera di email balasan,dan segera *UPLOAD BUKTI BAYAR*, dengan cara klik link *UPLOAD BUKTI BAYAR* diemail balasan.
            
*BATAS WAKTU* maximal 1x24 jam,apabila lewat batas waktu tersebut pendaftaran online hangus silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com
            
Menunggu *VERIFIKASI PEMBAYARAN* minimal 1x24 jam, dan selanjutnya cek EMAIL balasan di inbox/spam untuk mencetak *ID CARD*
            ',
  "skip_link" => False // This optional for skip snapshot of link in message
);
$data_string = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 360);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($data_string))
);
echo $res=curl_exec($ch);
curl_close($ch);
?>

<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script>
			$(document).ready(function(){
				window.setInterval(function () {
					var sisawaktu = $("#waktu").html();
					sisawaktu = eval(sisawaktu);
					if (sisawaktu == 0) {
						location.href = "http://konferwil-jatim-ippat.com";
					} else {
						$("#waktu").html(sisawaktu - 1);
					}
				}, 1000);
			});
		</script>
        
<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	   <div class="card-authentication2 mx-auto my-3">
	    <div class="card-group">
	    	<div class="card mb-0">
	    	   <!-- <div class="bg-signup2"></div> -->
	    		<div class="text-dark" align="left" style="background-color:#d7be40; padding:20px">
                 <h3 class="text-black">Mohon Perhatian :</h3>
                 <h3 class="text-black">=================</h3>
                 <p style="text-align: justify;">
                 1.Segera melakukan pembayaran sesuai dengan &nbsp;&nbsp;jumlah dan nomor rekening yang tertera di email &nbsp;&nbsp;balasan sampai dengan batas waktu 1X24 jam </p><br>
                 <p style="text-align: justify;">2.Apabila lewat <strong>BATAS WAKTU PEMBAYARAN</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;maka pendaftaran online akan hangus, silakan <br>&nbsp;&nbsp;&nbsp;&nbsp;mendaftar online kembali ke www.konferwil-jatim-ippat.com
                 </p>
             </div>
	    	</div>

	    	<div class="card mb-0">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="admin/assets/images/logo_kosong.png" width="125px">
					 	</div>  
                    <div class="card">
			     <div class="card-body">
				   <div class="card-title text-uppercase text-center py-3">PENDAFTARAN ONLINE BERHASIL</div>
				   <hr>
<p align="center">                   
SILAKAN CEK EMAIL INBOX/SPAM<br>
LAKUKAN PEMBAYARAN DENGAN JUMLAH DAN REKENING YANG TERTERA DI EMAIL BALASAN.
BATAS MAKSIMAL PEMBAYARAN 1x24 JAM
</p><p align="left">
</p>
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
<?php }}?>