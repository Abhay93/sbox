<?php 
session_start();
include("connect.php");
require("fpdf/html2pdf.php");
class savepdf extends PDF_HTML
{
function __construct ($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 40) 
{
$this->FPDF($orientation, $unit, $format);
$this->SetTopMargin($margin);
$this->SetLeftMargin($margin);
$this->SetRightMargin($margin);
$this->SetAutoPageBreak(true, $margin);
}
function Header () 
{
$img="data/data/icon.png";
$this->Image($img,40, 37,30,30);
$this->SetFont('Arial', 'B', 18);
$this->SetFillColor(255, 255, 255);
$this->SetTextColor(44,130,201);
$this->SetXY(72, 40);
$this->Cell(150, 30,'Social Box', 0, 1, 'L', true);
$this->SetFont('Arial', '', 14);
$this->SetFillColor(255, 255, 255);
$this->SetTextColor(225);
$this->SetXY(320, 40);
$this->Cell(250, 30,ucwords($_POST['savepdfsender'])." @ ".$_POST['savepdfmeta'], 0, 1, 'R', true);
$this->SetFont('Arial', '', 12);
$this->SetTextColor(0);
$this->SetXY(40, 70);
$this->Cell(0, 20,'', 'T', 0, 'C');
$this->Ln(5);
$this->SetFont('Arial', 'B', 20);
$this->SetTextColor();
$this->Cell(0, 30, ucwords($_POST['savepdfsub']), 0, 0, 'C', true);
$this->SetFont('Arial', '', 12);
$this->SetTextColor(0);
$this->SetXY(40, 110);
$this->Cell(0, 20,'', 'T', 0, 'C');
}
}
function decryptIt( $q ) 
{
$cryptKey= 'qJB0rGtIn5UB1xG03efyCp';
$qDecoded= rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
return( $qDecoded );
}
$un=$_SESSION['username'];
$datetime=$_POST['savepdfmeta'];
$date=explode(',',$datetime);
/*if(trim($_POST['ros'])!="From:")
{*/
$message=mysql_fetch_array(mysql_query("select message, enc from inbox where sender='".$_POST['savepdfsender']."' AND reciever='$un' AND sub='".$_POST['savepdfsub']."' AND date='".trim($_POST['savepdfdate'])."' AND time='".$_POST['savepdftime']."'"));
/*}
else
{
$message=mysql_fetch_array(mysql_query("select message, enc from sent where reciever='".$_POST['savepdfsender']."' AND sender='$un' AND sub='".$_POST['savepdfsub']."' AND date='".trim($_POST['savepdfdate'])."' AND time='".$_POST['savepdftime']."'"));
}*/
if($message['enc']=='y')
{
$msg=decryptIt($message['message']);
$wrappedmsg=wordwrap($msg,95,"<br>\n",1);
}
else
{
$msg=$message['message'];
$wrappedmsg=wordwrap($msg,95,"<br>\n",1);
}
$pdf = new savepdf();
$pdf->SetAuthor('Social Box');
$pdf->AddPage();
$pdf->SetDisplayMode(real,'default');
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(50,110);
$text=$wrappedmsg;
if(ini_get('magic_quotes_gpc')=='1')
$text=stripslashes($text);
$pdf->WriteHTML($text);
$path="data/saved/";
$pdf->Output($path.$_POST['rand'].'.pdf', 'F');
?>