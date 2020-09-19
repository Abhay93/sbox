<?php
session_start();
$un=$_SESSION['username'];
include("connect.php");
$uploaddir = "data/users/".$un."/";
// The posted data, for reference
$file = $_POST['value'];
$name = $_POST['name'];
//allowed extensions
$valid_exts = array('jpg', 'png', 'gif');
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
mysql_query("update users set images=concat(images, '$fname,') where username= '$un'");
if(file_put_contents($uploaddir.$randomName, $decodedData) && in_array($mime, $valid_exts)) 
{
echo "<script>alert('yes')</script>";
echo $randomName.":uploaded successfully";
}
else 
{
echo "Something went wrong. Check that the file isn't corrupted";
}
?>