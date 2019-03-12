<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Locastic\SyliusStoreLocatorPlugin\Fixture\ShippingMethodFactory;
use Locastic\SyliusStoreLocatorPlugin\Fixture\StoreFactory;
use Locastic\SyliusStoreLocatorPlugin\Repository\StoreRepository;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;


final class ShippingContext implements Context
{
    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var ShippingMethodFactory
     */
    private $shippingMethodFactory;

    /**
     * @var StoreFactory
     */
    private $storeFactory;

    /**
     * @var ShippingMethodRepositoryInterface
     */
    private $shippingMethodRepository;

    /**
     * ShippingContext constructor.
     * @param StoreRepository $storeRepository
     * @param SharedStorageInterface $sharedStorage
     * @param ShippingMethodFactory $shippingMethodExampleFactory
     * @param StoreFactory $storeFactory
     * @param ShippingMethodRepositoryInterface $shippingMethodRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        SharedStorageInterface $sharedStorage,
        ShippingMethodFactory $shippingMethodExampleFactory,
        StoreFactory $storeFactory,
        ShippingMethodRepositoryInterface $shippingMethodRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->sharedStorage = $sharedStorage;
        $this->shippingMethodFactory = $shippingMethodExampleFactory;
        $this->storeFactory = $storeFactory;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }


    /**
     * @Given /^the store has "([^"]*)" store location$/
     */
    public function theStoreHasStoreLocation($storeName)
    {
        $this->saveStore($this->storeFactory->create(
            [
                'latitude' => 43.5129188,
                'longitude' => 16.48521519999997,
                'address' => "Lovački put 7, 21000, Split, Croatia",
                'contact_phone' => '+38521782059',
                'contact_email' => 'info@locastic.com',
                'pickup_at_store_available' => true,
                'code' => StringInflector::nameToCode(strtolower($storeName)),
                'translations' => [
                    'en_US' => [
                        'name' => $storeName,
                        'slug' => StringInflector::nameToCode(strtolower($storeName)),
                        'meta_title' => $storeName,
                        'meta_description' => $storeName,
                        'meta_keywords' => $storeName,
                        'content' => $storeName,
                        'opening_hours' => 'Mon-Fri 09-17h',
                    ],
                ],
                'images' => []
            ]
        ));
    }

    /**
     * @Given /^the store has "([^"]+)" shipping method with enabled store pickup and ("[^"]+") fee$/
     */
    public function storeHasShippingMethodWithFeeAndPickupAtStore($shippingMethodName, $fee)
    {
        $channel = $this->sharedStorage->get('channel');
        $configuration = $this->getConfigurationByChannels([$channel], $fee);

        $this->saveShippingMethod(
            $this->shippingMethodFactory->create(
                [
                    'name' => $shippingMethodName,
                    'enabled' => true,
                    'is_pickup_at_store' => true,
                    'zone' => $this->getShippingZone(),
                    'calculator' => [
                        'type' => DefaultCalculators::FLAT_RATE,
                        'configuration' => $configuration,
                    ],
                    'channels' => [$this->sharedStorage->get('channel')],
                ]
            )
        );
    }

    /**
     * @param StoreInterface $store
     */
    private function saveStore(StoreInterface $store)
    {
        $this->storeRepository->add($store);
        $this->sharedStorage->set('store', $store);
    }

    /**
     * @return ZoneInterface
     */
    private function getShippingZone()
    {
        if ($this->sharedStorage->has('shipping_zone')) {
            return $this->sharedStorage->get('shipping_zone');
        }

        return $this->sharedStorage->get('zone');
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     */
    private function saveShippingMethod(ShippingMethodInterface $shippingMethod)
    {
        $this->shippingMethodRepository->add($shippingMethod);
        $this->sharedStorage->set('shipping_method', $shippingMethod);

    }

    /**
     * @param array $channels
     * @param int $amount
     *
     * @return array
     */
    private function getConfigurationByChannels(array $channels, $amount = 0)
    {
        $configuration = [];

        /** @var ChannelInterface $channel */
        foreach ($channels as $channel) {
            $configuration[$channel->getCode()] = ['amount' => $amount];
        }

        return $configuration;
    }

}