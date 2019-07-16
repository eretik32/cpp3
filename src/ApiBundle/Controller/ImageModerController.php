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
     * @param Product $product
     * @return View
     */
    public function CreateImageModerationAction(Request $request)
    {
        try {
            if (isset($_FILES['datafile'])) {
                $fileName = $_FILES['datafile']['name'];
                $fileNameActual = strtolower($fileName);
                $fileTmp = $_FILES['datafile']['tmp_name'];
                $fileSize = $_FILES['datafile']['size'];

                //get Width Height images
                $size = getimagesize($_FILES['datafile']['tmp_name']);
                $widthImage = $size[0];
                $heightImage = $size[1];

                $fileType = $_FILES['datafile']['type'];
                $fileExt = explode('/', $fileType);
                $fileTypeActualExt = strtolower(end($fileExt));
                $allowed = array("jpg", "jpeg", "png");

                $fileDir = "uploads/";
                $fileDirNew = $fileDir . $fileNameActual . "/";

                $product_id = $_POST['productId'];
                $type_image = $_POST['typeImage'];

                $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->find($product_id);
                $type = $this->getDoctrine()->getRepository('CoreBundle:TypeImage')->find($type_image);
                $typeTitle = $type->getTitle();
                echo $typeTitle;
                $data = new ImageModeration();
                if (empty($product) || empty($type)) {
                    return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
                }

                //  Проверка на допустимый тип файла и размер до 20 Mb
                if (in_array($fileTypeActualExt, $allowed) || $fileSize < 200000) {

                    //проверка существования директории
                    if (file_exists($fileDirNew)) {
                        echo "директория существует";
                    } else {
                        echo "создали новую директорию";
                        mkdir($fileDirNew, 0700, true);
                    }
                    $file = $fileDirNew . $fileNameActual . "_" . $typeTitle . "." . $fileTypeActualExt;

                    //Проверка на уникальность имени файла если такой существует переименовываем его

                    if (file_exists($file)) {
                        echo "Файл сохреннен с новым именем";
                        $fileDestinationRename = $fileDirNew . $fileNameActual . "_" . $typeTitle . "_" . round(microtime(true)) . "." . $fileTypeActualExt;
                        echo $fileDestinationRename;
                        move_uploaded_file($fileTmp, $fileDestinationRename);

                        // Создаем обьект image Сохраняем в БД картинку
                        $data->setProduct($product);
                        $data->setTypeimage($type);
                        $data->setPictureUrl($fileDestinationRename);
                        $data->setSize($fileSize);
                        $data->setWidth($widthImage);
                        $data->setLength($heightImage);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($data);
                        $em->flush();
                    } else {
                        echo "Файл успешно создан";
                        move_uploaded_file($fileTmp, $file);
                        // Создаем обьект image Сохраняем в БД картинку
                        $data->setProduct($product);
                        $data->setTypeimage($type);
                        $data->setPictureUrl($file);
                        $data->setSize($fileSize);
                        $data->setWidth($widthImage);
                        $data->setLength($heightImage);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($data);
                        $em->flush();
                    }
                } else {
                    echo 'Файл неверного типа или слишком большой';
                }
            }
            return new View("successfully", Response::HTTP_OK);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

