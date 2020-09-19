<?php
session_start();
if(!isset($_SESSION['username']))
{
die();
}
else
{
$un=$_SESSION['username'];
include("connect.php");
$result = mysql_query("select SQL_CALC_FOUND_ROWS * from inbox where reciever='$un' AND intrash='' order by id desc limit 10");
$row_object = mysql_query("Select Found_Rows() as rowcount");
$row_object = mysql_fetch_object($row_object);
$actual_row_count = $row_object->rowcount;
}
?>
<script src='js/readpane.js'></script>
<script>
$(function()
{
var page = 1
var actual_count = "<?php echo $actual_row_count; ?>";
if(actual_count==0)
{
$("#nomails").show()
$("#container").hide()
}
else
{
$("#nomails").hide()
$("#container").show()
$("#inboxcntnt").bind('scroll',function () 
{
var tp=$(this).scrollTop()
var inner=$(this).innerHeight()
var cntnt=$(this).prop('scrollHeight')
/*alert(tp+"and"+inner+"and"+cntnt)*/
if(tp + inner >=cntnt)
{
page++;
/*alert('end reacehd')*/
var data = { page_num: page};
var actual_count = "<?php echo $actual_row_count; ?>";
if((page-1)* 12 > actual_count){}
else{
$.ajax({
type: "POST",
url: "fetchomsgs.php",
data:data,
success: function(res) 
{
$("#inboxcntnt").append(res);
console.log(res);
}
});
}
}
});
}
})
</script>
<link rel="stylesheet" href="css/isdt.css">
<?php
echo "<div id='inboxcntnt'>";
$sndrpic='';
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];;
$sndr=$res['sender'];
$checksender=mysql_fetch_array(mysql_query("select bl, name from users where username='$un'"));
$senderstring=explode(',',$checksender['bl']);
if($senderstring['0']!="")
{
if (in_array($sndr, $senderstring))
{
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$staus=$res['ur_r'];
$datelen=strlen($full_date);
if($datelen==8)
{
$first_date_string=substr($full_date,0,4);
$second_date_string=substr($full_date,6,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else if($datelen==9)
{
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,7,2);
$trimmed_date=$first_date_string.$second_date_string;
}
else
{
$first_date_string=substr($full_date,0,6);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string.$second_date_string;
}
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$sndr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='msgpic' src='data/users/".$sndr."/".$sndrimg[0].".jpg'>";
}
if($staus=="ur")
{
echo "<div id='isdtcontent' class='".$id."' style='background:#2c82c9;'>";
}
else
{
echo "<div id='isdtcontent' class='".$id."'>";
}
echo $sndrpic."
<div id='meta'><p id='sndr'>".$sndr."</p>
<p id='metadate'>".$t.", ".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
}
else
{
echo "<script>$('#nomails').show()
$('#container').hide()</script>";
}
}
echo "</div>";
?>