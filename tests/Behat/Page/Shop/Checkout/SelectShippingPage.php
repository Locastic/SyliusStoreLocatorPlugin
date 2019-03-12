<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Checkout;

use Behat\Mink\Element\NodeElement;
use \Sylius\Behat\Page\Shop\Checkout\SelectShippingPage as BaseSelectShippingPage;

class SelectShippingPage extends BaseSelectShippingPage implements SelectShippingPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function hasStoreSelector($storeName)
    {
        $inputs = $this->getSession()->getPage()->findAll('css', '.store-select .dropdown option');

        $stores = [];
        foreach ($inputs as $input) {
            $stores[] = trim($input->getText());
        }

        return in_array($storeName, $stores);
    }

    /**
     * {@inheritdoc}
     */
    public function selectStore($storeName)
    {
        $storeOptionElement = $this->getElement('store_option', ['%store%' => $storeName]);
        $storeOptionValue = $storeOptionElement->getAttribute('value');

        $this->getElement('store_select')->selectOption($storeOptionValue);
    }

    /**
     * {@inheritdoc}
     */
    public function getSelectedStoreName()
    {
        $storeNames = $this->getSession()->getPage()->findAll('css', '.store-select .dropdown option');

        dump($storeNames);
        /** @var NodeElement $storeName */
        foreach ($storeNames as $storeName) {
            if (null !== $storeName->find('css', ':selected')) {
                return $storeName->getText();
            }
        }

        return null;
    }


    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(
            parent::getDefinedElements(),
            [
                'store_select_outer' => '.store-select',
                'store_select' => '.store-select .dropdown',
                'store_option' => '.store-select .dropdown option:contains("%store%")',
            ]
        );
    }
}