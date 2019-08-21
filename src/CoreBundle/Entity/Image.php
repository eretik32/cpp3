<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ImageRepository")
 */
class Image extends SuperImage
{

    /**
     * @var Product|null
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product", inversedBy = "images")
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */

    public $product;

    /**
     * @var typeimage|null
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TypeImage" , inversedBy = "image")
     * @ORM\JoinColumn(name="type_image", referencedColumnName="id")
     */

    public $typeimage;


    /**
     * Set product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return Image
     */


    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Research", inversedBy = "images")
     */
    public $research;


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
     * Set typeimage
     *
     * @param \CoreBundle\Entity\TypeImage $typeimage
     *
     * @return Image
     */
    public function setTypeimage(\CoreBundle\Entity\TypeImage $typeimage = null)
    {
        $this->typeimage = $typeimage;

        return $this;
    }

    /**
     * Get typeimage
     *
     * @return \CoreBundle\Entity\TypeImage
     */
    public function getTypeimage()
    {
        return $this->typeimage;
    }
    

    /**
     * Set research.
     *
     * @param \AdminBundle\Entity\Research|null $research
     *
     * @return Image
     */
    public function setResearch(\AdminBundle\Entity\Research $research = null)
    {
        $this->research = $research;

        return $this;
    }

    /**
     * Get research.
     *
     * @return \AdminBundle\Entity\Research|null
     */
    public function getResearch()
    {
        return $this->research;
    }
}
