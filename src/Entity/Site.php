<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sites")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinTable(name="user")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keywords;

    /**
     * @ORM\OneToMany(targetEntity=Seo::class, mappedBy="site")
     */
    private $seos;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getEditDate(): ?\DateTimeInterface
    {
        return $this->editDate;
    }

    public function setEditDate(\DateTimeInterface $editDate): self
    {
        $this->editDate = $editDate;

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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return Collection<int, Seo>
     */
    public function getAnnuaries(): Collection
    {
        return $this->seos;
    }

    public function addSeo(Seo $Seo): self
    {
        if (!$this->seos->contains($Seo)) {
            $this->seos[] = $Seo;
            $Seo->setSite($this);
        }

        return $this;
    }

    public function removeSeo(Seo $seo): self
    {
        if ($this->seos->removeElement($seo)) {
            // set the owning side to null (unless already changed)
            if ($seo->getSite() === $this) {
                $seo->setSite(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->url;
    }
}
