<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ImageRepository")
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
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product", inversedBy = "images")
     */

    private $product;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TypeImage" , inversedBy = "TypeImage")
     *
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */

    private $image;


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
     * Set product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return Image
     */
    public function setProduct(\CoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \CoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set image
     *
     * @param \CoreBundle\Entity\TypeImage $image
     *
     * @return Image
     */
    public function setImage(\CoreBundle\Entity\TypeImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \CoreBundle\Entity\TypeImage
     */
    public function getImage()
    {
        return $this->image;
    }
}
