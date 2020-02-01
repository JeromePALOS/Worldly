<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $x;

    /**
     * @ORM\Column(type="integer")
     */
    private $y;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRegion", inversedBy="regions")
     */
    private $TypeRegion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Server", inversedBy="regions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $server;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StateRegion", mappedBy="region", cascade={"persist", "remove"})
     */
    private $stateRegion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $spawnable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getTypeRegion(): ?TypeRegion
    {
        return $this->TypeRegion;
    }

    public function setTypeRegion(?TypeRegion $TypeRegion): self
    {
        $this->TypeRegion = $TypeRegion;

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

    public function getStateRegion(): ?StateRegion
    {
        return $this->stateRegion;
    }

    public function setStateRegion(StateRegion $stateRegion): self
    {
        $this->stateRegion = $stateRegion;

        // set the owning side of the relation if necessary
        if ($stateRegion->getRegion() !== $this) {
            $stateRegion->setRegion($this);
        }

        return $this;
    }

    public function getSpawnable(): ?bool
    {
        return $this->spawnable;
    }

    public function setSpawnable(?bool $spawnable): self
    {
        $this->spawnable = $spawnable;

        return $this;
    }
}
