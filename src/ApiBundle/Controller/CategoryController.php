<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends AbstractFOSRestController
{
    /**
     * @SWG\Tag(name="category")
     *
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
     * @SWG\Response(
     *     response=200,
     *     description="category id",
     *     @SWG\Schema(
     *        type="object",
     *        example={"id": "24"}
     *     )
     * )
     * @SWG\Response(
     *     response=423,
     *     description="Wrong input data",
     *     @SWG\Schema(
     *        type="object",
     *        example={"message": "text message"}
     *     )
     * )
     *
     * @SWG\Parameter(
     *     name="title",
     *     in="query",
     *     type="string",
     *     description="category title"
     * )
     *
     * @SWG\Tag(name="category")
     *
     * @Rest\Post("/api/category/")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setCategoryAction(Request $request)
    {
        $category = new Category();
        $category_title = $request->get('title');

        if (empty($category_title)) {
            return new JsonResponse([
                'message' => 'Not found title parameter'
            ], 423);
        }

        $category->setCategoryTitle($category_title);
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return new JsonResponse([
            'id' => $category->getId()
        ]);
    }

    /**
     * @SWG\Tag(name="category")
     *
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
     * @SWG\Tag(name="category")
     *
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