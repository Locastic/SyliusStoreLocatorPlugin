<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Checkout;

use Sylius\Behat\Page\Shop\Checkout\SelectShippingPageInterface as BaseSelectShippingPageInterface;

interface SelectShippingPageInterface extends BaseSelectShippingPageInterface
{
    public function hasStoreSelector($storeName);

    public function selectStore($storeName);

    public function getSelectedStoreName();
}