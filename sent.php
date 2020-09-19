<?php
session_start();
if(!isset($_SESSION['username']))
{
die();
}
else
{
$un=$_SESSION['username'];
$sent=$un."_sent";
include("connect.php");
$result = mysql_query("select SQL_CALC_FOUND_ROWS * from sent where sender='$un' AND intrash='' order by id desc limit 10");
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
$('#sentcntnt').bind('scroll',function () 
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
if((page-1)* 12 > actual_count){}
else{
$.ajax({
type: "POST",
url: "fetchsentdata.php",
data:data,
success: function(res) 
{
$("#sentcntnt").append(res);
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
echo "<div id='sentcntnt'>";
$rcvrpic='';
while($res=mysql_fetch_array($result))
{
$id=$res['id'];;
$rcvr=$res['reciever'];
$sub=$res['sub'];
$msg= $res['message'];
$staus=$res['ur_r'];
$t=$res['time'];
$full_date=$res['date'];
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
$cd=date("d F");
$rcvrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$rcvr'"));
if($rcvrimg[0]=="")
{
$rcvrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$rcvrpic="<img id='msgpic' src='data/users/".$rcvr."/".$rcvrimg[0].".jpg'>";
}
if($staus=="ur")
{
echo "<div id='isdtcontent' class='".$id."' style='background:red;'>";
}
else
{
echo "<div id='isdtcontent' class='".$id."'>";
}
echo $rcvrpic."
<div id='meta'><p id='sndr'>".$rcvr."</p>
<p id='metadate'>".$t.",".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
echo "</div>";
?>