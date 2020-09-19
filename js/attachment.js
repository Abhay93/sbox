$(function() 
{
// Makes sure the dataTransfer information is sent when we Drop the item in the drop box.
jQuery.event.props.push('dataTransfer');
// Get all of the data URIs and put them in an array
var dataArray = [];
// Bind the drop event to the dropzone.
$('#c_area #attachments').bind('drop', function(e) 
{
// Stop the default action, which is to redirect the page To the dropped file
var files = e.dataTransfer.files;
// Show the upload holder
$('#attachuploaded-holder').show();
$('#c_area #attachments #text').hide();
$('#c_area #attachments #attachedfiles').hide();
// For each file
$.each(files, function(index, file) 
{
// Start a new instance of FileReader
var fileReader = new FileReader()
// When the filereader loads initiate a function
fileReader.onload = (function(file) 
{
return function(e) 
{ 
// Push the data URI into an array
dataArray.push({name : file.name, value : this.result})
if(dataArray.length == 1) 
{$('#attachuploaded-holder span').html("1 file to be uploaded");} 
else
{$('#attachuploaded-holder span').html(dataArray.length+" files to be uploaded");} 
}
})(files[index])
// For data URI purposes
fileReader.readAsDataURL(file)
})
})	
function restartFiles() 
{
// This is to set the loading bar back to its default state
$('#attachloading-bar .attachloading-color').css({'width' : '0%'})
$('#attachloading').css({'display' : 'none'})
$('#attachupload-button').show()
$('#attachloading-bar').hide()
$('#attachdropped-files > .image').remove()
$('#attachuploaded-holder').hide()
$("#c_area #attachments").css({'box-shadow' : 'none', 'border' : '1px solid #2c82c9'})
$('#c_area #attachments #attachedfiles').show();
// And finally, empty the array/set z to -40
dataArray.length = 0
return false
test.abort()
}
$('#attachupload-button').click(function() 
{
$('#attachupload-button').hide()
$('#attachloading-bar').show()
var totalPercent = 100 / dataArray.length;
var x = 0;
var y = 0;
$.each(dataArray, function(index, file) 
{	
$.post('attachment.php', dataArray[index], function(data) 
{
var fileName = dataArray[index].name
++x
// Change the bar to represent how much has loaded
$('#attachloading-bar .attachloading-color').css({'width' : totalPercent*(x)+'%'})
if(totalPercent*(x) == 100) 
{
setTimeout(restartFiles, 500)
$('#c_area #attachments #attachedfiles').append("<span id='attachname'>"+fileName+"<img id='remattachment' src='data/data/close.png' alt='"+fileName+"'></span>,")
}
var dataSplit = data.split(':')
if(window.localStorage.length == 0) 
{
y = 0;
} 
else
{
y = window.localStorage.length
}
window.localStorage.setItem(y, realData)

})
})
return false
})
$('#c_area #attachments #attachedfiles').on('click', 'img', function (event) 
{
restartFiles()
})
// Just some styling for the drop file container.
$('#c_area #attachments').bind('dragenter', function() 
{
$(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed red'})
return false
})
$('#c_area #attachments').bind('drop', function() 
{
$(this).css({'box-shadow' : 'none', 'border' : '4px dashed green'})
return false
})
})