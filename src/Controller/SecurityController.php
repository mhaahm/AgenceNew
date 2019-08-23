<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 15/11/18
 * Time: 21:10
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    public function login(AuthenticationUtils $authentificationUtils): Response
    {
        $lastusername = $authentificationUtils->getLastUsername();
        $error = $authentificationUtils->getLastAuthenticationError();
        return new Response($this->renderView('security/login.html.twig',[
            'last_username' => $lastusername,
            'error' => $error
        ]));
    }

}