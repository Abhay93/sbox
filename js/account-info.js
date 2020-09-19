$(function()
{
/*-----UPLOAD PROFILE PIC-------*/
$("#imgcontainer #changepic").click(function()
{
$("#account_info #imgcontainer #uploadpic").show()
$("#imgcontainer #changepic").hide()
$("#imgcontainer #pic").hide()
})
$("#account_info #imgcontainer #uploadpic #cancel").click(function()
{
$("#account_info #imgcontainer #uploadpic, #uploaded-holder, #loading-bar, #loading-bar").hide()
$('#drop-files').css({'border' : '#2c82c9 3px solid'})
$('#loading-bar .loading-color').css({'width' : '0%'})
$('#loading').css({'display' : 'none'})
$('#imgcontainer #changepic,#imgcontainer #pic,  #upload-button, #uploadpicbutton, #upload-button').show()
$('#dropped-files > .image').remove()
$('#picfile').show()
$("#usersprofilepix").slideUp()
// And finally, empty the array/set z to -40
dataArray.length = 0
})
/*-----------USER PICS----------*/
$("#account_info #imgcontainer #uploadpic #showmypics").click(function()
{
$("#usersprofilepix").slideToggle()
var userpix="userpix"
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {userpix:userpix},
cache: false,
success:function(data)
{
if(data) $("#usersprofilepix").html(data)	
else $("#usersprofilepix").html("No Pics Found").css({'font-weight':'bold','color':'#CCCCCC','text-align':'center','font-family': 'Arial, sans-serif', 'font-size':'30px', 'height':'20px'})	
}
})
test.abort()
})
$("#account_info #back").click(function()
{
$("#account_info").hide()
$("#nomails").css({ 'width' : '80%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#msafe").css({ 'width' : '85%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#readpanel").css({ 'width' : '85%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#addressbook").css({ 'width' : '85%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#container").css({ 'width' : '85%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#c_area").css({ 'width' : '85%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$(".froala-editor.f-basic").css({'height' : '5%' })
$("#account_info #imgcontainer #uploadpic").hide()
$("#imgcontainer #changepic").show()
$("#imgcontainer #pic").show()
$("#info").show()
$("#usersprofilepix").hide()
$("#generalinfo").fadeIn("slow")
$("#imgcontainer #changepic").show()
$('#uploaded-holder').hide()
$('#picfile').show()
$('#uploadpicbutton').show()
$('#drop-files').css({'border' : 'none'})
$('#upload-button').show()
$('#loading-bar').hide()
})

/*------CHANGE PROFILE PIC------*/
$('#usersprofilepix').on('click', 'img.profilepix', function (event) 
{
var username='<?php echo $un?>'
var path=$(this).attr('src').split('/')
var file=path[path.length-1]
var name=file.split('.')[0]
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {userpicname:name},
cache: false,
beforeSend: function()
{
$("#imgcontainer #imgoverlay").show()
},
success:function(data)
{
src="data/users/"+data+"/"+name+".jpg"
$("#imgcontainer #pic").attr('src', src)
$(".hiarea #pic").attr('src', src)
$("#imgcontainer #imgoverlay").hide()
$("#moreoptionsimg img").attr('src', src)
} ,
complete:function(data)
{
}
})	
})
/*------DELETE PROFILE PIC------*/
$('#usersprofilepix').on('click', '.userpix .delpic', function (event) 
{
var divid=$(this).attr('id')
var picid=divid.substring(0,divid.length-3)
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {deluserpicname:picid},
cache: false,
beforeSend: function()
{
},
success:function(data)
{ 
$("#"+picid+"").remove()
if(data==picid)
{
$("#imgcontainer #pic").attr('src', 'data/data/avatar.png')
$(".hiarea #pic").attr('src', 'data/data/avatar.png')
$("#moreoptions #moreoptionsimg").remove()
$("#moreoptions").css({'height':'10%'})
$("#moreoptions:before").css({'top':'-22%'})
}
} ,
complete:function(data)
{
}
})
})
//confirm password to proceed
$("#account_info #acccontainer #info #changepwd").click(function()
{
$("#account_info #acccontainer #info #cpwd").toggle()
$("#account_info #acccontainer #info #cpwdwd").hide()
$("#account_info #acccontainer #info #cpwdwd").val('')
})
$("#account_info #acccontainer #info #cpwd").change(function()
{
var pwd=$("#account_info #acccontainer #info #cpwd").val()
$.ajax({  
type: "POST",  
url: "update_info.php",  
data: {data:pwd},  
success: function(data)
{
if(data=='OK')
{
$("#account_info #acccontainer #info #cpwd").hide()
$("#account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd").fadeIn()
}
else
{
$("#account_info #acccontainer #info #cpwd").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
}
})
})
//confirm new password and save
$("#account_info #acccontainer #info #cnewpwd").change(function()
{	
if($("#account_info #acccontainer #info #cnewpwd").val()==$("#account_info #acccontainer #info #newpwd").val())
{
$("#account_info #acccontainer #info #cnewpwd").css({'box-shadow': '0px 1px 4px 0px rgb(50, 400, 50) inset'})
var pwd=$("#account_info #acccontainer #info #cnewpwd").val()
$.ajax({  
type: "POST",  
url: "update_info.php",  
data: {newpassword:pwd},  
success: function(data)
{
if(data=='OK')
{
$("#created").show().append("Password Changed Succesfully")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$("#account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd, #account_info #acccontainer #info #cpwd").val('')
$("#account_info #acccontainer #info #cpwd").show()
$("#account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd").hide()
}
}
})
}
else
{
$("#account_info #acccontainer #info #cnewpwd").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
})
//confirm password to proceed when deleting account
$("#account_info #acccontainer #info #delaccount").click(function()
{
$("#account_info #acccontainer #info #cpwdwd").toggle()
$("#account_info #acccontainer #info #cpwd, #account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd").hide()
$("#account_info #acccontainer #info #cpwd, #account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd").val('')
})
$("#account_info #acccontainer #info #cpwdwd").change(function()
{
var pwd=$("#account_info #acccontainer #info #cpwdwd").val()
$.ajax({  
type: "POST",  
url: "update_info.php",  
data: {data:pwd},  
success: function(data)
{
if(data=='OK')
{
$("#account_info #acccontainer #info #cpwdwd").hide()
$("#account_info #acccontainer #info #cfrmtndlg").fadeIn()
}
else
{
$("#account_info #acccontainer #info #cpwdwd").css({'box-shadow': '0px 1px 4px 0px rgb(250, 50, 50) inset'})
}
}
})
})
$("#account_info #acccontainer #info #cfrmtndlg #no").click(function()
{
$("#account_info #acccontainer #info #cfrmtndlg").hide()
})
/*---------DELETE CONFIRMED----------*/
$("#account_info #acccontainer #info #cfrmtndlg #yes").click(function()
{
$("#account_info #acccontainer #info #cfrmtndlg img").show()
var sure=1;
$.ajax
({  
type: "POST",  
url: "update_info.php",  
data: {delacc:sure},  
success: function(data)
{
$("#created").show().append("Account Deleted")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)	
window.location='logout.php'
}
})
})
/*-----CLOSE-----*/
$("#closeinfo").click(function()
{
$("#uploadpic").css({ 'margin-left' : '100%'})
$("#imgcontainer #changepic").show()
$("#account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd, #account_info #acccontainer #info #cpwd").val('')
$("#account_info #acccontainer #info #cpwd").show()
$("#account_info #acccontainer #info #newpwd, #account_info #acccontainer #info #cnewpwd").hide()
})
})