<?php 
session_start();
ob_start();
?>
<!--captcha-->
<?php
$set1=array('shark','table','cricket','travel','megan');
$random_set1=array_rand($set1);
?>
<!---processing--->
<?php
include("connect.php");
$pdm='';
$cam;
$msg='';
if(isset($_REQUEST['sub']))
{
if($_REQUEST['sub'])
{
$name=$_REQUEST['name'];
$un=strtolower($_REQUEST['un']);
$res=mysql_num_rows(mysql_query("Select * from users where username like '$un'"));
if($res==0)
{
$_SESSION['username']=$un;
$pwd=$_REQUEST['p'];
$cpwd=$_REQUEST['cpwd'];
$day=$_REQUEST['day'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$dob=$day."-".$month."-".$year;
$gender=$_REQUEST['gender'];
$con=$_REQUEST['c'];
$ques=$_REQUEST['secret'];
$ans=$_REQUEST['ans'];
$style="default";
if($name!='' && $un!='' && $pwd!='' && $pwd==$cpwd && $gender!='' && $con!='' && $ques!='' && $ans!='')
{
$pwd=crypt($pwd);
/*usersISTER INFO*/
mysql_query("insert into users(name,username,password,dob,gender,contact, theme, secret, answer) values('$name','$un','$pwd','$dob','$gender', '$con', '$style', '$ques', '$ans')");
mkdir("data/users/".$un);
header("location:account.php");
}
}
else
{
$msg="Fill All Fields";
}
}
}
?>
<html>
<head>
<title>
SignUp
</title>
<link rel="shortcut icon" href="data/data/icon.png" type="image/icon">
<link rel="stylesheet" href="css/signup.css">
<link rel="stylesheet" href="css/tooltip.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/validate.js"></script>
<script src="js/password-strength.js"></script>
<script>
var word;
var selectedword
$(function()
{
$(".gender").click(function()
{
$("#gender_select").fadeToggle()
})
$("#gender_select input:radio").click(function()
{
var gender=$("#gender_select input:radio:checked").val()
$("#gender_select").hide()
$("#gender").val(gender)
})
word='<?php echo $set1[$random_set1]?>'
$(".signup #label").click(function()
{
selectedword=$(this).text()
})
})
</script>
</head>
<body>
<div id="master">
<div class="wp"><a href="index.php">Log In</a></div><br>
<div id="msgbox"><?php echo $msg?></div>
<div class="signup">
<form action="" method="post">
<!--name-->
<input class="su_boxes" type="text" name="name" value="" id="name" placeholder="Name">
<!--username-->
<input class="su_boxes" type="text" name="un" value="" id="username" placeholder="Username"><div class="tooltip">Not Available</div>
<!--gender-->
<div>
<input type="text" class="gender" id="gender" placeholder="I am" name="gender">
<div  id="gender_select">
<input type="radio" name="gender" value="Male" id="male">
<label for="male" id="gender_icon"><img src="data/data/male.png"></label>
<input type="radio" name="gender" value="Female" id="female">
<label for="female" id="gender_icon"><img src="data/data/female.png"></label>
</div>
<!--DATE OF BIRTH-->
<div id="dob" style="float:right; width:67%;">
<input type="text" name="month" class="dob" style="width:40%;" id="month" placeholder="Month" list="monthlist">
<datalist id="monthlist">
<option value="January"></option>
<option value="February"></option>
<option value="March"></option>
<option value="April"></option>
<option value="May"></option>
<option value="June" />
<option value="July" />
<option value="August" />
<option value="September" />
<option value="October" />
<option value="November" />
<option value="December" />
</datalist>
<input type="number" name="day" min="1" max="31" class="dob" style="width:25%;" placeholder="Day" id="day">
<input type="number" name="year" min="1980" max="2014" class="dob" style="width:28%;" placeholder="Year" id="year">
</div>
</div>
<!--password-->
<input class="su_boxes" maxlength="15" id="password" type="Password" name="p" value="" placeholder="Create Password">
<div id="meter"></div>
<input class="su_boxes" type="password" name="cpwd" value="" id="confirm" placeholder="Confirm Password">
<input class="mobile" type="text" name="c" value="" id="contact" placeholder="Email">
<!--------secret question-->
<select name="secret" id="secret">
<option value="1">What street did you lived on in third grade?</option>
<option value="2">In what city or town did your mother and father meet?</option>
<option value="3">What is the name of a college you applied to but didn't attend?</option>
<option value="4">What is the country of your ultimate dream vacation?</option>
<option value="5">To what city did you go on your honeymoon?</option>
</select>
<input class="su_boxes" type="text" name="ans" value="" id="answer" placeholder="Answer">
<!--captcha-->
<span>Select word <span><?php echo $set1[$random_set1]?></span> from below</span>
<br>
<input type="radio" name="selected-word" id="word1" checked="checked">
<label for="word1" id="label"><?php echo $set1[0]?></label>
<input type="radio" name="selected-word" id="word2">
<label for="word2" id="label"><?php echo $set1[1]?></label>
<input type="radio" name="selected-word" id="word3">
<label for="word3" id="label"><?php echo $set1[2]?></label>
<input type="radio" name="selected-word" id="word4">
<label for="word4" id="label"><?php echo $set1[3]?></label>
<input type="radio" name="selected-word" id="word5">
<label for="word5" id="label"><?php echo $set1[4]?></label>
<input class="su_btn" type="submit" name="sub" value="Register" id="su_btn">
</form>
</div>
<div id='signuptext'>
<div>Create</div><div id="line">a new Box account</div></div>
</div>
</body>
</html>