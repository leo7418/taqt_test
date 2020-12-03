<?php

namespace App\EventSubscriber;

use App\Protocol\JsonError;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
			KernelEvents::EXCEPTION => array( array( 'onKernelException', 0 ) ),
        );
    }

    public function onKernelException(ExceptionEvent $event)
    {
		$exception = $event->getThrowable();
		$status    = $exception->getCode();

		$event->setResponse( new JsonError( $exception->getMessage(), 0 !== $status ? $status : 400 ) );
	}
}
