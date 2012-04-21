<?php

	// Populate the sections and settings of the options page
		
	function meteorslides_section_text() {
	
		echo "<p>". __( 'Set up your slideshow using the options below.', 'meteor-slides' ) ."</p>";

	}
	
	function meteorslides_slideshow_quantity() {
		
		$meteor_slides  = __( 'slides', 'meteor-slides' );
		$meteor_options = get_option('meteorslides_options');
			
		echo "<input id='slideshow_quantity' name='meteorslides_options[slideshow_quantity]' size='20' type='text' value='{$meteor_options['slideshow_quantity']}' /> $meteor_slides";

	}
	
	function meteorslides_slide_height() {
		
		$meteor_px      = __( 'px', 'meteor-slides' );
		$meteor_options = get_option('meteorslides_options');

		echo "<input id='slide_height' name='meteorslides_options[slide_height]' size='20' type='text' value='{$meteor_options['slide_height']}' /> $meteor_px";

	}
		
	function meteorslides_slide_width() {
		
		$meteor_px      = __( 'px', 'meteor-slides' );
		$meteor_options = get_option('meteorslides_options');

		echo "<input id='slide_width' name='meteorslides_options[slide_width]' size='20' type='text' value='{$meteor_options['slide_width']}' /> $meteor_px";

	}
	
	function meteorslides_transition_style() {
				
		$meteor_blindX      = __( 'blindX', 'meteor-slides' );
		$meteor_blindY      = __( 'blindY', 'meteor-slides' );
		$meteor_blindZ      = __( 'blindZ', 'meteor-slides' );
		$meteor_cover       = __( 'cover', 'meteor-slides' );
		$meteor_curtainX    = __( 'curtainX', 'meteor-slides' );
		$meteor_curtainY    = __( 'curtainY', 'meteor-slides' );
		$meteor_fade        = __( 'fade', 'meteor-slides' );
		$meteor_fadeZoom    = __( 'fadeZoom', 'meteor-slides' );
		$meteor_growX       = __( 'growX', 'meteor-slides' );
		$meteor_growY       = __( 'growY', 'meteor-slides' );
		$meteor_none        = __( 'none', 'meteor-slides' );
		$meteor_scrollUp    = __( 'scrollUp', 'meteor-slides' );
		$meteor_scrollDown  = __( 'scrollDown', 'meteor-slides' );
		$meteor_scrollLeft  = __( 'scrollLeft', 'meteor-slides' );
		$meteor_scrollRight = __( 'scrollRight', 'meteor-slides' );
		$meteor_scrollHorz  = __( 'scrollHorz', 'meteor-slides' );
		$meteor_scrollVert  = __( 'scrollVert', 'meteor-slides' );
		$meteor_slideX      = __( 'slideX', 'meteor-slides' );
		$meteor_slideY      = __( 'slideY', 'meteor-slides' );
		$meteor_shuffle     = __( 'shuffle', 'meteor-slides' );
		$meteor_turnUp      = __( 'turnUp', 'meteor-slides' );
		$meteor_turnDown    = __( 'turnDown', 'meteor-slides' );
		$meteor_turnLeft    = __( 'turnLeft', 'meteor-slides' );
		$meteor_turnRight   = __( 'turnRight', 'meteor-slides' );
		$meteor_uncover     = __( 'uncover', 'meteor-slides' );
		$meteor_wipe        = __( 'wipe', 'meteor-slides' );
		$meteor_zoom        = __( 'zoom', 'meteor-slides' );
		$meteor_options     = get_option( 'meteorslides_options' );
		$meteor_item        = array(
			
			'blindX'      => $meteor_blindX,
			'blindY'      => $meteor_blindY,
			'blindZ'      => $meteor_blindZ,
			'cover'       => $meteor_cover,
			'curtainX'    => $meteor_curtainX,
			'curtainY'    => $meteor_curtainY,
			'fade'        => $meteor_fade,
			'fadeZoom'    => $meteor_fadeZoom,
			'growX'       => $meteor_growX,
			'growY'       => $meteor_growY,
			'none'        => $meteor_none,
			'scrollUp'    => $meteor_scrollUp,
			'scrollDown'  => $meteor_scrollDown,
			'scrollLeft'  => $meteor_scrollLeft,
			'scrollRight' => $meteor_scrollRight,
			'scrollHorz'  => $meteor_scrollHorz,
			'scrollVert'  => $meteor_scrollVert,
			'slideX'      => $meteor_slideX,
			'slideY'      => $meteor_slideY,
			'shuffle'     => $meteor_shuffle,
			'turnUp'      => $meteor_turnUp,
			'turnDown'    => $meteor_turnDown,
			'turnLeft'    => $meteor_turnLeft,
			'turnRight'   => $meteor_turnRight,
			'uncover'     => $meteor_uncover,
			'wipe'        => $meteor_wipe,
			'zoom'        => $meteor_zoom
			
		);
		
		echo "<select id='transition_style' name='meteorslides_options[transition_style]' style='width:142px;'>";
		
		while ( list( $meteor_key, $meteor_val ) = each( $meteor_item ) ) {

			$meteor_selected = ( $meteor_options['transition_style']==$meteor_key ) ? ' selected="selected"' : '';
		
			echo "<option value='$meteor_key'$meteor_selected>$meteor_val</option>";
	
		}
		
		echo "</select>";
		
	}
		
	function meteorslides_transition_speed() {
		
		$meteor_seconds = __( 'seconds', 'meteor-slides' );
		$meteor_options = get_option( 'meteorslides_options' );

		echo "<input id='transition_speed' name='meteorslides_options[transition_speed]' size='20' type='text' value='{$meteor_options['transition_speed']}' /> $meteor_seconds";

	}
		
	function meteorslides_slide_duration() {

		$meteor_seconds = __( 'seconds', 'meteor-slides' );
		$meteor_options = get_option( 'meteorslides_options' );

		echo "<input id='slide_duration' name='meteorslides_options[slide_duration]' size='20' type='text' value='{$meteor_options['slide_duration']}' /> $meteor_seconds";

	}
		
	function  meteorslides_slideshow_navigation() {
		
		$meteor_navnone     = __( 'None', 'meteor-slides' );
		$meteor_navprevnext = __( 'Previous/Next', 'meteor-slides' );
		$meteor_navpaged    = __( 'Paged', 'meteor-slides' );
		$meteor_navboth     = __( 'Both', 'meteor-slides' );
			
		$meteor_options = get_option( 'meteorslides_options' );
		
		$meteor_item = array(
			
			'navnone'     => $meteor_navnone,
			'navprevnext' => $meteor_navprevnext,
			'navpaged'    => $meteor_navpaged,
			'navboth'     => $meteor_navboth
				
		);
		
		echo "<select id='slideshow_navigation' name='meteorslides_options[slideshow_navigation]' style='width:142px;'>";
		
		while ( list( $meteor_key, $meteor_val ) = each( $meteor_item ) ) {
	
			$meteor_selected = ( $meteor_options['slideshow_navigation']==$meteor_key ) ? ' selected="selected"' : '';
		
			echo "<option value='$meteor_key'$meteor_selected>$meteor_val</option>";
	
		}
		
		echo "</select>";
		
	}

