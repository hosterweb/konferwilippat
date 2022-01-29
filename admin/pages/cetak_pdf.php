<?php
	require_once '../assets/tcpdf/tcpdf.php';
	$tgl_sekarang = date("d F Y");

class LuthfiPDF  extends TCPDF {
	public function Header() {
        $image_file = "<img src=\"../assets/images/logo_ippat.png\" width=\"50\" height=\"50\"/>";
		$this->SetY(10);
		$pengda=$_POST['pengda'];
		$isi_header="<table align=\"center\">
					<tr>
						<td>".$image_file."</td>
					</tr>
					<tr><td><h3>PENDAFTARAN ULANG</h3></td></tr>
					<tr><td><h3>Konferensi Ikatan Pejabat Pembuat Akta Tanah Jawa Timur</h3></td></tr>
					<tr><td><h3>Pengda ".$pengda."</h3></td></tr>
					<tr><td><h3>Sesi 1</h3></td></tr>
				</table>";
		$this->writeHTML($isi_header, true, false, false, false, '');
    }
	
	public function Footer() {
        $this->SetY(-15);
		$this->writeHTML("<hr>", true, false, false, false, '');
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, ''.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
	
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new LuthfiPDF  ('L', PDF_UNIT, 'F4', true, 'UTF-8', false);

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(PDF_MARGIN_LEFT, 55, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pengda=$_POST['pengda'];
	$pdf->SetTitle('Data Absensi Konferwil IPPAT Pengda' .$pengda);
	$pdf->SetSubject('Konferwil IPPAT Jatim');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 18);

// add a page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', '', 12);

function fetch_data() {	
$output = '';	
include 'components/koneksi.php';
$pengda=$_POST['pengda'];
// Check connection

$sql = "SELECT * FROM pendaftaran where pengda='$pengda' AND status_pembayaran='1'";
$result = mysqli_query($koneksi, $sql);
$no=1;
    // output data of each row
    while($row = mysqli_fetch_array($result)) {   

    $output .= '<tr>
				<td align="center"><br><br> '.$no.'</td>
    			<td align="center"><br><br><img width="50px" src="../images/'.$row['nama_foto'].'"><br></td>
    			<td align="center"><br><br> '.$row['id_pendaftaran'].'</td>
    			<td align="left"><br><br> '.$row['nama'].'</td>
				<td align="center">&nbsp;&nbsp;&nbsp;</td>
    			<td align="center">&nbsp;&nbsp;&nbsp;</td>
				<td align="center">&nbsp;&nbsp;&nbsp;</td>
				<td align="center">&nbsp;&nbsp;&nbsp;</td>

    			</tr>';
    $no++;
    }
    return $output;
}


$content  = '';  
$content .= ' 
<table border="1">  
  <tr>
  <th align="center" width="5%"><b>No</b></th>
  <th align="center" width="20%"><b>Foto</b></th>
    <th align="center" width="10%"><b>Id <br>Pendaftaran</b></th>
  <th align="center" width="32%"><b>Nama</b></th>
   <th align="center" width="5%"><b>KTP</b></th>
   <th align="center" width="8%"><b>Id Card</b></th>
   <th align="center" width="10%"><b>Bukti <br> Pembayaran</b></th>
   <th align="center" width="10%"><b>Tanda Tangan</b></th>

    </tr>';      
   
$content .= fetch_data(); 
$content .= '
</table>';


// output the HTML content
$pdf->writeHTML($content, true, true, true, true, '');

// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------
$pengda=$_POST['pengda'];
//Close and output PDF document
$pdf->Output('Absensi Pengda'.$pengda.'.pdf', 'D');
?>