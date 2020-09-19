<?php
session_start();
include("connect.php");
$un=$_SESSION['username'];
$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 10) . ",10";
$result = mysql_query("select  * from from inbox where reciever='$un' AND intrash='y' order by id desc limit $set_limit");
$resultsent = mysql_query("select SQL_CALC_FOUND_ROWS * from sent where sender='$un' AND intrash='y' order by id desc limit 10");
$sndrpic='';
echo "<script src='js/readpane.js'></script>";
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];;
$sndr=$res['sender'];
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$datelen=strlen($full_date);
if($datelen==8)
{
$first_date_string=substr($full_date,0,4);
$second_date_string=substr($full_date,6,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else if($datelen==9)
{
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,7,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else
{
$first_date_string=substr($full_date,0,6);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string.$second_date_string;
}
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$sndr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='msgpic' src='data/users/".$sndr."/".$sndrimg[0].".jpg'>";
}
if($staus=="ur")
{
echo "<div id='isdtcontent' class='".$id."' style='background:red;'>";
}
else
{
echo "<div id='isdtcontent' class='".$id."'>";
}
echo $sndrpic."
<div id='meta'><p id='sndr'>".$sndr."</p>
<p id='metadate'>".$t.", ".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];;
$rcvr=$res['reciever'];
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$datelen=strlen($full_date);
if($datelen==8)
{
$first_date_string=substr($full_date,0,4);
$second_date_string=substr($full_date,6,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else if($datelen==9)
{
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,7,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else
{
$first_date_string=substr($full_date,0,6);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string.$second_date_string;
}
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$rcvr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='msgpic' src='data/users/".$rcvr."/".$sndrimg[0].".jpg'>";
}
echo $sndrpic."
<div id='meta'><p id='sndr'>".$rcvr."</p>
<p id='metadate'>".$t.", ".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
exit;
?>