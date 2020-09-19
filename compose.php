<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="js/editor/css/font-awesome.min.css" />
<link rel="stylesheet" href="js/editor/css/froala_editor.css" />
<link rel="stylesheet" href="js/editor/css/froala_page.css" />
<script src='js/attachment.js'></script>
<script src="js/editor/js/froala_editor.min.js"></script>
<script src="js/editor/js/plugins/tables.min.js"></script>
<script src="js/editor/js/plugins/font_size.min.js"></script>
<script src="js/editor/js/plugins/font_family.min.js"></script>
<script src="js/editor/js/plugins/colors.min.js"></script>
<script src="js/editor/js/plugins/lists.min.js"></script>
<script src="js/editor/js/plugins/tables.min.js"></script>
<script src="js/editor/js/plugins/file_upload.min.js"></script>
<script>
var encaction=''
var enckey=''
var selfdestruct=''
$(function() 
{
$('#msg_area').editable({inlineMode: false,
// Defines the list of buttons that are available in the editor.
buttons: ["bold", "italic", "underline", "subscript", "superscript", "fontSize", "fontFamily", "color",  "align", "insertOrderedList", "insertUnorderedList", "createLink", "insertImage", "table", "undo", "redo", "Encrypt", "Save"], 
placeholder: "Type Message...",
spellcheck: true,
/*imageErrorCallback: false,
imageUploadParam: "file", // Customize the name of the param that has the image file in the upload request.
imageUploadURL: "/data/iim",*/
customButtons: 
{
/*-----SAVE-----*/
Save: 
{
title: 'Save',
icon: {type: 'img', value: 'data/data/saved.png'},
callback: function () 
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
if(subject!='')
{
$.ajax(
{
url:"functions.php",
type:"POST",
data: {todraft:to, subjectdraft:subject, messageBodydraft:messagebody, datedraft:currentDate, timedraft:time},
cache: false,
beforeSend:function(data)
{
$("#c_area input.sendbutton").hide()
$("#c_area #spinner").show()
},
success:function(data)
{
},
complete:function(data)
{
$("#c_area #to").val('')
$("#c_area #subject").val('')
$("#c_area #msg_area").val('')
$("#c_area input.sendbutton").hide()
$("#c_area #spinner").hide()
$("#created").show().append("Saved Successfully")
setTimeout(function() {$("#created").fadeOut('slow'); $("#created").text('')}, 500)
}
})
test.abort()
}
},
refresh: function () 
{console.log ('do alert refresh');}
},
/*-----ENCRYPT-----*/
Encrypt: 
{
title: 'Encrypt',
icon: {type: 'img', value: 'data/data/edm.png'},
callback: function () 
{
$("#c_area #keypopup").show()
$(document.body).mousedown(function(event) 
{
var target = $(event.target);
if (!target.parents().andSelf().is('#c_area #keypopup')) 
{ // Clicked outside
$('#c_area #keypopup').hide();
}
})
$('#c_area #keypopup button').click(function()
{
if($("#c_area #keypopup input[type='text']").val()!='')
{
encaction='y'
enckey=$("#c_area #keypopup input[type='text']").val()
}
if($('#destructcheck').is(':checked'))
selfdestruct="y"
$("#c_area #keypopup").hide()
$("#c_area #keypopup input[type='text']").val('')
})
$('#c_area #keypopup img').click(function()
{
encaction=''
enckey=''
selfdestruct=""
$("#c_area #keypopup").hide()
$("#c_area #keypopup input[type='text']").val('')
$('#destructcheck').prop('checked', false)
})
},
refresh: function () 
{console.log ('do alert refresh');}
}
}
})
});
</script>
<div id="c_area">
<input type="text" placeholder="To" name="to" id="to" />
<input class="sendbutton" type="submit" alt="Send" name="send" value="Send" />
<img src="data/data/spinner.gif" id="spinner" />
<img src="data/data/close.png" id="close">
<input type="text" placeholder="Subject" name="sub" id="subject" />
<textarea name="msg" id="msg_area" contenteditable="true" wrap="virtual" ></textarea>
<!-----------ATTACHMENT---------->
<div id="attachments" ondragover="return false">
<div id="text">DROP FILES HERE</div>
<div id="attachedfiles"></div>
<div id="attachuploaded-holder">
<span></span>
<button id="attachupload-button">Upload</button>
<div id="attachloading-bar">
<div class="attachloading-color"> </div>
</div>
</div>
</div>
<!----------ENCRYPTION------------>
<div id="keypopup"><img src="data/data/close.png" id="keypopupclose"><br /><span>Enter Key:</span> <input type="text" /placeholder="Enter Key..."><button id="ok">OK</button><p id='destruct'><label for="destructcheck">Self Distruct </label><input type="checkbox" id="destructcheck" /></p><p id='canenc'>Cancel Encryption</p></div>
</div>