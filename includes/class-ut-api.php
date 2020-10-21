<?php
/**
 * Register all API endpoints here
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class UT_API
 */
class UT_API {

	/**
	 * Constructor of UT_API
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'api_init' ) );
	}

	/**
	 * Starting point of endpoint
	 */
	public function api_init() {
		$this->post( '/user-meta', array( $this, 'save_user_meta' ), $this->save_user_meta_args() );
	}

	/**
	 * Helper for create route
	 *
	 * @param string   $path route path.
	 * @param string   $method route HTTP verb.
	 * @param callable $callback route callback.
	 */
	private function route( $path, $method, $callback, $args = array() ) {
		register_rest_route(
			'ut/v1',
			$path,
			array(
				'methods'             => $method,
				'callback'            => $callback,
				'permission_callback' => '__return_true',
				'args'                => $args,
			)
		);
	}

	/**
	 * Store user meta
	 *
	 * @param WP_REST_Request $request everything about request.
	 */
	public function save_user_meta( WP_REST_Request $request ) {
		$user_id = $request->get_param( 'user_id' );

		$data = array(
			'phone'   => $request->get_param( 'phone' ),
			'city'    => $request->get_param( 'city' ),
			'country' => $request->get_param( 'country' ),
		);

		$result = ut_set_user_information( $user_id, $data );

		$info = ut_get_user_information( $user_id );

		// Create the response object.
		$response = new WP_REST_Response( $info );

		// Add status code.
		$response->set_status( 201 );

		return $response;
	}

	/**
	 * REgister post request endpoint
	 *
	 * @param string   $path route path.
	 * @param callable $callback route callback.
	 * @param array    $args Route parameters information.
	 *
	 * @return void
	 */
	private function post( $path, $callback, $args = array() ) {
		$this->route( $path, 'POST', $callback, $args );
	}

	/**
	 * Request arguments
	 *
	 * @return array
	 */
	private function save_user_meta_args() {
		return array(
			'phone'   => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'city'    => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'country' => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			),
		);
	}

}
