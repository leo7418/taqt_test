<?php

namespace App\Protocol;

class JsonError extends JsonBasic {

	/**
	 * Contructor.
	 * 
	 * @param string $data
	 * @param int    $status
	 */
    function __construct( $data, $status ) {
        parent::__construct( $data, $status, false );
    }
}
