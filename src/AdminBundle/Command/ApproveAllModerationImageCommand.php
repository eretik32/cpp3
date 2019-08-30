<?php

namespace AdminBundle\Command;

use CoreBundle\Entity\Image;
use CoreBundle\Entity\ImageModeration;
use CoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApproveAllModerationImageCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('image_moderation:approve:all')
            ->setDescription('Approve all image moderation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this
            ->getContainer()
            ->get('doctrine.orm.entity_manager');

        $products = $entityManager
            ->getRepository('CoreBundle:Product')
            ->findAll();

        /** @var Product $product */
        foreach ($products as $product) {
            $moderationImages = $product->getImageModeration();

            /** @var ImageModeration $moderationImage */
            foreach ($moderationImages as $moderationImage) {
                $image = new Image();

                $image->setProduct(
                    $moderationImage->getProduct()
                );
                $image->setTypeimage(
                    $moderationImage->getTypeimage()
                );
                $image->setPictureUrl(
                    $moderationImage->getPictureUrl()
                );
                $image->setSize(
                    $moderationImage->getSize()
                );
                $image->setWidth(
                    $moderationImage->getWidth()
                );
                $image->setLength(
                    $moderationImage->getLength()
                );

                $entityManager->persist($image);
                $entityManager->remove($moderationImage);
            }
        }

        $entityManager->flush();
    }

}
