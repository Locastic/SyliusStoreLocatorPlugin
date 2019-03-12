<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Form\Extension\Checkout;

use Locastic\SyliusStoreLocatorPlugin\Entity\Store;
use Sylius\Bundle\CoreBundle\Form\Type\Checkout\ShipmentType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

final class ShipmentTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'store',
            EntityType::class,
            [
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.pickupAtStoreAvailable = :pickupAtStoreAvailable')
                        ->setParameter('pickupAtStoreAvailable', true);
                },
                'mapped' => true,
                'class' => Store::class,
                'choice_label' => 'name',
            ]
        );
    }

    public static function getExtendedTypes(): iterable
    {
        return [ShipmentType::class];
    }
}
