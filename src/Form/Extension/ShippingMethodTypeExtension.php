<?php

namespace Locastic\SyliusStoreLocatorPlugin\Form\Extension;

use Sylius\Bundle\ShippingBundle\Form\Type\ShippingMethodType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ShippingMethodTypeExtension
 * @package Locastic\SyliusStoreLocatorPlugin\Form\Extension\Checkout
 */
final class ShippingMethodTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'pickupAtLocation',
                CheckboxType::class,
                [
                    'label' => 'locastic_sylius_store_locator_plugin.ui.pickup_at_location',
                    'required' => false,
                ]
            );

    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return ShippingMethodType::class;
    }
}