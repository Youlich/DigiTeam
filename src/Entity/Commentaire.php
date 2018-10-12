<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotNull()
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Veuillez rentrer une nom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une nom de maximum {{ limit }} charactères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Veuillez rentrer une prenom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une prenom de maximum {{ limit }} charactères"
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
     * @ORM\Column(type="datetime")
     */
    private $dateAjout;

    /**
     * @ORM\Column(type="boolean")
     */
    private $caseNewsletter;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\IsTrue(message="Veuillez cocher la case")
     */
    private $caseObligatoire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commentaires")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

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

    public function getCaseObligatoire(): ?bool
    {
        return $this->caseObligatoire;
    }

    public function setCaseObligatoire(bool $caseObligatoire): self
    {
        $this->caseObligatoire = $caseObligatoire;

        return $this;
    }

    public function getArticle(): ?article
    {
        return $this->article;
    }

    public function setArticle(?article $article): self
    {
        $this->article = $article;

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
