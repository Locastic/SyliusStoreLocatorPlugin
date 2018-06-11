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
        // todo find some way to get info about shipmening methods
        // if methos is supporting pickupAtLocation add store fiedl
        // we nned to add bool to ShippingMethod (isPickupAtLocation)
        // this should be mapped

        $builder->add(
            'store',
            EntityType::class,
            [
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.pickupAtStoreAvailable = :pickupAtStoreAvailable')
                        ->setParameter('pickupAtStoreAvailable', true);
                },
                'mapped' => false,
                'class' => Store::class,
                'required' => false,
                'choice_label' => 'name',
            ]
        );

    }

    public function getExtendedType(): string
    {
        return ShipmentType::class;
    }
}