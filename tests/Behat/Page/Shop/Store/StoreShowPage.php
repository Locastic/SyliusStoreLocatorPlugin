<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store;

use Sylius\Behat\Page\SymfonyPage;

class StoreShowPage extends SymfonyPage implements StoreShowPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'locastic_sylius_store_locator_plugin_shop_store_show';
    }

    public function hasStoreInformation($storeName)
    {
        $hasStoreInfo = true;

        $titleElement = $this->getSession()->getPage()->find('css', 'h1.header');

        if ($titleElement->getText() !== $storeName) {
            $hasStoreInfo = false;
        }

        $infoElements = $this->getSession()->getPage()->findAll('css', '#store-location p');

        $requiredItemProps = ["address", "email", "telephone", "hours"];
        $existingItemProps = [];
        foreach ($infoElements as $infoElement) {
            $existingItemProps[] = $infoElement->getAttribute('itemprop');
        }

        $missingItemProps = array_diff($requiredItemProps, $existingItemProps);
        if (!empty($missingItemProps)) {
            $hasStoreInfo = false;
        }

        $descriptionElements = $this->getSession()->getPage()->findAll('css', '#store-location div');
        $existingItemProps = [];
        foreach ($descriptionElements as $descriptionElement) {
            $existingItemProps[] = $descriptionElement->getAttribute('itemprop');
        }

        if (!in_array('description', $existingItemProps)) {
            $hasStoreInfo = false;
        }

        return $hasStoreInfo;

    }

    public function hasStoreImage()
    {
        $imgElement = $this->getSession()->getPage()->find('css', 'img.dimmable');

        return $imgElement !== null;
    }
}