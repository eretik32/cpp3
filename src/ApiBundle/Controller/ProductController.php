<?php


namespace ApiBundle\Controller;

use CoreBundle\CoreBundle;
use CoreBundle\Entity\Category;
use CoreBundle\Entity\Product;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\ViewHandler;


class ProductController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/product/")
     */
    public function getProduct()
    {
        $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->findAll();
        if ($product === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $product;
    }

    /**
     * @Rest\Post("/api/product/")
     * @param Request $request
     * @return View
     */
    public function setProduct(Request $request)
    {
        $data = new Product;

        $title = $request->get('title', 'product 4');
        $category_id = $request->get('category_id', 4);
        $category = $this->getDoctrine()->getRepository('CoreBundle:Category')->find($category_id);

        if (empty($title) || empty($category)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setTitle($title);
        $data->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Product Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("api/product/{id}")
     */
    public function updateProduct($id, Request $request)
    {
//        $data = new Product();
        $name = $request->get('title');


        $category_id = $request->get('category_id');
        $category = $this->getDoctrine()->getRepository('CoreBundle:Category')->find($category_id);

        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->find($id);
        if (empty($product)) {
            return new View("product not found", Response::HTTP_NOT_FOUND);
        }
        elseif (!empty($name) && !empty($category)) {
            $product->setTitle($name);
            $product->setCategory($category);
            $sn->flush();
            return new View("product Updated Successfully", Response::HTTP_OK);
        }
        elseif (empty($name) && !empty($category)) {
            $product->setCategory($category);
            $sn->flush();
            return new View("category Updated Successfully", Response::HTTP_OK);
        }
        elseif (!empty($name) && empty($category)) {
            $product->setTitle($name);
            $sn->flush();
            return new View("name Updated Successfully", Response::HTTP_OK);
        }
        else return new View("name or category cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("api/product/{id}")
     */
    public function deleteAction($id)
    {
        $data = new Product;
        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->find($id);
        if (empty($product)) {
            return new View("product not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($product);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}