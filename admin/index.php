<?php 
error_reporting(1);
		include "inc/koneksi.php";

          if (isset($_GET['page'])) {
           
              if ($_GET['page']=="home") {
        	include "inc/header.php";          
			  include "inc/menu.php";
              include 'pages/home.php';
			  include "inc/footer.php";			  
            }
			 elseif ($_GET['page']=="tambah_peserta_pengda") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/tambah_peserta_pengda.php';
			  include "inc/footer.php";			  
            }
            
             elseif ($_GET['page']=="export_absen_sesi2") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/export_absen_sesi2.php';
			  include "inc/footer.php";			  
            }
            
             elseif ($_GET['page']=="export_absen_sesi1") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/export_absen_sesi1.php';
			  include "inc/footer.php";			  
            }
             
             elseif ($_GET['page']=="export_absen_meja") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/export_absen_meja.php';
			  include "inc/footer.php";			  
            }
            
			elseif ($_GET['page']=="lap_absen1") {
              include 'pages/lap_absen1.php';
            }
            
            elseif ($_GET['page']=="lap_absen_meja") {
              include 'pages/lap_absen_meja.php';
            }
            
            elseif ($_GET['page']=="lap_absensi1_all") {
              include 'pages/lap_absen1_all.php';
            }
elseif ($_GET['page']=="lap_absensi2_all") {
              include 'pages/lap_absen2_all.php';
            }
			elseif ($_GET['page']=="lap_absen2") {
              include 'pages/lap_absen2.php';
            }
            
            elseif ($_GET['page']=="kirim_notif") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/kirim_notif.php';
			  include "inc/footer.php";			  
            }
            
             elseif ($_GET['page']=="kirim_email_wa") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/kirim_email_wa.php';
			  include "inc/footer.php";			  
            }
			elseif ($_GET['page']=="backup_pembayaran") {
			 	include "inc/header.php";    
			  include "inc/menu.php";
              include 'pages/backup_pembayaran.php';
			  include "inc/footer.php";			  
            }
            
            elseif ($_GET['page']=="export_pembayaran_all") {
              include 'pages/export_pembayaran_all.php';
            }
			elseif ($_GET['page']=="export_pembayaran") {
              include 'pages/export_pembayaran.php';
            }
			 elseif ($_GET['page']=="logout") {
            include "inc/header.php";
			include 'pages/logout.php';
			include "inc/footer.php";

            }
            elseif ($_GET['page']=="edit_peserta_pengda") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/edit_peserta_pengda.php';
           	include "inc/footer.php";
		    }
		    elseif ($_GET['page']=="peserta_expired") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/peserta_expired.php';
           	include "inc/footer.php";
		    }
		    elseif ($_GET['page']=="kta") {
			include '../kartu_peserta.php';
		    }
		    elseif ($_GET['page']=="edit_peserta") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/edit_peserta.php';
           	include "inc/footer.php";
		    }
		     elseif ($_GET['page']=="peserta_pensiun") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/peserta_pensiun.php';
           	include "inc/footer.php";
		    }
              elseif ($_GET['page']=="edit_permis") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/edit_permis.php';
           	include "inc/footer.php";
		    }   
               elseif ($_GET['page']=="userlog") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/userlog.php';
           	include "inc/footer.php";
		    }
		       elseif ($_GET['page']=="permis") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/permis.php';
           	include "inc/footer.php";
		    }
            elseif ($_GET['page']=="validasi_peserta") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/validasi_peserta.php';
           	include "inc/footer.php";
		    }
		    elseif ($_GET['page']=="lihat_foto") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/lihat_foto.php';
           	include "inc/footer.php";
		    }
		      elseif ($_GET['page']=="lihat_bukti") {
            include "inc/header.php";
			include "inc/menu.php";
			include 'pages/lihat_bukti.php';
           	include "inc/footer.php";
		    }
			elseif ($_GET['page']=="data_peserta") {
            include "inc/header.php";
            include "inc/menu.php";
			include 'pages/data_peserta.php';
			include "inc/footer.php";

            }
            elseif ($_GET['page']=="konfirmasi_peserta") {
            include "inc/header.php";
            include "inc/menu.php";
			include 'pages/konfirmasi_peserta.php';
			include "inc/footer.php";

            }
			 elseif ($_GET['page']=="detail_trx") {
            include "inc/header.php";
			include 'pages/detail_trx.php';
           	include "inc/footer.php";
		    }
			
			 elseif ($_GET['page']=="peserta") {
			   include "inc/header.php";
            include "inc/menu.php";
			include 'pages/peserta.php';
           	include "inc/footer.php";
		    }
			
			 elseif ($_GET['page']=="pengda") {
			  include "inc/header.php"; 
            include "inc/menu.php";
			include 'pages/pengda.php';
           	include "inc/footer.php";
		    }
			
			 elseif ($_GET['page']=="input_peserta") {
           include "inc/header.php";
            include "inc/menu.php";
			include 'pages/input_peserta.php';
           	include "inc/footer.php";
		    }
		    
		     elseif ($_GET['page']=="users") {
           include "inc/header.php";
            include "inc/menu.php";
			include 'pages/users.php';
           	include "inc/footer.php";
		    }
		    
		     elseif ($_GET['page']=="tambah_users") {
           include "inc/header.php";
            include "inc/menu.php";
			include 'pages/tambah_users.php';
           	include "inc/footer.php";
		    }
		    
		     elseif ($_GET['page']=="laporan_pembayaran") {
           include "inc/header.php";
            include "inc/menu.php";
			include 'pages/laporan_pembayaran.php';
           	include "inc/footer.php";
		    }
		    
		    
		   elseif ($_GET['page']=="simpan_pendaftaran") {
			include 'pages/simpan_pendaftaran.php';
		    }
			
			elseif ($_GET['page']=="absensi") {
            include "inc/header.php";
			include 'pages/absensi.php';
		    }
			
			elseif ($_GET['page']=="absensi2") {
            include "inc/header.php";
			include 'pages/absensi2.php';
		    }
		    
		    elseif ($_GET['page']=="absensi3") {
            include "inc/header.php";
			include 'pages/absensi.php';
           	//include "inc/footer.php";
		    }
		    elseif ($_GET['page']=="status_absen") {
            include "inc/header.php";
			include 'pages/status_absen.php';
           	//include "inc/footer.php";
		    }
			
			else {
				 include "inc/header.php";
				 include 'pages/login.php';
				 include "inc/footer.php";

				}
		  }
		  else {
				 include "inc/header.php";
				 include 'pages/login.php';
				 include "inc/footer.php";

				}
				
			?>
