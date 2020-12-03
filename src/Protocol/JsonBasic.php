<?php

namespace App\Protocol;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class JsonBasic extends JsonResponse {

	/**
	 * Contructor.
	 * 
	 * @param string $data
	 * @param int    $status
	 * @param bool   $success
	 */
    function __construct( $data, $status, $success ) {
        parent::__construct( array(
			'data'    => $data,
			'code'    => $status,
			'success' => $success,
		), $status );
    }
}
