<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\Shipment as BaseShipment;

class Shipment extends BaseShipment implements PickupAtStoreInterface
{
    use PickupAtStoreTrait;
}
