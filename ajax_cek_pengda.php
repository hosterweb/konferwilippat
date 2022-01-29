<?php
include "admin/inc/koneksi.php";
$pegawai = mysqli_fetch_array(mysqli_query($koneksi, "select * from pendaftaran where id='$_GET[nama_lengkap]'"));
$data_pegawai = array('pengda'   	=>  $pegawai['pengda'],);
 echo json_encode($data_pegawai);
 ?>