<?php
/**
 * Test user information
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class Ajax_Request_Test
 */
class Ajax_Request_Test extends WP_Ajax_UnitTestCase {

	/**
	 * Create a post by ajax
	 *
	 * @return void
	 */
	public function test_create_post_by_ajax() {
		$_POST['_wpnonce']     = wp_create_nonce( 'ut_create_book_post' );
		$_POST['post_title']   = 'This is post title';
		$_POST['post_content'] = 'This is post content';

		try {
			$this->_handleAjax( 'ut_create_book_post' );
		} catch ( Exception $e ) {
			// We expected this, do nothing.
		}

		$response = json_decode( $this->_last_response );

		$post = get_post( $response->data->post_id );

		$this->assertEquals( 'WP_Post', get_class( $post ) );
		$this->assertEquals( $_POST['post_title'], $post->post_title );
	}

	/**
	 * Show error if title not set
	 *
	 * @return void
	 */
	public function test_show_error_for_title() {
		$_POST['_wpnonce']     = wp_create_nonce( 'ut_create_book_post' );
		$_POST['post_content'] = 'This is post content';

		$this->check_validation();
	}

	/**
	 * Show error if content not set
	 *
	 * @return void
	 */
	public function test_show_error_for_content() {
		$_POST['_wpnonce']   = wp_create_nonce( 'ut_create_book_post' );
		$_POST['post_title'] = 'This is post content';

		$this->check_validation();
	}

	/**
	 * Check validation
	 */
	private function check_validation() {
		try {
			$this->_handleAjax( 'ut_create_book_post' );
		} catch ( Exception $e ) {
			// We expected this, do nothing.
		}

		$response = json_decode( $this->_last_response );

		$this->assertEquals( 422, $response->data->code );
		$this->assertNotEmpty( $response->data->message );
	}

}
