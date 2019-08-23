<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 11/11/18
 * Time: 20:11
 */

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class AdminPropertyController extends AbstractController
{


    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminPropertyController constructor.
     * @param PropertyRepository $repo
     */
    public function __construct(PropertyRepository $repo,ObjectManager $em)
    {
        $this->repository = $repo;
        $this->em = $em;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $propertys = $this->repository->findAll();
        return new Response($this->renderView('Admin/index.html.twig',[
           'propertys' => $propertys
        ]));
    }


    /**
     * @param Request $request
     * @param Property $Property
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function edit(Request $request,Property $Property): Response
    {
        $form = $this->createForm(PropertyType::class,$Property);
        $form->handleRequest($request);
        if($form->isSubmitted() and  $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return new Response($this->renderView('Admin/edit.html.twig',[
            'property' => $Property,
            'formProperty' => $form->createView()
        ]));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function new(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() and  $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Bien Ajouté avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return new Response($this->renderView('Admin/new.html.twig',[
            'property' => $property,
            'formProperty' => $form->createView()
        ]));
    }

    /**
     * @param Property $property
     */
    public function delete(Property $property,Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.property.index');
    }
}