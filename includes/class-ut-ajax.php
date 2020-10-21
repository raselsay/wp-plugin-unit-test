<?php
/**
 * Register all ajax hooks here
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class UT_Ajax
 */
class UT_Ajax {

	/**
	 * Constructor of UT_Ajax
	 */
	public function __construct() {
		add_action( 'wp_ajax_ut_create_book_post', array( $this, 'create_book_post' ) );
	}

	/**
	 * Create book post
	 */
	public function create_book_post() {
		check_ajax_referer( 'ut_create_book_post' );

		if ( ! isset( $_POST['post_title'] ) ) {
			$this->send_error_message( 'Post title must not be empty', 422 );
		}

		if ( ! isset( $_POST['post_content'] ) ) {
			$this->send_error_message( 'Post content must not be empty', 422 );
		}

		$post = array(
			'post_title'   => sanitize_text_field( wp_unslash( $_POST['post_title'] ) ),
			'post_content' => sanitize_text_field( wp_unslash( $_POST['post_content'] ) ),
			'post_type'    => 'book',
		);

		$post_id  = wp_insert_post( $post );
		$response = array( 'post_id' => $post_id );

		wp_send_json_success( $response );
	}

	/**
	 * Send error message
	 *
	 * @param string  $message error message.
	 * @param integer $code status code.
	 *
	 * @return void
	 */
	private function send_error_message( $message, $code = null ) {
		$data = array(
			'message' => $message,
			'code'    => $code,
		);

		wp_send_json_error( $data, $code );
	}
}
