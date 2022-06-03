<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ActorRepository;
use App\Repository\ProgramRepository;
use App\Entity\Actor;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render(
            'actor/index.html.twig',
            ['actors' => $actors]
        );
    }


    #[Route('/{id}', name: 'show')]
    public function show(int $id, ActorRepository $actorRepository, ProgramRepository $programRepository): Response
    {
        $actor = $actorRepository->findOneBy(['id' => $id]);

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : ' . $id . ' found in actor\'s table.'
            );
        }
        $programs = $actor->getPrograms();
        return $this->render('actor/show.html.twig', [
            'actor' => $actor, 'programs' => $programs,
        ]);
    }
}
