<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    protected $slufigy;

    public function __construct(Slugify $slugify)
    {
        $this->slufigy = $slugify;
    }


    public const PROGRAMS = [
        ['title' => 'Star Wars: Obi-Wan Kenobi', 'ownerId' => 1, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/05/04/16/20/1390919.jpg', 'synopsis' => 'L’action se déroule dix ans après la fin tragique de STAR WARS : LA REVANCHE DES SITH. Obi-Wan y avait subi sa plus grande défaite et assisté à la déchéance de son meilleur ami, l’apprenti Jedi Anakin Skywalker, qui avait rejoint le Côté Obscur en devenant le seigneur Sith Dark Vador.', 'category' => 'Science-fiction'],
        ['title' => 'The Boys', 'ownerId' => 1, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/05/25/17/50/0161050.jpg', 'synopsis' => "Dans un monde fictif où les super-héros se sont laissés corrompre par la célébrité et la gloire et ont peu à peu révélé la part sombre de leur personnalité, une équipe de justiciers qui se fait appeler \"The Boys\" décide de passer à l'action et d'abattre ces super-héros autrefois appréciés de tous.", 'category' => 'Action'],
        ['title' => "La montagne aux secrets", 'ownerId' => 2, 'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/21/04/10/18/39/3948088.jpg', 'synopsis' => 'Après un drame survenu en haute montagne, un groupe de jeunes en réinsertion s’organise pour survivre en autonomie.', 'category' => 'Aventure'],
        ['title' => "Les Simpson", 'ownerId' => 1, 'poster' => 'https://fr.web.img3.acsta.net/c_310_420/pictures/20/10/01/11/26/1905965.jpg', 'synopsis' => 'Les Simpson vivent à Springfield. Homer, le père, a deux passions : regarder la télé et boire des bières. Mais son quotidien est rarement reposant, entre son fils Bart le cancre, sa fille Lisa la surdouée, ou encore sa femme Marge qui ne supporte pas de le voir se soûler à longueur de journée.', 'category' => 'Animation'],
        ['title' => "Histoires Fantastiques", 'ownerId' => 2, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/medias/nmedia/18/91/05/26/20127378.jpg', 'synopsis' => "Des échanges de corps, des rêves prémonitoires : venez découvrir des récits incroyables où le fantastique percute de plein fouet le quotidien. 24 épisodes haletants, imaginatifs et visuellement époustouflants.", 'category' => 'Fantastique'],
        ['title' => "Les Contes de la Crypte", 'ownerId' => 1, 'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/16/03/31/16/38/011023.jpg', 'synopsis' => "Cette comédie horrifique est basée sur les comics des années 50 de Williams M. Gaines. Chaque épisode est une histoire indépendante, avec de prestigieuses guest-stars régulièrement devant ou derrière la caméra.", 'category' => 'Horreur'],
        ['title' => "Stranger Things", 'ownerId' => 2, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/05/18/14/31/5186184.jpg', 'synopsis' => "1983, à Hawkins dans l'Indiana. Après la disparition d'un garçon de 12 ans dans des circonstances mystérieuses, la petite ville du Midwest est témoin d'étranges phénomènes.", 'category' => 'Fantastique'],
        ['title' => "Outlander", 'ownerId' => 1, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/20/01/06/09/20/3653287.jpg', 'synopsis' => "Les aventures de Claire, une infirmière de guerre mariée qui se retrouve accidentellement propulsée en pleine campagne écossaise de 1743.", 'category' => 'Fantastique'],
        ['title' => "Le Seigneur des Anneaux : Les Anneaux de Pouvoir", 'ownerId' => 1, 'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/02/03/16/28/1554715.jpg', 'synopsis' => "Commençant à une époque de paix relative, la série suit un ensemble de personnages, à la fois familiers et nouveaux, alors qu’ils affrontent la réémergence tant redoutée du mal sur la Terre du Milieu. Des profondeurs les plus sombres des Monts Brumeux, aux forêts majestueuses de la capitale des elfes de Lindon, au royaume insulaire à couper le souffle de Númenor, jusqu’aux confins de la carte, ces royaumes et personnages se tailleront des héritages qui perdureront longtemps après qu’ils soient partis.", 'category' => 'Fantastique'],
        ['title' => "Game of Thrones", 'ownerId' => 2, 'poster' => 'https://fr.web.img4.acsta.net/c_310_420/pictures/19/03/21/17/05/1927893.jpg', 'synopsis' => "Dans un pays où l'été peut durer plusieurs années et l'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. Pendant ce temps, complots et rivalités se jouent sur le continent pour s'emparer du Trône de Fer, le symbole du pouvoir absolu.", 'category' => 'Fantastique'],
        ['title' => "Forever", 'ownerId' => 1, 'poster' => 'https://fr.web.img3.acsta.net/c_310_420/pictures/14/08/08/11/44/228891.jpg', 'synopsis' => "Le Dr Henry Morgan, un médecin légiste discret mais brillant, étudie la mort pour une raison bien précise : il est immortel. Depuis deux siècles, il parcourt le monde et cherche un remède à sa condition qu'il considère comme une malédiction, aidé par un son meilleur ami, un vieux chauffeur de taxi roublard. Après un accident de métro au cours duquel il a (encore) perdu la vie, il fait la rencontre de la détective Jo Martinez, une veuve au caractère bien trempé avec qui, il ne va pas tarder à faire équipe pour résoudre d'épineuses affaires criminelles...", 'category' => 'Fantastique'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programItem) {
            $program = new Program();
            // $owner = $UserRepository->find($programItem['ownerId']);
            $program->setTitle($programItem['title'])
                ->setSynopsis($programItem['synopsis'])
                ->setPoster($programItem['poster'])
                ->setCategory($this->getReference('category_' . $programItem['category']))
                ->setSlug($this->slufigy->generate($programItem['title']))
                ->setOwner($this->getReference('user_' . $programItem['ownerId']));
            $this->addReference('program_' . $key, $program);
            // $program->addActor($this->getReference('actor_' . $key));
            $manager->persist($program);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}
