<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
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
     * @Assert\NotNull()
     */
    private $civilite;

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
     *      minMessage = "Veuillez rentrer une prenom de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une prenom de maximum {{ limit }} charactères"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Veuillez rentrer une societe de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une societe de maximum {{ limit }} charactères"
     * )
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Email(message="Veuillez rentrer une adresse email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Veuillez rentrer une adresse de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une adresse de maximum {{ limit }} charactères"
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\Range(
     *      min = "01000",
     *      max = "99999",
     *      minMessage="Veuillez rentrer un code postal valide",
     *      maxMessage="Veuillez rentrer un code postal valide"
     * )
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 35,
     *      minMessage = "Veuillez rentrer une ville de minimum {{ limit }} charactères",
     *      maxMessage = "Veuillez rentrer une ville de maximum {{ limit }} charactères"
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Regex(
     *     pattern="/^0[1-9](([. -]?)[0-9]{2}){1}(\2[0-9]{2}){3}$/",
     *     message="Veuillez rentrer un numero de telephone"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Url()
     */
    private $urlSite;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAjout;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean")
     */
    private $packStarter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $packChallenger;

    /**
     * @ORM\Column(type="boolean")
     */
    private $packExpert;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inboundMarketing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $consulting;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getUrlSite(): ?string
    {
        return $this->urlSite;
    }

    public function setUrlSite(string $urlSite): self
    {
        $this->urlSite = $urlSite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getPackStarter(): ?bool
    {
        return $this->packStarter;
    }

    public function setPackStarter(bool $packStarter): self
    {
        $this->packStarter = $packStarter;

        return $this;
    }

    public function getPackChallenger(): ?bool
    {
        return $this->packChallenger;
    }

    public function setPackChallenger(bool $packChallenger): self
    {
        $this->packChallenger = $packChallenger;

        return $this;
    }

    public function getPackExpert(): ?bool
    {
        return $this->packExpert;
    }

    public function setPackExpert(bool $packExpert): self
    {
        $this->packExpert = $packExpert;

        return $this;
    }

    public function getInboundMarketing(): ?bool
    {
        return $this->inboundMarketing;
    }

    public function setInboundMarketing(bool $inboundMarketing): self
    {
        $this->inboundMarketing = $inboundMarketing;

        return $this;
    }

    public function getConsulting(): ?bool
    {
        return $this->consulting;
    }

    public function setConsulting(bool $consulting): self
    {
        $this->consulting = $consulting;

        return $this;
    }
}
