<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 30/11/18
 * Time: 22:19
 */

namespace MHA\RecaptchaBundle;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RecapchaBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RecapchaCompilerPass());

    }

}