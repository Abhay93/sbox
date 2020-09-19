$(function()
{
$("#bold").click(function()
{
/*$$("#msg_area").css({'font-weight':'bold'})
})
$("#editor_menu #italic").click(function()
{
$("#msg_area").css({'font-style':'italic'})
})
$("#editor_menu #underline").click(function()
{
$("#msg_area").css({'text-decoration':'underline'})
})
$("#editor_menu #left").click(function()
{
$("#msg_area").css({'text-align':'left'})
})
$("#editor_menu #center").click(function()
{
$("#msg_area").css({'text-align':'center'})
})
$("#editor_menu #right").click(function()
{
$("#msg_area").css({'text-align':'right'})
})*/
   // obtain the object reference for the <textarea>
   var txtarea = document.getElementById("msg_area");
    // obtain the index of the first selected character
    var start = txtarea.selectionStart;
    // obtain the index of the last selected character
    var finish = txtarea.selectionEnd;
    // obtain the selected text
    var sel = txtarea.value.substring(start, finish);
	$(sel).addClass('text')
	alert(sel)
	
})
})

