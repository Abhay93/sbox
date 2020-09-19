$(function()
{
popup={'popup':1}
window.setInterval(function()
{$.post('popup.php', popup,  function(data) 
{
if(data!="no")
{
$("#chatbox").show()
$("#chatbox #cbheader #cwc").text(data)
var name=$("#chatbox #cbheader #cwc").text()
$('#chatmessagebox').val('')
load_data = {'fetch':1, 'fusername':name};
window.setInterval(function()
{
$.post('shout.php', load_data,  function(data) 
{
$('#messagebox').html(data);
var scrolltoh = $('#messagebox')[0].scrollHeight
$('#messagebox').scrollTop(scrolltoh)
});
}, 1000);
}
})
}, 1000);
$(document.body).mousedown(function(event) 
{
var target = $(event.target);
if (!target.parents().andSelf().is('#moreoptions') && event.target.id!='pic') 
{ // Clicked outside
$('#moreoptions').hide();
}
})
/*----More Option----*/
$("#pic").click(function()
{
$("#moreoptions").slideToggle()
})
$("#moreoptions p").click(function()
{
$("#moreoptions").hide()
})
/*-----ADD FOLDERS----*/
$(".menu_block #add").click(function()
{
$(".menu_block #add").hide()
$(".menu_block #addbox").show()
})
$("#addmenu #addbox").change(function()
{
var folname=$("#addmenu #addbox").val()
$.ajax(
{
url:"account.php",
type:"POST",
data: {folname:folname},
cache: false,
success:function(data)
{
$(".menu_block #add").show()
$(".menu_block #addbox").hide()
$("#created").show().append("Folder '"+folname+"' was created")
setTimeout(function() {$("#created").fadeOut('slow')}, 500)
}
})	
})
/*-----mSAFE----*/
$(".menu_block #safe").click(function()
{
$("#container, #readpanel, #addressbook, #nomails, #theme_modal, #c_area").hide()
$("#msafe").show()
$("#msafe #filearea #safemenu #safemenulist #myfiles").css({'color':'#2c82c9'})
var mymsafe="msafe"
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {mymsafe:mymsafe},
cache: false,
success:function(data)
{
$("#msafe #filearea #myfarea #safecntnr").html(data)	
}
})
test.abort()
})
$("#msafe #filearea #safemenu #safemenulist #myfiles").click(function()
{
$("#msafe #filearea #safecntnr").show()
$("#msafe #filearea #myfarea #sharedfiles").hide()
$(this).css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
var mymsafe="msafe"
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {mymsafe:mymsafe},
cache: false,
success:function(data)
{
$("#msafe #filearea #myfarea #safecntnr").html(data)	
}
})
test.abort()
})
/*----------SHARED FILES-----------------*/
$("#msafe #filearea #safemenu #safemenulist #sharedwme").click(function()
{
$("#msafe #filearea #myfarea #sharedfiles").show()
$("#msafe #filearea #safecntnr").hide()
$(this).css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #myfiles").css({'color':'#000000'})
var shared="shared"
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {shared:shared},
cache: false,
success:function(data)
{
$("#msafe #filearea #myfarea #sharedfiles").html(data)	
}
})
test.abort()
})
/*------Share--------*/
$('#msafe #filearea #myfarea #safecntnr').on('click', 'img.share', function (event) 
{
var namearray=$(this).parent().parent().find('.fimg').attr('alt').split('/')
var name=namearray[3]
$("#msafe #filearea #safemenu #sharefiles").show()
$("#msafe #filearea #safemenu #safemenulist").hide()
$("#msafe #filearea #safemenu #sharefiles header span span").html(name)
})
$("#msafe #filearea #safemenu #sharefiles #sharelist p").click(function()
{
var name=$(this).text()
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val(name)	
})
$("#msafe #filearea #safemenu #sharefiles #sharewith #share").click(function()
{
var cname=$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val()
if(cname!='')
{
var fname=$("#msafe #filearea #safemenu #sharefiles header span span").text()
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {cname:cname, sfname:fname},
cache: false,
success:function(data)
{
$("#created").show().append(fname+" was shared with "+cname)
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$("#msafe #filearea #safemenu #sharefiles").hide()
$("#msafe #filearea #safemenu #safemenulist").show()
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')	
}
})
}
else
{
$("#created").show().append("No contact selected")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
}
})
/*---------PLAY---------*/
$('#msafe #filearea #myfarea #safecntnr, #msafe #filearea #myfarea #sharedfiles').on('click', 'img.fplay', function (event) 
{
var name=$(this).parent().parent().find('.fimg').attr('alt')
$("#msafe #filearea #safemenu #safemenulist #msafeaudio audio").css({'display':'block'})
$("#msafe #filearea #safemenu #safemenulist #msafeaudio video").css({'display':'none'})
$("#msafe #filearea #safemenu #safemenulist #msafeaudio audio").attr({src:name})
$("#msafe #filearea #safemenu #safemenulist #msafeaudio video").attr({'src':''})
$("#msafe #filearea #safemenu #sharefiles").hide()
$("#msafe #filearea #safemenu #safemenulist").show()
})
/*---------------PLAY VIDEO------------*/
$('#msafe #filearea #myfarea #safecntnr, #msafe #filearea #myfarea #sharedfiles').on('click', 'img.fvplay', function (event) 
{
var name=$(this).parent().parent().find('.fimg').attr('alt')
$("#msafe #filearea").css({'display':'none'})
$("#msafe video").css({'display':'block'})
$("#msafe video").attr({src:name})
$("#msafe #filearea #safemenu #safemenulist #msafeaudio audio").attr({'src':''})
$("#msafe  #closemsafe").hide()
$("#msafe  #closevid").show()
})
/*-----------CLOSE VIDEO------------*/
$("#msafe #closevid").click(function()
{
$("#msafe #filearea").css({'display':'block'})
$("#msafe video").css({'display':'none'})
$("#msafe video").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closevid").hide()
})
/*--------VIEW PDF----------*/
$('#msafe #filearea #myfarea #safecntnr, #msafe #filearea #myfarea #sharedfiles').on('click', 'img.pdfopen', function (event) 
{
var name=$(this).parent().parent().find('.fimg').attr('alt')
$("#msafe #filearea").css({'display':'none'})
$("#msafe #pdf").css({'display':'block'})
$("#msafe #pdf").attr({data:name})
$("#msafe  #closemsafe").hide()
$("#msafe  #closepdf").show()
})
/*-----------CLOSE PDF------------*/
$("#msafe #closepdf").click(function()
{
$("#msafe #filearea").css({'display':'block'})
$("#msafe #pdf").css({'display':'none'})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf").hide()
})
/*-------------VIEW IMAGE------------*/
$('#msafe #filearea #myfarea #safecntnr, #msafe #filearea #myfarea #sharedfiles').on('click', 'img.imgopen', function (event) 
{
var name=$(this).parent().parent().find('.fimg').attr('alt')
$("#msafe #filearea").css({'display':'none'})
$("#msafe #fullview").css({'display':'block'})
$("#msafe #fullview").attr({src:name})
$("#msafe  #closemsafe").hide()
$("#msafe  #closeimg").show()
})
/*-----------CLOSE IMAGE------------*/
$("#msafe #closeimg").click(function()
{
$("#msafe #filearea").css({'display':'block'})
$("#msafe #fullview").css({'display':'none'})
$("#msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closeimg").hide()
})
/*------DELETE msafe FILES------*/
$('#msafe #filearea #myfarea #safecntnr').on('click', 'img.fclose', function (event) 
{
var namearray=$(this).parent().parent().find('.fimg').attr('alt').split('/')
var name=namearray[3]
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {msafedelname:name},
cache: false,
beforeSend: function()
{
},
success:function(data)
{
$("#created").show().append(name+" was deleted")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
} ,
complete:function(data)
{
}
})
$(this).parent().parent().remove()
})
/*------DELETE msafe SHARED FILES------*/
$('#msafe #filearea #myfarea #sharedfiles').on('click', 'img.fclose', function (event) 
{
var namearray=$(this).parent().parent().find('.fimg').attr('alt').split('/')
var name=namearray[3]
$.ajax(
{
url:"m_safe.php",
type:"POST",
data: {msafeshareddelname:name},
cache: false,
beforeSend: function()
{
},
success:function(data)
{
$("#created").show().append(name+" was deleted")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
} ,
complete:function(data)
{
}
})
$(this).parent().parent().remove()
})
/*----------CANCEL mSAFE-----------*/
$("#msafe #filearea #safemenu #sharefiles #sharewith #cancel").click(function()
{
$("#msafe #filearea #safemenu #sharefiles").hide()
$("#msafe #filearea #safemenu #safemenulist").show()
})
$("#msafe #closemsafe").click(function()
{
$("#container, #msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist").show()
$("#msafe, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles").hide()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
})
/*------ACCOUNT INFO------*/
$("#moreoptions #accinfo").click(function()
{
$("#account_info").show()
$("#nomails").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#msafe").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#readpanel").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#addressbook").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#container").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$("#c_area").css({ 'width' : '60%', '-webkit-transition': 'all .6s ease-in-out',
'-moz-transition': 'all .6s ease-in-out',
'-o-transition': 'all .6s ease-in-out',
'-ms-transition': 'all .6s ease-in-out',
'transition': 'all .6s ease-in-out'})
$(".froala-editor.f-basic").css({'height' : '10%' })
$("#theme_modal").hide()
})
/*----------THEME MODAL---------*/
$("#moreoptions #opentheme").click(function()
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
$("#theme_modal").show()
$("#container, #readpanel, #addressbook, #nomails, #msafe, #c_area").hide()
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
$("#theme_modal #buttons #close").click(function()
{
$("#theme_modal").hide()
$("#container").show();
})
/*----Select All-----*/
$("#selectall").prop("checked", false)
$("#selectall").click(function()
{
if($(this).prop("checked"))
{
$("#isdtcontent input[type='checkbox']").prop("checked", true)
}
else
{
$("#isdtcontent input[type='checkbox']").prop("checked", false)
}
})
/*-------REMOVE ATTACHMENT---------*/
$('#c_area #attachments #attachedfiles').on('click', 'img', function (event) 
{
var attname=$(this).attr('alt')
/*$.ajax(
{
url:"attachment.php",
type:"POST",
data: {attname:attname},
cache: false,
beforeSend: function()
{
},
success:function(data)
{
	$(this).parent().remove()
} ,
complete:function(data)
{
}
})*/
})
/*------SEND MAIL------*/
$(".sendbutton").click(function()
{
var to=$("#c_area #to").val()
var subject=$("#c_area #subject").val()
var messagebody=$("#c_area #msg_area").val()
var fullDate = new Date()
console.log(fullDate); 
//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear()
console.log(currentDate);
var time = fullDate.getHours() + ":" + fullDate.getMinutes()
var attachments=$('#c_area #attachments #attachedfiles').text()
if(to=='')
{
$("#c_area #to").css({'background':'#FF0033'})
}
if(to!='' && messagebody!='')
{
$.ajax(
{
url:"functions.php",
type:"POST",
data: {to:to, subject:subject, messageBody:messagebody, date:currentDate, time:time, encaction:encaction, enckey:enckey, selfdestruct:selfdestruct, attachments:attachments},
cache: false,
beforeSend:function(data)
{
$("#c_area input.sendbutton").hide()
$("#c_area #spinner").show()
},
success:function(data)
{
if(data=='sent')
{
$("#c_area #to").val('')
$("#c_area #subject").val('')
/*alert($(".froala-element").text())*/
encaction=''
enckey=''
$("#c_area #keypopup, #c_area #spinner, #attachloading-bar, #attachuploaded-holder").hide()
$("#c_area #keypopup input[type='text']").val('')
$("#c_area input.sendbutton, #attachupload-button, #c_area #attachments #attachedfiles, #c_area #attachments #text").show()
$("#created").show().append("Sent Successfully")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
// This is to set the loading bar back to its default state
$('#attachloading-bar .attachloading-color').css({'width' : '0%'})
$('#attachloading').css({'display' : 'none'})
$('#attachdropped-files > .image').remove()
$("#c_area #attachments").css({'box-shadow' : 'none', 'border' : '3px dashed #999999'})
$('#c_area #attachments #attachedfiles').text('')
// And finally, empty the array/set z to -40
dataArray.length = 0
return false
}
else
{
$("#c_area #to, #c_area #subject, #c_area #keypopup input[type='text']").val('')
$("#c_area #msg_area").val('')
$(".froala-element,.not-msie,.f-basic, #attachloading-bar, #attachuploaded-holder").hide() 
$(".froala-element,.not-msie,.f-basic, .f-placeholder").show()
encaction=''
enckey=''
$("#c_area #keypopup, #c_area #spinner").hide()
$("#c_area input.sendbutton").show()
$("").hide()
$("#created").show().append("Delivery Failed")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)	
// This is to set the loading bar back to its default state
$('#attachloading-bar .attachloading-color').css({'width' : '0%'})
$('#attachloading').css({'display' : 'none'})
$('#attachupload-button, #c_area #attachments #attachedfiles, #c_area #attachments #text').show()
$('#attachdropped-files > .image').remove()
$("#c_area #attachments").css({'box-shadow' : 'none', 'border' : '3px dashed #999999'})
$('#c_area #attachments #attachedfiles').text('')
// And finally, empty the array/set z to -40
dataArray.length = 0
return false
}
},
complete:function(data)
{
}
})
test.abort()
}
})
$("#c_area #to").click(function()
{
$("#c_area #to").css({'background':'white'})
})
/*-----ADDRESS BOOK-------*/
$(".menu_block #topbar #addbuk").click(function()
{
$("#container, #msafe, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles, #readpanel, #nomails, #theme_modal, #c_area, #msafe  #closepdf").hide()
$("#msafe #filearea #safecntnr, #addressbook, #msafe #filearea #safemenu #safemenulist, #msafe  #closemsafe").show()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {getaddress:1},
cache: false,
success:function(data)
{
$("#mycontacts").html(data)
}
})
test.abort()
})
$("#addressbook #closeaddbook").click(function()
{
$("#container").show()
$("#addressbook").hide()
$(".menu_block #topbar").bind('click')
})	
/*-----MESSAGE CONATCT-------*/
$('#addressbook').on('click', 'p.name, p.bname', function (event) 
{
var name=$(this).parent().find('p').eq(0).text()
$("#c_area").show()
$("#c_area #to").val(name)
$("#addressbook").hide()
})
/*-----REMOVE CONATCT-------*/
$('#addressbook').on('click', 'img.delcon', function (event) 
{
var name=$(this).parent().parent().find('p').eq(0).text()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {conname:name},
cache: false,
success:function(data)
{
$("#created").show().append(name+" deleted from Address book")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
}
})
$(this).parent().parent().hide()
test.abort()
})
/*-----BLACKLIST CONTACT-------*/
$('#addressbook').on('click', 'img.blacklist', function (event) 
{
var name=$(this).parent().parent().find('p').eq(0).text()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {connamebl:name},
cache: false,
success:function(data)
{
$("#created").show().append(name+" was Blacklisetd")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$('#addressbook .adddata img.blacklist').attr({'src': 'data/data/saved.png','class':'unblacklist' })
$('#addressbook .adddata .name').css({'color':'#000000'}).attr({'class':'bname' })
}
})
test.abort()
})
/*-----UNBLACKLIST CONTACT-------*/
$('#addressbook').on('click', 'img.unblacklist', function (event) 
{
var name=$(this).parent().parent().find('p').eq(0).text()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {connameunbl:name},
cache: false,
success:function(data)
{
$("#created").show().append(name+" was removed from blacklist")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$('#addressbook .adddata img.unblacklist').attr({'src': 'data/data/blacklist.png', 'class':'blacklist'})
$('#addressbook .adddata .bname').css({'color':'#2c82c9'}).attr({'class':'name' })
}
})
test.abort()
})
/*----------CHAT WITH CONTACT----------------*/
$('#addressbook').on('click', 'img.chat', function (event) 
{
var name=$(this).parent().parent().find('p').eq(0).text()
$("#chatbox").show()
$("#chatbox #cbheader #cwc").text(name)
$('#chatmessagebox').val('')
// load messages every 1000 milliseconds from server.
load_data = {'fetch':1, 'fusername':name};
window.setInterval(function()
{
$.post('shout.php', load_data,  function(data) 
{
$('#messagebox').html(data);
var scrolltoh = $('#messagebox')[0].scrollHeight
$('#messagebox').scrollTop(scrolltoh)
});
}, 1000);
var chatstatus={'chatting':1}
$.post('shout.php', chatstatus,  function(data) 
{
})
})
/*-------------CHAT--------------*/
$(".menu_block #topbar #chat").click(function()
{
$(".menu_block #online").toggle()
var ntfctn = $(".menu_block #topbar #ntfctn").css('display');
window.setInterval(function()
{
$.ajax(
{
url:"online.php",
type:"POST",
data: {onlinecontacts:1},
cache: false,
success:function(data)
{
$(".menu_block #online").html(data)
}
})
}, 1000)
test.abort()
})
/*-------------CHAT WITH ONLINE CONTACTS------------*/
$('.menu_block #online').on('click', 'p.showonline', function (event) 
{
var name=$(this).text()
$("#chatbox").show()
$("#chatbox #cbheader #cwc").text(name)
$('#chatmessagebox').val('')
// load messages every 1000 milliseconds from server.
load_data = {'fetch':1, 'fusername':name};
window.setInterval(function()
{
$.post('shout.php', load_data,  function(data) 
{
$('#messagebox').html(data);
var scrolltoh = $('#messagebox')[0].scrollHeight
$('#messagebox').scrollTop(scrolltoh)
});
}, 1000);
var chatstatus={'chatting':1}
$.post('shout.php', chatstatus,  function(data) 
{
})
})
/*-----ADD ADDRESS WHEN CHATTING----*/
$("#chatbox #cbheader #cwc").click(function()
{
var address=$(this).text()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {caddress:address},
cache: false,
success:function(data)
{
if(data=="OK")
{
$("#created").show().append(address+" added to Address book")	
}
else
{
$("#created").show().append("Entry already exists")
}
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
}
})
test.abort()
})
})
