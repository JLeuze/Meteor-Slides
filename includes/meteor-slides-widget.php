<?php // Add slideshow widget
class meteorslides_widget extends WP_Widget {

	// Setup slideshow widget
	function __construct() {
		parent::__construct(
			'meteor-slides-widget', // Base ID
			__( 'Meteor Slides Widget', 'meteor-slides' ), // Name
			array( 'Add a slideshow widget to a sidebar' => __( 'A Foo Widget', 'meteor-slides' ), ) // Args
		);
	}

	// Load slideshow widget on frontend
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		// Get options from widget for meteor_slideshow function arguments
		$slideshow_arg = $instance['slideshow'];
		$metadata_arg  = $instance['metadata'];

		// Load slideshow
		meteor_slideshow( $slideshow=$slideshow_arg, $metadata=$metadata_arg );
		echo $args['after_widget'];
	}

	// Setup slideshow widget form for the widget admin
	public function form( $instance ) {
	
		// Set blank default values for the widget options
		$defaults = array(
			'title'     => '',
			'slideshow' => '',
			'metadata'  => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . __('Title:', 'meteor-slides') . '</label>
		<input type="text" class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" value="' . $instance['title'] . '" /></p>';
		
		// If the slideshow taxonomy has terms, create a select list of those terms
		$slideshow_terms       = get_terms( 'slideshow' );
		$slideshow_terms_count = count( $slideshow_terms );
		$slideshow_value       = $instance['slideshow'];
		
		if ( $slideshow_terms_count > 0 ) {
			echo '<p><label for="' . $this->get_field_id( 'slideshow' ) . '">' . __('Slideshow:', 'meteor-slides') . '</label>';
			echo '<select name="' . $this->get_field_name( 'slideshow' ) . '" id="' . $this->get_field_id( 'slideshow' ) . '" class="widefat">';
			echo '<option value="">All Slides</option>';
			
			foreach ( $slideshow_terms as $slideshow_terms ) {
				if ( $slideshow_terms->slug == $slideshow_value ) {
					echo '<option selected="selected" value="' . $slideshow_terms->slug . '">' . $slideshow_terms->name . '</option>';
				} else {
					echo '<option value="' . $slideshow_terms->slug . '">' . $slideshow_terms->name . '</option>';
				}
			}
				
			echo '</select>';	
		}
		echo '<p><label for="' . $this->get_field_id( 'metadata' ) . '">' . __('Metadata:', 'meteor-slides') . '</label>
		<input type="text" class="widefat" id="' . $this->get_field_id( 'metadata' ) . '" name="' . $this->get_field_name( 'metadata' ) . '" value="' . $instance['metadata'] . '" /></p>';
	}

	// Update widget form options when saved
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['slideshow'] = ( ! empty( $new_instance['slideshow'] ) ) ? strip_tags( $new_instance['slideshow'] ) : '';
		$instance['metadata']  = ( ! empty( $new_instance['metadata'] ) ) ? strip_tags( $new_instance['metadata'] ) : '';

		return $instance;
	}

}

// Register slideshow widget
function meteorslides_register_widget() {
	register_widget( 'meteorslides_widget' );
}
add_action( 'widgets_init', 'meteorslides_register_widget' );