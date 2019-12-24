<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedecinRepository")
 */
class Medecin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datenais;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="medecins")
     */
    private $service;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialite", inversedBy="medecins")
     */
    private $specialite;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatenais(): ?\DateTimeInterface
    {
        return $this->datenais;
    }

    public function setDatenais(\DateTimeInterface $datenais): self
    {
        $this->datenais = $datenais;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getService(): ?service
    {
        return $this->service;
    }

    public function setService(?service $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection|specialite[]
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(specialite $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite[] = $specialite;
        }

        return $this;
    }

    public function removeSpecialite(specialite $specialite): self
    {
        if ($this->specialite->contains($specialite)) {
            $this->specialite->removeElement($specialite);
        }

        return $this;
    }
}
