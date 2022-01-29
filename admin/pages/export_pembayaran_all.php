<?php
// Fungsi header dengan mengirimkan raw data excel
$pengda=$_POST['pengda'];
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$nama_file="DATA_PEMBAYARAN_PESERTA_PENGDA_".$pengda.".xls";
header("Content-Disposition: attachment; filename=$nama_file");
 
// Tambahkan table
?>
<table id="example" width="100%" align="center" class="table table-bordered">
                      <tr><td colspan="20" align="center"><h3>DATA PESERTA KONFERWIL JAWA TIMUR</h3></td> </tr>
                  <tr><td colspan="20" align="center"><h3>IKATAN NOTARIS INDONESIA</h3></td> </tr>
                  <tr><td colspan="20" align="center"><h3>PENGDA <?php echo $pengda;?></h3></td> </tr>                
</table>
<br><br>
              <table id="example" class="table table-bordered" border='1 solid black'>
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>NIK</th>
                    <th>KTA</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th>HP</th>
                    <th>Email</th>
                    <th>Nomor <br>Pendaftaran</th>
                    <th>Tgl<br>Pendaftaran</th>
                    <th>Tgl SK <br>Pengangkatan</th>
                    <th>Tgl BA <br>Sumpah</th>
                    <th>No SK <br> Pengangkatan</th>
                    <th>Telp Kantor</th>    
                    <th>Alamat Kantor</th>
                    <th>Kabupaten</th>
                    <th>Biaya <br>Pendaftaran</th>
                    <th>Tgl Expired</th>
                    <th>Status <br>Expired</th>
                    <th>Status <br>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where status_pembayaran='1' order by nama_lengkap ASC");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo strtoupper($ambil['pengda']);?></td>
                        <td><?php echo "'"; echo $ambil['nik'];?></td>
                        <td><?php echo "'"; echo $ambil['kta'];?></td>
                        <td><?php echo strtoupper($ambil['tempat_lahir']);?>, <?php echo $ambil['tgl_lahir'];?></td>
                        <td><?php echo "'"; echo $ambil['hp'];?></td>
						<td><?php echo $ambil['email'];?></td>                        
						<td><?php echo $ambil['id_pendaftaran'];?></td>
                        <td><?php echo $ambil['tgl_pendaftaran'];?></td>
                        <td><?php echo $ambil['tgl_sk_pengangkatan'];?></td>
                        <td><?php echo $ambil['tgl_ba_sumpah'];?></td>
                        <td><?php echo "'"; echo $ambil['no_sk_pengangkatan'];?></td>
                        <td><?php  echo "'"; echo $ambil['kode_kantor'];?><?php echo $ambil['telp_kantor'];?></td>
                        <td><?php echo strtoupper($ambil['alamat_kantor']);?></td>
                        <td><?php echo strtoupper($ambil['kabupaten']);?></td>
                        <td><?php echo $ambil['biaya'];?></td>
                        <td><?php echo $ambil['tgl_expired'];?></td>
                         <td><?php if($ambil['status_expired']==1){ echo "Expired";} else { echo "Tidak Expired";}?></td>
                         <td><?php if($ambil['status_pembayaran']==1){ echo "Sudah Bayar";} else { echo "Belum Bayar";}?></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
             </table>
            