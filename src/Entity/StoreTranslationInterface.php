<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface StoreTranslationInterface extends ResourceInterface, TranslationInterface
{
    public function getSlug(): ?string;

    public function setSlug(?string $slug): void;

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

    public function getWorkingTime(): ?string;

    public function setWorkingTime(?string $workingTime): void;
}
