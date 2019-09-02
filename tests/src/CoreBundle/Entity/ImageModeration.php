<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImageModeration
 * @ORM\Table(name="image_moderation")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ImageModerationRepository")
 */

class ImageModeration extends SuperImage
{
    /**
     * @var Product|null
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product", inversedBy = "imageModeration")
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */

    public $product;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TypeImage", inversedBy = "imageModeration")
     * @ORM\JoinColumn(name="type_image", referencedColumnName="id")
     */
    public $typeimage;

    /**
     * Set product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return ImageModeration
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
     * @return string
     */
    public function getTypeimage()
    {
        return $this->typeimage;
    }

    /**
     * @param string $typeimage
     */
    public function setTypeimage($typeimage)
    {
        $this->typeimage = $typeimage;
    }

}
