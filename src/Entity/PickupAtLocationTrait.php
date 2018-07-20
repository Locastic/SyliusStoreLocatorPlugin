<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

trait PickupAtLocationTrait
{
    protected $pickupAtLocation;

    public function __construct()
    {
        $this->pickupAtLocation = false;
    }

    public function isPickupAtLocation(): ?bool
    {
        return $this->pickupAtLocation;
    }

    public function setPickupAtLocation(bool $pickupAtLocation): void
    {
        $this->pickupAtLocation = $pickupAtLocation;
    }
}
