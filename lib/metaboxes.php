<?php
/**
 *  Metaboxes
 *
 * @description: Contains all Custom Metaboxes and Fields functions
 */

/**
 * Initialize the metabox class
 *
 * @see : https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Basic-Usage
 * @TODO: Determine if you want to use CMB; uncomment action to initialize
 */
add_action( 'init', 'wordimpress_initialize_cmb_meta_boxes', 9999 );
function wordimpress_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/cmb/init.php' );
	}
}

/**
 * Sample Metaboxes
 *
 * Adds a sample metabox with fields to the sample "Movies" post type
 *
 * @param $meta_boxes
 *
 * @return mixed
 * @TODO: If you elected to use CMB then you will need to uncomment the filter; otherwise, remove this function
 */
add_filter( 'cmb_meta_boxes', 'wordimpress_sample_metaboxes' );
function wordimpress_sample_metaboxes( $meta_boxes ) {
	$prefix                             = '_cmb_'; // Prefix for all fields
	$meta_boxes['cmb_wizard_metabox_1'] = array(
		'id'         => 'cmb_wizard_metabox_1',
		'title'      => 'Movie Information',
		'pages'      => array( 'movies' ), // post type
		'context'    => 'normal', //  'normal', 'advanced', or 'side'
		'priority'   => 'core', //  'high', 'core', 'default' or 'low'
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Director',
				'desc' => 'Who is the director of this movie?',
				'id'   => $prefix . 'director',
				'type' => 'text'
			),
			array(
				'name' => 'Lead Actor',
				'desc' => 'Who starred in this film?',
				'id'   => $prefix . 'lead_actor',
				'type' => 'text'
			),
			array(
				'name' => 'Total Budget',
				'desc' => 'How much did this movie cost?',
				'id'   => $prefix . 'movie_budget',
				'type' => 'text_money'
			),
		),
	);

	$meta_boxes['cmb_wizard_metabox_2'] = array(
		'id'         => 'cmb_wizard_metabox_2',
		'title'      => 'Additional Cast Members',
		'pages'      => array( 'movies' ), // post type
		'context'    => 'normal', //  'normal', 'advanced', or 'side'
		'priority'   => 'core', //  'high', 'core', 'default' or 'low'
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'       => __( 'Full Name', 'cmb' ),
				'desc'       => __( 'Enter the full name of this cast member', 'cmb' ),
				'id'         => $prefix . 'additional_cast',
				'type'       => 'text',
				'repeatable' => true,
			),
		),
	);
	$meta_boxes['cmb_wizard_metabox_3'] = array(
		'id'         => 'cmb_wizard_metabox_3',
		'title'      => 'Movie Review',
		'pages'      => array( 'movies' ), // post type
		'context'    => 'normal', //  'normal', 'advanced', or 'side'
		'priority'   => 'core', //  'high', 'core', 'default' or 'low'
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Movie Review',
				'desc'    => 'Write your review of this movie.',
				'id'      => $prefix . 'movie_review',
				'type'    => 'wysiwyg',
				'options' => array(),
			),
		),
	);
	$meta_boxes['cmb_wizard_metabox_4'] = array(
		'id'         => 'cmb_wizard_metabox_4',
		'title'      => 'Number of Stars',
		'pages'      => array( 'movies' ), // post type
		'context'    => 'normal', //  'normal', 'advanced', or 'side'
		'priority'   => 'core', //  'high', 'core', 'default' or 'low'
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Rating',
				'desc'    => 'How many stars do you rate this movie?',
				'id'      => $prefix . 'movie_rating',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => '1 Star', 'value' => '1' ),
					array( 'name' => '2 Stars', 'value' => '2' ),
					array( 'name' => '3 Stars', 'value' => '3' ),
					array( 'name' => '4 Stars', 'value' => '4' ),
					array( 'name' => '5 Stars', 'value' => '5' )
				)
			),
		),
	);

	return $meta_boxes;
}