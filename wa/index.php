<?php
$key='de74023993da56ebf427ad67914c3593c1a369c937e159e6'; //this is demo key please change with your own key
$url='http://116.203.191.58/api/send_message';
$hpne='6282230617668';
$data = array(
  "phone_no"  => $hpne,
  "key"       => $key,
  "message"   => "*SELAMAT*
Anda  telah terdaftar sebagai PESERTA Konferensi Wilayah Jawa Timur  IKATAN PEJABAT PEMBUAT AKTA TANAH

Id Pendaftaran  : $b[id_pendaftaran]
Nama            : $b[nama_lengkap]
Pengda          : $b[pengda]

Silahkan mencetak Tanda Peserta (ID Card) anda.  Silahkan mencetak Tanda Peserta (ID Card) anda.  https://konferwil-jatim-ippat.com//kartu_peserta.php?id=$b[id_pendaftaran]


Harap CETAK ID CARD

Pada saat registrasi ulang mohon membawa:
*1.	Asli KTP;
2.	Asli Bukti Bayar;
3.	Tanda Peserta (ID Card);*

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

?>