<?php

namespace App\Service;

use App\Repository\CreditProgramRepository;

class LoanService
{
    public function calculateLoan(int $price, float $initialPayment, int $loanTerm, CreditProgramRepository $creditProgramRepo): array
    {
        $loanAmount = $price - $initialPayment;

        // Определяем кредитную программу на основе первоначального взноса и срока кредита
        if ($initialPayment > 200000 && $loanTerm < 60) {
            // Низкая процентная ставка, короткий срок кредита
            $program = $creditProgramRepo->find(1);
        } elseif ($initialPayment < 100000 && $loanTerm > 60) {
            // Высокая процентная ставка, длинный срок кредита
            $program = $creditProgramRepo->find(2);
        } elseif ($initialPayment >= 100000 && $initialPayment <= 200000 && $loanTerm >= 36 && $loanTerm <= 60) {
            // Условие для 4-й программы: средний срок, средний первоначальный взнос
            $program = $creditProgramRepo->find(4);
        } else {
            // Программа по умолчанию для всех остальных случаев
            $program = $creditProgramRepo->find(3);
        }

        // Расчет ежемесячного платежа на основе выбранной программы
        $monthlyPayment = ($loanAmount * (1 + ($program->getInterestRate() / 100))) / $loanTerm;

        return [
            'programId' => $program->getId(),
            'interestRate' => $program->getInterestRate(),
            'monthlyPayment' => (int)$monthlyPayment,
            'title' => $program->getTitle(),
        ];
    }
}
