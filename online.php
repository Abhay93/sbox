<?php
include('connect.php');
session_start();
$un=$_SESSION['username'];
$data=mysql_fetch_array(mysql_query("select addbook from users where username='$un' AND online='y'"));
$addresses=explode(',',$data['addbook']);
$caddresses=count($addresses);
if($caddresses!=1)
{
for($i=0; $i<$caddresses; $i++)
{
if($addresses[$i]!="")
{
$online=mysql_fetch_array(mysql_query("select username from users where username='$addresses[$i]' AND online='y'"));
if($online)
echo "<div id='cws'><span id='bulb'></span><p class='showonline'>".ucwords($online['username'])."</p></div>";
}
}
}
else
{
echo "<p class='nocontacts'>You have no contacts</p>";
}
?>