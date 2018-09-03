<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Locastic\SyliusStoreLocatorPlugin\Entity\ShippingMethodInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ShippingMethodExampleFactory;
use Sylius\Bundle\CoreBundle\Fixture\OptionsResolver\LazyOption;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface as BaseShippingMethodInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingMethodFactory extends ShippingMethodExampleFactory
{
    /**
     * @var FactoryInterface
     */
    private $shippingMethodFactory;

    /**
     * @var RepositoryInterface
     */
    private $zoneRepository;

    /**
     * @var RepositoryInterface
     */
    private $shippingCategoryRepository;

    /**
     * @var RepositoryInterface
     */
    private $localeRepository;

    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

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
     * ToDo: fix
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
     * ToDo: fix
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
