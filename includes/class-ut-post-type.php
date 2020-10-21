<?php
/**
 * Register post types here
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class UT_Post_Type
 */
class UT_Post_Type {

	/**
	 * Constructor of UT_Post_Type
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_book_post_type' ) );
	}

	/**
	 * Reguster post called book
	 *
	 * @return void
	 */
	public function register_book_post_type() {
		$labels = array(
			'name'          => 'Books',
			'singular_name' => 'Book',
		);

		$args = array(
			'labels'  => $labels,
			'public'  => true,
			'rewrite' => array( 'slug' => 'book' ),
		);

		register_post_type( 'book', $args );
	}
}
