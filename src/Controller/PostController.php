<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController {

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
