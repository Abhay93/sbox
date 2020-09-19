<?php
session_start();
$un=$_SESSION['username'];
include("connect.php");
ini_set('memory_limit','160M');
$uploaddir = "data/users/".$un."/";
// The posted data, for reference
$file = $_POST['value'];
$name = $_POST['name'];
//allowed extension
$valid_exts = array(	"pdf" ,"txt" ,"exe" ,"zip" ,"doc" ,"xls" ,"ppt" ,"gif" ,"png","jpeg","jpg" );
// Get the mime
$getMime = explode('.', $name);
$mime = end($getMime);
// Separate out the data
$data = explode(',', $file);
// Encode it correctly
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);
$fname=time().rand();
// We will create a random name!
$randomName = $fname.'.'.$mime;
if(file_put_contents($uploaddir.$name, $decodedData) && in_array($mime, $valid_exts)) 
{
echo "<script>alert('yes')</script>";
echo $randomName.":uploaded successfully";
}
else 
{
echo "Something went wrong. Check that the file isn't corrupted";
}
/*---------------DELETE ATTACHMENTS---------- */
if(isset($_POST['attname']))
{
$file=$_POST['attname'];
//delete from server
$userfile="data/users/".$un."/".$file;
$fh=fopen($userfile, 'w');
fclose($fh);
unlink($userfile);
}
?>