?>

<div class="wrap">
	
	<div id="icon-edit" class="icon32"><br /></div>
	
	<h2><?php _e( 'Meteor Slides Settings', 'meteor-slides' ); ?></h2>

	<form action="options.php" method="post">

		<?php // Adds options to settings page
				
		settings_fields( 'meteorslides_options' );
				
		do_settings_sections( 'meteorslides' );

		?>
		
		<p class="submit">

			<input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'meteor-slides' ) ?>" />
		
		</p>
				
	</form>
	
	<h3><?php _e( 'Add Slideshow', 'meteor-slides' ); ?></h3>
	
	<p><?php printf( __ ( 'Use %1$s to add this slideshow to your theme, use %2$s to add it to your Post or Page content, or use the Meteor Slides Widget.', 'meteor-slides'), "<code><&#63;php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } &#63;></code>", "<code>[meteor_slideshow]</code>" )?></p>
	
	<p><?php printf( __ ( 'Visit the %1$sMeteor Slides homepage%2$s for documentation, tutorials, and videos.', 'meteor-slides' ), "<a href='http://www.jleuze.com/plugins/meteor-slides/'>", "</a>" )?></p>
	
	<p><em><?php printf( __ ( 'Please %1$spost any questions or problems%2$s in the WordPress.org support forums.', 'meteor-slides' ), "<a href='http://wordpress.org/tags/meteor-slides?forum_id=10#postform'>", "</a>" )?></em></p>
	
</div><!-- .wrap -->