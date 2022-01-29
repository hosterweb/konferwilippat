<style>


table {
  border-collapse: collapse;
  width: 100%;
}

th {
  height: 50px;
}
</style>
<?php
// Fungsi header dengan mengirimkan raw data excel
$pengda=$_POST['pengda'];
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$nama_file="DATA_ABSENSI_DAFTAR_ULANG_PENGDA_".$pengda.".xls";
header("Content-Disposition: attachment; filename=$nama_file");
 
// Tambahkan table
?>
<table id="example" width="100%" align="center" style="border:0">
                      <tr><td colspan="5" align="center"><h4>DATA ABSENSI PESERTA KONFERWIL JAWA TIMUR</h5></td> </tr>
                  <tr><td colspan="5" align="center"><h4>IKATAN PEJABAT PEMBUAT AKTA TANAH</h4></td> </tr>
                  <tr><td colspan="5" align="center"><h4>PENGDA <?php echo $pengda;?></h4></td> </tr>
                  <tr><td colspan="5" align="center"><h4>DAFTAR ULANG</h4></td> </tr>                
                
</table>
<br><br>
              <table id="example" class="table table-bordered" border='1 solid black' width="100%">              
                <thead>
                    <tr>
                    <th width="5%"><h6></h5>No</h5></th>
                    <th width="25%"><h5>Nama</h5></th>
                    <th width="20%"><h5>Id Pendaftaran</h5></th>
                    <th width="20%"><h5>No. HP</h5></th>
                    <th colspan="2" width="20%"><h5>Tanda Tangan</h5></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where pengda='$pengda' AND status_pembayaran='1' order by nama_lengkap ASC");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td width="5%"><?php echo $no;?></td>
                        <td width="25%"><?php echo strtoupper($ambil['nama_lengkap']);?></td>
                        <td width="10%"><?php echo strtoupper($ambil['id_pendaftaran']);?></td>
						<td width="20%">'<?php echo $ambil['hp'];?></td> 
                        <td width="15%"></td>
                        <td width="15%"></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
             </table>
            