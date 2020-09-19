$(function()
{
$(".username").change(function()
{
if($(".username").val().match(/^([a-zA-Z0-9]+)$/))
{
var name=$(".username").val()
$.ajax
({  
type: "POST",  
url: "recovery.php",  
data: {data:name},  
success: function(msg)
{
if(msg == 'OK')
{ 
$(".username").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
$('.username').attr('readonly', true);
$("#steptwo").fadeIn()
$.ajax
({  
type: "POST",  
url: "recovery.php",  
data: {steptdata:name},  
success: function(data)
{
$("#steptwo #question").html(data)
}
}) 
} 
else  
{
$(".username").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}  
}
})
}
})
$(".answer").change(function()
{
var answer=$(".answer").val()
var name=$(".username").val()
$.ajax
({  
type: "POST",  
url: "recovery.php",  
data: {answer:answer, name:name},  
success: function(data)
{
if(answer==data)
{
$(".answer").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
$("#stepthree").fadeIn()
$('.answer').attr('readonly', true);
}
else
{
$(".answer").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
}
})
//CHECK PASSWORD
$(".cpassword").change(function()
{	
if($(".password").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset')
{
if($(".cpassword").val()==$(".password").val())
{
$(".cpassword").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$(".cpassword").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
}
else
{
$(".cpassword").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
})
/*-----------SUBMIT----------*/
$("#stepthree button").click(function()
{
if($(".password").val()!='' && $(".cpassword").val()!='' && $(".password").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $(".cpassword").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset')
{
var pwd=$(".password").val()
var name=$(".username").val()
$.ajax
({  
type: "POST",  
url: "recovery.php",  
data: {pwd:pwd, username:name},  
success: function(data)
{
alert("Password Changed")
window.location="index.php"
}
})
}
})
})