<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script> 
   <!-- Second, add the Timer and Easing plugins --> 
   <script src="js/jquery.timers-1.2.js" type="text/javascript"></script> 
   <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script> 
   <!-- Third, add the GalleryView Javascript and CSS files --> 
   <script src="/js/jquery.galleryview-3.0-dev.js" type="text/javascript"></script>
   <link href="css/jquery.galleryview-3.0-dev.css" rel="stylesheet" type="text/css">
   <!-- Lastly, call the galleryView() function on your unordered list(s) --> 
	<script type="text/javascript">
     $(function(){
         $('#myGallery').galleryView();
     });
   </script>
                           <ul id="myGallery">
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
                              <li><a href="<?=$db->f(id_product)?>"><img src="<?=($db->f(banner_img)!="")?'/upimg/banner/'.$db->f(banner_img):"images/clear.gif"?>" border="0" /></a> 
                              </li>
                              <?php } ?>
                           </ul>
                           <br />
