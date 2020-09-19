$(function() 
{
$("#chatmessagebox").keypress(function(evt) 
{
if(evt.which == 13) 
{
var iusername = $("#chatbox #cbheader #cwc").text()
var imessage = $('#chatmessagebox').val()
post_data = {'cusername':iusername, 'message':imessage}
//send data to "shout.php" using jQuery $.post()
$.post('shout.php', post_data, function(data) 
{
//append data into messagebox with jQuery fade effect!
$(data).hide().appendTo('#messagebox').fadeIn()
//keep scrolled to bottom of chat!
var scrolltoh = $('#messagebox')[0].scrollHeight
$('#messagebox').scrollTop(scrolltoh)
//reset value of message box
$('#chatmessagebox').val('')
})
}
})
//toggle hide/show shout box
$("#closechat").click(function (e) 
{
$("#chatbox").hide()
$('#chatmessagebox').val('')
closechat = {'cchat':1};
$.post('shout.php', closechat,  function(data) 
{
});
/*//get CSS display state of .toggle_chat element
var toggleState = $('#togglechat').css('display');
//toggle show/hide chat box
$('#togglechat').slideToggle();
//use toggleState var to change close/open icon image
if(toggleState == 'block')
{
$("#cbheader div").attr('id', 'openchat');
}
else
{
$("#cbheader div").attr('id', 'closechat');
}*/
})
})