$(function(){
	$(".autocomplete_cls").click(function(){
		$(".namepra_container,.mass_container,.roon_container,.pim_container,.wat_container,.geji_container").html("");
	});
});

function checklogin(){
	$.ajax({
		type: "POST",
		url: "checklogin_query.php",
		data: {do_what: "checklogin"},
		cache: false,
		success: function (result){
			if (result == "0"){
				alert("กรุณาเข้าสู่ระบบอีกครั้ง");
				window.location.href = "index.php";
			}
		}
	});
}

var checklogin_timer = setInterval(function (){
	checklogin();
}, 10000);

function translate_slide(x_this){
	var isopen = x_this.attr("isopen");
	if(isopen == "1"){
		x_this.attr("isopen","0");
		x_this.find("span:eq(0)").show();
		x_this.find("span:eq(1)").hide();
		x_this.prev().slideUp();
	}else{
		x_this.attr("isopen","1");
		x_this.find("span:eq(0)").hide();
		x_this.find("span:eq(1)").show();
		x_this.prev().slideDown();
	}
}

function leave_name(){
	var name_text = $.trim($(".name_text").val());
	if(name_text != ""){
		loading_show("black","");
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"leave_name", name_text:name_text },
			cache: false,
			success: function(result){
				loading_hide();
			}
		});
	}
}
function translate_name(x_this){
	var v = $.trim(x_this.val());
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"translate_name", v:v },
			cache: false,
			success: function(result){
				$(".translate_container").html(result);
			}
		});
	}else{
		$(".translate_container").html("");
	}
}
function name_select(x_this){
	var v = $.trim(x_this.html());
	$(".name_text").val(v);
	$(".translate_container").html("");
}

function get_keyword(x_value){
	var keyword = new Array();
	if(x_value.indexOf(',') > -1 ){
		var v_array = x_value.split(',');
		$.each(v_array,function(index,val){
			var x_val = $.trim(val);
			if(x_val.trim()){
				var texthtml = '<div class="new_keyword"><input type="hidden" name="keyword_text[]" value="'+x_val+'"/>'+x_val+'<span class="btnclose" onclick="$(this).parent().remove()">x</span></div>';
				$("#box_keyword").append(texthtml);
				$("#keyword").val('').focus();
			}
		});
	}
}
function tag_delete(x_obj,x_val,x_id){
	x_obj.parent().remove();
	var tag_item = [];

	$.each($("input[name='keyword_text[]']"), function (index, val) {
		tag_item.push(val.value);
	});

	$.ajax({
		url: "backend_notif_delete.php",
		type: "POST",
		dataType: "JSON",
		data: {do_what:"tag_delete",val:x_val,id:x_id,item:tag_item},
		cache: false,
		processData: true,
		success: function (result) {
			// console.log(result)
		}
	});
}

function get_CategoryData(x_val,x_lang){
	$.ajax({
		url: "backend_add_query.php",
		type: "POST",
		dataType: "JSON",
		data: {do_what:"get_CategoryData",val:x_val,lang:x_lang},
		cache: false,
		processData: true,
		success: function (e) {
			$("select[name=pra_category_id]").html('');

			$.each(e.rows, function (index, val) {
				var html_text = '<option value="'+val.catalog_id+'">'+val.catalog_name+'</option>';
				$("select[name=pra_category_id]").append(html_text);
			});
		}
	});
}

function pra_categorytousually(v,x_lang){
	$.ajax({
		url: "backend_add_query.php",
		type: "POST",
		dataType: "JSON",
		data: {do_what:"pra_categorytousually",v:v,lang:x_lang},
		cache: false,
		processData: true,
		success: function (e) {
			var html_usually = '<li><input type="checkbox" checked name="usually[]" value="'+e.data.catalog_id+'">'+e.data.catalog_name+'<a href="javascript:void(0);" onclick="del_usually('+e.data.catalog_id+',$(this));">'+e.lang+'</a></li>';
			$(".box-usually ul").prepend(html_usually);
		}
	});
}

function add_category(x_obj){
	x_obj.next().show();
}

function add_usually(x_lang){
	var main_val = $("select[name=main_id]").val();
	var newCatname_val = $("input[name=newCatname]").val();
	var newCatMeasure_val = $("input[name=newCatMeasure]").val();
	var newCatPorvince_val = $("select[name=newCatPorvince]").val();

	if ( main_val == 0 ) {
		alert('ท่านยังไม่ได้เลือกหมวดหมู่ใหญ่หรือตามภาค');
	}else if ( !$.trim(newCatname_val) ) {
		alert('ท่านยังไม่ได้กรอก ชื่อหมวด / 您还没填 佛牌名');
		$("input[name=newCatname]").focus();
	}else if( !$.trim(newCatMeasure_val) ){
		alert('ท่านยังไม่ได้กรอก ชื่อวัด / 您还没填 寺名');
		$("input[name=newCatMeasure]").focus();
	}else{
		$.ajax({
			url: "backend_add_query.php",
			type: "POST",
			dataType: "JSON",
			data: {do_what:"add_usually",lang:x_lang,main_val:main_val,newCatname_val:newCatname_val,newCatMeasure_val:newCatMeasure_val,newCatPorvince_val:newCatPorvince_val},
			cache: false,
			processData: true,
			success: function (e) {
				if(e.result){
					var html_usually = '<li><input type="checkbox" checked name="usually[]" value="'+e.data.catalog_id+'">'+e.data.catalog_name+'<a href="javascript:void(0);" onclick="del_usually('+e.data.catalog_id+',$(this));">'+e.lang+'</a></li>';
					$(".box-usually ul").prepend(html_usually);
					$("input[name=category_name]").val('').focus();
				}else{
					alert('หมวดหมู่ที่ท่านกรอก มีอยู่แล้ว กรุณาตรวจสอบใหม๋อีกครั้ง');
				}

			}
		});
	}

}

