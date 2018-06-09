<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface StoreRepositoryInterface extends RepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder;

    public function findOneEnabledBySlug(string $slug, ?string $localeCode): ?StoreInterface;
}
