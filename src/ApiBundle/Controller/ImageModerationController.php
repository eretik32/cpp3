<?php

namespace ApiBundle\Controller;

use ApiBundle\Exception\FileNotMoveException;
use ApiBundle\Exception\FileSizeIsTooLargeException;
use ApiBundle\Exception\NotFoundRequireParameterException;
use ApiBundle\Exception\WrongFileExtensionException;
use ApiBundle\Service\LoadImageModerationService;
use CoreBundle\Exception\NotFoundProductException;
use CoreBundle\Exception\NotFoundTypeImageException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class ImageModerationController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/image-moderation/")
     */
    public function getImageModerationAction()
    {
//        $data = new LoadImageModerationService();
//        $data->TestScript();

        return new View("successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/api/image-moderation/")
     * @param Request $request
     * @return JsonResponse
     */
    public function createImageModerationAction(Request $request)
    {
        /** @var LoadImageModerationService $loadImageModerationService */
        $loadImageModerationService = $this->container->get('load_image_moderation');

        try {
            $loadImageModerationService->processRequest($request);

            return new JsonResponse([
                'message' => 'file uploaded successfully'
            ]);
        } catch (NotFoundProductException $exception) {

            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 423);
        } catch (NotFoundTypeImageException $exception) {

            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 423);
        } catch (WrongFileExtensionException $exception) {

            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 423);
        } catch (FileSizeIsTooLargeException $exception) {

            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 423);
        } catch (NotFoundRequireParameterException $exception) {

            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 423);
        } catch (FileNotMoveException $exception) {

            return new JsonResponse([
                'message' => 'Something went wrong'
            ], 500);
        } catch (\Throwable $exception) {

            return new JsonResponse([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}

