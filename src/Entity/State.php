<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StateRepository")
 */
class State
{
    
    public function __construct(){
		$this->dateCreate = new \Datetime();
        $this->userCreator = new ArrayCollection();
        $this->stateUsers = new ArrayCollection();
        $this->stateRegions = new ArrayCollection();		
	}
    
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="stateCreates")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StateUser", mappedBy="state", orphanRemoval=true)
     */
    private $stateUsers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Server", inversedBy="states")
     * @ORM\JoinColumn(nullable=false)
     */
    private $server;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StateRegion", mappedBy="state")
     */
    private $stateRegions;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
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

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

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

    public function getUserCreator(): ?User
    {
        return $this->userCreator;
    }

    public function setUserCreator(?User $userCreator): self
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    /**
     * @return Collection|StateUser[]
     */
    public function getStateUsers(): Collection
    {
        return $this->stateUsers;
    }

    public function addStateUser(StateUser $stateUser): self
    {
        if (!$this->stateUsers->contains($stateUser)) {
            $this->stateUsers[] = $stateUser;
            $stateUser->setState($this);
        }

        return $this;
    }

    public function removeStateUser(StateUser $stateUser): self
    {
        if ($this->stateUsers->contains($stateUser)) {
            $this->stateUsers->removeElement($stateUser);
            // set the owning side to null (unless already changed)
            if ($stateUser->getState() === $this) {
                $stateUser->setState(null);
            }
        }

        return $this;
    }

    public function getServer(): ?Server
    {
        return $this->server;
    }

    public function setServer(?Server $server): self
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return Collection|StateRegion[]
     */
    public function getStateRegions(): Collection
    {
        return $this->stateRegions;
    }

    public function addStateRegion(StateRegion $stateRegion): self
    {
        if (!$this->stateRegions->contains($stateRegion)) {
            $this->stateRegions[] = $stateRegion;
            $stateRegion->setState($this);
        }

        return $this;
    }

    public function removeStateRegion(StateRegion $stateRegion): self
    {
        if ($this->stateRegions->contains($stateRegion)) {
            $this->stateRegions->removeElement($stateRegion);
            // set the owning side to null (unless already changed)
            if ($stateRegion->getState() === $this) {
                $stateRegion->setState(null);
            }
        }

        return $this;
    }






}
