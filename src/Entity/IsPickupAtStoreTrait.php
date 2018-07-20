<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

trait IsPickupAtStoreTrait
{
    protected $pickupAtStore;

    public function isPickupAtStore(): ?bool
    {
        return $this->pickupAtStore;
    }

    public function setPickupAtStore(bool $pickupAtStore): void
    {
        $this->pickupAtStore = $pickupAtStore;
    }
}
