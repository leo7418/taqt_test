<?php

namespace App\Protocol;

class JsonMissingParameter extends JsonError {

	/**
	 * Contructor.
	 * 
	 * @param string $parameter_name
	 */
    function __construct( $parameter_name ) {
        parent::__construct( "Missing parameter '$parameter_name'", 400 );
    }
}
