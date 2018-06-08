<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Form\Type\Translation;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class StoreTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.slug',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.content',
                'required' => false,
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.meta_title',
                'required' => false,
            ])
            ->add('metaKeywords', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.meta_keywords',
                'required' => false,
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'locastic_sylius_store_locator_plugin.ui.meta_description',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'locastic_sylius_store_locator_plugin_store_translation';
    }
}