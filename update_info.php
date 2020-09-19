<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) 
{
die('ERROR: You attempted to access a restricted page. Please <a
href="index.php">log in</a>.');
}
else
{
include("connect.php");
$un=$_SESSION['username'];
}
/*-----CHECHK BEFORE UPLAOD----*/
if(isset($_POST['dummy']))
{
$userimg=mysql_fetch_array(mysql_query("select images from users where username='$un'"));
$imgstring=$userimg['images'];
if($imgstring!="")
{
$img=explode(',',$imgstring);
if(count($img)<=3 )
{
echo "OK";
}
}
}
/*-----------USER PICS----------*/
if(isset($_POST['userpix']))
{
$userimg=mysql_fetch_array(mysql_query("select images from users where username='$un'"));
$imgstring=$userimg['images'];
if($imgstring!="")
{
$img=explode(',',$imgstring);
for($i=0; $i<3; $i++)
{
if($img[$i]!="")
{
echo "<div id='".$img[$i]."' class='userpix'><img src='data/users/".$un."/".$img[$i].".jpg' id='".$img[$i]."' class='profilepix' ><p id='".$img[$i]."del' class='delpic'> Delete</p></div>";
}
}
}
}
/*-----CHANGE PROFILE PIC-----*/
if(isset($_POST['userpicname']))
{
$img=$_POST['userpicname'];
mysql_query("update users set setpic='$img' where username='$un'");
echo $un;
}
/*------DELETE PROFILE PIC------*/
if(isset($_POST['deluserpicname']))
{
$img=$_POST['deluserpicname'];
$delimg=$img.",";
$imgstring=mysql_fetch_array(mysql_query("select setpic, images from users where username='$un'"));
$substr=str_replace($delimg,'', $imgstring['images']);
mysql_query("update users set images='$substr' where username='$un'");
if($img=$imgstring['setpic'])
{
mysql_query("update users set setpic='' where username='$un'");
}
//delete from server
$userpic="data/users/".$un."/".$img.".jpg";
$fh=fopen($userpic, 'w');
fclose($fh);
unlink($userpic);
echo $imgstring['setpic'];
}
//confirm password
if(isset($_POST['data']))
{
$res=mysql_fetch_array(mysql_query("select username,password from users where username='$un'"));
$pwd=$_POST['data'];
$pwd=crypt($pwd, $res['password']);
if($res['password']==$pwd)
{
echo "OK";
}
else
{
echo "NO";
}
}
/*----CHANGE PASSWORD----*/
if(isset($_POST['newpassword']))
{
$pwd=$_POST['newpassword'];
$pwd=crypt($pwd);
mysql_query("update users set password='$pwd' where username='$un'");
echo "OK";
}
/*----CHANGE NAME----*/
if(isset($_POST['name']))
{
$name=$_POST['name'];
mysql_query("update users set name='$name' where username='$un'");
echo "OK";
}
/*-----CHANGE THEME-----*/
if(isset($_POST['themename']))
{
$name=$_POST['themename'];
mysql_query("update users set theme='$name' where username='$un'");
mysql_query("update users set userthemeset='no' where username='$un'");
echo "OK";
}
/*-----CHANGE THEME USER PIC-----*/
if(isset($_POST['userthemename']))
{
$name=$_POST['userthemename'];
$change=mysql_query("update users set theme='$name' where username='$un'");
mysql_query("update users set userthemeset='yes' where username='$un'");
echo $un;
}
/*------DELETE USER THEME------*/
if(isset($_POST['deluserthemename']))
{
$img=$_POST['deluserthemename'];
$delimg=$img.",";
$imgstring=mysql_fetch_array(mysql_query("select theme, usertheme from users where username='$un'"));
$substr=str_replace($delimg,'', $imgstring['usertheme']);
if($img=$imgstring['theme'])
{
mysql_query("update users set theme='default' where username='$un'");
mysql_query("update users set userthemeset='no' where username='$un'");
}
mysql_query("update users set usertheme='$substr' where username='$un'");
//delete from server
$usertheme="data/users/".$un."/".$img.".jpg";
$userthemecss="data/users/".$un."/".$img.".css";
$fh=fopen($usertheme, 'w');
fclose($fh);
unlink($usertheme);
$fhcss=fopen($userthemecss, 'w');
fclose($fhcss);
unlink($userthemecss);
echo $imgstring['setpic'];
}
/*------delete messages-------*/
if(isset($_POST['msgdata']))
{
$msgdata=implode(",",$_POST['msgdata']);
foreach($msgdata as $i)
{
echo $i;
}
}
/*------delete account-------*/
if(isset($_POST['delacc']))
{
mysql_query("delete from users where username='$un'");
mysql_query("delete from inbox where reciever='$un'");
}
?>