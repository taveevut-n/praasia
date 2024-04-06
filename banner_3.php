<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/nivoslide/default/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/nivoslide/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/nivoslide/style.css" type="text/css" media="screen" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/nivoslide/jquery.nivo.slider.js"></script>
	<script type="text/javascript" src="js/nivoslide/nav.js"></script>

<script type="text/javascript">
	$(window).load(function() {
	$('#slider').nivoSlider();
	});
</script>
<table  width="740" height="300" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						
							<div class="slider-wrapper theme-default" align="center">
								<div id="slider" class="nivoSlider">
									<?php
										$q="SELECT * FROM `banner_slide` WHERE 1 ";
										$db->query($q);
										while($db->next_record()){
									?>
									<?
                                      if($db->f(banner_url)==''){
                                          $url="detail_bannerslide.php?banner_id=".$db->f(banner_id);
                                          $tar=$db->f(banner_target);
                                            if($tar=='1'){
                                                $target="_Blank";
                                        }else{
                                            $target="_parent";
                                        }
                                      }else{
                                          $url=$db->f(banner_url);
                                      }
                                    ?> 
                                    <a href="<?=$db->f(id_product)?>"><img src="<?=($db->f(banner_img)!="")?'/upimg/banner/'.$db->f(banner_img):"images/clear.gif"?>" width="740" height="300" border="0" /></a>         
									
										
									
									<?php } ?>
								</div>
								<div class="bar_navi" align="center"></div>
							</div>
						
					</td>
				</tr>
				
</table>
