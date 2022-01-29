<?php
error_reporting(1);
include "admin/inc/koneksi.php";


	$id_pendaftaran=$_GET['id_pendaftaran'];	
	$a=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran'");
	$b=mysqli_fetch_array($a);
	
	mysqli_query($koneksi, "UPDATE pendaftaran_ini SET status_pembayaran='1' where id_pendaftaran='$id_pendaftaran'");

date_default_timezone_set('Asia/Jakarta'); // setting time zone;

require_once('PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>SELAMAT! </h3>
<h5>Anda  telah terdaftar sebagai PESERTA Konferensi Wilayah Jawa Timur  IKATAN NOTARIS INDONESIA</h5>
<table border='0' width='100%'>
<tr><td width='25%'>Id Pendaftaran</td><td>:</td><td>".$b['id_pendaftaran']."</td></tr>
<tr><td width='25%'>Nama</td><td>:</td><td>".$b['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$b['pengda']."</td></tr>
</table><br>
SILAHKAN KLIK DAN SIMPAN ID CARD ANDA dengan klik link dibawah ini<br>  <a href='http://konferwil.pengwiljatimini.com/konfirmasi_pembayaran.php?id=".$u['id_pendaftaran']."'><input type='button' value='Konfirmasi Pembayaran'></a>
<h6><b>
Harap CETAK ID CARD DENGAN KERTAS BC/buffalo putih 100gram.
Jangan menggunakan KERTAS FOTO/GLOSSY</b></h6>
<br>
Pada saat registrasi ulang mohon membawa:<br>
<strong>1.	Asli KTP;<br>
2.	Asli Bukti Bayar;<br>
3.	Tanda Peserta (ID Card);<br></strong>
<br>
Terima kasih atas perhatian dan kerjasamanya.<br>"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 0;                     // mengaktifkan debug mode (untuk ujicoba)
                                           // 1 = Error dan pesan
                                           // 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "ssl";                 // jenis kemananan
$mail->Host       = "smtp.gmail.com";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "465";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "pengwiljatimini@gmail.com";  // GMAIL username
$mail->Password   = "Userloginadmin1234";            // GMAIL password
$mail->SetFrom('pengwiljatimini@gmail.com', 'Admin Konferwil Jatim INI'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN NOTARIS INDONESIA";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $b['email']; //masukkan penerima
$mail->AddAddress($address, $b['nama_lengkap']); //masukkan penerima

$mail->AddCC('pengwiljatimini@gmail.com', 'Admin Konferwil Jatim INI');

$mail->Send();
?>


<?php
$data["domain"] ="konferwil.pengwiljatimini.com";    //only domain name without http:// or https:// or www.
$data["license"] ="5d42d443a8600 ";
$data["wa_number"] =$u['hp'];     //use format 628xxx (country code first)
//$data["file"]="https://my.woo-wa.com/wp-content/uploads/2019/04/Woowa-Bulat-Hijau-Padding-BG-PUTIH.jpg";    //path of file must be https protocol
//$data["caption"] = "this is caption";    //optional 
$data["text"] ="<h3>SELAMAT!</h3>
<h5>Anda  telah terdaftar sebagai PESERTA Konferensi Wilayah Jawa Timur  IKATAN NOTARIS INDONESIA</h5>
<table border='0' width='100%'>
<tr><td width='25%'>Id Pendaftaran</td><td>:</td><td>".$b['id_pendaftaran']."</td></tr>
<tr><td width='25%'>Nama</td><td>:</td><td>".$b['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$b['pengda']."</td></tr>
</table><br>
*SILAHKAN KLIK DAN SIMPAN ID CARD ANDA* dengan klik link dibawah ini.<br><a href='http://konferwil.pengwiljatimini.com/konfirmasi_pembayaran.php?id=".$u['id_pendaftaran']."'><input type='button' value='Konfirmasi Pembayaran'></a>
<h6><b>
Harap CETAK ID CARD DENGAN KERTAS BC/buffalo putih 100gram.
Jangan menggunakan KERTAS FOTO/GLOSSY</b></h6>
<br>
Pada saat registrasi ulang mohon membawa:<br>
<strong>1.	Asli KTP;<br>
2.	Asli Bukti Bayar;<br>
3.	Tanda Peserta (ID Card);<br></strong>
<br>
Terima kasih atas perhatian dan kerjasamanya.<br>";    //body message same as whatsapp massage, you can use markdown whatsapp 
$data["mode"] ="sync";    //optional, if you want to detect number unregistered by WA. response `number_not_found` (take more time) 

$url="http://api.woo-wa.com/v2.0/send-message"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$err = curl_error($ch);
curl_close ($ch);
?>

	<script>
	window.location.href='?page=konfirmasi_peserta.php';
	</script>