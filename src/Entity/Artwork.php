<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtworkRepository;

/**
 * @ORM\Entity(repositoryClass=ArtworkRepository::class)
 *
 * @ORM\HasLifecycleCallbacks
 */
 
class Artwork
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $globalRate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl;

    /**
     * @ORM\ManyToMany(targetEntity=DiscussionTheme::class, inversedBy="artworks")
     */
    private $discussionTheme;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="artworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->discussionTheme = new ArrayCollection();
    }


    /**
     * Permet d'initialiser le slug
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug(){
        
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getGlobalRate(): ?int
    {
        return $this->globalRate;
    }

    public function setGlobalRate(?int $globalRate): self
    {
        $this->globalRate = $globalRate;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection|DiscussionTheme[]
     */
    public function getDiscussionTheme(): Collection
    {
        return $this->discussionTheme;
    }

    /**
     * Permet d'ajouter les thèmes globaux
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function setGlobalTheme(){
        
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }


    public function addDiscussionTheme(DiscussionTheme $discussionTheme): self
    {
        if (!$this->discussionTheme->contains($discussionTheme)) {
            $this->discussionTheme[] = $discussionTheme;
        }

        return $this;
    }

    public function removeDiscussionTheme(DiscussionTheme $discussionTheme): self
    {
        if ($this->discussionTheme->contains($discussionTheme)) {
            $this->discussionTheme->removeElement($discussionTheme);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
