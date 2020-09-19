<?php
session_start();
include("connect.php");
$un=$_SESSION['username'];
$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 10) . ",10";
$result = mysql_query("select  * from inbox where reciever='$un' AND intrash='' order by id desc limit $set_limit");
$sndrpic='';
echo "<script src='js/readpane.js'></script>";
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];;
$sndr=$res['sender'];
if($senderstring['0']!="")
{
if (!in_array($sndr, $senderstring))
{
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$staus=$res['ur_r'];
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
echo "<div id='isdtcontent' class='".$id."' style='background:#2c82c9;'>";
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
}
else
{
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$staus=$res['ur_r'];
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
echo "<div id='isdtcontent' class='".$id."' style='background:#2c82c9;'>";
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
}
exit;
?>