<?php
session_start();
error_reporting(0);
$ambil=$_GET['id'];
include "../barcode/barcode128.php";
include "../admin/inc/koneksi.php";
  //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';
?>
<script src="../admin/assets/js/jquery-latest.min.js"></script>
<script src="../admin/assets/js/jquery-barcode.js"></script>

<?php 
$title = "kartu_peserta_".$ambil;
//include "../components/header.php";

?>
<head><title><?php echo $title ?></title></head>
    
<body onLoad="javascrip:window:print()">
        
    <?php
//include('../barcode/barcode.php'); // include php barcode 128 class
//$kolom = 5;  // jumlah kolom
//$copy = 1; // jumlah copy barcode
//$counter = 1;
// sql query ke database
$sql = mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini WHERE id_pendaftaran='$ambil'");
$data = mysqli_fetch_array($sql);
//menampilkan hasil generate barcode

   ?>
                
<div style="font-size:11px; width:11cm; height:14cm;"><img src="../admin/assets/images/id_card.jpg" style="width:9.7cm; height:13cm;">


<table border="0" width="100%" style="position:absolute; left:30px; top:140px; width: 8.5cm;">
        <tr><td align="center"><br></td></tr>
<tr><td align="center" ><img src="../images/<?php echo $data['file_foto'];?>" align="middle" style="height:3cm;" height="3cm"></td></tr>
<tr><td width="30%" align="center" style="font-size:14px; color:000;"><b><?php echo $data['nama_lengkap'];?></b></td></tr>
<tr><td width="30%" align="center" style="font-size:12px; color:000;"><b><?php echo $data['id_pendaftaran'];?></b> | <b><?php echo $data['pengda'];?></b></td></tr>

<tr><td align="center"><?php echo bar128(stripslashes($ambil));?></td></tr>
</table>

<table border="0" width="8cm" style="position:absolute; left:26px; top:424px; height: 0px; width: 337px;">
<tr><td width="50%" align="center"><span style="float:center" align="center">
</span></td></tr>
</table>
</div>
