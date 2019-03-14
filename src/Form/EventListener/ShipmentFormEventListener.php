<?php

namespace Locastic\SyliusStoreLocatorPlugin\Form\EventListener;

use Locastic\SyliusStoreLocatorPlugin\Entity\Shipment;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ShipmentFormEventListener implements EventSubscriberInterface
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        ];
    }


    public function onPostSubmit(FormEvent $event)
    {
        $shipment = $event->getData();
        $form = $event->getForm();

        if (!$shipment instanceof Shipment || !$form->isValid()) {
            return;
        }

        if ($shipment->getMethod()->isPickupAtStore() && $shipment->getStore() === null) {
            $form->addError(new FormError($this->message));
        }
    }
}