$(document).ready(function(){
	$("body").append("<div id='swl_loading' style='display:none; position:fixed; z-index:100000; left:0px; top:0px; width:100%; height:100%;'><table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'><tr><td style='text-align:center; vertical-align:middle;'></td></tr></table></div>");
});

function loading_show(loading_background,loading_image){
	if(loading_background == ""){
		$("#swl_loading").css({ "background-color":"#ffffff" });
		$("#swl_loading").find("td").html("<img src='http://iswallows.com/func/loading/loading_white.gif' border='0'/>");
	}else{
		var bg_color = "";
		if(loading_background == "black"){
			bg_color = "#444444";
		}else if(loading_background == "gray"){
			bg_color = "#e1e1e1";
		}else if(loading_background == "white"){
			bg_color = "#ffffff";
		}else{
			bg_color = "#ffffff";
		}
		$("#swl_loading").css({ "background-color":bg_color });
		$("#swl_loading").find("td").html("<img src='http://iswallows.com/func/loading/loading_"+loading_background+".gif' border='0'/>");
	}
	if(loading_image != ""){
		$("#swl_loading").find("td").html("<img src='"+loading_image+"' border='0'/>");
	}
	$("#swl_loading").fadeTo(300,0.9);
}
function loading_hide(){
	$("#swl_loading").fadeOut();
}
