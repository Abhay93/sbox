<?php
include('connect.php');
session_start();
$un=$_SESSION['username'];
$popup=mysql_fetch_array(mysql_query("SELECT uc from users where username='$un'"));
if($popup['uc']!='n')
echo ucwords($popup['uc']);
else
echo "no"; 
?>