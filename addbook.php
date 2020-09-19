<?php
include('connect.php');
session_start();
$un=$_SESSION['username'];
/*------ADDRESS BOOK------*/
if(isset($_POST['getaddress']))
{
$data=mysql_fetch_array(mysql_query("select addbook from users where username='$un'"));
$addresses=explode(',',$data['addbook']);
$caddresses=count($addresses);
if($addresses[0]=="")
{
echo "<p class='noaddress'>No Contacts</p>";
}
else
{
for($i=0; $i<$caddresses; $i++)
{
if($addresses[$i]!="")
{
$pic=mysql_fetch_array(mysql_query("select setpic from users where username='$addresses[$i]'"));
if($pic[0]=="")
{
$sndrpic="<img id='addresspic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='addresspic' src='data/users/".$addresses[$i]."/".$pic.".jpg'>";
}
$blcontacts=mysql_fetch_array(mysql_query("select bl from users where username='$un'"));
$blcontactsarray=explode(',',$blcontacts['bl']);
if(in_array($addresses[$i],$blcontactsarray))
{
echo "<div class='adddata'>".$sndrpic."<p class='bname'>".ucwords($addresses[$i])."</p><p id='yes'><img src='data/data/chat4.png' class='chat'><img src='data/data/saved.png' class='unblacklist'><img src='data/data/close.png' class='delcon'></p></div>";
}
else
{
echo "<div class='adddata'>".$sndrpic."<p class='name'>".ucwords($addresses[$i])."</p><p id='yes'><img src='data/data/chat4.png' class='chat'><img src='data/data/blacklist.png' class='blacklist'><img src='data/data/close.png' class='delcon'></p></div>";
}
}
}
}
}
/*------ADD ADDRESS------*/
if(isset($_POST['address']))
{
$address=strtolower($_POST['address']);
$addbuk=mysql_fetch_array(mysql_query("select addbook from users where username='$un'"));
$crrtnadd=explode(',',$addbuk['0']);
if (!in_array($address, $crrtnadd) && mysql_query("update users set addbook=concat(addbook, '$address,') where username= '$un'"))
{
echo "OK";
}
}
/*------DELETE CONTACT------*/
if(isset($_POST['conname']))
{
$addbook=strtolower($_POST['conname']);
$addresstd=$addbook.",";
$addstring=mysql_fetch_array(mysql_query("select addbook from users where username='$un'"));
$substr=str_replace($addresstd,'', $addstring['addbook']);
mysql_query("update users set addbook='$substr' where username='$un'");
}
/*------BLACKLIST CONTACT------*/
if(isset($_POST['connamebl']))
{
$blacklist=strtolower($_POST['connamebl']);
mysql_query("update users set bl=concat(bl, '$blacklist,') where username= '$un'");
}
/*------UNBLACKLIST CONTACT------*/
if(isset($_POST['connameunbl']))
{
$blacklistun=strtolower($_POST['connameunbl']);
$unblacklist=$blacklistun.",";
$addstring=mysql_fetch_array(mysql_query("select bl from users where username='$un'"));
$substrun=str_replace($unblacklist,'', $addstring['bl']);
mysql_query("update users set bl='$substrun' where username='$un'");
}
?>