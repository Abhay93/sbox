<?php
include('connect.php');
if(isset($_POST['data']))
{
$username = $_POST['data'];
$sql = mysql_query("select *  from users where username='$username'");
if(mysql_num_rows($sql))
{
echo "no";
}
else
{
echo "OK";
}
}
?>