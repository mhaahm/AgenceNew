<?php

namespace MHA\RecaptchaBundle\Type;




use MHA\RecaptchaBundle\Contraints\Recapcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecapchaSubmitType extends AbstractType
{

    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;

    public function __construct(string $key,string $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'mapped' => false,
            'constraints' => new Recapcha()
        ]);
    }

    /**
     * @return null|string
     */
    public function getBlockPrefix()
    {
        return 'recaptcha_submit';
    }

    /**
     * @return null|string
     */
    public function getParent()
    {
        return TextType::class;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['label'] = false;
        $view->vars['button'] = $options['label'];
        $view->vars['key'] = $this->key;
    }


}


?>