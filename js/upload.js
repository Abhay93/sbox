$(function() 
{
var maxFiles = 1;
// Makes sure the dataTransfer information is sent when we Drop the item in the drop box.
jQuery.event.props.push('dataTransfer');
// Get all of the data URIs and put them in an array
var dataArray = [];
// Bind the drop event to the dropzone.
$('#drop-files').bind('drop', function(e) 
{
// Stop the default action, which is to redirect the page To the dropped file
var files = e.dataTransfer.files;
// Show the upload holder
$('#uploaded-holder').show();
$('#account_info #imgcontainer #uploadpic #drop-files #text').hide();
// For each file
$.each(files, function(index, file) 
{
if (!files[index].type.match('image.*')) 
{
alert('Hey! Images only');
$('#uploaded-holder').hide();
return false;
}
// Start a new instance of FileReader
var fileReader = new FileReader()
// When the filereader loads initiate a function
fileReader.onload = (function(file) 
{
return function(e) 
{ 
// Push the data URI into an array
dataArray.push({name : file.name, value : this.result})
if($('#dropped-files > .image').length < maxFiles) 
{
var image = this.result
// Place the image inside the dropzone
$('#dropped-files').append('<div class="image" style="background: url('+image+'); background-size: cover;"> </div>')
}
}
})(files[index])
// For data URI purposes
fileReader.readAsDataURL(file)
})
})	
function restartFiles() 
{
// This is to set the loading bar back to its default state
$('#loading-bar .loading-color').css({'width' : '0%'})
$('#loading').css({'display' : 'none'})
$('#upload-button').show()
$('#loading-bar').hide()
$('#dropped-files > .image').remove()
$('#uploaded-holder').hide()
// And finally, empty the array/set z to -40
dataArray.length = 0
return false
}
$('#upload-button').click(function() 
{
$('#upload-button').hide()
$('#delete-button').hide()
$('#loading-bar').show()
var totalPercent = 100 / dataArray.length;
var x = 0;
var y = 0;
$.each(dataArray, function(index, file) 
{	
$.post('uploadpic.php', dataArray[index], function(data) 
{
var fileName = dataArray[index].name
++x
// Change the bar to represent how much has loaded
$('#loading-bar .loading-color').css({'width' : totalPercent*(x)+'%'})
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
$('#loading-bar .loading-color').text('Done')

})
})
return false
})
$('#dropped-files #delete-button').click(restartFiles);
// Just some styling for the drop file container.
$('#drop-files').bind('dragenter', function() 
{
$(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bb2b2b'})
return false
})
$('#drop-files').bind('drop', function() 
{
$(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'})
return false
})
})