<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\CreditProgram;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $brands = [
            'Toyota' => [
                ['model' => 'Corolla', 'price' => 1500000],
                ['model' => 'Camry', 'price' => 2000000],
                ['model' => 'Land Cruiser', 'price' => 3000000],
            ],
            'BMW' => [
                ['model' => 'Series 3', 'price' => 2200000],
                ['model' => 'Series 5', 'price' => 3000000],
                ['model' => 'X5', 'price' => 4000000],
            ],
            'Mercedes' => [
                ['model' => 'C-Class', 'price' => 2800000],
                ['model' => 'E-Class', 'price' => 3500000],
                ['model' => 'S-Class', 'price' => 5000000],
            ],
        ];

        foreach ($brands as $brandName => $cars) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);

            foreach ($cars as $carData) {
                $model = new Model();
                $model->setName($carData['model']);
                $model->setBrand($brand);
                $manager->persist($model);

                $car = new Car();
                $car->setBrand($brand);
                $car->setModel($model);
                $car->setPrice($carData['price']);
                $car->setPhoto(null); // No photos
                $manager->persist($car);
            }
        }

        $creditPrograms = [
            ['title' => 'Alfa Energy', 'interest_rate' => 12.3],
            ['title' => 'Sber Super Long', 'interest_rate' => 15.0],
            ['title' => 'Tinkoff Mega Affordable', 'interest_rate' => 10.0],
            ['title' => 'VTB Uber Medium', 'interest_rate' => 13.5],
        ];

        foreach ($creditPrograms as $programData) {
            $creditProgram = new CreditProgram();
            $creditProgram->setTitle($programData['title']);
            $creditProgram->setInterestRate($programData['interest_rate']);
            $manager->persist($creditProgram);
        }

        $manager->flush();
    }
}
