<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecearchImage
 *
 * @ORM\Table(name="recearch_image")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\RecearchImageRepository")
 */
class RecearchImage
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
     * @var int
     *
     * @ORM\Column(name="idProduct", type="integer")
     */
    private $idProduct;

    /**
     * @var int
     *
     * @ORM\Column(name="idImage", type="integer")
     */
    private $idImage;
    

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idProduct.
     *
     * @param int $idProduct
     *
     * @return RecearchImage
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct.
     *
     * @return int
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set idImage.
     *
     * @param int $idImage
     *
     * @return RecearchImage
     */
    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * Get idImage.
     *
     * @return int
     */
    public function getIdImage()
    {
        return $this->idImage;
    }
}
