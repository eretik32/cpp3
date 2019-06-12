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
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */

    private $category;

    /**
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Image", mappedBy="productPicture")
     *
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id")
     */

    private $picture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->picture = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add picture
     *
     * @param \CoreBundle\Entity\Image $picture
     *
     * @return Product
     */
    public function addPicture(\CoreBundle\Entity\Image $picture)
    {
        $this->picture[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \CoreBundle\Entity\Image $picture
     */
    public function removePicture(\CoreBundle\Entity\Image $picture)
    {
        $this->picture->removeElement($picture);
    }

    /**
     * Get picture
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
