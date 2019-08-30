<?php

namespace ApiBundle\Service;

use ApiBundle\Exception\FileNotMoveException;
use ApiBundle\Exception\FileSizeIsTooLargeException;
use ApiBundle\Exception\NotFoundRequireParameterException;
use ApiBundle\Exception\TooMuchUploadFilesException;
use ApiBundle\Exception\WrongFileExtensionException;
use CoreBundle\Entity\ImageModeration;
use CoreBundle\Entity\Product;
use CoreBundle\Entity\TypeImage;
use CoreBundle\Exception\NotFoundProductException;
use CoreBundle\Exception\NotFoundTypeImageException;
use CoreBundle\Service\TranslitHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class LoadImageModerationService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var TranslitHelper
     */
    protected $translitHelper;

    /**
     * @var string
     */
    protected $uploadDirectory;

    /**
     * @var array
     */
    protected $allowFileExtensions;

    /**
     * LoadImageModerationService constructor.
     *
     * @param $uploadDirectory
     * @param $allowFileExtensions
     * @param $maxImageSize
     * @param EntityManagerInterface $entityManager
     * @param TranslitHelper $translitHelper
     */
    public function __construct(
        $uploadDirectory,
        $allowFileExtensions,
        $maxImageSize,
        EntityManagerInterface $entityManager,
        TranslitHelper         $translitHelper
    ) {
        $this->uploadDirectory     = $uploadDirectory;
        $this->allowFileExtensions = $allowFileExtensions;
        $this->maxImageSize        = $maxImageSize;
        $this->entityManager       = $entityManager;
        $this->translitHelper      = $translitHelper;
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    public function processRequest(Request $request)
    {
        $this->checkParameters($request);

        $requestData = $this->extractParametersFromRequest($request);

        $imageModeration = $this->convertDataToImageModeration($requestData);

        /** @var UploadedFile $file */
        $file = array_shift($requestData['files']);

        if (
            !move_uploaded_file($file->getPathname(), $imageModeration->getPictureUrl())
        ) {
            throw new FileNotMoveException(
                'Fail move file to ' . $imageModeration->getPictureUrl() . ' path'
            );
        }

        $this->entityManager->persist($imageModeration);
        $this->entityManager->flush();

        return $imageModeration->getId();
    }

    /**
     * @param $requestData
     *
     * @return ImageModeration
     */
    protected function convertDataToImageModeration($requestData)
    {
        $path = $this->createDirectory($requestData['product']);

        /** @var UploadedFile $file */
        $file     = array_shift($requestData['files']);
        $fileName = $this->generateFileName($path, $file, $requestData['typeImage']);

        $size = getimagesize($file->getPathname());
        $widthImage  = $size[0];
        $heightImage = $size[1];

        $imageModeration = new ImageModeration();

        $imageModeration->setProduct($requestData['product']);
        if (!is_null($requestData['typeImage'])) {
            $imageModeration->setTypeimage($requestData['typeImage']);
        }

        $imageModeration->setPictureUrl($path . $fileName);
        $imageModeration->setSize($file->getClientSize());
        $imageModeration->setWidth($widthImage);
        $imageModeration->setLength($heightImage);

        return $imageModeration;
    }

    /**
     * @param $path
     * @param UploadedFile $file
     * @param TypeImage $typeImage
     *
     * @return string
     */
    protected function generateFileName($path, UploadedFile $file, $typeImage)
    {
        $fileName =
            $this->translitHelper->ruStringToEnglish(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            );

        if (!is_null($typeImage)) {
            $fileName .= '_' . $typeImage->getTitle();
        }

        $fileName .= '.' . $file->getClientOriginalExtension();

        if (!file_exists($path . $fileName)) {
            return $fileName;
        }

        $fileName =
            $this->translitHelper->ruStringToEnglish(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            );

        if (!is_null($typeImage)) {
            $fileName .= '_' . $typeImage->getTitle();
        }
        $fileName .= '_' . round(microtime(true));
        $fileName .= '.' . $file->getClientOriginalExtension();

        return $fileName;
    }

    /**
     * @param Product $product
     *
     * @return string
     */
    protected function createDirectory(Product $product)
    {
        $folderName = $this->translitHelper->ruStringToEnglish(
            $product->getTitle()
        );

        $path = $this->uploadDirectory . '/' . $folderName . '/';

        if (!file_exists($path)) {
            mkdir($path, 0700, true);
        }

        return $path;
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function extractParametersFromRequest(Request $request)
    {
        $requestData = $request->query->all();
        $requestData = array_merge(
            $requestData,
            $request->request->all()
        );

        if (!empty($request->files)) {
            $requestData['files'] = $request->files->all();
        }

        if (!empty($requestData['productId'])) {
            $requestData['product'] = $this
                ->entityManager
                ->getRepository('CoreBundle:Product')
                ->find($requestData['productId']);
        }

        if (!empty($requestData['typeImageId'])) {
            $requestData['typeImage'] = $this
                ->entityManager
                ->getRepository('CoreBundle:TypeImage')
                ->find($requestData['typeImageId']);
        }

        return $requestData;
    }

    /**
     * @param Request $request
     */
    protected function checkParameters(Request $request)
    {
        $requestData = $this->extractParametersFromRequest($request);

        if (empty($requestData['productId'])) {
            throw new NotFoundRequireParameterException(
                'Not found productId parameter'
            );
        }

        if (empty($requestData['files'])) {
            throw new NotFoundRequireParameterException(
                'Not found file for upload parameter'
            );
        }

        if (
            !empty($requestData['files'])
            && count($requestData['files']) > 1
        ) {
            throw new TooMuchUploadFilesException(
                'Too much file for upload. File should be one'
            );
        }

        /** @var UploadedFile $file */
        $file = array_shift($requestData['files']);

        if ($file->getClientSize() > $this->maxImageSize) {
            throw new FileSizeIsTooLargeException(
                'File size is too large. Maximum size is '
                . $this->maxImageSize . ' byte'
            );
        }

        if (!in_array($file->getClientOriginalExtension(), $this->allowFileExtensions)) {
            throw new WrongFileExtensionException(
                'File have wrong extension. Allow extension are '
                . implode(', ', $this->allowFileExtensions)
            );
        }

        if (
            key_exists('product', $requestData)
            && is_null($requestData['product'])
        ) {
            throw new NotFoundProductException(
                "Product with this id doesn't exists"
            );
        }

        if (
            key_exists('typeImage', $requestData)
            && is_null($requestData['typeImage'])
        ) {
            throw new NotFoundTypeImageException(
                "Type image with this id doesn't exists"
            );
        }
    }
}