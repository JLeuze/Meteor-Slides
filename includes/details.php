<?php

define( 'METEOR_SLIDES_CSS_FILE_NAME', 'meteor-slides.css' );

function use_the_css_file_provided_by_the_plugin() {

	add_css_for_the_slideshow( $url_of_meteor_slides_css_file = plugins_url( '/css/' . METEOR_SLIDES_CSS_FILE_NAME, __FILE__ ) );

}

function use_the_css_file_provided_by_the_theme() {

	add_css_for_the_slideshow( $url_of_meteor_slides_css_file = get_template_directory_uri() . '/' . METEOR_SLIDES_CSS_FILE_NAME );

}

function use_the_css_file_provided_by_the_child_theme() {

	add_css_for_the_slideshow( $url_of_meteor_slides_css_file = get_stylesheet_directory_uri() . '/' . METEOR_SLIDES_CSS_FILE_NAME );

}

function the_child_theme_has_overridden_the_slideshow_css() {

	return the_child_theme_has_overridden( $file_to_check_for = METEOR_SLIDES_CSS_FILE_NAME );

}

function the_child_theme_has_overridden( $file_to_check_for ) {

	return file_exists( get_stylesheet_directory() . "/" . $file_to_check_for );

}

function the_theme_has_overridden_css_for_meteor_slides() {

	return the_theme_has_overridden( $file_to_check_for = METEOR_SLIDES_CSS_FILE_NAME );

}

function the_theme_has_overridden( $file_to_check_for ) {

	return file_exists( get_template_directory() . "/" . $file_to_check_for );

}


function add_css_for_the_slideshow( $url_of_meteor_slides_css_file ) {
	
	wp_enqueue_style(

		$handle = 'meteor-slides',
		$src = $url_of_meteor_slides_css_file,
		$deps = array(),
		$version = '1.0'

	);

}

define( 'METEOR_SLIDES_JAVASCRIPT_FILE_NAME', 'slideshow.js' );

function the_child_theme_has_overridden_the_slideshow_javascript() {

	return the_child_theme_has_overridden( $file_to_check_for = METEOR_SLIDES_JAVASCRIPT_FILE_NAME );

}

function use_the_javascript_file_provided_by_the_child_theme() {

	add_javascript_for_the_slideshow( $url_of_meteor_slides_javascript_file = get_stylesheet_directory_uri() . '/' . METEOR_SLIDES_JAVASCRIPT_FILE_NAME );

}

function the_theme_has_overridden_the_slideshow_javascript() {

	return the_theme_has_overridden( $file_to_check_for = METEOR_SLIDES_JAVASCRIPT_FILE_NAME );

}

function use_the_javascript_file_provided_by_the_theme() {

	add_javascript_for_the_slideshow( $url_of_meteor_slides_javascript_file = get_template_directory_uri() . '/' . METEOR_SLIDES_JAVASCRIPT_FILE_NAME );

}

function use_the_slideshow_javascript_file_provided_by_the_plugin() {

	add_javascript_for_the_slideshow( $url_of_meteor_slides_javascript_file = plugins_url( '/js/' . METEOR_SLIDES_JAVASCRIPT_FILE_NAME, __FILE__ ) );

}

function add_javascript_for_the_slideshow( $url_of_meteor_slides_javascript_file ) {

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-cycle', plugins_url( '/js/jquery.cycle.all.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'jquery-metadata', plugins_url( '/js/jquery.metadata.v2.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'jquery-touchwipe', plugins_url( '/js/jquery.touchwipe.1.1.1.js', __FILE__ ), array( 'jquery' ) );

	wp_enqueue_script(

		$handle = 'meteorslides-script',
		$src = $url_of_javascript_file_to_use,
		$deps = array( 'jquery', 'jquery-cycle' ),
		$version = '1.0',
		$in_footer = true

	);
	
	$meteor_options = meteorslides_get_options();
	wp_localize_script( 'meteorslides-script', 'meteorslidessettings',
	
		array(
		
			'meteorslideshowspeed'      => $meteor_options['transition_speed'] * 1000,
			'meteorslideshowduration'   => $meteor_options['slide_duration'] * 1000,
			'meteorslideshowheight'     => $meteor_options['slide_height'],
			'meteorslideshowwidth'      => $meteor_options['slide_width'],
			'meteorslideshowtransition' => $meteor_options['transition_style']
			
		)
		
	);
}
