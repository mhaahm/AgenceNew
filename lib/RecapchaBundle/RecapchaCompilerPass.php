<?php
  namespace MHA\RecaptchaBundle;

  use Symfony\Component\DependencyInjection\ContainerBuilder;
  use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

  class RecapchaCompilerPass implements CompilerPassInterface
  {


      public  function process(ContainerBuilder $builder)
      {
          if($builder->hasParameter('twig.form.resources')) {
              $resources = $builder->getParameter('twig.form.resources')? : [];
              array_unshift($resources,'@Recapcha/fields.html.twig');
              $builder->setParameter('twig.form.resources',$resources);
          }
      }
  }

?>