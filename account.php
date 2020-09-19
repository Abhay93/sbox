<?php
session_start();
@$un=$_SESSION['username'];
if (!isset($_SESSION['username'])) 
{
echo "<style>
#restricted
{
margin:20% auto;
width:30%;
height:15%;
background:#00FFFF;
text-align:center;
border-radius:5px;
font-size:20px;
padding:5 5 5 5;
}
</style>";
die('<div id="restricted">ERROR<br>You attempted to access a restricted page.<br><a
href="index.php">log in</a></div>');
}
else
{
include("connect.php");
echo "<html>
<head>
<title>";
echo $un;
echo "</title>
<link rel='shortcut icon' href='data/data/icon.png' type='image/icon'>";
$userdata=mysql_fetch_array(mysql_query("select name, username, password, dob, gender, contact, theme, setpic, folders, userthemeset, images, uc from users where username= '$un'"));
if($userdata['userthemeset']=='yes')
{
echo "<link rel='stylesheet' href='data/users/".$un."/".$userdata['theme'].".css'>";
}
else
{
echo "<link rel='stylesheet' href='css/themes/".$userdata['theme']."/".$userdata['theme'].".css'>";
}
echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src='js/menu.js'></script>
<script src='js/thumbnail.js'></script>
<script src='js/change_theme.js'></script>
<script src='js/account.js'></script>
<script src='js/uploadfile.js'></script>
<script src='js/account-info.js'></script>
<script src='js/upload.js'></script>
<script>

</script>
</head>
<body>
<link rel='stylesheet' media='(max-width: 1024px)' href='css/default.css'>
<link rel='stylesheet' media='(max-width: 1366px) and (min-width: 1025px)' href='css/default1366.css'>
<link rel='stylesheet' media='(min-width: 1367px)' href='css/defaultlarge.css'>
<link rel='stylesheet' href='css/isdt.css'>
<link rel='stylesheet' media='(max-width: 1024px), (min-width: 1367px)' href='css/compose.css'>
<link rel='stylesheet' media='(max-width: 1366px) and (min-width: 1025px)' href='css/compose1366.css'>
<link rel='stylesheet' href='css/circular-menu.css'>
<link rel='stylesheet' href='css/account-info.css'>
<div id='master'>
<header>
<!-----SEARCH----->
<div id='siteinn'>
<img src='data/data/icon.png' />
<p>Social Box</p>
</div>
<!--SAY HI AND DISPLAY PROFILE PIC----->
<div class='hiarea'>";
$img=$userdata['setpic'];
if($img=='')
{
echo "<img id='pic' src='data/data/avatar.png' />";
}
else
{
echo "<img id='pic' src='data/users/".$un."/".$img.".jpg'>";
}
echo "<div class='sayhi'>hi</div>
</div>
<!-------OPTIONS MENU------>
<div id='moreoptions'>";
$img=$userdata['setpic'];
if($img=='')
{
}
else
{
echo "<div id='moreoptionsimg'><img src='data/users/".$un."/".$img.".jpg'></div>";
echo '<style>#moreoptions{height:30%;}#moreoptions:before{top:-7%;}</style>';
}
echo "<p id='opentheme'>Themes</p>
<p class='set_item' id='accinfo'>Account</p>
<a href='logout.php' class='set_item'><p>Log Out</p></a>
</div>
</header>
<!--inbox,sent etc menu-->
<div class='menu_block'>
<div id='menu'>
<div class='menuicons' id='inbox'><div id='caption'>Inbox</div><img src='data/data/inbox-icon.png'></div>
<button id='compose'>Compose</button>
<div class='menuicons' id='trash'><div id='caption'>Trash</div><img src='data/data/trash.jpg'></div>
</div>
<div id='menu2'>
<div class='menuicons' id='draft'><div id='caption'>Draft</div><img src='data/data/draft.png'></div>
<div class='menuicons' id='sent'><div id='caption'>Sent</div><img src='data/data/send_mail-icon.png'></div>
</div>
<div id='topbar'><img src='data/data/2.jpg' id='addbuk'><img src='data/data/1.png' id='safe'><img src='data/data/others1.png' id='omsgs'><img src='data/data/chat5.png' id='chat'></div>";
echo "<div id='online'></div>
</div>
<!----RIGHT MESSAGE  CONTAINER----->
<div id='created'></div>
<div id='nomails'>This folder is Empty !!!</div>
<div id='container'>
<div class='menu-bar'>
<p id='title'></p>
</div>
<div class='msgpanel'>
<!--<div id='msgoverlay'><img src='data/data/partart_loading_boredoom_5_by_g2k2007-d5pd2zo.gif'></div>-->
</div>
<div id='bottombar'></div>
</div>
<!---------THEME----------->
<div id='theme_modal'>
<div id='msg'></div>
<div id='panel'>
<div id='column1'>
<a href='css/themes/petra/petra.jpg'><img id='icon' src='css/themes/petra/icon.jpg' ></a>
<a href='css/themes/graffiti/graffiti.jpg'><img id='icon' src='css/themes/graffiti/icon.jpg' ></a>
<a href='css/themes/blue/blue.jpg'><img id='icon' src='css/themes/blue/icon.jpg' ></a>
<a href='css/themes/plane/plane.jpg'><img id='icon' src='css/themes/plane/icon.jpg'  ></a>
<a href='css/themes/road/road.jpg'><img id='icon' src='css/themes/road/road.jpg' ></a>
<a href='css/themes/island1/island1.jpg'><img  id='icon'src='css/themes/island1/icon.jpg' ></a>
<a href='css/themes/city/city.jpg'><img  id='icon'src='css/themes/city/icon.jpg'  ></a>
<a href='css/themes/butterfly/butterfly.jpg'><img  id='icon' src='css/themes/butterfly/icon.jpg' ></a>
<a href='css/themes/port/port.jpg'><img id='icon'src='css/themes/port/icon.jpg' ></a>
<a href='css/themes/tree/tree.jpg'><img id='icon'src='css/themes/tree/icon.jpg' ></a>
<a href='css/themes/island/island.jpg'><img id='icon' src='css/themes/island/icon.jpg' ></a>
<a href='css/themes/bulgaria/bulgaria.jpg'><img  id='icon'src='css/themes/bulgaria/icon.jpg' ></a>
<a href='css/themes/sun/sun.jpg'><img  id='icon'src='css/themes/sun/icon.jpg'  ></a>
<a href='css/themes/beach/beach.jpg'><img  id='icon' src='css/themes/beach/icon.jpg' ></a>
<a href='css/themes/port1/port1.jpg'><img id='icon'src='css/themes/port1/icon.jpg' ></a>
<a href='css/themes/stars/stars.jpg'><img id='icon'src='css/themes/stars/icon.jpg' ></a>
<a href='css/themes/viet/viet.jpg'><img  id='icon'src='css/themes/viet/icon.jpg'  ></a>
<a href='css/themes/ware/ware.jpg'><img  id='icon' src='css/themes/ware/icon.jpg' ></a>
<a href='css/themes/penguin/penguin.jpg'><img id='icon'src='css/themes/penguin/icon.jpg' ></a>
<a href='css/themes/mexico/mexico.jpg'><img id='icon'src='css/themes/mexico/icon.jpg' ></a>
</div>
<section id='sec_makeowntheme'>
<img src='data/data/setting.png' id='setowntheme'>
<div id='theme_options'>
<span id='upload_theme_pix'>Upload</span><br />
<hr />
<span id='myphotos'>My Photos</span>
</div>
</section>
<!-----UPLOAD PIC----->
<div id='upload_pix_theme'>
<form method='post' enctype='multipart/form-data' action='' id='uploadthemeform'>
<input type='file' name='mytheme' id='themefile' /><br />
<input type='submit' value='Upload' name='themeupload' id='uploadtheme' />
</form>
</div>
<!-----MY PHOTOS---->";
echo "<div id='mypix'>";
$themestring=mysql_fetch_array(mysql_query("select usertheme, userthemeset from users where username='$un'"));
if($themestring['0']=="")
{
echo "<div id='nopix'>No Themes Found</div>";
echo "<script>$('#upload_pix_theme #themefile').attr('disabled',false)</script>";
}
else
{
$themes=explode(',',$themestring[0]);
for($i=0; $i<count($themes); $i++)
{
if($themes[$i]!="")
{
echo "<img id='img".$themes[$i]."' src='data/users/".$un."/".$themes[$i].".jpg' class='themeuser'>";
echo "<div id='".$themes[$i]."del'><img src='data/data/close1.png' class='deltheme' ></div>";
echo "<div class='whichimg' id='".$themes[$i]."'><span></span></div>";
}
}
}
echo "</div>";
/*----THEME UPLOAD-----*/
if(isset($_REQUEST['themeupload']))
{
if($_REQUEST['themeupload'])
{
$valid_exts = array('jpg', 'png', 'gif');
//file name
$fn=uniqid();
/*$fn=$_FILES['mytheme']['name'];*/
//extension of file
$ext=end(explode(".",$_FILES['mytheme']['name']));
$filename=$fn.".".$ext;
//type of file
$ft=$_FILES['mytheme']['type'];
//file size
$fsize=($_FILES["mytheme"]["size"]/1024);
$tmp=$_FILES['mytheme']['tmp_name'];
$error=$_FILES['mytheme']['error'];
//target
$tar="data/users/".$un."/".$fn.".jpg";


// looking for format validity
if (in_array($ext, $valid_exts)) 
{
//move file to uploads directory
move_uploaded_file($tmp,$tar);
mysql_query("update users set usertheme=concat(usertheme, '$fn,') where username= '$un'");
/*=concat(ifnull(usertheme, ''),*/
$style_file="data/users/".$un."/".$fn.".css";
$create=fopen($style_file,'w') or die("can't open file");
$data="*
{
margin:0;
}
html 
{ 
background: url(".$fn.".jpg)";
fwrite($create,$data);
$style_temp=file_get_contents('css/create_theme.css', FILE_APPEND) or die('ERROR: Cannot find file');
fwrite($create,$style_temp);
}
}
};
echo "
<!----PREVIEW SELECTED IMAGE---->
<div id='preview'>
<img src='css/themes/petra/petra.jpg' width='96%' height='95%' id='2'>
</div>
</div>
<div id='buttons'>
<button class='close_btn' id='close'>Close</button>
<button id='change' class='save_theme_btn'>Save</button>
</div>
</div>
<!-------ADDRESS BOOK------->
<div id='addressbook'>
<header id='addbukheader'>
<div><img src='data/data/add.png'></div>
</header>
<div id='mycontacts'></div>
<button id='closeaddbook'>Close</button>
</div>
<!-------------MSAFE--------------->
<div id='msafe'>
<header>
<img src='data/data/msafe.png' />
</header>
<img src='' id='fullview'>
<object data='' id='pdf'></object>
<video controls autoplay >
<source src='' type='video/mpeg'>
Your browser does not support the video tag.
</video>
<div id='filearea'>
<div id='myfarea'>
<!-----MY FILES---->
<div id='safecntnr'>
</div>
<!---------------SHARED WITH ME------------->
<div id='sharedfiles'>
</div>
</div>
<div id='safemenu'>
<div id='safemenulist'>
<p id='myfiles'>My Files</p>
<p id='sharedwme'>Shared</p>
<div id='msafeaudio'>
<audio controls autoplay>
<source src='' type='audio/ogg'>
Your browser does not support the audio element.
</audio> </div>
</div>
<div id='sharefiles'>
<header>
<p>SHARE <span id='stext'><span></span></span></p> 
</header>
<div id='sharelist'>";
$data=mysql_fetch_array(mysql_query("select addbook from users where username='$un'"));
$addresses=explode(',',$data['addbook']);
for($i=0; $i<count($addresses); $i++)
{
if($addresses[$i]!='')
{
echo '<p>'.$addresses[$i].'</p>';
}
};
echo "</div>
<div id='sharewith'>
<textarea></textarea>
<button id='cancel'>Cancel</button><button id='share'>Share</button>
</div>
</div>
</div>
<div id='newfile' ondragover='return false'>
<div id='text'>DROP FILES HERE</div>
<!--<form method='post' enctype='multipart/form-data' action='' id='uploadmsafeform'>
<input type='file' name='myfile'>
<br>
<input type='submit' name='uploadfiles'>
</form>-->
<div id='safeuploaded-holder'>
<span></span>
<button id='safeupload-button'>Upload</button>
<div id='safeloading-bar'>
<div class='safeloading-color'> </div>
</div>
</div>
</div>
</div>
<button id='closemsafe'>Close</button>
<button id='closepdf'>Close</button>
<button id='closeimg'>Close</button>
<button id='closevid'>Close</button>
</div>
<!----READ PANEL----->
<div id='readpanel'><div id='menubar'><button id='readdel'>DELETE</button><button id='readrep'>REPLY</button><button id='save'>SAVE</button></div><div id='readingpanel'><div id='metareaddata'><p id='subject'></p><button id='closemessage'>CLOSE</button><p id='from'><span id='frmto'></span><span id='username'></span></p><p id='dateandtime'></p></div><div id='messagecntnr'><div id='messagearea'></div><div id='key'>This is an Encrypted message<br /><br /><input type='password' placeholder='Enter Key' id='yes'><br /><span>Ask for one</span></div></div></div><div id='replybar'><input type='text' placeholder='Type quick response here...' id='replyarea'><button id='quickreplybutton'>Reply</button></div></div>
<!-----------ACCOUNT INFO----------->
<div  id='account_info'>
<div id='acccontainer'>
<!-------DISPALY PIC------>
<div id='imgcontainer'>";
$img=$userdata["setpic"];
if($img=="")
{
echo "<img id='pic' src='data/data/avatar.png' />";
}
else
{
echo "<img id='pic' src='data/users/".$un."/".$img.".jpg'>";
}
echo "<img id='changepic' src='data/data/edit.png'>";
echo "<div id='uploadpic'>
<div ondragover='return false' id='drop-files'>
<div id='text'>DROP IMAGE HERE</div>
<div id='uploaded-holder'>
<div id='dropped-files'>
<span></span>
<button id='upload-button'>Upload</button>
<button id='delete-button'>Delete</button>
<div id='loading-bar'>
<div class='loading-color'> </div>
</div>
</div>
</div>
</div>
<p id='showmypics'>My Photos</p>
<p id='cancel'>Cancel</p>
</div>
<div id='imgoverlay'></div>
</div>
<div id='usersprofilepix'>
</div>
<div id='info'>";
$firstname=explode(',',$userdata['name']);
echo "<p class='name'>".$firstname[0]."</p><p class='username'>@ ".$userdata['username']."</p><p id='email'>".$userdata['contact']."</p>";
echo "<p id='changepwd'>Change Password</p>
<input type='password' id='cpwd' placeholder='Current Password' />
<input type='password' id='newpwd' placeholder='Password' />
<input type='password' id='cnewpwd' placeholder='Confirm Password' />
<p id='delaccount'>Delete Account</p>
<input type='password' id='cpwdwd' placeholder='Current Password' />
<div id='cfrmtndlg'>Are You Sure?<br />
<button id='yes'>Yes</button><button id='no'>No</button>
<img src='data/data/spinner.gif' /></div>
</div>
</div>
<div id='back'><span></span></div>
</div>";
include('compose.php');
include('chat.php');
echo "</div></body>
</html>";
}
?>