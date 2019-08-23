<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 07/11/18
 * Time: 21:23
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertyType;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class PropertyController extends AbstractController
{

    /**
     * @var Twig\Environment
     *
     */
    private $twig;

    private $repository;

    /**
     * @var
     */
    private $em;


    public function __construct(PropertyRepository $repo,ObjectManager $em)
    {
        $this->repository = $repo;
        $this->em = $em;

    }




    public function index(Request $request): Response
    {


        $propertys = $this->repository->getAllVisited();
        return new Response($this->renderView('pages/home.html.twig',
        [
            'current_menu'=>'property',
            'propertys' => $propertys
        ]));
    }


    /**
     * @param Property $property
     * @param string $slug
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function show(Property $property,string $slug, Request $request, ContactNotification $notification):Response
    {
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class);

        if($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success',"Votre message est bien envoyé");
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        return new Response($this->renderView('pages/show.html.twig',[
            'property' => $property,
            'form'=>$form->createView()
        ]));
    }
}