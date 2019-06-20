<?php

namespace AdminBundle\Controller;

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
    public function adminAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('@Admin/Admin/index.html.twig', [
//            'products' => $products
        ]);
    }

//    public function getAction()
//    {
//        $restresult = $this->getDoctrine()->getRepository('CoreBundle:Product')->findAll();
//        if ($restresult === null) {
//            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
//        }
//        print_r($restresult);
//        return $restresult;
//    }

//    public function postAction(Request $request)
//    {
//        $data = new Product();
//        $title = $request->get('title');
//        $category = $request->get('category');
//        if(empty($name) || empty($role))
//        {
//            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
//        }
//        $data->setTitle($title);
//        $data->setCategory($category);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($data);
//        $em->flush();
//        return new View("User Added Successfully", Response::HTTP_OK);
//    }
}
