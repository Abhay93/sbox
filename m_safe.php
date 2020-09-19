<?php
include('connect.php');
session_start();
$un=$_SESSION['username'];
/*-------SHARE FILE---------*/
if(isset($_POST['cname']) && isset($_POST['sfname']))
{
$fname=$_POST['sfname'];
$cname=$_POST['cname'];
$sharefilenuser=$fname.":".$un;
mysql_query("update users set sharewithme=concat(sharewithme, '$sharefilenuser,') where username= '$cname'");
}
/*--------MY FILES--------*/
if(isset($_POST['mymsafe']))
{
$msafestring=mysql_fetch_array(mysql_query("select msafe from users where username='$un'"));
if($msafestring['0']=="")
{
echo "<p class='nofiles'>No Files</p>";
}
else
{
$msafefiles=explode(',',$msafestring[0]);
for($i=0; $i<count($msafefiles); $i++)
{
if($msafefiles[$i]!="")
{
echo "<div id='file'>";
$filestring=explode('.',$msafefiles[$i]);
$len=strlen($filestring[0]);
$ext=end($filestring);
$fstring='';
if($len<12)
{
$fstring=$filestring[0];
}
else
{
$fstring=substr($filestring[0],0,4)."...".substr($filestring[0],-4);
}
switch($ext)
{
case 'jpg':
case 'gif':
case 'png':
echo "<img src='data/users/".$un."/".$msafefiles[$i]."' class='fimg' alt='data/users/".$un."/".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/play.png' class='imgopen'><img src='data/data/close.png' class='fclose'></p>";
break;
case 'xlsx':
case 'xls':
echo "<img src='data/data/xls.png' class='fimg' alt='".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'mp3':
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$un."/".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/play.png' class='fplay'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'mp4':
case 'ogg':
case 'webm':
echo "<img src='data/data/video.png' class='fimg' alt='data/users/".$un."/".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/play.png' class='fvplay'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'pdf':
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$un."/".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/play.png' class='pdfopen'><img src='data/data/close.png' class='fclose'></p>";	
break;
default:
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$un."/".$msafefiles[$i]."' id='".$msafefiles[$i]."'><p id='fname'>".$fstring.".".$ext."</p><p id='dwnld'><a href='download.php?filename=".$un."/".$filestring[0].".".$ext."'>Download</a></p><p id='options'><img src='data/data/share.png' class='share'><img src='data/data/close.png' class='fclose'></p>";	
break;
}
echo "</div>";
}
}
}
}
/*---------SHARED WITH ME---------*/
if(isset($_POST['shared']))
{
$data=mysql_fetch_array(mysql_query("select sharewithme from users where username='$un'"));
$alldata=explode(',',$data['sharewithme']);
if($alldata['0']=="")
{
echo "<p class='nofiles'>No Shared Files</p>";
}
else
{
for($i=0; $i<count($alldata); $i++)
{
$filedata=explode(':',$alldata[$i]);
$fnamewe=$filedata[0];
if($fnamewe!='')
{
$cname=end($filedata);
$farray=explode('.',$fnamewe);
$fname=$farray[0];
$ext=end($farray);
$len=strlen($fname);
$fstring='';
if($len<12)
{
$fstring=$fname;
}
else
{
$fstring=substr($fname,0,4)."...".substr($fname,-4);
}
echo "<div id='file'>";
switch($ext)
{
case 'jpg':
case 'gif':
case 'png':
echo "<img src='data/users/".$cname."/".$fnamewe."' class='fimg'  alt='data/users/".$cname."/".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</a></p><p id='options'><img src='data/data/play.png' class='imgopen'><img src='data/data/close.png' class='fclose'></p>";
break;
case 'xlsx':
case 'xls':
echo "<img src='data/data/xls.png' class='fimg' alt='".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</p><p id='options'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'mp3':
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$cname."/".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</a></p><p id='options'><img src='data/data/play.png' class='fplay'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'mp4':
case 'ogg':
case 'webm':
echo "<img src='data/data/video.png' class='fimg' alt='data/users/".$cname."/".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</a></p><p id='options'><img src='data/data/play.png' class='fvplay'><img src='data/data/close.png' class='fclose'></p>";	
break;
case 'pdf':
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$cname."/".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</a></p><p id='options'><img src='data/data/play.png' class='pdfopen'><img src='data/data/close.png' class='fclose'></p>";	
break;
echo "<img src='data/data/".$ext.".png' class='fimg' alt='data/users/".$cname."/".$fname.".".$ext."'><p id='fname'>".$fstring.".".$ext."</p><p id='sharedby'>By: ".$cname."</p><p id='dwnld'><a href='download.php?filename="."$cname/".$fname.".".$ext."'>Download</a></p><p id='options'><img src='data/data/close.png' class='fclose'></p>";	
break;
}
echo "</div>";
}
}
}
}
/*---------------DELETE mSAFE FILES---------- */
if(isset($_POST['msafedelname']))
{
$file=$_POST['msafedelname'];
$delimg=$file.",";
$msafestring=mysql_fetch_array(mysql_query("select msafe from users where username='$un'"));
$substr=str_replace($delimg,'', $msafestring['msafe']);
mysql_query("update users set msafe='$substr' where username='$un'");
//delete from server
$userfile="data/users/".$un."/".$file;
$fh=fopen($userfile, 'w');
fclose($fh);
unlink($userfile);
}
/*---------------DELETE mSAFE SHARED FILES---------- */
if(isset($_POST['msafeshareddelname']))
{
$file=$_POST['msafeshareddelname'];
$delimg=$file.",";
$msafestring=mysql_fetch_array(mysql_query("select sharewithme from users where username='$un'"));
$substr=str_replace($delimg,'', $msafestring['msafe']);
mysql_query("update users set sharewithme='$substr' where username='$un'");
}
?>
