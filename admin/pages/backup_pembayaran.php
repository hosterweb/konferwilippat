<?php 
session_start();
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Peserta</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Export Pembayaran</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Export Pembayaran</div>
            <div class="card-body">
            
                    <div class="card">
			     <div class="card-body">
				   <hr>
				    <form method="post" action="?page=export_pembayaran"  enctype="multipart/form-data">
					<div class="form-group">
                                            <label for="input-13">Pengda</label>
<select class="form-control single-select required" id="option_s1" name="pengda">
                            <?php
                                    $pegawai = mysqli_query($koneksi,"SELECT * FROM pendaftaran_ini group by pengda");
                                    while ($row = mysqli_fetch_array($pegawai)) {
                                        echo "<option value='$row[pengda]'>$row[pengda]</option>";
                                    }
                                ?>
							</select>											</div>
										
						 <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">EXPORT</button>
						 
					</form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
 