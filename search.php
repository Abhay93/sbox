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
if(isset($_POST['searchdata']) && isset($_POST['searchin']))
{
$searchitem=$_POST['searchdata'];
$searchin=$_POST['searchin'];
echo "<script src='js/readpane.js'></script>";
if($searchin=="Inbox")
{
$result = mysql_query("select  * from $searchin where sender='$searchitem' AND reciever='$un' AND intrash='' order by id desc limit 10");
}
else
{
$result = mysql_query("select  * from $searchin where reciever='$searchitem' AND sender='$un' AND intrash='' order by id desc limit 10");
}
$row_object = mysql_query("Select Found_Rows() as rowcount");
$row_object = mysql_fetch_object($row_object);
$actual_row_count = $row_object->rowcount;
$script="<script>
$(function()
{
var page = 1
var actual_count = ".$actual_row_count.";
var search-item=".$searchitem.";
if(actual_count==0)
{
$('#nomails').show()
$('#container').hide()
}
else
{
$('#nomails').hide()
$('#container').show()
$('#searchcntnt').bind('scroll',function () 
{
var tp=$(this).scrollTop()
var inner=$(this).innerHeight()
var cntnt=$(this).prop('scrollHeight')
if(tp + inner >=cntnt)
{
page++;
var data = { page_num: page, search_item:search-item};
var actual_count = ".$actual_row_count."
var search_in=".$searchin.";
if((page-1)* 12 > actual_count){}
else{
$.ajax({
type: 'POST',
url: 'fetchsearchdata.php',
data:data,
success: function(res) 
{
$('#title').text('+searchin+')
$('#searchcntnt').append(res);
console.log(res);
}
});
}
}
});
}
})
</script>";
?>
<link rel="stylesheet" href="css/isdt.css">
<?php
echo "<div id='searchcntnt'>";
$contactpic='';
$contact='';
while ($res = mysql_fetch_array($result)) 
{
$id=$res['id'];;
$sndr=$res['sender'];
$rcvr=$res['reciever'];
$sub=$res['sub'];
$msg= $res['message'];
$t=$res['time'];
$full_date=$res['date'];
$first_date_string=substr($full_date,0,5);
$second_date_string=substr($full_date,8,2);
$trimmed_date=$first_date_string."/".$second_date_string;
$cd=date("d F");
if($searchin=="Inbox")
{
$sndrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$sndr'"));
if($sndrimg[0]=="")
{
$sndrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$sndrpic="<img id='msgpic' src='data/users/".$sndr."/".$sndrimg[0].".jpg'>";
$contactpic=$sndrpic;
$contact=$sndr;
}
}
else
{
$rcvrimg=mysql_fetch_array(mysql_query("select setpic from users where username= '$rcvr'"));
if($rcvrimg[0]=="")
{
$rcvrpic="<img id='msgpic' src='data/data/avatar.png' />";
}
else
{
$rcvrpic="<img id='msgpic' src='data/users/".$rcvr."/".$rcvrimg[0].".jpg'>";
$contactpic=$rcvrpic;
$contact=$rcvr;
}
}
echo "<div id='isdtcontent' class='".$id."'>".$rcvrpic."
<div id='meta'><p id='sndr'>".$rcvr."</p>
<p id='metadate'>".$t.",".$trimmed_date."</p></div>
<p id='sub'>".$sub."</p>
</div>";
}
echo "</div>";
}
}
?>