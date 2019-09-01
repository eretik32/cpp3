<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\RecearchImage;
use AdminBundle\Entity\Research;
use AdminBundle\Forms\LoadProductListFormType;
use AdminBundle\Forms\Model\LoadProductListModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class FileMappingController extends Controller
{
    /**
     * @Route("/admin/moderation/mapping", name="file_mapping")
     */

    public function LoadProductFileAction(Request $request)
    {

        $model = new LoadProductListModel();
        $form = $this->createForm(LoadProductListFormType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $model->getFile();   //наша загруженная таблица
            $file_mimes = array("xlsx", "application/vnd.ms-excel", "xls");

            $arr_file = explode('.', $_FILES['load_product_list_form']['name']['file']);
            $extension = end($arr_file);
            if (in_array($extension, $file_mimes)) {

                if ('xlsx' == $extension) {

                    $em = $this->getDoctrine()->getManager();

                    //Очищаем таблицу Research в БД
                    $research_list = $this->getDoctrine()->getRepository('AdminBundle:Research')->findAll();
                    foreach ($research_list as $researchItem) {
                        $researchId = $this->getDoctrine()->getRepository('AdminBundle:Research')->find($researchItem->getId());
                        $em->remove($researchId);
                    }
                    //Очищаем таблицу RecearchImage в БД
                    $researchImages = $this->getDoctrine()->getRepository('AdminBundle:RecearchImage')->findAll();
                    foreach ($researchImages as $researchImage) {
                        $em->remove($researchImage);
                    }



                    $em->flush();

                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
                    $spreadsheet = $reader->load($file);
                    $worksheet = $spreadsheet->getActiveSheet();

                    foreach ($worksheet->getRowIterator() as $row) {
                        $prodIterator = $row->getCellIterator();
                        $prodIterator->setIterateOnlyExistingCells(FALSE);

                        foreach ($prodIterator as $prodTitle) {
                            //проверка на пустые поля в документе
                            if ($prodTitle == null || $prodTitle == '') {
                                continue;
                            }
                            // Подставляем в метод findByProductName полученные товары из документа
                            $products = $this
                                ->getDoctrine()
                                ->getRepository('CoreBundle:Product')
                                ->findByProductName($prodTitle->getValue());
                            foreach ($products as $product) {
                                $data = new Research();
                                $data->setTitle($product->getTitle());
                                foreach ($product->getImages() as $image) {
                                    $data->addImage($image);
                                }
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($data);
                                $em->flush();

                            //Создание сушьности RecearchImage с названием продукта и картинок относящихся к нему на основе выборки
                                foreach ($product->getImages() as $image) {
                                    $dataRecearchImage = new RecearchImage();

                                    // id recearch , id images
                                    $dataRecearchImage->setIdProduct($product->getId());
                                    $dataRecearchImage->setIdImage($image->getId());
                                    $em->persist($dataRecearchImage);
                                }
                                $em->flush();
                            }
                        }
                    }
                } else {
                    echo "Выберите файд Exel(xlsx)";
                }
            } else {
                $error_format = "Загружен не верный формат документа";
                return $this->render('@Admin/FileMapping/fileMapping.html.twig', [
                    'add_file_form' => $form->createView(),
                    'error_format' => $error_format,
                ]);
            }

//            $productsListResearch = $this->getDoctrine()
//                ->getRepository('AdminBundle:Research')
//                ->findAll();

            $productsListResearchImage = $this->getDoctrine()
                ->getRepository('AdminBundle:RecearchImage')
                ->findAllRecearchImage();
            dump($productsListResearchImage);


//            foreach ($productsListResearch as $productSearch) {
//                $allProducts[] = $productSearch->getImages();
//            }
            return $this->render('@Admin/FileMapping/fileMapping.html.twig', [
                'add_file_form' => $form->createView(),
//                'productsListResearch' => $allProducts,
            ]);
        }

        return $this->render('@Admin/FileMapping/fileMapping.html.twig', [
            'add_file_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/moderation/mapping", name="LoadProductCheckImages")
     */

    public function LoadProductCheckImages()
    {

    }

}