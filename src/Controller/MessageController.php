<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/{message}", name="message")
     * @param $message
     * @return Response
     */
    public function index($message)
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
            'message' => $message
        ]);
    }
}
