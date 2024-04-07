<?php

if (!function_exists("thumbnail")) {

    class ImageManipulator
    {

        protected $width;
        protected $height;
        protected $image;

        public function __construct($file = null)
        {
            if (null !== $file) {
                if (is_file($file)) {
                    $this->setImageFile($file);
                } else {
                    $this->setImageString($file);
                }
            }
        }

        public function setImageFile($file)
        {
            if (!(is_readable($file) && is_file($file))) {
                throw new InvalidArgumentException("Image file $file is not readable");
            }
            if (is_resource($this->image)) {
                imagedestroy($this->image);
            }
            list($this->width, $this->height, $type) = getimagesize($file);
            switch ($type) {
                case IMAGETYPE_GIF:
                    $this->image = imagecreatefromgif($file);
                    break;
                case IMAGETYPE_JPEG:
                    $this->image = imagecreatefromjpeg($file);
                    break;
                case IMAGETYPE_PNG:
                    $this->image = imagecreatefrompng($file);
                    break;
                default:
                    throw new InvalidArgumentException("Image type $type not supported");
            }
            return $this;
        }
        public function setImageString($data)
        {
            if (is_resource($this->image)) {
                imagedestroy($this->image);
            }
            if (!$this->image = imagecreatefromstring($data)) {
                throw new RuntimeException('Cannot create image from data string');
            }
            $this->width = imagesx($this->image);
            $this->height = imagesy($this->image);
            return $this;
        }

        public function resample($width, $height, $constrainProportions = true)
        {
            if (!is_resource($this->image)) {
                throw new RuntimeException('No image set');
            }
            if ($constrainProportions) {
                if ($this->height >= $this->width) {
                    $width = round($height / $this->height * $this->width);
                } else {
                    $height = round($width / $this->width * $this->height);
                }
            }
            $temp = imagecreatetruecolor($width, $height);
            imagecopyresampled($temp, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
            return $this->_replace($temp);
        }

        public function enlargeCanvas($width, $height, array $rgb = array(), $xpos = null, $ypos = null)
        {
            if (!is_resource($this->image)) {
                throw new RuntimeException('No image set');
            }
            $width = max($width, $this->width);
            $height = max($height, $this->height);
            $temp = imagecreatetruecolor($width, $height);
            if (count($rgb) == 3) {
                $bg = imagecolorallocate($temp, $rgb[0], $rgb[1], $rgb[2]);
                imagefill($temp, 0, 0, $bg);
            }
            if (null === $xpos) {
                $xpos = round(($width - $this->width) / 2);
            }
            if (null === $ypos) {
                $ypos = round(($height - $this->height) / 2);
            }
            imagecopy($temp, $this->image, (int) $xpos, (int) $ypos, 0, 0, $this->width, $this->height);
            return $this->_replace($temp);
        }

        public function crop($x1, $y1 = 0, $x2 = 0, $y2 = 0)
        {
            if (!is_resource($this->image)) {
                throw new RuntimeException('No image set');
            }
            if (is_array($x1) && 4 == count($x1)) {
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

        protected function _replace($res)
        {
            if (!is_resource($res)) {
                throw new UnexpectedValueException('Invalid resource');
            }
            if (is_resource($this->image)) {
                imagedestroy($this->image);
            }
            $this->image = $res;
            $this->width = imagesx($res);
            $this->height = imagesy($res);
            return $this;
        }

        public function save($fileName, $type = IMAGETYPE_JPEG)
        {
            $dir = dirname($fileName);
            if (!is_dir($dir)) {
                if (!mkdir($dir, 0755, true)) {
                    throw new RuntimeException('Error creating directory ' . $dir);
                }
            }
            try {
                switch ($type) {
                    case IMAGETYPE_GIF:
                        if (!imagegif($this->image, $fileName)) {
                            throw new RuntimeException;
                        }
                        break;
                    case IMAGETYPE_PNG:
                        if (!imagepng($this->image, $fileName)) {
                            throw new RuntimeException;
                        }
                        break;
                    case IMAGETYPE_JPEG:
                    default:
                        if (!imagejpeg($this->image, $fileName, 95)) {
                            throw new RuntimeException;
                        }
                }
            } catch (Exception $ex) {
                throw new RuntimeException('Error saving image file to ' . $fileName);
            }
        }

        public function getResource()
        {
            return $this->image;
        }

        public function getWidth()
        {
            return $this->width;
        }

        public function getHeight()
        {
            return $this->height;
        }
    }

    function imagecreatefrombmp2($folder_path, $image_name, $image_size_x, $image_size_y)
    {

        $manipulator = new ImageManipulator($folder_path . $image_name);
        $width = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);

        $x1 = $centreX - ($image_size_x / 2);
        $y1 = $centreY - ($image_size_y / 2);

        $x2 = $centreX + ($image_size_x / 2);
        $y2 = $centreY + ($image_size_y / 2);

        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);

        $manipulator->save($folder_path . "crop_" . $image_name);

        return $folder_path . "crop_" . $image_name;

    }
    //use
    //imagecreatefrombmp2("img/twe_system/", "1.jpg", 100, 100);
    function imagecreatefrombmp2_rect($folder_path, $image_name)
    {

        $manipulator = new ImageManipulator($folder_path . $image_name);
        $width = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);

        if ($width > $height) {
            $height_half = $height / 2;

            $x1 = $centreX - $height_half;
            $y1 = $centreY - $centreY;

            $x2 = $centreX + $height_half;
            $y2 = $centreY + $centreY;
        } else {
            $width_half = $width / 2;

            $x1 = $centreX - $centreX;
            $y1 = $centreY - $width_half;

            $x2 = $centreX + $centreX;
            $y2 = $centreY + $width_half;
        }

        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);

        $manipulator->save($folder_path . "croprect_" . $image_name);

        return $folder_path . "croprect_" . $image_name;

    }
    //use
    //imagecreatefrombmp2_rect("img/twe_system/", "1.jpg");
    //end image crop

    //image resize
    function getExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i) {return "";}
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
    function imagecreatefrombmp($p_sFile)
    {
        $file = fopen($p_sFile, "rb");
        $read = fread($file, 10);
        while (!feof($file) && ($read != "")) {
            $read .= fread($file, 1024);
        }

        $temp = unpack("H*", $read);
        $hex = $temp[1];
        $header = substr($hex, 0, 108);
        if (substr($header, 0, 4) == "424d") {
            $header_parts = str_split($header, 2);
            $width = hexdec($header_parts[19] . $header_parts[18]);
            $height = hexdec($header_parts[23] . $header_parts[22]);
            unset($header_parts);
        }
        $x = 0;
        $y = 1;
        $image = imagecreatetruecolor($width, $height);
        $body = substr($hex, 108);
        $body_size = (strlen($body) / 2);
        $header_size = ($width * $height);
        $usePadding = ($body_size > ($header_size * 3) + 4);
        for ($i = 0; $i < $body_size; $i += 3) {
            if ($x >= $width) {
                if ($usePadding) {
                    $i += $width % 4;
                }

                $x = 0;
                $y++;
                if ($y > $height) {
                    break;
                }

            }
            $i_pos = $i * 2;
            $r = hexdec($body[$i_pos + 4] . $body[$i_pos + 5]);
            $g = hexdec($body[$i_pos + 2] . $body[$i_pos + 3]);
            $b = hexdec($body[$i_pos] . $body[$i_pos + 1]);
            $color = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $height - $y, $color);
            $x++;
        }
        unset($body);
        return $image;
    }

    function imageResizer($img_name, $filename, $new_w, $new_h)
    {

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }

        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }

        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }

        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);
        $ratio1 = $old_x / $new_w;
        $ratio2 = $old_y / $new_h;
        if ($ratio1 > $ratio2) {
            $thumb_w = $new_w;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $new_h;
            $thumb_w = $old_x / $ratio2;
        }
        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);
    }

    function imageresize($image_path, $image_prefix, $image_name, $image_size_x, $image_size_y)
    {

        $img_name = $image_path . $image_name;
        $filename = $image_path . $image_prefix . $image_name;

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }
        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $image_size_x;
        $ratio2 = $old_y / $image_size_y;

        if ($ratio1 > $ratio2) {
            $thumb_w = $image_size_x;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $image_size_y;
            $thumb_w = $old_x / $ratio2;
        }

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    function imageresize_min($image_path, $image_name, $image_size)
    {

        $img_name = $image_path . $image_name;
        $filename = $image_path . "resized_" . $image_name;

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }
        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $image_size;
        $ratio2 = $old_y / $image_size;

        if ($ratio1 > $ratio2) {
            $thumb_h = $image_size;
            $thumb_w = $old_x / $ratio2;
        } else {
            $thumb_w = $image_size;
            $thumb_h = $old_y / $ratio1;
        }

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    function imageresize_max($image_path, $image_name, $image_size)
    {

        $img_name = $image_path . $image_name;
        $filename = $image_path . "resized_" . $image_name;

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }
        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $image_size;
        $ratio2 = $old_y / $image_size;

        if ($ratio1 > $ratio2) {
            $thumb_w = $image_size;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $image_size;
            $thumb_w = $old_x / $ratio2;
        }

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    function imageresize_width($image_path, $image_name, $image_size)
    {

        $img_name = $image_path . $image_name;
        $filename = $image_path . "resized_" . $image_name;

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }
        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $image_size;
        $ratio2 = $old_y / $image_size;

        $thumb_w = $image_size;
        $thumb_h = $old_y / $ratio1;

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    function imageresize_height($image_path, $image_name, $image_size)
    {

        $img_name = $image_path . $image_name;
        $filename = $image_path . "resized_" . $image_name;

        $ext = getExtension($img_name);

        if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext) || !strcmp("JPG", $ext) || !strcmp("JPEG", $ext)) {
            $src_img = imagecreatefromjpeg($img_name);
        }
        if (!strcmp("png", $ext) || !strcmp("PNG", $ext)) {
            $src_img = imagecreatefrompng($img_name);
        }
        if (!strcmp("gif", $ext) || !strcmp("GIF", $ext)) {
            $src_img = imagecreatefromgif($img_name);
        }
        if (!strcmp("bmp", $ext) || !strcmp("BMP", $ext)) {
            $src_img = imagecreatefrombmp($img_name);
        }

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $image_size;
        $ratio2 = $old_y / $image_size;

        $thumb_h = $image_size;
        $thumb_w = $old_x / $ratio2;

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (!strcmp("png", $ext)) {
            imagepng($dst_img, $filename);
        } else {
            imagejpeg($dst_img, $filename);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

    }

    function imagewatermask($img_source, $img_mask)
    {
        $img_source_array = explode(".", $img_source);
        $stamp = imagecreatefrompng($img_mask);
        $im = imagecreatefromjpeg($img_source);
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        @imagejpeg($im, $img_source_array[0] . "_masked." . $img_source_array[1]);
        return $img_source_array[0] . "_masked." . $img_source_array[1];
    }

    function thumbnail_rect($image_path, $image_name, $image_size)
    {
        if (!file_exists($image_path . "thumbrect_" . $image_size . "_" . $image_name)) {
            imageresize_min($image_path, $image_name, $image_size);
            imagecreatefrombmp2_rect($image_path, "resized_" . $image_name);
            rename($image_path . "/croprect_resized_" . $image_name, $image_path . "/thumbrect_" . $image_size . "_" . $image_name);
            unlink($image_path . "resized_" . $image_name);
        }
        return $image_path . "thumbrect_" . $image_size . "_" . $image_name;
    }
    //thumbnail_rect("gallery_upload/","61.jpg",200)
    //it's will return path of new thumbnail image

    function thumbnail_ori($image_path, $image_name, $image_size)
    {
        if (!file_exists($image_path . "thumbnail_" . $image_size . "_" . $image_name)) {
            imageresize_min($image_path, $image_name, $image_size);
            rename($image_path . "/resized_" . $image_name, $image_path . "/thumbnail_" . $image_size . "_" . $image_name);
            unlink($image_path . "resized_" . $image_name);
        }
        return $image_path . "thumbnail_" . $image_size . "_" . $image_name;
    }

    function thumbnail($image_path, $image_name, $image_width, $image_height)
    {
        if ($image_name != "") {
            if (file_exists($image_path . $image_name)) {
                if (!file_exists($image_path . "thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name)) {
                    list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($image_path . $image_name);
                    if ($imgWidth > $imgHeight) {
                        $image_size = $image_height;
                    } else if ($imgWidth < $imgHeight) {
                        $image_size = $image_width;
                    } else {
                        if ($image_width > $image_height) {
                            $image_size = $image_height;
                        } else if ($image_width < $image_height) {
                            $image_size = $image_width;
                        } else {
                            $image_size = $image_width;
                        }
                    }
                    if ($image_width >= $image_height) {
                        $diff_parameter = $image_width - $image_height;
                    } else {
                        $diff_parameter = $image_height - $image_width;
                    }
                    imageresize_min($image_path, $image_name, $image_size);
                    list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($image_path . "resized_" . $image_name);
                    if ($imgWidth >= $imgHeight) {
                        $diff_min = $imgWidth - $imgHeight;
                    } else {
                        $diff_min = $imgHeight - $imgWidth;
                    }
                    if ($diff_parameter <= $diff_min) {
                        imagecreatefrombmp2($image_path, "resized_" . $image_name, $image_width, $image_height);
                        rename($image_path . "/crop_resized_" . $image_name, $image_path . "/thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name);
                        @unlink($image_path . "resized_" . $image_name);
                        @unlink($image_path . "crop_resized_" . $image_name);
                    } else {
                        if (($image_width > $image_height) && ($imgWidth > $imgHeight)) {
                            @unlink($image_path . "resized_" . $image_name);
                            if ($image_size == $image_height) {
                                $image_size = $image_width;
                            } else {
                                $image_size = $image_height;
                            }
                            imageresize_max($image_path, $image_name, $image_size);
                            imagecreatefrombmp2($image_path, "resized_" . $image_name, $image_width, $image_height);
                            rename($image_path . "/crop_resized_" . $image_name, $image_path . "/thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name);
                            @unlink($image_path . "resized_" . $image_name);
                            @unlink($image_path . "crop_resized_" . $image_name);
                        } else if (($image_width < $image_height) && ($imgWidth < $imgHeight)) {
                            @unlink($image_path . "resized_" . $image_name);
                            if ($image_size == $image_height) {
                                $image_size = $image_width;
                            } else {
                                $image_size = $image_height;
                            }
                            imageresize_max($image_path, $image_name, $image_size);
                            imagecreatefrombmp2($image_path, "resized_" . $image_name, $image_width, $image_height);
                            rename($image_path . "/crop_resized_" . $image_name, $image_path . "/thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name);
                            @unlink($image_path . "resized_" . $image_name);
                            @unlink($image_path . "crop_resized_" . $image_name);
                        } else {
                            imagecreatefrombmp2($image_path, "resized_" . $image_name, $image_width, $image_height);
                            rename($image_path . "/crop_resized_" . $image_name, $image_path . "/thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name);
                            @unlink($image_path . "resized_" . $image_name);
                            @unlink($image_path . "crop_resized_" . $image_name);
                        }
                    }
                }
                return $image_path . "thumbnail_" . $image_width . "_" . $image_height . "_" . $image_name;
            } else {
                return $image_path . "default.png";
            }
        } else {
            return $image_path . "default.png";
        }
    }
}

thumbnail("img/", "1399470196.jpg", "135", "135");
