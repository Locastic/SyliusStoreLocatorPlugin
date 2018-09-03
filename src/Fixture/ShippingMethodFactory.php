<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Locastic\SyliusStoreLocatorPlugin\Entity\ShippingMethodInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ShippingMethodExampleFactory;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface as BaseShippingMethodInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingMethodFactory extends ShippingMethodExampleFactory
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @param FactoryInterface $shippingMethodFactory
     * @param RepositoryInterface $zoneRepository
     * @param RepositoryInterface $shippingCategoryRepository
     * @param RepositoryInterface $localeRepository
     * @param ChannelRepositoryInterface $channelRepository
     */
    public function __construct(
        FactoryInterface $shippingMethodFactory,
        RepositoryInterface $zoneRepository,
        RepositoryInterface $shippingCategoryRepository,
        RepositoryInterface $localeRepository,
        ChannelRepositoryInterface $channelRepository
    ) {
        parent::__construct($shippingMethodFactory, $zoneRepository, $shippingCategoryRepository, $localeRepository, $channelRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = []): BaseShippingMethodInterface
    {
        /** @var ShippingMethodInterface $shippingMethod */
        $shippingMethod = parent::create($options);

        if (array_key_exists('is_pickup_at_store', $options)) {
            $shippingMethod->setPickupAtStore($options['is_pickup_at_store']);
        }

        return $shippingMethod;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('is_pickup_at_store', function (Options $options): bool {
                return $this->faker->boolean(90);
            })
        ;
    }
}
