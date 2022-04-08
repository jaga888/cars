<?php

namespace App\Controller;

use App\Repository\VehiclesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $vehicleRepository;

    public function __construct(VehiclesRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function appDefaultAction(): Response
    {
        $vehicles = $this->vehicleRepository->findAll();

        $models = $this->vehicleRepository->getModels();
        $brands = $this->vehicleRepository->getBrands();
        $maxPrice = $this->vehicleRepository->getMaxPrice();
        $minPrice = $this->vehicleRepository->getMinPrice();
        $maxPriceMonthly = $this->vehicleRepository->getMaxPriceMonthly();
        $minPriceMonthly = $this->vehicleRepository->getMinPriceMonthly();


        return $this->render('app/index.html.twig', [
            'vehicles' => $vehicles,
            'models' => $models,
            'brands' => $brands,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
            'maxPriceMonthly' => $maxPriceMonthly,
            'minPriceMonthly' => $minPriceMonthly,
        ]);
    }
}