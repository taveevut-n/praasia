<!DOCTYPE html>
<html>
<body>

<head><title>Page 1</title></head>

    <h1><a href=gg>test!</a></h1>
<script>


var detectOS = "Unknown OS";

if (navigator.appVersion.indexOf("Win") != -1) 
    detectOS = "Windows";

if (navigator.appVersion.indexOf("Mac") != -1) 
    detectOS = "MacOS";

if (navigator.appVersion.indexOf("Linux") != -1) 
    detectOS = "Linux";

if (navigator.appVersion.indexOf("PlayStation") != -1) 
    detectOS = "PlayStation";

let yes=' '
let x = alert(`Device OS is: ${detectOS}`)
console.log(x+yes);
</script>


<script>
			
			var last_pico8_player_layout_hash = 0;
			var pico8_player_button_w = 24;

			function update_pico8_player_layout()
			{
				
				var canvas = document.getElementById("canvas");
				var banner = document.getElementById("banner");
				var p8_frame = document.getElementById("p8_frame")
				var p8_menu_buttons = $("p8_menu_buttons");

				if (!canvas || !banner || !p8_frame || !p8_menu_buttons)
				{
					last_pico8_player_layout_hash = -55; // should still be invalid though
					requestAnimationFrame(update_pico8_player_layout);
					// console.log("@@ skipping update_pico8_player_layout (not ready)");
					return;
				}
				
				// console.log("@@ calling update_pico8_player_layout");

				// calculate scale

				var scale = 8;

				while (scale > 1 && (scale*480 > window.innerWidth || scale*210 > window.innerHeight*0.95))
//					scale -= 1/8; //!!  favor size and layout over pixel perfectness
					scale -= 1/2;

				var banner_w = window.innerWidth - 8; //!! why is -8 needed? scrollbar? isn't it supposed to be cause by hidden overflow anyway?
				var banner_h = 210*scale;
				var csize = scale * 128;
				var csize_w = scale * 144;
				var csize_h = scale * 136;

				var cart_w = scale * 160/4;
				var cart_h = scale * 205/4;

				var layout_hash = banner_w + banner_h * 1000;
				if (typeof(p8_is_running) !== 'undefined' && p8_is_running) layout_hash += 10001;
				//if (p8_is_running) layout_hash += 10001; // hrrm

				// last_pico8_player_layout_hash = 0; // !!!!!!!!!!!!!!     every frame while debugging

				if (last_pico8_player_layout_hash == layout_hash)
				{
					// no need to update this frame
					requestAnimationFrame(update_pico8_player_layout);
					//console.log("@@ skipping update_pico8_player_layout (no change)");
					return;
				}

				console.log("@ regenerating layout "+last_pico8_player_layout_hash);

				last_pico8_player_layout_hash = layout_hash;


				// set sizes and positions

				if (banner)
				{
					banner.style.width = banner_w;
					banner.style.height = banner_h;
				}

				pico8_player_button_w = 24 * csize_w / 512;

				if (canvas)
				{
					canvas.style.width = csize_w;
					canvas.style.height = csize_h;
					canvas.style.left = banner_w/2 - csize_w/2;
					canvas.style.top = banner_h/2 - csize_h/2 + 10*scale;
				}

				// p8_frame: match canvas
				if (p8_frame)
				{
					p8_frame.style.width = csize_w;
					p8_frame.style.height = csize_h;
					p8_frame.style.left = banner_w/2 - csize_w/2;
					p8_frame.style.top = banner_h/2 - csize_h/2 + 10*scale;
				}

				// power-on gif

				start_player_gif = document.getElementById("start_player_gif");
				if (start_player_gif)
				{
					start_player_gif.width = csize;
					start_player_gif.height = csize;
					start_player_gif.style.left = banner_w/2 - csize/2;
					start_player_gif.style.top = banner_h/2 - csize/2 + 10*scale;
				}

				// adjust vertical position of menu buttons
				p8_menu_buttons = document.getElementById("p8_menu_buttons");
				if (p8_menu_buttons)
				{
					p8_menu_buttons.style.marginTop = csize_h - (pico8_player_button_w*5);
				}

				// carts
				
				var tv_left = banner_w/2 - 90*scale;
				var tv_right = banner_w/2 + 90*scale;
				var tv_bottom = banner_h - 15*scale;

				var els = document.getElementsByClassName("p8cart");
				var lels = document.getElementsByClassName("p8cart_label");
				for (i = 0; i < els.length; i++)
				{
					var el = els[i];
					if (el && el.style) // sanity
					{
						el.style.width = cart_w;
						el.style.height = cart_h;

						// label

						if (lels && lels.length == els.length)
						{
							lel = lels[i]; // to do: don't rely on this
							lel.style.width = cart_w * 128 / 160;
							lel.style.height = cart_w * 128 / 160;

							lel.style.left = 16 * cart_w/160;
							lel.style.top = -181 * cart_w/160;
						}
					}
					else
						last_pico8_player_layout_hash = -77;
				}

				// first 6: grid on left
				
				for (y = 0; y < 2; y++)
					for (x = 0; x < 3; x++)
					{
						var el = els[x + y*3];
						if (el){
							el.style.left = tv_left - (x+1)*(cart_w*1.15);
							el.style.top = tv_bottom - ((1-y)+1)*(cart_h*1.1);
						}else last_pico8_player_layout_hash = -77;
					}

				// last 9: grid on right
				
				for (y = 0; y < 3; y++)
					for (x = 0; x < 3; x++)
					{
						var el = els[6+x + y*3];
						if (el){
							el.style.left = tv_right + cart_w*0.15 + (x)*(cart_w*1.15);
							el.style.top = tv_bottom - ((2-y)+1)*(cart_h*1.1);
						} else last_pico8_player_layout_hash = -77;
					}

				// top left: pico-8 logo, download button, cart info. all inside banner_info
				// occupies 3x1 carts

				var banner_info = document.getElementById("banner_info");
				if (banner_info)
				{
					banner_info.style.left = tv_left  - (3 * cart_w*1.15);
					banner_info.style.top = tv_bottom - (3 * cart_h*1.1);
					banner_info.style.width = cart_w*3.3;
					banner_info.style.height = cart_h*1.5;
				} else last_pico8_player_layout_hash = -77;

				// p8_menu_buttons position

				
				if (p8_menu_buttons && p8_menu_buttons.style) // sanity
				{
					p8_menu_buttons.style = "";
					p8_menu_buttons.style.zIndex = 50000;
				} else last_pico8_player_layout_hash = -77;

				els = document.getElementsByClassName("p8_menu_button");
				for (i = 0; i < els.length; i++)
				{
					var el = els[i];
					if (el)
					{
						el.style = "position:absolute;margin-left:"+(144*scale)+"px";
						el.style.top = (75 + i * 10) * scale;
					} else last_pico8_player_layout_hash = -77;
				}

				// invalidate buttons layout
				p8_buttons_hash = -33;

				requestAnimationFrame(update_pico8_player_layout);
			}
			requestAnimationFrame(update_pico8_player_layout);

			// called from p8_run_cart()
			function p8_run_cart_onrun(cid)
			{
				last_pico8_player_layout_hash = 0; // update layout

				// hide start gif
				var start_player_gif = document.getElementById("start_player_gif");
				if (start_player_gif) start_player_gif.style.display="none";

				// update cart info

				var el = document.getElementById("p8tv_cart_info");
				for (i = 0; i < 15; i++)
				if (p8tv_dat[i][1] == cid)
				{
					var user_url="/bbs/?uid="+p8tv_dat[i][5];
					el.innerHTML =
`
				<table cellpadding=0 cellspacing=0 width=100% height=100%><tr>
					<td width=54><a href="`+user_url+`"><img src="`+p8tv_dat[i][7]+`" width=48 height=48 style="max-height:90%"></a></td>
					<td width style="color:#fff; font-size:1.7vh">
						<div style="">
						<span style="color:#99a">Now playing </span><a href="`+p8tv_dat[i][3]+`">`+p8tv_dat[i][8]+`</a><br>
						</div><div style="margin-top:2%">
						<div style="float:left">
						<span style="color:#99a;">by </span><a href="`+user_url+`">@`+p8tv_dat[i][6]+`</a>
						</div>
						<div style="display:inline;">`+p8tv_dat[i][9]+`</div>
						</div>
						</td>
				</tr></table>
`;
				}
			}


			</script>

