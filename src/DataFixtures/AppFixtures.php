<?php

namespace App\DataFixtures;

use App\Entity\Arret;
use App\Entity\Passage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Initialisation des arrêts—points fixes dans l'espace urbain
        $arrets = [
            ['Gare Centrale', 48.8566, 2.3522],
            ['Place Ville Marie', 48.8575, 2.3514],
            ['Université', 48.8584, 2.3505],
            ['Hôpital', 48.8593, 2.3496],
            ['Stade', 48.8602, 2.3487],
        ];

        $arretEntities = [];

        // Boucle de création des entités Arret—chaque arrêt devient une entité persistée
        foreach ($arrets as $arretData) {
            $arret = new Arret();
            $arret->setNom($arretData[0]);         //nom de l'arrêt
            $arret->setLatitude($arretData[1]);    //coordonnée du latitude
            $arret->setLongitude($arretData[2]);   //coordonnée longitude
            $manager->persist($arret);             //enregistrement en base (non encore flushé)
            $arretEntities[] = $arret;             //stockage temporaire pour les relier aux passages
        }

        //Création des passages—chaque arrêt reçoit 3 passages aléatoires
        $lignes = ['A', 'B', 'C', 'D'];            //lignes fictives pour simuler le trafic
        $now = new \DateTime();                   //point de départ temporel

        foreach ($arretEntities as $arret) {
            for ($i = 0; $i < 3; $i++) {
                $passage = new Passage();
                $passage->setLigne($lignes[array_rand($lignes)]); //ligne aléatoire
                $passage->setHeureEstimee((clone $now)->modify('+'.rand(5, 60).' minutes')); //heure estimée entre +5 et +60 min
                $passage->setLieeAArret($arret);   //association avec l'arrêt correspondant
                $manager->persist($passage);       //enregistrement du passage
            }
        }

        $manager->flush(); //envoi final vers la base
    }
}