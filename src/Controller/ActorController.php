<?php

namespace App\Controller;

use App\Entity\Actor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/actor', name: 'index')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/{id<\d+>}', name : 'show',methods: ['GET'])]
    public function showActor(Actor $actor)
    {
        $programs=$actor->getPrograms();
        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : ' . $actor->getId() . ' found in program\'s table.'
            );
        }
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'programs'=>$programs
        ]);
}
}
