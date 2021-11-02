<?php

namespace FondOfOryx\Service\UtilMathFormula\Model;

interface FormulaEvaluatorInterface
{
    /**
     * @param string $formula
     * @param array<float> $variables
     *
     * @return float
     */
    public function evaluate(string $formula, array $variables): float;
}
