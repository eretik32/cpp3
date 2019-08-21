<?php


namespace ApiBundle\Controller;

use ApiBundle\Service\LoadImageModerationService;
use CoreBundle\Entity\ImageModeration;
use CoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Psr\Log\LoggerInterface;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImageModerController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/imageModeration/")
     */
    public function getImageModerationAction()
    {
//        $data = new LoadImageModerationService();
//        $data->TestScript();
//
        return new View("successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/api/imageModeration/")
     * @param Request $request
     * @return View
     */
    public function createImageModerationAction(Request $request)
    {
        /** @var LoadImageModerationService $loadImageModerationService */
//        $loadImageModerationService = $this->container->get('load_image_moderation');
        $loadImageModerationService = $this->container->get('load_image_moderation');

        try {
            $loadImageModerationService->processRequest($request);
        } catch (\Throwable $exception) {
            $r = 1;





//            return new JsonResponse([
//                'message' => 'Error'
//            ], 423);
        }



        /**
         * перенести все в сервис
         */

        /**
         * внедрить exception
         */

        /**
         * Запрос который отдается нужно поменять
         */

//        /** @var AttributeValue $attributeValue */
//        $attributeValue = $this->admin->getSubject();
//
//        /** @var GlobalAttributeService $globalAttributeService */
//        $globalAttributeService = $this->container->get('global_attribute');
//
//        try {
//            $globalAttributeService->dismissValue($attributeValue);
//        } catch (AttributeNotHaveRequestOnApproveException $exception) {
//
//            return new JsonResponse([
//                'message' => $exception->getMessage()
//            ], 423);
//        } catch (AttributeApprovedException $exception) {
//
//            return new JsonResponse([
//                'message' => $exception->getMessage()
//            ], 423);
//        } catch (\Throwable $exception) {
//
//            return new JsonResponse([
//                'message' => 'Error'
//            ], 423);
//        }
//
//        return new JsonResponse([
//            'message' => 'Rejected'
//        ]);
    }
}

