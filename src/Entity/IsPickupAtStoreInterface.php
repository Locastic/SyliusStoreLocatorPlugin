<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

interface IsPickupAtStoreInterface
{
    public function isPickupAtStore(): ?bool;

    public function setPickupAtStore(bool $pickupAtStore): void;
}
