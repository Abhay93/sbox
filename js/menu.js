$(function()
{
$(".msgpanel").load("inbox.php")
$("#title").text("Inbox")
$("#inbox").hover(function()
{
$(this).css({'width':'60px', 'height':'60px', 'border-radius':'50%'})
$("#inbox img").css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
}, function()
{
$(this).css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
$("#inbox img").css({'width':'48px', 'height':'48px', 'border-radius':'50%'})
})
$("#draft").hover(function()
{
$(this).css({'width':'60px', 'height':'60px', 'border-radius':'50%'})
$("#draft img").css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
}, function()
{
$(this).css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
$("#draft img").css({'width':'48px', 'height':'48px', 'border-radius':'50%'})
})
$("#sent").hover(function()
{
$(this).css({'width':'60px', 'height':'60px', 'border-radius':'50%'})
$("#sent img").css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
}, function()
{
$(this).css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
$("#sent img").css({'width':'48px', 'height':'48px', 'border-radius':'50%'})
})
$("#trash").hover(function()
{
$(this).css({'width':'60px', 'height':'60px', 'border-radius':'50%'})
$("#trash img").css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
}, function()
{
$(this).css({'width':'55px', 'height':'55px', 'border-radius':'50%'})
$("#trash img").css({'width':'48px', 'height':'48px', 'border-radius':'50%'})
})
/*--------INBOX--------------*/
$("#inbox").click(function()
{
$(".msgpanel").load("inbox.php")
$("#title").text("Inbox")
$("#container, #msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist, #c_area input.sendbutton").show()
$("#c_area, #msafe, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles, #readpanel, #addressbook, #c_area #spinner, #c_area #keypopup, #theme_modal").hide()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
/*----------DRAFT--------------------*/
$("#draft").click(function()
{
$(".msgpanel").load("draft.php")
$("#title").text("Draft")
$("#c_area, #readpanel, #msafe, #addressbook, #theme_modal, #c_area #spinner, #c_area #keypopup, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles").hide()
$("#container,#msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist, #c_area input.sendbutton").show()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
$(".froala-element").val('')
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
/*--------------SENT-------------*/
$("#sent").click(function()
{
$(".msgpanel").load("sent.php")
$("#title").text("Sent")
$("#c_area, #readpanel, #msafe, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles, #addressbook, #theme_modal, #c_area #spinner").hide()
$("#container, #msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist, #c_area input.sendbutton").show()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
/*----------------TRASH--------------*/
$("#trash").click(function()
{
$(".msgpanel").load("trash.php")
$("#title").text("Trash")
$("#c_area, #readpanel, #msafe, #msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles, #addressbook, #theme_modal, #c_area #spinner, #c_area #keypopup").hide()
$("#container, #msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist, #c_area input.sendbutton").show()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#msafe #filearea #safemenu #sharefiles #sharewith textarea").val('')
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
/*-------COMPOSE WINDOW------*/
$("#compose").click(function()
{
$("#c_area").show()
$("#container, #readpanel, #addressbook, #nomails, #msafe, #theme_modal").hide()
$("#account_info").hide()
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
$("#theme_modal").hide()
$("#c_area #to, #c_area #subject").val('')
$("#c_area #msg_area").val('')
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
$("#c_area #close").click(function()
{
$("#c_area, #c_area #keypopup").hide()
$("#container").show();
$("#c_area #to, #c_area #subject, #c_area #keypopup input[type='text']").val('')
$("#c_area #msg_area").val('')
encaction=''
enckey=''
})
$("#omsgs").click(function()
{
$(".msgpanel").load("omsgs.php")
$("#title").text("Others")
$("#c_area, #readpanel, #msafe,#msafe #filearea #myfarea #sharedfiles, #msafe #filearea #safemenu #sharefiles,  #addressbook, #theme_modal, #c_area #spinner, #c_area #keypopup").hide()
$("#container,#msafe #filearea #safecntnr, #msafe #filearea #safemenu #safemenulist, #c_area input.sendbutton").show()
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#2c82c9'})
$("#msafe #filearea #safemenu #safemenulist #sharedwme").css({'color':'#000000'})
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
$("#msafe #filearea").css({'display':'block'})
$("#msafe object, #msafe #fullview, #msafe video").css({'display':'none'})
$("#msafe video, #msafe #fullview").attr({'src':''})
$("#msafe  #closemsafe").show()
$("#msafe  #closepdf, #msafe  #closeimg, #msafe  #closevid").hide()
})
/*-----SEARCH-----*/
$(".search_mail .s_btn").click(function()
{
var searchitem=$(".search_mail .search-box").val()
var searchin=$(".search_mail #searchin").val()
if(searchitem!='' && searchin!='')
{
$.ajax(
{
url:"search.php",
type:"POST",
data: {searchdata:searchitem, searchin:searchin},
cache: false,
success:function(data)
{
var length=data.length
if(length=='73')
{

$("#created").show().append("No search results found")
setTimeout(function() {$("#created").fadeOut('slow')}, 500)
}
else
{
$(".msgpanel").html(data)
}
}
})
}
})
})