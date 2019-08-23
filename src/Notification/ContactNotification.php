<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 26/11/18
 * Time: 22:45
 */

namespace App\Notification;


use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;


    /**
     * ContactNotification constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renderer
     */
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }


    /**
     * @param Contact $contact
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message("Agence : ".$contact->getProperty()->getTitle()))
            ->setFrom('noreplay@server.com')
            ->setTo('contact@agence.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig',[
                'contact' => $contact
            ]),'text/html');
        $this->mailer->send($message);
    }

}