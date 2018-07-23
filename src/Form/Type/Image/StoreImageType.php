<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Form\Type\Image;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

class StoreImageType extends ImageType
{
    public function getBlockPrefix(): string
    {
        return 'locastic_sylius_store_locator_plugin_store_image';
    }
}