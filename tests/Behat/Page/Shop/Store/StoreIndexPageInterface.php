<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store;


interface StoreIndexPageInterface
{
    public function hasStoreMap();

    public function hasStorePreview($storeName);
}