<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Form\Type;

use Locastic\SyliusStoreLocatorPlugin\Form\Type\Translation\StoreTranslationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class StoreType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.code',
                'disabled' => null !== $builder->getData()->getCode(),
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.enabled',
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.latitude',
                'required' => false,
                'scale' => 8,
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.longitude',
                'required' => false,
                'scale' => 8,
            ])
            ->add('contactPhone', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.contact_phone',
                'required' => false,
            ])
            ->add('contactEmail', EmailType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.contact_email',
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.address',
                'required' => false,
            ])
            ->add('pickupAtStoreAvailable', CheckboxType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.pickup_at_store_available',
                'required' => false,
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.translations',
                'entry_type' => StoreTranslationType::class,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'locastic_sylius_store_locator_plugin_store';
    }
}