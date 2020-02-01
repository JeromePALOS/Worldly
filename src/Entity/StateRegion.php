<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StateRegionRepository")
 */
class StateRegion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="stateRegions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Region", inversedBy="stateRegion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(Region $region): self
    {
        $this->region = $region;

        return $this;
    }
}
