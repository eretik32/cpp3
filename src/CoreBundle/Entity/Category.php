<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_title", type="string", length=255)
     */
    public $category_title;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Product", mappedBy="category")
     *
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */
    public $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoryTitle
     *
     * @param string $categoryTitle
     *
     * @return Category
     */
    public function setCategoryTitle($categoryTitle)
    {
        $this->category_title = $categoryTitle;

        return $this;
    }

    /**
     * Get categoryTitle
     *
     * @return string
     */
    public function getCategoryTitle()
    {
        return $this->category_title;
    }

    /**
     * Add product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return Category
     */
    public function addProduct(\CoreBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \CoreBundle\Entity\Product $product
     */
    public function removeProduct(\CoreBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->product;
    }
}
