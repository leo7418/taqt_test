<?php

namespace App\Protocol;

class JsonNotFound extends JsonError {

	/**
	 * Contructor.
	 * 
	 * @param int $post_id
	 */
    function __construct( $post_id ) {
        parent::__construct( "Post '$post_id' not found", 404 );
    }
}
