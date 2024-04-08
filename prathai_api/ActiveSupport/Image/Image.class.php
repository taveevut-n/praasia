<?php
class Image {
	public static $MIME_TYPE_JPEG = "image/jpeg";
	public static $MIME_TYPE_JPG = self::MIME_TYPE_JPEG;
	public static $MIME_TYPE_PNG = "image/png";
	public static $MIME_TYPE_GIF = "image/gif";
	public static $MIME_TYPE_BMP = "image/bmp";
	public static $MIME_TYPE_SVG = "image/xml+svg";
	private $mMimeType;
	private $mSourceFile;
	private $mOriginalWidth;
	private $mOriginalHeight;
	private $mThumWidth;
	private $mThumHeight;
	function __construct() {
	}
}

?>