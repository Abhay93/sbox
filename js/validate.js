$(document).ready(function()
{
// disable button
$(".signup input[type=submit]").attr("disabled",true)
//validate name
$("#name").change(function()
{
if($("#name").val().match(/^([a-zA-Z']+)$/))
{
$("#name").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$("#name").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
//username availibility
$("#username").change(function() 
{ 
if($("#username").val().match(/^([a-zA-Z0-9]+)$/))
{
var username = $("#username").val();
$.ajax({  
type: "POST",  
url: "un_availibility_check.php",  
data: {data:username},  
success: function(msg)
{  
if(msg == 'OK')
{ 
$(".tooltip").css({'visibility': 'hidden'})
$("#username").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}  
else  
{
$(".tooltip").css({'visibility': 'visible'})
$("#username").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}  
}
});
}
else
{
$("#username").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
});
//CHECK PASSWORD
$("#confirm").change(function()
{	
if($("#password").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset')
{
if($("#confirm").val()==$("#password").val())
{
$("#confirm").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$("#confirm").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
}
else
{
$("#confirm").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
/*------validate email-------*/
$("#contact").change(function()
{
if($("#contact").val().match(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/))
{
$("#contact").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$("#contact").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
/*//validate mobile
$("#contact").change(function()
{	
if(isNaN($("#contact").val()) )
{
$("#contact").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
else if($("#contact").val().length==10)
{
$("#contact").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$("#contact").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})*/
//secret
$("#answer").change(function()
{	
if($("#answer").val()!='')
{
$("#answer").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
else
{
$("#answer").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
// captcha check
$(".signup #label").click(function()
{									  
$targetword=word
$selword=selectedword
if($targetword==$selword)
{
if($("#name").val()!='' && $("#username").val()!='' && $("#gender").val()!='' && $("#month").val()!='' && $("#day").val()!='' && $("#year").val()!='' && $("#password").val()!='' && $("#country").val()!='' && $("#contact").val()!=''  && $("#answer").val()!=''&& $("#name").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $("#username").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $("#day").css('boxShadow')!='rgb(250, 50, 50) 0px 1px 4px 0px inset' && $("#year").css('boxShadow')!='rgb(250, 50, 50) 0px 1px 4px 0px inset' && $("#password").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $("#confirm").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $("#contact").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset' && $("#answer").css('boxShadow')=='rgb(50, 255, 50) 0px 1px 4px 0px inset')
{
$("input[type=submit]").attr("disabled",false).css({'cursor':'pointer', 'width':'97%'})
}
}
})
})