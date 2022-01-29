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
								
				$bilangan="500000"; // Nilai Proses
				$aa=mysqli_query($koneksi,"SELECT count(*) as total from pendaftaran_ini");
				$ba=mysqli_fetch_array($aa);
				$total_peserta=$ba['total']+1;
				
				$tiga_angka = sprintf("%04d", $total_peserta);
				$idpendaftaran= $hasil_singkatan.$tiga_angka;
				//tiga_angka = sprintf("%03d", $bilangan);
				
				//$tiga_digit=substr($jam_skg,7);
				$biaya=$bilangan+$total_peserta;
			
  $wz=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini WHERE nik = '$nik'");
  $wu=mysqli_num_rows($wz);

	if($wu > 0)
	{
		echo "<script>
							alert('Peserta Sudah Terdaftar Dengan Nomor NIK Yang Anda Masukkan ');
							window.location.href='?page=input_peserta';
							</script>";
	}
else {
    
	if(empty($nik))
	{
		echo "<script>
							alert('Dilarang mereload halaman ini!');
							window.location.href='?page=home';
							</script>";
	}
else {
mysqli_query($koneksi,"INSERT INTO pendaftaran_ini SET nama_lengkap='$nama_lengkap', pengda='$pengda', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nik='$nik', tgl_sk_pengangkatan='$tgl_sk_pengangkatan', no_sk_pengangkatan='$no_sk_pengangkatan', tgl_ba_sumpah='$tgl_ba_sumpah', no_ba_sumpah='$no_ba_sumpah', email='$email' ,hp='$hp', telp_kantor='$telp_kantor', alamat_kantor='$alamat_kantor', kabupaten='$kabupaten', status_pembayaran='0', file_ktp='$nama_ktp', file_sk='$nama_sk', file_ba='$nama_ba' ,file_foto='$nama_foto', file_kta='$nama_kta', tgl_pendaftaran='$tgl_pendaftaran', kta='$kta', kode_kantor='$kode_kantor', tgl_expired='$tgl_besok',biaya='$bilangan', id_pendaftaran='$idpendaftaran', status_pendaftaran='peserta_pensiun'");
mysqli_query($koneksi, "DELETE FROM pendaftaran_ini_temp WHERE nik='$nik'");
$k=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where nik='$nik'");
$u=mysqli_fetch_array($k);

date_default_timezone_set('Asia/Jakarta'); // setting time zone;

require_once('../PHPMailer/PHPMailerAutoload.php');
$mail             = new PHPMailer();
$body             = "
<h3>Berikut adalah data invoice pendaftaran sbb: </h3>
<table border='0' width='100%'>
<tr><td width='25%'>Nama</td><td>:</td><td>".$nama_lengkap."</td></tr>
<tr><td width='25%'>Pengda</td><td>:</td><td>".$pengda."</td></tr>
<tr><td width='25%'>Tanggal Registrasi</td><td>:</td><td>".date('d-m-Y', strtotime($u['tgl_pendaftaran']))." ".$jam_expired." WIB</td></tr>
<tr><td width='25%'>Biaya Pendaftaran</td><td>:</td><td>Rp. ".number_format($bilangan)."</td></tr>
<tr><td width='25%'>Batas Waktu Pembayaran</td><td>:</td><td>".$tgl_expired." ".$jam_expired." WIB</td></tr></table><br>
Selanjutnya mohon untuk transfer biaya pendaftaran ke <strong>REKENING</strong> di bawah ini:<br>
<table border='0' width='100%'>
<tr><td width='25%'>Bank</td><td>:</td><td  width='70%'>BNI</td></tr>
<tr><td width='25%'>Nomor Account</td><td>:</td><td  width='70%'>0650005009</td></tr>
<tr><td width='25%'>Atas Nama</td><td>:</td><td width='70%'>IKATAN PEJABAT PEMBUAT AKTA TANAH PERKUMPULAN</td></tr></table>
<br>				  
Mohon Perhatian:<br>
<table border='0' width='100%'>
<tr><td width='5%'>1.</td><td width='95%'>Melakukan pembayaran sesuai dengan jumlah diatas dengan memperhatikan 3 digit terakhir kode pembayaran, dalam waktu terhitung 1X24 jam</td></tr>
<tr><td width='5%'>2.</td><td width='95%'>	Upload bukti bayar, dengan cara klik tombol UPLOAD BUKTI BAYAR dibawah ini.</td></tr>
<tr><td width='100%' colspan='2'><a href='http://konferwil-jatim-ippat.com/konfirmasi_pembayaran.php?id=".$u['id_pendaftaran']."'><input type='button' value='Konfirmasi Pembayaran'></a>
<tr><td width='100%'>3.</td><td>Silakan cek EMAIL balasan  di inbox/spam untuk mencetak ID CARD</td></tr>
<tr><td width='100%'>4./td><td>  Apabila lewat BATAS WAKTU PEMBAYARAN maka pendaftaran online akan hangus, silakan mendaftar online kembali ke www.konferwil-jatim-ippat.com.com</td></tr><table><br><br>
</td></tr>
<tr><td width='100%' colspan='2'><br></td></tr>
</table>
<br><br>
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
$mail->SetFrom('pinfo@konferwil-jatim-ippat.com', 'Admin Konferwil Jatim IPPAT'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "INVOICE PENDAFTARAN KONFERENSI WILAYAH JAWA TIMUR IKATAN PEJABAT PEMBUAT AKTA TANAH";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address = $email; //masukkan penerima
$mail->AddAddress($address, $nama_lengkap); //masukkan penerima

$mail->AddCC('info@konferwil-jatim-ippat.com', 'Pengwil IPPAT Jatim');

$mail->Send();
?>


<?php
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
echo '<script language="javascript">alert("Selamat Data Sudah Tersimpan")</script>';
echo '<script language="javascript">window.location = "?page=peserta_pensiun"</script>'; 
} }
?>