<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class ProductController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/product/")
     */
    public function getProductAction()
    {
        $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->findAll();
        if ($product === null) {
            return new View("there are no product exist", Response::HTTP_NOT_FOUND);
        }
        return $product;
    }

    /**
     * @Rest\Post("/api/product/")
     * @param Request $request
     * @return View
     */
    public function setProductAction(Request $request)
    {
        $data = new Product;

        $title = $request->get('title');
        $category_id = $request->get('category');
        $category = $this->getDoctrine()->getRepository('CoreBundle:Category')->find($category_id);

        if (empty($title) || empty($category)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setTitle($title);
        $data->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("product added successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("api/product/{id}")
     * @param $id
     * @param Request $request
     * @return View
     */
    public function updateProductAction($id, Request $request)
    {
        $name = $request->get('title');
        $category_id = $request->get('category');
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
            return new View("product updated successfully", Response::HTTP_OK);
        }
        elseif (empty($name) && !empty($category)) {
            $product->setCategory($category);
            $sn->flush();
            return new View("category updated successfully", Response::HTTP_OK);
        }
        elseif (!empty($name) && empty($category)) {
            $product->setTitle($name);
            $sn->flush();
            return new View("name updated successfully", Response::HTTP_OK);
        }
        else return new View("name or category cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("api/product/{id}")
     */
    public function deleteActionAction($id)
    {
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