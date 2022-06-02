<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Form\ProgramType;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * The controller for the category add form
     * Display the form or deal with it
     */
    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $programRepository->add($program, true);
        }

        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/{id<^[0-9]+$>}', name: 'show')]
    public function show(Program $program, SeasonRepository $seasonRepository): Response
    {
        $seasons = $seasonRepository->findBy(['program' => $program]);
        return $this->render('program/show.html.twig', [
            'program' => $program, 'seasons' => $seasons,
        ]);
    }

    #[Route('/{program<^[0-9]+$>}/season/{season<^[0-9]+$>}', name: 'season_show')]
    public function showSeason(Season $season, Program $program, EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findBy(['season' => $season]);
        return $this->render('program/season_show.html.twig', [
            'program' => $program, 'season' => $season, 'episodes' => $episodes,
        ]);
    }

    #[Route('/{program<^[0-9]+$>}/season/{season<^[0-9]+$>}/episode/{episode<^[0-9]+$>}', name: 'episode_show')]
    public function showEpisode(Season $season, Program $program, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program, 'season' => $season, 'episode' => $episode,
        ]);
    }
}
