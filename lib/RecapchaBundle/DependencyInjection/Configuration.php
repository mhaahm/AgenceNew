<?php

namespace MHA\RecaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 */
class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $tb = new TreeBuilder();
        $root = $tb->root('recapcha');

        $root->children()
            ->scalarNode('key')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('secret')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->end();

        return $tb;
    }

}