<script>
	// globals
	var p8_is_running = false;
	var p8_script = null;
	var Module = null;
	var codo_textarea = null;
	var menu_buttons_extra_hack = 0;

	var p8_current_playing_lid = null;

	function p8_document()
	{
		/*
		if (p8_current_playing_lid)
		{
			var playing_div = document.getElementById("cart_player_"+p8_current_playing_lid);
			if (playing_div)
				return playing_div;
		}
		*/

		return document;
	}


	// Default shell for PICO-8 0.1.12

	// options

	// p8_autoplay true to boot the cartridge automatically after page load when possible
	// if the browser can not create an audio context outside of a user gesture (e.g. on iOS), p8_autoplay has no effect
	var p8_autoplay = false;

	// When pico8_state is defined, PICO-8 will set .is_paused, .sound_volume and .frame_number each frame 
	// (used for determining button icons)
	var pico8_state = [];

	// use to send keypresses 
//	var codo_key_buffer = [];
	var codo_key_buffer = [];
	var p8_keyboard_state = 0; // mode (toggle with shift)

	// When pico8_buttons is defined, PICO-8 reads each int as a bitfield holding that player's button states
	// 0x1 left, 0x2 right, 0x4 up, 0x8 right, 0x10 O, 0x20 X, 0x40 menu
	// (used by p8_update_gamepads)
	var pico8_buttons = [0, 0, 0, 0, 0, 0, 0, 0]; // max 8 players

	// When pico8_mouse is defined and .length>0, PICO-8 reads the 3 integers as X, Y and a bitfield for buttons: 0x1 LMB, 0x2 RMB
	var pico8_mouse = [];

	// used to display number of detected joysticks
	var pico8_gamepads = {};
	pico8_gamepads.count = 0;

	// When pico8_gpio is defined, reading and writing to gpio pins will read and write to these values
	var pico8_gpio = new Array(128);

	// When pico8_audio_context context is defined, the html shell (this file) is responsible for creating and managing it
	// Otherwise, PICO-8 will create its own one
	var pico8_audio_context;

	

	p8_gfx_dat={
			"p8b_pause1": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAOUlEQVRIx2NgGPbg/8cX/0F46FtAM4vobgHVLRowC6hm0YBbQLFFoxaM4FQ0dHPy0C1Nh26NNugBAAnizNiMfvbGAAAAAElFTkSuQmCC",
"p8b_controls":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAQ0lEQVRIx2NgGAXEgP8fX/ynBaap4XBLhqcF1IyfYWQBrZLz0LEAlzqqxQFVLcAmT3MLqJqTaW7B4CqLaF4fjIIBBwBL/B2vqtPVIwAAAABJRU5ErkJggg==",
"p8b_full":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAN0lEQVRIx2NgGPLg/8cX/2mJ6WcBrUJm4CwgOSgGrQVEB8WoBaMWDGMLhm5OHnql6dCt0YY8AAA9oZm+9Z9xQAAAAABJRU5ErkJggg==",
"p8b_pause0":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAKUlEQVRIx2NgGHbg/8cX/7FhctWNWjBqwagFoxaMWjBqwagF5Fkw5AAAPaGZvsIUtXUAAAAASUVORK5CYII=",
"p8b_sound0":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAANklEQVRIx2NgGDHg/8cX/5Hx0LEA3cChYwEugwavBcRG4qgFoxYMZwuGfk4efqXp8KnRBj0AAMz7cLDnG4FeAAAAAElFTkSuQmCC",
"p8b_sound1":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAPUlEQVRIx2NgGDHg/8cX/5Hx0LEA3cChYwEugwhZQLQDqG4BsZFIKMhGLRi1YChbMPRz8vArTYdPjTboAQCSVgpXUWQAMAAAAABJRU5ErkJggg==",
"p8b_close":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAU0lEQVRIx2NkoDFgpJsF/z+++I8iwS9BkuW49A+cBcRaREgf/Swg1SJi1dHfAkIG4EyOOIJy4Cwg1iJCiWDUAvItGLqpaOjm5KFfmg79Gm3ItioAl+mAGVYIZUUAAAAASUVORK5CYII=",

"p8b_cart":'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAZ0lEQVR4Ae2dsQrAMAhEa+ie1f//uq79Ajs1OKRyiGDTeuAQAr4cp5lpU5LzEH32ijqPvi2ioaUpgDqTp2BApHbrEs3k6fV5GRSgAD8DmJtsbegaDpb4iz6eAao7q5njHAfo9Lxiii5mqxbMNtaN0wAAABB0RVh0TG9kZVBORwAyMDExMDIyMeNZtsEAAAAASUVORK5CYII=',

"controls_left_panel":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAYAAAB5fY51AAAEI0lEQVR42u3dMU7DQBCG0Tjam9DTcP8jpEmfswS5iHBhAsLxev/hvQY6pGXyZRTQ+nQCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHqbHEEtl+vt7hS+fLy/mXHBQqxEi/6aI/AiFW9SnB2BWDkDBAtAsADBAhAsAMECBAtAsAAECxAsAMECECxAsAAEC0CwONJ8tYvrXRAsImK19j0IFsPGSrQQLCJiNV+et7xAT7QQLIaN1dr3ooVgMWysRAvBIipWooVgERUr0UKwiIqVaCFYRMVKtBAsomIlWggWUbESLQSLqFiJFoJFVKxEC8EiKlaihWARFSvRQrDYJSSVfhaCBSBYAIIFCBbAHpoj4Bl/scOGBWDD4lX8iwE2LADBAgQLQLAABAsQLADBAhAsQLAABAtAsADBAhAsAMECBAtAsAAECxAsAMECECxAsAAECxAsAMECECxAsMh1ud7uTsHZVDcZyFo8Yt5sVJ6NyUAaSNEyIymaXwZepIKd4mwoQbAFC0CwAMECECwAwQIEC0CwAAQLECwAwQIQLECwAAQLQLAAwQI4UHME2/10QZq7usyBObBhRQwpmBUb1nADuPbuaUD/p2ezMH+1admwhosVfBcxb2SCJVaIlmAhVoiWYIkVoiVagiVWiJZgiZVYIVqCJVaIlmgJllghWoIlViBagiVWiJZoCZZYIVqCJVYgWoIlViBaggUIlnc0sPELlmghVmIlWKKFWAmWaIFYCZZoIVYIlmghVoIlWiBWgiVaiJVgIVqIlWCJFoiVYIkWYiVYiBZiJViihViJ1XbNEWyL1mMQRYvfvIGJlQ1rmE0LzIoNyyBiDrBhAYIFIFiAYAEIFoBgAYIFIFgAggUIFoBgAQgWIFgAggUgWIBgDc+Nn1D/tdH8YupwgZy5qG4ykKIlVmZDsDjshSlazqQqH7p793Q2CBaAYAGCBSBYAIIFCBaAYAEIFiBYAIIFIFiAYAEIFoBgAYIFIFgAggUIFoBgAQgWIFgAggUgWIBgAQgWwENzBKxZPub9CJ7WjA0LsGFRV+9N5+jNDhsWgGABggUgWACCxW56fgjuA3cEiz9Z/nWwR0iWP8P/YCFYDBstsUKwiIiWWCFYRERLrBAsIqIlVggWEdESKwSLiGiJFYJFRLTECsEiIlpihWARES2xQrCIiJZYIVhEREusECwioiVWCBYx0RIrBIuoaIkVr+YhFHTZtMCGBQgWgGABCBYgWACCBSBYgGABCBaAYAGCBSBYAIIFCBbj2uOR8s6AEbhexgsWYri3SKhKczcXAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMA2n+e0UMDzh3yTAAAAAElFTkSuQmCC",


"controls_right_panel":"data:image/png;base64,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",

	};

	// added w/ pico-8 0.2.1: dummys listeners on document required to allow touch events inside iframe (e.g. itch.io player)

	document.addEventListener('touchstart', {});
	document.addEventListener('touchmove', {});
	document.addEventListener('touchend', {});

	// --------------------------------------------------------------------------------------------------------------------------------
	// pico-8 0.2.2: allow dropping files
	var p8_dropped_cart = null;
	var p8_dropped_cart_name = "";
	function p8_drop_file(e)
	{
		// console.log("@@ dropping file...");
	
		e.stopPropagation();
		e.preventDefault();

		let file = null;

		// dropped file
		if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0])
			file = e.dataTransfer.files[0]

		// file selected via chooser
		if (!file && e.target && e.target.files && e.target.files[0])
			file = e.target.files[0];


		if (file)
		{
			// read from file
			reader = new FileReader();

			let dropped_filename = 'dropped.p8.png';
			try {
				if (typeof file.fileName !== 'undefined') dropped_filename = file.fileName;
				if (typeof file.name !== 'undefined') dropped_filename = file.name;
			}
			catch(err) {
				// was happening when inside reader.onload -- files[] becomes an empty set by that stage under Chrome on Chromebook (eh?)
			  console.log("@@ failed to set dropped file name: "+err.message+" files:"+JSON.stringify(e.dataTransfer.files));
			}

			console.log("@@ fetching dropped file: "+dropped_filename);
			reader.onload = function (event)
			{
				p8_dropped_cart = reader.result;
				p8_dropped_cart_name = dropped_filename;
				console.log("@@ finished reading dropped file: "+dropped_filename);

				// data:image/png;base64
				e.stopPropagation();
				e.preventDefault();
				codo_command = 9; // read directly from p8_dropped_cart with libb64 decoder
			};
			
			reader.readAsDataURL(file);
			
		}
		else if (e.dataTransfer)
		{
			// read from url (or data url)
			txt = e.dataTransfer.getData('Text');
			if (txt){
				p8_dropped_cart_name = "untitled.p8.png";
				p8_dropped_cart = txt;
				codo_command = 9;
			}
		}
	}


	function nop(evt) {
		evt.stopPropagation();
		evt.preventDefault();
	}
	function dragover(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		Module.pico8DragOver();
	}
	function dragstop(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		Module.pico8DragStop();
	}

	// --------------------------------------------------------------------------------------------------------------------------------



	var p8_buttons_hash = -1;
	function p8_update_button_icons()
	{
		var w = 24;
		var bottom_margin = 12;
		var padding = 4;
		var left = 44;
		var p8tv_mode = false;

		// buttons only appear when running
		if (!p8_is_running)
		{
			requestAnimationFrame(p8_update_button_icons);
			return;
		}

		// p8tv font page player
		if (typeof(pico8_player_button_w) !== 'undefined') 
		{
			p8tv_mode = true;
			w = Math.floor(pico8_player_button_w);
			// console.log("@@ player_button_w: "+w);
			bottom_margin = Math.floor(w*3/4) - 4;
			padding = Math.floor(w / 4);
			left = Math.floor(w * 2 / 3);
		}

		var is_fullscreen=(document.fullscreenElement || document.mozFullScreenElement || document.webkitIsFullScreen || document.msFullscreenElement);
			

		// hash based on: pico8_state.sound_volume  pico8_state.is_paused bottom_margin left is_fullscreen p8_touch_detected
		var hash = 0;
		hash = pico8_state.sound_volume;
		if (pico8_state.is_paused) hash += 0x100;
		if (p8_touch_detected)     hash += 0x200;
		if (is_fullscreen)         hash += 0x400;
		hash += bottom_margin * 0.001;
		hash += left * 1001.3;

		if (p8_buttons_hash == hash)
		{
			requestAnimationFrame(p8_update_button_icons);
			return;
		}
		
		p8_buttons_hash = hash;
		// console.log("@@ updating button icons");

		// regenerate every frame (shouldn't be expensive?)
		els = p8_document().getElementsByClassName('p8_menu_button');
		for (i = 0; i < els.length; i++)
		{
			el = els[i];
			index = el.id;
			
			if (p8tv_mode) // cludge button positions
			{
				el.style.marginBottom = bottom_margin;
				el.style.paddingBottom = bottom_margin;
				el.style.padding = 0;
				el.style.left = left; 
			}
			else
			{
				// arrrrgh
				//el.style.marginLeft = menu_buttons_extra_hack;
			}

			if (index == 'p8b_sound') index += (pico8_state.sound_volume == 0 ? "0" : "1"); // 1 if undefined
			if (index == 'p8b_pause') index += (pico8_state.is_paused > 0 ? "1" : "0");     // 0 if undefined

			new_str = '<img width='+w+' height='+w+' style="display:table; pointer-events:none;" src="'+p8_gfx_dat[index]+'">';
			if (el.innerHTML != new_str) // :/
				el.innerHTML = new_str;

			// hide all buttons for touch mode (can pause with menu buttons)
			
			var is_visible = p8_is_running;

			if (!p8_touch_detected && el.parentElement.id == "p8_menu_buttons_touch") 
//			if (el.parentElement.id == "p8_menu_buttons_touch") 
				is_visible = false;

			if (p8_touch_detected && el.parentElement.id == "p8_menu_buttons")
				is_visible = false;

			if (is_fullscreen) 
				is_visible = false;

			if (is_visible)
				el.style.display="";
			else
				el.style.display="none";
		}
		requestAnimationFrame(p8_update_button_icons);
	}

	function abs(x)
	{
		return x < 0 ? -x : x;
	}

	function pico8_buttons_event(e, step)
	{
		if (!p8_is_running) return;

		if (!document.getElementById("touch_controls_gfx")) return;

		// console.log("button event step ",step);

		if (step == 2 && typeof(pico8_mouse) !== 'undefined')
		{
			pico8_mouse[2] = 0;
		}

		// on canvas
		
		var num = 0;
		if (e.touches) num = e.touches.length;

		if (num == 0)
		{
			// no active touches: release mouse button from anywhere on page
			if (typeof(pico8_mouse) !== 'undefined')
				pico8_mouse[2] = 0;
		}
		else
		{		
			let touch = e.touches[0];

			var x = touch.clientX;
			var y = touch.clientY;
			var w = window.innerWidth;
			var h = window.innerHeight;

			let canvas = p8_document().getElementById("canvas");

			if (p8_touch_detected)
			if (typeof(pico8_mouse) !== 'undefined')
			if (canvas)
			{
				var rect = canvas.getBoundingClientRect();
				//console.log(rect.top, rect.right, rect.bottom, rect.left, x, y);

				if (x >= rect.left && x < rect.right && y >= rect.top && y < rect.bottom)
				{
					// only define pico8_mouse once it is needed (otherwise codo mouse is clobbered on desktop)
					pico8_mouse = [
						Math.floor((x - rect.left) * 128 / (rect.right - rect.left)),
						Math.floor((y - rect.top) * 128 / (rect.bottom - rect.top)),
						step < 2 ? 1 : 0
					];
					//console.log("-> x y b ", pico8_mouse[0], pico8_mouse[1], pico8_mouse[2]);
					// return; // commented -- blocks overlapping buttons
				}else
				{
					pico8_mouse[2] = 0;
				}
			}
		}

		if (document.getElementById("touch_controls_gfx").style.display != "none")
			pico8_buttons_event_virtual_dpad(e, step);
		else
			pico8_buttons_event_virtual_keyboard(e, step);
	}

	// ** dupe ** (virtual_dpad)
	function pico8_buttons_event_virtual_keyboard(e, step)
	{
		if (!p8_is_running) return;	
		if (step != 0) return;
		
		var num = 0;
		if (e.touches) num = e.touches.length;
		
		for (var i = 0; i < num; i++)
		if (e.touches[i])
		{
			var touch = e.touches[i];
			var x = touch.clientX;
			var y = touch.clientY;
			var w = window.innerWidth;
			var h = window.innerHeight;

			var r = Math.min(w,h) / 12;
			if (r > 40) r = 40;
			var keybd_h = (r*12)*132.0/200.0

			// console.log("x:",x," y:",y," keybd_h:",keybd_h," r:",r);

			if (y < h - r*9)
			{
				// no controller buttons up here; includes canvas and menu buttons at top in touch mode
			}
			else
			{
				e.preventDefault();
				
				var y1 = Math.floor((y - (h - keybd_h)) * 6 / keybd_h);
				if (y1 == 3) x -= (r*12.0/10.0)*3.0/20.0;
				if (y1 == 4) x -= (r*12.0/10.0)*6.0/20.0;
				var x1 = Math.floor(x * 10 / (r*12));

				
				if (x1 >= 0 && x1 < 10 && y1 >= 0 && y1 < 6)
				{
					// send keypress signal to pico-8

					let key_chars=[
						[
							"X{[(*-=_+X",
							"1234567890",
							"qwertyuiop",
							"asdfghjklX",
							"zxcvbnm,.X",
							"XXXX   <>/"
						],
						[
							"XXXXX[]`~X",
							`!"#$%^&@()`,
							"QWERTYUIOP",
							"ASDFGHJKLX",
							"ZXCVBNM;:X",
							`XXXX   ?'\\\\`
						]
					];

					let val = key_chars[p8_keyboard_state][y1].charCodeAt(x1);
					if ((y1==3 || y1==4) && x1==9) val = 13; // enter

					//if (y1==0 && x1==9) val = 9; // del
					
					if (y1==0 && x1==9) val = 8; // backspace
					if (y1==0 && x1==0) val = 27;
					if (y1==5 && x1>=0 && x1 < 4) val = -1; // shift, alt, left, right
					
					codo_key_buffer.push(val);

					// macros 
					if (p8_keyboard_state == 0)
					if (y1 == 0 && x1 >= 1 && x1 <= 3)
					{
						if (x1 == 1) codo_key_buffer.push("}".charCodeAt(0));
						if (x1 == 2) codo_key_buffer.push("]".charCodeAt(0));
						if (x1 == 3) codo_key_buffer.push(")".charCodeAt(0));

						// to do: push left-cursor here
					}

					// special: shift key (show alt keys set)
					if (y1 == 5 && x1 == 0){
						// toggle

						p8_keyboard_state = p8_keyboard_state ? 0 : 1;

						el = document.getElementById("controls_keyboard_panel");
						if (el)
							el.setAttribute("src", p8_keyboard_state ? "/gfx/controls_keyboard2.png" : "/gfx/controls_keyboard.png");
					}

					p8_give_focus(); // ** hrm.
				}
			}
		}
	}
	
	// step 0 down 1 drag 2 up (not used)
	function pico8_buttons_event_virtual_dpad(e, step)
	{
		if (!p8_is_running) return;

		pico8_buttons[0] = 0;
		
		var num = 0;
		if (e.touches) num = e.touches.length;
		
		for (var i = 0; i < num; i++)
		if (e.touches[i])
		{
			var touch = e.touches[i];
			var x = touch.clientX;
			var y = touch.clientY;
			var w = window.innerWidth;
			var h = window.innerHeight;
			
			//console.log("dpad touch ",x,y);

			var r = Math.min(w,h) / 12;
			if (r > 40) r = 40;
			
			b = 0;

			if (y < h - r*8)
			{
				// no controller buttons up here; includes canvas and menu buttons at top in touch mode
			}
			else
			{
				e.preventDefault();

				if ((y < h - r*6) && y > (h - r*8))
				{
					// menu button: half as high as X O button
					// stretch across right-hand half above X O buttons
					if (x > w - r*3) 
						b |= 0x40;

					// escape button for pwa (doesn't do anything otherwise)
					if (x < r*3){
						codo_key_buffer.push(27);
						p8_give_focus();
					}

				}
				else if (x < w/2 && x < r*6)
				{
					// stick

					mask = 0xf; // dpad
					var cx = 0 + r*3;
					var cy = h - r*3;

					deadzone = r/3;
					var dx = x - cx;
					var dy = y - cy;

					if (abs(dx) > abs(dy) * 0.6) // horizontal 
					{
						if (dx < -deadzone) b |= 0x1;
						if (dx > deadzone) b |= 0x2;
					}
					if (abs(dy) > abs(dx) * 0.6) // vertical
					{
						if (dy < -deadzone) b |= 0x4;
						if (dy > deadzone) b |= 0x8;
					}
				}
				else if (x > w - r*6)
				{
					// button; diagonal split from bottom right corner
				
					mask = 0x30;
					
					// one or both of [X], [O]
					if ( (h-y) > (w-x) * 0.8) b |= 0x10;
					if ( (w-x) > (h-y) * 0.8) b |= 0x20;
				}
			}

			pico8_buttons[0] |= b;
		
		}

	}


	var p8_update_layout_hash = -1;	
	var last_windowed_container_height = 512;
	function p8_update_layout()
	{
		var canvas = p8_document().getElementById("canvas");
		var p8_playarea = p8_document().getElementById("p8_playarea");
		var p8_container = p8_document().getElementById("p8_container");
		var p8_frame = p8_document().getElementById("p8_frame");

		var csize = 512;

		var margin_top = 0;
		var margin_left = 0;
		var aspect = p8_aspect;

		// page didn't load yet? first call should be after p8_frame is created
		if (!canvas || !p8_playarea || !p8_container || !p8_frame)
		{
			p8_update_layout_hash = -1;
			requestAnimationFrame(p8_update_layout);
			return;
		}



		// assumes frame doesn't have padding
		
		var is_fullscreen=(document.fullscreenElement || document.mozFullScreenElement || document.webkitIsFullScreen || document.msFullscreenElement);
		var frame_width = p8_frame.offsetWidth;
		var frame_height = p8_frame.offsetHeight;

		if (is_fullscreen)
		{
			// same as window
			frame_width = window.innerWidth;
			frame_height = window.innerHeight;
		}
		else{
			// never larger than window  // (happens when address bar is down in portraight mode on phone)
			frame_width  = Math.min(frame_width, window.innerWidth);
			frame_height = Math.min(frame_height, window.innerHeight);
		}

		// as big as will fit in a frame..
		csize =  Math.min(frame_width,frame_height);

		// .. but never more than 2/3 of longest side for touch (e.g. leave space for controls on iPad)
		if (p8_touch_detected && p8_is_running)
		{
			var longest_side = Math.max(window.innerWidth,window.innerHeight);
			csize = Math.min(csize, longest_side * 2/3);
		}

		// pixel perfect: quantize to closest multiple of 128
		// only when large display (desktop)
		if (aspect == 1.0) // pico-8
		if (frame_width >= 512 && frame_height >= 512)
		{
			csize = (csize+1) & ~0x7f;
		}

		// csize should never be higher than parent frame
		// (otherwise stretched large when fullscreen and then return)
		if (!is_fullscreen && p8_frame) 
			csize = Math.min(csize, last_windowed_container_height); // p8_frame_0 parent


		if (is_fullscreen)
		{
			// always center horizontally
			margin_left = (frame_width - (csize * aspect))/2;

			if (p8_touch_detected)
			{
				if (window.innerWidth < window.innerHeight)
				{
					// portrait: keep at y=40 (avoid rounded top corners / camer num thing etc.)
					margin_top = Math.min(40, frame_height - csize);
				}
				else
				{
					// landscape: put a little above vertical center
					margin_top = (frame_height - csize)/4;
				}
			}
			else{
				// non-touch: center vertically
				margin_top = (frame_height - csize)/2;
			}

			// turn off temp hack
/* deleteme
			canvas.style.position = "";
			canvas.style.left = 0.0;
*/
			
		}
/* deleteme
		else
		{

			// temp hack: had to remove margin:auto from p8_container tostop blurry scale under chrome
			p8_container.style.margin = 0; // WHHHHY
			let left = (frame_width - (csize * aspect))/2;
			canvas.style.position = "relative";
			canvas.style.left = left;
			menu_buttons_extra_hack = left;

//			p8_menu_buttons.style.marginLeft = 40;//10.0 + Math.floor(left);

		}
*/

		// temporary voxatron hacks
		if (p8_aspect > 1.0)
		 	margin_left -= 40;

		
		// skip if relevant state has not changed

		var update_hash = csize + margin_top * 1000.3 + margin_left * 0.001 + frame_width * 333.33 + frame_height * 772.15134;
		if (is_fullscreen) update_hash += 0.1237;

		if (!is_fullscreen) // fullscreen: update every frame for safety. should be cheap!
		if (!p8_touch_detected) // mobile: update every frame because nothing can be trusted
		if (p8_update_layout_hash == update_hash)
		{
			//console.log("p8_update_layout(): skipping");
			requestAnimationFrame(p8_update_layout);
			return;
		}
		p8_update_layout_hash = update_hash;

		// record this for returning to original size after fullscreen pushes out container height (argh)
		if (!is_fullscreen && p8_frame)
			last_windowed_container_height = p8_frame.parentNode.parentNode.offsetHeight;


		//console.log("@@ p8_update_layout(): updating "+(is_fullscreen ? "fullscreen" : "windowed")+"  csize: " + csize);
		
		// mobile in portrait mode: put screen at top (w / a little space for fullscreen button)
		// (don't cart about buttons overlapping screen)
		if (p8_touch_detected && p8_is_running && document.body.clientWidth < document.body.clientHeight)
			p8_playarea.style.marginTop = 32;
		else if (p8_touch_detected && p8_is_running) // landscape: slightly above vertical center (only relevant for iPad / highres devices)
			p8_playarea.style.marginTop = (document.body.clientHeight - csize) / 4;
		else
			p8_playarea.style.marginTop = "";

		canvas.style.width = csize * aspect;
		canvas.style.height = csize;

		// to do: this should just happen from css layout
		canvas.style.marginLeft = margin_left;
		canvas.style.marginTop = margin_top;

		p8_container.style.width = csize * aspect;
		p8_container.style.height = csize;

		if (p8_touch_detected && p8_is_running)
		{
			// turn off pointer events to prevent double-tap zoom etc (works on Android)
			// don't want this for desktop because breaks mouse input & click-to-focus when using codo_textarea
			canvas.style.pointerEvents = "none";

			p8_container.style.marginTop = "0px";

			// buttons
			
			// same as touch event handling
			var w = window.innerWidth;
			var h = window.innerHeight;
			var r = Math.min(w,h) / 12;

			if (r > 40) r = 40;

			el = document.getElementById("controls_right_panel");
			el.style.left = w-r*6;
			el.style.top = h-r*7;
			el.style.width = r*6;
			el.style.height = r*7;
			if (el.getAttribute("src") != p8_gfx_dat["controls_right_panel"]) // optimisation: avoid reload? (browser should handle though)
				el.setAttribute("src", p8_gfx_dat["controls_right_panel"]);

			el = document.getElementById("controls_left_panel");
			el.style.left = 0;
			el.style.top = h-r*6;
			el.style.width = r*6;
			el.style.height = r*6;
			if (el.getAttribute("src") != p8_gfx_dat["controls_left_panel"]) // optimisation: avoid reload? (browser should handle though)
				el.setAttribute("src", p8_gfx_dat["controls_left_panel"]);

			el = document.getElementById("controls_keyboard_panel");
			el.style.left = 0;
			el.style.top = h-r*12*(132.0/200.0);
			el.style.width = r*12;
			el.style.height = r*12*(132.0/200.0);

			if (el.getAttribute("src") == "")
				el.setAttribute("src", "/gfx/controls_keyboard.png");
			
			// scroll to cart (need to stop running with X)
			p8_frame.scrollIntoView(true);

			if (pico8_state.show_dpad == 0 && w < h) // not true when undefined
			{
				// virtual keyboard
				document.getElementById("touch_controls_gfx").style.display="none";
				document.getElementById("touch_keyboard_gfx").style.display="table";

				// hide touch menu bottons
				//document.getElementById("p8_menu_buttons_touch").style.display="none";
				
			}
			else{
				// virtual dpad
				document.getElementById("touch_controls_gfx").style.display="table";
				document.getElementById("touch_keyboard_gfx").style.display="none";
			}
			

			// don't use background -- just hide body div
			//document.getElementById("touch_controls_background").style.display="table";

		}
		else{
			// no touch
			document.getElementById("touch_controls_gfx").style.display="none";
			document.getElementById("touch_keyboard_gfx").style.display="none";

			//document.getElementById("touch_controls_background").style.display="none";
		}

		if (!p8_is_running)
		{
			p8_playarea.style.display="none";
			p8_container.style.display="flex";
			p8_container.style.marginTop="auto";

			el = p8_document().getElementById("p8_start_button");
			if (el) el.style.display="flex";
		}

		requestAnimationFrame(p8_update_layout);	
	}


	var p8_touch_detected = false;

	//addEventListener("click", function(event){alert(pico8_state.show_dpad);});

	addEventListener("touchstart", function(event)
	{
		p8_touch_detected = true;

		// hide textarea, so that virtual mobile keyboard doesn't come up
		// (and fall back to internal copy/paste -- can't paste from other apps, but can ctrl-c,v within PICO-8)
		if (codo_textarea && codo_textarea.style.display != "none")
			codo_textarea.style.display="none";

/* // deleteme
		if (typeof(pico8_state.show_dpad) === 'undefined' || pico8_state.show_dpad)
		{
			if (codo_textarea && codo_textarea.style.display != "none")
				codo_textarea.style.display="none";
		}
		else
		{
			if (codo_textarea && codo_textarea.style.display != "")
				codo_textarea.style.display="";
		}
*/


	},  {passive: true});

	function p8_create_audio_context()
	{
		if (pico8_audio_context) 
		{
			try {
				pico8_audio_context.resume();
			}
			catch(err) {
				console.log("** pico8_audio_context.resume() failed");
			}
			return;
		}

		var webAudioAPI = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.oAudioContext || window.msAudioContext;			
		if (webAudioAPI)
		{
			pico8_audio_context = new webAudioAPI;

			// wake up iOS
			if (pico8_audio_context)
			{
				try {
					var dummy_source_sfx = pico8_audio_context.createBufferSource();
					dummy_source_sfx.buffer = pico8_audio_context.createBuffer(1, 1, 22050); // dummy
					dummy_source_sfx.connect(pico8_audio_context.destination);
					dummy_source_sfx.start(1, 0.25); // gives InvalidStateError -- why? hasn't been played before 
					//dummy_source_sfx.noteOn(0); // deleteme
				}
				catch(err) {
					console.log("** dummy_source_sfx.start(1, 0.25) failed");
				}
			}
		}
	}


	// just hides. can reopen in a paused state.
	// used only by mobile X button after touch_detected
	function p8_close_cart()
	{
		p8_is_running = false;
		p8_touch_detected = false;
		Module.pico8SetPaused(1);

		// hide stuff

		el = document.getElementById("p8_frame_0");
			if (el) el.style.display="none";

		// show page
		el = document.getElementById("body_0");
			if (el) el.style.display="";

		// (re-)show dormant players
		els = document.getElementsByClassName("dormant_player");
	  	for (i = 0; i < els.length; i++)
			els[i].style.display = ''; // show

	}


	function p8_run_cart(player_url, cart_lid, cart_url)
	{
		console.log("p8_run_cart: "+player_url+" "+cart_lid+" "+cart_url);
		p8_current_playing_lid = cart_lid;
		//codo_textarea = document.getElementById("codo_textarea_global");
		codo_textarea = document.getElementById("codo_textarea_"+cart_lid);
		
		// e.g. for "currently playing" update
		if (typeof(p8_run_cart_onrun) !== 'undefined')
		{
			p8_run_cart_onrun(cart_lid);			
		}

		if (p8_is_running)
		{
			if (cart_lid != 0){
				_cartname=[String(cart_lid)];
				codo_command = 6;
			}
			return;
		}

		p8_is_running = true;

		// create audio context and wake it up (for iOS -- needs happen inside touch event)		
		p8_create_audio_context();

		// show touch elements
		els = document.getElementsByClassName('p8_controller_area');
		for (i = 0; i < els.length; i++)
			els[i].style.display="";


		// install touch events. These also serve to block scrolling / pinching / zooming on phones when p8_is_running
			// moved event.preventDefault(); calls into pico8_buttons_event (want to let top buttons pass through)
		addEventListener("touchstart", function(event){ pico8_buttons_event(event, 0); }, {passive: false});
		addEventListener("touchmove",  function(event){ pico8_buttons_event(event, 1); }, {passive: false});
		addEventListener("touchend",   function(event){ pico8_buttons_event(event, 2); }, {passive: false});


		// load and run script
		e = document.createElement("script");
		p8_script = e;
		e.onload = function(){

			//window.alert("loaded "+p8_update_layout_hash);
			
			// show canvas / menu buttons only after loading
			el = document.getElementById("p8_playarea");
			if (el) el.style.display="table";

			if (typeof(last_pico8_player_layout_hash) !== 'undefined') // p8tv
				last_pico8_player_layout_hash = -1;
			if (typeof(p8_update_layout_hash) !== 'undefined')
				p8_update_layout_hash = -77;
			if (typeof(p8_buttons_hash) !== 'undefined')
				p8_buttons_hash = -1;
			
/*
			// happens outside; when generating player.
			Module = {};
			Module.canvas = document.getElementById("canvas");
			Module.arguments = [cart_url.toString()];
			p8_update_button_icons();
*/

			// Module.arguments = [cart_url.toString()]; // doesn't work
			// hack: use command 6 instead. will load as soon as codo_update is spinning
			// allows starting player AND choosing cart by clicking on p8tv cart
			// could just always do this anyway; is cleaner.

			if (cart_lid != 0){
				_cartname=[String(cart_lid)];
				codo_command = 6;
			}

			// install drag and drop thing

			function noopHandler(evt) {
				evt.stopPropagation();
				evt.preventDefault();
			}
			var canvas = p8_document().getElementById("canvas");

			canvas.addEventListener('dragenter', noopHandler, false);
			canvas.addEventListener('dragover', noopHandler, false);
			canvas.addEventListener('dragleave', noopHandler, false);
			canvas.addEventListener('drop', noopHandler, false);
			
			canvas.addEventListener('drop', p8_drop_file, false);

		}
		e.type = "application/javascript";
		e.src = player_url;
		e.id = "e_script";
		
		document.body.appendChild(e); // load and run

		// hide start button and show canvas / menu buttons. hide start button
		el = document.getElementById("p8_start_button");
		if (el) el.style.display="none";

		// add #playing for touchscreen devices (allows back button to close)
		if (p8_touch_detected)
		{
			window.location.hash = "#playing";
			window.onhashchange = function()
			{
				if (window.location.hash.search("playing") < 0)
					p8_close_cart();
			}
		}

		// install drag&drop listeners
		{
			let canvas = p8_document().getElementById("canvas");
			if (canvas)
			{
				canvas.addEventListener('dragenter', dragover, false);
				canvas.addEventListener('dragover', dragover, false);
				canvas.addEventListener('dragleave', dragstop, false);
				canvas.addEventListener('drop', nop, false);
				canvas.addEventListener('drop', p8_drop_file, false);
			}
		}

		// install "sure you'd like to navigate away?" thing
		window.onbeforeunload = function() {
			if (pico8_state.require_page_navigate_confirmation)
				return "Are you sure you want to navigate away?";
			else
				return null; // ok to close immediately
		}

	}

	// Gamepad code  // from @weeble's mod
	
	var P8_BUTTON_O = {action:'button', code: 0x10};
	var P8_BUTTON_X = {action:'button', code: 0x20};
	var P8_DPAD_LEFT = {action:'button', code: 0x1};
	var P8_DPAD_RIGHT = {action:'button', code: 0x2};
	var P8_DPAD_UP = {action:'button', code: 0x4};
	var P8_DPAD_DOWN = {action:'button', code: 0x8};
	var P8_MENU = {action:'menu'};
	var P8_NO_ACTION = {action:'none'};

	var P8_BUTTON_MAPPING = [
		// ref: https://w3c.github.io/gamepad/#remapping
		P8_BUTTON_O,          // Bottom face button
		P8_BUTTON_X,          // Right face button
		P8_BUTTON_X,          // Left face button
		P8_BUTTON_O,          // Top face button
		P8_NO_ACTION,         // Near left shoulder button (L1)
		P8_NO_ACTION,         // Near right shoulder button (R1)
		P8_NO_ACTION,         // Far left shoulder button (L2)
		P8_NO_ACTION,         // Far right shoulder button (R2)
		P8_MENU,              // Left auxiliary button (select)
		P8_MENU,              // Right auxiliary button (start)
		P8_NO_ACTION,         // Left stick button
		P8_NO_ACTION,         // Right stick button
		P8_DPAD_UP,           // Dpad up
		P8_DPAD_DOWN,         // Dpad down
		P8_DPAD_LEFT,         // Dpad left
		P8_DPAD_RIGHT,        // Dpad right
	];

	// Track which player is controller by each gamepad. Gamepad index i controls the
	// player with index pico8_gamepads_mapping[i]. Gamepads with null player are
	// currently unassigned - they get assigned to a player when a button is pressed.
	var pico8_gamepads_mapping = [];

	function p8_unassign_gamepad(gamepad_index) {
		if (pico8_gamepads_mapping[gamepad_index] == null) {
			return;
		}
		pico8_buttons[pico8_gamepads_mapping[gamepad_index]] = 0;
		pico8_gamepads_mapping[gamepad_index] = null;
	}


	function p8_first_player_without_gamepad(max_players) {
		var allocated_players = pico8_gamepads_mapping.filter(function(x) { return x != null; });
		var sorted_players = Array.from(allocated_players).sort();
		for (var desired = 0; desired < sorted_players.length && desired < max_players; ++desired) {
			if (desired != sorted_players[desired]) {
				return desired;
			}
		}
		if (sorted_players.length < max_players) {
			return sorted_players.length;
		}
		return null;
	}

	function p8_assign_gamepad_to_player(gamepad_index, player_index) {
		p8_unassign_gamepad(gamepad_index);
		pico8_gamepads_mapping[gamepad_index] = player_index;
	}

	function p8_convert_standard_gamepad_to_button_state(gamepad, axis_threshold, button_threshold) {
		// Given a gamepad object, return:
		// {
		//     button_state: the binary encoded Pico 8 button state
		//     menu_button: true if any menu-mapped button was pressed
		//     any_button: true if any button was pressed, including d-pad
		//         buttons and unmapped buttons
		// }
		if (!gamepad || !gamepad.axes || !gamepad.buttons) {
			return {
				button_state: 0,
				menu_button: false,
				any_button: false
			};
		}
		function button_state_from_axis(axis, low_state, high_state, default_state) {
			if (axis && axis < -axis_threshold) return low_state;
			if (axis && axis > axis_threshold) return high_state;
			return default_state;
		}
		var axes_actions = [
			button_state_from_axis(gamepad.axes[0], P8_DPAD_LEFT, P8_DPAD_RIGHT, P8_NO_ACTION),
			button_state_from_axis(gamepad.axes[1], P8_DPAD_UP, P8_DPAD_DOWN, P8_NO_ACTION),
		];

		var button_actions = gamepad.buttons.map(function (button, index) {
			var pressed = button.value > button_threshold || button.pressed;
			if (!pressed) return P8_NO_ACTION;
			return P8_BUTTON_MAPPING[index] || P8_NO_ACTION;
		});

		var all_actions = axes_actions.concat(button_actions);
		
		var menu_button = button_actions.some(function (action) { return action.action == 'menu'; });
		var button_state = (all_actions
			.filter(function (a) { return a.action == 'button'; })
			.map(function (a) { return a.code; })
			.reduce(function (result, code) { return result | code; }, 0)
		);
		var any_button = gamepad.buttons.some(function (button) {
			return button.value > button_threshold || button.pressed;
		});

		any_button |= button_state; //jww: include axes 0,1 as might be first intended action


		return {
			button_state,
			menu_button,
			any_button
		};
	}

	// jww: pico-8 0.2.1 version for unmapped gamepads, following p8_convert_standard_gamepad_to_button_state
	// axes 0,1 & buttons 0,1,2,3 are reasonably safe. don't try to read dpad.
	// menu buttons are unpredictable, but use 6..8 anyway (better to have a weird menu button than none)
	function p8_convert_unmapped_gamepad_to_button_state(gamepad, axis_threshold, button_threshold) {

		if (!gamepad || !gamepad.axes || !gamepad.buttons) {
			return {
				button_state: 0,
				menu_button: false,
				any_button: false
			};
		}

		var button_state = 0;

		if (gamepad.axes[0] && gamepad.axes[0] < -axis_threshold) button_state |= 0x1;
		if (gamepad.axes[0] && gamepad.axes[0] > axis_threshold)  button_state |= 0x2;
		if (gamepad.axes[1] && gamepad.axes[1] < -axis_threshold) button_state |= 0x4;
		if (gamepad.axes[1] && gamepad.axes[1] > axis_threshold)  button_state |= 0x8;

		// buttons: first 4 taken to be O/X, 6..8 taken to be menu button

		for (j = 0; j < gamepad.buttons.length; j++)
		if (gamepad.buttons[j].value > 0 || gamepad.buttons[j].pressed)
		{
			if (j < 4)
				button_state |= (0x10 << (((j+1)/2)&1)); // 0 1 1 0 -- A,X -> O,X on xbox360
			else if (j >= 6 && j <= 8)
				button_state |= 0x40;
		}

		var menu_button = button_state & 0x40;


		var any_button = gamepad.buttons.some(function (button) {
			return button.value > button_threshold || button.pressed;
		});

		any_button |= button_state; //jww: include axes 0,1 as might be first intended action
		
		return {
			button_state,
			menu_button,
			any_button
		};
	}
	
	// gamepad  https://developer.mozilla.org/en-US/docs/Web/API/Gamepad_API/Using_the_Gamepad_API
	// (sets bits in pico8_buttons[])
	function p8_update_gamepads() {
		var axis_threshold = 0.3;
		var button_threshold = 0.5; // Should be unnecessary, we should be able to trust .pressed
		var max_players = 8;
		var gps = navigator.getGamepads() || navigator.webkitGetGamepads();

		if (!gps) return;

		// In Chrome, gps is iterable but it's not an array.
		gps = Array.from(gps);

		pico8_gamepads.count = gps.length;
		while (gps.length > pico8_gamepads_mapping.length) {
		    pico8_gamepads_mapping.push(null);
		}

		var menu_button = false;
		var gamepad_states = gps.map(function (gp) {
			return (gp && gp.mapping == "standard") ?
				p8_convert_standard_gamepad_to_button_state(gp, axis_threshold, button_threshold) :
				p8_convert_unmapped_gamepad_to_button_state(gp, axis_threshold, button_threshold);
		});

		// Unassign disconnected gamepads.
		// gps.forEach(function (gp, i) { if (gp && !gp.connected) { p8_unassign_gamepad(i); }});
		gps.forEach(function (gp, i) { if (!gp || !gp.connected) { p8_unassign_gamepad(i); }}); // https://www.lexaloffle.com/bbs/?pid=87132#p

		// Assign unassigned gamepads when any button is pressed.
		gamepad_states.forEach(function (state, i) {
			if (state.any_button && pico8_gamepads_mapping[i] == null) {
				var first_free_player = p8_first_player_without_gamepad(max_players);
				p8_assign_gamepad_to_player(i, first_free_player);
			}
		});

		// Update pico8_buttons array.
		gamepad_states.forEach(function (gamepad_state, i) {
			if (pico8_gamepads_mapping[i] != null) {
				pico8_buttons[pico8_gamepads_mapping[i]] = gamepad_state.button_state;
			}
		});

		// Update menu button.
		// Pico 8 only recognises the menu button on the first player, so we
		// press it when any gamepad has pressed a button mapped to menu.
		if (gamepad_states.some(function (state) { return state.menu_button; })) {
			pico8_buttons[0] |= 0x40;
		}

		requestAnimationFrame(p8_update_gamepads);
	}
	requestAnimationFrame(p8_update_gamepads);

	// End of gamepad code


	// key blocker. prevent cursor keys from scrolling page while playing cart.
	// also don't act on M, R so that can mute / reset cart
	document.addEventListener('keydown',
	function (event) {
		event = event || window.event;
		if (!p8_is_running) return;

		//console.log(event.keyCode+":"+([17,88,67,86].indexOf(event.keyCode)));

		if (pico8_state.has_focus == 1)
			// commented -- catch /all/ keypresses to support editor, and because using codo_textfield focus method
			// if ([32, 37, 38, 39, 40, 77, 82, 80, 9].indexOf(event.keyCode) > -1)   // allow: cursors, M R P, tab
			if ([17,88,67,86].indexOf(event.keyCode) < 0) // block all keypresses except ctrl,x,c,v (need for codo_textfield clipboard)
				if (event.preventDefault) event.preventDefault();
	},{passive: false});

	// same as in codo_update_js_textfield()
	function p8_give_focus()
	{
		el = (typeof codo_textarea === 'undefined') ? document.getElementById("codo_textarea") : codo_textarea;
		if (el)
		{
			el.focus();
			el.select();
		}
	}

	function p8_request_fullscreen() {

		var is_fullscreen=(document.fullscreenElement || document.mozFullScreenElement || document.webkitIsFullScreen || document.msFullscreenElement);

		if (is_fullscreen)
		{
			 if (document.exitFullscreen) {
		        document.exitFullscreen();
		    } else if (document.webkitExitFullscreen) {
		        document.webkitExitFullscreen();
		    } else if (document.mozCancelFullScreen) {
		        document.mozCancelFullScreen();
		    } else if (document.msExitFullscreen) {
		        document.msExitFullscreen();
		    }
			return;
		}
		
		var el = document.getElementById("p8_playarea");

		if ( el.requestFullscreen ) {
			el.requestFullscreen();
		} else if ( el.mozRequestFullScreen ) {
			el.mozRequestFullScreen();
		} else if ( el.webkitRequestFullScreen ) {
			el.webkitRequestFullScreen( Element.ALLOW_KEYBOARD_INPUT );
		}
	}


