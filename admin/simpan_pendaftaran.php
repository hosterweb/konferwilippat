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
	$kabupaten=$_POST['kabupaten'];
	$nama_ktp=$_POST['file_ktp'];
	$nama_kta=$_POST['file_kta'];
	$nama_sk=$_POST['file_sk'];
	$nama_ba=$_POST['file_ba'];
	$nama_foto=$_POST['file_foto'];
	$tgl_pendaftaran=date("Y-m-d H:i:s");

	$tgl_skg=date("Y-m-d");
	$jangka_waktu = strtotime('+1 days', strtotime($tgl_skg));// jangka waktu + 1 hari
	$tgl_besok=date("Y-m-d",$jangka_waktu). date("H:i:s");//tanggal expired
	$tgl_expired2=date("d-m-Y");
	$jam_expired=date("H:i:s");
	$tgl_expired = date("d-m-Y",$jangka_waktu);//tanggal expired

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
				
				$tiga_angka = sprintf("%03d", $total_peserta);
				$idpendaftaran= $hasil_singkatan.$tiga_angka;
				//tiga_angka = sprintf("%03d", $bilangan);
				
				//$tiga_digit=substr($jam_skg,7);
				$biaya=$bilangan+$total_peserta;
				
				

mysqli_query($koneksi,"INSERT INTO pendaftaran_ini SET nama_lengkap='$nama_lengkap', pengda='$pengda', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nik='$nik', tgl_sk_pengangkatan='$tgl_sk_pengangkatan', no_sk_pengangkatan='$no_sk_pengangkatan', tgl_ba_sumpah='$tgl_ba_sumpah', no_ba_sumpah='$no_ba_sumpah', email='$email' ,hp='$hp', telp_kantor='$telp_kantor', alamat_kantor='$alamat_kantor', kabupaten='$kabupaten', status_pembayaran='0', file_ktp='$nama_ktp', file_sk='$nama_sk', file_ba='$nama_ba' ,file_foto='$nama_foto', file_kta='$nama_kta', tgl_pendaftaran='$tgl_pendaftaran', kta='$kta', kode_kantor='$kode_kantor', tgl_expired='$tgl_besok',biaya='$biaya', id_pendaftaran='$idpendaftaran'");
mysqli_query($koneksi, "DELETE pendaftaran_ini_temp where nik='$nik'");
$k=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where nik='$nik'");
$u=mysqli_fetch_array($k);

date_default_timezone_set('Asia/Jakarta'); // setting time zone;

require_once('PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>Berikut adalah data invoice pendaftaran sbb: </h3>
<table border='0' width='100%'>
<tr><td width='25%'>Nama</td><td>:</td><td>".$u['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$u['pengda']."</td></tr>
<tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".date('d-m-Y', strtotime($u['tgl_pendaftaran']))." ".$jam_expired." WIB</td></tr>
<tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($u['biaya'])."</td></tr>
<tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired." ".$jam_expired." WIB</td></tr></table><br>
Selanjutnya mohon untuk transfer biaya pendaftaran ke <strong>REKENING</strong> di bawah ini:<br>
Bank 		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: BNI<br>
Nomor Account   &nbsp;: 2225588582<br>
Atas Nama       &nbsp;&nbsp;&nbsp;&nbsp;: PENGWIL JAWA TIMUR INI;<br>
<br>				  
Mohon Perhatian:<br>
1.	Melakukan pembayaran sesuai dengan jumlah diatas dengan memperhatikan 3 digit terakhir kode pembayaran, dalam waktu terhitung 1X24 jam <br>
2.	Upload bukti bayar, dengan cara klik tombol UPLOAD BUKTI BAYAR dibawah ini.<br>
3.  Apabila lewat BATAS WAKTU PEMBAYARAN maka pendaftaran online akan hangus, silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com/<br><br>
Informasi Pendaftaran/Contact Person (CP):<br>
1.	 Lily Marinie                : 0812-3057-2377<br>
2.	 Hendrita Vira Yona : 0812-3106-533<br>
<br><br>
Terima kasih atas perhatian dan kerjasamanya.
"; //isi dari email
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
$mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN NOTARIS INDONESIA";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $u['email']; //masukkan penerima
$mail->AddAddress($address, $u['nama_lengkap']); //masukkan penerima

$mail->AddCC('pengwiljatimini@gmail.com', 'Pengwil INI Jatim');

$mail->Send();
?>


<?php
$data["domain"] ="konferwil.pengwiljatimini.com";    //only domain name without http:// or https:// or www.
$data["license"] ="5d42d443a8600 ";
$data["wa_number"] =$u['hp'];     //use format 628xxx (country code first)
//$data["file"]="https://my.woo-wa.com/wp-content/uploads/2019/04/Woowa-Bulat-Hijau-Padding-BG-PUTIH.jpg";    //path of file must be https protocol
//$data["caption"] = "this is caption";    //optional 
$data["text"] ="<h3>*INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN NOTARIS INDONESIA*</h3>
<table border='0' width='100%'>
<tr><td width='25%'>Nama</td><td>:</td><td>".$u['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$u['pengda']."</td></tr>
<tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".date('d-m-Y', strtotime($u['tgl_pendaftaran']))." ".$jam_expired." WIB</td></tr>
<tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($u['biaya'])."</td></tr>
<tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired." ".$jam_expired." WIB</td></tr></table><br><br>
Selanjutnya mohon untuk transfer biaya pendaftaran ke <strong>REKENING</strong> di bawah ini:<br>
Bank 		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: BNI<br>
Nomor Account   &nbsp;: 2225588582<br>
Atas Nama       &nbsp;&nbsp;&nbsp;&nbsp;: PENGWIL JAWA TIMUR INI;<br>
<br>				  
Mohon Perhatian :<br>
1.Segera melakukan pembayaran sesuai dengan jumlah diatas dalam waktu terhitung *1X24 jam.*<br>
2.Apabila lewat *BATAS WAKTU PEMBAYARAN* maka pendaftaran online akan hangus,silahkan mendaftar online kembali ke website www.konferwil.pengwiljatimini.com<br>
<br>
Informasi Pendaftaran/Contact Person(CP):<br>
1.  <br>Lily Marinie             : 0812-3057-2377<br>
2.  <br>Hendrita Vira Yona : 0812-3106-533<br>
<br><br>
*Terima kasih atas perhatian dan kerjasamanya.*
";    //body message same as whatsapp massage, you can use markdown whatsapp 
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
	window.location.href='?page=input_peserta.php';
	</script>