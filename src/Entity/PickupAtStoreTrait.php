<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

trait PickupAtStoreTrait
{
    protected $store;

    public function getStore(): ?StoreInterface
    {
        return $this->store;
    }

    public function setStore(?StoreInterface $store): void
    {
        $this->store = $store;
    }
}
