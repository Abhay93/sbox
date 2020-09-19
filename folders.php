<?php
session_start();
$folder="";
if(!isset($_SESSION['username']))
{
die();
}
else
{
if(isset($_POST['fodlername']))
{
$un=$_SESSION['username'];
$foldername=$_POST['fodlername'];
$folder=$un."_sent";
include("connect.php");
$data = mysql_query("select * from $folder") or die(mysql_error());
$rows=mysql_num_rows($data);
$pages=ceil($rows/$itemsperpage);
$pagination	= '';
}
?>
<script>
$(function() 
{
var rows='<?php echo $rows?>'
if(rows!=0)
{
var totalpages='<?php echo $pages?>'
$(".msgcontainer").load("paginate.php", {'page':0}, function() {$("#pagenumbers input[type='text']").val(1)});  //initial page number to load
//load next pages
$("#next").click(function()
{
$(".msgcontainer").load("paginate.php", {'page':1}, function() {$("#pagenumbers input[type='text']").val(2)}); 
})
//go back to previous
$("#previous").click(function()
{
$(".msgcontainer").load("paginate.php", {'page':0}, function() {$("#pagenumbers input[type='text']").val(1)}); 
})
//code ends for previous
}
else
{
$("#nomails").show()
$("#menuoptions").hide()
$(".msgcontainer").hide()
}
})
</script>
<?php echo "OK";?>
<div id="nomails">There are no emails in this folder</div>