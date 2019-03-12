<?php

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Locastic\SyliusStoreLocatorPlugin\Entity\Store;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreImage;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreImageInterface;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreTranslation;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoreFactory
{
    /** @var ImageUploaderInterface */
    private $imageUploader;

    /**
     * StoreFactory constructor.
     * @param ImageUploaderInterface $imageUploader
     */
    public function __construct(ImageUploaderInterface $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }
    
    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
            $store = new Store();
            $store->setCode($options['code']);

            foreach ($options['translations'] as $locale => $translation) {
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

            $store->setLatitude($options['latitude']);
            $store->setLongitude($options['longitude']);
            $store->setAddress($options['address']);
            $store->setContactEmail($options['contact_email']);
            $store->setContactPhone($options['contact_phone']);
            $store->setPickupAtStoreAvailable($options['pickup_at_store_available']);

            foreach ($options['images'] as $image) {
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

            return $store;
    }
}