<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\EventListener;

use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;

final class StoreImageUploadListener
{
    /** @var ImageUploaderInterface */
    private $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImages(ResourceControllerEvent $event): void
    {
        /** @var StoreInterface $store */
        $store = $event->getSubject();

        $images = $store->getImages();

        $images->map(function (ImageInterface $image){
            if($image->hasFile()){
                $this->uploader->upload($image);
            }
        });

    }


}