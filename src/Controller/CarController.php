<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\CarRepository;
use App\Service\LoanService;
use App\Entity\LoanRequest;

class CarController extends AbstractController
{
    #[Route('/car', name: 'app_car')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarController.php',
        ]);
    }

    #[Route('/api/v1/cars', name: 'api_get_cars', methods: ['GET'])]
    public function getCars(CarRepository $carRepository): JsonResponse
    {
        $cars = $carRepository->findAll();

        $data = [];
        foreach ($cars as $car) {
            $data[] = [
                'id'    => $car->getId(),
                'brand' => $car->getBrand(),
                'model' => $car->getModel(),
                'photo' => $car->getPhoto(),
                'price' => $car->getPrice(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/v1/cars/{id}', name: 'api_get_car', methods: ['GET'])]
    public function getCar(int $id, CarRepository $carRepository): JsonResponse
    {
        $car = $carRepository->find($id);

        if (!$car) {
            return new JsonResponse(['message' => 'Car not found'], 404);
        }

        $data = [
            'id' => $car->getId(),
            'brand' => $car->getBrand(),
            'model' => $car->getModel(),
            'photo' => $car->getPhoto(),
            'price' => $car->getPrice(),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/v1/credit/calculate', name: 'api_calculate_credit', methods: ['GET'])]
    public function calculateCredit(Request $request, LoanService $loanService): JsonResponse
    {
        $price = (int) $request->query->get('price');
        $initialPayment = (float) $request->query->get('initialPayment');
        $loanTerm = (int) $request->query->get('loanTerm');

        $data = $loanService->calculateLoan($price, $initialPayment, $loanTerm);

        return new JsonResponse($data);
    }

    #[Route('/api/v1/request', name: 'api_save_request', methods: ['POST'])]
    public function saveRequest(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $loanRequest = new LoanRequest();
        $loanRequest->setCarId($data['carId']);
        $loanRequest->setProgramId($data['programId']);
        $loanRequest->setInitialPayment($data['initialPayment']);
        $loanRequest->setLoanTerm($data['loanTerm']);

        $em->persist($loanRequest);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}
