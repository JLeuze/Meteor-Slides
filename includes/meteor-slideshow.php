<?php
/*  Loop template for the Meteor Slides 1.5 slideshow
	
	Copy "meteor-slideshow.php" from "/meteor-slides/" to your theme's directory to replace
	the plugin's default slideshow loop.
	
	Learn more about customizing the slideshow template for Meteor Slides: 
	http://www.jleuze.com/plugins/meteor-slides/customizing-the-slideshow-template/
*/

	// Settings for slideshow loop

	global $post;
	
	$meteor_posttemp = $post;
	$meteor_options  = get_option( 'meteorslides_options' );
	$meteor_nav      = $meteor_options['slideshow_navigation'];
	$meteor_count    = 1;
	$meteor_loop     = new WP_Query( array(
	
		'post_type'      => 'slide',
		'slideshow'      => $slideshow,
		'posts_per_page' => $meteor_options['slideshow_quantity']
		
	) ); ?>
	
	<?php // Check for slides
	
	if ( $meteor_loop->have_posts() ) : ?>
	
	<div id="meteor-slideshow<?php echo $slideshow; ?>" class="meteor-slides <?php
	
		// Adds classes to slideshow
	
		echo $slideshow . ' ' . $meteor_nav;
		
		// Adds metadata to slideshow
		
		if ( !empty( $metadata ) || !empty( $slideshow ) ) {
			
			echo ' { ';
				
		}
		
		if ( !empty( $slideshow ) ) {
			
			echo "next: '#meteor-next" . $slideshow . "', prev: '#meteor-prev" . $slideshow . "', pager: '#meteor-buttons" . $slideshow . "'";
				
		}
				
		if ( !empty( $metadata ) && !empty( $slideshow ) ) {
			
			echo ', ';
				
		}
			
		echo $metadata;
		
		if ( !empty( $metadata ) || !empty( $slideshow ) ) {
			
			echo ' }';
				
		}
			
	?>">
	
	<?php // Check for multiple slides
	
	if ( $meteor_loop->post_count > 1 ) : ?>
		
		<?php // Adds Previous/Next and Paged navigation
		
		if ( $meteor_nav == "navboth" ) : ?>
	
			<ul class="meteor-nav">
		
				<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>
			
				<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>
			
			</ul><!-- .meteor-nav -->
		
			<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>
		
		<?php // Adds Previous/Next navigation
		
		elseif ( $meteor_nav == "navprevnext" ) : ?>
	
			<ul class="meteor-nav">
		
				<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>
			
				<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>
			
			</ul><!-- .meteor-nav -->
		
		<?php // Adds Paged navigation
		
		elseif ( $meteor_nav == "navpaged" ): ?>
	
			<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>
			
		<?php endif; ?>
		
	<?php endif; ?>
		
		<div class="meteor-clip">
	
		<?php // Loop which loads the slideshow
			
		while ( $meteor_loop->have_posts() ) : $meteor_loop->the_post(); ?>
		
			<?php // Use first slide image as shim to scale slideshow
			
			if ( $meteor_count == 1 ) {
			
				$meteor_shim = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-slide');
				
				echo '<img style="visibility: hidden;" class="meteor-shim" src="' . $meteor_shim[0] . '" alt="" />';
				
			} ?>

			<div class="mslide mslide-<?php echo $meteor_count; ?>">
				
				<?php // Adds slide image with Slide URL link
					
				if ( get_post_meta( $post->ID, "slide_url_value", $single = true ) != "" ): ?>
						
					<a href="<?php echo get_post_meta( $post->ID, "slide_url_value", $single = true ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured-slide', array( 'title' => get_the_title() ) ); ?></a>
			
				<?php // Adds slide image without Slide URL link
					
				else: ?>
					
					<?php the_post_thumbnail( 'featured-slide', array( 'title' => get_the_title() ) ); ?>
					
				<?php endif; ?>
			
			</div><!-- .mslide -->
			
			<?php $meteor_count++; ?>
			
		<?php endwhile; ?>
		
		</div><!-- .meteor-clip -->
				
		<?php // Reset the slideshow loop
		
		$post = $meteor_posttemp;
		
		wp_reset_postdata(); ?>
			
	</div><!-- .meteor-slides -->
	
	<?php endif; ?>