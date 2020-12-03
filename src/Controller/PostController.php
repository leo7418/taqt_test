<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Protocol\JsonMissingParameter;
use App\Protocol\JsonNotFound;
use App\Protocol\JsonSuccess;
use DateTime;

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
	 * Transform the given post as array.
	 *
	 * @param  Post $post
	 * @return array
	 */
	private function transformPost( $post ) {
		return array(
			'id'         => $post->getId(),
			'created_at' => $post->getCreatedAt(),
			'updated_at' => $post->getUpdatedAt(),
			'name'       => $post->getName(),
			'content'    => $post->getContent(),
		);
	}

	/**
	 * Create or update a post
	 *
	 * @param Post $post
	 */
	private function updatePost( $post ) {
		if ( ! $post->getId() ) {
			$post->setCreatedAt( new DateTime() );
		}
		$post->setUpdatedAt( new DateTime() );

		$manager = $this->getDoctrine()->getManager();
		$manager->persist( $post );
		$manager->flush();
	}

	/**
	 * @Route("/posts", methods="GET")
     * @return JsonResponse
	 */
	public function getPosts() {
		$posts = $this->getDoctrine()
			->getRepository( Post::class )
			->findAll();

		return new JsonSuccess( array_map( array( $this, 'transformPost' ), $posts ), 200 );
	}

	/**
	 * @Route("/posts/{id}", methods="GET")
     * @return JsonResponse
	 */
	public function getPost( $id ) {
		$post = $this->getDoctrine()
            ->getRepository( Post::class )
			->find( $id );

		if ( null === $post ) {
			return new JsonNotFound( $id );
		}
		return new JsonSuccess( $this->transformPost( $post ), 200 );
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

		$post = new Post();
		$post->setName( $name );
		$post->setContent( $content );

		$this->updatePost( $post );

		return new JsonSuccess( array( 'id' => $post->getId() ), 201 );
	}

	/**
	 * @Route("/posts/{id}", methods="PUT")
	 * @param Request $request
     * @return JsonResponse
	 */
	public function editPost( Request $request, $id ) {
		$post = $this->getDoctrine()
            ->getRepository( Post::class )
			->find( $id );

		if ( null === $post ) {
			return new JsonNotFound( $id );
		}

		$name    = $request->request->get('name');
		$content = $request->request->get('content');

		if ( null !== $name ) {
			$post->setName( $name );
		}
		if ( null !== $content ) {
			$post->setContent( $content );
		}
		if ( null !== $name || null !== $content ) {
			$this->updatePost( $post );
			return new JsonSuccess( array( 'id' => $post->getId() ), 200 );
		} else {
			return new JsonSuccess( array( 'id' => $post->getId() ), 304 );
		}
	}

	/**
	 * @Route("/posts/{id}", methods="DELETE")
     * @return JsonResponse
	 */
	public function deletePost( $id ) {
		$post = $this->getDoctrine()
            ->getRepository( Post::class )
			->find( $id );

		if ( null === $post ) {
			return new JsonNotFound( $id );
		}

		$manager = $this->getDoctrine()->getManager();
		$manager->remove( $post );
		$manager->flush();
		return new JsonSuccess( '', 200 );
	}
}
