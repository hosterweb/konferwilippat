<?php 
session_start();

$start_date = new DateTime("2018-11-14");
$end_date = new DateTime();
$interval = $start_date->diff($end_date);

$cari=mysqli_query($koneksi,"SELECT COUNT(id) AS sudah_bayar FROM pendaftaran where status_pembayaran='1'");
$data=mysqli_fetch_array($cari);
$sudah_bayar=$data['sudah_bayar'];

$cari1=mysqli_query($koneksi,"SELECT COUNT(id) AS belum_bayar FROM pendaftaran where status_pembayaran='0'");
$data1=mysqli_fetch_array($cari1);
$belum_bayar=$data1['belum_bayar'];

$cari2=mysqli_query($koneksi,"SELECT COUNT(id) AS data_peserta FROM pendaftaran");
$data2=mysqli_fetch_array($cari2);
$data_peserta=$data2['data_peserta'];

$username=$_SESSION['username'];
$cari=mysqli_query($koneksi,"SELECT * FROM user where username='$username'");
$data=mysqli_fetch_array($cari);
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Pendaftaran</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Daftar Peserta Expired</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Daftar Peserta Expired IPPAT Jatim</div>
            <div class="card-body">
              <div class="table-responsive">
 <?php  if (isset($_GET['hapus'])) {
$id=$_GET['hapus'];
$hapus=mysqli_query($koneksi,"DELETE FROM pendaftaran_ini where id='$id'");
if($hapus){	
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-success"><strong>Selamat!</strong> Data Berhasil Di Hapus.</div>
			</div></div>';
							  }
					else{
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-danger"><strong>Maaf!</strong> Data Gagal Di Hapus.</div>
			</div></div>';
						}
} ?>

<?php  if (isset($_GET['ubahstatus'])) {
$id=$_GET['ubahstatus'];
date_default_timezone_set('Asia/Jakarta'); // setting time zone;
$tgl_pendaftaran=date("Y-m-d H:i:s");
$ubahstatus=mysqli_query($koneksi,"UPDATE pendaftaran_ini SET tgl_pendaftaran='$tgl_pendaftaran', status_expired='0' where id='$id'");
if($ubahstatus){	
    $ambildata = mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini WHERE id = '$id'");
    $u1=mysqli_fetch_array($ambildata);
    
require_once('../PHPMailer/PHPMailerAutoload.php');
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

			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-success"><strong>Selamat!</strong> Data Berhasil Di Update Email dan Wa Notif Telah Dikirim.</div>
			</div></div>';
							  }
					else{
			echo '<div class="row">
			<div class="col-md-12">
			<div class="alert alert-danger"><strong>Maaf!</strong> Data Gagal Di Update.</div>
			</div></div>';
						}
} ?>
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>HP</th>
                    <th>Status <br>Expired</th>
                    <th>Tgl <br>Pendaftaran</th>
                    <th>Tgl <br>Expired</th>
                    <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where status_expired='1' order by nama_lengkap,pengda");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td><?php echo $ambil['hp'];?></td>
                        <td><?php if($ambil['status_expired']==1) { echo "Expired"; }  else {echo "Tidak Expired";}?></td>                         
                        <td><?php echo $ambil['tgl_pendaftaran'];?></td>
                        <td><?php echo $ambil['tgl_expired'];?></td>
                        <td><a href="?page=peserta_expired&ubahstatus=<?php echo $ambil['id'];?>"><input class="btn btn-primary" type="button" value="Ubah Status Exp"></a></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
                <tfoot>
                    <tr>
                     <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>HP</th>
                    <th>Nomor <br>Pendaftaran</th>
                    <th>Status <br>Pembayaran</th>
                    <th>Tgl <br>Pendaftaran</th>
                    <th>Tgl <br>Expired</th>
                    <th>Tindakan</th>

                    </tr>
                </tfoot>
             </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    