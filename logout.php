<?php
session_start();
include("connect.php");
?>
<html>
<head>
<style>
body
{
background:#333333;
}
body:after 
{
content: "";
z-index: -1;
position: absolute;
top: 0; right: 0; bottom: 0; left: 0;
background: -webkit-radial-gradient(center center, circle cover, rgba(0,0,0,0), rgba(0,0,0,0.5));
background: -moz-radial-gradient(center center, circle cover, rgba(0,0,0,0), rgba(0,0,0,0.5));
background: -ms-radial-gradient(center center, circle cover, rgba(0,0,0,0), rgba(0,0,0,0.5));
background: -o-radial-gradient(center center, circle cover, rgba(0,0,0,0), rgba(0,0,0,0.5));
background: radial-gradient(center center, circle cover, rgba(0,0,0,0), rgba(0,0,0,0.5));
}
#asd
{
margin:20% auto;
width:30%;
height:20%;
background:#00FFFF;
text-align:center;
border-radius:5px;
font-size:20px;
padding:5 5 5 5;
}
</style>
<script>
function redirect()
{
window.location="index.php"
}
</script>
</head>
<body onLoad="setTimeout('redirect()',1000)"> 
<div id="asd">
<p>You are being logged out</p>
</div>
</body>
</html>
<?php
$un=$_SESSION['username'];
mysql_query("update users set online='n', chatting='n' where username='$un'");
session_destroy();
?>