<?php

namespace Locastic\SyliusStoreLocatorPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class IsStorePopulated extends Constraint
{
    public $message = 'locastic_sylius_store_locator_plugin.shipment_method.store_not_null';


    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
