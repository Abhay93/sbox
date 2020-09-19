$(function() 
{

// Makes sure the dataTransfer information is sent when we Drop the item in the drop box.
jQuery.event.props.push('dataTransfer');
// Get all of the data URIs and put them in an array
var dataArray = [];
// Bind the drop event to the dropzone.
$('#dropsafefiles').bind('drop', function(e) 
{
// Stop the default action, which is to redirect the page To the dropped file
var files = e.dataTransfer.files;
// Show the upload holder
$('#uploadedsafeholder').show();
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
var image = this.result
// Place the image inside the dropzone
$('#droppedsafefiles').append('<div class="image" style="background: url('+image+'); background-size: cover;"> </div>')
}
})(files[index])
// For data URI purposes
fileReader.readAsDataURL(file)
})
})	
})