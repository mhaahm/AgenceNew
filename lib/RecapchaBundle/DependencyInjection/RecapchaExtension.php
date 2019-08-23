<?php

namespace  MHA\RecaptchaBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class RecapchaExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container,new FileLocator(__DIR__.'/../Resources/Config'));
        $loader->load('services.yaml');
        $configuration = new Configuration();
        $configs = $this->processConfiguration($configuration,$configs);
        $container->setParameter('recapcha.key',$configs['key']);
        $container->setParameter('recapcha.secret',$configs['secret']);
    }
}


?>