<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *@ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @var float|null
     *
     * @ORM\Column(name="basePrice", type="float", precision=10, scale=0, nullable=true)
     */
    private $baseprice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="brand", type="string", length=36, nullable=true)
     */
    private $brand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="category", type="string", length=11, nullable=true)
     */
    private $category;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delivery", type="string", length=24, nullable=true)
     */
    private $delivery;

    /**
     * @var string|null
     *
     * @ORM\Column(name="details", type="string", length=90, nullable=true)
     */
    private $details;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imageUrl", type="string", length=54, nullable=true)
     */
    private $imageurl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productMaterial", type="string", length=8, nullable=true)
     */
    private $productmaterial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productName", type="string", length=29, nullable=true)
     */
    private $productname;
    /**
     * @var \Review
     *
     * @ORM\ManyToOne(targetEntity="Review")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn( referencedColumnName="id")
     * })
     */
    private $reviews;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return float|null
     */
    public function getBaseprice(): ?float
    {
        return $this->baseprice;
    }

    /**
     * @param float|null $baseprice
     */
    public function setBaseprice(?float $baseprice): void
    {
        $this->baseprice = $baseprice;
    }

    /**
     * @return null|string
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param null|string $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return null|string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param null|string $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return null|string
     */
    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    /**
     * @param null|string $delivery
     */
    public function setDelivery(?string $delivery): void
    {
        $this->delivery = $delivery;
    }

    /**
     * @return null|string
     */
    public function getDetails(): ?string
    {
        return $this->details;
    }

    /**
     * @param null|string $details
     */
    public function setDetails(?string $details): void
    {
        $this->details = $details;
    }

    /**
     * @return null|string
     */
    public function getImageurl(): ?string
    {
        return $this->imageurl;
    }

    /**
     * @param null|string $imageurl
     */
    public function setImageurl(?string $imageurl): void
    {
        $this->imageurl = $imageurl;
    }

    /**
     * @return null|string
     */
    public function getProductmaterial(): ?string
    {
        return $this->productmaterial;
    }

    /**
     * @param null|string $productmaterial
     */
    public function setProductmaterial(?string $productmaterial): void
    {
        $this->productmaterial = $productmaterial;
    }

    /**
     * @return null|string
     */
    public function getProductname(): ?string
    {
        return $this->productname;
    }

    /**
     * @param null|string $productname
     */
    public function setProductname(?string $productname): void
    {
        $this->productname = $productname;
    }

    /**
     * @return \Review
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param \Review $reviews
     */
    public function setReviews( $reviews): void
    {
        $this->reviews = $reviews;
    }


}
