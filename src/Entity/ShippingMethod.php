<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\ShippingMethod as BaseShippingMethod;
use Sylius\Component\Shipping\Model\ShippingMethodTranslationInterface;

class ShippingMethod extends BaseShippingMethod implements PickupAtLocationInterface
{
    use PickupAtLocationTrait;

    protected function createTranslation(): ShippingMethodTranslationInterface
    {
        return parent::createTranslation();
    }
}
