<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\ShippingMethod as BaseShippingMethod;
use Sylius\Component\Shipping\Model\ShippingMethodTranslationInterface;

class ShippingMethod extends BaseShippingMethod implements IsPickupAtStoreInterface
{
    use IsPickupAtStoreTrait;

    public function __construct()
    {
        parent::__construct();
        
        $this->pickupAtStore = false;
    }

    protected function createTranslation(): ShippingMethodTranslationInterface
    {
        return parent::createTranslation();
    }
}
