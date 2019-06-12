<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PictureRepository")
 */
class Image
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
     * @ORM\Column(name="picture_url", type="string", length=255)
     */
    private $pictureUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;


    /**
     * @var int
     *
     * @ORM\Column(name="length", type="integer")
     */

    private $length;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */

    private $width;

    /**
     * @var Product|null
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product")
     */

    private $productPicture;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TypePicture" , inversedBy = "TypePicture")
     *
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */

    private $type;


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
     * Set pictureUrl
     *
     * @param string $pictureUrl
     *
     * @return Image
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * Get pictureUrl
     *
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Image
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set length
     *
     * @param integer $length
     *
     * @return Image
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set productPicture
     *
     * @param \CoreBundle\Entity\Product $productPicture
     *
     * @return Image
     */
    public function setProductPicture(\CoreBundle\Entity\Product $productPicture = null)
    {
        $this->productPicture = $productPicture;

        return $this;
    }

    /**
     * Get productPicture
     *
     * @return \CoreBundle\Entity\Product
     */
    public function getProductPicture()
    {
        return $this->productPicture;
    }

    /**
     * Set type
     *
     * @param \CoreBundle\Entity\TypePicture $type
     *
     * @return Image
     */
    public function setType(\CoreBundle\Entity\TypePicture $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CoreBundle\Entity\TypePicture
     */
    public function getType()
    {
        return $this->type;
    }
}
