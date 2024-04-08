<?php
class SiteMenu {
	private $s_header_text;
	private $a_menu;
	private $s_name;
	private $s_bg_color;
	private $s_child_bg_color;
	private $s_site_menu;
	
	/**
	 * Constructor
	 *
	 */
	public function __construct($s_header_text = 'Main Menu') {
		$this->a_menu = array ();
		$this->s_header_text = $s_header_text;
	}
	
	/**
	 * Set name and id on object. 
	 *
	 * @param string $s_name
	 */
	public function setName($s_name) {
		$this->s_name = $s_name;
	}
	
	public function getName() {
		return $this->s_name;
	}
	
	public function setHeaderText($s_text) {
		$this->s_header_text = $s_text;
	}
	
	public function getHeaderText() {
		return $this->s_header_text;
	}
	
	public function setBGColor($s_color) {
		$this->s_bg_color = $s_color;
	}
	
	public function getBGColor() {
		return $this->s_bg_color;
	}
	
	public function setChildBGColor($s_color) {
		$this->s_child_bg_color = $s_color;
	}
	
	public function getChildBGColor() {
		return $this->s_child_bg_color;
	}
	
	public function addSubMenu(SiteMenu $o_site_menu) {
		$o_site_menu;
	}
	
	public function createChild($s_text_menu, $s_img, $s_text_url, $s_text_param) {
		$this->a_menu [] = array ('is_head_menu' => false, 'menu_text' => $s_text_menu, 'menu_img' => $s_img, 'menu_url' => $s_text_url, 'menu_param' => $s_text_param );
	}
	
	/**
	 * Parse site to HTML format.
	 *
	 * @return string
	 */
	public function render() {
		$s_tag = '<table bgColor="' . self::getBGColor () . '" style="border:solid thin;" cellpadding="1" cellspacing="0" width="200"><tr><td>' . "\r\n";
		$s_tag .= '<tr><td onclick="if(document.getElementById(\'' . self::getName () . '\').style.display!=\'inline\'){ document.getElementById(\'' . self::getName () . '\').style.display=\'inline\'; } else { document.getElementById(\'' . self::getName () . '\').style.display=\'none\' }"><font color="white">' . self::getHeaderText () . '</font></td></tr>' . "\r\n";
		$s_tag .= '<tr><td>' . "\r\n";
		$s_tag .= '<table style="display:inline;" width="100%" id="' . $this->s_name . '" bgColor="' . self::getBGColor () . '" border="0" cellpadding="1" cellspacing="0" >' . "\r\n";
		for($i_loop = 0; $i_loop < count ( $this->a_menu ); $i_loop ++) {
			$a_menu = $this->a_menu [$i_loop];
			$s_tag .= '<tr bgColor="' . self::getChildBGColor () . '">' . "\r\n";
			$s_tag .= '<td width="30"><img src="' . $a_menu ['menu_img'] . '" border="0"/></td><td  align="left" width="170"><a href="' . $a_menu ['menu_url'] . (($a_menu ['menu_param'] == '') ? '' : '?' . $a_menu ['menu_param']) . '">' . $a_menu ['menu_text'] . '</a></td>' . "\r\n";
			$s_tag .= '</tr>' . "\r\n";
		}
		$s_tag .= '</table>' . "\r\n";
		$s_tag .= '</tr></td></table>' . "\r\n";
		return $s_tag;
	}
	
	/**
	 * show site menu on html.
	 *
	 */
	public function show() {
		print self::render ();
	}
}
?>