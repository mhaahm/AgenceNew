<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 05/12/18
 * Time: 22:53
 */

namespace MHA\RecaptchaBundle\Contraints;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecapchaValidator extends ConstraintValidator
{

    public $request;

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        $recapchaResponse = $this->request->getCurrentRequest()->request->get('g-recapcha-response');
        if(null === $recapchaResponse) {
            $this->context->buildViolation($constraint->message)->addViolation();
            return;
        }
    }
}