<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

//class DefaultController extends Controller
//{
//    /**
//     * @Route("/coreBundle")
//     */
//    public function indexAction()
//    {
//        return $this->render('CoreBundle:Default:index.html.twig');
//    }
//}

class DefaultController extends Controller
{
    /**
     * @Route("/",)
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}