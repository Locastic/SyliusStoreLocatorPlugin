<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Form\Extension\Checkout;

use Locastic\SyliusStoreLocatorPlugin\Entity\Store;
use Locastic\SyliusStoreLocatorPlugin\Form\EventListener\ShipmentFormEventListener;
use Sylius\Bundle\CoreBundle\Form\Type\Checkout\ShipmentType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

final class ShipmentTypeExtension extends AbstractTypeExtension
{
    private $translator;

    public function __construct($translator)
    {
        $this->translator = $translator;
    }

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
                'required' => false,
                'class' => Store::class,
                'choice_label' => 'name',
            ]
        );

        $message = $this->translator->trans('locastic_sylius_store_locator_plugin.shipment_method.store_not_null',[],'validators');
        $builder->addEventSubscriber(new ShipmentFormEventListener($message));
    }

    public static function getExtendedTypes(): iterable
    {
        return [ShipmentType::class];
    }
}
