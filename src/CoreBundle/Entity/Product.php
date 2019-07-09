<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Category", inversedBy="product")
     *
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */

    private $category;

    /**
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Image", mappedBy="product")
     *
     * @ORM\JoinColumn(name="images_product", referencedColumnName="id")
     */

    private $images;

    /**
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\ImageModeration", mappedBy="product")
     *
     * @ORM\JoinColumn(name="images_product", referencedColumnName="id")
     */

    private $imageModeration;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->imageModeration = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set category
     *
     * @param \CoreBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\CoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CoreBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add image
     *
     * @param \CoreBundle\Entity\Image $image
     *
     * @return Product
     */
    public function addImage(\CoreBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \CoreBundle\Entity\Image $image
     */
    public function removeImage(\CoreBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add imageModeration
     *
     * @param \CoreBundle\Entity\ImageModeration $imageModeration
     *
     * @return Product
     */
    public function addImageModeration(\CoreBundle\Entity\ImageModeration $imageModeration)
    {
        $this->imageModeration[] = $imageModeration;

        return $this;
    }

    /**
     * Remove imageModeration
     *
     * @param \CoreBundle\Entity\ImageModeration $imageModeration
     */
    public function removeImageModeration(\CoreBundle\Entity\ImageModeration $imageModeration)
    {
        $this->imageModeration->removeElement($imageModeration);
    }

    /**
     * Get imageModeration
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImageModeration()
    {
        return $this->imageModeration;
    }
}
