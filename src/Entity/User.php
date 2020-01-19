<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\State", mappedBy="userCreator")
     */
    private $stateCreates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StateUser", mappedBy="user", orphanRemoval=true)
     */
    private $stateUsers;


    public function __construct()
    {
        parent::__construct();
        $this->states = new ArrayCollection();
        $this->stateUsers = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|StateCreates[]
     */
    public function getStateCreates(): Collection
    {
        return $this->stateCreates;
    }

    public function addStateCreates(State $stateCreates): self
    {
        if (!$this->stateCreates->contains($stateCreates)) {
            $this->stateCreates[] = $stateCreates;
            $stateCreates->setUserCreator($this);
        }

        return $this;
    }

    public function removeStateCreates(State $stateCreates): self
    {
        if ($this->stateCreates->contains($stateCreates)) {
            $this->stateCreates->removeElement($stateCreates);
            // set the owning side to null (unless already changed)
            if ($stateCreates->getUserCreator() === $this) {
                $stateCreates->setUserCreator(null);
            }
        }

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
            $stateUser->setUser($this);
        }

        return $this;
    }

    public function removeStateUser(StateUser $stateUser): self
    {
        if ($this->stateUsers->contains($stateUser)) {
            $this->stateUsers->removeElement($stateUser);
            // set the owning side to null (unless already changed)
            if ($stateUser->getUser() === $this) {
                $stateUser->setUser(null);
            }
        }

        return $this;
    }


}