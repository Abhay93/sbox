$(function()
{
$("#password").keyup(function()
{
$("#meter").slideDown()
$("#password").css({'width':'85%'})
//initial strength
var strength = 0
//value
var password=$("#password").val()
//if the password length is less than 6, return message.
if (password.length >=6 ) 
{
strength += 1
//if password contains both lower and uppercase characters, increase strength value
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
//if it has numbers and characters, increase strength value
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
//if it has one special character, increase strength value
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
//if it has two special characters, increase strength value
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
//now we have calculated strength value, we can return messages
//if value is less than 2
if (strength < 2  && strength>0) $("#meter").css({'border-top-color':'#51ff0d'})
if(strength==2)
{
$("#meter").css({'border-top-color':'#51ff0d', 'border-right-color':'#51ff0d'})
}
if(strength<4 && strength>2)
{
$("#meter").css({'border-top-color':'#51ff0d', 'border-right-color':'#51ff0d', 'border-bottom-color':'#51ff0d'})
}
if(strength>4)
{
$("#meter").css({'border-top-color':'#51ff0d', 'border-right-color':'#51ff0d', 'border-bottom-color':'#51ff0d', 'border-left-color':'#51ff0d'})
}
}
})
$("#password").change(function()
{
$("#meter").hide()
$("#password").css({'width':'98%'})
if($("#password").val().length<6)
{
$("#password").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
else
{
$("#password").css({'box-shadow': '0px 1px 4px 0px rgb(50, 255, 50) inset'})
}
})
})