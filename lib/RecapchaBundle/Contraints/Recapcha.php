<?php

namespace MHA\RecaptchaBundle\Contraints;


use Symfony\Component\Validator\Constraint;

class Recapcha extends Constraint
{


    public $message = "Invalid recaptcha";
}

?>