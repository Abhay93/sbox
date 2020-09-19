<?php
include('connect.php');
session_start();
$un=$_SESSION['username'];
if(isset($_POST["message"]) &&  strlen($_POST["message"])>0)
{
//sanitize user name and message received from chat box
$chatusername = filter_var(strtolower(trim($_POST["cusername"])),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
$message = filter_var(trim($_POST["message"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
//insert new message in db
if(mysql_query("INSERT INTO chat(sender, reciever, message) value('$un','$chatusername','$message')"))
{
$msg_time = date('h:i A M d',time()); // current time
echo '<div id="chatmsg"><span class="message">'.$message.'</span><time>'.$msg_time.'</time></div>';
}
$popup=mysql_fetch_array(mysql_query("SELECT chatting from users where username='$chatusername'"));
if($popup["chatting"]=="n")
mysql_query("update users set uc='$un' where username='$chatusername'");
else
mysql_query("update users set uc='n' where username='$chatusername'");
}
elseif($_POST["fetch"]==1)
{
$recipient = filter_var(strtolower(trim($_POST["fusername"])),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
$results = mysql_query("SELECT sender, reciever, message, timedate FROM  chat  where (sender='$un' AND reciever='$recipient') OR (reciever='$un' AND sender='$recipient') ORDER BY chat.id ASC");
while($row = mysql_fetch_array($results))
{
$msg_time = date('h:i A M d',strtotime($row["timedate"])); //message posted time
if($row['sender']==$un )
echo '<div id="chatmsg"><span class="message">'.$row['message'].'</span><time>'.$msg_time.'</time></div>';
else
echo '<div id="chatmsgrec"><span class="message">'.$row['message'].'</span><time>'.$msg_time.'</time></div>';
}
mysql_query("update users set uc='n' where username='$un'");
}
else if($_POST["chatting"]==1)
{
mysql_query("update users set chatting='y', uc='n' where username='$un'");
}
else if($_POST["cchat"]==1)
{
mysql_query("update users set chatting='n' where username='$un'");
}
else if($_POST["popup"]==1)
{
$popup=mysql_fetch_array(mysql_query("SELECT uc from users where username='$un'"));
if($popup['uc']=='y')
echo "yes";
else
echo "no"; 
}
?>	