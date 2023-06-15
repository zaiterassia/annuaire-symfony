<?php

namespace App\Entity;

use App\Repository\AnnuaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnuaryRepository::class)
 */
class Annuary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Seo::class, mappedBy="annuary")
     */
    private $seos;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="annuaries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEdit;

    public function __construct()
    {
        $this->seos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Seo>
     */
    public function getSeos(): Collection
    {
        return $this->seos;
    }

    public function addSeo(Seo $seo): self
    {
        if (!$this->seos->contains($seo)) {
            $this->seos[] = $seo;
            $seo->setAnnuary($this);
        }

        return $this;
    }

    public function removeSeo(Seo $seo): self
    {
        if ($this->seos->removeElement($seo)) {
            // set the owning side to null (unless already changed)
            if ($seo->getAnnuary() === $this) {
                $seo->setAnnuary(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDateEdit(): ?\DateTimeInterface
    {
        return $this->dateEdit;
    }

    public function setDateEdit(?\DateTimeInterface $dateEdit): self
    {
        $this->dateEdit = $dateEdit;

        return $this;
    }

    public function __toString()
    {
        return $this->url;
    }
}
