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
