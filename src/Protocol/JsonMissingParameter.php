<?php

namespace App\Protocol;

class JsonMissingParameter extends JsonError {

	/**
	 * Contructor.
	 * 
	 * @param string $data
	 * @param int    $status
	 */
    function __construct( $parameter_name ) {
        parent::__construct( "Missing parameter '$parameter_name'", 400 );
    }
}