var p8_aspect = 1.0;

function activate_p8_player(player_url, cart_lid, cart_url, new_parent_id, dormant_player_id)
{
	var p8_frame_0 = document.getElementById("p8_frame_0");
	var new_parent = document.getElementById(new_parent_id);
	var dormant_player = document.getElementById(dormant_player_id);

	p8_aspect = 1.0;
	if (player_url.indexOf("vox") >= 0) p8_aspect = 820.0/512.0;

	if (!p8_frame_0)
	{
		console.log("@@ could not find p8_frame_0");
		return;
	}

	p8_frame_0.parentNode.removeChild(p8_frame_0);
	new_parent.appendChild(p8_frame_0);

	//p8_frame_0.style.display="table";
	p8_frame_0.style="display:table; width:100%;height:100%; max-width:100vw;max-height:100vh;  min-width:256px;min-height:256px;margin:0px;background-color:#111"
	
	dormant_player.style.display = 'none';

	// bbs player: can remove entire page and move player div to front
	// (differs from exported player approach

	if (p8_touch_detected)
	{
		el = document.getElementById("body_0");
			if (el) el.style.display="none";

		el.parentNode.appendChild(document.getElementById("p8_frame_0"));
	}

	// run!
	p8_run_cart(player_url, cart_lid, cart_url);

	// load cart menu
	embedded = (window.parent && window.parent != window) ? 1 : 0;

	// to do: decide cab (and make cab system clearer. count as bbs play -- need for voxatron embeds)

	//var el = document.getElementById("more_carts_global");
	//if (!el) console.log("@@ could not find "+"more_carts_"+cart_lid);
	//if (el) // only load if can find element for it
	{
		microAjax("/bbs/on_play.php?id="+cart_lid+"&embedded="+embedded+"&cab=0",
			function (retdata){
				var el = document.getElementById("more_carts_"+cart_lid);
				//var el = document.getElementById("more_carts_global");
				if (el) el.innerHTML = retdata;
			}
		);
	}

	// show dormant frames on other carts // was set_active_widget()
	els = document.getElementsByClassName("dormant_player");
  	for (i = 0; i < els.length; i++)
	if (els[i] != dormant_player)
		els[i].style.display = ''; // show


	// safety. should be unnecessary :|
	// when running wasm version, canvas seems right size, but then shrinks. sdl? to do: investigate
	setTimeout(function(){
		p8_update_layout_hash = -55;
	},1000);

}

