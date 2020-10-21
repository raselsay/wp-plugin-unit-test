<?php
/**
 * All necessary helper funciton will be here
 *
 * @package Wp_Plugin_Unit_Test
 */

/**
 * Set user necessary meta
 *
 * @param integer $user_id User ID.
 * @param array   $data with key phone, city, country.
 *
 * @return void
 */
function ut_set_user_information( $user_id, $data ) {

	if ( ! isset( $data['country'] ) ) {
		return false;
	}

	if ( isset( $data['phone'] ) ) {
		update_user_meta( $user_id, 'phone', $data['phone'] );
	}

	if ( isset( $data['city'] ) ) {
		update_user_meta( $user_id, 'city', $data['city'] );
	}

	update_user_meta( $user_id, 'country', $data['country'] );

	return true;
}

/**
 * Get user necessary meta
 *
 * @param integer $user_id User ID.
 *
 * @return array
 */
function ut_get_user_information( $user_id ) {
	$data = array(
		'phone'   => get_user_meta( $user_id, 'phone', true ),
		'city'    => get_user_meta( $user_id, 'city', true ),
		'country' => get_user_meta( $user_id, 'country', true ),
	);

	return $data;
}
