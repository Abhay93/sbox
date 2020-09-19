<?php
session_start();
include("connect.php");
$un=$_SESSION['username'];
if(isset($_POST['page_num']) && isset($_POST['search_item']) && isset($_POST['search_in']))
{
$requested_page = $_POST['page_num'];
$search_item= $_POST['search_item'];
$search_in=$_POST['search_in'];
$set_limit = (($requested_page - 1) * 10) . ",10";
$sndrpic='';
echo "<script src='js/readpane.js'></script>";
if($search_in=="Inbox")
{
$result = mysql_query("select  * from $search_in where sender='$search_item' AND reciever='$un' AND intrash='' order by id desc limit $set_limit");
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];
$sndr=$res['sender'];
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string."/".$second_date_string;
$cd=date("d F");
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$sndr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='msgpic' src='data/users/".$sndr."/".$sndrimg[0].".jpg'>";
}
echo "<div id='isdtcontent' class='".$id."'>".$sndrpic."
<div id='meta'><p id='sndr'>".$rcvr."</p>
<p id='metadate'>".$t.",".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
exit;
}
}
else
{
$result = mysql_query("select  * from $search_in where reciever='$search_item' AND sender='$un' order by id desc limit $set_limit");
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];
$rcvr=$res['reciever'];
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$d=$res['date'];
$full_date=$res['date'];
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string."/".$second_date_string;
$cd=date("d F");
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$sndr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$rcvrpic="<img id='msgpic' src='data/users/".$rcvr."/".$rcvrimg[0].".jpg'>";
}
echo "<div id='isdtcontent' class='".$id."'>".$rcvrpic."
<div id='meta'><p id='sndr'>".$rcvr."</p>
<p id='metadate'>".$t.",".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
exit;
}
}
?>