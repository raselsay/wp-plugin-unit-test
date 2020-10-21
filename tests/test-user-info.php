<?php
/**
 * Test user information
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Class User_Info_Test
 */
class User_Info_Test extends WP_UnitTestCase {

	private $user_id;

	public function setUp() {
		parent::setUp();

		$this->user_id = $this->factory->user->create();
	}

	/**
	 * Check user info is curectly set or not
	 *
	 * @return void
	 */
	public function test_user_all_info() {
		$data = array(
			'phone'   => '01630634726',
			'city'    => 'Dhaka',
			'country' => 'Bangladesh',
		);

		$result = ut_set_user_information( $this->user_id, $data );

		$this->assertTrue( $result );

		$info = ut_get_user_information( $this->user_id );

		$this->assertEquals( $data, $info );
	}

	/**
	 * Check user country set or not
	 *
	 * @return void
	 */
	public function test_user_info_country_is_not_set() {
		$data = array(
			'phone' => '01630634726',
			'city'  => 'Dhaka',
		);

		$result = ut_set_user_information( $this->user_id, $data );

		// If country is not set it must return false
		$this->assertFalse( $result );

		$info = ut_get_user_information( $this->user_id );

		$this->assertEmpty( $info['country'] );
		$this->assertEmpty( $info['phone'] );
		$this->assertEmpty( $info['city'] );
	}
}
