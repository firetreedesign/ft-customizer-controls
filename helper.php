<?php
/**
 * FT Customizer Controls Helper
 *
 * @version 1.0.0
 * @package WordPress
 * @subpackage Customizer
 */

 namespace FTCustomizerControls\Helper;

 if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Not allowed' );
}

function enqueue_google_fonts( $theme_option_name = '' ) {
	$fonts = trim( get_theme_mod( $theme_option_name, '' ) );
	
	if ( 0 === strlen( $fonts ) ) {
		return;
	}

	$fonts_array = array();
	$lines = explode( "\n", $fonts );

	foreach ( $lines as $line ) {
		$font_name = get_string_between( $line, 'family=', '&display=swap' );
		
		if ( 0 !== strpos( $font_name, ':wght@' ) ) {
			$font_name = substr( $font_name, 0, strpos( $font_name, ':wght@' ) );
		}

		$font_name = str_replace( ' ', '-', strtolower( urldecode( $font_name ) ) );
		$font_url = str_replace( 'https://', '//', $line );
		$font_url = str_replace( 'http://', '//', $font_url );
		
		wp_enqueue_style( $font_name, $font_url, array(), NULL );
	}
}

function get_string_between( $string, $start, $end ){
    $string = ' ' . $string;
    $ini = strpos( $string, $start );
    if ( $ini == 0 ) {
		return '';
	}
    $ini += strlen( $start );
    $len = strpos( $string, $end, $ini ) - $ini;
    return substr( $string, $ini, $len );
}