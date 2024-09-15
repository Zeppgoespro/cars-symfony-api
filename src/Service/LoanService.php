<?php

namespace App\Service;

class LoanService
{
    public function calculateLoan(int $price, float $initialPayment, int $loanTerm): array
    {
        $loanAmount = $price - $initialPayment;
        $interestRate = 12.3;
        $monthlyPayment = ($loanAmount * (1 + ($interestRate / 100))) / $loanTerm;

        return [
            'programId' => 1,
            'interestRate' => $interestRate,
            'monthlyPayment' => (int) $monthlyPayment,
            'title' => 'Alfa Energy',
        ];
    }
}
