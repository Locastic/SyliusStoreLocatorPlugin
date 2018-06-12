<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\Shipment as BaseShipment;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Shipment extends BaseShipment implements PickupAtStoreInterface
{
    use PickupAtStoreTrait;
}