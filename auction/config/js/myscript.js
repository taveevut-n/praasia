$(document).ready(function(){
	$("input[name=btnOk]").click(function(){
		var x_accept = $("input[name=accept]:checked").val();
		if(x_accept==1){
			$("#text_conditionregist").slideUp("slow",function(){
				$("#containerregist").show("slow");
			});
		}
	});
});