<?php
/**
 * Test user information
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class User_Info_Test
 */
class User_Info_API_Test extends WP_UnitTestCase {

	/**
	 * Registered user ID
	 *
	 * @var int
	 */
	private $user_id;

	/**
	 * Set up these test cases
	 */
	public function setUp() {
		parent::setUp();

		$this->user_id = $this->factory->user->create();
	}

	/**
	 * Check user info store API working or not
	 *
	 * @return void
	 */
	public function test_store_user_info() {
		$data = array(
			'phone'   => '01630634726',
			'city'    => 'Dhaka',
			'country' => 'Bangladesh',
			'user_id' => $this->user_id,
		);

		$response = $this->request_with_params( '/ut/v1/user-meta', $data, 'POST' );

		$this->assertEquals( 201, $response->get_status() );

		unset( $data['user_id'] );

		$this->assertEqualSets( $data, $response->get_data() );
	}

	/**
	 * Perform a REST request to our endpoint with given parameters.
	 *
	 * @param string $path route path.
	 * @param array  $params route parameters.
	 * @param string $method route HTTP verb.
	 */
	private function request_with_params( $path, $params, $method ) {
		$request = $this->get_request( $path, $params, $method );

		return rest_get_server()->dispatch( $request );
	}

	/**
	 * Get a REST request object for given parameters.
	 *
	 * @param string $path route path.
	 * @param array  $params route parameters.
	 * @param string $method route HTTP verb.
	 */
	private function get_request( $path, $params, $method ) {
		$request = new WP_REST_Request( $method, $path );

		foreach ( $params as $param => $value ) {
			$request->set_param( $param, $value );
		}

		return $request;
	}

	/**
	 * Sets up the expectations for testing a deprecated call.
	 */
	public function expectDeprecated() {
		return true;
	}
}
