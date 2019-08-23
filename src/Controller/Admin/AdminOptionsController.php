<?php

namespace App\Controller\Admin;

use App\Entity\Options;
use App\Form\OptionsType;
use App\Repository\OptionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/options")
 */
class AdminOptionsController extends AbstractController
{
    /**
     * @Route("/", name="options_index", methods="GET")
     */
    public function index(OptionsRepository $optionsRepository): Response
    {
        return $this->render('Admin/options/index.html.twig', ['options' => $optionsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="options_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $option = new Options();
        $form = $this->createForm(OptionsType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($option);
            $em->flush();

            return $this->redirectToRoute('options_index');
        }

        return $this->render('Admin/options/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="options_show", methods="GET")
     */
    public function show(Options $option): Response
    {
        return $this->render('Admin/options/show.html.twig', ['option' => $option]);
    }

    /**
     * @Route("/{id}/edit", name="options_edit", methods="GET|POST")
     */
    public function edit(Request $request, Options $option): Response
    {
        $form = $this->createForm(OptionsType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('options_index', ['id' => $option->getId()]);
        }

        return $this->render('Admin/options/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="options_delete", methods="DELETE")
     */
    public function delete(Request $request, Options $option): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($option);
            $em->flush();
        }

        return $this->redirectToRoute('options_index');
    }
}