function toggle_cart_menu(div_id)
{
	var el=$(div_id);
	if (el)
	{
		el.style.display = (el.style.display=='none') ? 'table' : 'none';
		var slider_el = el.childNodes[1];
		if (true)
		{
			left_target = 0;
			slider_el.style.left = (left_target + 540)+'px';

			poll_function(200, 10,
			function(q){
				q= 1 - (1-q)*(1-q);
				slider_el.style.left = (left_target + (1-q)*540)+'px';
			});
		}
		codo_running = (el.style.display == 'none'); // running if hidden
		codo_command = 5; codo_command_p = !codo_running;
	}
}

// for downloading saved carts
function download_browser_file(filename, contents)
{
  var element = document.createElement('a');
  if (filename.substr(filename.length - 7) == ".p8.png")
  	element.setAttribute('href', 'data:image/png;base64,' + encodeURIComponent(contents));
  else if (filename.substr(filename.length - 4) == ".wav")
	  	element.setAttribute('href', 'data:audio/x-wav;base64,' + encodeURIComponent(contents));
  else
  	element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(contents));
  element.setAttribute('download', filename);
  element.style.display = 'none';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

</script>
<div> <!-- optional div to limit max size -->
	<div id="p8_frame" style="display: flex; position: absolute; width: 144px; height: 136px; left: 692px; top: 47px;">
	<textarea id="codo_textarea_rp8-22" class="emscripten" style="display:none; position:absolute; left:-9999px; height:0px; overflow:hidden"></textarea><input id="p8_file_chooser" type="file" name="name" style="display: none;" onchange="p8_drop_file(event)"><div style="position:absolute">

		<div id="cart_menu_rp8-22" style="
			display:none;
			position:absolute;
			width:568px; height:512px; 
			max-width:568px; max-height:512px; 
			z-index:200; 
			overflow:hidden;
			padding:0px;
		">

		<div style="
				background: rgba(24.0,24.0,42.0,0.95);
				position:relative;
				top:0px;
				left:0px;
				margin:0px;
				display:block;
				width:560px;
				height:504px;
				padding-left:8px;
				padding-top:8px;
				overflow:hidden;
			">
	<div style="margin:8px; margin-top:12px; margin-bottom:20px; width:100%; height:128px; float:left"><div style="margin-top:8px; margin-left:px; width:128px; height:128px; float:left;
				background:url('https://www.lexaloffle.com/bbs/thumbs/pico8_rp8-22.png') no-repeat center;
				-webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover;
			">
			</div><div style="padding:8px; padding-left:32px; display:table"><a target="_parent" href="https://www.lexaloffle.com/bbs/?pid=rp8#p">
					<div style="font-size:16pt; color:#fff; margin-bottom:8px">RP-8 1.1</div>
				</a><div style="padding-bottom:12px"><a target="_parent" style="color:#fab" href="https://www.lexaloffle.com/bbs/cposts/rp/rp8-22.p8.png">Cart File</a> | <a target="_parent" style="color:#fab" href="https://www.lexaloffle.com/bbs/?pid=rp8-22#p">Forum Post</a> | </div>
					<table cellpadding="0" cellspacing="8"><tbody><tr><td rowspan="2">
						<a target="_parent" href="https://www.lexaloffle.com/bbs/?uid=24137"><img src="/media/24137/5_cloud.png" width="48"></a>
					</td><td>
						<a target="_parent" style="color:#fab" href="https://www.lexaloffle.com/bbs/?uid=24137&amp;mode=carts">More cartridges</a> by 
							<a target="_parent" href="https://www.lexaloffle.com/bbs/?uid=24137"><b>luchak</b></a>
					</td></tr><tr><td>
						<a target="_rss" href="/bbs/feed.php?uid=24137" class="social_button">
	<img src="/gfx/so_rss.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a><a target="_home" href="https://luchak.net" class="social_button">
	<img src="/gfx/so_home.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a><a target="_mastodon" href="https://6t.vc/@luchak" class="social_button">
	<img src="/gfx/so_mastodon.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a><a target="_twitter" href="https://twitter.com/its_luchak" class="social_button">
	<img src="/gfx/so_twitter.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a><a target="_youtube" href="https://youtube.com/luchak" class="social_button">
	<img src="/gfx/so_youtube.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a><a target="_itch" href="https://luchak.itch.io/" class="social_button">
	<img src="/gfx/so_itch.png" width="24" height="24" style="float:left; margin-left:4px; margin-top:0px; margin-bottom:4px">
	</a>
					</td></tr></tbody></table>
				</div></div><div style="display:table; font-size:14pt; color:#fff; width:100%; padding:4px; padding-top:24px; ">More Cartridges  
				<a target="_parent" style="font-size:10pt; color:#aaa" href="https://www.lexaloffle.com/bbs/?cat=7#sub=2&amp;mode=carts">[View All]</a>
			</div><div id="more_carts_rp8-22"></div></div></div></div>

	<div id="p8_menu_buttons_touch" style="position:absolute; width:100%; z-index:10; left:0px; top:0px;">
		<div class="p8_menu_button" id="p8b_full" style="position: absolute; margin-left: 144px; top: 75px;" onclick="p8_give_focus(); p8_request_fullscreen();"></div>
		<div class="p8_menu_button" id="p8b_sound" style="position: absolute; margin-left: 144px; top: 85px;" onclick="p8_give_focus(); p8_create_audio_context(); Module.pico8ToggleSound();"></div>
		<div class="p8_menu_button" id="p8b_close" style="position: absolute; margin-left: 144px; top: 95px;" onclick="p8_close_cart();"></div>
	</div>

	<div id="p8_container" style="margin:auto; display:table;" onclick="if (!p8_is_running) {p8_create_audio_context(); p8_run_cart('https://www.lexaloffle.com/play/pico8_0205g.js', 'rp8-22', 'https://www.lexaloffle.com/bbs/cposts/rp/rp8-22.p8.png');}">


	<div id="p8_start_button" class="p8_start_button" style="width:100%; height:100%; display:flex; cursor:pointer; background:url('');
					-repeat center;
						-webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover;
					">
				<img width="80" height="80" style="margin:auto;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAABpklEQVR42u3au23DQBCEYUXOXIGKcujQXUgFuA0XIKgW90Q9oEAg+Ljd27vd2RsCf058gEDqhofPj+OB6SMCAQlIQAIyAhKQgARkBAQDnM6XSRsB7/2e/tSA0//12fCAKsQX3ntDA4oRFwBRIc0AixE38BAhTQGLEAsBUSDNAXcRhYDRIZsAPlp99VECRoXsDpgN0g0wC6Q7IDpkGEBUyG6A0+vKBtkdMBukG2AWSHdAdMgwgKiQ4QDRIMMCokCGB4wOCQPYFVKw2cABNocUjl6wgE0gFashPKAZpHJ2TQNYBVmxW6cDFENWDv9pAUshCVgJScBKSAISkD9hPkT4GkNAMdzepyj8Kye852EBLe51CZHHWQK4JcThD1SlcHPEYY/0a+A0n6SkGZV6w6WZNb3g4Id1b7hwgGhwYQBR4dwB0eHcALPAdQfMBhcOEA0uDCAqnDsgOpwbYBa4poA/31+rZYFrBriFpwGMCtcEcA9PAhgdzhywBK8EEQXOFFCCtwaIBmcGKMWbI6LCmQBq8R6hw5kAMgISkIAEJCAjIAEJSEBGQI9ukV7lRn9nD+gAAAAASUVORK5CYII=">

			</div>
	


		<div id="p8_playarea" style="display:none; margin:auto;
			-webkit-user-select:none; -moz-user-select: none; user-select: none; -webkit-touch-callout:none;
		">

			<div id="touch_controls_background" style=" pointer-events:none; display:none; background-color:#000; opacity:0.5;
						 position:fixed; top:0px; left:0px; border:0; width:100vw; height:200vh; overflow:hidden">
				&nbsp;
			</div>

			
			<div id="p8_playarea_flex" style="display:flex; position:">

				<canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault();" style="width: 144px; height: 136px; left: 692px; top: 47px;">
				</canvas>

				<div class="p8_menu_buttons" id="p8_menu_buttons" style="z-index: 50000;">

					<div class="p8_menu_button" style="position: absolute; margin-left: 144px; top: 105px;" id="p8b_controls" onclick="p8_give_focus(); Module.pico8ToggleControlMenu();"></div>					
					<div class="p8_menu_button" style="position: absolute; margin-left: 144px; top: 115px;" id="p8b_pause" onclick="p8_give_focus(); Module.pico8TogglePaused(); p8_update_layout_hash = -22;"></div>
					<div class="p8_menu_button" style="position: absolute; margin-left: 144px; top: 125px;" id="p8b_sound" onclick="p8_give_focus(); p8_create_audio_context(); Module.pico8ToggleSound();"></div>

				</div>


			</div>

			<!-- display after first layout update -->

			<div id="touch_controls_gfx" style=" pointer-events:none; display:table; 
						 position:fixed; top:0px; left:0px; border:0; width:100vw; height:100vh">

					<img src="" id="controls_right_panel" style="position:absolute; opacity:0.5;">
					<img src="" id="controls_left_panel" style="position:absolute;  opacity:0.5;">
					
			</div> <!-- touch_controls_gfx -->

			<div id="touch_keyboard_gfx" style=" pointer-events:none; display:table; 
						 position:fixed; top:0px; left:0px; border:0; width:100vw; height:100vh">

					<img src="" id="controls_keyboard_panel" style="position:absolute; opacity:0.5;">
					
			</div> <!-- touch_keyboard_gfx -->

		</div> <!--p8_playarea -->
	</div> <!-- p8_container -->

</div> <!-- p8_frame -->
</div>

	<script type="application/javascript" src="https://www.lexaloffle.com/play/pico8_0205g.js" id="e_script"></script>



</body>
</body>
</html>
