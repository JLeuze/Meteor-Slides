<?php

	// Populate the sections and settings of the options page
		
	function meteorslides_section_text() {
	
		echo "<p>". __( 'Set up your slideshow using the options below.', 'meteor-slides' ) ."</p>";

	}
	
	function slideshow_quantity() {
		
		$slides = __( 'slides', 'meteor-slides' );
		
		$options = get_option('meteorslides_options');
			
		echo "<input id='slideshow_quantity' name='meteorslides_options[slideshow_quantity]' size='20' type='text' value='{$options['slideshow_quantity']}' /> $slides";

	}
	
	function slide_height() {
		
		$px = __( 'px', 'meteor-slides' );
		
		$options = get_option('meteorslides_options');

		echo "<input id='slide_height' name='meteorslides_options[slide_height]' size='20' type='text' value='{$options['slide_height']}' /> $px";

	}
		
	function slide_width() {
		
		$px = __( 'px', 'meteor-slides' );
		
		$options = get_option('meteorslides_options');

		echo "<input id='slide_width' name='meteorslides_options[slide_width]' size='20' type='text' value='{$options['slide_width']}' /> $px";

	}
	
	function transition_style() {
				
		$blindX      = __( 'blindX', 'meteor-slides' );
		$blindY      = __( 'blindY', 'meteor-slides' );
		$blindZ      = __( 'blindZ', 'meteor-slides' );
		$cover       = __( 'cover', 'meteor-slides' );
		$curtainX    = __( 'curtainX', 'meteor-slides' );
		$curtainY    = __( 'curtainY', 'meteor-slides' );
		$fade        = __( 'fade', 'meteor-slides' );
		$fadeZoom    = __( 'fadeZoom', 'meteor-slides' );
		$growX       = __( 'growX', 'meteor-slides' );
		$growY       = __( 'growY', 'meteor-slides' );
		$none        = __( 'none', 'meteor-slides' );
		$scrollUp    = __( 'scrollUp', 'meteor-slides' );
		$scrollDown  = __( 'scrollDown', 'meteor-slides' );
		$scrollLeft  = __( 'scrollLeft', 'meteor-slides' );
		$scrollRight = __( 'scrollRight', 'meteor-slides' );
		$scrollHorz  = __( 'scrollHorz', 'meteor-slides' );
		$scrollVert  = __( 'scrollVert', 'meteor-slides' );
		$slideX      = __( 'slideX', 'meteor-slides' );
		$slideY      = __( 'slideY', 'meteor-slides' );
		$shuffle     = __( 'shuffle', 'meteor-slides' );
		$turnUp      = __( 'turnUp', 'meteor-slides' );
		$turnDown    = __( 'turnDown', 'meteor-slides' );
		$turnLeft    = __( 'turnLeft', 'meteor-slides' );
		$turnRight   = __( 'turnRight', 'meteor-slides' );
		$uncover     = __( 'uncover', 'meteor-slides' );
		$wipe        = __( 'wipe', 'meteor-slides' );
		$zoom        = __( 'zoom', 'meteor-slides' );
		
		$options = get_option( 'meteorslides_options' );
		
		$item = array(
			
			'blindX'      => $blindX,
			'blindY'      => $blindY,
			'blindZ'      => $blindZ,
			'cover'       => $cover,
			'curtainX'    => $curtainX,
			'curtainY'    => $curtainY,
			'fade'        => $fade,
			'fadeZoom'    => $fadeZoom,
			'growX'       => $growX,
			'growY'       => $growY,
			'none'        => $none,
			'scrollUp'    => $scrollUp,
			'scrollDown'  => $scrollDown,
			'scrollLeft'  => $scrollLeft,
			'scrollRight' => $scrollRight,
			'scrollHorz'  => $scrollHorz,
			'scrollVert'  => $scrollVert,
			'slideX'      => $slideX,
			'slideY'      => $slideY,
			'shuffle'     => $shuffle,
			'turnUp'      => $turnUp,
			'turnDown'    => $turnDown,
			'turnLeft'    => $turnLeft,
			'turnRight'   => $turnRight,
			'uncover'     => $uncover,
			'wipe'        => $wipe,
			'zoom'        => $zoom
			
		);
		
		echo "<select id='transition_style' name='meteorslides_options[transition_style]' style='width:142px;'>";
		
		while ( list( $key, $val ) = each( $item ) ) {

			$selected = ( $options['transition_style']==$key ) ? ' selected="selected"' : '';
		
			echo "<option value='$key'$selected>$val</option>";
	
		}
		
		echo "</select>";
		
	}
		
	function transition_speed() {
		
		$seconds = __( 'seconds', 'meteor-slides' );
		
		$options = get_option( 'meteorslides_options' );

		echo "<input id='transition_speed' name='meteorslides_options[transition_speed]' size='20' type='text' value='{$options['transition_speed']}' /> $seconds";

	}
		
	function slide_duration() {

		$seconds = __( 'seconds', 'meteor-slides' );
		
		$options = get_option( 'meteorslides_options' );

		echo "<input id='slide_duration' name='meteorslides_options[slide_duration]' size='20' type='text' value='{$options['slide_duration']}' /> $seconds";

	}
		
	function  slideshow_navigation() {
		
		$navnone     = __( 'None', 'meteor-slides' );
		$navprevnext = __( 'Previous/Next', 'meteor-slides' );
		$navpaged    = __( 'Paged', 'meteor-slides' );
		$navboth     = __( 'Both', 'meteor-slides' );
			
		$options = get_option( 'meteorslides_options' );
		
		$item = array(
			
			'navnone'     => $navnone,
			'navprevnext' => $navprevnext,
			'navpaged'    => $navpaged,
			'navboth'     => $navboth
				
		);
		
		echo "<select id='slideshow_navigation' name='meteorslides_options[slideshow_navigation]' style='width:142px;'>";
		
		while ( list( $key, $val ) = each( $item ) ) {
	
			$selected = ( $options['slideshow_navigation']==$key ) ? ' selected="selected"' : '';
		
			echo "<option value='$key'$selected>$val</option>";
	
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