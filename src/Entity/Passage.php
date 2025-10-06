<?php

namespace App\Entity;

use App\Repository\PassageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassageRepository::class)]
class Passage
{
    //identifiant unique du passage
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    //nom de la ligne de bus (ex: A, B, C...)
    #[ORM\Column(length: 10)]
    private ?string $ligne = null;

    //heure estimée d’arrivée
    #[ORM\Column]
    private ?\DateTime $heureEstimee = null;

    //association avec un arrêt où chaque passage est lié à un point fixe
    #[ORM\ManyToOne(inversedBy: 'passages')]
    private ?Arret $liee_a_Arret = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigne(): ?string
    {
        return $this->ligne;
    }

    //setter pour la ligne qui est utile lors de la création des fixtures ou du formulaire
    public function setLigne(string $ligne): static
    {
        $this->ligne = $ligne;

        return $this;
    }

    //getter pour l’heure estimée qui est utilisé pour l’affichage ou le tri
    public function getHeureEstimee(): ?\DateTime
    {
        return $this->heureEstimee;
    }

    //setter pour l’heure estimée qui permet de simuler des horaires dynamiques
    public function setHeureEstimee(\DateTime $heureEstimee): static
    {
        $this->heureEstimee = $heureEstimee;

        return $this;
    }

    //getter pour l’arrêt lié qui permet de naviguer entre les entités
    public function getLieeAArret(): ?Arret
    {
        return $this->liee_a_Arret;
    }

    //setter pour l’arrêt qui est essentiel pour relier les passages aux arrêts
    public function setLieeAArret(?Arret $liee_a_Arret): static
    {
        $this->liee_a_Arret = $liee_a_Arret;

        return $this;
    }
}