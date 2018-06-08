<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Locastic\SyliusStoreLocatorPlugin\Entity\Store;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreTranslation;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class StoreFixture extends AbstractFixture
{
    private $storeManager;

    public function __construct(ObjectManager $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    public function load(array $options): void
    {
        foreach ($options['custom'] as $code => $option) {
            $store = new Store();
            $store->setCode($code);

            foreach ($option['translations'] as $locale => $translation) {
                $pageTranslation = new StoreTranslation();
                $pageTranslation->setLocale($locale);

                $pageTranslation->setName($translation['name']);
                $pageTranslation->setSlug($translation['slug']);
                $pageTranslation->setContent($translation['content']);
                $pageTranslation->setWorkingTime($translation['working_time']);
                $pageTranslation->setMetaTitle($translation['meta_title']);
                $pageTranslation->setMetaDescription($translation['meta_description']);
                $pageTranslation->setMetaKeywords($translation['meta_keywords']);

                $store->addTranslation($pageTranslation);
            }

            $store->setLatitude($option['latitude']);
            $store->setLongitude($option['longitude']);
            $store->setAddress($option['address']);
            $store->setContactEmail($option['contact_email']);
            $store->setContactPhone($option['contact_phone']);

            $this->storeManager->persist($store);
        }

        $this->storeManager->flush();
    }

    public function getName(): string
    {
        return 'store';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')
                    ->prototype('array')
                        ->children()
                            ->booleanNode('remove_existing')->defaultTrue()->end()
                            ->booleanNode('enabled')->defaultTrue()->end()
                            ->scalarNode('latitude')->defaultNull()->end()
                            ->scalarNode('longitude')->defaultNull()->end()
                            ->scalarNode('address')->defaultNull()->end()
                            ->scalarNode('contact_phone')->defaultNull()->end()
                            ->scalarNode('contact_email')->defaultNull()->end()
                            ->arrayNode('translations')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('slug')->defaultNull()->end()
                                        ->scalarNode('name')->defaultNull()->end()
                                        ->scalarNode('meta_title')->defaultNull()->end()
                                        ->scalarNode('meta_keywords')->defaultNull()->end()
                                        ->scalarNode('meta_description')->defaultNull()->end()
                                        ->scalarNode('content')->defaultNull()->end()
                                        ->scalarNode('working_time')->defaultNull()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
