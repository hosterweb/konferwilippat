<?php
mysqli_query($koneksi, "UPDATE pendaftaran_ini SET nama_lengkap = replace(nama_lengkap, 'M.KN', 'M.Kn');");
$cari2=mysqli_query($koneksi, "SELECT * FROM pendaftaran_ini where status_expired='0' AND status_pembayaran='0'");
while($hasil2=mysqli_fetch_array($cari2)){

$waktuawal  = date_create($hasil2['tgl_expired']); //waktu di setting
$waktuakhir = date_create(); //2019-02-21 09:35 waktu sekarang

 if($waktuakhir >= $waktuawal){ mysqli_query($koneksi, "UPDATE pendaftaran_ini SET status_expired='1' where id='$hasil2[id]'"); }
}
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Dashboard</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=home">Dashboard</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
<div class="row mt-3">
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card bg-pattern-primary">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g=mysqli_query($koneksi,"SELECT * FROM pendaftaran");
                $k=mysqli_num_rows($g);
                echo $k;
                ?></h4>
                <span class="text-white">Total Anggota</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-user text-white"></i></div>
             </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card bg-pattern-danger">
            <div class="card-body">
              <div class="media">
               <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g1=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini");
                $k1=mysqli_num_rows($g1);
                echo $k1;
                ?></h4>
                <span class="text-white">Total Peserta</span>
              </div>
               <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-user text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card bg-pattern-success">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g2=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where status_pembayaran='0'");
                $k2=mysqli_num_rows($g2);
                echo $k2;
                ?></h4>
                <span class="text-white">Belum Bayar</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-wallet text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card bg-pattern-warning">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g3=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini where status_pembayaran='1'");
                $k3=mysqli_num_rows($g3);
                echo $k3;
                ?></h4>
                <span class="text-white">Sudah Bayar</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-wallet text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
	  
	 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Data Peserta</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
              
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>HP</th>
                    <th>Kode Unik Pemb</th>
                    <th>Nomor <br>Pendaftaran</th>
                    <th>Tgl daftar</th>
                    <th>Tgl Expired</th>
                    <th>Status Pemb</th>
                    <th>Status Exp</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini order by biaya");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td><?php echo $ambil['hp'];?></td>
                        <td>Rp. <?php echo number_format($ambil['biaya']);?></td>
                        <td><?php echo $ambil['id_pendaftaran'];?></td>
                        <td><?php echo $ambil['tgl_pendaftaran'];?></td>
                        <td><?php echo $ambil['tgl_expired'];?></td>
                        <td><?php if($ambil['status_pembayaran']==0){echo "Belum Bayar"; } else {echo "Sudah Bayar";}?></td>
                        <td><?php if($ambil['status_expired']==1) { echo "Expired"; }  else {echo "Tidak Expired";}?></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
                <tfoot>
                    <tr>
                     <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                    <th>HP</th>
                    <th>Kode Unik Pemb</th>
                    <th>Nomor <br>Pendaftaran</th>
                    <th>Tgl daftar</th>
                    <th>Tgl Expired</th>
                     <th>Status Pemb</th>
                    <th>Status Exp</th>
                    </tr>
                </tfoot>
             </table>
            </div>
            </div>
          </div>

      </div><!-- End Row-->
       <!--End Dashboard Content-->

	 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Data Peserta</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered">
              
                <thead>
                    <tr>
                  <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                     <th>Status Pemb</th>
                    <th>Status Exp</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$no=0;
				$x=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini order by biaya");
				while($ambil=mysqli_fetch_array($x)){
				$no++
				?>
                    <tr>
                     	<td><?php echo $no;?></td>
                        <td><?php echo $ambil['nama_lengkap'];?></td>
                        <td><?php echo $ambil['pengda'];?></td>
                        <td><?php if($ambil['status_pembayaran']==0){echo "Belum Bayar"; } else {echo "Sudah Bayar";}?></td>
                        <td><?php if($ambil['status_expired']==1) { echo "Expired"; }  else {echo "Tidak Expired";}?></td>
                    </tr>
                    <?php }?>
                   
                </tbody>
                <tfoot>
                    <tr>
                     <th>No</th>
                    <th>Nama</th>
                    <th>Pengda</th>
                     <th>Status Pemb</th>
                    <th>Status Exp</th>
                    </tr>
                </tfoot>
             </table>
            </div>
            </div>
          </div>

      </div><!-- End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->