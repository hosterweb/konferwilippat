<style>


table {
  border-collapse: collapse;
  width: 210mm;
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
$nama_file="DATA_ABSENSI_PESERTA_SESI_2_PENGDA_".$pengda.".xls";
header("Content-Disposition: attachment; filename=$nama_file");
 
// Tambahkan table
?>
<table width="100%" align="center" style="border:0px">
                      <tr><td colspan="6" align="center"><h3>DATA ABSENSI PESERTA KONFERWIL JAWA TIMUR</h3></td> </tr>
                  <tr><td colspan="6" align="center"><h3>IKATAN NOTARIS INDONESIA</h3></td> </tr>
                  <tr><td colspan="6" align="center"><h3>SESI 2</h3></td> </tr>                                
</table>
<br><br>
              <table id="example" class="table table-bordered" border='1 solid black' width="100%">              
                <thead>
                    <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama</th>
                    <th width="20%">Id Pendaftaran</th>
                    <th width="20%">Pengda</th>
                    <th width="20%">No. HP</th>
                    <th width="10%">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM absen where jenis_absen='2' order by pengda");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php 
						$id_pendaftaran=$ambil['id_pendaftaran'];
						$x1=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where id_pendaftaran='$id_pendaftaran'");
						$ambil1=mysqli_fetch_array($x1);
						echo $ambil1['nama_lengkap'];?>
						</td>
                        <td><?php echo strtoupper($ambil['id_pendaftaran']);?></td>
                        <td><?php echo strtoupper($ambil['pengda']);?></td>
						<td>'<?php echo $ambil1['hp'];?></td>                        
                        <td><?php echo $ambil['waktu'];?></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
             </table>
            