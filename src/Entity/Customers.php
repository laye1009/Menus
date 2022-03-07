<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity
 */
class Customers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=150, nullable=false)
     */
    private $avatar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="join_date", type="datetime", nullable=false)
     */
    private $joinDate;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="customer", orphanRemoval=true)
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    // setters
    public function setFirstname($fn)
    {
        $this->firstName = $fn;
        return $this;

    }
    public function setLastname($fn)
    {
        $this->lastName = $fn;
        return $this;
        
    }
    public function setEmail($fn)
    {
        $this->email = $fn;
        return $this;
    }
    public function setPassword($fn)
    {
        $this->password = $fn;
        return $this;

        
    }
    public function setAvatar($fn)
    {
        $this->avatar = $fn;
        return $this;
        
    }
    public function setJoinDate($fn)
    {
        $this->joinDate = $fn;
        return $this;
        
    }

    // getters

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEamil()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function getJoinDate()
    {
        return $this->joinDate;
    }


}
