<?php
include("connect.php");
ob_start();
$er="";
if(isset($_REQUEST['li']))
{
if($_REQUEST['li'])
{
$username=$_REQUEST['un'];
$un=strtolower($username);
$un=filter_var(trim($un),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
$pwd=filter_var(trim($_REQUEST['pwd']),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
if(!$un || !$pwd)
{
$er="Username or password incorrect";
echo "<script>
$(function()
{
$('.login').addClass('flash-bang')
})
</script>";
}
else
{
$res=mysql_fetch_array(mysql_query("select username,password from users where username='$un' AND block=''"));
$pwd=crypt($pwd, $res['password']);
if($res['username']==$un && $res['password']!=$pwd)
{
$data=mysql_fetch_array(mysql_query("select counter from users where username='$un'"));
$counter=$data['counter']+1;
mysql_query("update users set counter='$counter' where username='$un'");
$er="Username or password incorrect";
if($data['counter']==2)
{
$er="Your ID has been blocekd. Recover Password";
mysql_query("update users set block='y' where username='$un'");
}
}
else if($res['username']==$un && $res['password']==$pwd)
{
session_start();
$_SESSION['username']=$un;
header('location:account.php');
mysql_query("update users set counter='0',  online='y' where username='$un'");
}
else
{
$er="Username or password incorrect";
}
}
}
}
?>
<html lang="en">
<head>
<title>
SBox
</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="shortcut icon" href="data/data/icon.png" type="image/icon">
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<div id="title">
<img src="data/data/icon.png">
<p>Social Box</p>
</div>
<div class="login" >
<form action="" method="post" id="login" >
<h4><?php echo "<font class='msg'>".$er."</font>"; ?></h4>
<input placeholder="Username" name="un" type="text" class="name">
<input placeholder="Password" name="pwd" type="password" class="password">
<input type="submit" name="li" value="Sign In" id="signin">
</form>
<div id="meta">
<form action="" method="post" >
<input type="submit" name="demo" value="Demo" id="demo">
</form>
<font class="help"><a href="help.php" style="text-decoration:none; cursor:help;">Forgot Password</a></font>
</div>
<a href="signup.php" style="text-decoration:none;"><button>Join Us</button></a>
</div>
</body>
</html>
<?php
if(isset($_REQUEST['demo']))
{
if($_REQUEST['demo'])
{
$un="abhay";
$pwd="128125";
$res=mysql_fetch_array(mysql_query("select username,password from users where username='$un'"));
$pwd=crypt($pwd, $res['password']);
if($res['username']==$un && $res['password']==$pwd)
{
session_start();
header('location:account.php');
$_SESSION['username']=$un;
}}}
?>