<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items", indexes={@ORM\Index(name="category", columns={"category"})})
 * @ORM\Entity
 */
class Items
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

    // setters
    public function setName($fn)
    {
        $this->name = $fn;
        return $this;

    }
    public function setDescription($fn)
    {
        $this->description = $fn;
        return $this;

    }
    public function setPrice($fn)
    {
        $this->price = $fn;
        return $this;

    }
    public function setImage($fn)
    {
        $this->image = $fn;
        return $this;

    }

    // les getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function Name()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @ORM\ManyToMany(targetEntity=Orders::class, mappedBy="item")
     */
    private $ordered;

    public function __construct()
    {
        $this->ordered = new ArrayCollection();
    }

    /**
     * @return Collection|Orders[]
     */
    public function getQuantite(): Collection
    {
        return $this->quantite;
    }

    public function addQuantite(Orders $quantite): self
    {
        if (!$this->quantite->contains($quantite)) {
            $this->quantite[] = $quantite;
            $quantite->addItem($this);
        }

        return $this;
    }

    public function removeQuantite(Orders $quantite): self
    {
        if ($this->quantite->removeElement($quantite)) {
            $quantite->removeItem($this);
        }

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrdered(): Collection
    {
        return $this->ordered;
    }

    public function addOrdered(Orders $ordered): self
    {
        if (!$this->ordered->contains($ordered)) {
            $this->ordered[] = $ordered;
            $ordered->addItem($this);
        }

        return $this;
    }

    public function removeOrdered(Orders $ordered): self
    {
        if ($this->ordered->removeElement($ordered)) {
            $ordered->removeItem($this);
        }

        return $this;
    }


}
