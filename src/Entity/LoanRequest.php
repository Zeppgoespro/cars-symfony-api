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

    #[ORM\ManyToOne(targetEntity: Car::class)]
    private ?Car $car = null;

    #[ORM\ManyToOne(targetEntity: CreditProgram::class)]
    private ?CreditProgram $credit_program = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 2)]
    private ?float $initial_payment = null;

    #[ORM\Column]
    private ?int $loan_term = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getCreditProgram(): ?CreditProgram
    {
        return $this->credit_program;
    }

    public function setCreditProgram(CreditProgram $credit_program): static
    {
        $this->credit_program = $credit_program;

        return $this;
    }

    public function getInitialPayment(): ?float
    {
        return $this->initial_payment;
    }

    public function setInitialPayment(float $initial_payment): static
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
