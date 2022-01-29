<?php
//error_reporting(1);
$nama=$_SESSION['nama'];
$id_pendaftaran=$_GET['id_pendaftaran'];

	$a=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran'");
	$b=mysqli_fetch_array($a);
	
$nama_peserta=$b['nama_lengkap'];
$tgl_validasi=date("d-m-Y H:i:s");
$konten="Kirim Ulang Email dan WA";
mysqli_query($koneksi, "INSERT INTO userlog SET operator='$nama', peserta='$nama_peserta', aktifitas='$konten', tgl='$tgl_validasi'");	


$key='de74023993da56ebf427ad67914c3593c1a369c937e159e6'; //this is demo key please change with your own key
$url='http://116.203.191.58/api/send_message';
$hpne= $b['hp'];
$data = array(
  "phone_no"  => $hpne,
  "key"       => $key,
  "message"   => "*SELAMAT*
Anda  telah terdaftar sebagai PESERTA Konferensi Wilayah Jawa Timur  IKATAN PEJABAT PEMBUAT AKTA TANAH

Id Pendaftaran  : $b[id_pendaftaran]
Nama            : $b[nama_lengkap]
Pengda          : $b[pengda]

Silahkan mencetak Tanda Peserta (ID Card) anda. https://konferwil-jatim-ippat.com//kartu_peserta.php?id=$b[id_pendaftaran]
*Harap CETAK ID CARD DENGAN KERTAS HVS*

Pada saat registrasi ulang mohon membawa:
1. Asli KTP;
2. Asli Bukti Bayar;
3. Tanda Peserta (ID Card);
4. Membawa Hasil Antigen dan Memakai Masker;

Terima kasih atas perhatian dan kerjasamanya",
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

require_once('../PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>SELAMAT! </h3>
<h5>Anda  telah terdaftar sebagai 

PESERTA Konferensi Wilayah Jawa Timur  IKATAN PEJABAT PEMBUAT AKTA TANAH</h5>
<table border='0' 

width='100%'>
<tr><td width='25%'>Id Pendaftaran</td><td>:</td><td>".$b['id_pendaftaran']."</td></tr>
<tr><td width='25%'>Nama</td><td>:</td><td>".$b['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$b['pengda']."</td></tr>
</table><br>
Silahkan mencetak Tanda Peserta (ID Card) anda.  <a href='https://konferwil-jatim-ippat.com//kartu_peserta.php?id=".$b['id_pendaftaran']."'><input type='button' value='Cetak Kartu Peserta'></a>
<h6><b>Harap CETAK ID CARD DENGAN KERTAS HVS.</b></h6>
Jangan menggunakan KERTAS FOTO/GLOSSY</b></h6>
<br>
Pada saat registrasi ulang mohon membawa:<br>
<strong>
1.	Asli KTP;<br>
2.	Asli Bukti Bayar;<br>
3.	Tanda Peserta (ID Card);<br>
4.  Membawa Hasil Antigen dan Memakai Masker;
</strong>
<br>
Terima kasih atas perhatian dan kerjasamanya.<br>"; //isi dari email
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
$mail->SetFrom('info@konferwil-jatim-ippat.com', 'Admin Konferwil Jatim INI'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN PEJABAT PEMBUAT AKTA TANAH";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $b['email']; //masukkan penerima
$mail->AddAddress($address, $b['nama_lengkap']); //masukkan penerima

$mail->AddCC('info@konferwil-jatim-ippat.com', 'Pengwil IPPAT Jatim');

$mail->Send();
header("Location: https://konferwil-jatim-ippat.com/admin/?page=konfirmasi_peserta");
?>

