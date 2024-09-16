<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CreditProgramRepository;

#[ORM\Entity(repositoryClass: CreditProgramRepository::class)]
#[ORM\Table(name: 'credit_programs')]
class CreditProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 2)]
    private ?float $interest_rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getInterestRate(): ?float
    {
        return $this->interest_rate;
    }

    public function setInterestRate(float $interest_rate): static
    {
        $this->interest_rate = $interest_rate;
        return $this;
    }
}
