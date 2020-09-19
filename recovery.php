<?php
include('connect.php');
if(isset($_POST['data']))
{
$username = $_POST['data'];
$sql = mysql_query("select *  from users where username='$username'");
if(mysql_num_rows($sql))
{
echo "OK";
}
else
{
echo "no";
}
}
/*--------GET SECRET QUESTION--------*/
if(isset($_POST['steptdata']))
{
$username = $_POST['steptdata'];
$data = mysql_fetch_array(mysql_query("select secret  from users where username='$username'"));
switch($data['secret'])
{
case 1:
echo "What street did you lived on in third grade?";
break;
case 2:
echo "In what city or town did your mother and father meet?";
break;
case 3:
echo "What is the name of a college you applied to but didn't attend?";
break;
case 4:
echo "What is the country of your ultimate dream vacation?";
break;
case 5:
echo "To what city did you go on your honeymoon?";
break;
}
}
/*-------CHECK ANSWER-------*/
if(isset($_POST['answer']) && isset($_POST['name']) )
{
$answer = $_POST['answer'];
$username = $_POST['name'];
$data = mysql_fetch_array(mysql_query("select answer  from users where username='$username'"));
echo $data['answer'];
}
/*--------UPDATE PASSWORD---------*/
if(isset($_POST['pwd']) && isset($_POST['username']) )
{
$pwd = crypt($_POST['pwd']);
$username = $_POST['username'];
mysql_query("update users set password='$pwd' where username='$username'");
mysql_query("update users set block='' where username='$username'");
}
?>