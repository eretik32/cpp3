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
     * @var Image|null
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Image", mappedBy="image")
     *
     */

    private $TypeImage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->TypeImage = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add typeImage
     *
     * @param \CoreBundle\Entity\Image $typeImage
     *
     * @return TypeImage
     */
    public function addTypeImage(\CoreBundle\Entity\Image $typeImage)
    {
        $this->TypeImage[] = $typeImage;

        return $this;
    }

    /**
     * Remove typeImage
     *
     * @param \CoreBundle\Entity\Image $typeImage
     */
    public function removeTypeImage(\CoreBundle\Entity\Image $typeImage)
    {
        $this->TypeImage->removeElement($typeImage);
    }

    /**
     * Get typeImage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeImage()
    {
        return $this->TypeImage;
    }
}
