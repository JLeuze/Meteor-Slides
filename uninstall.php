<?php

	// If uninstall not called from WordPress exit

	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	
		exit();
	
	}
	
	// Delete settings page options from options table
	
	delete_option( 'meteorslides_options' );
	
?>