<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController {

	/**
	 * Check parameters and throw an error if a parameter is missing.
	 */
	private function checkParameters( $parameters ) {
		foreach ( $parameters as $name => $value ) {
			if ( null === $value ) {
				throw new Exception( 'Missing parameter ' . $name );
			}
		}
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

		$this->checkParameters( array( 'name' => $name, 'content' => $content ) );

		return new JsonResponse( 'ok' );
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
