<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class CategoryController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/category/")
     */
    public function getCategoryAction()
    {
        $product = $this->getDoctrine()->getRepository('CoreBundle:Category')->findAll();
        if ($product === null) {
            return new View("there are no category exist", Response::HTTP_NOT_FOUND);
        }
        return $product;
    }

    /**
     * @Rest\Post("/api/category/")
     * @param Request $request
     * @return View
     */
    public function setCategoryAction(Request $request)
    {
        $data = new Category();
        $category_title = $request->get('category_title');


        if (empty($category_title)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setCategoryTitle($category_title);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("category added successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("api/category/{id}")
     * @param $id
     * @param Request $request
     * @return View
     */
    public function updateCategoryAction($id, Request $request)
    {
        $category_title = $request->get('category_title');

        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Category')->find($id);
        if (empty($product)) {
            return new View("category not found", Response::HTTP_NOT_FOUND);
        }
        elseif (!empty($category_title)){
            $product->setCategoryTitle($category_title);
            $sn->flush();
            return new View("category updated successfully", Response::HTTP_OK);
        }
        else return new View("category name cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }
    /**
     * @Rest\Delete("api/category/{id}")
     */
    public function deleteCategoryAction($id)
    {
        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Category')->find($id);
        if (empty($product)) {
            return new View("category not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($product);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}