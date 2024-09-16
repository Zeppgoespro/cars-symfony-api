<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\CarRepository;
use App\Repository\CreditProgramRepository;
use App\Service\LoanService;
use App\Entity\LoanRequest;

class CarController extends AbstractController
{
    #[Route('/api/v1/cars', name: 'api_get_cars', methods: ['GET'])]
    public function getCars(CarRepository $carRepository): JsonResponse
    {
        $cars = $carRepository->findAll();

        $data = [];
        foreach ($cars as $car) {
            $data[] = [
                'id'    => $car->getId(),
                'brand' => [
                    'id' => $car->getBrand()->getId(),
                    'name' => $car->getBrand()->getName(),
                ],
                // 'model' => [
                //     'id' => $car->getModel()->getId(),
                //     'name' => $car->getModel()->getName(),
                // ],
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
            'brand' => [
                'id' => $car->getBrand()->getId(),
                'name' => $car->getBrand()->getName(),
            ],
            'model' => [
                'id' => $car->getModel()->getId(),
                'name' => $car->getModel()->getName(),
            ],
            'photo' => $car->getPhoto(),
            'price' => $car->getPrice(),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/v1/credit/calculate', name: 'api_calculate_credit', methods: ['GET'])]
    public function calculateCredit(
        Request $request,
        LoanService $loanService,
        CreditProgramRepository $creditProgramRepo // Подключение CreditProgramRepository
    ): JsonResponse
    {
        $price = (int) $request->query->get('price');
        $initialPayment = (float) $request->query->get('initialPayment');
        $loanTerm = (int) $request->query->get('loanTerm');

        // Передаем CreditProgramRepository как четвертый аргумент
        $data = $loanService->calculateLoan($price, $initialPayment, $loanTerm, $creditProgramRepo);

        return new JsonResponse($data);
    }

    #[Route('/api/v1/request', name: 'api_save_request', methods: ['POST'])]
    public function saveRequest(Request $request, EntityManagerInterface $em, CarRepository $carRepository, CreditProgramRepository $creditProgramRepo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Найти сущность Car на основе переданного car_id
        $car = $carRepository->find($data['car_id']);
        if (!$car) {
            return new JsonResponse(['message' => 'Car not found'], 404);
        }

        // Найти сущность CreditProgram на основе переданного program_id
        $creditProgram = $creditProgramRepo->find($data['program_id']);
        if (!$creditProgram) {
            return new JsonResponse(['message' => 'Credit program not found'], 404);
        }

        // Создаем и заполняем LoanRequest
        $loanRequest = new LoanRequest();
        $loanRequest->setCar($car);
        $loanRequest->setCreditProgram($creditProgram);
        $loanRequest->setInitialPayment($data['initial_payment']);
        $loanRequest->setLoanTerm($data['loan_term']);

        // Сохраняем запрос
        $em->persist($loanRequest);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}
