<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\ShippingMethodInterface as BaseShippingMethodInterface;

interface ShippingMethodInterface extends BaseShippingMethodInterface, IsPickupAtStoreInterface
{

}