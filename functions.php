<?php
session_start();
include("connect.php");
$un=$_SESSION['username'];
function encryptIt( $q ) 
{
$cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
$qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
return( $qEncoded );
}
/*------SEND MESSAGE-----*/
if(isset($_POST['to']) && isset($_POST['subject']) && isset($_POST['messageBody']) && isset($_POST['date']) && isset($_POST['time']) & isset($_POST['encaction']) && isset($_POST['enckey']) && isset($_POST['selfdestruct']) && isset($_POST['attachments']))
{
$to=strtolower($_POST['to']);		
$sub=str_replace('\'', '"',$_POST['subject']);	
$msg=str_replace('\'', '"',$_POST['messageBody']);
$date=$_POST['date'];
$time=$_POST['time'];
$action=$_POST['encaction'];
$key=$_POST['enckey'];
$selfdestruct=$_POST['selfdestruct'];
$attachments=$_POST['attachments'];
if($to!=$un)
{
$sql = mysql_query("select *  from users where username='$to'");
if(mysql_num_rows($sql))
{
if($action=='y')
{
/*-------encryption-------*/
$encmsg = encryptIt( $msg );
mysql_query("insert into sent (sender,reciever,sub,message,time,date, enc, attachment) value('$un','$to','$sub','$encmsg','$time','$date', '$action','$attachments')") or die(mysql_error());
mysql_query("insert into inbox (reciever,sender,sub,message,time,date, ur_r, enc, enckey, destruct, attachment) value('$to','$un','$sub','$encmsg','$time','$date', 'ur', '$action', '$key', '$selfdestruct', '$attachments')") or die(mysql_error());
}
else
{
mysql_query("insert into sent (sender,reciever,sub,message,time,date,  attachment) value('$un','$to','$sub','$msg','$time','$date','$attachments')") or die(mysql_error());
mysql_query("insert into inbox (reciever,sender,sub,message,time,date, ur_r, destruct, attachment) value('$to','$un','$sub','$msg','$time','$date', 'ur', '$selfdestruct', '$attachments')") or die(mysql_error());
}
echo "sent";
}
else
{
echo "bad request";
}
}
}
/*--------SAVE MESSAGE--------*/
if(isset($_POST['todraft']) && isset($_POST['subjectdraft']) && isset($_POST['messageBodydraft']) && isset($_POST['datedraft']) && isset($_POST['timedraft']))
{
$to=$_POST['todraft'];		
$sub=$_POST['subjectdraft'];	
$msg=$_POST['messageBodydraft'];
$date=$_POST['datedraft'];
$time=$_POST['timedraft'];
if($to!=$un)
{
mysql_query("insert into draft (sender,reciever,sub,message,time,date) value('$un','$to','$sub','$msg','$time','$date')") or die(mysql_error());
}
}
/*-----QUICK REPLY-----*/
if(isset($_POST['resubject']) && isset($_POST['sendto']) && isset($_POST['message']) && isset($_POST['qdate']) && isset($_POST['qtime']))
{
$to=strtolower($_POST['sendto']);
$sub=$_POST['resubject'];
$message=$_POST['message'];
$time=$_POST['qtime'];
$date=$_POST['qdate'];
mysql_query("insert into inbox (reciever,sender,sub,message,time,date) value('$to','$un','$sub','$message','$time','$date')") or die(mysql_error());
mysql_query("insert into sent (sender,reciever,sub,message,time,date) value('$un','$to','$sub','$message','$time','$date')") or die(mysql_error());
}
/*-------DELETE MESSAGE-------*/
if(isset($_POST['subjectdel']) && isset($_POST['usernamedel']) && isset($_POST['timedel']) && isset($_POST['datedel']) & isset($_POST['delfrom']))
{
$subject=$_POST['subjectdel'];
$usernamedel=$_POST['usernamedel'];
$time=$_POST['timedel'];
$date=$_POST['datedel'];
$folder=$_POST['delfrom'];
if($folder=='inbox')
mysql_query("update inbox set intrash='y' where reciever='$un' AND sender='$usernamedel' AND sub='$subject' AND time='$time' AND date='$date'") or die(mysql_error());
else
mysql_query("update sent set intrash='y' where reciever='$usernamedel' AND sender='$un' AND sub='$subject' AND time='$time' AND date='$date'") or die(mysql_error());
}
/*-------DELETE TRASH MESSAGE-------*/
if(isset($_POST['subjectdelper']) && isset($_POST['usernamedelper']) && isset($_POST['timedelper']) && isset($_POST['datedelper']) && isset($_POST['frmto']) )
{
$subject=$_POST['subjectdelper'];
$usernamedelper=$_POST['usernamedelper'];
$time=$_POST['timedelper'];
$date=$_POST['datedelper'];
$frmto=$_POST['frmto'];
if($frmto=='From: ')
mysql_query("delete from inbox where intrash='y' AND reciever='$un' AND sender='$usernamedelper' AND sub='$subject' AND time='$time' AND date='$date'") or die(mysql_error());
else
mysql_query("delete from sent where intrash='y' AND reciever='$usernamedelper' AND sender='$un' AND sub='$subject' AND time='$time' AND date='$date'") or die(mysql_error());
}
?>