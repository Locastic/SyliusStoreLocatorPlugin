<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Locastic\SyliusStoreLocatorPlugin\Fixture\StoreFactory;
use Locastic\SyliusStoreLocatorPlugin\Repository\StoreRepository;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Formatter\StringInflector;

final class StoreContext implements Context
{
    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * @var StoreFactory
     */
    private $storeFactory;

    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * StoreContext constructor.
     * @param $storeRepository
     * @param $storeFactory
     * @param SharedStorageInterface $sharedStorage
     */
    public function __construct(
        StoreRepository $storeRepository,
        StoreFactory $storeFactory,
        SharedStorageInterface $sharedStorage
    ) {
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeFactory;
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Given /^the store has "([^"]*)" store location$/
     */
    public function theStoreHasStoreLocation($storeName)
    {
        $this->saveStore(
            $this->storeFactory->create(
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
                    'images' => [
                        'dragovode_1' =>
                            [
                                'type' => "Office inside",
                                'path' => __DIR__."/../../../Application/app/Resources/fixtures/office_1.jpg",
                            ],
                    ],
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
}