<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 */
class Newsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Veuillez rentrer un prenom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer un prenom de maximum {{ limit }} charactères"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Veuillez rentrer un nom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer un nom de maximum {{ limit }} charactères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Email(message="Veuillez rentrer une adresse email")
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\IsTrue(message="Veuillez cocher la case")
     */
    private $caseObligatoire;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCaseObligatoire(): ?bool
    {
        return $this->caseObligatoire;
    }

    public function setCaseObligatoire(bool $caseObligatoire): self
    {
        $this->caseObligatoire = $caseObligatoire;

        return $this;
    }
}
