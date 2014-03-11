<?php
/*
Plugin Name: Custom Metaboxes and Fields Wizard Demo
Plugin URI: http://wordimpress.com
Description: Example plugin for creating a wizard-like walk-through form with CMB
Author: Devin Walker
Version: 1.0
Requires at least: 3.8.1
Author URI: http://imdev.in
*/

/**
 * Include all necessary files
 */
//metaboxes
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/metaboxes.php' ) ) {
	require_once( 'lib/metaboxes.php' );
}
//CPTs
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-post-types.php' ) ) {
	require_once( 'lib/custom-post-types.php' );
}


/**
 * Admin Enqueue Scripts
 *
 * Only enqueue scripts for the CPT we have setup as to not unnecessarily slow down the admin panel.
 *
 * @todo: Update the following function to output script for your specific implementation
 */
add_action( 'admin_enqueue_scripts', 'cmb_example_enqueue' );
function cmb_example_enqueue( $hook ) {
	global $post;
	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
		if ( 'movies' === $post->post_type ) {
			wp_enqueue_style( 'cmb_wizard_css', plugin_dir_url( __FILE__ ) . '/assets/css/cmb-wizard.css' );
			wp_enqueue_script( 'cmb_wizard_easing', plugin_dir_url( __FILE__ ) . '/assets/js/jquery.easing.1.3.js', array( 'jquery' ) );
			wp_enqueue_script( 'cmb_wizard_js', plugin_dir_url( __FILE__ ) . '/assets/js/cmb-wizard.js', array( 'jquery' ) );
		}
	}
}
