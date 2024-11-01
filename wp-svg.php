<?php
/*
Plugin Name: WP-SVG
Plugin URI:
Description: WP-SVG allow you to embed SVG images into wordpress posts and pages using shortcode. It uses SVGWEB (http://code.google.com/p/svgweb/) project to provide cross-browser SVG support.
Author: DmitriySalko
Author URI: http://salko.org.ua/
Version: 0.9
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* shortcode for svg */
class WPSvg {

	public static function init(){
		add_shortcode('svg', array(__CLASS__, 'shortcode'));
		add_action('wp_head', array(__CLASS__, 'include_script'));
	}

	public static function shortcode($atts) {
		extract( shortcode_atts( array(
			'src' => false,
			'width' => 100,
			'height' => 100
		), $atts ) );	
		if( $src ) {
		$res = '<!--[if !IE]>--><object data="'.$src.'" type="image/svg+xml" width="'.$width.'" height="'.$height.'"> <!--<![endif]-->'.
		       '<!--[if lt IE 9]><object src="'.$src.'" classid="image/svg+xml" width="'.$width.'" height="'.$height.'"> <![endif]--><!--[if gte IE 9]>'.
		       '<object data="'.$src.'" type="image/svg+xml"  width="'.$width.'" height="'.$height.'"><![endif]--></object>';
	
		} 
		return $res;
	}

	function include_script() {
		echo '<script type="text/javascript" src="'.plugins_url('wp-svg/data/svg.js').'" data-path="'.plugins_url('wp-svg/data/').'"></script>';
	}
 

}

WPSvg::init();