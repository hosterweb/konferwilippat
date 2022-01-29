<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="assets/images/logo-icon.png">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Login Admin Konferwil Jatim IPPAT</div>
          			<?php
 session_start();

if (isset($_POST['login'])) {

$username = $_POST['username'];

//$password = md5(trim($_POST['password']));
$password=$_POST['password'];
$sql = "select  * from  user  where username='$username' AND password='$password'";



$sql_login = mysqli_query($koneksi, $sql) or die(mysqli_error());

$hasil = mysqli_fetch_array($sql_login);



if(mysqli_num_rows($sql_login) == 1) {

	$_SESSION['username'] = $hasil['username'];
	$_SESSION['nama'] = $hasil['nama'];
	$_SESSION['level'] = $hasil['level'];

	header("Location:?page=home");

} else {
?>
				<h3>Invalid login</h3>
				<p>Enter <strong>username</strong>/<strong><?php echo $username ?></strong> ot password not found.</p>
<?php
//	header("Location:?page=login");

}

}

?>
		    <form method="post" action="?page=login">
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label for="exampleInputUsername" class="sr-only">Username</label>
				  <input type="text" id="exampleInputUsername" name="username" autofocus class="form-control form-control-rounded" placeholder="Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label for="exampleInputPassword" class="sr-only">Password</label>
				  <input type="password" id="exampleInputPassword" name="password" class="form-control form-control-rounded" placeholder="Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			 <button type="submit" value="login" name="login" id="login" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Login</button>
			 </form>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper--></div>