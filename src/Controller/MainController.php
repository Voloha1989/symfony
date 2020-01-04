<?php

namespace App\Controller;

use App\Entity\Notes;
use App\Form\NotesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $note = new Notes();
        $form = $this->createForm(NotesType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($note);
            $em->flush();

            return $this->redirect("/");
        }

        $notes = $em->getRepository(Notes::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
            'notes' => $notes
        ]);
    }

    /**
     * @Route("/remove/{note}", name="remove_note")
     * @param Notes $note
     * @return RedirectResponse
     */
    public function removeNote(Notes $note)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute("index");
    }
}
