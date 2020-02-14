<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuildingRepository")
 */
class Building
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domain", inversedBy="buildings")
     */
    private $domain;

    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     */
    private $buildTime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $buildable;


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

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getBuildTime(): ?\DateInterval
    {
        return $this->buildTime;
    }

    public function setBuildTime(?\DateInterval $buildTime): self
    {
        $this->buildTime = $buildTime;

        return $this;
    }

    public function getBuildable(): ?int
    {
        return $this->buildable;
    }

    public function setBuildable(int $buildable): self
    {
        $this->buildable = $buildable;

        return $this;
    }


}
