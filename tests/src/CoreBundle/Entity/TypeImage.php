<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePicture
 *
 * @ORM\Table(name="type_image")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TypeImageRepository")
 */
class TypeImage
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
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Image", mappedBy="typeimage")
     *
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */

    public $image;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\ImageModeration", mappedBy="typeimage")
     *
     * @ORM\JoinColumn(name="image_moderation", referencedColumnName="id")
     */

    public $imageModeration;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return TypeImage
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
     * Add image
     *
     * @param \CoreBundle\Entity\Image $image
     *
     * @return TypeImage
     */
    public function addImage(\CoreBundle\Entity\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \CoreBundle\Entity\Image $image
     */
    public function removeImage(\CoreBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add imageModeration
     *
     * @param \CoreBundle\Entity\ImageModeration $imageModeration
     *
     * @return TypeImage
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
