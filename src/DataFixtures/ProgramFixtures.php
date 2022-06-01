<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'La Ligne verte', 'synopsis' => 'La Ligne verte est un film de science-fiction américain réalisé par Steven Spielberg, sorti en 1987. Il est le premier film de la série de films La Ligne verte, créée par le studio Warner Bros. et sorti en France le 1er avril 1987', 'category' => 'Science-fiction'],
        ['title' => 'Top Gun: Maverick', 'synopsis' => "Après avoir été l’un des meilleurs pilotes de chasse de la Marine américaine, Pete \"Maverick\" Mitchell continue à repousser ses limites en tant que pilote d'essai. Il est chargé de former un détachement de jeunes diplômés de l’école Top Gun pour une mission spéciale qu’aucun pilote n'aurait jamais imaginée.", 'category' => 'Action'],
        ['title' => "Les Aventuriers de l'arche perdue", 'synopsis' => '1936. Indiana Jones est mandaté par les services secrets pour retrouver le Médaillon de Râ, en possession de son ancienne conquête Marion Ravenwood.', 'category' => 'Aventure'],
        ['title' => "Le Roi Lion", 'synopsis' => 'Le long combat de Simba le lionceau pour accéder à son rang de roi des animaux, après que le fourbe Scar, son oncle, a tué son père et pris sa place.', 'category' => 'Animation'],
        ['title' => "Le Seigneur des anneaux : le retour du roi", 'synopsis' => "Tandis que les ténèbres se répandent sur la Terre du Milieu, Aragorn se révèle être l'héritier caché des rois antiques. Quant à Frodon, toujours tenté par l'Anneau, il voyage à travers les contrées ennemies, se reposant sur Sam et Gollum...", 'category' => 'Fantastique'],
        ['title' => "Psychose", 'synopsis' => "Une jeune femme en fuite trouve refuge dans un motel isolé...", 'category' => 'Horreur'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programItem) {
            $program = new Program();
            $program->setTitle($programItem['title']);
            $program->setSynopsis($programItem['synopsis']);
            $program->setCategory($this->getReference('category_' . $programItem['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
