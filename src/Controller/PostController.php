<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Protocol\JsonMissingParameter;
use App\Protocol\JsonSuccess;

class PostController extends AbstractController {

	/**
	 * Check parameters and throw an error if a parameter is missing.
	 * 
	 * @return true|string Return the name of the missing parameter or true if nothing is missing.
	 */
	private function checkParameters( $parameters ) {
		foreach ( $parameters as $name => $value ) {
			if ( null === $value ) {
				return $name;
			}
		}
		return true;
	}

	/**
	 * @Route("/posts", methods="GET")
     * @return JsonResponse
	 */
	public function getPosts() {
	}

	/**
	 * @Route("/posts/{id}", methods="GET")
     * @return JsonResponse
	 */
	public function getPost( $id ) {
	}

	/**
	 * @Route("/posts", methods="POST")
	 * @param Request $request
     * @return JsonResponse
	 */
	public function createPost( Request $request ) {
		$name    = $request->request->get('name');
		$content = $request->request->get('content'); 

		$missing = $this->checkParameters( array( 'name' => $name, 'content' => $content ) );
		if ( true !== $missing ) {
			return new JsonMissingParameter( $missing );
		}

		return new JsonSuccess( array( 'id' => 0 ), 200 );
	}

	/**
	 * @Route("/posts/{id}", methods="PUT")
	 * @param Request $request
     * @return JsonResponse
	 */
	public function editPost( Request $request, $id ) {
	}

	/**
	 * @Route("/posts/{id}", methods="DELETE")
     * @return JsonResponse
	 */
	public function deletePost( $id ) {
	}
}
