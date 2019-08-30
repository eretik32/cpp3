<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends AbstractFOSRestController
{
    /**
     * @SWG\Tag(name="product")
     *
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
     * @SWG\Response(
     *     response=200,
     *     description="product id",
     *     @SWG\Schema(
     *        type="object",
     *        example={"id": "11"}
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
     *     description="product title"
     * )
     * @SWG\Parameter(
     *     name="categoryId",
     *     in="query",
     *     type="int",
     *     description="category id"
     * )
     *
     * @SWG\Tag(name="product")
     *
     * @Rest\Post("/api/product/")
     * @param Request $request
     * @return JsonResponse
     */
    public function setProductAction(Request $request)
    {
        $product = new Product;

        $title      = $request->get('title', '');
        $categoryId = $request->get('categoryId', '');

        $category = $this
            ->getDoctrine()
            ->getRepository('CoreBundle:Category')
            ->find($categoryId);

        if (empty($title)) {
            return new JsonResponse([
                'message' => 'Not found title parameter'
            ], 423);
        }

        if (empty($categoryId)) {
            return new JsonResponse([
                'message' => 'Not found categoryId parameter'
            ], 423);
        }

        if (empty($category)) {
            return new JsonResponse([
                'message' => 'Product with this id doesn\'t exists'
            ], 423);
        }

        $product->setTitle($title);
        $product->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new JsonResponse([
            'id' => $product->getId()
        ]);
    }

    /**
     * @SWG\Tag(name="product")
     *
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
     * @SWG\Tag(name="product")
     *
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