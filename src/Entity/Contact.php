<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
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
     *      minMessage = "Veuillez rentrer un nom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer un nom de maximum {{ limit }} charactères"
     * )
     */
    private $nom;

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
     * @Assert\Email(message="Veuillez rentrer une adresse email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull()
     */
    private $sujet;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotNull()
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     */
    private $caseNewsletter;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\IsTrue(message="Veuillez cocher la case")
     */
    private $caseReglement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCaseNewsletter(): ?bool
    {
        return $this->caseNewsletter;
    }

    public function setCaseNewsletter(bool $caseNewsletter): self
    {
        $this->caseNewsletter = $caseNewsletter;

        return $this;
    }

    public function getCaseReglement(): ?bool
    {
        return $this->caseReglement;
    }

    public function setCaseReglement(bool $caseReglement): self
    {
        $this->caseReglement = $caseReglement;

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
}
