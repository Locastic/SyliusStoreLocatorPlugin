<?php

namespace Locastic\SyliusStoreLocatorPlugin\Entity;


interface PickupAtLocationInterface
{
    public function isPickupAtLocation(): ?bool;

    public function setPickupAtLocation(bool $pickupAtLocation): void;

}