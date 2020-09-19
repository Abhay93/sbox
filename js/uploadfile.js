$(function() 
{
// Makes sure the dataTransfer information is sent when we Drop the item in the drop box.
jQuery.event.props.push('dataTransfer');
// Get all of the data URIs and put them in an array
var dataArray = [];
// Bind the drop event to the dropzone.
$('#msafe #newfile').bind('drop', function(e) 
{
// Stop the default action, which is to redirect the page To the dropped file
var files = e.dataTransfer.files;
// Show the upload holder
$('#safeuploaded-holder').show();
$('#msafe #filearea #newfile #text').hide();
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
{$('#safeuploaded-holder span').html("1 file to be uploaded");} 
else
{$('#safeuploaded-holder span').html(dataArray.length+" files to be uploaded");}
$('#safeuploaded-holder').append('<div class="image" style="left: '+z+'px; background: url('+image+'); background-size: cover;"> </div>'); 
}
})(files[index])
// For data URI purposes
fileReader.readAsDataURL(file)
})
})	
function restartFiles() 
{
// This is to set the loading bar back to its default state
$('#safeloading-bar .safeloading-color').css({'width' : '0%'})
$('#safeloading').css({'display' : 'none'})
$('#safeupload-button').show()
$('#safeloading-bar').hide()
$('#safedropped-files > .image').remove()
$('#safeuploaded-holder').hide()
$("#msafe #newfile").css({'box-shadow' : 'none', 'border' : '4px solid #2c82c9'})
$('#msafe #filearea #newfile #text').show()
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
// And finally, empty the array/set z to -40
dataArray.length = 0
return false
test.abort()
}
$('#safeupload-button').click(function() 
{
$('#safeupload-button').hide()
$('#safeloading-bar').show()
var totalPercent = 100 / dataArray.length;
var x = 0;
var y = 0;
$.each(dataArray, function(index, file) 
{	
$.post('uploadfile.php', dataArray[index], function(data) 
{
var fileName = dataArray[index].name
++x
$('#safeuploaded-holder span').html("Uploading...")
// Change the bar to represent how much has loaded
$('#safeloading-bar .safeloading-color').css({'width' : totalPercent*(x)+'%'})
if(totalPercent*(x) == 100) 
{
setTimeout(restartFiles, 500)
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
$('#safeloading-bar .safeloading-color').text('Done')
})
})
return false
})
// Just some styling for the drop file container.
$('#msafe #newfile').bind('dragenter', function() 
{
$(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed red'})
return false
})
$('#msafe #newfile').bind('drop', function() 
{
$(this).css({'box-shadow' : 'none', 'border' : '4px dashed green'})
return false
})
})