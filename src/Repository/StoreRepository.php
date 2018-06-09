<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class StoreRepository extends EntityRepository implements StoreRepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->where('translation.locale = :locale')
            ->setParameter('locale', $locale);
    }

    public function findOneEnabledBySlug(string $slug, ?string $localeCode): ?StoreInterface
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation')
            ->where('translation.locale = :localeCode')
            ->andWhere('translation.slug = :slug')
            ->andWhere('o.enabled = true')
            ->setParameter('localeCode', $localeCode)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
