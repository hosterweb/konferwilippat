<?php 
session_start();
?>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Data Permission</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Edit Hak Akses</a></li>
         </ol>
	   </div>
	  
     </div>
     </div>
    <!-- End Breadcrumb-->
 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">Hak Akses</div>
            <div class="card-body">
  <?php 
											if (isset($_GET['hapus'])) {
											$id_hapus=$_GET['hapus'];
											$ex=mysqli_query($koneksi,"DELETE FROM permis WHERE id_permis='$id_hapus'");
											if($ex){
												?>
												<div  class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong>Selamat!</strong> Data Sukses Di Hapus.
											</div>
											<?php	}
											}
											if (isset($_POST['submit'])){
													$menu=$_POST['menu'];		
													$user=$_POST['user'];
													$c=$_POST['c'];	
													$r=$_POST['r'];	
													$u=$_POST['u'];
													$d=$_POST['d'];	
													
													$id=$_POST['id'];

												
$insert=mysqli_query($koneksi,"UPDATE permis SET menu='$menu', user='$user', c='$c', r='$r', u='$u', d='$d' WHERE id_permis='$id'");
												if($insert){
												?>
												<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong>Selamat!</strong> Data Sukses Di Simpan.
											</div>
											<?php	}
											else {?>
												<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong>Maaf!</strong> Data Gagal Di Simpan.
											</div>
                                                <?php
												}
												}
												$edit=$_GET['edit'];
												$ambil=mysqli_query($koneksi, "Select * from permis where id_permis='$edit'");
												$data=mysqli_fetch_array($ambil);
											?>         
              <form action="" method="post">
               <table id="example" class="table table-bordered">
              <thead>
                  <tr>
	<th width="20%" align="center">Menu</th>
    <th align="center"  width="15%">Level</th>
    <th width="15%">Create</th>
    <th width="15%">Read</th>
    <th width="15%">Update</th>
    <th width="15%">Delete</th>  
</tr>

<tr>    
	<td style="display:none"><input type="text" readonly="readonly" id="id" name="id" value="<?php echo "$edit";?>" /></td>
    <td><input class="form-control" type="text" readonly="readonly" id="menu" name="menu" value="<?php echo $data['menu'];?>" /></td>
    <td><input class="form-control" type="text" readonly="readonly" id="user" name="user" value="<?php echo $data['user'];?>" /></td>
<td>
   <select class="form-control" name="c" id="c">
   <option value="<?php echo $data['c'];?>" selected><?php echo $data['c'];?></option>
   <option value="y">Ya</option>
   <option value="n">Tidak</option>
   </select>
</td>
<td>
   <select class="form-control" name="r" id="r">
      <option value="<?php echo $data['r'];?>" selected><?php echo $data['r'];?></option>
   <option value="y">Ya</option>
   <option value="n">Tidak</option>
   </select>
</td>
<td>
   <select class="form-control" name="u" id="u">
      <option value="<?php echo $data['u'];?>" selected><?php echo $data['u'];?></option>
   <option value="y">Ya</option>
   <option value="n">Tidak</option>
   </select>
</td>
<td>
   <select class="form-control" name="d" id="d">
      <option value="<?php echo $data['d'];?>" selected><?php echo $data['d'];?></option>
   <option value="y">Ya</option>
   <option value="n">Tidak</option>
   </select>
</td>
</tr>
<tr><td colspan="6"><button type="submit" value="submit" name="submit" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-save mr-1"></i> Simpan</button>
                  <a href="?page=permis"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-save mr-1"></i> Kembali</button></a></td></tr>
</table>
                    

                 </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    