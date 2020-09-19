$(function()
{
// Thumbnail preview
$("#column1 img").hover(function()
{
$(this).css({'z-index' : '10'});
$(this).addClass("imgborder")
.animate
({
width: '26%', 
height: '110',
marginTop: '-20px', 
marginLeft: '-10px', 
padding: '0'  // Increase padding size the border of image increased
}, 100);
} , function()
{
$(this).css({'z-index' : '0'});
$(this).removeClass("imgborder")
.animate({
width: '24%', 
height: '95',
marginTop: '0', 
marginLeft: '0',
padding: '0'
}, 200)
})
/*----PREVIEW SELETED IMAGE----*/
$("#column1 a").click(function()
{		
var previewImg = $(this).attr("href"); 
$("#preview img").attr({ src: previewImg })
return false;
})
/*-----CHANGE THEME----*/
$("#change").click(function()
{
var path=$("#preview img").attr('src').split('/')
var file=path[path.length-1]
var name=file.split('.')[0]
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {themename:name},
cache: false,
beforeSend: function()
{
$("#msg").addClass("msg").show()
$("#msg").addClass("msg").html("Loading...")
},
success:function(data)
{ 
$("#msg").addClass("msg").html("Done")
$("head").append("<link rel='stylesheet' href='css/themes/"+name+"/"+name+".css'>")
},
complete:function(data)
{
$("#msg").addClass("msg").hide()
}
})
test.abort()
})
//when clicked on choose option
$("#setowntheme").click(function()
{
$("#theme_options").fadeToggle(500)
$("#mypix").slideUp(500)
$("#change").show()
$("#upload_pix_theme").hide()
$("#preview").show()
})
//when clicked on myphotos option
$("#myphotos").click(function()
{
$("#mypix").slideToggle(500)
$("#preview img").css({'-webkit-filter':'grayscale(1)'})
if($("#change").css('display')=='none')
{
if($("#upload_pix_theme").css('display')=='none')
{
$("#change").show()
$("#preview img").css({'-webkit-filter':'grayscale(0)'})
}
else
{
$("#change").hide()
}
}
else
{
$("#change").hide()
}
})
/*----SELECT AND DELETE USERS PIC----*/
$("#mypix img").hover(function()
{
var selimgpath=$(this).attr("src").split('/')
var selimg=selimgpath[selimgpath.length-1]
var selimgname=selimg.split('.')[0]
$("#mypix #"+selimgname).show()
}, function()
{
var selimgpath=$(this).attr("src").split('/')
var selimg=selimgpath[selimgpath.length-1]
var selimgname=selimg.split('.')[0]
$("#mypix #"+selimgname).hide()
})
/*----CHOOSE USER'S PIC AS THEME----*/
$("#mypix .themeuser").click(function()
{
var path=$(this).attr('src').split('/')
var file=path[path.length-1]
var name=file.split('.')[0]
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {userthemename:name},
cache: false,
beforeSend: function()
{
$("#msg").addClass("msg").show()
$("#msg").addClass("msg").html("Loading...")
},
success:function(data)
{ 
$("#msg").addClass("msg").html("Done")
$("head").append("<link rel='stylesheet' href='data/users/"+data+"/"+name+".css'>")
} ,
complete:function(data)
{
$("#msg").addClass("msg").hide()
}
})	
})
/*-----UPLOAD PIC-----*/
$("#upload_theme_pix").click(function()
{
$("#upload_pix_theme").toggle()
$("#preview").toggle()
$("#change").toggle()
})
/*------DELETE THEME PIC------*/
$("#mypix .deltheme").click(function()
{
var divid=$(this).parent().attr('id')
var picid=divid.substring(0,divid.length-3)
$.ajax(
{
url:"update_info.php",
type:"POST",
data: {deluserthemename:picid},
cache: false,
beforeSend: function()
{
},
success:function(data)
{
$("#img"+picid+"").remove()
$("#"+divid+"").remove()
$("#"+picid+"").remove()
} ,
complete:function(data)
{
}
})
})
/*-----CLOSE-----*/
$("#close").click(function()
{
$("#mypix").hide()
$("#theme_options").hide()
$("#change").show()
$("#msg").hide()
$("#upload_pix_theme").hide()
$("#preview").show()
$("#preview img").css({'-webkit-filter':'grayscale(0)'})
})
})