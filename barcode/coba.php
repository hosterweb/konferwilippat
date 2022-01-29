<body onLoad="javascrip:window:print()">

<?php
include('barcode128.php'); // include php barcode 128 class
include "../components/koneksi.php"; // koneksi ke database

$kolom = 5;  // jumlah kolom
$copy = 1; // jumlah copy barcode
$counter = 1;
$kode="S1912124415";

// sql query ke database
$sql_barcode = mysqli_query($koneksi,"SELECT * FROM pendaftaran WHERE id_pendaftaran='$kode'");
$data_barcode = mysqli_fetch_array($sql_barcode);
//menampilkan hasil generate barcode
echo"<table cellpadding='10'>";
for ($ucopy=1; $ucopy<=$copy; $ucopy++) {
if (($counter-1) % $kolom == '0') { 
echo "<tr>"; }
//echo"<td class='merk'>".substr($data_barcode['id_pendaftaran'],0,20)."";
echo bar128(stripslashes($kode));
echo "</td>";
if ($counter % $kolom == '0') { echo "</tr>"; }
$counter++;
}
echo "</table>";
?>