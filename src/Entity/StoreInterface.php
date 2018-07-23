<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface StoreInterface extends ResourceInterface, ToggleableInterface, TimestampableInterface, TranslatableInterface
{
    public function getSlug(): ?string;

    public function setSlug(?string $slug): void;

    public function getCode(): ?string;

    public function setCode(?string $code): void;

    public function getLatitude(): ?float;

    public function setLatitude(?float $latitude): void;

    public function getLongitude(): ?float;

    public function setLongitude(?float $longitude): void;

    public function setContactEmail(?string $contactEmail): void;

    public function getContactEmail(): ?string;

    public function setContactPhone(?string $contactPhone): void;

    public function getContactPhone(): ?string;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getMetaTitle(): ?string;

    public function setMetaTitle(?string $metaTitle): void;

    public function getMetaKeywords(): ?string;

    public function setMetaKeywords(?string $metaKeywords): void;

    public function getMetaDescription(): ?string;

    public function setMetaDescription(?string $metaDescription): void;

    public function getContent(): ?string;

    public function setContent(?string $content): void;

    public function getImages(): Collection;

    public function hasImages(): bool;

    public function hasImage(?ImageInterface $image): bool;

    public function addImage(ImageInterface $image): void;

    public function removeImage(ImageInterface $image);

    public function setImages($images): void;
}
