<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionHandler implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
			KernelEvents::REQUEST   => 'onPageNotFound',
			KernelEvents::EXCEPTION => 'onKernelException',
        );
    }
	
	public function onPageNotFound(ExceptionEvent $event) {
		return new JsonResponse( 'Not found' );
	}

    public function onKernelException(ExceptionEvent $event)
    {
//        $exception = $event->getThrowable();
//		$event->setResponse(new HttpError($exception->getStatusCode()));

		$event->setResponse(new JsonResponse( "ERROR" ));
	}
}
