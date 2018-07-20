<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

interface PickupAtStoreInterface
{
    public function getStore(): ?StoreInterface;

    public function setStore(?StoreInterface $store): void;
}
