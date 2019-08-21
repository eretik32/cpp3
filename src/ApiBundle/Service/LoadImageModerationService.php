<?php

namespace ApiBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class LoadImageModerationService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * LoadImageModerationService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function processRequest(Request $request)
    {
        /**
         * Проверка входных параметров
         */

        /**
         *
         */

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

                $product_id = $_POST['productId'];
                $type_image = $_POST['typeImage'];
                $fileDir = "uploads/";

//                Переводим имя продукта в транслит
                function translit($product_name)
                {
                    $s = (string)$product_name; // преобразуем в строковое значение
                    $s = trim($s); // убираем пробелы в начале и конце строки
                    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр
                    $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
                    return $s; // возвращаем результат
                }

                $product = $this->getDoctrine()->getRepository('CoreBundle:Product')->find($product_id);
                $product_name = $product->getTitle();
                $fileDirNew = $fileDir . translit($product_name) . "/";
                $type = $this->getDoctrine()->getRepository('CoreBundle:TypeImage')->find($type_image);
                $typeTitle = $type->getTitle();
                $data = new ImageModeration();
                if (empty($product) || empty($type)) {
                    return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
                }

                //  Проверка на допустимый тип файла и размер до 20 Mb
                if (in_array($fileTypeActualExt, $allowed) || $fileSize < 200000) {

                    //проверка существования директории
                    if (file_exists($fileDirNew)) {
                        echo "директория существует ";
                    } else {
                        echo "создали новую директорию ";
                        mkdir($fileDirNew, 0700, true);
                    }

                    $file = $fileDirNew . $fileNameActual . "_" . $typeTitle . "." . $fileTypeActualExt;
                    //Проверка на уникальность имени файла если такой существует переименовываем его

                    if (file_exists($file)) {
                        echo "Файл сохреннен с новым именем";
                        $fileDestinationRename = $fileDirNew . $fileNameActual . "_" . $typeTitle . "_" . round(microtime(true)) . "." . $fileTypeActualExt;
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