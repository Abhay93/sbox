$(function()
{
$('#inboxcntnt #isdtcontent').click(function()
{
var whichdiv=$(this).attr("class")
var sender=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$(this).css({'background':'rgba(150,150,150,.5)'})
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdiv:whichdiv, sender:sender, metadata:timedate, subject:subject},
success: function(data) 
{
$("#container").hide()
$("#readpanel").show()
$("#subject").html(subject)
var subjectcheck=$("#subject").text().split(':')
var file=subjectcheck[subjectcheck.length-2]
if(file!='Requesting key')
{
$("#frmto").text("From: ")
$("#username").html(sender)
$("#dateandtime").html(timedate)
$("#replyarea, #quickreplybutton, #readrep, #readpanel #menubar #save").show()
var len=data.length
$("#messagearea").html(data)
}
else
{
$("#menubar #readrep, #replyarea, #quickreplybutton").hide()
$("#username").html(sender)
$("#dateandtime").html(timedate)
var len=data.length
$("#messagearea").html(data)
$('#readpanel #menubar #save').show()
}
},
complete:function(data)
{
}
})
test.abort()
})
/*-----CLOSE MESSAGE-----*/
$("#readpanel #closemessage").click(function()
{
$("#container").show()
$("#readpanel").hide()
$("#readpanel #replybar #replyarea").val('').css({'background':'white'})
$("#messagecntnr #key input[type='password']").val('')
})
/*-------REPLY-------*/
$("#readpanel #readrep").click(function()
{
var subjectstring=$("#subject").text().split(':')
var checksubject=subjectstring[subjectstring.length-2]
if(checksubject=='Requesting key')
{
/*-----------send key---------*/
var sendto=$("#username").text()
var subject=$("#subject").text()
var fullDate = new Date()
console.log(fullDate); 
//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear()
console.log(currentDate);
var time = fullDate.getHours() + ":" + fullDate.getMinutes()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{sendkeyto:sendto, keysubject:subject, sendkeydate:currentDate, sendkeytime:time},
success: function(data) 
{
	alert('yes')
}
})
test.abort()
}
else
{
var subject=subjectstring[subjectstring.length-1]
var resubject="RE:: "+subject
var sendto=$("#username").text()
$("#c_area #to").val(sendto)
$("#c_area #subject").val(resubject)
$("#c_area").show()
$("#readpanel").hide()
}
})
/*-----QUICK REPLY-----*/
$("#readpanel #replybar #quickreplybutton").click(function()
{
var subjectstring=$("#subject").text().split(':')
var subject=subjectstring[subjectstring.length-1]
var resubject="RE:: "+subject
var sendto=$("#username").text()
var message=$("#readpanel #replybar #replyarea").val()
var fullDate = new Date()
console.log(fullDate); 
//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear()
console.log(currentDate);
var time = fullDate.getHours() + ":" + fullDate.getMinutes()
if(message!='')
{
$.ajax
({
type: "POST",
url: "functions.php",
data:{resubject:resubject, sendto:sendto, message:message, qdate:currentDate, qtime:time },
success: function(data) 
{
$("#created").show().append("MESSAGE SENT")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$("#readpanel #replybar #replyarea").val('')
}, 
complete:function(data)
{
}
})
test.abort()
$("#created").text("")
}
else
{
$("#readpanel #replybar #replyarea").css({'background':'#FF0033'})
}
})
/*-----QUICK REPLY WHEN PRESS ENTER-----*/
$("#readpanel #replybar").keypress(function(evt)
{
if(evt.which == 13) 
{
var subjectstring=$("#subject").text().split(':')
var subject=subjectstring[subjectstring.length-1]
var resubject="RE:: "+subject
var sendto=$("#username").text()
var message=$("#readpanel #replybar #replyarea").val()
var fullDate = new Date()
console.log(fullDate); 
//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear()
console.log(currentDate);
var time = fullDate.getHours() + ":" + fullDate.getMinutes()
if(message!='')
{
$.ajax
({
type: "POST",
url: "functions.php",
data:{resubject:resubject, sendto:sendto, message:message, qdate:currentDate, qtime:time },
success: function(data) 
{
$("#created").show().append("MESSAGE SENT")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
$("#readpanel #replybar #replyarea").val('')
}, 
complete:function(data)
{
}
})
test.abort()
$("#created").text("")
}
else
{
$("#readpanel #replybar #replyarea").css({'background':'#FF0033'})
}
}
})
$("#readpanel #replybar #replyarea").click(function()
{
$("#readpanel #replybar #replyarea").css({'background':'white'})
})
/*-----ADD ADDRESS----*/
$("#metareaddata #from #username").click(function()
{
var address=$(this).text()
$.ajax(
{
url:"addbook.php",
type:"POST",
data: {address:address},
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
/*-------DELETE MESSAGE-------*/
$("#readpanel #readdel").click(function()
{
var subjectdel=$("#readingpanel #metareaddata #subject").text()
var usernamedel=$("#readingpanel #metareaddata #from #username").text()
var datetime=$("#readingpanel #metareaddata #dateandtime").text()
var dateandtimestring=datetime.split(',')
var timedel=dateandtimestring[0]
var datetrim=dateandtimestring[1].trim().split('/')
var year="20"+datetrim[2]
var datedel=datetrim[0]+"/"+datetrim[1]+"/"+year
var delfrom=$("#title").text().toLowerCase()
var frmto=$("#frmto").text()
if(delfrom=='trash')
{
$.ajax(
{
url:"functions.php",
type:"POST",
data: {subjectdelper:subjectdel, usernamedelper:usernamedel, timedelper:timedel, datedelper:datedel, frmto:frmto},
cache: false,
success:function(data)
{
$(".msgpanel").load("trash.php")
$("#container").show()
$("#readpanel").hide()
}
})
test.abort()
}
else
{
$.ajax(
{
url:"functions.php",
type:"POST",
data: {subjectdel:subjectdel, usernamedel:usernamedel, timedel:timedel, datedel:datedel, delfrom:delfrom},
cache: false,
success:function(data)
{
$(".msgpanel").load(delfrom+".php")
$("#container").show()
$("#readpanel").hide()
}
})
test.abort()
}
})
/*--------READ SENT MESSAGE----------*/
$('#sentcntnt #isdtcontent').click(function()
{
var whichdiv=$(this).attr("class")
var reciever=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdivsent:whichdiv, reciever:reciever, metadatasent:timedate, subjectsent:subject},
success: function(data) 
{
$("#container, #readpanel #menubar #save, #replyarea, #readrep").hide()
$("#readpanel").show()
$("#subject").html(subject)
$("#frmto").text("To: ")
$("#from #username").html(reciever)
$("#dateandtime").html(timedate)
$("#quickreplybutton").hide()
var len=data.length
$("#messagearea").html(data)
},
complete:function(data)
{
}
})
test.abort()
})
/*--------READ DRAFT MESSAGE----------*/
$('#draftcntnt #isdtcontent').click(function()
{
var whichdiv=$(this).attr("class")
var reciever=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdivdraft:whichdiv, recieverdraft:reciever, metadatadraft:timedate, subjectdraft:subject},
success: function(data) 
{
$("#c_area").show()
$("#c_area #to").val(reciever)
$("#c_area #subject").val(subject)
$(".froala-element").val(data)
$("#container").hide()
},
complete:function(data)
{
}
})
test.abort()
})
/*--------READ TRASH MESSAGE----------*/
$('#trashcntnt #isdtcontent').click(function()
{
var whichdiv=$(this).attr("class")
var sender=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdivtrash:whichdiv, sendertrash:sender, metadatatrash:timedate, subjecttrash:subject},
success: function(data) 
{
$("#container, #replyarea,#readrep, #readpanel #menubar #save, #readpanel #menubar #print, #quickreplybutton").hide()
$("#readpanel").show()
$("#subject").html(subject)
$("#username").html(sender)
$("#dateandtime").html(timedate)
var len=data.length
$("#messagearea").html(data)
},
complete:function(data)
{
}
})
test.abort()
})
/*--------READ SEARCH MESSAGE----------*/
$('.msgpanel #isdtcontent').click(function()
{
var searchitem=$(".search_mail .search-box").val()
var searchin=$(".search_mail #searchin").val()
if(searchin=="Inbox")
{
var whichdiv=$(this).attr("class")
var sender=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
var whichdiv=$(this).attr("class")
var sender=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$("#frmto").text("From: ")
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdiv:whichdiv, sender:sender, metadata:timedate, subject:subject},
success: function(data) 
{
$("#container").hide()
$("#readpanel").show()
$("#subject").html(subject)
$("#username").html(sender)
$("#dateandtime").html(timedate)
$("#replyarea").show()
$("#quickreplybutton").show()
$("#readrep").show()
var len=data.length
$("#messagearea").html(data)
},
complete:function(data)
{
}
})
test.abort()
}
else
{
var whichdiv=$(this).attr("class")
var reciever=$(this).find('p').eq(0).text()
var timedate=$(this).find('p').eq(1).text()
var subject=$(this).find('p').eq(2).text()
$("#frmto").text("To: ")
$.ajax({
type: "POST",
url: "readpanel.php",
data:{whichdivsent:whichdiv, reciever:reciever, metadatasent:timedate, subjectsent:subject},
success: function(data) 
{
$("#container").hide()
$("#readpanel").show()
$("#subject").html(subject)
$("#username").html(reciever)
$("#dateandtime").html(timedate)
$("#replyarea").hide()
$("#quickreplybutton").hide()
$("#readrep").hide()
var len=data.length
$("#messagearea").html(data)
},
complete:function(data)
{
}
})
test.abort()
}
})
/*-----REQUEST KEY-------*/
$('#readingpanel #key span').click(function()
{
var sender=$("#metareaddata #from #username").text()
var subject=$("#metareaddata #subject").text()
var timedate=$("#metareaddata #dateandtime").text()
var fullDate = new Date()
console.log(fullDate); 
//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
var keycurrentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear()
console.log(keycurrentDate);
var keytime = fullDate.getHours() + ":" + fullDate.getMinutes()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{keysender:sender, keysubject:subject, keycurrentDate:keycurrentDate, keytime:keytime},
success: function(data) 
{
alert("done")	
}
})
test.abort()
})
/*------------CHECK KEY------------*/
$("#messagecntnr #key input[type='password']").change(function()
{
var keyentered=$("#messagecntnr #key input[type='password']").val()
var sender=$("#metareaddata #from #username").text()
var subject=$("#metareaddata #subject").text()
$.ajax({
type: "POST",
url: "readpanel.php",
data:{msgsubject:subject, msgsender:sender},
success: function(data) 
{
if(data===keyentered)
{
$('#messagecntnr #key').hide() 
$('#messagearea, #replybar, #readpanel #menubar #readrep').show()
$('#readpanel #menubar #save').attr('disabled',false);
}
}
})
test.abort()
})
/*------SAVE MESSAGE PDF------*/
$("#readpanel #menubar #save").click(function()
{
var subject=$("#subject").text()
var ros=$("#frmto").text()
var sender=$("#username").text()
var metadata=$("#dateandtime").text()
var metadatastring=$("#dateandtime").text().split(',')
var time=metadatastring[0]
var date=metadatastring[1].split('/')
var year="20"+date[2]
var newdate=date[0]+"/"+date[1]+"/"+year
var msgpdf=$('#messagearea').html()
var randomno=Math.floor(Math.random()*9999999)
$.ajax({
type: "POST",
url: "savepdf.php",
data:{savepdfsub:subject, savepdfsender:sender, savepdfdate:newdate, savepdftime:time, savepdfmeta:metadata, rand:randomno, msgpdf:msgpdf, ros:ros},
success: function(data) 
{
/*window.open('data/saved/'+randomno+'.pdf', '_blank')
*/window.location='data/saved/'+randomno+'.pdf'
}
})
test.abort()
})
})