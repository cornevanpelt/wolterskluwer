<?php

namespace App\EventSubscriber;

use App\Event\OrderStatusEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderStatusSubscriber implements EventSubscriberInterface
{
    public function onOrderStatusUpdated(OrderStatusEvent $event)
    {
        // TODO: Check update medium preference of the user attached to this order
        $order = $event->getOrder();

        die;
    }

    public static function getSubscribedEvents()
    {
        return [
            OrderStatusEvent::NAME => 'onOrderStatusUpdated'
        ];
    }
}
