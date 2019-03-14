<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store;


interface StoreShowPageInterface
{
    public function hasStoreInformation($storeName);

    public function hasStoreImage();
}