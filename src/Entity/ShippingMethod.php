<?php
namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Core\Model\ShippingMethod as BaseShippingMethod;
use Sylius\Component\Shipping\Model\ShippingMethodTranslationInterface;

/**
 * Class ShippingMethod
 * @package Locastic\SyliusStoreLocatorPlugin\Entity
 */
class ShippingMethod extends BaseShippingMethod
{
    /**
     * @var bool
     */
    private $pickupAtLocation;

    public function __construct()
    {
        parent::__construct();
        $this->pickupAtLocation = false;
    }

    /**
     * @return bool|null
     */
    public function isPickupAtLocation(): ?bool
    {
        return $this->pickupAtLocation;
    }

    /**
     * @param bool $pickupAtLocation
     */
    public function setPickupAtLocation(bool $pickupAtLocation): void
    {
        $this->pickupAtLocation = $pickupAtLocation;
    }

    protected function createTranslation(): ShippingMethodTranslationInterface
    {
        return parent::createTranslation();
    }
}