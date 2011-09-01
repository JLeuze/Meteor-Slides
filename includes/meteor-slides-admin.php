<?php
	
	//Adds filter to customize messages for the slide post type

	add_filter( 'post_updated_messages', 'meteorslides_updated_messages' );

	function meteorslides_updated_messages( $messages ) {

		global $post, $post_ID;

		$messages['slide'] = array( 
  
			0  => '',
			1  => sprintf( __( 'Slide updated. <a href="%s">View slide</a>', 'meteor-slides' ), esc_url( get_permalink($post_ID) ) ),
			2  => __( 'Custom field updated.', 'meteor-slides' ),
			3  => __( 'Custom field deleted.', 'meteor-slides' ),
			4  => __( 'Slide updated.', 'meteor-slides' ),
			5  => isset($_GET['revision']) ? sprintf( __( 'Slide restored to revision from %s', 'meteor-slides' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( 'Slide published. <a href="%s">View slide</a>', 'meteor-slides' ), esc_url( get_permalink($post_ID) ) ),
			7  => __( 'Slide saved.', 'meteor-slides' ),
			8  => sprintf( __( 'Slide submitted. <a target="_blank" href="%s">Preview slide</a>', 'meteor-slides' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9  => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>', 'meteor-slides' ), date_i18n( __( 'M j, Y @ G:i', 'meteor-slides' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __( 'Slide draft updated. <a target="_blank" href="%s">Preview slide</a>', 'meteor-slides' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
 
		);

		return $messages;
  
	}
	
	// Customize and move featured image box to main column
	
	add_action( 'do_meta_boxes', 'meteorslides_image_box' );
	
	function meteorslides_image_box() {
		
		$options = get_option('meteorslides_options');
		
		$title = __( 'Slide Image', 'meteor-slides' ) . ' (' . $options['slide_width'] . 'x' . $options['slide_height'] . ')';
	
		remove_meta_box( 'postimagediv', 'slide', 'side' );
	
		add_meta_box( 'postimagediv', $title, 'post_thumbnail_meta_box', 'slide', 'normal', 'high' );
	
	}
	
	// Remove permalink metabox
	
	add_action( 'admin_menu', 'meteorslides_remove_permalink_meta_box' );

	function meteorslides_remove_permalink_meta_box() {
	
		remove_meta_box( 'slugdiv', 'slide', 'core' );
	
	}
		
	// Adds meta box for Slide URL
	
	add_action( 'admin_menu', 'meteorslides_create_url_meta_box' );

	$meteorslides_new_meta_box =

		array(
		
			'slide_url' => array(
			
				'name' => 'slide_url',
				'std'  => ''				
			)

		);

	function meteorslides_new_meta_box() {
	
		global $post, $meteorslides_new_meta_box;

		foreach ( $meteorslides_new_meta_box as $meteorslides_meta_box ) {

			$meteorslides_meta_box_value = get_post_meta( $post->ID, $meteorslides_meta_box['name'].'_value', true );  

			if( $meteorslides_meta_box_value == "" ) $meteorslides_meta_box_value = $meteorslides_meta_box['std'];

			echo "<input type='hidden' name='" . $meteorslides_meta_box['name'] . "_noncename' id='" . $meteorslides_meta_box['name'] . " _noncename' value='" . wp_create_nonce( plugin_basename(__FILE__) ) . "' />";

			echo "<input type='text' name='" . $meteorslides_meta_box['name'] . "_value' value='" . $meteorslides_meta_box_value . "' size='55' /><br />";

			echo "<p>" . __('Add the URL this slide should link to.','meteor-slides') . "</p>";

		}

	}

	function meteorslides_create_url_meta_box() {
	
		global $theme_name;

		if ( function_exists('add_meta_box') ) {

			add_meta_box( 'meteorslides-url-box', __('Slide Link','meteor-slides'), 'meteorslides_new_meta_box', 'slide', 'normal', 'low' );

		}

	}
	
	// Save and retrieve the Slide URL data
	
	add_action( 'save_post', 'meteorslides_save_postdata' );

	function meteorslides_save_postdata( $post_id ) {

		global $post, $meteorslides_new_meta_box;

		foreach( $meteorslides_new_meta_box as $meteorslides_meta_box ) {

			if ( !isset( $_POST[$meteorslides_meta_box['name'].'_noncename']  ) || !wp_verify_nonce( $_POST[$meteorslides_meta_box['name'].'_noncename'], plugin_basename(__FILE__) ) ) {

				return $post_id;

			}

			if ( 'page' == $_POST['post_type'] ) {

				if( !current_user_can( 'edit_page', $post_id ) )

				return $post_id;

			}
			
			else {
			
				if( !current_user_can( 'edit_post', $post_id ) )

				return $post_id;

			}

			$data = $_POST[$meteorslides_meta_box['name'].'_value'];

			if ( get_post_meta( $post_id, $meteorslides_meta_box['name'].'_value' ) == "" ) {
			
				add_post_meta( $post_id, $meteorslides_meta_box['name'].'_value', $data, true );
			
			}
			
			elseif ( $data != get_post_meta( $post_id, $meteorslides_meta_box['name'].'_value', true ) ) {

				update_post_meta( $post_id, $meteorslides_meta_box['name'].'_value', $data );
			
			}

			elseif ( $data == "" ) {

				delete_post_meta( $post_id, $meteorslides_meta_box['name'].'_value', get_post_meta( $post_id, $meteorslides_meta_box['name'].'_value', true ) );
			
			}
			
		}

	}
	
	// Adds slide image and link to slides column view
	
	add_filter( 'manage_edit-slide_columns', 'meteorslides_edit_columns' );
 
	function meteorslides_edit_columns( $columns ) {
	
		$columns = array(
		
			'cb'         => '<input type="checkbox" />',
			'slide'      => __( 'Slide Image', 'meteor-slides' ),
			'title'      => __( 'Slide Title', 'meteor-slides' ),
			'slide-link' => __( 'Slide Link', 'meteor-slides' ),
			'date'       => __( 'Date', 'meteor-slides' )

		);
 
		return $columns;
  
	}
	
	add_action( 'manage_posts_custom_column', 'meteorslides_custom_columns' );
	
	function meteorslides_custom_columns( $column ) {
	
		global $post;
 
		switch ( $column ) {
		
			case 'slide' :
			
				echo the_post_thumbnail('featured-slide-thumb');
			
			break;
			
			case 'slide-link' :
			
				if ( get_post_meta($post->ID, "slide_url_value", $single = true) != "" ) {
				
					echo "<a href='" . get_post_meta($post->ID, "slide_url_value", $single = true) . "'>" . get_post_meta($post->ID, "slide_url_value", $single = true) . "</a>";
			
				}  
			
				else {
				
					_e('No Link', 'meteor-slides');
			
				}
			
			break;

		}
		
	}
	
	//display contextual help for slides
	
	add_action( 'contextual_help', 'meteorslides_add_help_text', 10, 3 );

	function meteorslides_add_help_text($contextual_help, $screen_id, $screen) { 
	
		if ('slide' == $screen->id ) {
		
			$contextual_help =
			'<h3>' . __( 'Add New Slide', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<strong>Title:</strong> Each slide needs a title in order to be published.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Slide Image:</strong> To add an image to a slide, click the <strong>Set featured image</strong> link. Upload an image, or browse the media library for one, click the <strong>Use as featured image</strong> link to add the image and then close the media uploader. The Slide Image metabox should now have a thumbnail image.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Slide Link:</strong> Add the full URL to the Slide Link metabox, such as <em>http://wordpress.org/</em> (Optional)', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Slideshows:</strong> A slide can be added to a slideshow by selecting the slideshow from the Slideshows metabox.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( "<strong>Slide Order:</strong> Slides are sorted chronologically, edit the slide's published date to change the order of the slide.", "meteor-slides" ) . '</p>' .
			'<h3>' . __( 'For more information', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<a href="http://www.jleuze.com/plugins/meteor-slides/using-meteor-slides/" target="_blank">Using Meteor Slides Documentation</a>', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<a href="http://wordpress.org/tags/meteor-slides" target="_blank">Plugin Support Forum</a>', 'meteor-slides' ) . '</p>';
			
		} elseif ( 'edit-slide' == $screen->id ) {
		
			$contextual_help =
			
			'<h3>' . __( 'Slides', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( 'Choose a slide to edit, or add a new slide.', 'meteor-slides' ) . '</p>' .
			'<h3>' . __( 'For more information', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<a href="http://www.jleuze.com/plugins/meteor-slides/installation/" target="_blank">Meteor Slides Documentation</a>', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<a href="http://wordpress.org/tags/meteor-slides" target="_blank">Plugin Support Forum</a>', 'meteor-slides' ) . '</p>';
			
		} elseif ( 'edit-slideshow' == $screen->id ) {
		
			$contextual_help =
			
			'<h3>' . __( 'Slideshows', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( 'Slides can be organized into slideshows, just as posts can be organized into categories.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Add New Slideshow:</strong> Name the slideshow, specify a Slug or one will be generated from the name, skip the Parent and Description and click <strong>Add New Slideshow</strong>.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Add Slide to Slideshow:</strong> Edit a slide and select the slideshow in the Slideshows metabox.', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<strong>Adding a specific Slideshow:</strong> Add a slideshow slug to a template tag, shortcode, or widget to load a specific slideshow. Here is an example using the shortcode:', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<code>[meteor_slideshow slideshow="slug"]</code>', 'meteor-slides' ) . '</p>' .
			'<h3>' . __( 'For more information', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<a href="http://www.jleuze.com/plugins/meteor-slides/multiple-slideshows/" target="_blank">Multiple Slideshows Documentation</a>', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<a href="http://wordpress.org/tags/meteor-slides" target="_blank">Plugin Support Forum</a>', 'meteor-slides' ) . '</p>';
			
		} elseif ( 'slide_page_slides_settings' == $screen->id ) {
		
			$contextual_help =
			
			'<h3>' . __( 'Configure Slideshow', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<em>Before adding any slides, enter the slide height and width in the settings so the slides are the correct dimensions.</em>', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( "<strong>Slideshow Quantity:</strong> Choose the number of slides that are loaded in the slideshow. (Leave this option blank to reset the settings)", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Slide Height:</strong> Enter the height of your slides in pixels. For slides of different heights, use the height of the tallest slide.", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Slide Width:</strong> Enter the width of your slides in pixels. Slides that are narrower than this will be centered in the slideshow.", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Transition Style:</strong> Choose the effect that is used to transition between slides.", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Transition Speed:</strong> Enter the number of seconds that it should take for a transition between slides to complete.", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Slide Duration:</strong> Enter the number of seconds that each slide should be paused on in the slideshow.", "meteor-slides" ) . '</p>' .
			'<p>'  . __( "<strong>Slideshow Navigation:</strong> ", "meteor-slides" ) . '</p>' .
			'<ul>' .
			'<li>'  . __( "<strong>None:</strong> The default option, no navigation is added to the slideshow.", "meteor-slides" ) . '</li>' .
			'<li>'  . __( "<strong>Previous/Next:</strong> Left and right buttons are added to the slideshow to cycle through the slides.", "meteor-slides" ) . '</li>' .
			'<li>'  . __( "<strong>Paged:</strong> Small round buttons are added below the slideshow to choose a specific slide and highlight the current slide.", "meteor-slides" ) . '</li>' .
			'<li>'  . __( "<strong>Both:</strong> Previous/Next and Paged navigation are both added to the slideshow.", "meteor-slides" ) . '</li>' .
			'</ul>' .
			'<h3>' . __( 'Add Slideshow', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( 'Check out the documentation for <a href="http://www.jleuze.com/plugins/meteor-slides/adding-a-slideshow/" target="_blank">adding a slideshow</a>.', 'meteor-slides' ) . '</p>' .
			'<h3>' . __( 'For more information', 'meteor-slides' ) . '</h3>' .
			'<p>'  . __( '<a href="http://www.jleuze.com/plugins/meteor-slides/installation/" target="_blank">Meteor Slides Documentation</a>', 'meteor-slides' ) . '</p>' .
			'<p>'  . __( '<a href="http://wordpress.org/tags/meteor-slides" target="_blank">Plugin Support Forum</a>', 'meteor-slides' ) . '</p>';
			
		}
		
		return $contextual_help;

	}

	// Adds Slideshow settings page
	
	function meteorslides_set_options_cap(){

		if ( function_exists( 'members_get_capabilities' ) ) {
	
			return 'meteorslides_manage_options';
		
		} else {
	
			return 'manage_options';
		
		}
	
	}
	
	add_filter( 'option_page_capability_meteorslides_options', 'meteorslides_options_cap' );
	
	function meteorslides_options_cap( $capability ) {
	
		if ( function_exists( 'members_get_capabilities' ) ) {
	
			return 'meteorslides_manage_options';
		
		} else {
	
			return 'manage_options';
		
		}
		
	}
		
	add_action( 'admin_menu', 'meteorslides_menu' );

	function meteorslides_menu() {
		
		add_submenu_page( 'edit.php?post_type=slide', __( 'Slides Settings', 'meteor-slides' ), __( 'Settings', 'meteor-slides' ), meteorslides_set_options_cap(),  'slides_settings', 'meteorslides_settings_page' );
		
	}
	
	function meteorslides_settings_page() {
		
		include( 'meteor-slides-settings.php' );
	
	}
	
	// Add custom slide capabilities for the Members plugin
	
	add_action( 'admin_init', 'meteorslides_members_capabilities' );

	function meteorslides_members_capabilities() {
	
		if ( function_exists( 'members_get_capabilities' ) ) {
	
			add_filter( 'members_get_capabilities', 'meteorslides_add_members_caps' );
		
		}
	
	}

	function meteorslides_add_members_caps( $caps ) {
	
		$caps[] = 'meteorslides_manage_options';
		$caps[] = 'meteorslides_edit_slide';
		$caps[] = 'meteorslides_edit_slides';
		$caps[] = 'meteorslides_edit_others_slides';
		$caps[] = 'meteorslides_publish_slides';
		$caps[] = 'meteorslides_read_slides';
		$caps[] = 'meteorslides_read_private_slides';
		$caps[] = 'meteorslides_delete_slide';
		$caps[] = 'meteorslides_manage_slideshows';
		
		return $caps;
		
	}
	
	// Adds link to settings page on plugins page
		
	add_filter( 'plugin_action_links', 'meteorslides_settings_link', 10, 2 );
	
	function meteorslides_settings_link( $links, $file ) {
		
		if ( $file == plugin_basename( 'meteor-slides/meteor-slides-plugin.php' ) ) {
		
			$links[] = '<a href="edit.php?post_type=slide&page=slides_settings">'.__( 'Settings', 'meteor-slides' ).'</a>';
	
		}
		
		return $links;
		
	}
	
	// Register options for settings page

	add_action( 'admin_init', 'meteorslides_register_settings' );
	
	function meteorslides_register_settings() {

		register_setting( 'meteorslides_options', 'meteorslides_options' );
		
		add_settings_section( 'meteorslides_slideshow', __( 'Configure Slideshow', 'meteor-slides' ), 'meteorslides_section_text', 'meteorslides' );
		
		add_settings_field( 'slideshow_quantity', __( 'Slideshow Quantity', 'meteor-slides' ), 'slideshow_quantity', 'meteorslides', 'meteorslides_slideshow' );

		add_settings_field( 'slide_height', __( 'Slide Height', 'meteor-slides' ), 'slide_height', 'meteorslides', 'meteorslides_slideshow' );
		
		add_settings_field( 'slide_width', __( 'Slide Width', 'meteor-slides' ), 'slide_width', 'meteorslides', 'meteorslides_slideshow' );

		add_settings_field( 'transition_style', __( 'Transition Style', 'meteor-slides' ), 'transition_style', 'meteorslides', 'meteorslides_slideshow' );

		add_settings_field( 'transition_speed', __( 'Transition Speed', 'meteor-slides' ), 'transition_speed', 'meteorslides', 'meteorslides_slideshow' );

		add_settings_field( 'slide_duration', __( 'Slide Duration', 'meteor-slides' ), 'slide_duration', 'meteorslides', 'meteorslides_slideshow' );
	
		add_settings_field( 'slideshow_navigation', __( 'Slideshow Navigation', 'meteor-slides' ), 'slideshow_navigation', 'meteorslides', 'meteorslides_slideshow' );

	}
	
	// Validates values for options on settings page
	
	function meteorslides_options_validate( $input ) {

		$options = get_option( 'meteorslides_options' );

		$options['slideshow_quantity'] = trim( $input['slideshow_quantity'] );

		if ( !preg_match( '/^[0-9]{1,3}$/i', $options['slideshow_quantity'] ) ) {

			$options['slideshow_quantity'] = '';

		}
		
		$options['slide_height'] = trim( $input['slide_height'] );

		if ( !preg_match( '/^[0-9]{1,4}$/i', $options['slide_height'] ) ) {

			$options['slide_height'] = '';

		}
		
		$options['slide_width'] = trim( $input['slide_width'] );

		if ( !preg_match( '/^[0-9]{1,5}$/i', $options['slide_width'] ) ) {

			$options['slide_width'] = '';

		}
		
		$options['transition_style'] = trim( $input['transition_style'] );

		if ( !preg_match( '/^[a-z]{4,20}$/i', $options['transition_style'] ) ) {

			$options['transition_style'] = '';

		}
		
		$options['transition_speed'] = trim( $input['transition_speed'] );

		if ( !preg_match( '/^[0-9]{1,3}$/i', $options['transition_speed'] ) ) {

			$options['transition_speed'] = '';

		}
		
		$options['slide_duration'] = trim( $input['slide_duration'] );

		if ( !preg_match( '/^[0-9]{1,3}$/i', $options['slide_duration'] ) ) {

			$options['slide_duration'] = '';

		}
		
		$options['slideshow_navigation'] = trim( $input['slideshow_navigation'] );

		if ( !preg_match( '/^[a-z]{4,20}$/i', $options['slideshow_navigation'] ) ) {

			$options['slideshow_navigation'] = '';

		}

		return $options;
		
	}
	
	// Adds translation support for language files
	
	add_action( 'plugins_loaded', 'meteorslides_localization' );

	function meteorslides_localization() {
		
		load_plugin_textdomain( 'meteor-slides', false, '/meteor-slides/languages/' );
		
	}

	// Adds CSS for the Slides admin pages
	
	add_action( 'admin_enqueue_scripts', 'meteorslides_admin_css' );

	function meteorslides_admin_css() {
		
		global $post_type;
				
		if ( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'slide' ) || ( isset( $post_type ) && $post_type == 'slide' ) ) {
	
			wp_enqueue_style( 'meteor-slides-admin', plugins_url( 'meteor-slides/css/meteor-slides-admin.css' ), array(), '1.0' );
	
		}
		
	}

?>