$(function(){
	$('.nav > li').hover(
		function(){
			$(this).children('ul').slideDown(300);   
		},
		function(){
			$(this).children('ul').slideUp(200);
		})
});


$(function(){
	$('.quick > li').hover(
		function(){
			$(this).children('ul').slideDown(300);   
		},
		function(){
			$(this).children('ul').slideUp(200);
		})
});
