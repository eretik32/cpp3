<?php

namespace AdminBundle\Controller;

use CoreBundle\Entity\Image;
use CoreBundle\Entity\ImageModeration;
use CoreBundle\Entity\Product;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Controller\ProductController;


class AdminController extends AbstractFOSRestController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function getAdminAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $products = $this->getDoctrine()->getRepository('CoreBundle:Product')->findAll();

        $imageModer = $this->getDoctrine()->getRepository('CoreBundle:ImageModeration')->findAll();

        return $this->render('@Admin/Admin/index.html.twig', [
            'products' => $products,
            'ImageModer' => $imageModer
        ]);
    }

    /**
     * @Route("/admin/remove/{id}", name="remove_image")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function RemoveImageModerationAction(Product $product)
    {
        // удалить
        $productId = $product->getId();
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(ImageModeration::class)->findBy(
            [
                'product' => $productId
            ]);
        foreach ($repository as $rep) {
            $dirNamePath = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'web'; // путь к папки web
            $pathImg = $dirNamePath . DIRECTORY_SEPARATOR . $rep->getPictureUrl(); //полный путь к картинке
            if (file_exists($pathImg)) {
                echo $rep->getPictureUrl();
                unlink($pathImg);
                $em->remove($rep);
            }
            $em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/add/{id}", name="add_image")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function AddImageAction(Product $product)
    {
        $productId = $product->getId();
        $repositoryModerImg = $this->getDoctrine()->getRepository(ImageModeration::class)->findBy(
            [
                'product' => $productId
            ]);
        $em = $this->getDoctrine()->getManager();
//TUDO: Удалять модерируемые фото
        foreach ($repositoryModerImg as $rep) {
            $data = new Image();
            $productImg = $rep->getProduct();
            $typeimage = $rep->getTypeimage();
            $pictureUrl = $rep->getPictureUrl();
            $size = $rep->getSize();
            $width = $rep->getWidth();
            $length = $rep->getLength();

            $data->setProduct($productImg);
            $data->setTypeimage($typeimage);
            $data->setPictureUrl($pictureUrl);
            $data->setSize($size);
            $data->setWidth($width);
            $data->setLength($length);

            $em->persist($data);
        }
        $em->flush();
        die();
    }
}
