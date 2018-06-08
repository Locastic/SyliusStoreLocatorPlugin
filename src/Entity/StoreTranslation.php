<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Resource\Model\AbstractTranslation;

class StoreTranslation extends AbstractTranslation implements StoreTranslationInterface
{
    protected $id;

    protected $slug;

    protected $name;

    protected $content;

    protected $workingTime;

    protected $metaTitle;

    protected $metaKeywords;

    protected $metaDescription;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setWorkingTime(?string $workingTime): void
    {
        $this->workingTime = $workingTime;
    }

    public function getWorkingTime(): ?string
    {
        return $this->workingTime;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->metaKeywords = $metaKeywords;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }
}
