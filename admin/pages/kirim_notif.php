 <?php
//error_reporting(1);
$id_pendaftaran=$_GET['id_pendaftaran'];
$nama=$_SESSION['nama'];

	$id_pendaftaran=$_GET['id_pendaftaran'];	
	$a=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran'");
	$b=mysqli_fetch_array($a);

$data_tgl_pendaftaran=$b['tgl_pendaftaran'];
$pecah_tgl_pendaftaran = explode(' ', $data_tgl_pendaftaran);
$hasil_tgl_pendaftaran=$pecah_tgl_pendaftaran[0];
$hasil_jam_pendaftaran=$pecah_tgl_pendaftaran[1];
$tgl_pendaftaran=date('d-m-Y', strtotime('$pecah_tgl_pendaftaran[0]'));

$pecah_tgl_pendaftaran1 = explode('-', $hasil_tgl_pendaftaran);
$tgl_pendaftaran_tahun=$pecah_tgl_pendaftaran1[0];
$tgl_pendaftaran_bulan=$pecah_tgl_pendaftaran1[1];
$tgl_pendaftaran_hari=$pecah_tgl_pendaftaran1[2];
$tgl_pendaftaran_baru=$tgl_pendaftaran_hari."-". $tgl_pendaftaran_bulan."-" .$tgl_pendaftaran_tahun;


$data_tgl_expired=$b['tgl_expired'];
$pecah_tgl_expired = explode(' ', $data_tgl_expired);
$hasil_tgl_expired=$pecah_tgl_expired[0];
$hasil_jam_expired=$pecah_tgl_expired[1];
$tgl_expired=date('d-m-Y', strtotime('$pecah_tgl_expired[0]'));

$pecah_tgl_expired1 = explode('-', $hasil_tgl_expired);
$tgl_expired_tahun=$pecah_tgl_expired1[0];
$tgl_expired_bulan=$pecah_tgl_expired1[1];
$tgl_expired_hari=$pecah_tgl_expired1[2];
$tgl_expired_baru=$tgl_expired_hari."-" .$tgl_expired_bulan."-" .$tgl_expired_tahun;
	
$nama_peserta=$b['nama_lengkap'];
$tgl_validasi=date("d-m-Y H:i:s");
$konten="Kirim Ulang Email dan WA";
mysqli_query($koneksi, "INSERT INTO userlog SET operator='$nama', peserta='$nama_peserta', aktifitas='$konten', tgl='$tgl_validasi'");	

$key='de74023993da56ebf427ad67914c3593c1a369c937e159e6'; //this is demo key please change with your own key
$url='http://116.203.191.58/api/send_message';
$hpne= $b['hp'];     //use format 628xxx (country code first)
//$data["file"]="https://my.woo-wa.com/wp-content/uploads/2019/04/Woowa-Bulat-Hijau-Padding-BG-PUTIH.jpg";    //path of file must be https protocol
//$data["caption"] = "this is caption";    //optional 
$data = array(
  "phone_no"  => $hpne,
  "key"       => $key,
  "message"   => " *SELAMAT PENDAFTARAN ONLINE BERHASIL*
*TERIMA KASIH TELAH MENDAFTAR*
            
Silakan *CEK EMAIL INBOX/SPAM*, Lakukan pembayaran dengan jumlah dan nomer rekening yang tertera di email balasan,dan segera *UPLOAD BUKTI BAYAR*, dengan cara klik link *UPLOAD BUKTI BAYAR* diemail balasan.
            
*BATAS WAKTU* maximal 1x24 jam,apabila lewat batas waktu tersebut pendaftaran online hangus silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com
            
Menunggu *VERIFIKASI PEMBAYARAN* minimal 1x24 jam, dan selanjutnya cek EMAIL balasan di inbox/spam untuk mencetak *ID CARD*",
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


date_default_timezone_set('Asia/Jakarta'); // setting time zone;

require_once('../PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>Berikut adalah data invoice pendaftaran sbb: </h3>
<table border='0' width='70%'>
<tr><td width='25%'>Nama</td><td>:</td><td>".$b['nama_lengkap']."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$b['pengda']."</td></tr>
<tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".$tgl_pendaftaran_baru." ".$hasil_jam_pendaftaran." WIB</td></tr>
<tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($b['biaya'])."</td></tr>
<tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired_baru." ".$hasil_jam_expired."  WIB</td></tr>
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
<a href='http://konferwil-jatim-ippat.com/konfirmasi_pembayaran.php?id=".$b['id_pendaftaran']."'><input type='button' value='UPLOAD BUKTI BAYAR'></a></td></tr>
<tr><td width='3%'>2.</td><td>Menunggu VERIFIKASI PEMBAYARAN minimal 1x24 jam.<br>
<tr><td width='3%'>3.</td><td>Silakan cek EMAIL balasan  di inbox/spam untuk mencetak ID CARD</td></tr>
<tr><td width='3%'>4.</td><td>Apabila PEMBAYARAN dan UPLOAD BUKTI BAYAR lewat 1X24 jam, maka pendaftaran online akan hangus, silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com.com</td></tr>
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
$mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN PEJABAT PEMBUAT AKTA TANAH";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $b['email']; //masukkan penerima
$mail->AddAddress($address, $b['nama_lengkap']); //masukkan penerima

$mail->AddCC('info@konferwil-jatim-ippat.com', 'Pengwil IPPAT Jatim');

$mail->Send();
header("Location: https://konferwil-jatim-ippat.com/admin/?page=data_peserta");

?>