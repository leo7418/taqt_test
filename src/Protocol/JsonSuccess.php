<?php

namespace App\Protocol;

class JsonSuccess extends JsonBasic {

	/**
	 * Contructor.
	 * 
	 * @param string $data
	 * @param int    $status
	 */
    function __construct( $data, $status ) {
        parent::__construct( $data, $status, true );
    }
}
