<?php

namespace App\Entity;

use App\Repository\LoanRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRequestRepository::class)]
#[ORM\Table(name: 'loan_requests')]
class LoanRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $car_id = null;

    #[ORM\Column]
    private ?int $program_id = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 2)]
    private ?float $initial_payment = null;

    #[ORM\Column]
    private ?int $loan_term = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarId(): ?int
    {
        return $this->car_id;
    }

    public function setCarId(int $car_id): static
    {
        $this->car_id = $car_id;

        return $this;
    }

    public function getProgramId(): ?int
    {
        return $this->program_id;
    }

    public function setProgramId(int $program_id): static
    {
        $this->program_id = $program_id;

        return $this;
    }

    public function getInitialPayment(): ?int
    {
        return $this->initial_payment;
    }

    public function setInitialPayment(int $initial_payment): static
    {
        $this->initial_payment = $initial_payment;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loan_term;
    }

    public function setLoanTerm(int $loan_term): static
    {
        $this->loan_term = $loan_term;

        return $this;
    }
}
