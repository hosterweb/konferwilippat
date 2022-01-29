<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication2 mx-auto my-5 animated bounceInDown">
	
	 <div class="row">
        <div class="col-lg-12">
            
		<div class="card-body">
		 <div class="card-content p-1">
		 	<div class="text-center">
		 		<img src="assets/images/logo_ippat.png" width="10%">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Status Absensi <br> Konferensi Wilayah Jawa Timur<br>Ikatan Pejabat Pembuat Akta Tanah (IPPAT)<br><?php echo date("d-m-Y H:i:s");?></div>
          			<?php
 session_start();

?>
		     
		     
<div class="row mt-2">
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-pattern-primary">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g=mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini");
                $k=mysqli_num_rows($g);
                echo $k;
                ?></h4>
                <span class="text-white">Total Peserta</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-user text-white"></i></div>
             </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-pattern-danger">
            <div class="card-body">
              <div class="media">
               <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g1=mysqli_query($koneksi,"SELECT * FROM absen where jenis_absen='1'");
                $k1=mysqli_num_rows($g1);
                if (empty($k1)) { echo "0"; }
                echo $k1;
                ?></h4>
                <span class="text-white">Absen Sesi 1 </span>
              </div>
               <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-user text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
          <div class="card bg-pattern-success">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-white"><?php 
                $g2=mysqli_query($koneksi,"SELECT * FROM absen where jenis_absesn='2'");
                $k2=mysqli_num_rows($g2);
                if (empty($k2)) { echo "0"; }
                else {
                echo $k2; }
                ?></h4>
                <span class="text-white">Absen Sesi 2</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-wallet text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        
			 <br>
			 
		   </div>
		  </div>
		  </div>
		  </div>
		  </div>
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper--></div>