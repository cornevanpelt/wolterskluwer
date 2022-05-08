<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\OrderStatusEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderStatusSubscriber implements EventSubscriberInterface
{
    public function onOrderStatusUpdated(OrderStatusEvent $event)
    {
        $order = $event->getOrder();
        $user = $order->getUser();

        foreach ($user->getCommunicationPreference()->getValues() as $updateMedium) {
            echo "Send {$updateMedium->getName()} to {$user->getName()}\n";

            // TODO: Handle sending out an update for this order via the preferred update medium(s) (e.g. SMS and e-mail) to replace the echo above
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            OrderStatusEvent::NAME => 'onOrderStatusUpdated'
        ];
    }
}
