<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;

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

    #[Route('/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, SeasonRepository $seasonRepository, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        $seasons = $seasonRepository->findBy(['program' => $program]);
        return $this->render('program/show.html.twig', [
            'program' => $program, 'seasons' => $seasons,
        ]);
    }

    #[Route('/{programId<^[0-9]+$>}/seasons/{seasonId<^[0-9]+$>}', name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, ProgramRepository $programRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $programId . ' found in program\'s table.'
            );
        }
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : ' . $seasonId . ' found in program' . $programId
            );
        }
        $episodes = $episodeRepository->findBy(['season' => $season]);
        return $this->render('program/season_show.html.twig', [
            'program' => $program, 'season' => $season, 'episodes' => $episodes,
        ]);
    }
}
