<?php
/*  Loop template for the Meteor Slides slideshow
	
	Copy "meteor-slideshow.php" from "/meteor-slides/" to your theme's directory to replace
	the plugin's default slideshow loop.
	
	Learn more about customizing the slideshow template for Meteor Slides: 
	http://www.jleuze.com/plugins/meteor-slides/customizing-the-slideshow-template/
*/

	// Settings for slideshow loop

	global $post;
	
	$options = get_option( 'meteorslides_options' );
	
	$meteornav = $options['slideshow_navigation'];
	
	$i = 1;
	
	$loop = new WP_Query( array(
	
		'post_type'      => 'slide',
		'slideshow'      => $slideshow,
		'posts_per_page' => $options['slideshow_quantity']
		
	) ); ?>
	
	<div id="meteor-slideshow<?php echo $slideshow; ?>" class="meteor-slides <?php
	
		// Adds classes to slideshow
	
		echo $slideshow . ' ' . $meteornav;
		
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
		
		<?php // Adds Previous/Next and Paged navigation
		
		if ( $meteornav == "navboth" ) : ?>
	
			<ul class="meteor-nav">
		
				<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>
			
				<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>
			
			</ul><!-- .meteor-nav -->
		
			<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>
		
		<?php // Adds Previous/Next navigation
		
		elseif ( $meteornav == "navprevnext" ) : ?>
	
			<ul class="meteor-nav">
		
				<li id="meteor-prev<?php echo $slideshow; ?>" class="prev"><a href="#prev"><?php _e( 'Previous', 'meteor-slides' ) ?></a></li>
			
				<li id="meteor-next<?php echo $slideshow; ?>" class="next"><a href="#next"><?php _e( 'Next', 'meteor-slides' ) ?></a></li>
			
			</ul><!-- .meteor-nav -->
		
		<?php // Adds Paged navigation
		
		elseif ( $meteornav == "navpaged" ): ?>
	
			<div id="meteor-buttons<?php echo $slideshow; ?>" class="meteor-buttons"></div>
			
		<?php endif; ?>
	
		<?php // Loop which loads the slideshow
			
		while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<div class="mslide mslide-<?php echo $i; ?>">
				
				<?php // Adds slide image with Slide URL link
					
				if ( get_post_meta( $post->ID, "slide_url_value", $single = true ) != "" ): ?>
						
					<a href="<?php echo get_post_meta( $post->ID, "slide_url_value", $single = true ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured-slide' ); ?></a>
			
				<?php // Adds slide image without Slide URL link
					
				else: ?>
					
					<?php the_post_thumbnail( 'featured-slide' ); ?>
					
				<?php endif; ?>
			
			</div><!-- .mslide -->
			
			<?php $i++; ?>
			
		<?php endwhile; ?>
				
		<?php wp_reset_query(); ?>
			
	</div><!-- .meteor-slides -->