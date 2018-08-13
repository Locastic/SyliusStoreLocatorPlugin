<?php

namespace Locastic\SyliusStoreLocatorPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsStorePopulatedValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value->getMethod()->isPickupAtStore() && $value->getStore() === null) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('method')
                ->addViolation();
        }
    }
}
