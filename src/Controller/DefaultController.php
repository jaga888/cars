<?php

namespace App\Controller;

use App\Repository\VehiclesRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $vehicleRepository;
    private $paginator;

    public function __construct(VehiclesRepository $vehicleRepository, PaginatorInterface $paginator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function appDefaultAction(Request $request): Response
    {
        $vehicleQueryBuilder = $this->vehicleRepository->createQueryBuilder('v');

        if ($request->get('brands')) {
            $vehicleQueryBuilder->andWhere("v.brand IN(:brands)")
                ->setParameter('brands', array_values($request->get('brands')));
        }

        if ($request->get('models')) {
            $vehicleQueryBuilder->andWhere("v.model IN(:models)")
                ->setParameter('models', array_values($request->get('models')));
        }

        if ($request->get('energies')) {
            $vehicleQueryBuilder->andWhere("v.energy IN(:energies)")
                ->setParameter('energies', array_values($request->get('energies')));
        }

        $pagination = $this->paginator->paginate(
            $vehicleQueryBuilder,
            $request->query->getInt('page', 1),
            11
        );

        $models = $this->vehicleRepository->getModels();
        $brands = $this->vehicleRepository->getBrands();
        $energies = $this->vehicleRepository->getEnergy();

        $maxPrice = $this->vehicleRepository->getMaxPrice();
        $minPrice = $this->vehicleRepository->getMinPrice();
        $maxPriceMonthly = $this->vehicleRepository->getMaxPriceMonthly();
        $minPriceMonthly = $this->vehicleRepository->getMinPriceMonthly();


        return $this->render('app/index.html.twig', [
            'pagination' => $pagination,
            'models' => $models,
            'brands' => $brands,
            'energies' => $energies,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
            'maxPriceMonthly' => $maxPriceMonthly,
            'minPriceMonthly' => $minPriceMonthly,
        ]);
    }
}