<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Shipping\Model\Shipment as BaseShipment;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Shipment
 * @package Locastic\SyliusStoreLocatorPlugin\Entity
 */
class Shipment extends BaseShipment implements PickupAtStoreInterface
{
    use PickupAtStoreTrait;

    /**
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (is_null($this->getStore()) && $this->getMethod()->isPickupAtLocation()) {

            $context
                ->buildViolation('You must select a store')
                ->atPath('method')
                ->addViolation();
        }
    }
}