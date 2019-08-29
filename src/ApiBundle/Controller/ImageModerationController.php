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
use Swagger\Annotations as SWG;

class ImageModerationController extends AbstractFOSRestController
{
    /**
     * @SWG\Tag(name="image-moderation")
     *
     * @Rest\Get("/api/image-moderation/")
     */
    public function getImageModerationAction()
    {
        return new View("successfully", Response::HTTP_OK);
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="File uploaded successfully",
     *     @SWG\Schema(
     *        type="object",
     *        example={"message": "File uploaded successfully"}
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
     * @SWG\Response(
     *     response=500,
     *     description="Something went wrong",
     *     @SWG\Schema(
     *        type="object",
     *        example={"message": "Something went wrong"}
     *     )
     * )
     *
     * @SWG\Parameter(
     *     name="productId",
     *     in="query",
     *     type="int",
     *     description="Product id"
     * )
     * @SWG\Parameter(
     *     name="typeImageId",
     *     in="query",
     *     type="int",
     *     description="TypeImage id"
     * )
     * @SWG\Parameter(
     *     name="file",
     *     in="query",
     *     type="file",
     *     description="File for upload"
     * )
     *
     * @SWG\Tag(name="image-moderation")
     *
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
                'message' => 'File uploaded successfully'
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