function del_usually(x_id,x_obj){
	var main_val = $("select[name=main_id]").val();

	x_obj.parent().remove();

	$.ajax({
		url: "backend_add_query.php",
		type: "POST",
		dataType: "JSON",
		data: {do_what:"del_usually",x_id:x_id,main_val:main_val},
		cache: false,
		processData: true,
		success: function (e) {
			// console.log(e)
		}
	});
}
function namepra_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"namepra_search", v:v },
			cache: false,
			success: function(result){
				$(".namepra_container").html(result);
			}
		});
	}else{
		$(".namepra_container").html("");
	}
}
function namepra_select(v){
	$("input[name=namepra]").val(v);
	$(".namepra_container").html("");
}
function mass_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"mass_search", v:v },
			cache: false,
			success: function(result){
				$(".mass_container").html(result);
			}
		});
	}else{
		$(".mass_container").html("");
	}
}
function mass_select(v,v_id){
	$("input[name=mass]").val(v_id);
	$("input[name=mass_name]").val(v);
	$(".mass_container").html("");
}

function roon_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"roon_search", v:v },
			cache: false,
			success: function(result){
				$(".roon_container").html(result);
			}
		});
	}else{
		$(".roon_container").html("");
	}
}
function roon_select(v,v_id){
	$("input[name=roon]").val(v_id);
	$("input[name=roon_name]").val(v);
	$(".roon_container").html("");
}

function pim_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"pim_search", v:v },
			cache: false,
			success: function(result){
				$(".pim_container").html(result);
			}
		});
	}else{
		$(".pim_container").html("");
	}
}
function pim_select(v,v_id){
	$("input[name=pim]").val(v_id);
	$("input[name=pim_name]").val(v);
	$(".pim_container").html("");
}

function wat_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"wat_search", v:v },
			cache: false,
			success: function(result){
				$(".wat_container").html(result);
			}
		});
	}else{
		$(".wat_container").html("");
	}
}
function wat_select(v){
	$("input[name=wat]").val(v);
	$(".wat_container").html("");
}

function geji_search(v){
	if(v != ""){
		$.ajax({
			type: "POST",
			url: "backend_query.php",
			data: { do_what:"geji_search", v:v },
			cache: false,
			success: function(result){
				$(".geji_container").html(result);
			}
		});
	}else{
		$(".geji_container").html("");
	}
}
function geji_select(v){
	$("input[name=geji]").val(v);
	$(".geji_container").html("");
}
function cn_slide(x_this){
	var isopen = x_this.attr("isopen");
	if(isopen == "1"){
		x_this.attr("isopen","0");
		x_this.find("span:eq(0)").show();
		x_this.find("span:eq(1)").hide();
		x_this.prev().slideUp();
	}else{
		x_this.attr("isopen","1");
		x_this.find("span:eq(0)").hide();
		x_this.find("span:eq(1)").show();
		x_this.prev().slideDown();
	}
}

function FormValidation(){
	var x_name = $("input[name=name]");
	var x_main_id = $("select[name=main_id]");
	var x_usually = $('input[ name="usually[]"]:checked').length;
	var x_pra_category_id = $('select[ name="pra_category_id"]');
	var x_release = $('select[ name="release"]');
	var x_watprice = $('input[ name="watprice"]:checked').length;
	var x_other = $('input[ name="other"]:checked').length;
	var x_certificate = $('input[ name="certificate"]:checked').length;

	if(!$.trim(x_name.val())){
		alert('กรุณากรอกข้อมูลพระเครื่องให้ครบถ้วน 请把资料填完整');
		x_name.focus();
		return false;
	}
	// else if(x_main_id.val() == 0){
	// 	alert('ท่านยังไม่เลือก หมวดหมู่ใหญ่หรือตามภาค 您还没选择 泰国部级佛牌分类区');
	// 	x_main_id.focus();
	// 	return false;
	// }
	else if(x_usually == 0 && x_pra_category_id.val() == 0){
		alert('ท่านยังไม่เลือกหมวดหมู่ย่อย 您还没选择总站佛牌分别区');
		return false;
	}else if((x_watprice == 0 && x_other == 0) && x_release.val() == 0){
		alert('กรุณาเลือกพระเก่า / 老牌 - พระใหม่ / 新牌');
		return false;
	}else if(x_certificate == 1 && x_release.val() == 0){
		alert('กรุณาเลือกพระเก่า / 老牌 - พระใหม่ / 新牌');
		return false;
	}else if((x_watprice == 1 && x_other == 1) && x_release.val() == 0){
		alert('กรุณาเลือกอย่างใดอย่างหนึ่ง (เปิดจองพระใหม่ + พระใหม่ราคาวัด หรือ สินค้าเบ็ดเตล็ด \n 只能选择一种分类区而己(预定新牌+庙价牌区或者杂项区)');
		return false;
	}else if((x_watprice == 1 || x_other == 1) && x_release.val() != 0){
		alert('ท่านได้เลือก (เปิดจองพระใหม่ + พระใหม่ราคาวัด หรือ สินค้าเบ็ดเตล็ด) แล้ว ไม่สามารถเลือก ประเภทพระเครื่อง (พระเก่า-ใหม่) ได้อีก \n 您已选择(预定新牌+庙价牌区或是杂项区)，就不能再加选择佛牌类型区(新牌-老牌)');
		return false;
	}else{
		loading_show('gray','');
		return true;
	}
}
