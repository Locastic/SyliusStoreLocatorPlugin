<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

class Store implements StoreInterface
{
    use ToggleableTrait;
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as protected initializeTranslationsCollection;
        getTranslation as public translatableTraitGetTranslation;
    }

    protected $id;

    protected $code;

    protected $latitude;

    protected $longitude;

    protected $contactPhone;

    protected $contactEmail;

    protected $address;

    protected $pickupAtStoreAvailable;

    /** @var Collection|ImageInterface[] */
    protected $images;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->createdAt = new \DateTime();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getLatitude(): ?float
    {
        return (float)$this->latitude;
    }

    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?float
    {
        return (float)$this->longitude;
    }

    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(?string $contactPhone): void
    {
        $this->contactPhone = $contactPhone;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }


    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getSlug(): ?string
    {
        return $this->getStoreLocatorTranslation()->getSlug();
    }

    public function setSlug(?string $slug): void
    {
        $this->getStoreLocatorTranslation()->setSlug($slug);
    }

    public function getName(): ?string
    {
        return $this->getStoreLocatorTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getStoreLocatorTranslation()->setName($name);
    }

    public function getMetaTitle(): ?string
    {
        return $this->getStoreLocatorTranslation()->getMetaTitle();
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->getStoreLocatorTranslation()->setMetaTitle($metaTitle);
    }

    public function getMetaKeywords(): ?string
    {
        return $this->getStoreLocatorTranslation()->getMetaKeywords();
    }

    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->getStoreLocatorTranslation()->setMetaKeywords($metaKeywords);
    }

    public function getMetaDescription(): ?string
    {
        return $this->getStoreLocatorTranslation()->getMetaDescription();
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->getStoreLocatorTranslation()->setMetaDescription($metaDescription);
    }

    public function getContent(): ?string
    {
        return $this->getStoreLocatorTranslation()->getContent();
    }

    public function setContent(?string $content): void
    {
        $this->getStoreLocatorTranslation()->setContent($content);
    }

    public function getOpeningHours(): ?string
    {
        return $this->getStoreLocatorTranslation()->getOpeningHours();
    }

    public function setOpeningHours(?string $openingHours): void
    {
        $this->getStoreLocatorTranslation()->setOpeningHours($openingHours);
    }

    public function setPickupAtStoreAvailable(bool $pickupAtStoreAvailable): void
    {
        $this->pickupAtStoreAvailable = $pickupAtStoreAvailable;
    }

    public function isPickupAtStoreAvailable(): ?bool
    {
        return $this->pickupAtStoreAvailable;
    }

    protected function getStoreTranslation(): StoreTranslationInterface
    {
        return $this->getStoreLocatorTranslation();
    }

    protected function createTranslation(): ?StoreTranslationInterface
    {
        return new StoreTranslation();
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function addImage(ImageInterface $image): void
    {
        if ($image->hasFile()) {
            $image->setOwner($this);
            $this->images->add($image);
        }
    }

    public function removeImage(ImageInterface $image)
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }

    public function getStoreLocatorTranslation(?string $locale = null): StoreTranslationInterface
    {
        /** @var StoreTranslationInterface $storeTranslation */
        $storeTranslation = $this->translatableTraitGetTranslation($locale);

        return $storeTranslation;
    }
}
