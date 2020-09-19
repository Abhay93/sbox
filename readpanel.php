<?php
session_start();
include("connect.php");
$un=$_SESSION['username'];
function decryptIt( $q ) 
{
$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
return( $qDecoded );
}
function attachment($attachment)
{
$len=strlen($attachment);
if($len<20)
{
$attname=$attachment;
}
else
{
$attname=substr($attachment,0,4)."...".substr($attachment,-4);
}
$filestring=explode('.',$attachment);
$ext=end($filestring);
$recattachments="<div id='attachmentsrec'>".$attname."</div>";
return( $recattachments );
}
/*------INBOX PANEL---------*/
if(isset($_POST['whichdiv']) && isset($_POST['sender']) && isset($_POST['metadata']) && isset($_POST['subject']))
{
$id=$_POST['whichdiv'];
$sender=$_POST['sender'];
$sub=$_POST['subject'];
$result=mysql_query("select message, enc, destruct, attachment from inbox where id='$id' AND sender='$sender' AND reciever='$un' AND sub='$sub'");
$message=mysql_fetch_array($result);
if($message['attachment']!='')
{
if($message['enc']=='y')
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',true); $('#messagecntnr #key').show(); $('#messagearea').hide(); $('#replyarea').hide()
$('#quickreplybutton').hide(); $('#readpanel #menubar #readrep').hide()
</script>";
$msg=$message['message'];
$messagepart=decryptIt( $msg );
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$sender."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
else
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',false); $('#messagecntnr #key').hide(); $('#messagearea').show(); $('#replybar').show(); $('#readpanel #menubar #readrep').show()</script>";
$messagepart=$message['message'];
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$sender."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
}
else
{
if($message['enc']=='y')
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',true); $('#messagecntnr #key').show(); $('#messagearea').hide(); $('#replyarea').hide()
$('#quickreplybutton').hide(); $('#readpanel #menubar #readrep').hide()
</script>";
$msg=$message['message'];
echo decryptIt( $msg );
}
else
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',false); $('#messagecntnr #key').hide(); $('#messagearea').show(); $('#replybar').show(); $('#readpanel #menubar #readrep').show()</script>";
echo $message['message'];
}
}
if($message['destruct']=='y')
{
mysql_query("delete from inbox where id='$id' AND sender='$sender' AND reciever='$un' AND sub='$sub'") or die(mysql_error());
echo "<script> $('.msgpanel').load('inbox.php')</script>";
}
mysql_query("update inbox set ur_r='r' where id='$id' AND sender='$sender' AND reciever='$un' AND sub='$sub'");
/*mysql_query("update sent set ur_r='r' where id='$id' AND sender='$un' AND reciever='$sender' AND sub='$sub'");*/
}
/*------SENT PANEL---------*/
if(isset($_POST['whichdivsent']) && isset($_POST['reciever']) && isset($_POST['metadatasent']) && isset($_POST['subjectsent']))
{
$id=$_POST['whichdivsent'];
$reciever=$_POST['reciever'];
$sub=$_POST['subjectsent'];
$message=mysql_fetch_array(mysql_query("select message, enc , attachment from sent where id='$id' AND reciever='$reciever' AND sender='$un' AND sub='$sub'"));
echo "<script>$('#messagecntnr #key').hide(); $('#messagearea').show()</script>";
if($message['attachment']!='')
{
if($message['enc']=='y')
{
$msg=$message['message'];
$messagepart=decryptIt( $msg );
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$un."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
else
{
$messagepart=$message['message'];
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$un."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
}
else
{
if($message['enc']=='y')
{
$msg=$message['message'];
echo decryptIt( $msg );
}
else
{
echo $message['message'];
}
}
}
/*------DRAFT PANEL---------*/
if(isset($_POST['whichdivdraft']) && isset($_POST['recieverdraft']) && isset($_POST['metadatadraft']) && isset($_POST['subjectdraft']))
{
$id=$_POST['whichdivdraft'];
$reciever=$_POST['recieverdraft'];
$sub=$_POST['subjectdraft'];
$result=mysql_query("select message from draft where id='$id' AND reciever='$reciever' AND sender='$un' AND sub='$sub'");
$message=mysql_fetch_array($result);
echo $message['message'];
}
/*------TRASH PANEL---------*/
if(isset($_POST['whichdivtrash']) && isset($_POST['sendertrash']) && isset($_POST['metadatatrash']) && isset($_POST['subjecttrash']))
{
$id=$_POST['whichdivtrash'];
$sender=$_POST['sendertrash'];
$sub=$_POST['subjecttrash'];
$result=mysql_query("select message, enc, attachment from inbox where id='$id' AND sender='$sender' AND reciever='$un' AND sub='$sub' AND intrash='y'");
$message=mysql_fetch_array($result);
if($message['attachment']!='')
{
if($message['enc']=='y')
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',true); $('#messagecntnr #key').show(); $('#messagearea').hide(); $('#replyarea').hide()
$('#quickreplybutton').hide(); $('#readpanel #menubar #readrep').hide()
</script>";
$msg=$message['message'];
$messagepart=decryptIt( $msg );
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$sender."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
else
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',false); $('#messagecntnr #key').hide(); $('#messagearea').show(); $('#replybar').show(); $('#readpanel #menubar #readrep').show()</script>";
$messagepart=$message['message'];
$attachment=explode(',',$message['attachment']);
$attachpart='';
for($i=0; $i<count($attachment); $i++)
{
if($attachment[$i]!="")
{
$attachpart.="<a href='downloadattachment.php?filename=".$sender."/".$attachment[$i]."'>".attachment( $attachment[$i] )."</a>";
}
}
echo $messagepart."<div id='attachholder'>".$attachpart."</div>";
}
}
else
{
if($message['enc']=='y')
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',true); $('#messagecntnr #key').show(); $('#messagearea').hide(); $('#replyarea').hide()
$('#quickreplybutton').hide(); $('#readpanel #menubar #readrep').hide()
</script>";
$msg=$message['message'];
echo decryptIt( $msg );
}
else
{
echo "<script>$('#readpanel #menubar #save').attr('disabled',false); $('#messagecntnr #key').hide(); $('#messagearea').show(); $('#replybar').show(); $('#readpanel #menubar #readrep').show()</script>";
echo $message['message'];
}
}
}
/*--------REQUEST KEY---------*/
if(isset($_POST['keysender']) && isset($_POST['keysubject']) && isset($_POST['keycurrentDate']) && isset($_POST['keytime']) )
{
$keysender=$_POST['keysender'];
$keysubject=strtoupper($_POST['keysubject']);
$keydate=$_POST['keycurrentDate'];
$keytime=$_POST['keytime'];
$subject="Requesting key: Send key for message with subject-".$keysubject;
$msg="Send key yaar";
mysql_query("insert into inbox (reciever,sender,sub,message,time,date, ur_r) value('$keysender','$un','$subject','$msg','$keytime','$keydate', 'ur')") or die(mysql_error());
}
/*---------SENDING KEY-----------*/
if(isset($_POST['sendkeyto']) && isset($_POST['keysubject']) && isset($_POST['sendkeydate']) && isset($_POST['sendkeytime']))
{
$to=$_POST['sendkeyto'];
$keysubject=$_POST['keysubject'];
$subjectcheck=explode('-',$keysubject);
$subjectcheckmain=$subjectcheck['1'];
$date=$_POST['sendkeydate'];
$time=$_POST['sendkeytime'];
$msgsubject="Sending key for message with subject bhj de- ".strtoupper($subjectcheckmain);
$retrieveddata=mysql_fetch_array(mysql_query("select message, enckey from inbox where reciever='$to' AND sender='$un' AND sub='$subjectcheckmain' AND enc!=''"));
$key=$retrieveddata['enckey'];
mysql_query("insert into inbox (reciever,sender,sub,message,time,date, ur_r) value('$to','$un','$msgsubject','$key','$time','$date', 'ur')") or die(mysql_error());
}
/*---------CHECKING KEY-----------*/
if(isset($_POST['msgsubject']) && isset($_POST['msgsender']))
{
$sub=$_POST['msgsubject'];
$sender=$_POST['msgsender'];
$retrieveddata=mysql_fetch_array(mysql_query("select message, enckey from inbox where sender='$sender' AND reciever='$un' AND sub='$sub' AND enc!=''"));
$key=$retrieveddata['enckey'];
echo $key;
}
?>