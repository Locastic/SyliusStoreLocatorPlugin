<?php

namespace Locastic\SyliusStoreLocatorPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsStorePopulatedValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value->getMethod()->isPickupAtLocation() && is_null($value->getStore())) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('method')
                ->addViolation();
        }
    }
}