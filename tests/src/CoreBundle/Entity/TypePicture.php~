<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePicture
 *
 * @ORM\Table(name="type_picture")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TypePictureRepository")
 */
class TypePicture
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
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Image", mappedBy="type")
     *
     */

    private $TypePicture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->TypePicture = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return TypePicture
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
     * Add typePicture
     *
     * @param \CoreBundle\Entity\Image $typePicture
     *
     * @return TypePicture
     */
    public function addTypePicture(\CoreBundle\Entity\Image $typePicture)
    {
        $this->TypePicture[] = $typePicture;

        return $this;
    }

    /**
     * Remove typePicture
     *
     * @param \CoreBundle\Entity\Image $typePicture
     */
    public function removeTypePicture(\CoreBundle\Entity\Image $typePicture)
    {
        $this->TypePicture->removeElement($typePicture);
    }

    /**
     * Get typePicture
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypePicture()
    {
        return $this->TypePicture;
    }
}
