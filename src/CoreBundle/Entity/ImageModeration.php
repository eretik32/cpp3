<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImageModeration
 *
 * @ORM\Table(name="ImageModeration")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ImageModerationRepository")
 */

class ImageModeration extends Image
{
}
