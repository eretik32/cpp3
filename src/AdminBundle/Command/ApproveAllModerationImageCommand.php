<?php

namespace AdminBundle\Command;

//use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
//use Symfony\Component\Console\Exception\RuntimeException;
//use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
//use Tradedealer\EntityBundle\Entity\Customer;
//use Tradedealer\EntityBundle\Entity\CustomerCar;
//use Tradedealer\EntityBundle\Entity\CustomerLoyalty;
//use Tradedealer\EntityBundle\Entity\CustomerOrder;
//use Tradedealer\EntityBundle\Entity\CustomerOrderRecommendation;
//use Tradedealer\EntityBundle\Entity\CustomerOrderWork;
//use Tradedealer\EntityBundle\Entity\CustomerPartsOrder;
//use Tradedealer\EntityBundle\Entity\CustomerProfile;
//use Tradedealer\EntityBundle\Entity\CustomerUserApi;

class ApproveAllModerationImageCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('image_moderation:approve:all')
            ->setDescription('Approve all image moderation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $productId = $product->getId();
//        $repositoryModerImg = $this->getDoctrine()->getRepository(ImageModeration::class)->findBy(
//            [
//                'product' => $productId
//            ]);
//        $em = $this->getDoctrine()->getManager();
//
//        foreach ($repositoryModerImg as $rep) {
//            $data = new Image();
//            $productImg = $rep->getProduct();
//            $typeimage = $rep->getTypeimage();
//            $pictureUrl = $rep->getPictureUrl();
//            $size = $rep->getSize();
//            $width = $rep->getWidth();
//            $length = $rep->getLength();
//
//            $data->setProduct($productImg);
//            $data->setTypeimage($typeimage);
//            $data->setPictureUrl($pictureUrl);
//            $data->setSize($size);
//            $data->setWidth($width);
//            $data->setLength($length);
//
//            $em->persist($data);
//        }
////        Удаление модерируемых фото
//        foreach ($repositoryModerImg as $moderImg) {
//            $em->remove($moderImg);
//        }
//        $em->flush();





//        $em = $this->getContainer()->get('doctrine.orm.tradedealer_entity_manager');
//        $userApi = $em->getRepository('EntityBundle:UserApi')->find($input->getArgument('user_api_id'));
//
//        if (!$userApi) {
//            throw new RuntimeException("UserApi not found");
//        }
//
//        $customer = $em->getRepository('EntityBundle:Customer')->findOneBy(['phone' => '+79123456789']);
//        if (!$customer) {
//            $customer = new Customer();
//            $customer->setPhone('+79123456789');
//            $em->persist($customer);
//            $em->flush();
//
//            $profile = new CustomerProfile();
//            $profile
//                ->setCustomer($customer)
//                ->setEmail('debug@tradedealer.ru')
//                ->setFio('Тестович Тест Тестов');
//
//            $em->persist($profile);
//            $em->flush();
//        }
//
//        $customerUserApi = $em->getRepository('EntityBundle:CustomerUserApi')->findOneBy([
//            'customer' => $customer,
//            'userApi'  => $userApi,
//        ]);
//
//        if (!$customerUserApi) {
//            $customerUserApi = new CustomerUserApi();
//
//            $encoder = $this->getContainer()->get('security.password_encoder');
//            $password = $encoder->encodePassword($customerUserApi, '1234');
//
//            $customerUserApi
//                ->setCustomer($customer)
//                ->setUserApi($userApi)
//                ->setPhoneConfirmed(true)
//                ->setPassword($password);
//
//            $em->persist($customerUserApi);
//            $em->flush();
//        }
//
//        $customerLoyal = $em->getRepository('EntityBundle:CustomerLoyalty')
//            ->findOneBy(['customerUserApi' => $customerUserApi]);
//
//        if (!$customerLoyal) {
//            $customerLoyal = new CustomerLoyalty();
//            $customerLoyal
//                ->setCustomerUserApi($customerUserApi)
//                ->setBonus(5124530)
//                ->setExternalLoyaltyId(1024563)
//                ->setCards([
//                    0 =>
//                        [
//                            'number'    => '5Т',
//                            'dateStart' => '2007-10-15',
//                            'dateEnd'   => '2008-10-15',
//                            'status'    => 'Серебряная',
//                            'discount'  => '5',
//                        ],
//                    1 =>
//                        [
//                            'number'    => '7Т 2702',
//                            'dateStart' => '2008-10-15',
//                            'dateEnd'   => '2020-10-15',
//                            'status'    => 'Золотая',
//                            'discount'  => '7',
//                        ],
//                ]);
//        }
//
//        $carIds = [399627];
//        foreach ($carIds as $carId) {
//            $customerCar = $em->getRepository('EntityBundle:CustomerCar')->findOneBy([
//                'customer' => $customer,
//                'userApi'  => $userApi,
//                'car'      => $carId,
//            ]);
//            if ($customerCar) {
//                continue;
//            }
//
//            $customerCar = new CustomerCar();
//            $customerCar
//                ->setCustomer($customer)
//                ->setUserApi($userApi)
//                ->setCar($em->getReference('EntityBundle:Car', $carId));
//
//            $em->persist($customerCar);
//            $em->flush();
//
//            foreach ($this->getOrders() as $orderData) {
//                $order = new CustomerOrder();
//
//                $company = null;
//                if ($orderData['externalId']) {
//                    $company = $em
//                        ->getRepository('EntityBundle:CompanyIntegration')
//                        ->getCompanyByExternalId($orderData['externalId']);
//                }
//
//                $order
//                    ->setCompany($company)
//                    ->setCustomerCar($customerCar)
//                    ->setExternalId($orderData['externalId'])
//                    ->setCreationDate($orderData['creationDate'])
//                    ->setCloseDate($orderData['closeDate'])
//                    ->setCarRun($orderData['carRun'])
//                    ->setConsultant($orderData['consultant'])
//                    ->setStatusCode($orderData['statusCode'])
//                    ->setTypeCode($orderData['typeCode'])
//                    ->setParts($orderData['parts']);
//
//                if (!empty($orderData['recommendations'])) {
//                    foreach ($orderData['recommendations'] as $recommendation) {
//                        /** @var CustomerOrderRecommendation $customerOrderRecommendations */
//                        $customerOrderRecommendations = new CustomerOrderRecommendation();
//
//                        $customerOrderRecommendations->setCode($recommendation['code']);
//                        $customerOrderRecommendations->setDescription($recommendation['type_code']);
//                        $customerOrderRecommendations->setCustomerOrder($order);
//
//                        $em->persist($customerOrderRecommendations);
//                    }
//                }
//
//                if (!empty($orderData['works'])) {
//                    foreach ($orderData['works'] as $work) {
//                        /** @var CustomerOrderWork $customerOrderWork */
//                        $customerOrderWork = new CustomerOrderWork();
//
//                        $customerOrderWork->setTitle($work['title']);
//                        $customerOrderWork->setCode($work['code']);
//                        $customerOrderWork->setQuantity($work['qty']);
//                        $customerOrderWork->setPrice(floatval(str_replace(',', '', $work['price'])));
//                        $customerOrderWork->setAmount(floatval(str_replace(',', '', $work['amount'])));
//                        $customerOrderWork->setCustomerOrder($order);
//
//                        if (isset($work['add_work'])) {
//                            $customerOrderWork->setAddWork($work['add_work']);
//                        }
//
//                        $em->persist($customerOrderWork);
//                    }
//                }
//
//                try {
//                    $statusCodeObject = $em
//                        ->getRepository('EntityBundle:CustomerOrderStatusCode')
//                        ->findOneBySynonym($orderData['statusCode']);
//
//                    if ($statusCodeObject) {
//                        $order->setCustomerOrderStatusCode($statusCodeObject);
//                    }
//                } catch (NonUniqueResultException $e) {
//
//                }
//
//                try {
//                    $typeCodeObject = $em
//                        ->getRepository('EntityBundle:CustomerOrderTypeCode')
//                        ->findOneBySynonym($orderData['typeCode']);
//
//                    if ($typeCodeObject) {
//                        $order->setCustomerOrderTypeCode($typeCodeObject);
//                    }
//                } catch (NonUniqueResultException $e) {
//
//                }
//
//                $em->persist($order);
//            }
//
//            foreach ($this->getParts() as $partsData) {
//                $partsOrder = new CustomerPartsOrder();
//
//                $company = null;
//                if ($partsData['externalId']) {
//                    $company = $em
//                        ->getRepository('EntityBundle:CompanyIntegration')
//                        ->getCompanyByExternalId($partsData['externalId']);
//                }
//
//                $partsOrder
//                    ->setCompany($company)
//                    ->setCustomerCar($customerCar)
//                    ->setParts($partsData['parts'])
//                    ->setExternalId($partsData['externalId'])
//                    ->setClose($partsData['close'])
//                    ->setDateCreate($partsData['dateCreate'])
//                    ->setDatePlaneShipment($partsData['datePlaneShipment'])
//                    ->setStatus($partsData['status']);
//
//                $em->persist($partsOrder);
//            }
//
//            $em->flush();
//        }
//
//        $em->flush();
//    }
//
//    private function getOrders()
//    {
//        return [
//            0  =>
//                [
//                    'id'              => 34,
//                    'externalId'      => 'ЗКСЦ10-08599',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-14 16:00:12.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-20 20:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 995,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ДОП',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00088',
//                            'name' => 'Дадон А. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                            0 => [
//                                'code'      => '',
//                                'type_code' => 'Замена аккумулятора'
//                            ],
//                            1 => [
//                                'code'      => '',
//                                'type_code' => 'Замена задного стеклоочистителя'
//                            ]
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'title'    => 'MAGICAR VУСТАНОВКА С ОРГАНИЗАЦИЕЙ ЗАПУСКА',
//                                    'code'     => 'U00014',
//                                    'qty'      => '4.5',
//                                    'price'    => '1,319.9952',
//                                    'amount'   => '5524.18',
//                                    'add_work' => false
//                                ],
//                            1 =>
//                                [
//                                    'title'    => 'ЗАМЕНА МОТОРНОГО МАСЛА',
//                                    'code'     => 'M00001',
//                                    'qty'      => '0.5',
//                                    'price'    => '450.00',
//                                    'amount'   => '225',
//                                    'add_work' => true
//                                ],
//                            2 =>
//                                [
//                                    'title'    => 'ХИМЧИСТКА САЛОНА',
//                                    'code'     => 'С00011',
//                                    'qty'      => '1.6',
//                                    'price'    => '1,100.55',
//                                    'amount'   => '1,760.88',
//                                    'add_work' => true
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '0006100502',
//                                    'title'        => 'А/с Scher-Khan Magicar 5New',
//                                    'qty'          => '1',
//                                    'amount'       => '7533',
//                                    'measure_code' => 'КОМПЛ.',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '00060B0200',
//                                    'title'        => 'Модуль обхода иммобилайзераBP2',
//                                    'qty'          => '1',
//                                    'amount'       => '869.55',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => 'ITM0002703',
//                                    'title'        => 'Расх/мат. для уст.автосигн.',
//                                    'qty'          => '1',
//                                    'amount'       => '354',
//                                    'measure_code' => '',
//                                ],
//                        ],
//                ],
//            1  =>
//                [
//                    'id'              => 35,
//                    'externalId'      => 'ЗКСЦ10-08709',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-22 19:34:57.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-22 20:17:44.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 1354,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ВО-2',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00127',
//                            'name' => 'Хомутов И.А.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3A13',
//                                    'title'  => '=1,000= KM (600 MILES) SERVICE-Проверка',
//                                    'qty'    => '0.2',
//                                    'price'  => '0',
//                                    'amount' => '0',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3A13S',
//                                    'title'  => '=1,000= KM (600 MILES) SERVICE доп. Время для А/С',
//                                    'qty'    => '0.1',
//                                    'price'  => '0',
//                                    'amount' => '0',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                        ],
//                ],
//            2  =>
//                [
//                    'id'              => 36,
//                    'externalId'      => 'ЗКСЦ10-10986',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-09-13 16:00:55.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-09-13 18:20:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 11306,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3A63B',
//                                    'title'  => '=10,000= KM (6,000 MILES)(RR D/C) SERVICE-Проверка',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '613.8',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '491.05',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '368.28',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D000021',
//                                    'title'  => 'Испаритель кондиционераобработка',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '245.52',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '367.43',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080370',
//                                    'title'        => 'Масло мот. 5W-40 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '1747.59',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1699.58',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => 'ITM0002716',
//                                    'title'        => 'Расх/мат. для обработки испарителя',
//                                    'qty'          => '0.5',
//                                    'amount'       => '650',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '0888980072',
//                                    'title'        => 'Антифриз SUPER LONG',
//                                    'qty'          => '0.2',
//                                    'amount'       => '89.9',
//                                    'measure_code' => 'Л',
//                                ],
//                        ],
//                ],
//            3  =>
//                [
//                    'id'              => 37,
//                    'externalId'      => 'ЗКСЦ10-12967',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-11-01 16:51:11.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-11-01 18:30:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 20114,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3B23G',
//                                    'title'  => '=20,000= KM(12,000 MILES)(A/T RR D/C) SERVICE-Провверка',
//                                    'qty'    => '0.9',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '1104.85',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3B23S',
//                                    'title'  => '=20,000= KM(12,000 MILES) SERVICE доп. Время для АА/С',
//                                    'qty'    => '0.1',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '122.76',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '491.05',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '368.28',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => 'D00010',
//                                    'title'  => 'ДИАГНОСТИЧЕСКИЙ СТЕНД(ТОРМОЗН.УСИЛИЯ+АМОРТИЗАТОРЫ)ТЕСТ',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,319.9952',
//                                    'amount' => '613.8',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '367.43',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080360',
//                                    'title'        => 'Масло моторное 0W-30 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '2623.01',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1699.58',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            4  =>
//                [
//                    'id'              => 38,
//                    'externalId'      => 'ЗКСЦ11-00052',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-01-05 10:34:11.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-01-05 12:50:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 29537,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3B73B',
//                                    'title'  => '=30,000= KM(18,000 MILES)(RR D/C) SERVICE-Проверка',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D000021',
//                                    'title'  => 'Испаритель кондиционераобработка',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => '190031',
//                                    'title'  => 'АКБЗАРЯДКА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '0888080360',
//                                    'title'        => 'Масло мот. 0W-30 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '2623',
//                                    'measure_code' => 'Л',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1699.57',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => 'ITM0002716',
//                                    'title'        => 'Расх/мат. для обработки испарителя',
//                                    'qty'          => '0.5',
//                                    'amount'       => '650.06',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => '0888980072',
//                                    'title'        => 'Антифриз SUPER LONG',
//                                    'qty'          => '0.15',
//                                    'amount'       => '67.42',
//                                    'measure_code' => 'Л',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '367.42',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            5  =>
//                [
//                    'id'              => 39,
//                    'externalId'      => 'ЗКСЦ11-03149',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-03-16 16:54:36.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-03-17 20:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 40011,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3C23D',
//                                    'title'  => '=40,000= KM(24,000 MILES)(M/T,RR D/C) SERVICE-Провверка',
//                                    'qty'    => '1.3',
//                                    'price'  => '1,320',
//                                    'amount' => '1595.88',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3C23S',
//                                    'title'  => '=40,000= KM(24,000 MILES)SERVICE доп. Время для А//С',
//                                    'qty'    => '0.1',
//                                    'price'  => '1,320',
//                                    'amount' => '122.76',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => '171011',
//                                    'title'  => 'ВОЗДУШНЫЙ ФИЛЬТР ДВИГАТЕЛЯЗАМЕНА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => '002469',
//                                    'title'  => 'ТОРМОЗНАЯ ЖИДКОСТЬЗАМЕНА',
//                                    'qty'    => '1.1',
//                                    'price'  => '1,320',
//                                    'amount' => '1350.36',
//                                ],
//                            5 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            6 =>
//                                [
//                                    'code'   => 'D00010',
//                                    'title'  => 'ДИАГНОСТИЧЕСКИЙ СТЕНД(ТОРМОЗН.УСИЛИЯ+АМОРТИЗАТОРЫ)ТЕСТ',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                            7 =>
//                                [
//                                    'code'   => '810151A',
//                                    'title'  => 'РЕГУЛИРОВКА СВЕТАРЕГУЛИРОВКА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '367.42',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080360',
//                                    'title'        => 'Масло мот. 0W-30 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '2623',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '1780128030',
//                                    'title'        => 'Фильтр воздушный',
//                                    'qty'          => '1',
//                                    'amount'       => '905.91',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => '0882380004',
//                                    'title'        => 'Жидкость тормозная DOT 5.1(1л)Toyota',
//                                    'qty'          => '1',
//                                    'amount'       => '508.23',
//                                    'measure_code' => 'Л',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1699.57',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            6  =>
//                [
//                    'id'              => 40,
//                    'externalId'      => 'ЗКСЦ11-07007',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-05-19 11:32:32.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-05-21 14:30:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 50499,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3C83B',
//                                    'title'  => '=50,000= KM(30,000 MILES)(RR D/C) SERVICE-Проверка',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D000021',
//                                    'title'  => 'Испаритель кондиционераобработка',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => 'U00100',
//                                    'title'  => 'ОБШИВКА ДВЕРИСНЯТИЕ / УСТАНОВКА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            5 =>
//                                [
//                                    'code'   => '67099',
//                                    'title'  => 'КРЕПЛЕНИЕ ОБШИВКА ДВЕРИ РЕМОНТ',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '395.25',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080370',
//                                    'title'        => 'Масло мот. 5W-40 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '1871.29',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1719.57',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => 'ITM0002716',
//                                    'title'        => 'Расх/мат. для обработки испарителя',
//                                    'qty'          => '0.5',
//                                    'amount'       => '604.5',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            7  =>
//                [
//                    'id'              => 41,
//                    'externalId'      => 'ЗКСЦ11-10809',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-08-03 14:51:33.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-08-06 17:12:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 60859,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3D33D',
//                                    'title'  => '=60,000= KM(36,000 MILES)(A/T,RR D/C) SERVICE-Провверка',
//                                    'qty'    => '0.9',
//                                    'price'  => '1,320',
//                                    'amount' => '1104.84',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3D33S',
//                                    'title'  => '=60,000= KM(36,000 MILES)SERVICE доп. Время для А//С',
//                                    'qty'    => '0.1',
//                                    'price'  => '1,320',
//                                    'amount' => '122.76',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => 'D00010',
//                                    'title'  => 'ДИАГНОСТИЧЕСКИЙ СТЕНД(ТОРМОЗН.УСИЛИЯ+АМОРТИЗАТОРЫ)ТЕСТ',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                            5 =>
//                                [
//                                    'code'   => '171011',
//                                    'title'  => 'ВОЗДУШНЫЙ ФИЛЬТР ДВИГАТЕЛЯЗАМЕНА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '395.25',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080370',
//                                    'title'        => 'Масло мот. 5W-40 TOYOTA 208л',
//                                    'qty'          => '4.3',
//                                    'amount'       => '1871.29',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольныйRAV20, CAM40, LC200',
//                                    'qty'          => '1',
//                                    'amount'       => '1719.57',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => '1780128030',
//                                    'title'        => 'Фильтр воздушный CAMRY 40дв. 2AZFE 2,4',
//                                    'qty'          => '1',
//                                    'amount'       => '889.08',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '0888980072',
//                                    'title'        => 'Антифриз SUPER LONG 5л (разв.)',
//                                    'qty'          => '0.2',
//                                    'amount'       => '103.86',
//                                    'measure_code' => 'Л',
//                                ],
//                        ],
//                ],
//            8  =>
//                [
//                    'id'              => 42,
//                    'externalId'      => 'ЗКСЦ11-13568',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-09-26 14:06:24.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-10-01 15:54:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 71229,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3D83B',
//                                    'title'  => '=70,000= KM (42,000 MILES(RR D/C) SERVICE-Проверка',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => 'D000021',
//                                    'title'  => 'Испаритель кондиционераобработка',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => '171011',
//                                    'title'  => 'ВОЗДУШНЫЙ ФИЛЬТР ДВИГАТЕЛЯЗАМЕНА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1719.57',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => 'ITM0002716',
//                                    'title'        => 'Расх/мат. для обработки испарителя',
//                                    'qty'          => '0.5',
//                                    'amount'       => '604.5',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '1780128030',
//                                    'title'        => 'Фильтр воздушный',
//                                    'qty'          => '1',
//                                    'amount'       => '889.08',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            9  =>
//                [
//                    'id'              => 43,
//                    'externalId'      => 'ЗКСЦ11-13814',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-10-01 14:03:33.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-10-01 14:30:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 71229,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'АКЦИИ',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '0',
//                                    'amount' => '0',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '0888080370',
//                                    'title'        => 'Масло мот. 5W-40 TOYOTA 208л',
//                                    'qty'          => '4.3',
//                                    'amount'       => '2322',
//                                    'measure_code' => 'Л',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '0',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            10 =>
//                [
//                    'id'              => 44,
//                    'externalId'      => 'ЗКСЦ11-15511',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-10-26 09:22:49.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-10-27 20:30:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 75557,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТР',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '420018',
//                                    'title'  => 'КОЛЕСА ЗИМНИЕУСТАНОВКА/БАЛАНСИРОВКА',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,320',
//                                    'amount' => '613.8',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => 'ITM0002704',
//                                    'title'        => 'Расх/мат. для шиномонтажа1-го колеса',
//                                    'qty'          => '4',
//                                    'amount'       => '131.69',
//                                    'measure_code' => '',
//                                ],
//                        ],
//                ],
//            11 =>
//                [
//                    'id'              => 45,
//                    'externalId'      => 'ЗКСЦ11-17070',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-11-23 11:03:56.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-11-26 17:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 80671,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00127',
//                            'name' => 'Хомутов И.А.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3E43D',
//                                    'title'  => '=80,000= KM(48,000 MILES)(M/T,RR D/C) SERVICE-Провверка',
//                                    'qty'    => '1.6',
//                                    'price'  => '1,320',
//                                    'amount' => '1964.16',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3E43S',
//                                    'title'  => '=80,000= KM(48,000 MILES)SERVICE доп. Время для А//С',
//                                    'qty'    => '0.1',
//                                    'price'  => '1,320',
//                                    'amount' => '122.76',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,320',
//                                    'amount' => '491.04',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => '171011',
//                                    'title'  => 'ВОЗДУШНЫЙ ФИЛЬТР ДВИГАТЕЛЯЗАМЕНА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,320',
//                                    'amount' => '245.52',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => '002469',
//                                    'title'  => 'ТОРМОЗНАЯ ЖИДКОСТЬЗАМЕНА',
//                                    'qty'    => '1.1',
//                                    'price'  => '1,320',
//                                    'amount' => '1350.36',
//                                ],
//                            5 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,320',
//                                    'amount' => '368.28',
//                                ],
//                            6 =>
//                                [
//                                    'code'   => '236021',
//                                    'title'  => 'ТОПЛИВНЫЙ ФИЛЬТРСНЯТЬ / УСТАНОВИТЬ',
//                                    'qty'    => '0.6',
//                                    'price'  => '1,320',
//                                    'amount' => '736.56',
//                                ],
//                            7 =>
//                                [
//                                    'code'   => 'D00010',
//                                    'title'  => 'ДИАГНОСТИЧЕСКИЙ СТЕНД(ТОРМОЗН.УСИЛИЯ+АМОРТИЗАТОРЫ)ТЕСТ',
//                                    'qty'    => '0.25',
//                                    'price'  => '1,320',
//                                    'amount' => '306.9',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '398.04',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080360',
//                                    'title'        => 'Масло мот. 0W-30 TOYOTA 208л',
//                                    'qty'          => '4.3',
//                                    'amount'       => '2779.3',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '1780128030',
//                                    'title'        => 'Фильтр воздушный CAMRY 40дв. 2AZFE 2,4',
//                                    'qty'          => '1',
//                                    'amount'       => '893.73',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => '0882380004',
//                                    'title'        => 'Жидкость тормозная DOT 5.1(1л)Toyota',
//                                    'qty'          => '1',
//                                    'amount'       => '633.79',
//                                    'measure_code' => 'Л',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольныйRAV20, CAM40, LC200',
//                                    'qty'          => '1',
//                                    'amount'       => '1546.59',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            5 =>
//                                [
//                                    'code'         => '7702433060',
//                                    'title'        => 'Фильтр топливный в сборе',
//                                    'qty'          => '1',
//                                    'amount'       => '5845.98',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            12 =>
//                [
//                    'id'              => 46,
//                    'externalId'      => 'ЗКСЦ12-00853',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2017-01-23 11:32:02.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       => null,
//                    'carRun'          => 90869,
//                    'statusCode'      => 'СОГЛАСОВАН',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3E93B',
//                                    'title'  => '=90,000= KM(54,000 MILES)(RR D/C) SERVICE-Проверкаа',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,450',
//                                    'amount' => '674.25',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,450',
//                                    'amount' => '539.4',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,450',
//                                    'amount' => '404.55',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D000021',
//                                    'title'  => 'Испаритель кондиционераобработка',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,450',
//                                    'amount' => '269.7',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => '810151',
//                                    'title'  => 'ЛАМПА ПЕРЕДНЕЙ ФАРЫ (ОДНА СТОРОНА)СНЯТЬ / УСТАНОВИТЬ',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,450',
//                                    'amount' => '269.7',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '398.04',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080360',
//                                    'title'        => 'Масло мот. 0W-30 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '3179.2',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1546.59',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => 'ITM0002716',
//                                    'title'        => 'Расх/мат. для обработки испарителя',
//                                    'qty'          => '0.5',
//                                    'amount'       => '604.5',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '99132YZZBA',
//                                    'title'        => 'Лампа 12V 5W  б/ц',
//                                    'qty'          => '1',
//                                    'amount'       => '24.18',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//            13 =>
//                [
//                    'id'              => 47,
//                    'externalId'      => 'ЗКСЦ12-03787',
//                    'branch'          => 'ТАГИЛ',
//                    'creationDate'    =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-03-26 10:13:17.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'closeDate'       =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-03-26 18:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'carRun'          => 100454,
//                    'statusCode'      => 'ЗН_ЗАВЕРШ',
//                    'typeCode'        => 'ТО',
//                    'consultant'      =>
//                        [
//                            'code' => 'R00016',
//                            'name' => 'Кострова Е. В.',
//                        ],
//                    'recommendations' =>
//                        [
//                        ],
//                    'works'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'   => '0B3F43E',
//                                    'title'  => '=100,000= KM(60,000 MILES)(A/T,RR D/C) SERVICE-Прооверка',
//                                    'qty'    => '1.1',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '1176.45',
//                                ],
//                            1 =>
//                                [
//                                    'code'   => '0B3F43S',
//                                    'title'  => '=100,000= KM(60,000 MILES)SERVICE доп. Время для АА/С',
//                                    'qty'    => '0.1',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '106.95',
//                                ],
//                            2 =>
//                                [
//                                    'code'   => '002119',
//                                    'title'  => 'МАСЛО ДЛЯ ДВИГАТЕЛЯ И МАСЛЯНЫЙ ФИЛЬТРЗАМЕНА',
//                                    'qty'    => '0.4',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '427.8',
//                                ],
//                            3 =>
//                                [
//                                    'code'   => 'D00004',
//                                    'title'  => 'ФИЛЬТР КОНДИЦИОНЕРАЗАМЕНА',
//                                    'qty'    => '0.3',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '320.85',
//                                ],
//                            4 =>
//                                [
//                                    'code'   => '191101',
//                                    'title'  => 'СВЕЧИ ЗАЖИГАНИЯ (ВСЕ)СНЯТЬ / УСТАНОВИТЬ',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '534.75',
//                                ],
//                            5 =>
//                                [
//                                    'code'   => 'D00010',
//                                    'title'  => 'ДИАГНОСТИЧЕСКИЙ СТЕНД(АМОРТИЗАТОРЫ)ТЕСТ',
//                                    'qty'    => '0.5',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '534.75',
//                                ],
//                            6 =>
//                                [
//                                    'code'   => 'D00017',
//                                    'title'  => 'НАПРАВЛЯЮЩИЕ СУППОРТОВСМАЗКА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,150.0044',
//                                    'amount' => '213.9',
//                                ],
//                            7 =>
//                                [
//                                    'code'   => '171011',
//                                    'title'  => 'ВОЗДУШНЫЙ ФИЛЬТР ДВИГАТЕЛЯЗАМЕНА',
//                                    'qty'    => '0.2',
//                                    'price'  => '1,450',
//                                    'amount' => '269.7',
//                                ],
//                        ],
//                    'parts'           =>
//                        [
//                            0 =>
//                                [
//                                    'code'         => '90915YZZJ2',
//                                    'title'        => 'Фильтр масляный',
//                                    'qty'          => '1',
//                                    'amount'       => '342.4',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            1 =>
//                                [
//                                    'code'         => '0888080370',
//                                    'title'        => 'Масло мот. 5W-40 TOYOTA',
//                                    'qty'          => '4.3',
//                                    'amount'       => '1857.6',
//                                    'measure_code' => 'Л',
//                                ],
//                            2 =>
//                                [
//                                    'code'         => '0897400820',
//                                    'title'        => 'Фильтр салона угольный',
//                                    'qty'          => '1',
//                                    'amount'       => '1330.4',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            3 =>
//                                [
//                                    'code'         => '9091901210',
//                                    'title'        => 'Свеча зажигания SK20R11',
//                                    'qty'          => '4',
//                                    'amount'       => '2464.32',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            4 =>
//                                [
//                                    'code'         => '0888701206',
//                                    'title'        => 'Смазка гликолиевая 100 граммд/направл.торм.суппорт.',
//                                    'qty'          => '0.1',
//                                    'amount'       => '38.4',
//                                    'measure_code' => 'ШТ',
//                                ],
//                            5 =>
//                                [
//                                    'code'         => '1780128030',
//                                    'title'        => 'Фильтр воздушный CAMRY 40дв. 2AZFE 2,4',
//                                    'qty'          => '1',
//                                    'amount'       => '768.8',
//                                    'measure_code' => 'ШТ',
//                                ],
//                        ],
//                ],
//        ];
//    }
//
//    private function getParts()
//    {
//        return [
//            0  =>
//                [
//                    'id'                => 40,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2017-06-28 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2017-06-28 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ13-00244',
//                    'status'            => 'Заявка',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '4265230811',
//                                    'title'       => 'Шина нешип.  225/50 R17Dunlop SP Sport 2050',
//                                    'qty'         => '1',
//                                    'amount'      => '10788',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'Заявка',
//                                ],
//                        ],
//                    'close'             => false,
//                ],
//            1  =>
//                [
//                    'id'                => 41,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2017-06-20 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2017-06-20 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ13-00238',
//                    'status'            => 'Склад',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0002133047',
//                                    'title'       => 'Броня (защитная трубка)33047A',
//                                    'qty'         => '1',
//                                    'amount'      => '0',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'Заявка',
//                                ],
//                            1 =>
//                                [
//                                    'code'        => '0006400800',
//                                    'title'       => 'Видеорегистратор CV-R3022,5" TFT, HD DVR',
//                                    'qty'         => '1',
//                                    'amount'      => '2092.5',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'Склад',
//                                ],
//                        ],
//                    'close'             => false,
//                ],
//            2  =>
//                [
//                    'id'                => 42,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-01-19 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-01-19 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ08-00063',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0008000F01',
//                                    'title'       => 'Набор автомобильный Toyota',
//                                    'qty'         => '1',
//                                    'amount'      => '0',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            3  =>
//                [
//                    'id'                => 43,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-07-25 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-07-25 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ08-01159',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0008000F02',
//                                    'title'       => 'Папка для документов Toyota',
//                                    'qty'         => '1',
//                                    'amount'      => '0',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                            1 =>
//                                [
//                                    'code'        => '01100296',
//                                    'title'       => 'Сумка дорожная LAND CRUISER',
//                                    'qty'         => '1',
//                                    'amount'      => '0',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            4  =>
//                [
//                    'id'                => 44,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-08-27 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-08-27 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ08-01504',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0041063007',
//                                    'title'       => 'Накладка на торец порога LC200СОЮЗ TC20.95.0577',
//                                    'qty'         => '1',
//                                    'amount'      => '18190',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            5  =>
//                [
//                    'id'                => 45,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-10-30 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2008-10-30 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ08-01763',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0071822565',
//                                    'title'       => 'Шина шип. 225/65R17 NOKIANHKPL SUV 5',
//                                    'qty'         => '4',
//                                    'amount'      => '35451.6',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            6  =>
//                [
//                    'id'                => 46,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-02 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-02 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => '',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                        ],
//                    'close'             => true,
//                ],
//            7  =>
//                [
//                    'id'                => 47,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-25 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2010-07-25 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'КВЗЧ10-00338',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => 'KFMTNPLP8809',
//                                    'title'       => 'Ковер багажника CAM40полиуретан черный 2,4L',
//                                    'qty'         => '1',
//                                    'amount'      => '1195.99',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            8  =>
//                [
//                    'id'                => 48,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-01-19 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2011-01-19 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ11-00060',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '8521242120',
//                                    'title'       => 'Щетка стеклоочистителя правая=85212YZZAF OPTIFIT',
//                                    'qty'         => '1',
//                                    'amount'      => '670.67',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                            1 =>
//                                [
//                                    'code'        => '8522242110',
//                                    'title'       => 'Щетка стеклоочистителя левая=85212YZZCR OPTIFIT',
//                                    'qty'         => '1',
//                                    'amount'      => '1349.86',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            9  =>
//                [
//                    'id'                => 49,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-01-13 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-01-13 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ12-00046',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '9098113075',
//                                    'title'       => 'Лампа 12V 55WH11',
//                                    'qty'         => '1',
//                                    'amount'      => '559.86',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            10 =>
//                [
//                    'id'                => 50,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-05-16 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-05-16 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ12-01223',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => '0008000F01',
//                                    'title'       => 'Набор автомобильный Toyota',
//                                    'qty'         => '1',
//                                    'amount'      => '0',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            11 =>
//                [
//                    'id'                => 51,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-05-14 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-05-11 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ12-01172',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => 'PL1395K',
//                                    'title'       => 'Замок на АКПП LC150Bear Lock бесштыревой',
//                                    'qty'         => '1',
//                                    'amount'      => '8785.71',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                            1 =>
//                                [
//                                    'code'        => '0006510013',
//                                    'title'       => 'А/с Pandora DXL 3500',
//                                    'qty'         => '1',
//                                    'amount'      => '12889.8',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                            2 =>
//                                [
//                                    'code'        => '0001000009',
//                                    'title'       => 'Пленка тонир. ATR 05 CH SR HPRLLumar черная',
//                                    'qty'         => '1.5',
//                                    'amount'      => '976.5',
//                                    'measureCode' => 'М',
//                                    'status'      => 'У клиента',
//                                ],
//                            3 =>
//                                [
//                                    'code'        => 'KFMNPLPO8852',
//                                    'title'       => 'Коврики салона LC150полиуретан черные (5 мест)',
//                                    'qty'         => '1',
//                                    'amount'      => '2128.77',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                            4 =>
//                                [
//                                    'code'        => 'KFMTNPLP8852',
//                                    'title'       => 'Ковер багажника LC150LC150',
//                                    'qty'         => '1',
//                                    'amount'      => '1760.49',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                            5 =>
//                                [
//                                    'code'        => '0044055003',
//                                    'title'       => 'Защита двигателя LC150,GX460сталь ДВС+КПП, бензин и дизель',
//                                    'qty'         => '1',
//                                    'amount'      => '3906',
//                                    'measureCode' => 'КОМПЛ.',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//            12 =>
//                [
//                    'id'                => 52,
//                    'branch'            => 'ТАГИЛ',
//                    'dateCreate'        =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-08-30 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'datePlaneShipment' =>
//                        \DateTime::__set_state([
//                            'date'          => '2012-08-30 00:00:00.000000',
//                            'timezone_type' => 3,
//                            'timezone'      => 'Asia/Karachi',
//                        ]),
//                    'externalId'        => 'ЗКЗЧ12-02279',
//                    'status'            => 'У клиента',
//                    'parts'             =>
//                        [
//                            0 =>
//                                [
//                                    'code'        => 'OTC01103CT',
//                                    'title'       => 'Бейсболка TOYOTA черная',
//                                    'qty'         => '1',
//                                    'amount'      => '609.15',
//                                    'measureCode' => 'ШТ',
//                                    'status'      => 'У клиента',
//                                ],
//                        ],
//                    'close'             => true,
//                ],
//        ];
    }

}
