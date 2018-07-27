<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Locastic\SyliusStoreLocatorPlugin\Entity\Store;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreImage;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreImageInterface;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreTranslation;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class StoreFixture extends AbstractFixture
{
    /** @var ObjectManager */
    private $storeManager;

    /** @var FactoryInterface */
    private $storeImageFactory;

    /** @var ImageUploaderInterface */
    private $imageUploader;

    /**
     * StoreFixture constructor.
     *
     * @param ObjectManager $storeManager
     * @param FactoryInterface $storeImageFactory
     * @param ImageUploaderInterface $imageUploader
     */
    public function __construct(ObjectManager $storeManager, FactoryInterface $storeImageFactory, ImageUploaderInterface $imageUploader)
    {
        $this->storeManager = $storeManager;
        $this->storeImageFactory = $storeImageFactory;
        $this->imageUploader = $imageUploader;
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
                $pageTranslation->setOpeningHours($translation['opening_hours']);
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
            $store->setPickupAtStoreAvailable($option['pickup_at_store_available']);

            foreach ($option['images'] as $image) {
                if (!array_key_exists('path', $image)) {
                    $imagePath = array_shift($image);
                    $imageType = array_pop($image);
                } else {
                    $imagePath = $image['path'];
                    $imageType = $image['type'] ?? null;
                }

                $uploadedImage = new UploadedFile($imagePath, basename($imagePath));

                /** @var StoreImageInterface $storeImage */
                $storeImage = new StoreImage();

                $storeImage->setPath($imagePath);
                $storeImage->setFile($uploadedImage);
                $storeImage->setType($imageType);

                $this->imageUploader->upload($storeImage);

                $store->addImage($storeImage);
            }

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
                            ->scalarNode('pickup_at_store_available')->defaultTrue()->end()
                            ->arrayNode('translations')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('slug')->defaultNull()->end()
                                        ->scalarNode('name')->defaultNull()->end()
                                        ->scalarNode('meta_title')->defaultNull()->end()
                                        ->scalarNode('meta_keywords')->defaultNull()->end()
                                        ->scalarNode('meta_description')->defaultNull()->end()
                                        ->scalarNode('content')->defaultNull()->end()
                                        ->scalarNode('opening_hours')->defaultNull()->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('images')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('type')->defaultNull()->end()
                                        ->scalarNode('path')->defaultNull()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
