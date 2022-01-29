<?php 
$koneksi = mysqli_connect("localhost","konferwi_sistem","Masuk*123","konferwi_sistem");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
session_start(); 
?>