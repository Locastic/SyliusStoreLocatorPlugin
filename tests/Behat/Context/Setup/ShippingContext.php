<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Locastic\SyliusStoreLocatorPlugin\Fixture\ShippingMethodFactory;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;


final class ShippingContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var ShippingMethodFactory
     */
    private $shippingMethodFactory;

    /**
     * @var ShippingMethodRepositoryInterface
     */
    private $shippingMethodRepository;

    /**
     * ShippingContext constructor.
     * @param SharedStorageInterface $sharedStorage
     * @param ShippingMethodFactory $shippingMethodExampleFactory
     * @param ShippingMethodRepositoryInterface $shippingMethodRepository
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        ShippingMethodFactory $shippingMethodExampleFactory,
        ShippingMethodRepositoryInterface $shippingMethodRepository
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->shippingMethodFactory = $shippingMethodExampleFactory;
        $this->shippingMethodRepository = $shippingMethodRepository;
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